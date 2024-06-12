<?php

namespace Modules\Monitoring\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Carbon\Carbon;
use Modules\Monitoring\Entities\Perencanaan;
use Modules\Monitoring\Entities\Realisasi;
use Modules\Monitoring\Entities\SubPerencanaan;
use Modules\Monitoring\Entities\Unit;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index_bulanan()
    {
        $units = Unit::all();

        return view('monitoring::laporan_bulanan.index', compact('units'));
    }

    public function getData(Request $request)
    {
        $units = Unit::all();
        $year = $request->input('year', date('Y'));
        $unitId = $request->input('unit', null);
        $programId = $request->input('program', null);
        $kegiatanId = $request->input('kegiatan', null);
        $target = [];
        $realisasi = [];

        for ($i = 1; $i <= 12; $i++) {
            $target[$i] = Perencanaan::with(['subPerencanaan' => function ($query) use ($year, $i) {
                    $query->whereYear('rencana_bayar', $year)
                        ->whereMonth('rencana_bayar', $i);
                }])
                ->when($unitId, function ($query) use ($unitId) {
                    return $query->where('unit_id', $unitId);
                })
                ->when($programId, function ($query) use ($programId) {
                    return $query->where('id', $programId);
                })
                ->when($kegiatanId, function ($query) use ($kegiatanId) {
                    return $query->whereHas('subPerencanaan', function ($q) use ($kegiatanId) {
                        $q->where('id', $kegiatanId);
                    });
                })
                ->get()
                ->reduce(function ($carry, $item) {
                    return $carry + $item->subPerencanaan->sum(function ($sub) {
                        return $sub->volume * $sub->harga_satuan;
                    });
                }, 0);

            $realisasi[$i] = Realisasi::with('perencanaan')
                ->whereYear('tanggal_pembayaran', $year)
                ->whereMonth('tanggal_pembayaran', $i)
                ->when($unitId, function ($query) use ($unitId) {
                    return $query->whereHas('subPerencanaan.perencanaan.unit', function ($q) use ($unitId) {
                        $q->where('id', $unitId);
                    });
                })
                ->when($programId, function ($query) use ($programId) {
                    return $query->whereHas('subPerencanaan.perencanaan', function ($q) use ($programId) {
                        $q->where('id', $programId);
                    });
                })
                ->when($kegiatanId, function ($query) use ($kegiatanId) {
                    return $query->whereHas('subPerencanaan', function ($q) use ($kegiatanId) {
                        $q->where('id', $kegiatanId);
                    });
                })
                ->sum('realisasi');
        }

        return response()->json([
            'target' => array_values($target),
            'realisasi' => array_values($realisasi),
            'units' => $units
        ]);
    }

    public function getProgram(Request $request)
    {
        $unitId = $request->input('unit');
        $programs = Perencanaan::where('unit_id', $unitId)->get();

        return response()->json([
            'programs' => $programs
        ]);
    }

    public function getKegiatan(Request $request)
    {
        $programId = $request->input('program');
        $kegiatan = SubPerencanaan::where('perencanaan_id', $programId)->get();

        return response()->json([
            'kegiatan' => $kegiatan
        ]);
    }

    public function index_triwulan()
    {
        return view('monitoring::laporan_triwulan.index');
    }

    // Api chart
    public function ChartKeuangan()
    {
        $currentYear = Carbon::now()->year;
        $monthlyRealisasi = Realisasi::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(realisasi) as total_realisasi')
            ->whereYear('created_at', $currentYear)
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->keyBy('month');

        $realisasi = collect();
        for ($i = 1; $i <= 12; $i++) {
            $realisasi->push([
                'month' => Carbon::create()->month($i)->format('F'),
                'total_realisasi' => $monthlyRealisasi->get($i)->total_realisasi ?? 0,
            ]);
        }
        return response()->json($realisasi);
    }
}
