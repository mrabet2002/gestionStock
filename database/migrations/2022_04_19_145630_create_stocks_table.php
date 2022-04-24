<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_produit')->unsigned();
            $table->double('prix_vente', 11, 2)->nullable();
            $table->double('prix_achat', 11, 2)->nullable();
            $table->double('prix_vente_cons', 11, 2)->nullable();
            $table->integer('qte')->unsigned()->default(0);
            $table->date('date_expiration');
            $table->string('descripiton', 2000)->nullable();
            $table->timestamps();
            $table->foreign('id_produit')->references('id')->on('produits')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
