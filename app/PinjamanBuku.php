<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PinjamanBuku extends Model
{
    protected $table   = 'tb_pinjaman_buku';
    protected $guarded = ['id'];

    protected $fillable = [
        'id_master_buku', 'username', 'tanggal_peminjaman', 'tanggal_pengembalian', 'is_approve', 'is_reject', 'created_at', 'updated_at'
    ];

    public function deleteData($id)
    {
        return static::find($id)->delete();
    }
}
