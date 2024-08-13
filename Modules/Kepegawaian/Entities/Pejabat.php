<?php

namespace Modules\Kepegawaian\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pejabat extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $primary = 'id';

    protected $fillable = [
        'jabatan',
        'mulai',
        'selesai',
        'SK',
        'pegawai_id',
        'unit_id',
        'status',
    ];

    public function pegawai()
    {
        return $this->belongsTo('Modules\Kepegawaian\Entities\Pegawai');
    }

    public function unit()
    {
        return $this->belongsTo('Modules\Keuangan\Entities\Unit');
    }
}
