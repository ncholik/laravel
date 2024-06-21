<?php

namespace Modules\Keuangan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Realisasi extends Model
{
    use HasFactory;

    protected $primary = 'id';

    public function subPerencanaan()
    {
        return $this->belongsTo('Modules\Keuangan\Entities\SubPerencanaan');
    }
}
