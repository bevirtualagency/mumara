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
        if (!Schema::hasColumn('user_email_limits', 'monthly_credits')) {
            DB::statement("ALTER TABLE `user_email_limits` CHANGE `monthly_credits` `monthly_credits` INT NULL DEFAULT NULL;");
            DB::statement("UPDATE `user_email_limits` SET `monthly_credits` = NULL WHERE `monthly_credits` = 0");
        }
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
;
