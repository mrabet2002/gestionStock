<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAchatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('achats', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user')->unsigned();
            $table->bigInteger('id_fournisseur')->unsigned();
            $table->double('total', 11, 8);
            $table->integer('taxe')->unsigned()->nullable()->default(0);
            $table->date('date_reception')->nullable();
            $table->string('statut', 255)->nullable();
            $table->string('descripition', 1000)->nullable();
            $table->string('devise', 20)->nullable();
            $table->timestamps();
            $table->foreign('id_fournisseur')->references('id')->on('fournisseurs')->onDelete('cascade');
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
        Schema::dropIfExists('achats');
    }
}
