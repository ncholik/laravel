<?php

namespace Modules\Keuangan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubPerencanaan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    public function perencanaan()
    {
        return $this->belongsTo('Modules\Keuangan\Entities\Perencanaan');
    }

    public function realisasi()
    {
        return $this->hasMany('Modules\Keuangan\Entities\Realisasi');
    }

    public function pegawai()
    {
        return $this->belongsTo('Modules\Kepegawaian\Entities\Pegawai');
    }
}
