<?php

namespace Modules\KeuanganMPA\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\KeuanganMPA\Entities\Perencanaan;
use Modules\KeuanganMPA\Entities\Realisasi;
use Modules\KeuanganMPA\Entities\SubPerencanaan;
use Modules\KeuanganMPA\Entities\Unit;

class KeuanganTriwulanController extends Controller
{
    public function index(Request $request)
    {
        $unit = session('units');
        $triwulan = $request->input('triwulan', 1);
        $bulanAwal = ($triwulan - 1) * 3 + 1;
        $bulanAkhir = $bulanAwal + 2;

        $units = Unit::all();
        $data = [];

        if ($request->user()->role_aktif == 'admin') {
            $perencanaan = Perencanaan::with('subPerencanaan')
                ->whereHas('subPerencanaan', function ($query) use ($bulanAwal, $bulanAkhir) {
                    $query->whereBetween(\DB::raw('MONTH(rencana_mulai)'), [$bulanAwal, $bulanAkhir]);
                })->get();

            $realisasi = Realisasi::with('subPerencanaan')
                ->whereBetween(\DB::raw('MONTH(tanggal_pembayaran)'), [$bulanAwal, $bulanAkhir])
                ->get();
        } else {
            $perencanaan = Perencanaan::with('subPerencanaan.unit')
                ->whereHas('subPerencanaan', function ($query) use ($bulanAwal, $bulanAkhir, $unit) {
                    $query->whereBetween(\DB::raw('MONTH(rencana_mulai)'), [$bulanAwal, $bulanAkhir])
                        ->whereIn('unit_id', $unit);
                })->get();

            $realisasi = Realisasi::with('subPerencanaan.unit')
                ->whereHas('subPerencanaan', function ($query) use ($unit) {
                    $query->whereIn('unit_id', $unit);
                })
                ->whereBetween(\DB::raw('MONTH(tanggal_pembayaran)'), [$bulanAwal, $bulanAkhir])
                ->get();
        }

        // Inisialisasi array untuk menyimpan total per bulan
        $targetPerBulan = array_fill(1, 12, 0);
        $realisasiPerBulan = array_fill(1, 12, 0);

        // Hitung target per bulan dari data perencanaan dan subPerencanaan
        foreach ($perencanaan as $item) {
            foreach ($item->subPerencanaan as $sub) {
                $bulan = (int) date('m', strtotime($sub->rencana_mulai));
                $total = $sub->volume * $sub->harga_satuan;
                $targetPerBulan[$bulan] += $total;
            }
        }

        // Hitung realisasi per bulan dari data realisasi
        foreach ($realisasi as $item) {
            $bulan = (int) date('m', strtotime($item->tanggal_pembayaran));
            $realisasiPerBulan[$bulan] += $item->realisasi;
        }

        $currentMonth = date('m');

        $target = [];
        $realisasis = [];
        $persentasePerBulan = [];

        for ($i = $bulanAwal; $i <= $bulanAkhir; $i++) {
            $targetSum = 0;
            $realisasiSum = 0;

            for ($j = 1; $j <= $i; $j++) {
                $targetSum += $targetPerBulan[$j] ?? 0;
                $realisasiSum += $realisasiPerBulan[$j] ?? 0;
            }

            $target[] = $targetSum;
            $realisasis[] = $realisasiSum;

            if ($targetSum > 0) {
                $persentasePerBulan[$i] = ($realisasiSum / $targetSum) * 100;
            } else {
                $persentasePerBulan[$i] = 0;
            }
        }

        // hitung total pagu
        $total_pagu = $perencanaan->reduce(function ($carry, $item) {
            $carry += $item->subPerencanaan->sum(function ($sub) {
                return $sub->volume * $sub->harga_satuan;
            }) ?? 0; // Jika null, tambahkan 0
            return $carry;
        }, 0);

        // Hitung total rpd
        $total_perencanaan = $perencanaan->reduce(function ($carry, $item) {
            return $carry + $item->subPerencanaan->sum(function ($sub) {
                return $sub->volume * $sub->harga_satuan;
            });
        }, 0);

        // hitung total realisasi
        $total_realisasi = $realisasi->reduce(function ($carry, $item) {
            return $carry + $item->realisasi;
        }, 0);

        $persentase_realisasi = 0;
        $persentase_belum_direalisasi = 0;
        // Hitung persentase
        if ($total_pagu > 0) {
            $persentase_realisasi = ($total_realisasi / $total_pagu) * 100;
            $persentase_belum_direalisasi = 100 - $persentase_realisasi;
        }

        $persentase_rpd = 0;
        $persentase_sisa_rpd = 0;
        // Hitung persentase
        if ($total_perencanaan > 0) {
            $persentase_rpd = ($total_realisasi / $total_perencanaan) * 100;
            $persentase_sisa_rpd = 100 - $persentase_rpd;
        }

        // tabel terendah dan tertinggi
        $unitData = $this->unit_tabel();
        $topUnits = $unitData['topUnits'];
        $bottomUnits = $unitData['bottomUnits'];

        $namaBulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        $data = [
            $persentase_realisasi,
            $persentase_belum_direalisasi
        ];

        // dd($unitRealisasi);
        return view('keuanganmpa::index_triwulan', compact(
            'triwulan',
            'bulanAwal',
            'bulanAkhir',
            'perencanaan',
            'total_pagu',
            'total_perencanaan',
            'total_realisasi',
            'topUnits',
            'bottomUnits',
            'persentase_realisasi',
            'persentase_belum_direalisasi',
            'persentase_rpd',
            'persentase_sisa_rpd',
            'target',
            'realisasis',
            'persentasePerBulan',
            'namaBulan'
        ))->with('data', $data);
    }

