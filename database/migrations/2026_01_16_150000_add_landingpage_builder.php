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
        // Check if landingpage already exists
        $exists = DB::table('builder_pages')->where('identifier', 'landingpage')->exists();

        if (!$exists) {
            // Insert landingpage builder
            DB::table('builder_pages')->insert([
                'is_permanent' => 1,
                'edit_home_id' => 1,
                'identifier' => 'landingpage',
                'name' => '1001 Pioneer AI Landing',
                'html' => null,
                'status' => 0, // Not active by default
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            // Update existing record to ensure edit_home_id is set
            DB::table('builder_pages')
                ->where('identifier', 'landingpage')
                ->update([
                    'edit_home_id' => 1,
                    'updated_at' => now(),
                ]);
        }

        // Check if landingpage settings already exists
        $settingsExists = DB::table('home_page_settings')->where('key', 'landingpage')->exists();

        if (!$settingsExists) {
            // Insert landingpage settings
            $default_settings = [
                'hero_title' => '1001 Pioneer AI',
                'hero_subtitle' => 'Not Public. Built Quietly.',
                'hero_description' => "Halaman ini tidak dibuat untuk semua orang. Dan tidak bisa diakses selamanya!\nDan ga semua orang akan nyaman membacanya sampai selesai.\nJika kamu menemukannya,\nbesar kemungkinan kamu tidak sedang mencari kelas AI biasa.",
                'hero_image' => 'frontend/landingpage/img/image-1-dekstop.png',
                'about_title' => 'Tentang AI (yang jarang dibahas)',
                'about_intro' => "Hari ini semua orang bisa belajar AI.\nTool ada di mana-mana. Materi berlimpah.",
                'what_title' => 'Apa Itu 1001 AI Pioneers?',
                'what_intro' => '1001 AI Pioneers adalah sebuah ekosistem tertutup bagi individu yang ingin menggunakan AI sampai batas paling maksimalnya. Bukan untuk terlihat pintar.',
                'why_title' => 'Kenapa Terasa Berbeda?',
                'pricing' => 'Rp 199.000',
                'pricing_period' => 'Per bulan',
            ];

            DB::table('home_page_settings')->insert([
                'key' => 'landingpage',
                'value' => json_encode($default_settings),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('builder_pages')->where('identifier', 'landingpage')->delete();
        DB::table('home_page_settings')->where('key', 'landingpage')->delete();
    }
};