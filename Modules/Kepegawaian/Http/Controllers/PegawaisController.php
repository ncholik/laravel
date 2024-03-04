<?php

namespace Modules\Kepegawaian\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Modules\Kepegawaian\Entities\Pegawai;

class PegawaisController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $pegawai = Pegawai::where('nama', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $pegawai = Pegawai::latest()->paginate($perPage);
        }

        return view('kepegawaian::pegawai.index', compact('pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('kepegawaian::pegawai.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
			'nip' => 'required',
            'nama' => 'required'
		]);
        $requestData = $request->all();
        $requestData['nama']=strtoupper(strtolower($requestData['nama']));
        Pegawai::create($requestData);

        return redirect('/kepegawaian/pegawai')->with('success_message', 'JenisLuaran added!');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $pegawai = Pegawai::findOrFail($id);

        return view('kepegawaian::pegawai.show', compact('pegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);

        return view('kepegawaian::pegawai.edit', compact('pegawai'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'nip' => 'required',
            'nama' => 'required'
		]);
        $requestData = $request->all();
        
        $Pegawai = Pegawai::findOrFail($id);
        $Pegawai->update($requestData);

        return redirect('/kepegawaian/pegawai')->with('success_message', 'JenisLuaran updated!');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //JenisLuaran::destroy($id);

        return redirect('/kepegawaian/pegawai')->with('success_message', 'JenisLuaran deleted!');
    }
}
