<?php

namespace Modules\PengajuanAnggaran\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailRab extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'rab_detail';

    public function rab()
    {
        return $this->belongsTo(Rab::class, 'rab_id');
    }

    public function akunDetail()
    {
        return $this->hasMany(AkunDetailRab::class, 'rab_detail_id');
    }
}
