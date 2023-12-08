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
        DB::statement("UPDATE `permissions` SET `access_level` = 'all' WHERE `permissions`.`id` = 485;");
        DB::statement("UPDATE `mainmenu` SET `is_view` = '1' WHERE `mainmenu`.`link` = 'campaign.evergreen.index';");
        DB::statement("UPDATE `mainmenu` SET `is_view` = '1' WHERE `mainmenu`.`link` = 'statistics.evergreen.index';");
        DB::statement("UPDATE `mainmenu` SET `routes` = 'broadcasts||broadcast/{id}/edit||broadcast/add||broadcast/add/{id}||broadcast/schedule||spintags||dynamictags||dynamictag/{id}/edit||drips||drips/*||drip/group/view||drip/group/{id}/edit||drip/group/add||drip/add||splittests||splittest/{id}/edit||splittest/add||schedule/new/*||spintag/add||dynamictag/add||scheduled||broadcasts/schedule||spintag/{id}/edit||broadcast/create/{id}||drip/{id}/edit||scheduled/{type?}||campaign/evergreen||campaign/evergreen/{id}||campaign/evergreen/edit/{id}' WHERE `mainmenu`.`id` = 3;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("UPDATE `permissions` SET `access_level` = 'super_admin' WHERE `permissions`.`id` = 48");
    }
}
;
