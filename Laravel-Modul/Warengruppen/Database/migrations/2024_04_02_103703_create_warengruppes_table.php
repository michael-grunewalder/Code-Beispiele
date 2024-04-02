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
        Schema::create('warengruppen', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('kunde_id')->nullable();
            $table->unsignedInteger('nummer')->nullable();
            $table->string('bezeichnung')->nullable();
            $table->integer('dk_main_cat')->nullable();
            $table->integer('dk_sub_cat')->nullable();
            $table->tinyInteger('type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warengruppen');
    }
};
