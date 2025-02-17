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
        Schema::table('plans', function (Blueprint $table) {
            $table->dropColumn('duration');
            $table->integer('duration')->nullable()->after('price');
            $table->enum('duration_unit', ['day', 'week', 'month', 'year'])->nullable()->after('duration');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->dropColumn(['duration', 'duration_unit']);
            $table->integer('duration');
            $table->enum('duration_unit', ['day', 'week', 'month', 'year']);
        });
    }
};
