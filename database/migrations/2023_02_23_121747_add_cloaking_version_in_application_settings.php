<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        $count = DB::table('application_settings')->where('setting_name', 'cloaking_version')->count();
        if ($count == 0) {
            Schema::table('application_settings', function (Blueprint $table) {
                DB::statement("INSERT INTO `application_settings` (`setting_name`, `setting_value`) VALUES ('cloaking_version', '1.0');");
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        $count = DB::table('application_settings')->where('setting_name', 'cloaking_version')->count();
        if ($count > 0) {
            DB::table('application_settings')->where('setting_name', 'cloaking_version')->delete();
        }
    }

}
;
