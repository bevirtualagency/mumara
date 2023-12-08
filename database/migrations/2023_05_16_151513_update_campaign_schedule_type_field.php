<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('campaign_schedules', 'type')) {
            DB::statement("ALTER TABLE `campaign_schedules` CHANGE `type` `type` ENUM('subscriber', 'segment', 'split_test', 'trigger','evergreen') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL;");
        }
        if (Schema::hasColumn('evergreen_campaigns', 'runs')) {
            DB::statement("ALTER TABLE `evergreen_campaigns` CHANGE `runs` `runs` INT NULL DEFAULT '0';");
        }
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
