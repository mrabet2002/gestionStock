<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitVenteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produit_vente', function (Blueprint $table) {
            $table->bigInteger('id_vente')->unsigned();
            $table->bigInteger('id_produit')->unsigned();
            $table->foreign('id_produit')->references('id')->on('produits')->onDelete('cascade');
            $table->foreign('id_vente')->references('id')->on('ventes')->onDelete('cascade');
            $table->primary(['id_produit','id_vente']);
            $table->date('date_expiration')->nullable();
            $table->integer('remise')->unsigned()->nullable();
            $table->integer('qte_demandee')->unsigned();
            $table->integer('qte_livrai')->unsigned();
            $table->integer('taxe')->unsigned()->nullable()->default(0);
            $table->double('prix', 11, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produit_vente');
    }
}
