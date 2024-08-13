<?php

namespace Modules\KeuanganMPA\Http\Controllers;

use App\Exports\LaporanExport;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class LaporanController extends Controller
{
    public function index()
    {
        return view('keuanganmpa::laporan.index');
    }

    public function cetakPDF(Request $request)
    {
        $subPerencanaans = json_decode($request->input('sub_perencanaans'), true);

        $totalPagu = 0;
        $totalRealisasi = 0;
        $totalSisa = 0;

        foreach ($subPerencanaans as $item) {
            $totalPagu += $item['pagu'];
            $totalRealisasi += $item['realisasi'];
            $totalSisa += $item['sisa'];
        }

        $totalPersentase = ($totalPagu > 0) ? ($totalRealisasi / $totalPagu) * 100 : 0;

        // Siapkan data untuk dikirim ke view
        $totals = [
            'totalPagu' => $totalPagu,
            'totalRealisasi' => $totalRealisasi,
            'totalSisa' => $totalSisa,
            'totalPersentase' => $totalPersentase,
        ];

        $pdf = PDF::loadView('keuanganmpa::laporan.cetak_laporan', compact('subPerencanaans', 'totals'));
        $pdfDirectory = 'laporan-realisasi/pdf';
        $pdfFileName = 'laporan_realisasi_TA_' . now()->format('Ymd_His') . '.pdf';
        $pdfPath = $pdfDirectory . '/' . $pdfFileName;
        Storage::put('public/' . $pdfPath, $pdf->output());

        $pdfUrl = Storage::url($pdfPath);

        return response()->json(['pdf_url' => $pdfUrl]);
    }

    public function cetakExcel(Request $request)
    {
        $subPerencanaans = json_decode($request->input('sub_perencanaans'), true);

        // Pastikan untuk menyediakan subPerencanaans sebagai array
        if (!is_array($subPerencanaans)) {
            $subPerencanaans = [];
        }

        // Ekspor data sebagai file Excel
        return Excel::download(new LaporanExport($subPerencanaans), 'laporan_realisasi_TA_' . now()->format('Ymd_His') . '.xlsx');
    }

    public function generate_laporan(Request $request)
    {
        $subPerencanaans = json_decode($request->input('sub_perencanaans'), true);

        $totalPagu = 0;
        $totalRealisasi = 0;
        $totalSisa = 0;

        foreach ($subPerencanaans as $item) {
            $totalPagu += $item['pagu'];
            $totalRealisasi += $item['realisasi'];
            $totalSisa += $item['sisa'];
        }

        $totalPersentase = ($totalPagu > 0) ? ($totalRealisasi / $totalPagu) * 100 : 0;

        // Siapkan data untuk dikirim ke view
        $totals = [
            'totalPagu' => $totalPagu,
            'totalRealisasi' => $totalRealisasi,
            'totalSisa' => $totalSisa,
            'totalPersentase' => $totalPersentase,
        ];

        // Pastikan direktori ada
        $pdfDirectory = 'laporan-realisasi/pdf';
        $excelDirectory = 'laporan-realisasi/excel';

        if (!is_dir($pdfDirectory)) {
            mkdir($pdfDirectory, 0755, true);
        }

        if (!is_dir($excelDirectory)) {
            mkdir($excelDirectory, 0755, true);
        }

        // Generate PDF
        $pdf = PDF::loadView('keuanganmpa::laporan.cetak_laporan', compact('subPerencanaans', 'totals'));
        $pdfFileName = 'laporan_realisasi_TA_' . now()->format('Ymd_His') . '.pdf';
        $pdfPath = $pdfDirectory . '/' . $pdfFileName;
        Storage::put('public/' . $pdfPath, $pdf->output());

        // Generate Excel
        $excelFileName = 'laporan_realisasi_TA_' . now()->format('Ymd_His') . '.xlsx';
        $excelPath = $excelDirectory . '/' . $excelFileName;
        Excel::store(new LaporanExport($subPerencanaans), $excelPath, 'public');

        $laporan = session()->get('laporan', []);
        $laporan[] = [
            'name' => 'laporan_realisasi_TA_' . now()->format('Ymd_His'),
            'pdf_path' => Storage::url($pdfPath),
            'excel_path' => Storage::url($excelPath),
            'date' => now()->format('d M Y H:i:s'),
        ];
        session()->put('laporan', $laporan);

        return back()->with('success', 'Laporan berhasil dicetak');
    }

    public function show_pdf($filename)
    {
        $path = storage_path('app/public/laporan-realisasi/pdf/' . $filename);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }

    public function reset()
    {
        $laporan = session('laporan', []);

        // Delete files from storage
        foreach ($laporan as $item) {
            $pdfPath = 'public/' . str_replace(url('storage/'), '', $item['pdf_path']);
            $excelPath = 'public/' . str_replace(url('storage/'), '', $item['excel_path']);

            if (Storage::exists($pdfPath)) {
                Storage::delete($pdfPath);
            }

            if (Storage::exists($excelPath)) {
                Storage::delete($excelPath);
            }
        }

        // Clear the session
        session()->forget('laporan');

        return back()->with('success', 'Semua laporan telah direset.');
    }
}
