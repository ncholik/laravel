<?php

namespace Modules\Keuangan\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Keuangan\Entities\Perencanaan;
use Modules\Keuangan\Entities\Realisasi;

class RealisasiController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');

        if ($query) {
            // Perform the search based on the query
            $perencanaans = Perencanaan::with('subPerencanaan')
                ->where('nama', 'LIKE', "%{$query}%")
                ->orWhere('kode', 'LIKE', "%{$query}%")
                ->paginate(10);
        } else {
            $perencanaans = Perencanaan::with('subPerencanaan')->paginate(10);
        }

        return view('keuangan::realisasi.index', compact('perencanaans'));
    }

    // public function sub_index($id)
    // {
    //     $perencanaan = Perencanaan::findOrFail($id);
    //     $subPerencanaan = $perencanaan->subPerencanaan;
    //     return view('keuangan::realisasi.sub_index', compact('subPerencanaan', 'perencanaan'));
    // }

    public function create()
    {
        return view('keuangan::realisasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'progres' => 'required|numeric',
            'realisasi' => 'required|numeric',
            'laporan_keuangan' => 'required|string',
            'laporan_kegiatan' => 'required|string',
            'ketercapaian_output' => 'required|string',
            'tanggal_kontrak' => 'required|date',
            'tanggal_pembayaran' => 'required|date',
            'sub_perencanaan_id' => 'required|exists:sub_perencanaans,id',
        ]);

        Realisasi::create($validated);

        return redirect()->route('keuangan::realisasi.index')->with('success', 'Realisasi berhasil ditambahkan.');
    }

    public function show($id)
    {
        $perencanaans = Perencanaan::with('subPerencanaan')->findOrFail($id);

        $filterBulan = $perencanaans->subPerencanaan->map(function ($sub) {
            return \Carbon\Carbon::parse($sub->rencana_bayar)->format('F');
        })->unique()->values();

        $jumlah_anggaran = $perencanaans->subPerencanaan->sum(function ($sub) {
            return $sub->volume * $sub->harga_satuan;
        });

        $realisasi_keuangan = $perencanaans->subPerencanaan->sum(function ($sub) {
            return $sub->realisasi->sum('realisasi');
        });

        $efisiensi = $jumlah_anggaran - $realisasi_keuangan;

        return view('keuangan::realisasi.show', compact('perencanaans', 'filterBulan', 'jumlah_anggaran', 'realisasi_keuangan', 'efisiensi'));
    }

    public function edit($id)
    {
        return view('keuangan::realisasi.edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
