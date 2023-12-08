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
       if (!Schema::hasColumn('suppression_emails', 'md5')) {
                DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update suppression_emails table md5', 'ALTER TABLE  `suppression_emails` ADD `md5` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL after email;', '0', NULL);");
            }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('suppression_emails', 'md5')) {
            Schema::table('suppression_emails', function (Blueprint $table) {
                $table->dropColumn('md5');
            });
        }
    }
}
;
