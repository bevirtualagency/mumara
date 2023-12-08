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
        if (!Schema::hasTable('dashboard_stats')) {
            Schema::create('dashboard_stats', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('user_id');
                $table->dateTime('start_date')->nullable();
                $table->dateTime('end_date')->nullable()->index('end_date');
                $table->integer('sent')->nullable()->default(0);
                $table->integer('delivered')->nullable()->default(0);
                $table->integer('bounced')->nullable()->default(0);
                $table->integer('spammed')->nullable()->default(0);
                $table->integer('opened')->nullable()->default(0);
                $table->integer('clicked')->nullable()->default(0);
                $table->integer('unsubscribed')->nullable()->default(0);
                $table->dateTime('created_at')->nullable()->index('created_at');
            });
        }
        else {
            if (!Schema::hasColumn('dashboard_stats', 'id')) {
                Schema::table('dashboard_stats', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('dashboard_stats', 'user_id')) {
                Schema::table('dashboard_stats', function (Blueprint $table) {
                    $table->integer('user_id');
                });
            }
            if (!Schema::hasColumn('dashboard_stats', 'start_date')) {
                Schema::table('dashboard_stats', function (Blueprint $table) {
                    $table->dateTime('start_date')->nullable();
                });
            }
            if (!Schema::hasColumn('dashboard_stats', 'end_date')) {
                Schema::table('dashboard_stats', function (Blueprint $table) {
                    $table->dateTime('end_date')->nullable()->index('end_date');
                });
            }
            if (!Schema::hasColumn('dashboard_stats', 'sent')) {
                Schema::table('dashboard_stats', function (Blueprint $table) {
                    $table->integer('sent')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('dashboard_stats', 'delivered')) {
                Schema::table('dashboard_stats', function (Blueprint $table) {
                    $table->integer('delivered')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('dashboard_stats', 'bounced')) {
                Schema::table('dashboard_stats', function (Blueprint $table) {
                    $table->integer('bounced')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('dashboard_stats', 'spammed')) {
                Schema::table('dashboard_stats', function (Blueprint $table) {
                    $table->integer('spammed')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('dashboard_stats', 'opened')) {
                Schema::table('dashboard_stats', function (Blueprint $table) {
                    $table->integer('opened')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('dashboard_stats', 'clicked')) {
                Schema::table('dashboard_stats', function (Blueprint $table) {
                    $table->integer('clicked')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('dashboard_stats', 'unsubscribed')) {
                Schema::table('dashboard_stats', function (Blueprint $table) {
                    $table->integer('unsubscribed')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('dashboard_stats', 'created_at')) {
                Schema::table('dashboard_stats', function (Blueprint $table) {
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
        Schema::dropIfExists('dashboard_stats');
    }

}
;
