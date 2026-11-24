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
        Schema::table('general_settings', function (Blueprint $table) {
            if (!Schema::hasColumn('general_settings', 'theme_color')) {
                $table->string('theme_color')->nullable()->default('#0088cc');
            }
            if (!Schema::hasColumn('general_settings', 'header_bg_color')) {
                $table->string('header_bg_color')->nullable()->default('#0088cc');
            }
            if (!Schema::hasColumn('general_settings', 'header_text_color')) {
                $table->string('header_text_color')->nullable()->default('#ffffff');
            }
            if (!Schema::hasColumn('general_settings', 'footer_bg_color')) {
                $table->string('footer_bg_color')->nullable()->default('#0b2c3d');
            }
            if (!Schema::hasColumn('general_settings', 'footer_text_color')) {
                $table->string('footer_text_color')->nullable()->default('#ffffff');
            }
            if (!Schema::hasColumn('general_settings', 'footer_bottom_color')) {
                $table->string('footer_bottom_color')->nullable()->default('#0088cc');
            }
            if (!Schema::hasColumn('general_settings', 'button_color')) {
                $table->string('button_color')->nullable()->default('#0088cc');
            }
            if (!Schema::hasColumn('general_settings', 'button_text_color')) {
                $table->string('button_text_color')->nullable()->default('#ffffff');
            }
            if (!Schema::hasColumn('general_settings', 'button_hover_color')) {
                $table->string('button_hover_color')->nullable()->default('#02527a');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('general_settings', function (Blueprint $table) {
            $table->dropColumn([
                'theme_color',
                'header_bg_color',
                'header_text_color',
                'footer_bg_color',
                'footer_text_color',
                'footer_bottom_color',
                'button_color',
                'button_text_color',
                'button_hover_color',
            ]);
        });
    }
};
