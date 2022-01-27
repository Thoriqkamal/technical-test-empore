<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MasterBuku extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_master_buku', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_buku');
            $table->string('judul_buku');
            $table->date('tahun_terbit');
            $table->string('penulis');
            $table->string('stok_buku');
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
