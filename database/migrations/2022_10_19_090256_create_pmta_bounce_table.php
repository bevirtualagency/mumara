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
        if (!Schema::hasTable('pmta_bounce')) {
            Schema::create('pmta_bounce', function (Blueprint $table) {
                $table->integer('file_id', true);
                $table->string('pmta_ip', 30)->nullable();
                $table->string('file_name', 200)->nullable();
                $table->integer('counter')->nullable();
            });
        }
        else {
            if (!Schema::hasColumn('pmta_bounce', 'file_id')) {
                Schema::table('pmta_bounce', function (Blueprint $table) {
                    $table->integer('file_id', true);
                });
            }
            if (!Schema::hasColumn('pmta_bounce', 'pmta_ip')) {
                Schema::table('pmta_bounce', function (Blueprint $table) {
                    $table->string('pmta_ip', 30)->nullable();
                });
            }
            if (!Schema::hasColumn('pmta_bounce', 'file_name')) {
                Schema::table('pmta_bounce', function (Blueprint $table) {
                    $table->string('file_name', 200)->nullable();
                });
            }
            if (!Schema::hasColumn('pmta_bounce', 'counter')) {
                Schema::table('pmta_bounce', function (Blueprint $table) {
                    $table->integer('counter')->nullable();
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('pmta_bounce');
    }

}
;
