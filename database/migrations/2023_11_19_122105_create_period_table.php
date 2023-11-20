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
        Schema::create('period', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('training_id')->nullable(false);
            $table->foreign('training_id')->on('trainings')->references('id');
            $table->year('graduation_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('period');
    }
};
