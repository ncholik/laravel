<?php

namespace Modules\Keuangan\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Keuangan\Entities\Perencanaan;
use Modules\Keuangan\Entities\Realisasi;
use Modules\Keuangan\Entities\Unit;

class RealisasiController extends Controller
{
    public function index(Request $request)
    {
        $unitId = $request->input('unit_id');
        $sumber_dana = $request->input('sumber');
        $akun_belanja = $request->input('akun');
        $tahun_anggaran = $request->input('tahun');

        $perencanaansQuery = Perencanaan::with(['subPerencanaan']);

        if ($unitId) {
            $perencanaansQuery->where('unit_id', $unitId);
        }

        if ($sumber_dana) {
            $perencanaansQuery->where('sumber', $sumber_dana);
        }

        if ($akun_belanja) {
            // Join with sub_perencanaans and filter based on 'jenis' column
            $perencanaansQuery->whereHas('subPerencanaan', function ($query) use ($akun_belanja) {
                $query->where('jenis', $akun_belanja);
            });
        }

        if ($tahun_anggaran) {
            $perencanaansQuery->where('tahun', $tahun_anggaran);
        }

        $perencanaans = $perencanaansQuery->orderBy('kode', 'asc')->paginate(20);

        foreach ($perencanaans as $perencanaan) {
            $perencanaan->total_anggaran = $perencanaan->subPerencanaan->sum(function ($sub) {
                return $sub->volume * $sub->harga_satuan;
            });

            $perencanaan->total_realisasi = $perencanaan->subPerencanaan->sum(function ($sub) {
                return $sub->realisasi->sum('realisasi');
            });

            $perencanaan->sisa_anggaran = $perencanaan->pagu - $perencanaan->total_realisasi;

            // Menghitung persentase realisasi
            if ($perencanaan->total_anggaran > 0) {
                $perencanaan->persentase = ($perencanaan->total_realisasi / $perencanaan->total_anggaran) * 100;
            } else {
                $perencanaan->persentase = 0;
            }
        }

        $units = Unit::all();
        $sumber = ['BOPTN', 'PNBP', 'RM', 'Hibah'];
        $akun = ['Barang', 'Jasa Konsultasi', 'Operasional', 'Pekerjaan Kontruksi'];
        $tahun = range(date('Y'), date('Y') - 5);

        return view('keuangan::realisasi.index', compact(
            'perencanaans', 
            'units',
            'sumber', 
            'akun', 
            'tahun', 
            'unitId', 
            'sumber_dana', 
            'akun_belanja',
            'tahun_anggaran'
        ));
    }

    public function create()
    {
        return view('keuangan::realisasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'progres' => 'required|numeric',
            'realisasi' => 'required|numeric',
            'laporan_keuangan' => 'required|string',
            'laporan_kegiatan' => 'required|string',
            'ketercapaian_output' => 'required|string',
            'tanggal_kontrak' => 'required|date',
            'tanggal_pembayaran' => 'required|date',
            'sub_perencanaan_id' => 'required|exists:sub_perencanaans,id',
        ]);

        Realisasi::create($request->all());

        return redirect()->back()->with('success', 'Realisasi berhasil ditambahkan.');
    }

    public function show($id)
    {
        $perencanaans = Perencanaan::with('subPerencanaan.realisasi')->findOrFail($id);

        $realisasi = $perencanaans->subPerencanaan->mapWithKeys(function ($sub) {
            return [$sub->id => $sub->realisasi];
        });

        $filterBulan = $perencanaans->subPerencanaan->map(function ($sub) {
            return \Carbon\Carbon::parse($sub->rencana_bayar)->format('F');
        })->unique()->values();

        $jumlah_anggaran = $perencanaans->subPerencanaan->sum(function ($sub) {
            return $sub->volume * $sub->harga_satuan;
        });

        $realisasi_keuangan = $perencanaans->subPerencanaan->sum(function ($sub) {
            return $sub->realisasi->sum('realisasi');
        });

        return view('keuangan::realisasi.show', compact('realisasi', 'perencanaans', 'filterBulan', 'jumlah_anggaran', 'realisasi_keuangan'));
    }

    public function edit($id)
    {
        $realisasi = Realisasi::findOrFail($id);
        return view('keuangan::realisasi.edit', compact('realisasi'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'progres' => 'required|numeric',
            'realisasi' => 'required|numeric',
            'laporan_keuangan' => 'required|string',
            'laporan_kegiatan' => 'required|string',
            'ketercapaian_output' => 'required|string',
            'tanggal_kontrak' => 'required|date',
            'tanggal_pembayaran' => 'required|date',
        ]);

        $realisasi = Realisasi::findOrFail($id);
        $realisasi->update($validated);

        return redirect()->back()->with('success', 'Realisasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $realisasi = Realisasi::findOrFail($id);
        $realisasi->delete();

        return response()->json(['success' => 'Realisasi berhasil dihapus.']);
    }
}
