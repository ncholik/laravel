<?php

namespace Modules\Keuangan\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Keuangan\Entities\Perencanaan;
use Modules\Keuangan\Entities\Realisasi;

class RealisasiController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');

        if ($query) {
            $perencanaans = Perencanaan::with('subPerencanaan')
                ->where('nama', 'LIKE', "%{$query}%")
                ->orWhere('kode', 'LIKE', "%{$query}%")
                ->paginate(10);
        } else {
            $perencanaans = Perencanaan::with('subPerencanaan')->paginate(10);
        }

        foreach ($perencanaans as $perencanaan) {
            $perencanaan->jumlah_anggaran = $perencanaan->subPerencanaan->sum(function ($sub) {
                return $sub->volume * $sub->harga_satuan;
            });

            $perencanaan->realisasi_keuangan = $perencanaan->subPerencanaan->sum(function ($sub) {
                return $sub->realisasi->sum('realisasi');
            });
        }

        return view('keuangan::realisasi.index', compact('perencanaans'));
    }

    public function create()
    {
        return view('keuangan::realisasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'progres' => 'required|numeric',
            'realisasi' => 'required|numeric',
            'laporan_keuangan' => 'required|string',
            'laporan_kegiatan' => 'required|string',
            'ketercapaian_output' => 'required|string',
            'tanggal_kontrak' => 'required|date',
            'tanggal_pembayaran' => 'required|date',
            'sub_perencanaan_id' => 'required|exists:sub_perencanaans,id',
        ]);

        Realisasi::create($validated);

        return redirect()->route('keuangan::realisasi.index')->with('success', 'Realisasi berhasil ditambahkan.');
    }

    public function show($id)
    {
        $realisasi = Realisasi::all();
        $perencanaans = Perencanaan::with('subPerencanaan')->findOrFail($id);

        $filterBulan = $perencanaans->subPerencanaan->map(function ($sub) {
            return \Carbon\Carbon::parse($sub->rencana_bayar)->format('F');
        })->unique()->values();

        $jumlah_anggaran = $perencanaans->subPerencanaan->sum(function ($sub) {
            return $sub->volume * $sub->harga_satuan;
        });

        $realisasi_keuangan = $perencanaans->subPerencanaan->sum(function ($sub) {
            return $sub->realisasi->sum('realisasi');
        });

        $efisiensi = $jumlah_anggaran - $realisasi_keuangan;

        return view('keuangan::realisasi.show', compact('realisasi', 'perencanaans', 'filterBulan', 'jumlah_anggaran', 'realisasi_keuangan', 'efisiensi'));
    }

    public function getKegiatan($id)
    {
        $subPerencanaan = Perencanaan::with(['subPerencanaan' => function ($query) use ($id) {
            $query->where('id', $id);
        }])->firstOrFail()->subPerencanaan->first();

        $jumlah_anggaran = $subPerencanaan->volume * $subPerencanaan->harga_satuan;
        $realisasi_keuangan = $subPerencanaan->realisasi->sum('realisasi');
        $efisiensi = $jumlah_anggaran - $realisasi_keuangan;

        $data = [
            'jumlah_anggaran' => number_format($jumlah_anggaran, 2, ',', '.'),
            'realisasi_keuangan' => number_format($realisasi_keuangan, 2, ',', '.'),
            'efisiensi' => number_format($efisiensi, 2, ',', '.'),
            'anggaran_keuangan' => number_format($subPerencanaan->anggaran_keuangan, 2, ',', '.'),
            'progres' => $subPerencanaan->progres,
            'tanggal_pembayaran' => $subPerencanaan->tanggal_pembayaran->format('d-m-Y'),
            'laporan_keuangan' => $subPerencanaan->laporan_keuangan,
            'laporan_kegiatan' => $subPerencanaan->laporan_kegiatan,
            'ketercapaian_output' => $subPerencanaan->ketercapaian_output,
        ];

        return response()->json($data);
    }

    public function edit($id)
    {
        $perencanaan = Perencanaan::findOrFail($id);
        return view('keuangan::realisasi.edit', compact('perencanaan'));
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

        $perencanaan = Perencanaan::findOrFail($id);
        $perencanaan->update($validated);

        return redirect()->route('realisasi.index')->with('success', 'Realisasi berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $realisasi = Realisasi::findOrFail($id);
        $realisasi->delete();

        return redirect()->route('keuangan::realisasi.index')->with('success', 'Realisasi berhasil dihapus.');
    }
}
