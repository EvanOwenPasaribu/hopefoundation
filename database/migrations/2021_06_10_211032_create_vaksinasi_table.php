<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVaksinasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaksinasi', function (Blueprint $table) {
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
            $table->char('kodependaftaran',10)->nullable();
            $table->date('tanggalvaksinpertama');
            $table->time('waktuvaksinpertama');
            $table->date('tanggalvaksinkedua');
            $table->time('waktuvaksinkedua');
            $table->timestamps();
        });

        Schema::table('vaksinasi', function($table) {
            $table->foreign('id_kota')
                ->references('id_kota')->on('kotavaksinasi')
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
        Schema::dropIfExists('vaksinasi');
    }
}
