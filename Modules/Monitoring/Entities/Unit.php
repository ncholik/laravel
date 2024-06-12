<?php

namespace Modules\Monitoring\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{
    use HasFactory;

    protected $primary = 'id';
    
    // protected static function newFactory()
    // {
    //     return \Modules\Monitoring\Database\factories\UnitFactory::new();
    // }
}
