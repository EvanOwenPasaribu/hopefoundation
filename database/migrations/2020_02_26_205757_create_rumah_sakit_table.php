<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRumahSakitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rumahsakit', function (Blueprint $table) {
            $table->bigIncrements('id_rumahsakit');
            $table->string('namarumahsakit',200);
            $table->text('alamatrumahsakit');
            $table->string('latituders',30);
            $table->string('longituders',30);
            $table->text('rumah_sakit_foto');
            $table->string('rumah_sakit_is_deleted',1);
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
        Schema::dropIfExists('rumah_sakit');
    }
}