    private function unit_tabel()
    {
        // Fetch data within the function
        $units = Unit::all();
        $perencanaan = Perencanaan::with('subPerencanaan.unit')->get();
        $realisasi = Realisasi::with('subPerencanaan.unit')->get();

        // Initialize unitRealisasi with all units
        $unitRealisasi = [];
        foreach ($units as $unit) {
            $unitRealisasi[$unit->id] = [
                'nama' => $unit->nama,
                'total_pagu' => 0,
                'total_perencanaan' => 0,
                'total_realisasi' => 0,
                'percentage' => 0
            ];
        }

        // Calculate total pagu per unit
        foreach ($perencanaan as $item) {
            $unit = $item->unit;
            if ($unit) {
                $unitId = $unit->id;
                $unitRealisasi[$unitId]['total_pagu'] += $item->subPerencanaan->sum(function ($sub) {
                    return $sub->volume * $sub->harga_satuan;
                });
            }
        }

        // Calculate total realisasi per unit
        foreach ($realisasi as $item) {
            $unit = $item->subPerencanaan->unit;
            if ($unit) {
                $unitId = $unit->id;
                $unitRealisasi[$unitId]['total_realisasi'] += $item->realisasi;
            }
        }

        // Calculate percentage for all units
        foreach ($unitRealisasi as &$unit) {
            if ($unit['total_perencanaan'] > 0) {
                $unit['percentage'] = ($unit['total_realisasi'] / $unit['total_perencanaan']) * 100;
            } else {
                $unit['percentage'] = 0;
            }
        }

        // Sort the units by total realisasi in descending order and get the top 5
        usort($unitRealisasi, function ($a, $b) {
            return $b['total_realisasi'] <=> $a['total_realisasi'];
        });
        $topUnits = array_slice($unitRealisasi, 0, 5);

        // Sort the units by total realisasi in ascending order and get the bottom 5
        usort($unitRealisasi, function ($a, $b) {
            return $a['total_realisasi'] <=> $b['total_realisasi'];
        });
        $bottomUnits = array_slice($unitRealisasi, 0, 5);

        return compact('topUnits', 'bottomUnits');
    }
}
