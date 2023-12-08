<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        if (Schema::hasColumn('campaign_schedules', 'status')) {
            Schema::table('campaign_schedules', function (Blueprint $table) {
                DB::statement("ALTER TABLE `campaign_schedules` CHANGE `status` `status` ENUM('processing','paused','complete','scheduled','scheduling','system paused','resumed','pausing','prepared','WaitingForResult','system pausing','running','StoppedByPolicy') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'processing';");
            });
        }
        if (!Schema::hasColumn('statistics_summarys', 'campaign_bounced')) {
            Schema::table('statistics_summarys', function (Blueprint $table) {
                $table->Integer('campaign_bounced')->default(0);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        if (Schema::hasColumn('statistics_summarys', 'campaign_bounced')) {
            Schema::table('statistics_summarys', function (Blueprint $table) {
                $table->dropColumn('campaign_bounced');
            });
        }
    }

}
;
