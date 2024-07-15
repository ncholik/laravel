<?php

namespace Modules\Keuangan\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Keuangan\Entities\Perencanaan;
use Modules\Keuangan\Entities\Realisasi;
use Modules\Keuangan\Entities\SubPerencanaan;
use Modules\Keuangan\Entities\Unit;

class RealisasiController extends Controller
{
    public function index(Request $request)
    {
        $unitId = $request->input('unit_id');
        $sumber_dana = $request->input('sumber');
        $akun_belanja = $request->input('akun');
        $periode_anggaran = $request->input('periode');
        $tahun_anggaran = $request->input('tahun');

        $perencanaansQuery = SubPerencanaan::with(['perencanaan.unit', 'realisasi']);

        if ($unitId) {
            $perencanaansQuery->whereHas('perencanaan', function ($query) use ($unitId) {
                $query->where('unit_id', $unitId);
            });
        }

        if ($sumber_dana) {
            $perencanaansQuery->whereHas('perencanaan', function ($query) use ($sumber_dana) {
                $query->where('sumber', $sumber_dana);
            });
        }

        if ($akun_belanja) {
            $perencanaansQuery->where('jenis', $akun_belanja);
        }

        if ($periode_anggaran) {
            $perencanaansQuery->whereMonth('rencana_bayar', '>=', 1)->whereMonth('rencana_bayar', '<=', $periode_anggaran);
        }

        if ($tahun_anggaran) {
            $perencanaansQuery->whereHas('perencanaan', function ($query) use ($tahun_anggaran) {
                $query->where('tahun', $tahun_anggaran);
            });
        }

        $subPerencanaans = $perencanaansQuery->get()->map(function ($subPerencanaan) {
            $pagu = $subPerencanaan->perencanaan->pagu;
            $realisasiTotal = $subPerencanaan->realisasi->sum('realisasi');
            $sisa = $pagu - $realisasiTotal;
            $persentase = $pagu > 0 ? ($realisasiTotal / $pagu) * 100 : 0;

            return [
                'id' => $subPerencanaan->id,
                'pic' => $subPerencanaan->perencanaan->unit->nama,
                'kode' => $subPerencanaan->perencanaan->kode,
                'kegiatan' => $subPerencanaan->kegiatan,
                'pagu' => $pagu,
                'realisasi' => $realisasiTotal,
                'sisa' => $sisa,
                'persentase' => $persentase,
            ];
        });

        $units = Unit::all();
        $sumber = ['BOPTN', 'PNBP', 'RM', 'Hibah'];
        $akun = ['Barang', 'Jasa Konsultasi', 'Operasional', 'Pekerjaan Kontruksi'];
        $tahun = range(date('Y'), date('Y') - 5);

        return view('keuangan::realisasi.index', compact(
            'subPerencanaans',
            'units',
            'sumber',
            'akun',
            'tahun',
            'unitId',
            'sumber_dana',
            'akun_belanja',
            'periode_anggaran',
            'tahun_anggaran'
        ));
    }

    public function create(Request $request)
    {
        $subPerencanaanId = $request->input('sub_perencanaan_id');
        return view('keuangan::realisasi.create', compact('subPerencanaanId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'progres' => 'required|numeric',
            'realisasi' => 'required|numeric',
            'laporan_keuangan' => 'required|file|mimes:pdf|max:5120',
            'laporan_kegiatan' => 'required|file|mimes:pdf|max:5120',
            'ketercapaian_output' => 'required|string',
            'tanggal_kontrak' => 'required|date',
            'tanggal_pembayaran' => 'required|date',
            'sub_perencanaan_id' => 'required|exists:sub_perencanaans,id',
        ]);

        $data = $request->all();

        if ($request->hasFile('laporan_keuangan')) {
            $file = $request->file('laporan_keuangan');
            $path = $file->storeAs('laporan-keuangan', $file->getClientOriginalName(), 'public');
            $data['laporan_keuangan'] = $path;
        }

        if ($request->hasFile('laporan_kegiatan')) {
            $file = $request->file('laporan_kegiatan');
            $path = $file->storeAs('laporan-kegiatan', $file->getClientOriginalName(), 'public');
            $data['laporan_kegiatan'] = $path;
        }

        Realisasi::create($data);

        return redirect()->route('realisasi.index')->with('success', 'Realisasi berhasil ditambahkan.');
    }

    // Controller Method
    public function show($id)
    {
        // Fetch the perencanaan data by ID
        $perencanaan = Perencanaan::with('subPerencanaan.realisasi')->findOrFail($id);

        // Calculate the required fields, e.g., pagu, periode_lalu, periode_ini, sd_periode, persentase, sisa
        $data = [];
        foreach ($perencanaan->subPerencanaan as $sub) {
            foreach ($sub->realisasi as $realisasi) {
                $data[] = [
                    'progres' => $realisasi->progres,
                    'realisasi' => $realisasi->realisasi,
                    'laporan_keuangan' => $realisasi->laporan_keuangan,
                    'laporan_kegiatan' => $realisasi->laporan_kegiatan,
                    'ketercapaian_output' => $realisasi->ketercapaian_output,
                    'tanggal_kontrak' => $realisasi->tanggal_kontrak,
                    'tanggal_pembayaran' => $realisasi->tanggal_pembayaran,
                ];
            }
        }

        return view('keuangan::realisasi.show', compact('perencanaan', 'data'));
    }


    public function edit($id)
    {
        // Find the perencanaan by id
        $perencanaan = Perencanaan::findOrFail($id);

        // Find the related subPerencanaan
        $subPerencanaan = $perencanaan->subPerencanaans->first();

        // Find the related realisasi through subPerencanaan
        $realisasi = $subPerencanaan ? $subPerencanaan->realisasi : null;

        if (!$realisasi) {
            // Handle case where there is no related realisasi
            return redirect()->back()->with('error', 'Realisasi not found.');
        }
        return view('keuangan::realisasi.edit', compact('realisasi'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'progres' => 'required|numeric',
            'realisasi' => 'required|numeric',
            'laporan_keuangan' => 'required|string',
            'laporan_kegiatan' => 'required|string',
            'ketercapaian_output' => 'required|string',
            'tanggal_kontrak' => 'required|date',
            'tanggal_pembayaran' => 'required|date',
        ]);

        $realisasi = Realisasi::findOrFail($id);
        $realisasi->update($validated);

        return redirect()->back()->with('success', 'Realisasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $realisasi = Realisasi::findOrFail($id);
        $realisasi->delete();

        return response()->json(['success' => 'Realisasi berhasil dihapus.']);
    }
}
