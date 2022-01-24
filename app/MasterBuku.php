<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterBuku extends Model
{
    protected $table   = 'tb_master_buku';
    protected $guarded = ['id'];

    protected $fillable = [
        'kode_buku', 'judul_buku', 'tahun_terbit', 'penulis', 'stok_buku'
    ];

    public function storeData($input)
    {
    	return static::create($input);
    }

    public function deleteData($id)
    {
        return static::find($id)->delete();
    }
}
