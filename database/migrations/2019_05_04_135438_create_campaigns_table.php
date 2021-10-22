<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->bigIncrements('id_campaigns');
            $table->unsignedBigInteger('id');
            $table->unsignedBigInteger('id_category');
            $table->string('campaigns_title',200);
            $table->text('campaigns_description');
            $table->text('short_invitation');
            $table->decimal('target_funds', 12, 2);
            $table->decimal('funds_collected', 12, 2);
            $table->date('raising_deadline');
            $table->string('raising_link',100);
            $table->text('campaigns_foto');
            $table->string('fundraiser_phone_number',14);
            $table->text('purpose_of_raising');
            $table->integer('campaigns_total_views');
            $table->string('is_important',1);
            $table->string('campaigns_is_deleted',1);
            $table->string('campaigns_verification',1);
            $table->string('campaigns_status',1);
            $table->timestamps();
        });

        Schema::create('donations', function (Blueprint $table) {
            $table->bigIncrements('id_donations');
            $table->unsignedBigInteger('id_campaigns');
            $table->unsignedBigInteger('id'); 
            $table->unsignedBigInteger('id_paymentmethoddetails'); 
            $table->decimal('amount_of_donation', 12, 2);
            $table->text('support_description')->nullable();
            $table->integer('unique_number');
            $table->string('user_is_anonim',1);
            $table->string('donations_is_deleted',1);
            $table->string('donations_status',1);
            $table->timestamps();
        });

        Schema::table('campaigns', function($table) {
            $table->foreign('id_fundraiser')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('id_category')
                ->references('id_category')->on('category')
                ->onDelete('cascade');
         });

        Schema::table('donations', function($table) {
            $table->foreign('id_campaigns')
                ->references('id_campaigns')->on('campaigns')
                ->onDelete('cascade');
            $table->foreign('id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('id_paymentmethoddetail')
                ->references('payment_method_detail')->on('id_paymentmethoddetail')
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
        Schema::dropIfExists('campaigns');
        Schema::dropIfExists('donations');
    }
}
