<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramKerjaCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_kerja_category', function (Blueprint $table) {
            $table->bigIncrements('id_programkerjacategory');
            $table->string('program_kerja_category_description',50);
            $table->string('program_kerja_url',50);
            $table->string('program_kerja_category_is_deleted',1);
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
        Schema::dropIfExists('program_kerja_category');
    }
}
