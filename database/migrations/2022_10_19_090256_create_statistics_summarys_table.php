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
        if (!Schema::hasTable('statistics_summarys')) {
            Schema::create('statistics_summarys', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('campaign_schedule_id')->unique('campaign_schedule_id_unique');
                $table->bigInteger('opens')->nullable()->default(0);
                $table->bigInteger('unique_opens')->nullable()->default(0);
                $table->bigInteger('clicked')->nullable()->default(0);
                $table->bigInteger('unique_clicked')->nullable()->default(0);
                $table->bigInteger('processed')->nullable()->default(0);
                $table->bigInteger('unsubscribed')->nullable()->default(0);
                $table->bigInteger('bounced')->nullable()->default(0);
                $table->integer('delivered')->default(0);
                $table->integer('not_confirmed')->nullable()->default(0);
                $table->integer('suppressed')->nullable()->default(0);
                $table->integer('suppressed_domains')->nullable()->default(0);
                $table->integer('duplicate')->default(0);
                $table->integer('skipped')->default(0);
                $table->integer('in_active')->nullable()->default(0);
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else {
            if (!Schema::hasColumn('statistics_summarys', 'id')) {
                Schema::table('statistics_summarys', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('statistics_summarys', 'campaign_schedule_id')) {
                Schema::table('statistics_summarys', function (Blueprint $table) {
                    $table->integer('campaign_schedule_id')->unique('campaign_schedule_id_unique');
                });
            }
            if (!Schema::hasColumn('statistics_summarys', 'opens')) {
                Schema::table('statistics_summarys', function (Blueprint $table) {
                    $table->bigInteger('opens')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('statistics_summarys', 'unique_opens')) {
                Schema::table('statistics_summarys', function (Blueprint $table) {
                    $table->bigInteger('unique_opens')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('statistics_summarys', 'clicked')) {
                Schema::table('statistics_summarys', function (Blueprint $table) {
                    $table->bigInteger('clicked')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('statistics_summarys', 'unique_clicked')) {
                Schema::table('statistics_summarys', function (Blueprint $table) {
                    $table->bigInteger('unique_clicked')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('statistics_summarys', 'processed')) {
                Schema::table('statistics_summarys', function (Blueprint $table) {
                    $table->bigInteger('processed')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('statistics_summarys', 'unsubscribed')) {
                Schema::table('statistics_summarys', function (Blueprint $table) {
                    $table->bigInteger('unsubscribed')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('statistics_summarys', 'bounced')) {
                Schema::table('statistics_summarys', function (Blueprint $table) {
                    $table->bigInteger('bounced')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('statistics_summarys', 'delivered')) {
                Schema::table('statistics_summarys', function (Blueprint $table) {
                    $table->integer('delivered')->default(0);
                });
            }
            if (!Schema::hasColumn('statistics_summarys', 'not_confirmed')) {
                Schema::table('statistics_summarys', function (Blueprint $table) {
                    $table->integer('not_confirmed')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('statistics_summarys', 'suppressed')) {
                Schema::table('statistics_summarys', function (Blueprint $table) {
                    $table->integer('suppressed')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('statistics_summarys', 'suppressed_domains')) {
                Schema::table('statistics_summarys', function (Blueprint $table) {
                    $table->integer('suppressed_domains')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('statistics_summarys', 'duplicate')) {
                Schema::table('statistics_summarys', function (Blueprint $table) {
                    $table->integer('duplicate')->default(0);
                });
            }
            if (!Schema::hasColumn('statistics_summarys', 'skipped')) {
                Schema::table('statistics_summarys', function (Blueprint $table) {
                    $table->integer('skipped')->default(0);
                });
            }
            if (!Schema::hasColumn('statistics_summarys', 'in_active')) {
                Schema::table('statistics_summarys', function (Blueprint $table) {
                    $table->integer('in_active')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('statistics_summarys', 'created_at')) {
                Schema::table('statistics_summarys', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('statistics_summarys', 'updated_at')) {
                Schema::table('statistics_summarys', function (Blueprint $table) {
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
        Schema::dropIfExists('statistics_summarys');
    }

}
;
