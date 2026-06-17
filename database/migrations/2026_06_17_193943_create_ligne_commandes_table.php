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
        Schema::create('ligne_commandes', function (Blueprint $table) {
            $table->id('id_ligne_commande');
            
            $table->unsignedBigInteger('commande_id');
            $table->foreign('commande_id')
            ->references('id_commande')
            ->on('commandes')
            ->cascadeOnDelete();
              $table->unsignedBigInteger('produit_id');
            $table->foreign('produit_id')
            ->references('idproduit')
             ->on('produits')
             ->cascadeOnDelete();
             $table->integer('quantite')->default(1);
              $table->decimal('prix_unitaire',10,2);
              $table->decimal('total_ligne',10,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ligne_commandes');
    }
};
