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
        $table_name = "user_email_limits";
        if (!Schema::hasColumn($table_name, 'total_bounced_hard') and Schema::hasColumn($table_name, 'bounced')) {
            Schema::table($table_name, function (Blueprint $table) {
                $table->integer('total_bounced_hard')->after("bounced");
            });
        }
        if (!Schema::hasColumn($table_name, 'total_bounced_hard') and Schema::hasColumn($table_name, 'total_bounced')) {
            Schema::table($table_name, function (Blueprint $table) {
                $table->integer('total_bounced_hard')->after("total_bounced");
            });
        }

        if (!Schema::hasColumn($table_name, 'total_bounced_soft')) {
            Schema::table($table_name, function (Blueprint $table) {
                $table->integer('total_bounced_soft')->after("total_bounced_hard");
            });
        }
        if (!Schema::hasColumn($table_name, 'bounced_hard_this_month')) {
            Schema::table($table_name, function (Blueprint $table) {
                $table->integer('bounced_hard_this_month')->after("bounced_this_month");
            });
        }
        if (!Schema::hasColumn($table_name, 'bounced_soft_this_month')) {
            Schema::table($table_name, function (Blueprint $table) {
                $table->integer('bounced_soft_this_month')->after("bounced_hard_this_month");
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
        $table_name = "user_email_limits";
        if (Schema::hasColumn($table_name, 'bounced_hard')) {
            Schema::table($table_name, function (Blueprint $table) {
                $table->drop('bounced_hard');
            });
        }

        if (Schema::hasColumn($table_name, 'bounced_soft')) {
            Schema::table($table_name, function (Blueprint $table) {
                $table->drop('bounced_soft');
            });
        }
        if (Schema::hasColumn($table_name, 'bounced_hard_this_month')) {
            Schema::table($table_name, function (Blueprint $table) {
                $table->drop('bounced_hard_this_month');
            });
        }
        if (Schema::hasColumn($table_name, 'bounced_soft_this_month')) {
            Schema::table($table_name, function (Blueprint $table) {
                $table->drop('bounced_soft_this_month');
            });
        }
    }
};
