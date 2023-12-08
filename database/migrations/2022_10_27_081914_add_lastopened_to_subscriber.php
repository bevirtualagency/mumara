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

       

        Schema::table('subscribers', function (Blueprint $table) {
            try {
                if (!Schema::hasColumn('subscribers', 'last_opened')) {
                    DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update Subscriber Table', 'ALTER TABLE `subscribers` ADD `last_opened` TIMESTAMP NULL DEFAULT NULL AFTER `user_id`, ADD INDEX `last_opened` (`last_opened`);', '0', NULL);");
                }
                
            } catch (\Exception $e) {
                Log::info("Error in up CreateTableIndexes: ".$e->getMessage());  
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscribers', function (Blueprint $table) {
            $table->dropIndex(['last_opened']);
            $table->dropColumn('last_opened');
        });
    }
}
;
