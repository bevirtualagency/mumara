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
        Schema::table('application_settings', function (Blueprint $table) {
            DB::statement("INSERT INTO `application_settings` (`setting_name`, `setting_value`) VALUES
            ( 'click_tracking', 'realtime'),
            ( 'open_tracking', 'realtime');");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('application_settings', function (Blueprint $table) {
            //
        });
    }
}
;
