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
        if (!Schema::hasColumn('email_clicked', 'user_id')) {
            Schema::table('email_clicked', function (Blueprint $table) {
                try {
                    DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update click Table', 'ALTER TABLE `email_clicked` ADD `user_id` INT(11) NULL AFTER `contact_id`;', '0', NULL);");
                } catch (\Exception $e) {
                    Log::info("Error in up CreateTableIndexes: ".$e->getMessage());  
                }
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
        if (Schema::hasColumn('email_clicked', 'user_id')) {
            Schema::table('email_clicked', function (Blueprint $table) {
                    $table->dropColumn('user_id');
            });
        }
    }
}
;
