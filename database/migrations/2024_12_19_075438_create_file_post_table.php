<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('file_post', function (Blueprint $table) {
      $table->id();
      $table->foreignId('file_id')->constrained(
        table: 'files'
      );
      $table->foreignId('post_id')->constrained(
        table: 'posts'
      );
      $table->tinyInteger('is_active')->default(0);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('file_post');
  }
};
