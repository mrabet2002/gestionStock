<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user')->unsigned();
            $table->bigInteger('id_client')->unsigned();
            $table->bigInteger('id_facture')->unsigned();
            $table->integer('taxe')->unsigned()->nullable()->default(0);
            $table->double('total', 11, 2);
            $table->double('cout_livraison', 11, 2)->nullable()->default(0);
            $table->string('adresse_livraison', 255)->nullable();
            $table->date('date_livraison')->nullable();
            $table->string('statut', 255)->nullable();
            $table->string('descripition', 1000)->nullable();
            $table->string('devise', 20)->nullable();
            $table->timestamps();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_client')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('id_facture')->references('id')->on('factures')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventes');
    }
}
