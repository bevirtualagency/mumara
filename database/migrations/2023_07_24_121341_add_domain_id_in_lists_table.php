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
        if (!Schema::hasColumn('lists', 'domain_id')) {
            Schema::table('lists', function (Blueprint $table) {
                $table->unsignedBigInteger('domain_id')->after('bounce_email_id')->nullable();
            });
        }

        DB::statement("INSERT INTO `tasks` (`user_id`, `thread_id`, `task_id`, `record_id`, `thread_number`, `task`, `type`, `status`, `value`, `data`, `response`, `attempts`, `priority`, `created_at`, `updated_at`, `start_time`, `is_running`, `end_time`) VALUES
                (2, NULL, NULL, 0, 1, 'updateliststable', 'command', 0, 'updateList:domain-id', '', NULL, 3, 1, NULL, NULL, NULL, 1, NULL);");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       
    }
};
