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
        if (!Schema::hasColumn('alter_tables', 'execute_at')) {
            Schema::table('alter_tables', function (Blueprint $table) {
                $table->time('execute_at')->nullable();
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
        if (Schema::hasColumn('alter_tables', 'execute_at')) {
            Schema::table('alter_tables', function (Blueprint $table) {
                $table->dropColumn('execute_at');
            });
        }
    }
}
;
