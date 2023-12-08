<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdInMultipleTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('statistics_summarys', 'user_id')) {
            Schema::table('statistics_summarys', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id')->after('id');
            });
        }
        if (!Schema::hasColumn('trigger_actions', 'user_id')) {
            Schema::table('trigger_actions', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id')->after('id');
            });
        }
        if (!Schema::hasColumn('broadcast_links', 'user_id')) {
            Schema::table('broadcast_links', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id')->after('id');
            });
        }


        if (!Schema::hasColumn('subscriber_additional_data', 'user_id')) {
            Schema::table('subscriber_additional_data', function (Blueprint $table) {
                try {
                    DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update click Table', 'ALTER TABLE `subscriber_additional_data` ADD `user_id` INT(11) NULL AFTER `id`;', '0', NULL);");
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
        
    }
}
