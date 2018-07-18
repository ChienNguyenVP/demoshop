<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
	use Notifiable;
    protected $table = 'admins';
    protected $fillable = ['id','name','avatar','email','created_at','updated_at','password'];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
