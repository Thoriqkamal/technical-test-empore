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
                return '<button type="button" class="btn btn-success btn-sm" id="getEditMasterBuku" data-id="'.$master_buku->id.'"><i style="color:#fff" class="fa fa-edit"></i></button>
                <button type="button" data-id="'.$master_buku->id.'" data-toggle="modal" data-target="#DeleteMasterBukuModal" class="btn btn-danger btn-sm" id="getDeleteId"><i style="color:#fff" class="fa fa-trash"></i></button>';
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

    public function getMasterBuku(Request $request)
    {
        $get_master_buku = MasterBuku::where('id', '=', $request->id)->get();

        $array = [];
        foreach ($get_master_buku as $key => $value) {
            $array['id']             = $value->id;
            $array['kode_buku']      = $value->kode_buku;
            $array['judul_buku']     = $value->judul_buku;
            $array['tahun_terbit']   = $value->tahun_terbit;
            $array['penulis']        = $value->penulis;
            $array['stok_buku']      = $value->stok_buku;
        }
        $data = array("get_master_buku" => $array);
        echo json_encode($data);
		die();
    }

    public function updateMasterBuku(Request $request)
    {
        DB::table('tb_master_buku')
        ->where('id', $request->id_update_master_buku)
        ->update([
            'kode_buku'     => $request->update_kode_buku,
            'judul_buku'    => $request->update_judul_buku,
            'tahun_terbit'  => $request->update_tahun_terbit,
            'penulis'       => $request->update_penulis,
            'stok_buku'     => $request->update_stok_buku
        ]);

        return redirect('/master-buku')->with('status', 'Data Berhasil Diubah');
    }

    public function deleteMasterBuku($id)
    {
        $this->MasterBuku->deleteData($id);

        return response()->json(['success'=>'User deleted successfully']);
    }

}
