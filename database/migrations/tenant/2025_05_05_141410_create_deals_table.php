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
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('type_id')->nullable()->constrained();
            $table->foreignId('entity_id')->constrained('entities')->onDelete('cascade');
            $table->decimal('value', 12, 2)->nullable();
            $table->foreignId('status_id')->nullable()->constrained();
            $table->timestamps();
        });

        Schema::create('contact_deal', function (Blueprint $table) {
            $table->foreignId('deal_id')->constrained()->onDelete('cascade');
            $table->foreignId('contact_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_deal');
        Schema::dropIfExists('deals');
    }
};
