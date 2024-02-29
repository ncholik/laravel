<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getChild(){        
        $child=Menu::where('parent_id',$this->id);
        if($child->count()>0){
            return $child->get();
        }
        return false;
    }
}
