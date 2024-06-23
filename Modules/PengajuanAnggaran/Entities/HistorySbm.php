<?php

namespace Modules\PengajuanAnggaran\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HistorySbm extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'sbm_history';
}
