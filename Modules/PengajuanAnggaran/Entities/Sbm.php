<?php

namespace Modules\PengajuanAnggaran\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sbm extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'sbm';

    public function detail()
    {
        return $this->hasMany(DetailSbm::class, 'sbm_id', 'id');
    }
}
