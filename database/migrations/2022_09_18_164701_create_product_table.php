<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->json('description');
            $table->unsignedBigInteger('store_id');
            $table->float('price');
            $table->enum('vat_type', ['fixed', 'percentage'])->nullable();
            $table->float('vat_value')->nullable();
            $table->timestamps();
            $table->foreign('store_id')->references('id')->on('store');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
