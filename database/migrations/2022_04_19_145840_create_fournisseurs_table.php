<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFournisseursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fournisseurs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user')->unsigned();
            $table->integer('num_fournisseur')->nique();
            $table->string('name');
            $table->string('email')->nullable()->unique();
            $table->string('tel', 20)->nullable();
            $table->string('site_web', 255)->nullable();
            $table->string('adresse', 255)->nullable();
            $table->integer('code_postal')->nullable();
            $table->string('pays', 255)->nullable();
            $table->string('ville', 255)->nullable();
            $table->string('description', 1000)->nullable();
            $table->string('devise', 20)->nullable();
            $table->string('fichier_attacher', 255)->nullable();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fournisseurs');
    }
}
