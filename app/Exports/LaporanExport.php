<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\Keuangan\Entities\SubPerencanaan as EntitiesSubPerencanaan;

class LaporanExport implements FromArray, WithHeadings
{
    protected $subPerencanaans;

    public function __construct(array $subPerencanaans)
    {
        $this->subPerencanaans = $subPerencanaans;
    }

    public function array(): array
    {
        $data = [];
        
        foreach ($this->subPerencanaans as $subPerencanaan) {
            $data[] = [
                'PIC' => $subPerencanaan['pic'],
                'Uraian' => $subPerencanaan['kode'] . ' ' . $subPerencanaan['kegiatan'],
                'Pagu' => $subPerencanaan['pagu'],
                'Realisasi' => $subPerencanaan['realisasi'],
                'Sisa' => $subPerencanaan['sisa'],
                'Persentase' => $subPerencanaan['persentase'], 
            ];
        }

        return $data;
    }

    public function headings(): array
    {
        return [
            'PIC',
            'Uraian',
            'Pagu',
            'Realisasi',
            'Sisa',
            'Persentase',
        ];
    }
}