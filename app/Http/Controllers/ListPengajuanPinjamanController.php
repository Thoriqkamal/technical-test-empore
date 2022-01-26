<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Redirect,Response,DB,Config;
use Datatables;
use App\PinjamanBuku;

class ListPengajuanPinjamanController extends Controller
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
        return view('list_pengajuan_pinjaman.view_list_pengajuan_pinjaman');
    }

    public function PengajuanPinjaman(Request $request)
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
                return $row->is_approve = 'Approve';
            elseif($row->is_approve == 0 && $row->is_reject == 0)
                return $row->is_approve = 'Sudah di kembalikan';
            elseif($row->is_approve == 0 && $row->is_reject == 1)
                return $row->is_approve = 'Reject';
        })
        ->rawColumns(['is_status', 'Actions'])
        ->make(true);
    }

    public function approvePinjaman(Request $request)
    {
        $pinjaman_buku = PinjamanBuku::join('tb_master_buku', 'tb_pinjaman_buku.id_master_buku', '=', 'tb_master_buku.id')
        ->where('tb_pinjaman_buku.id', '=', $request->id)
        ->get(['tb_pinjaman_buku.*', 'tb_master_buku.judul_buku', 'tb_master_buku.stok_buku']);
        foreach ($pinjaman_buku as $key => $value) {
            if ($value->is_approve == 1 && $value->is_reject == 0) {
                $stok_buku = $value->stok_buku - 1;
                DB::table('tb_pinjaman_buku')
                ->join('tb_master_buku', 'tb_pinjaman_buku.id_master_buku', '=', 'tb_master_buku.id')
                ->where('tb_pinjaman_buku.id', $request->id)
                ->update([
                    'stok_buku'   => $stok_buku,
                    'is_approve'  => 2,
                ]);

                $status = 'Success di approve';
            }else if ($value->is_approve == 0 && $value->is_reject == 1) {
                $status = 'Tidak bisa approve status reject!';
            }else if ($value->is_approve == 0 && $value->is_reject == 0){
                $status = 'Tidak bisa approve status sudah di kembalikan!';
            }else if ($value->is_approve == 2 && $value->is_reject == 0){
                $status = 'Pengajuan sudah di Approve!';
            }
        }

        echo json_encode($status);
        exit();
    }

    public function rejectPinjaman(Request $request)
    {
        $pinjaman_buku = PinjamanBuku::join('tb_master_buku', 'tb_pinjaman_buku.id_master_buku', '=', 'tb_master_buku.id')
        ->where('tb_pinjaman_buku.id', '=', $request->id)
        ->get(['tb_pinjaman_buku.*', 'tb_master_buku.judul_buku', 'tb_master_buku.stok_buku']);
        foreach ($pinjaman_buku as $key => $value) {
            if ($value->is_approve == 1 && $value->is_reject == 0) {
                DB::table('tb_pinjaman_buku')
                ->join('tb_master_buku', 'tb_pinjaman_buku.id_master_buku', '=', 'tb_master_buku.id')
                ->where('tb_pinjaman_buku.id', $request->id)
                ->update([
                    'is_approve'  => 0,
                    'is_reject'   => 1,
                ]);

                $status = 'Success di reject';

            }else if ($value->is_approve == 2 && $value->is_reject == 0){
                $status = 'Tidak bisa reject status approve!';
            }else if ($value->is_approve == 0 && $value->is_reject == 0){
                $status = 'Tidak bisa reject status sudah di kembalikan!';
            }else if ($value->is_approve == 0 && $value->is_reject == 1) {
                $status = 'Pengajuan sudah di reject!';
            }
        }

        echo json_encode($status);
        exit();
    }
}
