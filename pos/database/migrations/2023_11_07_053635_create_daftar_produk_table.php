<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_produk', function (Blueprint $table) {
            $table->id();
            $table->string('produk_nama')->unique();
            $table->unsignedBigInteger('kategori_produk_id');
            $table->double('harga_jual');
            $table->integer('stok');
            $table->timestamps();

            $table->foreign('kategori_produk_id')->references('id')->on('kategori_produk')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daftar_produk');
    }
}
