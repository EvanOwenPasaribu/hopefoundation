<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramKerjaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_kerja', function (Blueprint $table) {
            $table->bigIncrements('id_programkerja');
            $table->unsignedBigInteger('id_programkerjacategory');
            $table->unsignedBigInteger('id');
            $table->string('program_kerja_title',100);
            $table->text('program_kerja_short_description',200);
            $table->text('program_kerja_description');
            $table->text('program_kerja_foto');
            $table->text('program_kerja_foto_name');
            $table->timestamps();
        });

        Schema::table('program_kerja', function($table) {
            $table->foreign('id_programkerjacategory')
                ->references('id_programkerjacategory')->on('program_kerja_category')
                ->onDelete('cascade');
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
        Schema::dropIfExists('program_kerja');
    }
}
