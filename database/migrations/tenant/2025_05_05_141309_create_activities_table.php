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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('time');
            $table->integer('duration')->nullable(); // minutos
            $table->foreignId('entity_id')->nullable()->constrained('entities');
            $table->foreignId('type_id')->nullable()->constrained();
            $table->text('description')->nullable();
            $table->string('status')->default('scheduled');
            $table->timestamps();
        });

        Schema::create('activity_user', function (Blueprint $table) {
            $table->foreignId('activity_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('access')->default('view');
        });

        Schema::create('activity_contact', function (Blueprint $table) {
            $table->foreignId('activity_id')->constrained()->onDelete('cascade');
            $table->foreignId('contact_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_contact');
        Schema::dropIfExists('activity_user');
        Schema::dropIfExists('activities');
    }
};
