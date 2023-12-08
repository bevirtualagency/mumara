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
        if (!Schema::hasColumn('user_email_limits', 'domains_limit')) {
            Schema::table('user_email_limits', function (Blueprint $table) {
                $table->Integer('domains_limit')->nullable();
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
        if (Schema::hasColumn('user_email_limits', 'domains_limit')) {
            Schema::table('user_email_limits', function (Blueprint $table) {
                $table->dropColumn('domains_limit');
            });
        }
    }
}
;
