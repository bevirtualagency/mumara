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
        if (!Schema::hasColumn('stats_pending', 'broadcast_id')) {
            Schema::table('stats_pending', function (Blueprint $table) {
                $table->Integer('broadcast_id')->after("user_id")->default(NULL);
            });
        }
        if (!Schema::hasColumn('stats_pending', 'sn_id')) {
            Schema::table('stats_pending', function (Blueprint $table) {
                $table->Integer('sn_id')->after("broadcast_id")->default(NULL);
            });
        }
        if (!Schema::hasColumn('stats_pending', 'sd_id')) {
            Schema::table('stats_pending', function (Blueprint $table) {
                $table->Integer('sd_id')->after("sn_id")->default(NULL);
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
        if (Schema::hasColumn('stats_pending', 'broadcast_id')) {
            Schema::table('stats_pending', function (Blueprint $table) {
                $table->dropColumn('broadcast_id');
            });
        } if (Schema::hasColumn('stats_pending', 'sn_id')) {
            Schema::table('stats_pending', function (Blueprint $table) {
                $table->dropColumn('sn_id');
            });
        } if (Schema::hasColumn('stats_pending', 'sn_id')) {
            Schema::table('stats_pending', function (Blueprint $table) {
                $table->dropColumn('sn_id');
            });
        }
    }
};
