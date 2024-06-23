<?php

namespace Modules\PengajuanAnggaran\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Iku extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'iku';
    protected $guarded = ['id'];

    public function dataIku()
    {
        return $this->hasMany(dataIKU::class, 'iku_id', 'id');
    }
}
