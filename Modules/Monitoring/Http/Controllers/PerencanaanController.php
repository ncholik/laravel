<?php

namespace Modules\Monitoring\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Monitoring\Entities\Perencanaan;
use Modules\Monitoring\Entities\SubPerencanaan;

class PerencanaanController extends Controller
{
    public function index()
    {
        $perencanaans = Perencanaan::paginate(10);
        return view('monitoring::perencanaan.index', compact('perencanaans'));
    }

    public function create()
    {
        return view('monitoring::perencanaan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kode' => 'required|string|max:255',
            'sumber' => 'required|string|max:255',
            'revisi' => 'required|string|max:255',
            'unit_id' => 'required|integer',
        ]);

        Perencanaan::create($request->all());

        return redirect()->route('perencanaan.index')
            ->with('success', 'Perencanaan berhasil ditambahkan.');
    }

    public function show($id)
    {
        return view('monitoring::show');
    }

    public function edit(Perencanaan $perencanaan)
    {
        return view('monitoring::perencanaan.edit', compact('perencanaan'));
    }

    public function update(Request $request, Perencanaan $perencanaan)
    {
        $request->validate([
            'nama' => 'required',
            'kode' => 'required|unique:perencanaans,kode,' . $perencanaan->id,
            'sumber' => 'required',
            'revisi' => 'required',
            'unit_id' => 'required'
        ]);

        $perencanaan->update($request->all());

        return redirect()->route('perencanaan.index')
            ->with('success', 'Perencanaan berhasil diperbarui.');
    }

    public function destroy(Perencanaan $perencanaan)
    {
        $perencanaan->delete();

        return redirect()->route('perencanaan.index')
            ->with('success', 'Perencanaan berhasil dihapus.');
    }
}
