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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id("id_commande");
            $table->string('reference')->unique();
            $table->string('nom_client');
            $table->string('telephone')->nullable()    ->index();;
            $table->string('telephone_secondaire')->nullable();
            $table->string('email')->nullable()    ->index();;    
           $table->enum('status', [
            'en_attente',
            'confirmee',
            'expediee',
            'retouree',
            'livree',
            'annulee'
            ])->default('en_attente');
            $table->string('adresse_livraison');
            $table->string('ville');
            $table->string('code_postal')->nullable();
            $table->string('pays')->default('Maroc');

            $table->decimal('sous_total',10,2)->default(0);
            $table->decimal('frais_livraison',10,2)->default(0);
            $table->decimal('total',10,2)->default(0);

            $table->string('payment_method')->nullable();
            $table->enum('payment_status', [  'en_attente','non_paye','paye','rembourse','echec'])->default('non_paye');
            $table->text('notes')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
