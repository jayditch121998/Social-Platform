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
    Schema::create('files', function (Blueprint $table) {
      $table->id();
      $table->string('original_file');
      $table->string('parsed_file_name');
      $table->string('parsed_file_location');
      $table->string('type')->index();
      $table->string('extension');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('files');
  }
};
