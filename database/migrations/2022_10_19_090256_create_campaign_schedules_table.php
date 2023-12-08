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
        if (!Schema::hasTable('campaign_schedules')) {
            Schema::create('campaign_schedules', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('name', 255)->nullable();
                $table->enum('type', ['subscriber', 'segment', 'split_test', 'trigger'])->nullable();
                $table->string('list_ids', 255)->nullable();
                $table->integer('trigger_id')->nullable();
                $table->integer('autoresponder_id')->nullable();
                $table->string('segment_ids', 255)->nullable();
                $table->string('campaign_ids', 255)->nullable();
                $table->enum('split_test_on', ['lists', 'campaigns'])->nullable();
                $table->string('split_test_ids', 255)->nullable();
                $table->text('smtp_ids')->nullable();
                $table->enum('smtp_sequence', ['batch', 'loop'])->nullable()->default('batch');
                $table->enum('sending_pattern', ['sequential', 'random'])->default('sequential');
                $table->enum('masked_domain', ['not', 'smtp', 'custom'])->nullable()->default('not');
                $table->string('masked_domain_ids', 255)->nullable();
                $table->string('send_campaign', 10)->default('now');
                $table->dateTime('send_datetime')->nullable();
                $table->enum('sender_option', ['smtp', 'list', 'custom'])->nullable()->default('smtp');
                $table->text('from_attributes')->nullable();
                $table->string('notification_email', 255)->nullable();
                $table->enum('status', ['processing', 'paused', 'complete', 'scheduled', 'scheduling', 'system paused', 'resumed', 'pausing', 'prepared', 'WaitingForResult', 'system pausing'])->default('processing')->index('campaign_schedule_status_index');
                $table->string('paused_reason', 1000)->nullable();
                $table->boolean('is_running')->default(false);
                $table->boolean('unsub_show')->default(true);
                $table->boolean('track_opens')->nullable()->default(true);
                $table->boolean('track_clicks')->nullable()->default(true);
                $table->boolean('track_duplicate')->default(true);
                $table->boolean('unsubscribe_header')->default(false);
                $table->boolean('track_unsubscribe')->default(false);
                $table->integer('hourly_speed')->nullable()->default(-1);
                $table->integer('threads');
                $table->integer('thread_no')->nullable()->default(0);
                $table->integer('thread_settings')->default(0);
                $table->integer('emails_sent')->nullable()->default(0);
                $table->string('campaign_type', 16)->nullable();
                $table->text('evergreen_data')->nullable();
                $table->integer('user_id')->nullable();
                $table->integer('parent_id')->default(0);
                $table->boolean('is_save_criteria')->default(false);
                $table->dateTime('start_datetime')->nullable();
                $table->dateTime('end_datetime')->nullable();
                $table->integer('current_smtp');
                $table->bigInteger('prepare_count')->default(0);
                $table->text('top_domains')->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else {
            if (!Schema::hasColumn('campaign_schedules', 'id')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'name')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->string('name', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'type')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->enum('type', ['subscriber', 'segment', 'split_test', 'trigger'])->nullable();
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'list_ids')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->string('list_ids', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'trigger_id')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->integer('trigger_id')->nullable();
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'autoresponder_id')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->integer('autoresponder_id')->nullable();
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'segment_ids')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->string('segment_ids', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'campaign_ids')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->string('campaign_ids', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'split_test_on')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->enum('split_test_on', ['lists', 'campaigns'])->nullable();
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'split_test_ids')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->string('split_test_ids', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'smtp_ids')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->text('smtp_ids')->nullable();
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'smtp_sequence')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->enum('smtp_sequence', ['batch', 'loop'])->nullable()->default('batch');
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'sending_pattern')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->enum('sending_pattern', ['sequential', 'random'])->default('sequential');
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'masked_domain')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->enum('masked_domain', ['not', 'smtp', 'custom'])->nullable()->default('not');
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'masked_domain_ids')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->string('masked_domain_ids', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'send_campaign')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->string('send_campaign', 10)->default('now');
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'send_datetime')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->dateTime('send_datetime')->nullable();
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'sender_option')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->enum('sender_option', ['smtp', 'list', 'custom'])->nullable()->default('smtp');
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'from_attributes')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->text('from_attributes')->nullable();
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'notification_email')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->string('notification_email', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'status')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->enum('status', ['processing', 'paused', 'complete', 'scheduled', 'scheduling', 'system paused', 'resumed', 'pausing', 'prepared', 'WaitingForResult', 'system pausing'])->default('processing')->index('campaign_schedule_status_index');
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'paused_reason')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->string('paused_reason', 1000)->nullable();
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'is_running')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->boolean('is_running')->default(false);
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'unsub_show')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->boolean('unsub_show')->default(true);
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'track_opens')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->boolean('track_opens')->nullable()->default(true);
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'track_clicks')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->boolean('track_clicks')->nullable()->default(true);
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'track_duplicate')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->boolean('track_duplicate')->default(true);
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'unsubscribe_header')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->boolean('unsubscribe_header')->default(false);
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'track_unsubscribe')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->boolean('track_unsubscribe')->default(false);
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'hourly_speed')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->integer('hourly_speed')->nullable()->default(-1);
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'threads')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->integer('threads');
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'thread_no')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->integer('thread_no')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'thread_settings')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->integer('thread_settings')->default(0);
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'emails_sent')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->integer('emails_sent')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'campaign_type')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->string('campaign_type', 16)->nullable();
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'evergreen_data')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->text('evergreen_data')->nullable();
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'user_id')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->integer('user_id')->nullable();
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'parent_id')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->integer('parent_id')->default(0);
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'is_save_criteria')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->boolean('is_save_criteria')->default(false);
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'start_datetime')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->dateTime('start_datetime')->nullable();
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'end_datetime')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->dateTime('end_datetime')->nullable();
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'current_smtp')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->integer('current_smtp');
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'prepare_count')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->bigInteger('prepare_count')->default(0);
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'top_domains')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                    $table->text('top_domains')->nullable();
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'created_at')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('campaign_schedules', 'updated_at')) {
                Schema::table('campaign_schedules', function (Blueprint $table) {
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
        Schema::dropIfExists('campaign_schedules');
    }

}
;
