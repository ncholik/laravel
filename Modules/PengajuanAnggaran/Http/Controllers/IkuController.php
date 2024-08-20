<?php

namespace Modules\PengajuanAnggaran\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\PengajuanAnggaran\Entities\dataIKU;
use Modules\PengajuanAnggaran\Entities\HistoryIku;
use Modules\PengajuanAnggaran\Entities\Iku;

class IkuController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data['iku'] = Iku::with(['dataIku'])->get();
        return view('pengajuananggaran::iku.iku', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('kepegawaian::create');
    }



    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $iku = Iku::with('dataIku')->find($id);
        $iku->dataIku = $iku->dataIku;
        return view('pengajuananggaran::iku.detail_iku', $iku);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('kepegawaian::edit');
    }



    public function modalEdit($id)
    {
        $dataIku = dataIKU::find($id);
        return view('pengajuananggaran::iku.edit_data_iku', $dataIku);
    }

    public function storeDataIku(Request $request, $id)
    {
        $data = $request->except('_token');
        $data['iku_id'] = $id;

        dataIKU::create($data);
        return redirect('/pengajuananggaran/iku/' . $id)->with('success_message', 'Data added!');
    }

    public function editDataIku(Request $request, $id)
    {
        $data = $request->except('_token');
        $dataIku = dataIKU::find($id);

        $dataIku->update($data);
        return back()->with('success_message', 'Data updated!');
    }

    public function deleteDataIku($id)
    {
        $data = dataIKU::find($id);

        $data->delete();
        return back()->with('success_message', 'Data deleted!');
    }


    public function historyIku()
    {
        $data['time'] = HistoryIku::groupBy('updated_at')->pluck('updated_at');
        return view('pengajuananggaran::iku.history_iku', $data);
    }

    public function detailHistory($date)
    {
        $data['iku'] = HistoryIku::where('created_at', $date)->orderBy('iku_id')->get();
        $data['rowspan'] = HistoryIku::select('iku_id', DB::raw('count(id) as count'))
            ->where('created_at', $date)
            ->groupBy('iku_id')
            ->pluck('count', 'iku_id');
        $data['date'] = $date;
        return view('pengajuananggaran::iku.detail_history', $data);
    }

    public function saveIku()
    {
        $data = dataIKU::with('iku')->get()->toArray();
        $time = date('Y-m-d H:i:s');
        $newData = array_map(function ($d) use ($time) {
            $temp = [];
            $temp['iku_id'] = $d['iku_id'];
            $temp['iku_text'] = $d['iku']['sasaran_kinerja'];
            $temp['indikator'] = $d['indikator'];
            $temp['target'] = $d['target'];
            $temp['created_at'] = $time;
            $temp['updated_at'] = $time;
            return $temp;
        }, $data);

        HistoryIku::insert($newData);
        return back()->with('success_message', 'Data saved!');
    }
}
