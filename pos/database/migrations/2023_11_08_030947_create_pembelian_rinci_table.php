<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianRinciTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian_rinci', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('daftar_produk_id');
            $table->unsignedBigInteger('pembelian_id');
            $table->integer('qty');
            $table->double('harga_beli');
            $table->double('diskon');
            $table->double('subtotal');
            $table->timestamps();

            $table->foreign('daftar_produk_id')->references('id')->on('daftar_produk')->onDelete('cascade');
            $table->foreign('pembelian_id')->references('id')->on('pembelian')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembelian_rinci');
    }
}
