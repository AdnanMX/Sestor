<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions_item', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_transactions');
            $table->unsignedBigInteger('id_products');
            $table->string('nama_produk');
            $table->integer('harga_produk');
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('id_transactions')->references('id')->on('transactions')->onDelete('cascade');
            $table->foreign('id_products')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions_item');
    }
};
