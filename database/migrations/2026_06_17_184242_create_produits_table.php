<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produits', function (Blueprint $table) {

        $table->id('idproduit');
      $table->unsignedBigInteger('categorie_id');
      $table->foreign('categorie_id')
      ->references('id_categorie_prd')
      ->on('categorie_prods')
      ->onDelete('cascade');
        $table->string('nom_produit');
        $table->string('slug')
        ->unique();
        $table->text('description')
        ->nullable();
        $table->decimal('prix', 10, 2);
        $table->string('image')
        ->nullable();   
        $table->boolean('status')
        ->default(true);
        $table->softDeletes();
        $table->integer('stock')
        ->default(0);
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
