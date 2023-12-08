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
        try {

            Schema::table('active_sessions', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM active_sessions"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `active_sessions`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('active_sessions', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM active_sessions"))->pluck('Key_name')->contains('file_name');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `active_sessions`  ADD UNIQUE KEY `file_name` (`file_name`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('active_sessions', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM active_sessions"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `active_sessions`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {

            Schema::table('activity_logs', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM activity_logs"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `activity_logs`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('activity_logs', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM activity_logs"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `activity_logs`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('addons', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM addons"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `addons`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('addons', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM addons"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `addons`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('alter_tables', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM alter_tables"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `alter_tables`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('alter_tables', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM alter_tables"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `alter_tables`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {

            Schema::table('api_tokens', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM api_tokens"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `api_tokens`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('api_tokens', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM api_tokens"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `api_tokens`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {

            Schema::table('application_settings', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM application_settings"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `application_settings`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {

            Schema::table('app_errors', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM app_errors"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `app_errors`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('app_errors', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM app_errors"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `app_errors`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {

            Schema::table('app_issues', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM app_issues"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `app_issues`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('app_issues', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM app_issues"))->pluck('Key_name')->contains('ref_id');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `app_issues` ADD UNIQUE KEY `ref_id` (`ref_id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('app_issues', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM app_issues"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `app_issues`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('autoresponders', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM autoresponders"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `autoresponders`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('autoresponders', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM autoresponders"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `autoresponders`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('autoresponder_bounced_emails', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM autoresponder_bounced_emails"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `autoresponder_bounced_emails`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('autoresponder_complaint_emails', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM autoresponder_complaint_emails"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `autoresponder_complaint_emails`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('autoresponder_email_bounced', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM autoresponder_email_bounced"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `autoresponder_email_bounced`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('autoresponder_trackings', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM autoresponder_trackings"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `autoresponder_trackings`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {

            Schema::table('autoresponder_groups', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM autoresponder_groups"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `autoresponder_groups` ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('autoresponder_groups', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM autoresponder_groups"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `autoresponder_groups`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('autoresponder_tracking_clicks', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM autoresponder_tracking_clicks"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `autoresponder_tracking_clicks`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('bug_reports', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM bug_reports"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `bug_reports`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {

            Schema::table('bounced_emails', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM bounced_emails"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `bounced_emails`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('bounced_emails', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM bounced_emails"))->pluck('Key_name')->contains('campaing_schedule_logs_id_2');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `bounced_emails`  ADD UNIQUE KEY `campaing_schedule_logs_id_2` (`campaing_schedule_logs_id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('bounced_emails', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM bounced_emails"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `bounced_emails`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {

            Schema::table('bounces', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM bounces"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `bounces`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('bounces', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM bounces"))->pluck('Key_name')->contains('pmta_id');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `bounces` ADD KEY `pmta_id` (`pmta_id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('bounces', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM bounces"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `bounces`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('bounce_reasons', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM bounce_reasons"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `bounce_reasons`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('bounce_reasons', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM bounce_reasons"))->pluck('Key_name')->contains('is_default');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `bounce_reasons`  ADD KEY `is_default` (`is_default`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('bounce_reasons', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM bounce_reasons"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `bounce_reasons`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('broadcast_links', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM broadcast_links"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `broadcast_links`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('broadcast_links', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM broadcast_links"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `broadcast_links`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('bug_replies', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM bug_replies"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `bug_replies`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('bug_replies', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM bug_replies"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `bug_replies`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('campaigns', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM campaigns"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `campaigns`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('campaigns', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM campaigns"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `campaigns`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('campaign_schedules', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM campaign_schedules"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `campaign_schedules`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('campaign_schedules', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM campaign_schedules"))->pluck('Key_name')->contains('campaign_schedule_status_index');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `campaign_schedules`  ADD KEY `campaign_schedule_status_index` (`status`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('campaign_schedules', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM campaign_schedules"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `campaign_schedules`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            ///DB::statement("ALTER TABLE `campaign_schedule_logs`  ADD PRIMARY KEY (`id`);");
            Schema::table('campaign_schedule_logs', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM campaign_schedule_logs"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'indexes', 'ALTER TABLE `campaign_schedule_logs`  ADD PRIMARY KEY (`id`);', '0', NULL);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            /// DB::statement("ALTER TABLE `campaign_schedule_logs`   ADD KEY `campaign_schedule_id` (`campaign_schedule_id`);");
            Schema::table('campaign_schedule_logs', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM campaign_schedule_logs"))->pluck('Key_name')->contains('campaign_schedule_id');
                if (!$index_exists) {
                    DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'indexes', 'CREATE INDEX campaign_schedule_id ON campaign_schedule_logs (campaign_schedule_id);', '0', NULL);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            ///DB::statement("ALTER TABLE `campaign_schedule_logs`  ADD KEY `campaign_id` (`campaign_id`);");
            Schema::table('campaign_schedule_logs', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM campaign_schedule_logs"))->pluck('Key_name')->contains('campaign_id');
                if (!$index_exists) {
                    DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'indexes', 'CREATE INDEX campaign_id ON campaign_schedule_logs (campaign_id);', '0', NULL);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            ///DB::statement("ALTER TABLE `campaign_schedule_logs`   ADD KEY `subscriber_id` (`subscriber_id`);");
            Schema::table('campaign_schedule_logs', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM campaign_schedule_logs"))->pluck('Key_name')->contains('subscriber_id');
                if (!$index_exists) {
                    DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'indexes', 'CREATE INDEX subscriber_id ON campaign_schedule_logs (subscriber_id);', '0', NULL);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            ///DB::statement("ALTER TABLE `campaign_schedule_logs`  ADD KEY `is_sent` (`is_sent`);");
            Schema::table('campaign_schedule_logs', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM campaign_schedule_logs"))->pluck('Key_name')->contains('is_sent');
                if (!$index_exists) {
                    DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'indexes', 'CREATE INDEX is_sent ON campaign_schedule_logs (is_sent);', '0', NULL);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            //DB::statement("ALTER TABLE `campaign_schedule_logs`  ADD KEY `is_bounced` (`is_bounced`);");
            Schema::table('campaign_schedule_logs', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM campaign_schedule_logs"))->pluck('Key_name')->contains('is_bounced');
                if (!$index_exists) {
                    DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'indexes', 'CREATE INDEX is_bounced ON campaign_schedule_logs (is_bounced);', '0', NULL);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            //DB::statement("ALTER TABLE `campaign_schedule_logs`  ADD KEY `domain_name` (`domain_name`);");
            Schema::table('campaign_schedule_logs', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM campaign_schedule_logs"))->pluck('Key_name')->contains('domain_name');
                if (!$index_exists) {
                    DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'indexes', 'CREATE INDEX domain_name ON campaign_schedule_logs (domain_name);', '0', NULL);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('campaign_schedule_logs', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM campaign_schedule_logs"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'indexes', 'CREATE INDEX created_at ON campaign_schedule_logs (created_at);', '0', NULL);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('campaign_schedule_records', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM campaign_schedule_records"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `campaign_schedule_records`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('campaign_schedule_records', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM campaign_schedule_records"))->pluck('Key_name')->contains('campaign_schedule_id');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `campaign_schedule_records` ADD KEY `campaign_schedule_id` (`campaign_schedule_id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('campaign_schedule_records', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM campaign_schedule_records"))->pluck('Key_name')->contains('batch_no');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `campaign_schedule_records` ADD KEY `batch_no` (`batch_no`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('conversion_trackings', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM conversion_trackings"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `conversion_trackings`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('conversion_trackings', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM conversion_trackings"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `conversion_trackings`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('countries', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM countries"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `countries`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {

            Schema::table('cronjob_logs', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM cronjob_logs"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `cronjob_logs`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('cronjob_logs', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM cronjob_logs"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `cronjob_logs`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('custom_css', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM custom_css"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `custom_css`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('custom_css', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM custom_css"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `custom_css`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('custom_fields', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM custom_fields"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `custom_fields`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('custom_fields', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM custom_fields"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `custom_fields`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {

            Schema::table('custom_headers', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM custom_headers"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `custom_headers`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('custom_headers', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM custom_headers"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `custom_headers`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('dashboard_stats_hourly', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM dashboard_stats_hourly"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `dashboard_stats_hourly`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('dashboard_stats', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM dashboard_stats"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `dashboard_stats`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('dashboard_stats', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM dashboard_stats"))->pluck('Key_name')->contains('end_date');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `dashboard_stats` ADD KEY `end_date` (`end_date`)");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('dashboard_stats', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM dashboard_stats"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `dashboard_stats`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('domain_maskings', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM domain_maskings"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `domain_maskings`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('domain_maskings', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM domain_maskings"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `domain_maskings`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('dynamic_content_tags', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM dynamic_content_tags"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `dynamic_content_tags`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('dynamic_content_tags', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM dynamic_content_tags"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `dynamic_content_tags`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('email_bounced', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM email_bounced"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'indexes', 'ALTER TABLE `email_bounced`  ADD PRIMARY KEY (`id`);', '0', NULL);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('email_bounced', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM email_bounced"))->pluck('Key_name')->contains('campaing_schedule_logs_id');
                if (!$index_exists) {
                    DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'indexes', 'CREATE INDEX campaing_schedule_logs_id ON email_bounced (campaing_schedule_logs_id);', '0', NULL);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('email_bounced', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM email_bounced"))->pluck('Key_name')->contains('schedule_id');
                if (!$index_exists) {
                    DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'indexes', 'CREATE INDEX schedule_id ON email_bounced (schedule_id);', '0', NULL);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('email_bounced', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM email_bounced"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {                    
                    DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'indexes', 'CREATE INDEX created_at ON email_bounced (created_at);', '0', NULL);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('email_clicked', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM email_clicked"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'indexes', 'ALTER TABLE `email_clicked`  ADD PRIMARY KEY (`id`);', '0', NULL);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('email_clicked', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM email_clicked"))->pluck('Key_name')->contains('scheduled_id');
                if (!$index_exists) {
                    DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'indexes', 'CREATE INDEX scheduled_id ON email_clicked (scheduled_id);', '0', NULL);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('email_clicked', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM email_clicked"))->pluck('Key_name')->contains('contact_id');
                if (!$index_exists) {
                    DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'indexes', 'CREATE INDEX contact_id ON email_clicked (contact_id);', '0', NULL);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('email_clicked', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM email_clicked"))->pluck('Key_name')->contains('campaign_schedule_logs_id');
                if (!$index_exists) {
                    DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'indexes', 'CREATE INDEX campaign_schedule_logs_id ON email_clicked (campaign_schedule_logs_id);', '0', NULL);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('email_clicked', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM email_clicked"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'indexes', 'CREATE INDEX created_at ON email_clicked (created_at);', '0', NULL);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('alter_tables', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM alter_tables"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `alter_tables`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
       
        try {
            Schema::table('email_complaints', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM email_complaints"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `email_complaints`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('email_complaints', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM email_complaints"))->pluck('Key_name')->contains('campaing_schedule_logs_id');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `email_complaints` ADD KEY `campaing_schedule_logs_id` (`campaing_schedule_logs_id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('email_complaints', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM email_complaints"))->pluck('Key_name')->contains('scheduled_id');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `email_complaints` ADD KEY `scheduled_id` (`scheduled_id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('email_complaints', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM email_complaints"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `email_complaints`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('email_opened', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM email_opened"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'indexes', 'ALTER TABLE `email_opened`  ADD PRIMARY KEY (`id`);', '0', NULL);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('email_opened', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM email_opened"))->pluck('Key_name')->contains('scheduled_id');
                if (!$index_exists) {
                    DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'indexes', 'CREATE INDEX scheduled_id ON email_opened (scheduled_id);', '0', NULL);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('email_opened', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM email_opened"))->pluck('Key_name')->contains('contact_id');
                if (!$index_exists) {
                    DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'indexes', 'CREATE INDEX contact_id ON email_opened (contact_id);', '0', NULL);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('email_opened', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM email_opened"))->pluck('Key_name')->contains('campaign_schedule_logs_id');
                if (!$index_exists) {
                    DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'indexes', 'CREATE INDEX campaign_schedule_logs_id ON email_opened (campaign_schedule_logs_id);', '0', NULL);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('email_opened', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM email_opened"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'indexes', 'CREATE INDEX created_at ON email_opened (created_at);', '0', NULL);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('email_templates', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM email_templates"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `email_templates`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('email_templates', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM email_templates"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `email_templates`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('email_trackings', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM email_trackings"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `email_trackings`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('email_trackings', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM email_trackings"))->pluck('Key_name')->contains('campaign_schedule_logs_id');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `email_trackings` ADD KEY `campaign_schedule_logs_id` (`campaign_schedule_logs_id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('email_trackings', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM email_trackings"))->pluck('Key_name')->contains('is_open');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `email_trackings` ADD KEY `is_open` (`is_open`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('email_trackings', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM email_trackings"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `email_trackings`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('email_tracking_clicks', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM email_tracking_clicks"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `email_tracking_clicks`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('email_tracking_clicks', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM email_tracking_clicks"))->pluck('Key_name')->contains('campaign_schedule_logs_id');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `email_tracking_clicks`  ADD KEY `campaign_schedule_logs_id` (`campaign_schedule_logs_id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('email_tracking_clicks', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM email_tracking_clicks"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `email_tracking_clicks`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('email_unsubscribed', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM email_unsubscribed"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `email_unsubscribed`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('email_unsubscribed', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM email_unsubscribed"))->pluck('Key_name')->contains('campaing_schedule_logs_id');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `email_unsubscribed` ADD KEY `campaing_schedule_logs_id` (`campaing_schedule_logs_id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('email_unsubscribed', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM email_unsubscribed"))->pluck('Key_name')->contains('scheduled_id');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `email_unsubscribed` ADD KEY `scheduled_id` (`scheduled_id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('email_unsubscribed', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM email_unsubscribed"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `email_unsubscribed`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('events_queue_process', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM events_queue_process"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `events_queue_process`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('events_queue_process', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM events_queue_process"))->pluck('Key_name')->contains('event_action');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `events_queue_process` ADD KEY `event_action` (`event_action`,`process_id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('events_queue_process', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM events_queue_process"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `events_queue_process`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('evergreen_campaigns', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM evergreen_campaigns"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `evergreen_campaigns`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('evergreen_campaigns', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM evergreen_campaigns"))->pluck('Key_name')->contains('evergreen_campaigns_created_at_index');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `evergreen_campaigns`  ADD KEY `evergreen_campaigns_created_at_index` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }        
        try {
            Schema::table('exported_files', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM exported_files"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `exported_files`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('exported_files', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM exported_files"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `exported_files`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('failed_jobs', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM failed_jobs"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `failed_jobs`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('fbls', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM fbls"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `fbls`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('fbls', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM fbls"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `fbls`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('fbl_emails', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM fbl_emails"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `fbl_emails`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('fbl_emails', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM fbl_emails"))->pluck('Key_name')->contains('campaing_schedule_logs_id_2');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `fbl_emails` ADD UNIQUE KEY `campaing_schedule_logs_id_2` (`campaing_schedule_logs_id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('fbl_emails', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM fbl_emails"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `fbl_emails`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('groups', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM groups"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `groups`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('groups', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM groups"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `groups`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('jobs', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM jobs"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `jobs`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('jobs', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM jobs"))->pluck('Key_name')->contains('jobs_queue_index');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `jobs` ADD KEY `jobs_queue_index` (`queue`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('jobs', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM jobs"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `jobs`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {

            Schema::table('links', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM links"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `links`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('list_custom_field', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM list_custom_field"))->pluck('Key_name')->contains('fk_list_id');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `list_custom_field`  ADD KEY `fk_list_id` (`list_id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('list_custom_field', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM list_custom_field"))->pluck('Key_name')->contains('fk_custom_field_id');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `list_custom_field`  ADD KEY `fk_custom_field_id` (`custom_field_id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        
        
        try {
            Schema::table('live_events', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM live_events"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `live_events`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('live_events', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM live_events"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `live_events`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('mainmenu', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM mainmenu"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `mainmenu`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('mainmenu', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM mainmenu"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `mainmenu`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('mumara_migrations', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM mumara_migrations"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `mumara_migrations`  ADD PRIMARY KEY (`migration`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        
        try {
            Schema::table('notifications', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM notifications"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `notifications`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('notifications', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM notifications"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `notifications`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('packages', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM packages"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `packages`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('packages', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM packages"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `packages`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('password_resets', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM password_resets"))->pluck('Key_name')->contains('password_resets_email_index');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `password_resets`  ADD KEY `password_resets_email_index` (`email`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('password_resets', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM password_resets"))->pluck('Key_name')->contains('password_resets_token_index');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `password_resets` ADD KEY `password_resets_token_index` (`token`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('password_resets', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM password_resets"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `password_resets`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('permissions', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM permissions"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `permissions`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('permissions', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM permissions"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `permissions`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('pixels', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM pixels"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `pixels`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('pixels', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM pixels"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `pixels`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('pixel_events', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM pixel_events"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `pixel_events`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('pixel_events', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM pixel_events"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `pixel_events`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('pixel_tracking', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM pixel_tracking"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `pixel_tracking`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('pixel_tracking', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM pixel_tracking"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `pixel_tracking`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('pmtas', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM pmtas"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `pmtas`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('pmtas', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM pmtas"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `pmtas`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('pmta_bounce', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM pmta_bounce"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `pmta_bounce`  ADD PRIMARY KEY (`file_id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        
        try {
            Schema::table('roles', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM roles"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `roles`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('roles', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM roles"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `roles`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('role_permissions', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM role_permissions"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `role_permissions`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('role_permissions', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM role_permissions"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `role_permissions`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('sections', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM sections"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `sections`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        
        try {
            Schema::table('segmentations', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM segmentations"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `segmentations`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('segmentations', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM segmentations"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `segmentations`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('segmentation_logs', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM segmentation_logs"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `segmentation_logs`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('segmentation_logs', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM segmentation_logs"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `segmentation_logs`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('smtps', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM smtps"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `smtps`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('smtps', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM smtps"))->pluck('Key_name')->contains('pmta_id');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `smtps` ADD KEY `pmta_id` (`pmta_id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('smtps', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM smtps"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `smtps`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('spin_tags', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM spin_tags"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `spin_tags`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('spin_tags', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM spin_tags"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `spin_tags`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('split_tests', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM split_tests"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `split_tests`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('split_tests', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM split_tests"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `split_tests`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('statistics', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM statistics"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `statistics`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('statistics', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM statistics"))->pluck('Key_name')->contains('campaign_schedule_id');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `statistics` ADD KEY `campaign_schedule_id` (`campaign_schedule_id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('statistics', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM statistics"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `statistics`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('statistics_summarys', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM statistics_summarys"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `statistics_summarys`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('statistics_summarys', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM statistics_summarys"))->pluck('Key_name')->contains('campaign_schedule_id_unique');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `statistics_summarys` ADD UNIQUE KEY `campaign_schedule_id_unique` (`campaign_schedule_id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('statistics_summarys', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM statistics_summarys"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `statistics_summarys`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('statstopdomains', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM statstopdomains"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `statstopdomains`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('statstopdomains', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM statstopdomains"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `statstopdomains`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('stats_broadcasts', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM stats_broadcasts"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `stats_broadcasts`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('stats_broadcasts', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM stats_broadcasts"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `stats_broadcasts`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('stats_dashboards', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM stats_dashboards"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `stats_dashboards`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('stats_dashboards', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM stats_dashboards"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `stats_dashboards`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('stats_devices', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM stats_devices"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `stats_devices`  ADD PRIMARY KEY (`id`);");
                }
            });
            
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('stats_devices', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM stats_devices"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `stats_devices`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('stats_pending', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM stats_pending"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `stats_pending`  ADD PRIMARY KEY (`id`);");
                }
            });
            
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('stats_pending', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM stats_pending"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `stats_pending`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('subscribers', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM subscribers"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'indexes', 'ALTER TABLE `subscribers`  ADD PRIMARY KEY (`id`);', '0', NULL);");
                }
            });            
        } catch (\Exception $e) {
            
        }
        try {
            //DB::statement("ALTER TABLE `subscribers`  ADD KEY `email` (`email`);");  
            Schema::table('subscribers', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM subscribers"))->pluck('Key_name')->contains('email');
                if (!$index_exists) {
                    DB::statement("CREATE INDEX email ON subscribers (email);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            //DB::statement("ALTER TABLE `subscribers` ADD KEY `domain_name` (`domain_name`);");
            Schema::table('subscribers', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM subscribers"))->pluck('Key_name')->contains('domain_name');
                if (!$index_exists) {
                    DB::statement("CREATE INDEX domain_name ON subscribers (domain_name);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            ///DB::statement("ALTER TABLE `subscribers`  ADD KEY `list_id` (`list_id`);");
            Schema::table('subscribers', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM subscribers"))->pluck('Key_name')->contains('list_id');
                if (!$index_exists) {
                    DB::statement("CREATE INDEX list_id ON subscribers (list_id);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            //DB::statement("ALTER TABLE `subscribers`  ADD KEY `last_opened` (`last_opened`);");
            Schema::table('subscribers', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM subscribers"))->pluck('Key_name')->contains('last_opened');
                if (!$index_exists) {
                    DB::statement("CREATE INDEX last_opened ON subscribers (last_opened);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            ///DB::statement("ALTER TABLE `subscribers`  ADD KEY `created_at` (`created_at`);");
            Schema::table('subscribers', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM subscribers"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("CREATE INDEX created_at ON subscribers (created_at);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            //DB::statement("ALTER TABLE `subscriber_additional_data`  ADD KEY `subscriber_id` (`subscriber_id`);");
            Schema::table('subscriber_additional_data', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM subscriber_additional_data"))->pluck('Key_name')->contains('subscriber_id');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `subscriber_additional_data`  ADD KEY `subscriber_id` (`subscriber_id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            //DB::statement("ALTER TABLE `subscriber_additional_data`  ADD KEY `custom_field_id` (`custom_field_id`);");
            Schema::table('subscriber_additional_data', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM subscriber_additional_data"))->pluck('Key_name')->contains('custom_field_id');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `subscriber_additional_data`  ADD KEY `custom_field_id` (`custom_field_id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('subscriber_additional_data', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM subscriber_additional_data"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `subscriber_additional_data`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('subscriber_imports', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM subscriber_imports"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `subscriber_imports`  ADD PRIMARY KEY (`id`);");
                }
            });
            
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('subscriber_imports', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM subscriber_imports"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `subscriber_imports`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('suppression_domains', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM suppression_domains"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `suppression_domains`  ADD PRIMARY KEY (`id`);");
                }
            });
            
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('suppression_domains', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM suppression_domains"))->pluck('Key_name')->contains('domain');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `suppression_domains` ADD KEY `domain` (`domain`,`list_id`,`import_id`,`user_id`);");
                }
            });
            
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('suppression_domains', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM suppression_domains"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `suppression_domains`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('suppression_emails', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM suppression_emails"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `suppression_emails`  ADD PRIMARY KEY (`id`);");
                }
            });
            
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('suppression_emails', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM suppression_emails"))->pluck('Key_name')->contains('email');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `suppression_emails` ADD KEY `email_key` (`email`);");
                }
            });
            
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('suppression_emails', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM suppression_emails"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `suppression_emails`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('suppression_ips', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM suppression_ips"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `suppression_ips`  ADD PRIMARY KEY (`id`);");
                }
            });
            
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('suppression_ips', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM suppression_ips"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `suppression_ips`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            
            Schema::table('tasks', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM tasks"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `tasks`  ADD PRIMARY KEY (`id`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('tasks', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM tasks"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `tasks`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('todos', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM todos"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `todos`  ADD PRIMARY KEY (`id`);");
                }
            });
            
        } catch (\Exception $e) {
            
        }
        
        try {
             Schema::table('triggers', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM triggers"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `triggers`  ADD PRIMARY KEY (`id`);");
                }
            });
            
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('triggers', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM triggers"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `triggers`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('trigger_actions', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM trigger_actions"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `trigger_actions`  ADD PRIMARY KEY (`id`);");
                }
            });
            
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('trigger_actions', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM trigger_actions"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `trigger_actions`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('trigger_tasks', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM trigger_tasks"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `trigger_tasks`  ADD PRIMARY KEY (`id`);");
                }
            });
            
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('trigger_tasks', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM trigger_tasks"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `trigger_tasks`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('two_fa', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM two_fa"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `two_fa`  ADD PRIMARY KEY (`id`);");
                }
            });
            
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('two_fa', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM two_fa"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `two_fa`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('update_contacts', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM update_contacts"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `update_contacts`  ADD PRIMARY KEY (`id`);");
                }
            });
            
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('update_contacts', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM update_contacts"))->pluck('Key_name')->contains('file');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `update_contacts` ADD UNIQUE KEY `file` (`file`);");
                }
            });
            
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('update_contacts', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM update_contacts"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `update_contacts`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('users', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM users"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `users`  ADD PRIMARY KEY (`id`);");
                }
            });
            
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('users', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM users"))->pluck('Key_name')->contains('users_email_unique');
                if (!$index_exists) {
                   DB::statement("ALTER TABLE `users` ADD UNIQUE KEY `users_email_unique` (`email`);");
                }
            });
            
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('users', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM users"))->pluck('Key_name')->contains('api_token');
                if (!$index_exists) {
                   DB::statement("ALTER TABLE `users` ADD UNIQUE KEY `api_token` (`api_token`);");
                }
            });
            
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('users', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM users"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `users`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('user_cron_settings', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM user_cron_settings"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `user_cron_settings`  ADD PRIMARY KEY (`id`);");
                }
            });
            
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('user_cron_settings', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM user_cron_settings"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `user_cron_settings`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('user_email_limits', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM user_email_limits"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `user_email_limits`  ADD PRIMARY KEY (`id`);");
                }
            });
            
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('user_email_limits', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM user_email_limits"))->pluck('Key_name')->contains('user_id');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `user_email_limits`  ADD UNIQUE KEY `user_id` (`user_id`);");
                }
            });
            
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('user_email_limits', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM user_email_limits"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `user_email_limits`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
             Schema::table('user_notifications', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM user_notifications"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `user_notifications`  ADD PRIMARY KEY (`id`);");
                }
            });
            
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('user_notifications', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM user_notifications"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `user_notifications`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('user_settings', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM user_settings"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `user_settings`  ADD PRIMARY KEY (`id`);");
                }
            });
            
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('user_settings', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM user_settings"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `user_settings`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('web_forms', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM web_forms"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `web_forms`  ADD PRIMARY KEY (`id`);");
                }
            });
            
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('web_forms', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM web_forms"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `web_forms`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('web_form_categories', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM web_form_categories"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `web_form_categories`  ADD PRIMARY KEY (`id`);");
                }
            });
            
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('web_form_categories', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM web_form_categories"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `web_form_categories`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('web_form_designs', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM web_form_designs"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `web_form_designs`  ADD PRIMARY KEY (`id`);");
                }
            });
            
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('web_form_designs', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM web_form_designs"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `web_form_designs`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('web_templates', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM web_templates"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `web_templates`  ADD PRIMARY KEY (`id`);");
                }
            });
            
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('web_templates', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM web_templates"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `web_templates`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('zapier_subscriptions', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM zapier_subscriptions"))->pluck('Key_name')->contains('PRIMARY');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `zapier_subscriptions`  ADD PRIMARY KEY (`id`);");
                }
            });
            
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('zapier_subscriptions', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM zapier_subscriptions"))->pluck('Key_name')->contains('url');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `zapier_subscriptions`  ADD UNIQUE KEY `url` (`url`);");
                }
            });
            
        } catch (\Exception $e) {
            
        }
        try {
            Schema::table('zapier_subscriptions', function (Blueprint $table) {
                $index_exists = collect(DB::select("SHOW INDEXES FROM zapier_subscriptions"))->pluck('Key_name')->contains('created_at');
                if (!$index_exists) {
                    DB::statement("ALTER TABLE `zapier_subscriptions`  ADD KEY `created_at` (`created_at`);");
                }
            });
        } catch (\Exception $e) {
            
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
    }

}
;
