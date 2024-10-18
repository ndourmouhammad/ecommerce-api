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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('accessoires');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('accessoires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categorie_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }
};
