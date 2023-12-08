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
        if (!Schema::hasTable('stats_broadcasts')) {
            Schema::create('stats_broadcasts', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('user_id');
                $table->dateTime('start_date')->nullable();
                $table->dateTime('end_date')->nullable();
                $table->string('extracted', 255)->nullable();
                $table->integer('delivered')->default(0);
                $table->integer('total_sent')->default(0);
                $table->integer('total_bounced')->default(0);
                $table->integer('total_opened')->default(0);
                $table->integer('total_clicked')->default(0);
                $table->integer('total_spammed')->default(0);
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else {
            if (!Schema::hasColumn('stats_broadcasts', 'id')) {
                Schema::table('stats_broadcasts', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('stats_broadcasts', 'user_id')) {
                Schema::table('stats_broadcasts', function (Blueprint $table) {
                    $table->integer('user_id');
                });
            }
            if (!Schema::hasColumn('stats_broadcasts', 'start_date')) {
                Schema::table('stats_broadcasts', function (Blueprint $table) {
                    $table->dateTime('start_date')->nullable();
                });
            }
            if (!Schema::hasColumn('stats_broadcasts', 'end_date')) {
                Schema::table('stats_broadcasts', function (Blueprint $table) {
                    $table->dateTime('end_date')->nullable();
                });
            }
            if (!Schema::hasColumn('stats_broadcasts', 'extracted')) {
                Schema::table('stats_broadcasts', function (Blueprint $table) {
                    $table->string('extracted', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('stats_broadcasts', 'delivered')) {
                Schema::table('stats_broadcasts', function (Blueprint $table) {
                    $table->integer('delivered')->default(0);
                });
            }
            if (!Schema::hasColumn('stats_broadcasts', 'total_sent')) {
                Schema::table('stats_broadcasts', function (Blueprint $table) {
                    $table->integer('total_sent')->default(0);
                });
            }
            if (!Schema::hasColumn('stats_broadcasts', 'total_bounced')) {
                Schema::table('stats_broadcasts', function (Blueprint $table) {
                    $table->integer('total_bounced')->default(0);
                });
            }
            if (!Schema::hasColumn('stats_broadcasts', 'total_opened')) {
                Schema::table('stats_broadcasts', function (Blueprint $table) {
                    $table->integer('total_opened')->default(0);
                });
            }
            if (!Schema::hasColumn('stats_broadcasts', 'total_clicked')) {
                Schema::table('stats_broadcasts', function (Blueprint $table) {
                    $table->integer('total_clicked')->default(0);
                });
            }
            if (!Schema::hasColumn('stats_broadcasts', 'total_spammed')) {
                Schema::table('stats_broadcasts', function (Blueprint $table) {
                    $table->integer('total_spammed')->default(0);
                });
            }
            if (!Schema::hasColumn('stats_broadcasts', 'created_at')) {
                Schema::table('stats_broadcasts', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('stats_broadcasts', 'updated_at')) {
                Schema::table('stats_broadcasts', function (Blueprint $table) {
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
        Schema::dropIfExists('stats_broadcasts');
    }

}
;
