<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformasiKesehatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informasi_kesehatan', function (Blueprint $table) {
            $table->bigIncrements('id_informasikesehatan');
            $table->unsignedBigInteger('id');
            $table->string('informasi_kesehatan_title',100);
            $table->text('informasi_kesehatan_short_description',200);
            $table->text('informasi_kesehatan_description');
            $table->text('informasi_kesehatan_foto');
            $table->timestamps();
        });

        Schema::table('informasi_kesehatan', function($table) {
            $table->foreign('id')
                ->references('id')->on('users')
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
        Schema::dropIfExists('informasi_kesehatan');
    }
}
