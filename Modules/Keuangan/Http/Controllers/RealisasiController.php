<?php

namespace Modules\Keuangan\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Keuangan\Entities\Perencanaan;
use Modules\Keuangan\Entities\Realisasi;
use Modules\Keuangan\Entities\SubPerencanaan;

class RealisasiController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');

        if ($query) {
            $perencanaans = Perencanaan::with('subPerencanaan')
                ->where('nama', 'LIKE', "%{$query}%")
                ->orWhere('kode', 'LIKE', "%{$query}%")
                ->paginate(10);
        } else {
            $perencanaans = Perencanaan::with('subPerencanaan')->paginate(10);
        }

        foreach ($perencanaans as $perencanaan) {
            $perencanaan->jumlah_anggaran = $perencanaan->subPerencanaan->sum(function ($sub) {
                return $sub->volume * $sub->harga_satuan;
            });

            $perencanaan->realisasi_keuangan = $perencanaan->subPerencanaan->sum(function ($sub) {
                return $sub->realisasi->sum('realisasi');
            });
        }

        return view('keuangan::realisasi.index', compact('perencanaans'));
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

        return redirect()->route('keuangan::realisasi.index')->with('success', 'Realisasi berhasil dihapus.');
    }
}
