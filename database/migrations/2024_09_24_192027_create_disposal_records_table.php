<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up()
  {
    Schema::create('disposal_records', function (Blueprint $table) {
      $table->id();
      $table
        ->foreignId('waste_id')
        ->constrained('wastes')
        ->onDelete('cascade');
      $table->string('method');
      $table->date('disposal_date');
      $table->string('location');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('disposal_records');
  }
};
