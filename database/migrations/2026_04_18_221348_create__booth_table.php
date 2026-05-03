<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
    Schema::create('booths', function (Blueprint $table) {
    $table->id();
    $table->string('location_description');
    $table->foreignId('publisher_id')->constrained()->cascadeOnDelete();
    $table->foreignId('hall_id')->constrained()->cascadeOnDelete();
    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('Booth');
    }
};