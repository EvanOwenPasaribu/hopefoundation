<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentMethodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_method', function (Blueprint $table) {
            $table->bigIncrements('id_paymentmethod');
            $table->string('payment_code',3);
            $table->string('method_name',100);
            $table->text('description_payment');
            $table->string('is_active',1);
            $table->string('is_default',1);
            $table->string('payment_method_is_deleted',1);
            $table->timestamps();
        });

        Schema::create('payment_method_detail', function (Blueprint $table) {
            $table->bigIncrements('id_paymentmethoddetail');
            $table->unsignedBigInteger('id_paymentmethod');
            $table->string('method_detail_name',100);
            $table->text('description_payment_detail');
            $table->text('payment_detail_logo');
            $table->string('is_active',1);
            $table->string('payment_method_detail_is_deleted',1);
            $table->timestamps();
        });

        Schema::table('payment_method_detail', function($table) {
            $table->foreign('id_paymentmethod')
                ->references('id_paymentmethod')->on('payment_method')
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
        Schema::dropIfExists('payment_method');
        Schema::dropIfExists('payment_method_detail');
    }
}
