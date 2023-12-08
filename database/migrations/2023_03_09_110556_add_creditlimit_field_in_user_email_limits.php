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
            Schema::table('user_email_limits', function (Blueprint $table) {
                $table->Integer('monthly_credits')->after("contacts_limit")->nullable()->default(NULL);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('user_email_limits', 'monthly_credits')) {
            Schema::table('user_email_limits', function (Blueprint $table) {
                $table->dropColumn('monthly_credits');
            });
        }
    }
}
;
