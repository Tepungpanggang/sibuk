<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->string('isbn')->nullable();
            $table->year('published_year')->nullable();
            $table->string('publisher')->nullable();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->foreignId('shelf_id')->constrained('shelves')->cascadeOnDelete();
            $table->unsignedInteger('stock')->default(0);
            $table->string('cover_path')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['tersedia', 'dipinjam', 'perbaikan'])->default('tersedia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};