<?php

namespace Modules\PengajuanAnggaran\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailSbm extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'sbm_detail';

    public function sbm()
    {
        return $this->belongsTo(Sbm::class, 'sbm_id', 'id');
    }
}
