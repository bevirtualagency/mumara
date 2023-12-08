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
        if (Schema::hasTable('email_bounced')) {
            if (!Schema::hasColumn('email_bounced', 'user_id')) {
                Schema::table('email_bounced', function (Blueprint $table) {
                    try {
                        DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update click Table', 'ALTER TABLE `email_bounced` ADD `user_id` INT(11) NULL AFTER `contact_id`;', '0', NULL);");
                        DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update click Table', 'update email_bounced join subscribers on email_bounced.contact_id = subscribers.id set email_bounced.user_id = subscribers.user_id where email_bounced.user_id is null', '0', NULL);");
                    } catch (\Exception $e) {
                        Log::info("Error in up CreateTableIndexes: ".$e->getMessage());  
                    }

                });
            }
        }
        //DB::statement("update email_bounced join subscribers on email_bounced.contact_id = subscribers.id set email_bounced.user_id = subscribers.user_id where email_bounced.user_id is null");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        if (Schema::hasColumn('email_bounced', 'user_id')) {
            Schema::table('email_bounced', function (Blueprint $table) {
                $table->dropColumn('user_id');
            });
        }
    }

}
;
