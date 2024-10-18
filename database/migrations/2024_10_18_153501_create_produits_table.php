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
            $table->id();
            $table->string('libelle');
            $table->integer('prix_unitaire');
            $table->text('description')->nullable();
            $table->date('date_Ajout');
            $table->integer('quantite_actuellement_disponible');
            $table->boolean('en_rupture')->default(false);
            $table->json('caracteristiques')->nullable();
            $table->integer('prix_en_promo')->nullable();
            $table->foreignId('categorie_id')->constrained()->onDelete('cascade')->nullable();
            $table->foreignId('marque_id')->constrained()->onDelete('cascade')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('produits');
    }
};
