<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() 
    {   
         Schema::table('animals', function (Blueprint $table) {
            $table->string('coloracao', length:100)->nullable()->change();
            $table->LongText('storytelling')->nullable()->change();
            $table->text('observacoes')->nullable()->change();
            $table->string('comportamento', length:255)->nullable()->change(); 
            $table->date('data_entrada')->nullable()->change();
         });
    }

    /**
     * Reverse the migrations.
     */
    public function down() 
    {
          Schema::table('animals', function (Blueprint $table) {
            $table->string('coloracao', length:100)->nullable(false)->change();
            $table->LongText('storytelling')->nullable(false)->change();
            $table->text('observacoes')->nullable(false)->change();
            $table->string('comportamento', length:255)->nullable(false)->change(); 
            $table->date('data_entrada')->nullable(false)->change();
         }); 
    }
};
