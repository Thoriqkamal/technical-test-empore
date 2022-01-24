<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Redirect,Response,DB,Config;
use Datatables;
use App\MasterBuku;

class MasterBukuController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->MasterBuku = new MasterBuku;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('master_buku.view_master_buku');
    }

    public function MasterBukuList()
    {
        $master_buku = MasterBuku::all();
        return \DataTables::of($master_buku)
            ->addColumn('Actions', function($master_buku) {
                return '<button type="button" class="btn btn-success btn-sm" id="getEditUserData" data-id="'.$master_buku->id.'"><i style="color:#fff" class="fa fa-edit"></i></button>
                <button type="button" data-id="'.$master_buku->id.'" data-toggle="modal" data-target="#DeleteUserModal" class="btn btn-danger btn-sm" id="getDeleteId"><i style="color:#fff" class="fa fa-trash"></i></button>';
            })
            ->rawColumns(['Actions'])
        ->make(true);
    }

    public function createMasterBuku(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'kode_buku'    => 'required',
            'judul_buku'   => 'required',
            'tahun_terbit' => 'required',
            'penulis'      => 'required',
            'stok_buku'    => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $this->MasterBuku->storeData($request->all());

        return redirect('/master-buku')->with('status', 'Data Berhasil Ditambahkan');;
    }

}
