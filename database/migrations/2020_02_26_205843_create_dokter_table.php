<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDokterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokter', function (Blueprint $table) {
            $table->bigIncrements('id_dokter');
            $table->unsignedBigInteger('id_rumahsakit');
            $table->string('namadokter',200);
            $table->string('spesialist',100);
            $table->text('jadwalpraktek');
            $table->string('dokter_is_deleted',1);
            $table->timestamps();
        });

        Schema::table('dokter', function($table) {
            $table->foreign('id_rumahsakit')
                ->references('id_rumahsakit')->on('rumahsakit')
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
        Schema::dropIfExists('dokter');
    }
}
