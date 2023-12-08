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
        DB::statement("UPDATE `application_settings` SET `setting_value` = 'Application' WHERE `application_settings`.`setting_name` = 'title' AND `application_settings`.`setting_value` = 'Mumara';");
        DB::statement("UPDATE `application_settings` SET `setting_value` = 'Application' WHERE `application_settings`.`setting_name` = 'login_title' AND `application_settings`.`setting_value` = 'Mumara Email Login';");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       
    }
};
