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
        if (!Schema::hasTable('trigger_tasks')) {
            Schema::create('trigger_tasks', function (Blueprint $table) {
                $table->bigInteger('id', true);
                $table->integer('process_id')->nullable();
                $table->dateTime('last_activity')->nullable();
                $table->dateTime('created_at')->nullable()->useCurrent();
            });
        }
        else {
            if (!Schema::hasColumn('trigger_tasks', 'id')) {
                Schema::table('trigger_tasks', function (Blueprint $table) {
                    $table->bigInteger('id', true);
                });
            }
            if (!Schema::hasColumn('trigger_tasks', 'process_id')) {
                Schema::table('trigger_tasks', function (Blueprint $table) {
                    $table->integer('process_id')->nullable();
                });
            }
            if (!Schema::hasColumn('trigger_tasks', 'last_activity')) {
                Schema::table('trigger_tasks', function (Blueprint $table) {
                    $table->dateTime('last_activity')->nullable();
                });
            }
            if (!Schema::hasColumn('trigger_tasks', 'created_at')) {
                Schema::table('trigger_tasks', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
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
        Schema::dropIfExists('trigger_tasks');
    }

}
;
