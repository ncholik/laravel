<?php

namespace Modules\Keuangan\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Keuangan\Entities\Perencanaan;
use Modules\Keuangan\Entities\Realisasi;
use Modules\Keuangan\Entities\SubPerencanaan;
use Modules\Keuangan\Entities\Unit;

class KeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $perencanaan = Perencanaan::with('subPerencanaan')->get();
        $realisasi = Realisasi::with('subPerencanaan.perencanaan.unit')->get();
        $units = Unit::all();
        $data = [];

        // hitung total pagu
        $total_pagu = 0;
        foreach ($perencanaan as $item) {
            $total_pagu += $item->pagu;
        }

        // Hitung total perencanaan
        $total_perencanaan = $perencanaan->reduce(function ($carry, $item) {
            return $carry + $item->subPerencanaan->sum(function ($sub) {
                return $sub->volume * $sub->harga_satuan;
            });
        }, 0);

        // hitung total realisasi
        $total_realisasi = 0;
        foreach ($realisasi as $item) {
            $total_realisasi += $item->realisasi;
        }

        $persentase_realisasi = 0;
        $persentase_belum_direalisasi = 0;
        // Hitung persentase
        if ($total_pagu > 0) {
            $persentase_realisasi = ($total_realisasi / $total_pagu) * 100;
            $persentase_belum_direalisasi = 100 - $persentase_realisasi;
        }

        $persentase_rpd = 0;
        $persentase_sisa_rpd = 0;
        // Hitung persentase
        if ($total_perencanaan > 0) {
            $persentase_rpd = ($total_realisasi / $total_perencanaan) * 100;
            $persentase_sisa_rpd = 100 - $persentase_rpd;
        }

        // Inisialisasi unitRealisasi dengan semua unit
        $unitRealisasi = [];
        foreach ($units as $unit) {
            $unitRealisasi[$unit->id] = [
                'nama' => $unit->nama,
                'total_pagu' => 0,
                'total_perencanaan' => 0,
                'total_realisasi' => 0,
                'percentage' => 0
            ];
        }

        // Hitung total pagu per unit
        foreach ($perencanaan as $item) {
            $unit = $item->unit;
            if ($unit) {
                $unitId = $unit->id;
                $unitRealisasi[$unitId]['total_pagu'] += $item->pagu;
            }
        }

        // Hitung total perencanaan per unit
        foreach ($perencanaan as $item) {
            $unit = $item->unit;
            if ($unit) {
                $unitId = $unit->id;
                $unitRealisasi[$unitId]['total_perencanaan'] += $item->subPerencanaan->sum(function ($sub) {
                    return $sub->volume * $sub->harga_satuan;
                });
            }
        }

        // Hitung total realisasi per unit
        foreach ($realisasi as $item) {
            $unit = $item->subPerencanaan->perencanaan->unit;
            if ($unit) {
                $unitId = $unit->id;
                $unitRealisasi[$unitId]['total_realisasi'] += $item->realisasi;
            }
        }

        // Hitung persentase untuk semua unit
        foreach ($unitRealisasi as &$unit) {
            if ($total_perencanaan > 0) {
                $unit['percentage'] = ($unit['total_realisasi'] / $total_perencanaan) * 100;
            } else {
                $unit['percentage'] = 0;
            }
        }

        // Sort the units by total realisasi in descending order and get the top 5
        usort($unitRealisasi, function ($a, $b) {
            return $b['total_realisasi'] <=> $a['total_realisasi'];
        });

        $topUnits = array_slice($unitRealisasi, 0, 5);

        // Sort the units by total realisasi in ascending order and get the bottom 5
        usort($unitRealisasi, function ($a, $b) {
            return $a['total_realisasi'] <=> $b['total_realisasi'];
        });

        $bottomUnits = array_slice($unitRealisasi, 0, 5);

        // Data untuk chart per bulan
        $targetPerBulan = SubPerencanaan::selectRaw('MONTH(rencana_mulai) as bulan, SUM(volume * harga_satuan) as total')
            ->groupBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        $realisasiPerBulan = Realisasi::selectRaw('MONTH(tanggal_pembayaran) as bulan, SUM(realisasi) as total')
            ->groupBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        $currentMonth = date('m');

        $target = [];
        $realisasi = [];
        $persentasePerBulan = [];

        for ($i = 1; $i <= $currentMonth; $i++) {
            $targetSum = 0;
            $realisasiSum = 0;

            for ($j = 1; $j <= $i; $j++) {
                $targetSum += $targetPerBulan[$j] ?? 0;
                $realisasiSum += $realisasiPerBulan[$j] ?? 0;
            }

            $target[] = $targetSum;
            $realisasi[] = $realisasiSum;

            if ($targetSum > 0) {
                $persentasePerBulan[$i] = ($realisasiSum / $targetSum) * 100;
            } else {
                $persentasePerBulan[$i] = 0;
            }
        }

        $namaBulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        $data = [
            $persentase_realisasi,
            $persentase_belum_direalisasi
        ];

        // dd($unitRealisasi);
        return view('keuangan::index', compact(
            'perencanaan',
            'total_pagu',
            'total_perencanaan',
            'total_realisasi',
            'topUnits',
            'bottomUnits',
            'persentase_realisasi',
            'persentase_belum_direalisasi',
            'persentase_rpd',
            'persentase_sisa_rpd',
            'target',
            'realisasi',
            'persentasePerBulan',
            'namaBulan'
        ))->with('data', $data);
    }
}
