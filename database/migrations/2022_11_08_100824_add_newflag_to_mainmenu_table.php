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
        if (!Schema::hasColumn('mainmenu', 'new_flag')) {
            Schema::table('mainmenu', function (Blueprint $table) {
                $table->tinyInteger('new_flag')->after("is_view")->default(0);
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
        if (Schema::hasColumn('mainmenu', 'new_flag')) {
            Schema::table('mainmenu', function (Blueprint $table) {
                $table->dropColumn('new_flag');
            });
        }
    }
}
;
