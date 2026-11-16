<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('book_id')->constrained('books')->cascadeOnDelete();
            $table->enum('status', ['pending', 'approved', 'rejected', 'dipinjam', 'dikembalikan'])->default('pending');
            $table->date('loan_date');
            $table->timestamp('approved_at')->nullable();
            $table->date('handed_over_at')->nullable();
            $table->date('due_date')->nullable();
            $table->date('returned_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};