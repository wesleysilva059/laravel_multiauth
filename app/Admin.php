<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    use Notifiable;

    /**
     * Attributes that are mass assignable
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * Attributes that should be hidden for arrays
     */
    protected $hidden = [
        'password','remember_token'
    ];

}
