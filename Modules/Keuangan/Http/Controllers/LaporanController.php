<?php

namespace Modules\Keuangan\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanExport;
use Illuminate\Support\Facades\Storage;
use PDF;

class LaporanController extends Controller
{
    public function index()
    {
        return view('keuangan::laporan.index');
    }

    public function generate_laporan(Request $request)
    {
        $subPerencanaans = json_decode($request->input('sub_perencanaans'), true);

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
        $pdf = PDF::loadView('keuangan::laporan.cetak_laporan', compact('subPerencanaans'));
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
            'date' => now()->format('d M Y'),
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

    public function destroy($id)
    {
        //
    }
}
