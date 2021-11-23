<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePemesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->bigIncrements('id_pemesanan');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_product');
            $table->string('status_pesanan',1);
            $table->unsignedBigInteger('total_product');
            $table->string('bukti_pembayaran', 200);
            $table->timestamps();
        });

        Schema::table('pemesanan', function($table) {
            $table->foreign('id_user')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });

        Schema::table('pemesanan', function($table) {
            $table->foreign('id_product')
                ->references('id_fundraisingproduct')->on('fundraising_product')
                ->onDelete('cascade');
        });

    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemesanan');
    }
}
