<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MasterBuku;

class ApiBukuController extends Controller
{
    public function getBook()
    {
        $get_books = MasterBuku::all();

        return response()->json($get_books, 200);
    }

    public function getSingleBook($code)
    {
        $get_single_books = MasterBuku::where('kode_buku', '=', $code)->get();

        return response()->json($get_single_books, 200);
    }

    public function createBook(Request $request)
    {
        $response = \App\MasterBuku::create([
            'kode_buku'     => $request->kode_buku,
            'judul_buku'    => $request->judul_buku,
            'tahun_terbit'  => $request->tahun_terbit,
            'penulis'       => $request->penulis,
            'stok_buku'     => $request->stok_buku
        ]);

        if ($response){
            $data=['status'=>'200','message'=>'Success Create Data'];
        }else{
            $data=['status'=>'400','message'=>'Failed Create Data'];
        }

        return response()->json($data);
    }

    public function updateBook(Request $request, $code)
    {
        $response = DB::table('tb_master_buku')
        ->where('kode_buku', $code)
        ->update([
            'kode_buku'     => $request->kode_buku,
            'judul_buku'    => $request->judul_buku,
            'tahun_terbit'  => $request->tahun_terbit,
            'penulis'       => $request->penulis,
            'stok_buku'     => $request->stok_buku
        ]);

        if ($response){
            $data=['status'=>'200','message'=>'Success Update Data'];
        }else{
            $data=['status'=>'400','message'=>'Failed Update Data'];
        }

        return response()->json($data);
    }

    public function deleteBook(Request $request, $code)
    {
        $response = MasterBuku::where('kode_buku', '=', $code)->delete();

        if ($response){
            $data=['status'=>'200','message'=>'Success Delete Data'];
        }else{
            $data=['status'=>'400','message'=>'Failed Delete Data'];
        }

        return response()->json($data);
    }
}
