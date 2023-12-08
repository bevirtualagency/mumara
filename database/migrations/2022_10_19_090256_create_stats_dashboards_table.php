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
        if (!Schema::hasTable('stats_dashboards')) {
            Schema::create('stats_dashboards', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('user_id');
                $table->integer('total_sent')->default(0);
                $table->integer('total_opened')->default(0);
                $table->integer('total_clicked')->default(0);
                $table->integer('total_lists')->default(0);
                $table->integer('total_campaigns')->default(0);
                $table->integer('total_contacts')->default(0);
                $table->integer('total_triggers')->default(0);
                $table->integer('total_smtps')->default(0);
                $table->integer('total_sending_domains')->default(0);
                $table->integer('total_campaign_schedules')->default(0);
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else {
            if (!Schema::hasColumn('stats_dashboards', 'id')) {
                Schema::table('stats_dashboards', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('stats_dashboards', 'user_id')) {
                Schema::table('stats_dashboards', function (Blueprint $table) {
                    $table->integer('user_id');
                });
            }
            if (!Schema::hasColumn('stats_dashboards', 'total_sent')) {
                Schema::table('stats_dashboards', function (Blueprint $table) {
                    $table->integer('total_sent')->default(0);
                });
            }
            if (!Schema::hasColumn('stats_dashboards', 'total_opened')) {
                Schema::table('stats_dashboards', function (Blueprint $table) {
                    $table->integer('total_opened')->default(0);
                });
            }
            if (!Schema::hasColumn('stats_dashboards', 'total_clicked')) {
                Schema::table('stats_dashboards', function (Blueprint $table) {
                    $table->integer('total_clicked')->default(0);
                });
            }
            if (!Schema::hasColumn('stats_dashboards', 'total_lists')) {
                Schema::table('stats_dashboards', function (Blueprint $table) {
                    $table->integer('total_lists')->default(0);
                });
            }
            if (!Schema::hasColumn('stats_dashboards', 'total_campaigns')) {
                Schema::table('stats_dashboards', function (Blueprint $table) {
                    $table->integer('total_campaigns')->default(0);
                });
            }
            if (!Schema::hasColumn('stats_dashboards', 'total_contacts')) {
                Schema::table('stats_dashboards', function (Blueprint $table) {
                    $table->integer('total_contacts')->default(0);
                });
            }
            if (!Schema::hasColumn('stats_dashboards', 'total_triggers')) {
                Schema::table('stats_dashboards', function (Blueprint $table) {
                    $table->integer('total_triggers')->default(0);
                });
            }
            if (!Schema::hasColumn('stats_dashboards', 'total_smtps')) {
                Schema::table('stats_dashboards', function (Blueprint $table) {
                    $table->integer('total_smtps')->default(0);
                });
            }
            if (!Schema::hasColumn('stats_dashboards', 'total_sending_domains')) {
                Schema::table('stats_dashboards', function (Blueprint $table) {
                    $table->integer('total_sending_domains')->default(0);
                });
            }
            if (!Schema::hasColumn('stats_dashboards', 'total_campaign_schedules')) {
                Schema::table('stats_dashboards', function (Blueprint $table) {
                    $table->integer('total_campaign_schedules')->default(0);
                });
            }
            if (!Schema::hasColumn('stats_dashboards', 'created_at')) {
                Schema::table('stats_dashboards', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('stats_dashboards', 'updated_at')) {
                Schema::table('stats_dashboards', function (Blueprint $table) {
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
        Schema::dropIfExists('stats_dashboards');
    }

}
;
