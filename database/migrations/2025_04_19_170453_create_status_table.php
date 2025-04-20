<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        DB::table('statuses')->insert([
            ['name' => 'Unavailable'],
            ['name' => 'Available'],
            ['name' => 'Active'],
            ['name' => 'Inactive'],
            ['name' => 'Pending'],
            ['name' => 'Paid'],
            ['name' => 'Cancelled'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status');
    }
};
