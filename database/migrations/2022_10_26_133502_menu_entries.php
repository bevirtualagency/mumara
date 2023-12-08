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
        DB::statement("DELETE FROM `mainmenu` WHERE link = 'templates.templates';"); 
        DB::statement("UPDATE `mainmenu` SET `routes` = 'broadcasts||broadcast/{id}/edit||broadcast/add||broadcast/add/{id}||broadcast/schedule||spintags||dynamictags||dynamictag/{id}/edit||drips||drips/*||drip/group/view||drip/group/{id}/edit||drip/group/add||drip/add||splittests||splittest/{id}/edit||splittest/add||schedule/new/*||spintag/add||dynamictag/add||scheduled||broadcasts/schedule||spintag/{id}/edit||broadcast/create/{id}||drip/{id}/edit||scheduled/{type?}||broadcast/templates/select' WHERE `mainmenu`.`id` = 3;");
        DB::statement("UPDATE `mainmenu` SET `routes` = 'broadcasts||broadcast/{id}/edit||broadcast/add||broadcast/add/{id}||broadcast/templates/select' WHERE `mainmenu`.`id` = 22;");
        DB::statement("INSERT INTO `mainmenu` (`id`, `parent_id`, `module_name`, `routes`, `link`, `sequence`, `permission`, `icons`, `type`, `is_view`) VALUES (NULL, '5', 'templates.page.title', 'broadcast/templates||broadcast/templates/marketplace', 'templates.templates', '10', '494', 'kt-menu__link-bullet kt-menu__link-bullet--dot', '1', '1');");
        DB::statement("UPDATE `mainmenu` SET `routes` = 'bounce/mailbox/{id}/edit||bounce/mailboxes||bounce/rule/{id}/edit||bounce/rules||domain/{id}/edit||domains||node/{type}/{id}/edit||nodes||form/{id}/edit||forms||fbls||staff/role/*||staff/role||staff/*||staff/roles||staff/role/add||staff/administrators||threads/*||bounce/mailbox/add||bounce/rule/add||domain/add||node/list/view||pmta/integration/create||fbl/add||staff/administrator/add||threads||node/add/{id}||pmta/config/view/{id}||form/add/{design_id?}||fbl/{id}/edit||staff/administrator/{staff}/edit||threads/{id?}||staff/role/{id}/edit||setup/processed-fbls/{id?}||node/{id}/add||staff/administrator/{id}/edit||addons/all||node/add||node/{id}/edit||view-web-form-designs||create-web-form-design/{id?}||forms/template||broadcast/templates||broadcast/templates/marketplace' WHERE `mainmenu`.`id` = 5;");
        DB::statement("UPDATE `mainmenu` SET `permission` = '494' WHERE link = 'templates.templates';");
        DB::statement("UPDATE `mainmenu` SET `routes` = 'broadcasts||broadcast/{id}/edit||broadcast/add||broadcast/add/{id}||broadcast/schedule||spintags||dynamictags||dynamictag/{id}/edit||drips||drips/*||drip/group/view||drip/group/{id}/edit||drip/group/add||drip/add||splittests||splittest/{id}/edit||splittest/add||schedule/new/*||spintag/add||dynamictag/add||scheduled||broadcasts/schedule||spintag/{id}/edit||broadcast/create/{id}||drip/{id}/edit||scheduled/{type?}||broadcast/templates/select||broadcast/add-new' WHERE `mainmenu`.`id` = 3;");
        DB::statement("UPDATE `mainmenu` SET `routes` = 'broadcasts||broadcast/{id}/edit||broadcast/add||broadcast/add/{id}||broadcast/templates/select||broadcast/add-new' WHERE `mainmenu`.`id` = 22;");
               
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       DB::statement("DELETE FROM `mainmenu` WHERE link = 'templates.templates';");
    }
}
;
