<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event', function (Blueprint $table) {
            $table->bigIncrements('id_event');
            $table->unsignedBigInteger('id');
            $table->string('event_title',100);
            $table->text('event_short_description',200);
            $table->text('event_description');
            $table->text('event_foto');
            $table->timestamps();
        });

        Schema::table('event', function($table) {
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
        Schema::dropIfExists('event');
    }
}
