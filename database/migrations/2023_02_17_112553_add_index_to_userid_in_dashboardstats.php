<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('dashboard_stats')) {
            Schema::table('dashboard_stats', function (Blueprint $table) {
                DB::statement("ALTER TABLE `dashboard_stats` ADD INDEX(`user_id`);");
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('dashboard_stats')) {
            Schema::table('dashboard_stats', function (Blueprint $table) {
                
            });
        }
    }
}
;
