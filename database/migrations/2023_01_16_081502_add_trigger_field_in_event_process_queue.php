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
        if (!Schema::hasColumn('events_queue_process', 'trigger_id')) {
            Schema::table('events_queue_process', function (Blueprint $table) {
                $table->integer('trigger_id')->after("id")->nullable();  
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
        if (!Schema::hasColumn('events_queue_process', 'trigger_id')) {
            Schema::table('events_queue_process', function (Blueprint $table) {
                $table->dropColumn('trigger_id');
            });
        }
    }
}
;
