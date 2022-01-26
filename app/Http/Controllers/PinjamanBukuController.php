<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Redirect,Response,DB,Config;
use Datatables;
use App\PinjamanBuku;
use App\MasterBuku;
use App\User;

class PinjamanBukuController extends Controller
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
        $master_buku = MasterBuku::all();
        return view('pinjaman_buku.view_pinjaman_buku', compact('master_buku'));
    }

    public function createPinjamanBuku(Request $request)
    {
        $session = $request->session()->get('nama');
        $user = User::where('username', '=', $session)->first();

        $validator = \App\PinjamanBuku::create([
            'id_master_buku'         => $request->judul_buku,
            'username'               => $user->username,
            'tanggal_peminjaman'     => $request->tanggal_pinjaman,
            'tanggal_pengembalian'   => $request->tanggal_pengembalian,
            'is_approve'             => 1,
            'is_reject'              => 0,
            'created_at'             => date('Y-m-d H:i:s')
          ]);

        return redirect('/pengajuan-pinjaman-buku')->with('status', 'Pengajuan Pinjaman Buku Berhasil');;
    }

    public function indexPinjamanBuku()
    {
        return view('pinjaman_buku.list_pinjaman_buku');
    }

    public function ListPinjamanBuku(Request $request)
    {
        $session_user = $request->session()->get('nama');

        $pinjaman_buku = PinjamanBuku::join('tb_master_buku', 'tb_pinjaman_buku.id_master_buku', '=', 'tb_master_buku.id')
        ->where('username', $session_user)
        ->get(['tb_pinjaman_buku.*', 'tb_master_buku.judul_buku', 'tb_master_buku.tahun_terbit', 'tb_master_buku.penulis']);

        return \DataTables::of($pinjaman_buku)
        ->editColumn('is_status', function($row){
            if($row->is_approve == 1 && $row->is_reject == 0)
                return $row->is_approve = 'Waiting approve';
            elseif($row->is_approve == 2 && $row->is_reject == 0)
                return $row->is_approve = 'Sedang di pinjam';
            elseif($row->is_approve == 0 && $row->is_reject == 0)
                return $row->is_approve = 'Telah di pinjam';
            elseif($row->is_approve == 0 && $row->is_reject == 1)
                return $row->is_approve = 'Peminjaman di tolak';
        })
        ->rawColumns(['is_status'])
        ->make(true);
    }
}
