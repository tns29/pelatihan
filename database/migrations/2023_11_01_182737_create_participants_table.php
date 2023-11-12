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
        Schema::create('participants', function (Blueprint $table) {
            $table->char('code', 20)->primary();
            $table->string('fullname', 50);
            $table->char('username', 30)->unique('users_username_unique');
            $table->enum('gender', ["M", "F"]);
            $table->string('place_of_birth', 50)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('no_telp', 20)->nullable();
            $table->string('address')->nullable();
            $table->string('email', 100)->unique('users_email_unique');
            $table->string('password');
            $table->unsignedBigInteger('grade_id')->nullable(false);
            $table->foreign('grade_id')->on('grades')->references('id');
            $table->enum('is_active', ["Y", "N"])->default('N');
            $table->text('images')->nullable();
            $table->dateTime('created_on')->nullable()->default(date('Y-m-d H:i:s'));
            $table->string('created_by', 50)->nullable();
            $table->dateTime('updated_on')->nullable();
            $table->string('updated_by', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
