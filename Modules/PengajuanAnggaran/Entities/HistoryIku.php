<?php

namespace Modules\PengajuanAnggaran\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HistoryIku extends Model
{
    use HasFactory;
    protected $table = 'history_iku';
    protected $guarded = [];
}
