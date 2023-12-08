<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        if (!Schema::hasTable('user_email_limits')) { 
            Schema::create('user_email_limits', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('user_id')->unique('user_id');
                $table->integer('hourly_rate')->nullable();
                $table->integer('daily_limit')->nullable();
                $table->integer('monthly_limit')->nullable();
                $table->integer('sent_today')->nullable()->default(0);
                $table->integer('sent_this_month')->nullable()->default(0);
                $table->integer('credits')->nullable()->default(0);
                $table->integer('total_sent')->nullable()->default(0);
                $table->integer('total_delivered')->nullable()->default(0);
                $table->integer('total_bounced')->nullable()->default(0);
                $table->integer('total_opens')->nullable()->default(0);
                $table->integer('total_clicks')->nullable()->default(0);
                $table->integer('total_complaints')->nullable()->default(0);
                $table->unsignedInteger('contacts')->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
                $table->integer('delivered_this_month')->default(0);
                $table->integer('bounced_this_month')->default(0);
                $table->integer('clicks_this_month')->default(0);
                $table->integer('opens_this_month')->default(0);
                $table->integer('complaints_this_month')->default(0);
                $table->bigInteger('trigger_actions_limit')->nullable()->default(0);
                $table->integer('trigger_actions_this_month')->default(0);
                $table->integer('domain_suppression_limit')->nullable();                
            });



          DB::statement("INSERT INTO `user_email_limits` (`id`, `user_id`, `hourly_rate`, `daily_limit`, `monthly_limit`, `sent_today`, `sent_this_month`, `credits`, `total_sent`, `total_delivered`, `total_bounced`, `total_opens`, `total_clicks`, `total_complaints`, `contacts`, `created_at`, `updated_at`, `delivered_this_month`, `bounced_this_month`, `clicks_this_month`, `opens_this_month`, `complaints_this_month`, `trigger_actions_this_month`) VALUES
(1, 1, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '2022-10-19 08:51:40', '2022-10-19 08:51:40', 0, 0, 0, 0, 0, 0),
        (2, 2, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '2022-10-19 08:51:40', '2022-10-19 08:51:40', 0, 0, 0, 0, 0, 0);");
        }
        else { 
            if (!Schema::hasColumn('user_email_limits', 'id')) {
                Schema::table('user_email_limits', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('user_email_limits', 'user_id')) {
                Schema::dropIfExists('user_email_limits');
                 Schema::create('user_email_limits', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('user_id')->unique('user_id');
                $table->integer('hourly_rate')->nullable();
                $table->integer('daily_limit')->nullable();
                $table->integer('monthly_limit')->nullable();
                $table->integer('sent_today')->nullable()->default(0);
                $table->integer('sent_this_month')->nullable()->default(0);
                $table->integer('credits')->nullable()->default(0);
                $table->integer('total_sent')->nullable()->default(0);
                $table->integer('total_delivered')->nullable()->default(0);
                $table->integer('total_bounced')->nullable()->default(0);
                $table->integer('total_opens')->nullable()->default(0);
                $table->integer('total_clicks')->nullable()->default(0);
                $table->integer('total_complaints')->nullable()->default(0);
                $table->unsignedInteger('contacts')->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
                $table->integer('delivered_this_month')->default(0);
                $table->integer('bounced_this_month')->default(0);
                $table->integer('clicks_this_month')->default(0);
                $table->integer('opens_this_month')->default(0);
                $table->integer('complaints_this_month')->default(0);
                $table->bigInteger('trigger_actions_limit')->nullable()->default(0);
                $table->integer('trigger_actions_this_month')->default(0);
                $table->integer('domain_suppression_limit')->nullable();                
            });



          DB::statement("INSERT INTO `user_email_limits` (`id`, `user_id`, `hourly_rate`, `daily_limit`, `monthly_limit`, `sent_today`, `sent_this_month`, `credits`, `sent`, `delivered`, `bounced`, `opened`, `clicked`, `complaints`, `contacts`, `created_at`, `updated_at`, `delivered_this_month`, `bounced_this_month`, `clicks_this_month`, `opens_this_month`, `complaints_this_month`, `trigger_actions_this_month`) VALUES
(1, 1, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '2022-10-19 08:51:40', '2022-10-19 08:51:40', 0, 0, 0, 0, 0, 0),
        (2, 2, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '2022-10-19 08:51:40', '2022-10-19 08:51:40', 0, 0, 0, 0, 0, 0);");
            }
            if (!Schema::hasColumn('user_email_limits', 'hourly_rate')) {
                Schema::table('user_email_limits', function (Blueprint $table) {
                    $table->integer('hourly_rate')->nullable();
                });
            }
            if (!Schema::hasColumn('user_email_limits', 'daily_limit')) {
                Schema::table('user_email_limits', function (Blueprint $table) {
                    $table->integer('daily_limit')->nullable();
                });
            }
            if (!Schema::hasColumn('user_email_limits', 'monthly_limit')) {
                Schema::table('user_email_limits', function (Blueprint $table) {
                    $table->integer('monthly_limit')->nullable();
                });
            }
            if (!Schema::hasColumn('user_email_limits', 'sent_today')) {
                Schema::table('user_email_limits', function (Blueprint $table) {
                    $table->integer('sent_today')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('user_email_limits', 'sent_this_month')) {
                Schema::table('user_email_limits', function (Blueprint $table) {
                    $table->integer('sent_this_month')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('user_email_limits', 'credits')) {
                Schema::table('user_email_limits', function (Blueprint $table) {
                    $table->integer('credits')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('user_email_limits', 'total_sent')) {
                Schema::table('user_email_limits', function (Blueprint $table) {
                    $table->integer('total_sent')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('user_email_limits', 'total_delivered')) {
                Schema::table('user_email_limits', function (Blueprint $table) {
                    $table->integer('total_delivered')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('user_email_limits', 'bounced')) {
                Schema::table('user_email_limits', function (Blueprint $table) {
                    $table->integer('bounced')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('user_email_limits', 'opened')) {
                Schema::table('user_email_limits', function (Blueprint $table) {
                    $table->integer('opened')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('user_email_limits', 'clicked')) {
                Schema::table('user_email_limits', function (Blueprint $table) {
                    $table->integer('clicked')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('user_email_limits', 'complaints')) {
                Schema::table('user_email_limits', function (Blueprint $table) {
                    $table->integer('complaints')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('user_email_limits', 'contacts')) {
                Schema::table('user_email_limits', function (Blueprint $table) {
                    $table->unsignedInteger('contacts')->nullable();
                });
            }
            if (!Schema::hasColumn('user_email_limits', 'created_at')) {
                Schema::table('user_email_limits', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('user_email_limits', 'updated_at')) {
                Schema::table('user_email_limits', function (Blueprint $table) {
                   $table->timestamp('updated_at')->useCurrentOnUpdate();
                });
            }
            if (!Schema::hasColumn('user_email_limits', 'delivered_this_month')) {
                Schema::table('user_email_limits', function (Blueprint $table) {
                    $table->integer('delivered_this_month')->default(0);
                });
            }
            if (!Schema::hasColumn('user_email_limits', 'bounced_this_month')) {
                Schema::table('user_email_limits', function (Blueprint $table) {
                    $table->integer('bounced_this_month')->default(0);
                });
            }
            if (!Schema::hasColumn('user_email_limits', 'clicks_this_month')) {
                Schema::table('user_email_limits', function (Blueprint $table) {
                    $table->integer('clicks_this_month')->default(0);
                });
            }
            if (!Schema::hasColumn('user_email_limits', 'opens_this_month')) {
                Schema::table('user_email_limits', function (Blueprint $table) {
                    $table->integer('opens_this_month')->default(0);
                });
            }
              if (!Schema::hasColumn('user_email_limits', 'complaints_this_month')) {
                Schema::table('user_email_limits', function (Blueprint $table) {
                    $table->integer('complaints_this_month')->default(0);
                });
            }
              if (!Schema::hasColumn('user_email_limits', 'trigger_actions_limit')) {
                Schema::table('user_email_limits', function (Blueprint $table) {
                    $table->bigInteger('trigger_actions_limit')->nullable()->default(0);
                });
            }
              if (!Schema::hasColumn('user_email_limits', 'trigger_actions_this_month')) {
                Schema::table('user_email_limits', function (Blueprint $table) {
                    $table->integer('trigger_actions_this_month')->default(0);
                });
            }
              if (!Schema::hasColumn('user_email_limits', 'domain_suppression_limit')) {
                Schema::table('user_email_limits', function (Blueprint $table) {
                    $table->integer('domain_suppression_limit')->nullable();
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
        Schema::dropIfExists('user_email_limits');
    }

}
;
