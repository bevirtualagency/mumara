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
        if (!Schema::hasColumn('suppression_emails', 'is_admin')) {
            try {
                DB::statement("ALTER TABLE `suppression_emails` ADD `is_admin` TINYINT(1) NOT NULL DEFAULT '0' AFTER `user_id`;");
            } catch (\Exception $e) {
                Log::info("Error in up SuppressionIsAdminField: ".$e->getMessage());  
            }
        }
        if (!Schema::hasColumn('suppression_domains', 'is_admin')) {
            try {
                DB::statement("ALTER TABLE `suppression_domains` ADD `is_admin` TINYINT(1) NOT NULL DEFAULT '0' AFTER `user_id`;");
            } catch (\Exception $e) {
                Log::info("Error in up SuppressionIsAdminField: ".$e->getMessage());  
            }
        }
        
        //ALTER TABLE `suppression_domains` ADD `is_admin` TINYINT NULL DEFAULT NULL AFTER `user_id`;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('suppression_emails', 'is_admin')) {
            Schema::table('suppression_emails', function (Blueprint $table) {
                $table->dropColumn('is_admin');
            });
        }
        if (Schema::hasColumn('suppression_domains', 'is_admin')) {
            Schema::table('suppression_domains', function (Blueprint $table) {
                $table->dropColumn('is_admin');
            });
        }
    }
}
;
