<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->text('logo');
            $table->decimal('balance',2);
            $table->string('nomorhp',16)->unique();
            $table->string('isverified',1);
            $table->string('users_status',1);
            $table->rememberToken();
            $table->text('token_for_verification');
            $table->text('token_for_reset_password');
            $table->string('status_penerimaan',1);
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
        Schema::dropIfExists('users');
    }
}
