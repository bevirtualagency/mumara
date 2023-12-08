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
        if (!Schema::hasTable('campaign_schedule_logs')) {
            Schema::create('campaign_schedule_logs', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('campaign_schedule_id')->nullable()->index('campaign_schedule_id');
                $table->integer('list_id')->nullable();
                $table->integer('smtp_id')->nullable();
                $table->integer('campaign_id')->index('campaign_id');
                $table->integer('subscriber_id')->index('subscriber_id');
                $table->string('subscriber_email', 255)->nullable();
                $table->integer('trigger_id')->nullable();
                $table->boolean('is_delivered')->default(false);
                $table->boolean('is_sent')->default(false)->index('is_sent');
                $table->boolean('is_clicked')->nullable();
                $table->boolean('is_open')->nullable();
                $table->boolean('is_bounced')->default(false)->index('is_bounced');
                $table->boolean('is_spammed')->default(false);
                $table->boolean('is_delayed')->nullable();
                $table->boolean('is_injected')->nullable();
                $table->integer('domain_id')->nullable();
                $table->string('domain_name', 100)->nullable()->index('domain_name');
                $table->integer('bounce_email')->nullable();
                $table->string('from_email', 255)->nullable();
                $table->string('reply_email', 255)->nullable();
                $table->string('from_name', 100)->nullable();
                $table->string('recipient_email', 255)->nullable();
                $table->integer('pixel_event_id')->default(0);
                $table->string('message_id', 255)->nullable();
                $table->integer('user_id');
                $table->integer('thread_id')->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else {
            if (!Schema::hasColumn('campaign_schedule_logs', 'id')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update campaign_schedule_logs table id', 'ALTER TABLE `campaign_schedule_logs` ADD `id` INT(11) NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`id`);', '0', NULL);");
            }
            if (!Schema::hasColumn('campaign_schedule_logs', 'campaign_schedule_id')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update campaign_schedule_logs table campaign_schedule_id', 'ALTER TABLE `campaign_schedule_logs` ADD `campaign_schedule_id` INT(11) NULL DEFAULT NULL , ADD INDEX `campaign_schedule_id` (`campaign_schedule_id`) ;', '0', NULL);");
            }
            if (!Schema::hasColumn('campaign_schedule_logs', 'list_id')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update campaign_schedule_logs table list_id', 'ALTER TABLE `campaign_schedule_logs` ADD `list_id` INT(11) NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('campaign_schedule_logs', 'smtp_id')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update campaign_schedule_logs table smtp_id', 'ALTER TABLE `campaign_schedule_logs` ADD `smtp_id` INT(11) NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('campaign_schedule_logs', 'campaign_id')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update campaign_schedule_logs table campaign_id', 'ALTER TABLE `campaign_schedule_logs` ADD `campaign_id` INT(11) NOT NULL , ADD INDEX `campaign_id` (`campaign_id`) ;', '0', NULL);");
            }
            if (!Schema::hasColumn('campaign_schedule_logs', 'subscriber_id')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update campaign_schedule_logs table subscriber_id', 'ALTER TABLE `campaign_schedule_logs` ADD `subscriber_id` INT(11) NOT NULL , ADD INDEX `subscriber_id` (`subscriber_id`);', '0', NULL);");
            }
            if (!Schema::hasColumn('campaign_schedule_logs', 'subscriber_email')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update campaign_schedule_logs table subscriber_email', 'ALTER TABLE `campaign_schedule_logs` ADD `subscriber_email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('campaign_schedule_logs', 'trigger_id')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update campaign_schedule_logs table trigger_id', 'ALTER TABLE `campaign_schedule_logs` ADD `trigger_id` INT(11) NOT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('campaign_schedule_logs', 'is_delivered')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update campaign_schedule_logs table is_delivered', 'ALTER TABLE `campaign_schedule_logs` ADD `is_delivered` TINYINT(1) NOT NULL DEFAULT 0 ;', '0', NULL);");
            }
            if (!Schema::hasColumn('campaign_schedule_logs', 'is_sent')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update campaign_schedule_logs table is_sent', 'ALTER TABLE `campaign_schedule_logs` ADD `is_sent` TINYINT(1) NOT NULL DEFAULT 0 , ADD INDEX `is_sent` (`is_sent`);', '0', NULL);");
            }
            if (!Schema::hasColumn('campaign_schedule_logs', 'is_clicked')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update campaign_schedule_logs table is_clicked', 'ALTER TABLE `campaign_schedule_logs` ADD `is_clicked` TINYINT(1) NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('campaign_schedule_logs', 'is_open')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update campaign_schedule_logs table is_open', 'ALTER TABLE `campaign_schedule_logs` ADD `is_open` TINYINT(1) NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('campaign_schedule_logs', 'is_bounced')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update campaign_schedule_logs table is_bounced', 'ALTER TABLE `campaign_schedule_logs` ADD `is_bounced` TINYINT(1) NOT NULL DEFAULT 0 , ADD INDEX `is_bounced` (`is_bounced`);', '0', NULL);");
            }
            if (!Schema::hasColumn('campaign_schedule_logs', 'is_spammed')) {
                DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update campaign_schedule_logs table is_spammed', 'ALTER TABLE `campaign_schedule_logs` ADD `is_spammed` TINYINT(1) NOT NULL DEFAULT 0 ;', '0', NULL);");
            }
            if (!Schema::hasColumn('campaign_schedule_logs', 'is_delayed')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update campaign_schedule_logs table is_delayed', 'ALTER TABLE `campaign_schedule_logs` ADD `is_delayed` TINYINT(1) NOT NULL DEFAULT 0 ;', '0', NULL);");
            }
            if (!Schema::hasColumn('campaign_schedule_logs', 'is_injected')) {
                DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update campaign_schedule_logs table is_injected', 'ALTER TABLE `campaign_schedule_logs` ADD `is_injected` TINYINT(1) NOT NULL DEFAULT 0 ;', '0', NULL);");
            }
            if (!Schema::hasColumn('campaign_schedule_logs', 'domain_id')) {
                DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update campaign_schedule_logs table domain_id', 'ALTER TABLE `campaign_schedule_logs` ADD `domain_id` INT(11) NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('campaign_schedule_logs', 'domain_name')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update campaign_schedule_logs table domain_name', 'ALTER TABLE `campaign_schedule_logs` ADD `domain_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL , ADD INDEX `domain_name` (`domain_name`);', '0', NULL);");
            }
            if (!Schema::hasColumn('campaign_schedule_logs', 'bounce_email')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update campaign_schedule_logs table bounce_email', 'ALTER TABLE `campaign_schedule_logs` ADD `bounce_email` INT(11) NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('campaign_schedule_logs', 'from_email')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update campaign_schedule_logs table from_email', 'ALTER TABLE `campaign_schedule_logs` ADD `from_email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('campaign_schedule_logs', 'reply_email')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update campaign_schedule_logs table reply_email', 'ALTER TABLE `campaign_schedule_logs` ADD `reply_email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('campaign_schedule_logs', 'from_name')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update campaign_schedule_logs table from_name', 'ALTER TABLE `campaign_schedule_logs` ADD `from_name` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('campaign_schedule_logs', 'recipient_email')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update campaign_schedule_logs table recipient_email', 'ALTER TABLE `campaign_schedule_logs` ADD `recipient_email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('campaign_schedule_logs', 'pixel_event_id')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update campaign_schedule_logs table pixel_event_id', 'ALTER TABLE `campaign_schedule_logs` ADD `pixel_event_id` INT(11) NOT NULL DEFAULT 0 ;', '0', NULL);");
            }
            if (!Schema::hasColumn('campaign_schedule_logs', 'message_id')) {
                DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update campaign_schedule_logs table message_id', 'ALTER TABLE `campaign_schedule_logs` ADD `message_id` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL , ADD INDEX `message_id` (`message_id`);', '0', NULL);");
            }
            if (!Schema::hasColumn('campaign_schedule_logs', 'user_id')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update campaign_schedule_logs table user_id', 'ALTER TABLE `campaign_schedule_logs` ADD `user_id` INT(11) NOT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('campaign_schedule_logs', 'thread_id')) {
                DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update campaign_schedule_logs table thread_id', 'ALTER TABLE `campaign_schedule_logs` ADD `thread_id` INT(11) NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('campaign_schedule_logs', 'created_at')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update campaign_schedule_logs table created_at', 'ALTER TABLE `campaign_schedule_logs` ADD `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP , ADD INDEX `created_at` (`created_at`);', '0', NULL);");
            }
            if (!Schema::hasColumn('campaign_schedule_logs', 'updated_at')) {
                DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update campaign_schedule_logs table updated_at', 'ALTER TABLE `campaign_schedule_logs` ADD `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ;', '0', NULL);");
            }

        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('campaign_schedule_logs');
    }

}
;
