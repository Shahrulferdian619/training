<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKebutuhanRinciTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kebutuhan_rinci', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kebutuhan_id');
            $table->string('nama_barang');
            $table->double('harga');
            $table->integer('qty');
            $table->double('diskon');
            $table->double('subtotal');
            $table->timestamps();

            $table->foreign('kebutuhan_id')->references('id')->on('kebutuhan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kebutuhan_rinci');
    }
}
