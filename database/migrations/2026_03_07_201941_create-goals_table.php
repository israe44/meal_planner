<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('goals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['weight_loss', 'muscle_gain', 'maintenance']);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('goals');
    }
};
