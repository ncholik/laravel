<?php

namespace Modules\Keuangan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Realisasi extends Model
{
    use HasFactory;

    protected $primary = 'id';

    protected $fillable = [
        'progres', 'realisasi', 
        'laporan_keuangan', 
        'laporan_kegiatan',
        'ketercapaian_output', 
        'tanggal_kontrak', 
        'tanggal_pembayaran', 
        'sub_perencanaan_id'
    ];

    public function subPerencanaan()
    {
        return $this->belongsTo('Modules\Keuangan\Entities\SubPerencanaan');
    }
}
