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
        Schema::create('fruit_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('fruit_category_id')->constrained('fruit_categories')->onDelete('cascade');;
            $table->string('unit');
            $table->integer('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fruit_items');
    }
};
