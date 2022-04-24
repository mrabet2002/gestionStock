<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAchatProduitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('achat_produit', function (Blueprint $table) {
            $table->bigInteger('id_achat')->unsigned();
            $table->bigInteger('id_produit')->unsigned();
            $table->foreign('id_produit')->references('id')->on('produits')->onDelete('cascade');
            $table->foreign('id_achat')->references('id')->on('achats')->onDelete('cascade');
            $table->primary(['id_produit','id_achat']);
            $table->date('date_expiration')->nullable();
            $table->integer('remise')->unsigned()->nullable();
            $table->integer('qte_demandee')->unsigned();
            $table->integer('qte_recue')->unsigned();
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
        Schema::dropIfExists('achat_produit');
    }
}
