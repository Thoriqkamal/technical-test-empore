<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use DB;
use Session;

class ajaxController extends Controller
{
    public function login(Request $request){

        $hasil = DB::table('tb_user')
        ->select('username','email','password')
        ->where('email', '=', $request->email)
        ->where('password', '=', $request->password)
        ->first();

        if($hasil != null){
            session()->put('nama', $hasil->username);
            return response()->json(['success' => 1]);
        }else{
            return response()->json(['success' => 0]);
        }

    }

    public function logout(Request $request){
        session()->forget('nama');
        return response()->json(['success' => 1]);
    }
}
