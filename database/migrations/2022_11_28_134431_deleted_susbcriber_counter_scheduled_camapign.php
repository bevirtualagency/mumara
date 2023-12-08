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
        if (!Schema::hasColumn('statistics_summarys', 'deleted_susbcriber_count')) {
            Schema::table('statistics_summarys', function (Blueprint $table) {
                $table->Integer('deleted_susbcriber_count')->after("skipped")->default(0);
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
       if (Schema::hasColumn('statistics_summarys', 'deleted_susbcriber_count')) {
            Schema::table('statistics_summarys', function (Blueprint $table) {
                $table->dropColumn('deleted_susbcriber_count');
            });
        }
    }
}
;
