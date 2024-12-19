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
    Schema::create('follows', function (Blueprint $table) {
      $table->id();
      $table->foreignId('follower_id')->constrained(
        table: 'users'
      );
      $table->foreignId('followed_id')->constrained(
        table: 'users'
      );
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('follows');
  }
};
