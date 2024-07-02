<?php

namespace Modules\PengajuanAnggaran\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AkunDetailRab extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'rab_akun_detail';

    public function detailRab()
    {
        return $this->belongsTo(DetailRab::class, 'rab_detail_id');
    }
}
