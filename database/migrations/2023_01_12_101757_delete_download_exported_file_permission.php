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
        DB::statement("delete from permissions where id = 485;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("INSERT INTO `permissions` (`id`, `parent_id`, `default_title`, `title`, `is_available`, `sequence`, `route_type`, `route`, `skip_in_acl`, `hidden_in_acl`, `access_level`, `created_at`, `updated_at`) VALUES(485, 482, 'Download Exported Files', 'Download Exported Files', 1, 10000, 'web', 'suppression.export.download.csv', 0, 0, 'all', '2022-09-09 00:23:18', '2023-01-12 10:20:42');");
    }
}
;
