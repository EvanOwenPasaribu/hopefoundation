<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionBalanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_balance', function (Blueprint $table) {
            $table->bigIncrements('id_transactionbalance');
            $table->unsignedBigInteger('id');
            $table->unsignedBigInteger('id_paymentmethoddetail');
            $table->char('transaction_code',16);
            $table->decimal('saldosebelumnya', 12, 2);
            $table->decimal('nominaltransaction', 12, 2);
            $table->decimal('nominaltransaction', 12, 2);
            $table->char('kodeunik',3);
            $table->decimal('kredit', 12, 2);
            $table->decimal('saldosesudahnya', 12, 2);
            $table->text('keterangantransaksi');
            $table->string('transaction_balance_status',1);
            $table->timestamps();
        });
        Schema::table('transaction_balance', function($table) {
            $table->foreign('id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('id_paymentmethoddetail')
                ->references('id_paymentmethoddetail')->on('payment_method_detail')
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
        Schema::dropIfExists('transaction_balance');
    }
}
