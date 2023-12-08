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
        if (!Schema::hasColumn('suppression_emails', 'supervisor')) {
            try {
                DB::statement("ALTER TABLE `suppression_emails` ADD `supervisor` INT(11) NULL DEFAULT NULL AFTER `user_id`;");
            } catch (\Exception $e) {
                Log::info("Error in up SupervisorFieldEmailSupression: ".$e->getMessage());  
            }
        }
        if (!Schema::hasColumn('suppression_domains', 'supervisor')) {
            try {
                DB::statement("ALTER TABLE `suppression_domains` ADD `supervisor` INT(11) NULL DEFAULT NULL AFTER `user_id`;");
            } catch (\Exception $e) {
                Log::info("Error in up SupervisorFieldEmailSupression: ".$e->getMessage());  
            }
        }
        $count = DB::table("application_settings")->where('setting_name','suppression_is_running')->count();
        if($count==0){
            DB::statement("INSERT INTO `application_settings` (`id`, `setting_name`, `setting_value`) VALUES(NULL, 'suppression_is_running', '0');");
        }
        $count = DB::table("application_settings")->where('setting_name','suppression_domain_id')->count();
        if($count==0){
            DB::statement("INSERT INTO `application_settings` (`id`, `setting_name`, `setting_value`) VALUES(NULL, 'suppression_domain_id', '0');");
        }
        
        
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('suppression_emails', 'supervisor')) {
            Schema::table('suppression_emails', function (Blueprint $table) {
                $table->dropColumn('supervisor');
            });
        }
        if (Schema::hasColumn('suppression_domains', 'supervisor')) {
            Schema::table('suppression_domains', function (Blueprint $table) {
                $table->dropColumn('supervisor');
            });
        }
        
        DB::table("application_settings")->where('setting_name','suppression_is_running')->delete();
        DB::table("application_settings")->where('setting_name','suppression_domain_id')->delete();
    }
}
;
