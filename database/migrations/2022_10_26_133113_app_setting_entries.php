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
        DB::statement("UPDATE `application_settings` SET `setting_value` = '1000' WHERE `application_settings`.`setting_name` = 'segment_chunk_size';");
        DB::statement("UPDATE `application_settings` SET `setting_value` = '500' WHERE `application_settings`.`setting_name` = 'sleep_between_two_chunk_size';");
        DB::statement("UPDATE `application_settings` SET `setting_value` = '-1' WHERE `application_settings`.`setting_name` = 'contacts_limit';");
        DB::statement("UPDATE `application_settings` SET `setting_value` = '48' WHERE `application_settings`.`setting_name` = 'delete_export_file_after_days';");        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
;
