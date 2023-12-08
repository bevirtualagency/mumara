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
        try{
            DB::statement('ALTER TABLE `packages` CHANGE `sending_domains` `sending_domains` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `smtp_groups` `smtp_groups` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `bounce_emails` `bounce_emails` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `smtp_ids` `smtp_ids` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;');
        }catch (\Exception $e) {
            ///Log::info("Error in up CreateTableIndexes: ".$e->getMessage());  
        }
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        try {
            DB::statement('ALTER TABLE `packages` CHANGE `sending_domains` `sending_domains` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `smtp_groups` `smtp_groups` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `bounce_emails` `bounce_emails` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `smtp_ids` `smtp_ids` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;');
        } catch (\Exception $e) {
            ///Log::info("Error in up CreateTableIndexes: ".$e->getMessage());  
        }
    }
}
;
