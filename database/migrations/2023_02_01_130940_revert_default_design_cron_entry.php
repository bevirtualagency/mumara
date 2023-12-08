<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('tasks')->insert(array(
            "user_id" => 2,
            "value" => "revert:defaultDesigns",
            "record_id" => 1,
            "data" => "",
            "type" => "command",
            "priority" => 1,
            "thread_number" => 1,
            "task" => "default_design",
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
;
