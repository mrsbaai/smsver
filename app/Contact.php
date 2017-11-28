<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'message', 'subject', 'email'
    ];

    protected $table = "contacts";

}
