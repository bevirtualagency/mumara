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
        if (!Schema::hasTable('application_settings')) {
            Schema::create('application_settings', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('setting_name', 255)->nullable();
                $table->text('setting_value')->nullable();
            });
            DB::statement("INSERT INTO `application_settings` (`id`, `setting_name`, `setting_value`) VALUES
(1, 'upgrade_failure_message', ''),
(2, 'current_version', NULL),
(3, 'segment_chunk_size', '1000'),
(4, 'sleep_between_two_chunk_size', '500'),
(5, 'delete_exported_segments_after', '1'),
(6, 'upgrade_status', ''),
(7, 'SERVER_ADDR', ''),
(8, 'SERVER_NAME', ''),
(9, 'new_version', '5.4.5'),
(10, 'last_contact', '0'),
(11, 'updated_version', '5.4.5'),
(13, 'multi_threading', 'on'),
(14, 'log_callbacks', '{\"log_callbacks\":{\"enabled\":0,\"file_count\":null}}'),
(16, 'cron_setting', '{\"email_send_cron\":\"1\",\"trigger_cron\":\"5\",\"bounce_process_cron\":\"120\",\"fbl_cron\":\"120\",\"file_base_processing\":\"120\",\"maintenance_cron\":\"1440\",\"segments_recount\":\"1440\",\"pending_stats\":\"15\"}'),
(17, 'ftp_detail', ''),
(19, 'default_dkim_selector', 'key'),
(20, 'default_tracking_selector', 'click'),
(21, 'key_size', '2048'),
(22, 'domain_verification', '0'),
(27, 'updated_date', '03-03-2022'),
(28, 'secure_url', 'off'),
(29, 'keep_log_for', '30'),
(30, 'default_import_chunk_size', '10000'),
(34, 'title', 'Application Title'),
(35, 'copyright', ''),
(36, 'login_title', 'Login to the Application'),
(37, 'login_desc', 'Use your registered email address and password to log in'),
(38, 'help_disable', NULL),
(39, 'allow_duplicate_sending_domains', '0'),
(40, 'duplicate_clicks_opens', '10'),
(41, 'smtp_sending_type', 'swift'),
(42, 'header_unsubscribe_email', ''),
(43, 'process_bounce_days', '2'),
(44, 'process_callbacks_via_file', '0'),
(45, 'add_header_footer', '0'),
(46, 'intellectual_tracking', 'on'),
(47, 'security', '{\"remeber_session\":1,\"session_idle_time\":{\"enabled\":0,\"time\":10080}}'),
(48, 'unsubscribe_check', 'on'),
(49, 'help_icon_switch', 'on'),
(56, 'batch_size', '100'),
(57, 'addons', ''),
(58, 'users', '0'),
(59, 'contacts_limit', NULL),
(60, 'threads', '1'),
(61, 'enable_unsubscribe_form', '1'),
(73, 'sending_node_failed', 'on'),
(74, 'broadcast_systempaused_node', 'on'),
(75, 'broadcast_autopaused_daily_limit', 'on'),
(76, 'broadcast_autopaused_monthly_limit', 'on'),
(77, 'broadcast_finished', 'on'),
(78, 'broadcast_started', 'on'),
(79, 'broadcast_scheduled', 'on'),
(80, 'segment_created', 'on'),
(81, 'segment_exported', 'on'),
(82, 'list_exported', 'on'),
(83, 'contact_list_imported', 'on'),
(84, 'bounce_rules_synced', '1'),
(85, 'use_esp_module', '1'),
(86, 'delete_export_file_after_days', '2'),
(87, 'prohibited_primary_domains', '*.cloud.mumara.com');");
        }
        else
        {
            if (!Schema::hasColumn('application_settings', 'id')) {
                Schema::table('application_settings', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
             if (!Schema::hasColumn('application_settings', 'setting_name')) {
                Schema::table('application_settings', function (Blueprint $table) {
                    $table->string('setting_name', 255)->nullable();
                });
            }
             if (!Schema::hasColumn('application_settings', 'setting_value')) {
                Schema::table('application_settings', function (Blueprint $table) {
                    $table->text('setting_value')->nullable();
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
        Schema::dropIfExists('application_settings');
    }

}
;
