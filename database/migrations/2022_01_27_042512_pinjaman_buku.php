<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PinjamanBuku extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pinjaman_buku', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_master_buku');
            $table->string('username');
            $table->date('tanggal_peminjaman');
            $table->date('tanggal_pengembalian');
            $table->tinyinteger('is_approve');
            $table->tinyinteger('is_reject');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_master_buku');
    }
}
