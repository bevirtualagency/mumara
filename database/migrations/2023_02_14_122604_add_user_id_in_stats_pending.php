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
        if (!Schema::hasColumn('stats_pending', 'user_id')) {
            Schema::table('stats_pending', function (Blueprint $table) {
                $table->integer('user_id')->after("subscriber_id")->nullable();
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
        if (Schema::hasColumn('stats_pending', 'user_id')) {
            Schema::table('stats_pending', function (Blueprint $table) {
                $table->dropColumn('user_id');
            });
        }
    }
}
;
