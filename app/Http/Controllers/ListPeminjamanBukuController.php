<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Redirect,Response,DB,Config;
use Datatables;

class ListPeminjamanBukuController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->PinjamanBuku = new PinjamanBuku;
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
        ->get(['tb_pinjaman_buku.*', 'tb_master_buku.judul_buku', 'tb_master_buku.stok_buku']);

        return \DataTables::of($pinjaman_buku)
        ->addColumn('Actions', function($pinjaman_buku) {
            return '<button type="button" class="btn btn-success btn-sm" id="approvePinjaman" data-id="'.$pinjaman_buku->id.'" data-toggle="modal" data-target="#ApproveModal">Approve</button>
            <button type="button" class="btn btn-danger btn-sm" id="rejectPinjaman" data-id="'.$pinjaman_buku->id.'" data-toggle="modal" data-target="#RejectModal">Reject</button>';
        })
        ->editColumn('is_status', function($row){
            if($row->is_approve == 1 && $row->is_reject == 0)
                return $row->is_approve = 'Waiting Approve';
            elseif($row->is_approve == 2 && $row->is_reject == 0)
                return $row->is_approve = 'Sedang Di Pinjam';
            elseif($row->is_approve == 0 && $row->is_reject == 0)
                return $row->is_approve = 'Telah Pinjam';
            elseif($row->is_approve == 0 && $row->is_reject == 1)
                return $row->is_approve = 'Peminjaman Di Tolak';
        })
        ->rawColumns(['is_status', 'Actions'])
        ->make(true);
    }
}
