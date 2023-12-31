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
        if (!Schema::hasTable('stats_devices')) {
            Schema::create('stats_devices', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('user_id');
                $table->dateTime('start_date')->nullable();
                $table->dateTime('end_date')->nullable();
                $table->integer('mobile')->default(0);
                $table->integer('desktop')->default(0);
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else {
            if (!Schema::hasColumn('stats_devices', 'id')) {
                Schema::table('stats_devices', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('stats_devices', 'user_id')) {
                Schema::table('stats_devices', function (Blueprint $table) {
                    $table->integer('user_id');
                });
            }
            if (!Schema::hasColumn('stats_devices', 'start_date')) {
                Schema::table('stats_devices', function (Blueprint $table) {
                    $table->dateTime('start_date')->nullable();
                });
            }
            if (!Schema::hasColumn('stats_devices', 'end_date')) {
                Schema::table('stats_devices', function (Blueprint $table) {
                    $table->dateTime('end_date')->nullable();
                });
            }
            if (!Schema::hasColumn('stats_devices', 'mobile')) {
                Schema::table('stats_devices', function (Blueprint $table) {
                    $table->integer('mobile')->default(0);
                });
            }
            if (!Schema::hasColumn('stats_devices', 'desktop')) {
                Schema::table('stats_devices', function (Blueprint $table) {
                    $table->integer('desktop')->default(0);
                });
            }
            if (!Schema::hasColumn('stats_devices', 'created_at')) {
                Schema::table('stats_devices', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }

            if (!Schema::hasColumn('stats_devices', 'updated_at')) {
                Schema::table('stats_devices', function (Blueprint $table) {
                   $table->timestamp('updated_at')->useCurrentOnUpdate();
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
        Schema::dropIfExists('stats_devices');
    }

}
;
