<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    public function index()
    {
        $user = DB::table('tb_user')->get();

        return view('users.view_user', compact('user'));
    }
}
