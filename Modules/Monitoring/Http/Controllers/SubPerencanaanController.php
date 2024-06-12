<?php

namespace Modules\Monitoring\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Monitoring\Entities\Perencanaan;
use Modules\Monitoring\Entities\SubPerencanaan;

class SubPerencanaanController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index($id)
    {
        $perencanaan = Perencanaan::findOrFail($id);
        $subPerencanaan = $perencanaan->subPerencanaan;
        return view('monitoring::perencanaan.sub_index', compact('subPerencanaan', 'perencanaan'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('monitoring::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'kegiatan' => 'required|string',
            'volume' => 'required|integer',
            'satuan' => 'required|string',
            'harga_satuan' => 'required|numeric',
            'output' => 'required|string',
            'rencana_mulai' => 'required|date',
            'rencana_bayar' => 'required|date',
            'file_hps' => 'required|string',
            'file_kak' => 'required|string',
            'pic_id' => 'required|string',
            'ppk_id' => 'required|string',
            'perencanaan_id' => 'required|exists:perencanaans,id',
        ]);

        SubPerencanaan::create($request->all());
        $perencanaanId = $request->perencanaan_id;

        return redirect()->route('perencanaan.sub_index', ['perencanaan' => $perencanaanId])
            ->with('success', 'Sub Perencanaan berhasil ditambahkan.');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $subPerencanaan = SubPerencanaan::findOrFail($id);
        $perencanaan = $subPerencanaan->perencanaan;
        $total = $subPerencanaan->volume * $subPerencanaan->harga_satuan;

        return view('monitoring::perencanaan.show', compact('subPerencanaan', 'perencanaan', 'total'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('monitoring::edit');
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
