<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('templates', function (Blueprint $table) {
            $table->bigIncrements('id_templates');
            $table->string('app_name',50);
            $table->text('front_picture');
            $table->text('profile_description');
            $table->string('caption_front_picture',50);
            $table->string('caption_description_front_picture',150);
            $table->string('button_description_front_picture',50);
            $table->text('about_us_description_footer');
            $table->text('address_footer');
            $table->text('number_phone_footer');
            $table->string('email_footer',50);
            $table->string('whatsapp',16);
            $table->string('youtube',50);
            $table->string('facebook',50);
            $table->string('instagram',50);
            $table->text('facebook_page');
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
        Schema::dropIfExists('templates');
    }
}
