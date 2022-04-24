<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_categorie')->unsigned();
            $table->bigInteger('id_marque')->unsigned();
            $table->bigInteger('id_user')->unsigned();
            $table->string('libele', 255);
            $table->string('code_barre', 255);
            $table->string('descripiton', 2000)->nullable();
            $table->string('image', 255)->nullable();
            $table->integer('min_stock')->unsigned()->nullable()->default(0);
            $table->double('poids', 8, 2)->nullable();
            $table->string('unite', 255)->nullable();
            $table->string('zone', 200)->nullable();
            $table->timestamps();
            $table->foreign('id_categorie')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('id_marque')->references('id')->on('marques')->onDelete('cascade');
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
        Schema::dropIfExists('produits');
    }
}
