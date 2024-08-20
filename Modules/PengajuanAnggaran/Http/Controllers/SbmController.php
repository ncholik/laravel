<?php

namespace Modules\PengajuanAnggaran\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\PengajuanAnggaran\Entities\DetailSbm;
use Modules\PengajuanAnggaran\Entities\HistorySbm;
use Modules\PengajuanAnggaran\Entities\Sbm;

class SbmController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data['sbm'] = Sbm::with(['detail'])->get();

        return view('pengajuananggaran::sbm.sbm', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('pengajuananggaran::create');
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
    public function show($id)
    {
        $sbm = Sbm::with('detail')->find($id);
        $sbm->detail = $sbm->detail;
        return view('pengajuananggaran::sbm.detail_sbm', $sbm);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('pengajuananggaran::edit');
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

    public function modalEdit($id)
    {
        $detail = DetailSbm::find($id);
        return view('pengajuananggaran::sbm.edit_data_sbm', $detail);
    }

    public function storeDataSBM(Request $request, $id)
    {
        $data = $request->except('_token');
        $data['sbm_id'] = $id;

        DetailSbm::create($data);
        return redirect('/pengajuananggaran/sbm/' . $id)->with('success_message', 'Data added!');
    }

    public function editDataSbm(Request $request, $id)
    {
        $data = $request->except('_token');
        $detail = DetailSbm::find($id);

        $detail->update($data);
        return back()->with('success_message', 'Data updated!');
    }

    public function deleteDataSbm($id)
    {
        $data = DetailSbm::find($id);

        $data->delete();
        return back()->with('success_message', 'Data deleted!');
    }


    public function historySbm()
    {
        $data['time'] = HistorySbm::groupBy('updated_at')->pluck('updated_at');
        return view('pengajuananggaran::sbm.history_sbm', $data);
    }

    public function detailHistory($date)
    {
        $data['sbm'] = HistorySbm::where('created_at', $date)->orderBy('sbm_id')->get();
        $data['rowspan'] = HistorySbm::select('sbm_id', DB::raw('count(id) as count'))
            ->where('created_at', $date)
            ->groupBy('sbm_id')
            ->pluck('count', 'sbm_id');
        $data['date'] = $date;
        return view('pengajuananggaran::sbm.detail_history', $data);
    }

    public function saveSbm()
    {
        $data = DetailSbm::with('sbm')->get()->toArray();
        $time = date('Y-m-d H:i:s');
        $newData = array_map(function ($d) use ($time) {
            $temp = [];
            $temp['nama'] = $d['nama'];
            $temp['sbm_id'] = $d['sbm_id'];
            $temp['sbm_text'] = $d['sbm']['jenis_kegiatan'];
            $temp['jumlah_satuan'] = $d['jumlah_satuan'];
            $temp['satuan'] = $d['satuan'];
            $temp['harga_satuan'] = $d['harga_satuan'];
            $temp['keterangan'] = $d['keterangan'];
            $temp['created_at'] = $time;
            $temp['updated_at'] = $time;
            return $temp;
        }, $data);

        HistorySbm::insert($newData);
        return back()->with('success_message', 'Data saved!');
    }
}
