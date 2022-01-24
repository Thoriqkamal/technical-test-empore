<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'tb_user';

    protected $fillable = [
        'username', 'email', 'password'
    ];
}
