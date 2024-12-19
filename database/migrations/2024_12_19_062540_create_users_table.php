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
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('email')->unique();
      $table->string('username')->unique();
      $table->string('last_name')->index();
      $table->string('first_name')->index();
      $table->string('middle_name')->nullable();
      $table->string('password');
      $table->tinyInteger('is_active')->default(0);
      $table->integer('follow_count')->default(0);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('users');
  }
};
