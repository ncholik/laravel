<?php

namespace Modules\KeuanganMPA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubPerencanaan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    public function perencanaan()
    {
        return $this->belongsTo('Modules\KeuanganMPA\Entities\Perencanaan');
    }

    public function realisasi()
    {
        return $this->hasMany('Modules\KeuanganMPA\Entities\Realisasi');
    }

    public function pegawai()
    {
        return $this->belongsTo('Modules\Kepegawaian\Entities\Pegawai');
    }

    public function unit()
    {
        return $this->belongsTo('Modules\KeuanganMPA\Entities\Unit');
    }
}
