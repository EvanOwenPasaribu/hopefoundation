<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKotavaksinasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kotavaksinasi', function (Blueprint $table) {
            $table->bigIncrements('id_kota');
            $table->string('namakota',50);
            $table->date('tanggalvaksin');
            $table->date('tanggalvaksinselesai');
            $table->string('is_active',1);
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
        Schema::dropIfExists('kotavaksinasi');
    }
}
