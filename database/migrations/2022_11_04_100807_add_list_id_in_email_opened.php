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
        if (!Schema::hasColumn('email_opened', 'list_id')) {
            try {
                DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update Open Table', 'ALTER TABLE `email_opened` ADD `list_id` INT(11) NULL DEFAULT NULL AFTER `contact_id`, ADD INDEX `list_id` (`list_id`);', '0', NULL);");
            } catch (\Exception $e) {
                Log::info("Error in up CreateTableIndexes: ".$e->getMessage());  
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        if (Schema::hasColumn('email_opened', 'list_id')) {
            Schema::table('email_opened', function (Blueprint $table) {
                $table->dropColumn('list_id');
            });
        }
    }
}
;
