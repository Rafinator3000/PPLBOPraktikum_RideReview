<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('attraction_id')->constrained()->onDelete('cascade');
            $table->integer('fun_rating');
            $table->integer('safety_rating');
            $table->integer('value_rating');
            $table->text('comment')->nullable();
            $table->timestamps();

            // Ensure one review per user per attraction
            $table->unique(['user_id', 'attraction_id']);
            $table->index(['attraction_id']);
            $table->index(['user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
