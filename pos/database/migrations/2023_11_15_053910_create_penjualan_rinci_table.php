<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualanRinciTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan_rinci', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('daftar_produk_id');
            $table->unsignedBigInteger('penjualan_id');
            $table->double('harga_jual');
            $table->double('qty');
            $table->double('diskon');
            $table->double('subtotal');
            $table->timestamps();

            $table->foreign('daftar_produk_id')->references('id')->on('daftar_produk')->onDelete('cascade');
            $table->foreign('penjualan_id')->references('id')->on('penjualan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penjualan_rinci');
    }
}
