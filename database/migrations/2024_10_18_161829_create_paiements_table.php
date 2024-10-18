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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->integer('montant');
            $table->date('date_paiement');
            $table->enum('MethodePaiement', ['carte', 'wave', 'orange_money'])->default('wave');
            $table->enum('etat_paiement', ['en_attente', 'paye', 'annule'])->default('en_attente');
            $table->foreignId('commande_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('paiements');
    }
};
