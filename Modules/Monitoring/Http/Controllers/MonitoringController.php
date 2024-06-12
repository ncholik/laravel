<?php

namespace Modules\Monitoring\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Monitoring\Entities\Perencanaan;
use Modules\Monitoring\Entities\Realisasi;
use Modules\Monitoring\Entities\SubPerencanaan;
use Modules\Monitoring\Entities\Unit;

class MonitoringController extends Controller
{
    public function index()
    {
        $jumlahPerencanaan = Perencanaan::count();
        $jumlahSubPerencanaan = SubPerencanaan::count();
        $perencanaan = Perencanaan::with('subPerencanaan')->get();
        $realisasi = Realisasi::with('subPerencanaan.perencanaan.unit')->get();
        $units = Unit::all();
        $data = [];

        // Hitung total perencanaan
        $total_perencanaan = $perencanaan->reduce(function ($carry, $item) {
            return $carry + $item->subPerencanaan->sum(function ($sub) {
                return $sub->volume * $sub->harga_satuan;
            });
        }, 0);

        // hitung total realisasi
        $total_realisasi = 0;
        foreach ($realisasi as $item) {
            $total_realisasi += $item->realisasi;
        }

        // Hitung persentase
        if ($total_perencanaan > 0) {
            $persentase_realisasi = ($total_realisasi / $total_perencanaan) * 100;
            $persentase_belum_direalisasi = 100 - $persentase_realisasi;
        } else {
            $persentase_realisasi = 0;
            $persentase_belum_direalisasi = 0;
        }

        // Inisialisasi unitRealisasi dengan semua unit
        $unitRealisasi = [];
        foreach ($units as $unit) {
            $unitRealisasi[$unit->id] = [
                'nama' => $unit->nama,
                'total_realisasi' => 0,
                'percentage' => 0
            ];
        }

        // Hitung total realisasi per unit
        foreach ($realisasi as $item) {
            $unit = $item->subPerencanaan->perencanaan->unit;
            if ($unit) {
                $unitId = $unit->id;
                $unitRealisasi[$unitId]['total_realisasi'] += $item->realisasi;
            }
        }

        // Hitung persentase untuk semua unit
        foreach ($unitRealisasi as &$unit) {
            if ($total_perencanaan > 0) {
                $unit['percentage'] = ($unit['total_realisasi'] / $total_perencanaan) * 100;
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

        $data = [
            $persentase_realisasi,
            $persentase_belum_direalisasi
        ];

        // dd($unitRealisasi);
        return view('monitoring::index', compact(
            'perencanaan',
            'total_perencanaan',
            'total_realisasi',
            'topUnits',
            'bottomUnits',
            'jumlahPerencanaan',
            'jumlahSubPerencanaan'
        ))->with('data', $data);
    }

    public function getDataSerapan()
    {
        $subPerencanaan = SubPerencanaan::all();
        $realisasi = Realisasi::all();

        // Initialize arrays for storing the data
        $target = [];
        $realisasi = [];


        foreach ($subPerencanaan as $sub) {
            $target += $sub->volume * $sub->harga_satuan;
        }

        foreach ($realisasi as $realisasi) {
            $realisasi += $realisasi->realisasi;
        }

        return response()->json([
            'targets' => $target,
            'realisasi' => $realisasi
        ]);
    }
}
