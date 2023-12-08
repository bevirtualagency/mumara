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
        if (!Schema::hasColumn('user_email_limits', 'contacts_limit')) {
            Schema::table('user_email_limits', function (Blueprint $table) {
                $table->Integer('contacts_limit')->after("user_id")->nullable()->default(NULL);
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
        if (Schema::hasColumn('user_email_limits', 'contacts_limit')) {
            Schema::table('user_email_limits', function (Blueprint $table) {
                $table->dropColumn('contacts_limit');
            });
        }
    }
}
;
