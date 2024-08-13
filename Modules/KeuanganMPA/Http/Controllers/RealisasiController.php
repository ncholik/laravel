<?php

namespace Modules\KeuanganMPA\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\KeuanganMPA\Entities\Realisasi;
use Modules\KeuanganMPA\Entities\SubPerencanaan;
use Modules\KeuanganMPA\Entities\Unit;
use Illuminate\Validation\ValidationException;

class RealisasiController extends Controller
{
    public function index(Request $request)
    {
        $unit = session('units');
        
        $unitId = $request->input('unit_id');
        $sumber_dana = $request->input('sumber');
        $akun_belanja = $request->input('akun');
        $periode_anggaran = $request->input('periode');
        $tahun_anggaran = $request->input('tahun');

        $perencanaansQuery = SubPerencanaan::with(['unit', 'realisasi']);
        if ($unit) {
            // Jika user bukan admin, filter berdasarkan unit dari session
            $perencanaansQuery->whereHas('perencanaan', function ($query) use ($unit) {
                $query->where('unit_id', $unit->id);
            });
        }

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

        // if ($tahun_anggaran) {
        //     $perencanaansQuery->whereHas('perencanaan', function ($query) use ($tahun_anggaran) {
        //         $query->where('tahun', $tahun_anggaran);
        //     });
        // }

        $subPerencanaans = $perencanaansQuery->get()->map(function ($subPerencanaan) {
            if ($subPerencanaan->perencanaan) {
                $pagu = $subPerencanaan->volume * $subPerencanaan->harga_satuan;
                $realisasiTotal = $subPerencanaan->realisasi->sum('realisasi');
                $sisa = $pagu - $realisasiTotal;
                $persentase = $pagu > 0 ? ($realisasiTotal / $pagu) * 100 : 0;

                return [
                    'id' => $subPerencanaan->id,
                    'pic' => $subPerencanaan->unit ? $subPerencanaan->unit->nama : ' ',
                    'kode' => $subPerencanaan->perencanaan->kode,
                    'kegiatan' => $subPerencanaan->kegiatan,
                    'pagu' => $pagu,
                    'realisasi' => $realisasiTotal,
                    'sisa' => $sisa,
                    'persentase' => $persentase,
                ];
            }

            // Return a default value or handle cases where perencanaan is null
            return [
                'id' => $subPerencanaan->id,
                'pic' => ' ',
                'kode' => null,
                'kegiatan' => $subPerencanaan->kegiatan,
                'pagu' => 0,
                'realisasi' => 0,
                'sisa' => 0,
                'persentase' => 0,
            ];
        });

        $units = Unit::all();
        $sumber = ['BOPTN', 'PNBP', 'RM', 'Hibah'];
        $akun = ['Barang', 'Jasa Konsultasi', 'Operasional', 'Pekerjaan Kontruksi'];
        $tahun = range(date('Y'), date('Y') - 5);

        return view('keuanganmpa::realisasi.index', compact(
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

        $realisasi = new Realisasi();
        return view('keuanganmpa::realisasi.create', compact('subPerencanaanId', 'realisasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'progres' => 'required|string|in:Kontrak,Pembayaran,Selesai',
            'realisasi' => 'required|numeric|min:0',
            'laporan_keuangan' => 'required|file|mimes:pdf|max:5120',
            'laporan_kegiatan' => 'required|file|mimes:pdf|max:5120',
            'ketercapaian_output' => 'required|string|max:100',
            'tanggal_kontrak' => 'nullable|date',
            'tanggal_pembayaran' => 'nullable|date',
            'sub_perencanaan_id' => 'required|exists:sub_perencanaans,id',
        ]);

        // Ambil nilai pagu dari perencanaan terkait
        $subPerencanaan = SubPerencanaan::findOrFail($request->input('sub_perencanaan_id'));
        $pagu = $subPerencanaan->volume * $subPerencanaan->harga_satuan;

        // Validasi nilai realisasi tidak melebihi pagu
        if ($request->input('realisasi') > $pagu) {
            throw ValidationException::withMessages([
                'realisasi' => 'Nilai realisasi tidak boleh melebihi pagu perencanaan (' . $pagu . ')',
            ]);
        }

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

    public function show($id)
    {
        // Fetch the perencanaan data by ID
        $perencanaan = SubPerencanaan::with('realisasi')->findOrFail($id);

        // Calculate the required fields, e.g., pagu, periode_lalu, periode_ini, sd_periode, persentase, sisa
        $data = [];
        foreach ($perencanaan->realisasi as $realisasi) {
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

        return view('keuanganmpa::realisasi.show', compact('perencanaan', 'data'));
    }

    public function edit($id)
    {
        // Find the perencanaan by id
        $perencanaan = SubPerencanaan::findOrFail($id);

        // Find the related subPerencanaan
        $realisasi = $perencanaan->realisasi->first();

        if (!$realisasi) {
            // Handle case where there is no related realisasi
            return redirect()->back()->with('error', 'Realisasi not found.');
        }
        return view('keuanganmpa::realisasi.edit', compact('realisasi'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'progres' => 'required|string|max:20',
            'realisasi' => 'required|numeric|min:0',
            'laporan_keuangan' => 'file|mimes:pdf|max:5120',
            'laporan_kegiatan' => 'file|mimes:pdf|max:5120',
            'ketercapaian_output' => 'required|string|max:100',
            'tanggal_kontrak' => 'required|date',
            'tanggal_pembayaran' => 'required|date',
        ]);

        $realisasi = Realisasi::findOrFail($id);
        $subPerencanaan = $realisasi->subPerencanaan;
        $perencanaan = $subPerencanaan->perencanaan;
        $pagu = $perencanaan->pagu;

        if ($request->input('realisasi') > $pagu) {
            throw ValidationException::withMessages([
                'realisasi' => 'Nilai realisasi tidak boleh melebihi pagu perencanaan (' . $pagu . ')',
            ]);
        }

        $realisasi->update($validated);

        return redirect()->route('realisasi.index')->with('success', 'Realisasi berhasil diperbarui.');
    }
}
