<?php

namespace Modules\KeuanganMPA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{
    use HasFactory;

    protected $primary = 'id';

    public function pegawais()
    {
        return $this->hasMany('Modules\Kepegawaian\Entities\Pegawai');
    }
}
