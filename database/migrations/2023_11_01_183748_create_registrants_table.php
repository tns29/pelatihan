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
        Schema::create('registrants', function (Blueprint $table) {
            $table->id();
            $table->char('participant_code')->nullable(false);
            $table->foreign('participant_code')->on('participants')->references('code');
            $table->dateTime('date')->nullable(false);
            $table->string('status', 1);
            $table->enum('is_active', ["Y", "N"]);
            $table->enum('paid', ["Y", "N"]);
            $table->dateTime('approval_on')->nullable();
            $table->string('approval_by', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrants');
    }
};
