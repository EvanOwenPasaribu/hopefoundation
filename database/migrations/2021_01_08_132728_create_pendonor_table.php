<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePendonorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendonor', function (Blueprint $table) {
            $table->bigIncrements('id_pendonor');
            $table->string('namapendonor',200);
            $table->string('golongandarah',2);
            $table->string('nomorhandphone1',16)->unique();
            $table->string('nomorhandphone2',16)->nullable()->unique();
            $table->text('alamatpendonor');
            $table->string('pendonor_is_deleted',1);
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
        Schema::dropIfExists('pendonor');
    }
}
