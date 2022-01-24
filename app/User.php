<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table   = 'tb_user';
    protected $guarded = ['id', 'password'];

    protected $fillable = [
        'username', 'email', 'password'
    ];

    public function storeData($input)
    {
    	return static::create($input);
    }

    public function deleteData($id)
    {
        return static::find($id)->delete();
    }
}
