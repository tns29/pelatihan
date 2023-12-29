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
            $table->char('participant_number')->nullable(false);
            $table->foreign('participant_number')->on('participants')->references('number');
            $table->unsignedBigInteger('training_id')->nullable(true);
            $table->foreign('training_id')->on('trainings')->references('id');
            $table->dateTime('date')->nullable(false);
            $table->enum('is_active', ["Y", "N"]); // FOR STATUS KELULUSAN, JIKA N TELAH LULUS, DEFAULT Y MASIH AKTIF PELATIHAN
            $table->enum('approve', ["Y", "N"])->nullable(); // Y APPROVED N REJECTED // DEFAULT NULL
            $table->dateTime('approval_on')->nullable();
            $table->string('approval_by', 50)->nullable();
            $table->enum('passed', ["Y", "N"])->nullable(); // Y LULUS N Tidak Lulus // DEFAULT NULL
            $table->dateTime('passed_on')->nullable();
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
