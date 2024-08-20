<?php

namespace Modules\Keuangan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perencanaan extends Model
{
    use HasFactory;

    protected $primary = 'id';

    public function subPerencanaan()
    {
        return $this->hasMany('Modules\Keuangan\Entities\SubPerencanaan');
    }

    public function unit()
    {
        return $this->belongsTo('Modules\Keuangan\Entities\Unit');
    }

}
