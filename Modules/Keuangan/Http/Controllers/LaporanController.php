<?php

namespace Modules\Keuangan\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Keuangan\Entities\Perencanaan;
use PDF;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('keuangan::laporan.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('keuangan::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    
    public function show_laporan()
    {
        $perencanaans = Perencanaan::with('subPerencanaan.realisasi')->get();

        $this->hitungAnggaran($perencanaans);

        $data = [
            'perencanaans' => $perencanaans
        ];

        return view('keuangan::laporan.show_laporan', $data);
    }

    function hitungAnggaran($perencanaans)
    {
        // menghitung program
        foreach ($perencanaans as $perencanaan) {
            $perencanaan->anggaran = $perencanaan->subPerencanaan->sum(function ($sub) {
                return $sub->volume * $sub->harga_satuan;
            });

            $perencanaan->realisasi_ini = $perencanaan->subPerencanaan->sum(function ($sub) {
                return $sub->realisasi->sum('realisasi');
            });

            $perencanaan->sisa = $perencanaan->anggaran - $perencanaan->realisasi_ini;

            // menghitung kegiatan
            foreach ($perencanaan->subPerencanaan as $sub) {
                $sub->sub_anggaran = $sub->volume * $sub->harga_satuan;

                $sub->sub_realisasi = $sub->realisasi->isNotEmpty() ? $sub->realisasi->first()->realisasi : 0;

                $sub->sisa_sub = $sub->sub_anggaran - $sub->sub_realisasi;
            }
        }
    }

    public function cetak_laporan()
    {
        $perencanaans = Perencanaan::with('subPerencanaan.realisasi')->get();
        $this->hitungAnggaran($perencanaans);

        $data = [
            'perencanaans' => $perencanaans
        ];

        $pdf = PDF::loadView('keuangan::laporan.cetak_laporan', $data);
        $pdf->setPaper('A4', 'landscape');

        return response($pdf->stream('laporan_realisasi_TA_2024.pdf'), 200)
        ->header('Content-Type', 'application/pdf');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('keuangan::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
