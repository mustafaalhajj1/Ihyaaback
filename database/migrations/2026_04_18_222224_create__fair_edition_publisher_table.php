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
    Schema::create('fair_edition_publisher', function (Blueprint $table) {
    $table->foreignId('fair_edition_id')->constrained()->cascadeOnDelete();
    $table->foreignId('publisher_id')->constrained()->cascadeOnDelete();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fair_edition_publisher');
    }
};
