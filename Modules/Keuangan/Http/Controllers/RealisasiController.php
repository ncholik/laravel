<?php

namespace Modules\Keuangan\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Keuangan\Entities\Perencanaan;
use Modules\Keuangan\Entities\Realisasi;
use Modules\Keuangan\Entities\SubPerencanaan;

class RealisasiController extends Controller
{
    public function index()
    {
        $jumlahProgramKerja = SubPerencanaan::count();
        // $realisasi = Realisasi::whereHas('subPerencanaan.realisasi')->get();
        $perencanaans = Perencanaan::with('subPerencanaan')->paginate(10);
        $totalDPA = 0;

        foreach ($perencanaans as $item) {
            $subPerencanaan = $item->subPerencanaan;
            foreach ($subPerencanaan as $sub) {
                $totalDPA += ($sub->volume * $sub->harga_satuan);
            }
        }

        return view('keuangan::realisasi.index', compact('perencanaans', 'jumlahProgramKerja', 'totalDPA'));
    }

    public function sub_index($id)
    {
        $perencanaan = Perencanaan::findOrFail($id);
        $subPerencanaan = $perencanaan->subPerencanaan;
        return view('keuangan::realisasi.sub_index', compact('subPerencanaan', 'perencanaan'));
    }

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
        return view('keuangan::realisasi.show');
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
