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
        Schema::table('reservations', function (Blueprint $table) {
            $table->date('start_date')->after('destination_id');
            $table->date('end_date')->after('start_date');
            $table->dropColumn('reserved_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(['start_date', 'end_date']); 
            $table->date('reserved_date')->after('destination_id'); 
        });
    }
};
