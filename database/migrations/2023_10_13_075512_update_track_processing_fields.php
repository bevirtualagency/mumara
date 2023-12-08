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
        if (Schema::hasColumn('email_track_processing', 'sd_id')) {
            DB::statement("ALTER TABLE `email_track_processing` CHANGE `sd_id` `sd_id` BIGINT(20) UNSIGNED NULL DEFAULT NULL;");
       }
       if (Schema::hasColumn('email_track_processing', 'sn_id')) {
             DB::statement("ALTER TABLE `email_track_processing` CHANGE `sn_id` `sn_id` BIGINT(20) UNSIGNED NULL DEFAULT NULL;");
       }
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
};
