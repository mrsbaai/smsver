<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    protected $fillable = [
        'email', 'password',  'ip', 'flat_password', 'is_payed', 'created_at'
    ];

    protected $table = "users";

}
