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
        // Check if landingpage record exists before updating
        $exists = DB::table('builder_pages')->where('identifier', 'landingpage')->exists();

        if ($exists) {
            // Update landingpage builder to have edit_home_id = 1
            DB::table('builder_pages')
                ->where('identifier', 'landingpage')
                ->update(['edit_home_id' => 1]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Check if landingpage record exists before reverting
        $exists = DB::table('builder_pages')->where('identifier', 'landingpage')->exists();

        if ($exists) {
            // Revert landingpage builder edit_home_id to null
            DB::table('builder_pages')
                ->where('identifier', 'landingpage')
                ->update(['edit_home_id' => null]);
        }
    }
};