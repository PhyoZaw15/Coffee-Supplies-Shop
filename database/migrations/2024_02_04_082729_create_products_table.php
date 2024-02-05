<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->default(1);
            $table->unsignedBigInteger('brand_id')->default(1);
            $table->string('name');
            $table->string('sku_code')->nullable();
            $table->text('description')->nullable();
            $table->integer('media_id')->unsigned()->nullable();
            $table->integer('price')->nullable();
            $table->integer('quantity')->nullable();
            $table->boolean('status')->default(0);
            $table->boolean('is_deleted')->default(0);
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
        Schema::dropIfExists('products');
    }
}
