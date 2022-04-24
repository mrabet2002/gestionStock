<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user')->unsigned();
            $table->integer('num_facture')->unsigned()->unique();
            $table->date('date_echeance')->nullable();
            $table->string('envoi', 100)->nullable();
            $table->string('statut_paiment', 50)->nullable();
            $table->string('methode_paiment', 50)->nullable();
            $table->integer('tva')->unsigned()->nullable()->default(0);
            $table->integer('remise')->unsigned()->nullable()->default(0);
            $table->double('montant_ht', 11, 8);
            $table->double('total_ttc', 11, 8);
            $table->double('net_payer', 11, 8);
            $table->string('description', 1000)->nullable();
            $table->string('devise', 20)->nullable();
            $table->string('fichier_attacher', 255)->nullable();
            $table->timestamps();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factures');
    }
}
