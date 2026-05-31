<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attractions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('type')->nullable();  // e.g., "roller coaster", "dark ride"
            $table->string('safety_status')->default('safe');  // safe, under_review, closed
            $table->decimal('avg_fun_rating', 5, 2)->default(0);
            $table->decimal('avg_safety_rating', 5, 2)->default(0);
            $table->decimal('avg_value_rating', 5, 2)->default(0);
            $table->integer('review_count')->default(0);
            $table->timestamps();

            $table->index('location_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attractions');
    }
};
