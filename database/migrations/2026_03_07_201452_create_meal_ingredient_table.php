<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up () : void {
    Schema::create('meal_ingredient', function (Blueprint $table){
        $table->foreignId('meal_id')->constrained()->onDelete('cascade');
        $table->foreignId('ingredient_id')->constrained()->onDelete('cascade');
        $table->integer('quantity');
    });
   }
   public function down() : void {
    Schema::dropIfExists('meal_ingredient');
   }
};
