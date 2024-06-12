<?php

namespace Modules\Monitoring\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubPerencanaan extends Model
{
    use HasFactory;

    protected $table = 'sub_perencanaans';
    protected $primary = 'id';

    protected $fillable = [
        'kegiatan',
        'metode_pengadaan',
        'satuan',
        'volume',
        'harga_satuan',
        'output',
        'rencana_mulai',
        'rencana_bayar',
        'file_hps',
        'file_kak',
        'pic_id',
        'ppk_id',
        'pp_id',
        'jenis',
        'perencanaan_id'
    ];

    public function perencanaan()
    {
        return $this->belongsTo('Modules\Monitoring\Entities\Perencanaan');
    }

    public function realisasi()
    {
        return $this->hasMany('Modules\Monitoring\Entities\Realisasi');
    }
}
