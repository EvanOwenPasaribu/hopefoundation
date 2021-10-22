<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFundraisingProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fundraising_product', function (Blueprint $table) {
            $table->bigIncrements('id_fundraisingproduct');
            $table->unsignedBigInteger('id');
            $table->string('product_name',100);
            $table->text('description_product');
            $table->string('is_active',1);
            $table->string('fundraising_product_is_deleted',1);
            $table->timestamps();
        });

        Schema::create('fundraising_product_attributes', function (Blueprint $table) {
            $table->bigIncrements('id_fundraisingproductattributes');
            $table->unsignedBigInteger('id_fundraisingproduct');
            $table->decimal('product_price_netto', 12, 2);
            $table->decimal('product_price_gross', 12, 2);
            $table->integer('disc_percentage');
            $table->integer('product_weight');
            $table->integer('stock');
            $table->integer('min_order');
            $table->string('attribute_string',100);
            $table->string('attribute_string_value',100);
            $table->string('is_default',1);
            $table->string('fundraising_product_attributes_is_deleted',1);
            $table->timestamps();
        });

        Schema::create('fundraising_product_images', function (Blueprint $table) {
            $table->bigIncrements('id_fundraisingproductimages');
            $table->unsignedBigInteger('id_fundraisingproduct');
            $table->text('fundraising_product_images');
            $table->text('fundraising_product_images_thumb');
            $table->string('is_default',1);
            $table->string('fundraising_product_images_is_deleted',1);
            $table->timestamps();
        });

        Schema::table('fundraising_product', function($table) {
            $table->foreign('id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });

        Schema::table('fundraising_product_attributes', function($table) {
            $table->foreign('id_fundraisingproduct')
                ->references('id_fundraisingproduct')->on('fundraising_product')
                ->onDelete('cascade');
        });

        Schema::table('fundraising_product_images', function($table) {
            $table->foreign('id_fundraisingproduct')
                ->references('id_fundraisingproduct')->on('fundraising_product')
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
        Schema::dropIfExists('fundraising_product');
        Schema::dropIfExists('fundraising_product_attributes');
        Schema::dropIfExists('fundraising_product_images');
    }
}
