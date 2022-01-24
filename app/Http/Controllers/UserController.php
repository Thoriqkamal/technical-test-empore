<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Redirect,Response,DB,Config;
use Datatables;
use App\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->User = new User;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('users.view_user');
    }

    public function usersList()
    {
        $users = User::all();
        return \DataTables::of($users)
            ->addColumn('Actions', function($users) {
                return '<button type="button" class="btn btn-success btn-sm" id="getEditUserData" data-id="'.$users->id.'"><i style="color:#fff" class="fa fa-edit"></i></button>
                <button type="button" data-id="'.$users->id.'" data-toggle="modal" data-target="#DeleteUserModal" class="btn btn-danger btn-sm" id="getDeleteId"><i style="color:#fff" class="fa fa-trash"></i></button>';
            })
            ->rawColumns(['Actions'])
        ->make(true);
    }

    public function createUser(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'username'  => 'required',
            'email'     => 'required',
            'password'  => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $this->User->storeData($request->all());

        return redirect('/users')->with('status', 'Data Berhasil Ditambahkan');;
    }

    public function getUser(Request $request)
    {
        $get_user = User::where('id', '=', $request->id)->get();

        $array = [];
        foreach ($get_user as $key => $value) {
            $array['id']                 = $value->id;
            $array['username']           = $value->username;
            $array['email']              = $value->email;
            $array['password']           = $value->password;
        }
        $data = array("get_user" => $array);
        echo json_encode($data);
		die();
    }

    public function updateUser(Request $request)
    {
        DB::table('tb_user')
        ->where('id', $request->id_update_user)
        ->update([
            'username'     => $request->update_username,
            'email'        => $request->update_email,
            'password'     => Hash::make($request->update_password),
            'updated_at'   => date('Y-m-d H:i:s')
        ]);

        return redirect('/users')->with('status', 'Data Berhasil Diubah');
    }

    public function deleteUser($id)
    {
        $this->User->deleteData($id);

        return response()->json(['success'=>'User deleted successfully']);
    }
}
