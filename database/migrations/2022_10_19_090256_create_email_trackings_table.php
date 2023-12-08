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
        if (!Schema::hasTable('email_trackings')) {
            Schema::create('email_trackings', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('campaign_schedule_logs_id')->index('campaign_schedule_logs_id');
                $table->boolean('is_open')->nullable()->default(false)->index('is_open');
                $table->mediumInteger('open_count')->nullable()->default(0);
                $table->boolean('is_clicked')->nullable()->default(false);
                $table->integer('clicked_count')->nullable()->default(0);
                $table->string('ip_address', 50)->nullable();
                $table->string('country', 99)->nullable();
                $table->string('region', 99)->nullable();
                $table->string('city', 99)->nullable();
                $table->string('zip', 50)->nullable();
                $table->string('user_agent', 255)->nullable();
                $table->dateTime('date_time')->nullable();
                $table->integer('user_id')->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else {
            if (!Schema::hasColumn('email_trackings', 'id')) {
                Schema::table('email_trackings', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('email_trackings', 'campaign_schedule_logs_id')) {
                Schema::table('email_trackings', function (Blueprint $table) {
                    $table->integer('campaign_schedule_logs_id')->index('campaign_schedule_logs_id');
                });
            }
            if (!Schema::hasColumn('email_trackings', 'is_open')) {
                Schema::table('email_trackings', function (Blueprint $table) {
                    $table->boolean('is_open')->nullable()->default(false)->index('is_open');
                });
            }
            if (!Schema::hasColumn('email_trackings', 'open_count')) {
                Schema::table('email_trackings', function (Blueprint $table) {
                    $table->mediumInteger('open_count')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('email_trackings', 'is_clicked')) {
                Schema::table('email_trackings', function (Blueprint $table) {
                    $table->boolean('is_clicked')->nullable()->default(false);
                });
            }
            if (!Schema::hasColumn('email_trackings', 'clicked_count')) {
                Schema::table('email_trackings', function (Blueprint $table) {
                    $table->integer('clicked_count')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('email_trackings', 'ip_address')) {
                Schema::table('email_trackings', function (Blueprint $table) {
                    $table->string('ip_address', 50)->nullable();
                });
            }
            if (!Schema::hasColumn('email_trackings', 'country')) {
                Schema::table('email_trackings', function (Blueprint $table) {
                    $table->string('country', 99)->nullable();
                });
            }
            if (!Schema::hasColumn('email_trackings', 'region')) {
                Schema::table('email_trackings', function (Blueprint $table) {
                    $table->string('region', 99)->nullable();
                });
            }
            if (!Schema::hasColumn('email_trackings', 'city')) {
                Schema::table('email_trackings', function (Blueprint $table) {
                    $table->string('city', 99)->nullable();
                });
            }
            if (!Schema::hasColumn('email_trackings', 'zip')) {
                Schema::table('email_trackings', function (Blueprint $table) {
                    $table->string('zip', 50)->nullable();
                });
            }
            if (!Schema::hasColumn('email_trackings', 'user_agent')) {
                Schema::table('email_trackings', function (Blueprint $table) {
                    $table->string('user_agent', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('email_trackings', 'date_time')) {
                Schema::table('email_trackings', function (Blueprint $table) {
                    $table->dateTime('date_time')->nullable();
                });
            }
            if (!Schema::hasColumn('email_trackings', 'user_id')) {
                Schema::table('email_trackings', function (Blueprint $table) {
                    $table->integer('user_id')->nullable();
                });
            }
            if (!Schema::hasColumn('email_trackings', 'created_at')) {
                Schema::table('email_trackings', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('email_trackings', 'updated_at')) {
                Schema::table('email_trackings', function (Blueprint $table) {
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
        Schema::dropIfExists('email_trackings');
    }

}
;
