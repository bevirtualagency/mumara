<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\UserCronSetting;

return new class extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        try {
            $result = DB::table("user_cron_settings")->where('cron_name', 'suppress_subscribers');
            if ($result->count() == 0) {
                UserCronSetting::insert(array(
                    'cron_name' => 'suppress_subscribers',
                    'cron_value' => 15,
                    'cron_time' => ''
                ));
            } else {
                UserCronSetting::where('cron_name', 'suppress_subscribers')->update(array(
                    'cron_name' => 'suppress_subscribers',
                    'cron_value' => 15,
                    'cron_time' => ''
                ));
            }
        } catch (\Exception $e) {
            Log::info("Error in up SuppressionCronSettings: " . $e->getMessage());
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
    }

}
;
