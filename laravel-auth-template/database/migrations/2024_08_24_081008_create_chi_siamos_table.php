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
        Schema::create('chi_siamos', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(); // Titolo della sezione "Chi siamo"
            $table->text('description')->nullable(); // Descrizione della sezione (opzionale)
            $table->string('image_path')->nullable(); // Percorso dell'immagine (opzionale)
            $table->string('instagram_link')->nullable(); // Link Instagram (opzionale)
            $table->string('facebook_link')->nullable(); // Link Facebook (opzionale)
            $table->string('tiktok_link')->nullable(); // Link TikTok (opzionale)
            $table->string('other_social_link')->nullable(); // Link Altro social (opzionale)
            $table->string('phone_number')->nullable(); // Numero di telefono (opzionale)
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chi_siamos');
    }
};
