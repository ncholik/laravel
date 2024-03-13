<?php

namespace Modules\Kepegawaian\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pegawai extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $guarded = ['id'];
    
    protected static function newFactory()
    {
        return \Modules\Kepegawaian\Database\factories\PegawaiFactory::new();
    }
}
