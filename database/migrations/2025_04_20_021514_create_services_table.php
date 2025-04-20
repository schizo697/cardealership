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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('service_ticket');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('customer_name')->nullable();
            $table->string('car');
            $table->string('service');
            $table->decimal('price', 10, 2);
            $table->string('assigned_mechanic');
            $table->foreignId('status_id')->constrained('statuses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
