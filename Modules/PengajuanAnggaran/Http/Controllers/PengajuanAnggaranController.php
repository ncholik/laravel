<?php

namespace Modules\PengajuanAnggaran\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\PengajuanAnggaran\Entities\AkunDetailRab;
use Modules\PengajuanAnggaran\Entities\dataIKU;
use Modules\PengajuanAnggaran\Entities\DetailRab;
use Modules\PengajuanAnggaran\Entities\DetailSbm;
use Modules\PengajuanAnggaran\Entities\Iku;
use Modules\PengajuanAnggaran\Entities\Rab;
use Modules\PengajuanAnggaran\Entities\Sbm;

class PengajuanAnggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data['rab'] = Rab::get();
        return view('pengajuananggaran::rab.rab', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('pengajuananggaran::rab.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        Rab::create($data);

        return redirect(route('pengajuan.index'))->with('success_message', 'Data saved!');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $data['rab'] = Rab::with(['detail', 'detail.akunDetail'])->find($id);
        return view('pengajuananggaran::rab.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $rab = Rab::find($id);
        return view('pengajuananggaran::rab.edit', $rab);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $rab = Rab::find($id);

        $rab->update($request->except('_token', '_method'));
        return redirect(route('pengajuan.index'))->with('success_message', 'Data saved!');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $rab = Rab::find($id);
        $rab->delete();

        return back();
    }


    public function createDetail($id)
    {
        $data['rab'] = Rab::find($id);
        $data['iku'] = Iku::with(['dataIku'])->get();
        $data['detail_sbm'] = DetailSbm::with(['sbm'])->orderBy('sbm_id')->get();
        $data['sbm'] = Sbm::with(['detail'])->get();
        return view('pengajuananggaran::rab.create_detail_rab', $data);
    }

    public function storeDetail(Request $request, $id)
    {
        $request->validate([
            'aktivitas' => 'required',
            'lokasi' => 'required',
            'penyedia' => 'required',
            'durasi' => 'required',
            'bukti_file' => 'required|file|max:max:2480',
            'nama_peserta' => 'required',
            'iku' => 'required',
            'akun' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $newDetail = new DetailRab;
            $newDetail->rab_id = $id;
            $newDetail->aktivitas = $request->aktivitas;
            $newDetail->lokasi = $request->lokasi;
            $newDetail->penyedia = $request->penyedia;
            $newDetail->durasi = $request->durasi;
            $newDetail->nama_peserta = $request->nama_peserta;
            $iku = explode('|', $request->iku);
            $newDetail->iku_id = $iku[0];
            $newDetail->iku_text = $iku[1];

            if ($request->bukti_file) {
                if ($request->file('bukti_file')) {
                    $file = $request->file('bukti_file');
                    $file_name = 'bukti_' . strtotime(now()) . '.' . $file->getClientOriginalExtension();
                    $folder = "bukti_file/";
                    $file->storeAs($folder, $file_name, ['disk' => 'public']);
                    $newDetail->bukti  = $file_name;
                }
            }
            if ($newDetail->save()) {
                $idDetail = $newDetail->id;
                $time = date('Y-m-d H:i:s');
                $res = [];
                foreach (json_decode($request->akun) as $akun) {
                    foreach ($akun->data as $d) {
                        $temp = [];
                        $temp['rab_detail_id'] = $idDetail;
                        $temp['sbm_id'] = $d->modal_sbm_id;
                        $temp['sbm_text'] = $d->modal_sbm_text;
                        $temp['sbm_detail_id'] = $d->modal_sbm_detail_id;
                        $temp['sbm_detail_text'] = $d->modal_sbm_detail_text;
                        $temp['jumlah'] = $d->modal_jumlah;
                        $temp['jumlah_satuan'] = $d->modal_jumlah_satuan;
                        $temp['jam'] = $d->modal_jam;
                        $temp['jam_satuan'] = $d->modal_jam_satuan;
                        $temp['frek'] = $d->modal_frek;
                        $temp['frek_satuan'] = $d->modal_frek_satuan;
                        $temp['total'] = $d->modal_total;
                        $temp['total_satuan'] = $d->modal_total_satuan;
                        $temp['harga_satuan'] = $d->modal_harga_satuan;
                        $temp['created_at'] = $time;
                        $temp['updated_at'] = $time;
                        $res[] = $temp;
                    }
                }
                if (AkunDetailRab::insert($res)) {
                    DB::commit();
                    return redirect(route('pengajuan.show', ['pengajuan' => $id]))->with('message', 'Berhasil Menambah Akun');
                }
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            // dd($th->getTrace());
            return back()->withErrors(['message' => $th->getMessage()]);
        }
    }

    public function editDetail($id)
    {
        $data['detail'] = DetailRab::with(['akunDetail'])->find($id);


        $data['rab'] = Rab::find($id);
        $data['iku'] = Iku::with(['dataIku'])->get();
        $data['detail_sbm'] = DetailSbm::with(['sbm'])->orderBy('sbm_id')->get();
        $data['sbm'] = Sbm::with(['detail'])->get();

        return view('pengajuananggaran::rab.edit_detail_rab', $data);
    }

    public function updateDetail(Request $request, $id)
    {
        $request->validate([
            'aktivitas' => 'required',
            'lokasi' => 'required',
            'penyedia' => 'required',
            'durasi' => 'required',
            'bukti_file' => 'nullable|file|max:max:2480',
            'nama_peserta' => 'required',
            'iku' => 'required',
            'akun' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $newDetail = DetailRab::find($id);
            $newDetail->aktivitas = $request->aktivitas;
            $newDetail->lokasi = $request->lokasi;
            $newDetail->penyedia = $request->penyedia;
            $newDetail->durasi = $request->durasi;
            $newDetail->nama_peserta = $request->nama_peserta;
            $iku = explode('|', $request->iku);
            $newDetail->iku_id = $iku[0];
            $newDetail->iku_text = $iku[1];

            if ($request->bukti_file) {
                if ($request->file('bukti_file')) {
                    $file = $request->file('bukti_file');
                    $file_name = 'bukti_' . strtotime(now()) . '.' . $file->getClientOriginalExtension();
                    $folder = "bukti_file/";
                    $file->storeAs($folder, $file_name, ['disk' => 'public']);
                    $newDetail->bukti  = $file_name;
                }
            }

            if ($newDetail->save()) {
                $newDetail->akunDetail()->delete();
                $time = date('Y-m-d H:i:s');
                $res = [];
                foreach (json_decode($request->akun) as $akun) {
                    foreach ($akun->data as $d) {
                        $temp = [];
                        $temp['rab_detail_id'] = $id;
                        $temp['sbm_id'] = $d->modal_sbm_id;
                        $temp['sbm_text'] = $d->modal_sbm_text;
                        $temp['sbm_detail_id'] = $d->modal_sbm_detail_id;
                        $temp['sbm_detail_text'] = $d->modal_sbm_detail_text;
                        $temp['jumlah'] = $d->modal_jumlah;
                        $temp['jumlah_satuan'] = $d->modal_jumlah_satuan;
                        $temp['jam'] = $d->modal_jam;
                        $temp['jam_satuan'] = $d->modal_jam_satuan;
                        $temp['frek'] = $d->modal_frek;
                        $temp['frek_satuan'] = $d->modal_frek_satuan;
                        $temp['total'] = $d->modal_total;
                        $temp['total_satuan'] = $d->modal_total_satuan;
                        $temp['harga_satuan'] = $d->modal_harga_satuan;
                        $temp['created_at'] = $time;
                        $temp['updated_at'] = $time;
                        $res[] = $temp;
                    }
                }
                if (AkunDetailRab::insert($res)) {
                    DB::commit();
                    return redirect(route('pengajuan.show', ['pengajuan' => $newDetail->rab_id]))->with('message', 'Berhasil Mengubah Akun');
                }
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            // dd($th->getTrace());
            return back()->withErrors(['message' => $th->getMessage()]);
        }
    }

    public function deleteDetail($id)
    {
        $detail = DetailRab::find($id);
        $idRab = $detail->rab_id;
        $detail->delete();

        return redirect(route('pengajuan.show', ['pengajuan' => $idRab]))->with('message', 'Berhasil Menghapus Akun');
    }

    public function approveRab(Request $request, $id)
    {
        $rab = Rab::find($id);
        $rab->status = $request->status;

        $rab->save();
        $status = ucfirst($request->status);
        return redirect(route('pengajuan.show', ['pengajuan' => $id]))->with('message', "Berhasil $status RAB");
    }
}
