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
        if (!Schema::hasColumn('email_clicked', 'is_duplicate')) {
            try {
                DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update Clicked Table', 'ALTER TABLE `email_clicked` ADD `is_duplicate` TINYINT(1) NULL DEFAULT NULL AFTER `is_bot`;', '0', NULL);");
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
        if (Schema::hasColumn('email_clicked', 'is_duplicate')) {
            Schema::table('email_clicked', function (Blueprint $table) {
                $table->dropColumn('is_duplicate');
            });
        }
    }
}
;
