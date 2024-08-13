<?php

namespace Modules\KeuanganMPA\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perencanaan extends Model
{
    use HasFactory;

    protected $primary = 'id';

    public function subPerencanaan()
    {
        return $this->hasMany('Modules\KeuanganMPA\Entities\SubPerencanaan');
    }
}
