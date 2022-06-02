<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockVenteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_vente', function (Blueprint $table) {
            $table->bigInteger('id_vente')->unsigned();
            $table->bigInteger('id_stock')->unsigned();
            $table->foreign('id_stock')->references('id')->on('stocks')->onDelete('cascade');
            $table->foreign('id_vente')->references('id')->on('ventes')->onDelete('cascade');
            $table->primary(['id_stock','id_vente']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_vente');
    }
}
