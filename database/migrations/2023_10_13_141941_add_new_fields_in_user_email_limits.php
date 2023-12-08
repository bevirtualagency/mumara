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
        if (Schema::hasColumn("user_email_limits", 'trans_opened')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('trans_opened', 'trans_opens');
            });
        }

        if (Schema::hasColumn("user_email_limits", 'trans_clicked')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('trans_clicked', 'trans_clicks');
            });
        }


        if (Schema::hasColumn($table_name, 'trans_opens') and !Schema::hasColumn($table_name, 'trans_opens_this_month')) {
            Schema::table($table_name, function (Blueprint $table) {
                $table->integer('trans_opens_this_month')->after("trans_opens");
            });
        }

        if (Schema::hasColumn($table_name, 'trans_clicks') and !Schema::hasColumn($table_name, 'trans_clicks_this_month')) {
            Schema::table($table_name, function (Blueprint $table) {
                $table->integer('trans_clicks_this_month')->after("trans_clicks");
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

        if (Schema::hasColumn("user_email_limits", 'trans_opens')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('trans_opens', 'trans_opened');
            });
        }
        if (Schema::hasColumn("user_email_limits", 'trans_clicks')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('trans_clicks', 'trans_clicked');
            });
        }

        if (Schema::hasColumn("user_email_limits", 'trans_opens_this_month')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->dropColumn('trans_opens_this_month');
            });
        }
        if (Schema::hasColumn("user_email_limits", 'trans_clicks_this_month')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->dropColumn('trans_clicks_this_month');
            });
        }

       
    }
};
