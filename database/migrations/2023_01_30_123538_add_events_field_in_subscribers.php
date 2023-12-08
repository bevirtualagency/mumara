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
        if (!Schema::hasColumn('subscribers', 'events')) {
            Schema::table('subscribers', function (Blueprint $table) {  
                DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update Open Table', 'ALTER TABLE `subscribers` ADD `events` TEXT NULL AFTER `last_opened`;', '0', NULL);");
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
        if (!Schema::hasColumn('subscribers', 'events')) {
            Schema::table('subscribers', function (Blueprint $table) {
                $table->dropColumn('events');
            });
        }
    }
}
;
