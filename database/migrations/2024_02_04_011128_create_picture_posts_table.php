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
        Schema::create('picture_posts', function (Blueprint $table) {
            $table->id();
            $table->integer('post_id')->nullable('false');
            $table->text('image')->nullable();
            $table->dateTime('created_at')->nullable()->default(date('Y-m-d H:i:s'));
            $table->string('created_by', 50)->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->string('updated_by', 50)->nullable();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('picture_posts');
    }
};
