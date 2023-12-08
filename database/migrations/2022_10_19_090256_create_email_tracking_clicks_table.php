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
        if (!Schema::hasTable('email_tracking_clicks')) {
            Schema::create('email_tracking_clicks', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('campaign_schedule_logs_id')->index('campaign_schedule_logs_id');
                $table->integer('link_id')->nullable();
                $table->string('ip_address', 50)->nullable();
                $table->string('country', 99)->nullable();
                $table->string('region', 99)->nullable();
                $table->string('city', 99)->nullable();
                $table->string('zip', 50)->nullable();
                $table->string('user_agent', 255)->nullable();
                $table->dateTime('date_time')->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else 
        {
            if (!Schema::hasColumn('email_tracking_clicks', 'id')) {
                Schema::table('email_tracking_clicks', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('email_tracking_clicks', 'campaign_schedule_logs_id')) {
                Schema::table('email_tracking_clicks', function (Blueprint $table) {
                    $table->integer('campaign_schedule_logs_id')->index('campaign_schedule_logs_id');
                });
            }
            if (!Schema::hasColumn('email_tracking_clicks', 'link_id')) {
                Schema::table('email_tracking_clicks', function (Blueprint $table) {
                    $table->integer('link_id')->nullable();
                });
            }
            if (!Schema::hasColumn('email_tracking_clicks', 'ip_address')) {
                Schema::table('email_tracking_clicks', function (Blueprint $table) {
                    $table->string('ip_address', 50)->nullable();
                });
            }
            if (!Schema::hasColumn('email_tracking_clicks', 'country')) {
                Schema::table('email_tracking_clicks', function (Blueprint $table) {
                    $table->string('country', 99)->nullable();
                });
            }
            if (!Schema::hasColumn('email_tracking_clicks', 'region')) {
                Schema::table('email_tracking_clicks', function (Blueprint $table) {
                    $table->string('region', 99)->nullable();
                });
            }
            if (!Schema::hasColumn('email_tracking_clicks', 'city')) {
                Schema::table('email_tracking_clicks', function (Blueprint $table) {
                    $table->string('city', 99)->nullable();
                });
            }
            if (!Schema::hasColumn('email_tracking_clicks', 'zip')) {
                Schema::table('email_tracking_clicks', function (Blueprint $table) {
                    $table->string('zip', 50)->nullable();
                });
            }
            if (!Schema::hasColumn('email_tracking_clicks', 'user_agent')) {
                Schema::table('email_tracking_clicks', function (Blueprint $table) {
                    $table->string('user_agent', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('email_tracking_clicks', 'date_time')) {
                Schema::table('email_tracking_clicks', function (Blueprint $table) {
                    $table->dateTime('date_time')->nullable();
                });
            }
            if (!Schema::hasColumn('email_tracking_clicks', 'created_at')) {
                Schema::table('email_tracking_clicks', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('email_tracking_clicks', 'updated_at')) {
                Schema::table('email_tracking_clicks', function (Blueprint $table) {
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
        Schema::dropIfExists('email_tracking_clicks');
    }

}
;
