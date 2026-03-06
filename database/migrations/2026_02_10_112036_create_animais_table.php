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
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('nome', length:100);
            $table->foreignId('category_id');
            $table->enum('sexo', ['Macho', 'Fêmea']);
            $table->string('coloracao', length:100);
            $table->enum('idade', ['Adulto', 'Filhote', 'Idoso']);
            $table->enum('porte', ['Pequeno', 'Médio', 'Grande']);
            $table->LongText('storytelling')->nullable();
            $table->text('observacoes')->nullable();
            $table->string('comportamento', length:255)->nullable(); 
            $table->date('data_entrada')->nullable();
            $table->string('disponivel', length:1 );
            $table->string('microchip', length:1 );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animais');
    }
};
