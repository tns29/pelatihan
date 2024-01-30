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
        Schema::create('participant_works', function (Blueprint $table) {
            $table->id();
            $table->char('participant_number')->nullable(false);
            $table->foreign('participant_number')->on('participants')->references('number');
            $table->string('date_year', 10);
            $table->string('company_name', 100);
            $table->string('position', 50);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participant_works');
    }
};
