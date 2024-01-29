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
        Schema::create('datasets', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->integer('id_subject_area');
            $table->string('name');
            $table->text('abstract');
            $table->integer('instances');
            $table->integer('features');
            $table->text('information');
            $table->enum('status', ['pending', 'valid', 'invalid'])->default('pending');
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datasets');
    }
};
