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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nome del prodotto
            $table->decimal('price', 8, 2); // Prezzo del prodotto
            $table->text('description')->nullable(); // Descrizione del prodotto (non obbligatoria)
            $table->enum('category', [
                'caffetteria',
                'aperitivi',
                'vini_bianchi',
                'vini_rossi',
                'vini_rose',
                'vini_bollicine',
                'cocktail',
                'superalcolici',
                'food'
            ]); // Categoria con opzioni predefinite
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
