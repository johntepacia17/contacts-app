<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('name', 120);
            $table->string('company', 120)->nullable();
            $table->string('email', 190)->nullable();
            $table->string('phone', 50)->nullable();

            $table->timestamps();

            $table->index(['user_id', 'name']);
            $table->index(['user_id', 'email']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
