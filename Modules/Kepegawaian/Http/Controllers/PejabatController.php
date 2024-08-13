<?php

namespace Modules\Kepegawaian\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Kepegawaian\Entities\Pegawai;
use Modules\Kepegawaian\Entities\Pejabat;
use Modules\KeuanganMPA\Entities\Unit;

class PejabatController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        //$user = \Auth::user();
        //dd($user);
        $perPage = 25;

        if (!empty($keyword)) {
            $pejabat = Pejabat::where('jabatan', 'LIKE', "%$keyword%")
                ->orderBy('id', 'asc')->paginate($perPage);
        } else {
            $pejabat = Pejabat::orderBy('id', 'asc')->paginate($perPage);
        }

        return view('kepegawaian::pejabat.index', compact('pejabat'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $pegawais = Pegawai::all();
        $units = Unit::all();
        return view('kepegawaian::pejabat.create', compact('pegawais', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'jabatan' => 'required|string|max:255',
            'mulai' => 'required|date',
            'selesai' => 'nullable|date|after_or_equal:mulai',
            'SK' => 'nullable|string|max:150',
            'pegawai_id' => 'required|exists:pegawais,id',
            'unit_id' => 'nullable|exists:units,id',
            'status' => 'required|in:Aktif,Non Aktif',
        ]);

        // Create new Pejabat
        $pejabat = new Pejabat([
            'jabatan' => $request->input('jabatan'),
            'mulai' => $request->input('mulai'),
            'selesai' => $request->input('selesai'),
            'SK' => $request->input('SK'),
            'pegawai_id' => $request->input('pegawai_id'),
            'unit_id' => $request->input('unit_id'),
            'status' => $request->input('status'),
        ]);

        // Save Pejabat to the database
        $pejabat->save();

        // Redirect with success message
        return redirect()->route('pejabat.index')->with('success', 'Pejabat berhasil ditambahkan.');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $pejabat = Pejabat::findOrFail($id);

        return view('kepegawaian::pejabat.show', compact('pejabat'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $pejabat = Pejabat::findOrFail($id);
        $pegawais = Pegawai::all();
        $units = Unit::all();

        return view('kepegawaian::pejabat.edit', compact('pejabat', 'pegawais', 'units'));
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
