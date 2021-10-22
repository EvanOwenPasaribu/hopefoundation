<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUpdateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('update_campaigns', function (Blueprint $table) {
            $table->bigIncrements('id_updatecampaigns');
            $table->unsignedBigInteger('id_campaigns');
            $table->unsignedBigInteger('id');
            $table->string('title_update',200);
            $table->text('description_update');
            $table->timestamps();
        });

        Schema::table('update_campaigns', function($table) {
            $table->foreign('id_campaigns')
                ->references('id_campaigns')->on('campaigns')
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
        Schema::dropIfExists('update_campaigns');
    }
}
