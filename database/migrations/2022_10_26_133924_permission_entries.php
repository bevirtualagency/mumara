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
        if(!(DB::table("permissions")->where("id" , 494)->exists())) 
            DB::statement("INSERT INTO permissions (id, parent_id, default_title, title, is_available, sequence, route_type, route, skip_in_acl, hidden_in_acl, access_level, created_at, updated_at) VALUES (494, '1', 'Templates', 'Templates', '1', '10000', 'web', 'templates.templates', '0', '0', 'all', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."')");
        DB::statement("UPDATE `permissions` SET `skip_in_acl` = '1', `is_available` = 0 WHERE `permissions`.`id` = 487;");
        DB::statement("UPDATE `permissions` SET `is_available` = '1', `access_level` = 'all'  WHERE `permissions`.`id` = 485;");
        DB::statement("UPDATE `permissions` SET `skip_in_acl` = '0' WHERE `permissions`.`id` = 278;");
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
}
;
