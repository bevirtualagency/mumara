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
        if (!Schema::hasTable('email_opened')) {
            Schema::create('email_opened', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('broadcast_id')->nullable();
                $table->integer('scheduled_id')->nullable()->index('scheduled_id');
                $table->integer('contact_id')->nullable()->index('contact_id');
                $table->integer('sd_id')->nullable();
                $table->integer('sn_id')->nullable();
                $table->integer('campaign_schedule_logs_id')->index('campaign_schedule_logs_id');
                $table->boolean('is_clicked')->nullable()->default(false);
                $table->string('ip_address', 50)->nullable();
                $table->string('ip_country', 55)->nullable();
                $table->string('ip_region', 55)->nullable();
                $table->string('ip_city', 55)->nullable();
                $table->string('ip_zip', 10)->nullable();
                $table->string('user_agent', 255)->nullable();
                $table->string('platform', 50)->nullable();
                $table->string('browser', 50)->nullable();
                $table->string('device', 50)->nullable();
                $table->boolean('is_bot')->nullable();
                $table->integer('user_id')->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent()->index('created_at');
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else {
            if (!Schema::hasColumn('email_opened', 'id')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_opened table id', 'ALTER TABLE `email_opened` ADD `id` INT(11) NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`id`);', '0', NULL);");
            }
            if (!Schema::hasColumn('email_opened', 'broadcast_id')) {
                  DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_opened table broadcast_id', 'ALTER TABLE `email_opened` ADD `broadcast_id` INT(11) NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('email_opened', 'scheduled_id')) {
                  DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_opened table scheduled_id', 'ALTER TABLE `email_opened` ADD `scheduled_id` INT(11) NULL DEFAULT NULL , ADD INDEX `scheduled_id` (`scheduled_id`) ;', '0', NULL);");
            }
            if (!Schema::hasColumn('email_opened', 'contact_id')) {
                  DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_opened table contact_id', 'ALTER TABLE `email_opened` ADD `contact_id` INT(11) NULL DEFAULT NULL , ADD INDEX `contact_id` (`contact_id`) ;', '0', NULL);");
            }
            
            if (!Schema::hasColumn('email_opened', 'sd_id')) {
                  DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_opened table sd_id', 'ALTER TABLE `email_opened` ADD `sd_id` INT(11) NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('email_opened', 'sn_id')) {
                  DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_opened table sn_id', 'ALTER TABLE `email_opened` ADD `sn_id` INT(11) NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('email_opened', 'campaign_schedule_logs_id')) {
                  DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_opened table campaign_schedule_logs_id', 'ALTER TABLE `email_opened` ADD `campaign_schedule_logs_id` INT(11) NULL , ADD INDEX `campaign_schedule_logs_id` (`campaign_schedule_logs_id`) ;', '0', NULL);");
            }
            if (!Schema::hasColumn('email_opened', 'is_clicked')) {
                  DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_opened table is_clicked', 'ALTER TABLE `email_opened` ADD `is_clicked` TINYINT(1) NULL DEFAULT 0 ;', '0', NULL);");
            }
            if (!Schema::hasColumn('email_opened', 'ip_address')) {
                  DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_opened table ip_address', 'ALTER TABLE `email_opened` ADD `ip_address` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('email_opened', 'ip_country')) {
                  DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_opened table ip_country', 'ALTER TABLE `email_opened` ADD `ip_country` VARCHAR(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('email_opened', 'ip_region')) {
                  DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_opened table ip_region', 'ALTER TABLE `email_opened` ADD `ip_region` VARCHAR(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('email_opened', 'ip_city')) {
                  DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_opened table ip_city', 'ALTER TABLE `email_opened` ADD `ip_city` VARCHAR(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('email_opened', 'ip_zip')) {
                  DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_opened table ip_zip', 'ALTER TABLE `email_opened` ADD `ip_zip` VARCHAR(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('email_opened', 'user_agent')) {
                  DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_opened table user_agent', 'ALTER TABLE `email_opened` ADD `user_agent` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('email_opened', 'platform')) {
                  DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_opened table platform', 'ALTER TABLE `email_opened` ADD `platform` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('email_opened', 'browser')) {
                  DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_opened table browser', 'ALTER TABLE `email_opened` ADD `browser` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('email_opened', 'device')) {
                  DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_opened table device', 'ALTER TABLE `email_opened` ADD `device` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('email_opened', 'is_bot')) {
                  DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_opened table is_bot', 'ALTER TABLE `email_opened` ADD `is_bot` TINYINT(1) NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('email_opened', 'user_id')) {
                  DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_opened table user_id', 'ALTER TABLE `email_opened` ADD `user_id` INT(11) NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('email_opened', 'created_at')) {
                  DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_opened table created_at', 'ALTER TABLE `email_opened` ADD `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP , ADD INDEX `created_at` (`created_at`);', '0', NULL);");
            }
            if (!Schema::hasColumn('email_opened', 'updated_at')) {         
                  DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_opened table updated_at', 'ALTER TABLE `email_opened` ADD `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ;', '0', NULL);");
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('email_opened');
    }

}
;
