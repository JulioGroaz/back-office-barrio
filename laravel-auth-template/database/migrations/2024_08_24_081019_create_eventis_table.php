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
        Schema::create('eventis', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Titolo dell'evento
            $table->dateTime('event_date_time'); // Data e orario dell'evento
            $table->text('description')->nullable(); // Descrizione dell'evento (non obbligatoria)
            $table->string('image_path')->nullable(); // Percorso dell'immagine associata all'evento
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventis');
    }
};
