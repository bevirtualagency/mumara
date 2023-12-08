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
        $table_name = "users";
        if (!Schema::hasColumn($table_name , 'application_domain')) {
            Schema::table($table_name, function (Blueprint $table) {
                $table->string('application_domain')->nullable();
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
        $table_name = "users";
        if (Schema::hasColumn($table_name , 'application_domain')) {
            Schema::table($table_name, function (Blueprint $table) {
                $table->dropColumn('application_domain');
            });
        }
    }
};
