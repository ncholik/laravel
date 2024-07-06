<?php

namespace Modules\PengajuanAnggaran\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rab extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'rab';

    public function detail()
    {
        return $this->hasMany(DetailRab::class, 'rab_id');
    }
}
