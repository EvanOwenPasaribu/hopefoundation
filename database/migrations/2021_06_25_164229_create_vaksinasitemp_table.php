<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVaksinasitempTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaksinasitemp', function (Blueprint $table) {
            $table->bigIncrements('id_vaksinasi');
            $table->unsignedBigInteger('id_kota');
            $table->string('emailvaksin')->nullable();
            $table->string('namalengkap');
            $table->char('nik',16)->unique();;
            $table->text('ktp_foto');
            $table->string('jenis_kelamin',15);
            $table->string('kotakelahiran',50)->nullable();
            $table->date('tanggallahir');
            $table->text('alamat');
            $table->string('nomorhpvaksin',16);
            $table->string('nomorwavaksin',16);
            $table->string('golongan_darah',2)->nullable();
            $table->char('rhesus_darah',1)->nullable();
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
        Schema::dropIfExists('vaksinasitemp');
    }
}
