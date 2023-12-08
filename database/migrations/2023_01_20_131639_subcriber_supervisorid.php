<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        if (!Schema::hasColumn('subscribers', 'supervisor_id')) {
            DB::table('alter_tables')->insert([
                'name' => 'Update subscribers Table',
                'query' => 'ALTER TABLE `subscribers` ADD `supervisor_id` INT(11) NULL DEFAULT NULL AFTER `user_id`;',
                'status' => 0,
                'fields' => null,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        if (Schema::hasColumn('subscribers', 'supervisor_id')) {
            Schema::table('subscribers', function (Blueprint $table) {
                $table->dropColumn('supervisor_id');
            });
        }
    }

}
;
