<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Redirect,Response,DB,Config;
use Datatables;
use App\PinjamanBuku;

class ListPeminjamanBukuController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->PinjamanBuku = new PinjamanBuku;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('list_peminjaman_buku.view_list_peminjaman_buku');
    }

    public function PeminjamanBuku(Request $request)
    {
        $pinjaman_buku = PinjamanBuku::join('tb_master_buku', 'tb_pinjaman_buku.id_master_buku', '=', 'tb_master_buku.id')
        ->where('is_approve', 2)
        ->where('is_reject', 0)
        ->get(['tb_pinjaman_buku.*', 'tb_master_buku.judul_buku', 'tb_master_buku.stok_buku']);

        return \DataTables::of($pinjaman_buku)
        ->addColumn('Actions', function($pinjaman_buku) {
            return '<button type="button" class="btn btn-success btn-sm" id="updateStatus" data-id="'.$pinjaman_buku->id.'" data-toggle="modal" data-target="#UpdateStatusModal">Update</button>';
        })
        ->editColumn('is_status', function($row){
            if($row->is_approve == 2 && $row->is_reject == 0)
                return $row->is_approve = 'Approve';
        })
        ->rawColumns(['is_status', 'Actions'])
        ->make(true);
    }

    public function updateStatus(Request $request)
    {
        $pinjaman_buku = PinjamanBuku::join('tb_master_buku', 'tb_pinjaman_buku.id_master_buku', '=', 'tb_master_buku.id')
        ->where('tb_pinjaman_buku.id', '=', $request->id)
        ->get(['tb_pinjaman_buku.*', 'tb_master_buku.judul_buku', 'tb_master_buku.stok_buku']);
        foreach ($pinjaman_buku as $key => $value) {
            if ($value->is_approve == 2 && $value->is_reject == 0) {
                $stok_buku = $value->stok_buku + 1;
                DB::table('tb_pinjaman_buku')
                ->join('tb_master_buku', 'tb_pinjaman_buku.id_master_buku', '=', 'tb_master_buku.id')
                ->where('tb_pinjaman_buku.id', $request->id)
                ->update([
                    'stok_buku'   => $stok_buku,
                    'is_approve'  => 0,
                ]);

                $status = 'Success di update';
            }else{
                $status = 'List peminjaman sudah di update!';
            }
        }

        echo json_encode($status);
        exit();
    }
}
