<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Core\User;

class LoginActivity extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_agent',
        'ip_address',
        'created_at',
        'user_id',
		
    ];
	
	public function getUser(){
		return $this->hasOne(User::class,'id','user_id');
	}
}
