<?php

namespace Modules\PengajuanAnggaran\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class dataIKU extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'iku_data';
    protected $guarded = ['id'];

    public function iku()
    {
        return $this->belongsTo(Iku::class, 'iku_id');
    }
}
