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
        if (!Schema::hasTable('email_clicked')) {
            Schema::create('email_clicked', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('broadcast_id')->nullable();
                $table->integer('scheduled_id')->nullable()->index('scheduled_id');
                $table->integer('contact_id')->nullable()->index('contact_id');
                $table->integer('sd_id')->nullable();
                $table->integer('sn_id')->nullable();
                $table->integer('campaign_schedule_logs_id')->index('campaign_schedule_logs_id');
                $table->integer('link_id')->nullable();
                $table->string('link', 255)->nullable();
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
                $table->timestamp('created_at')->nullable()->useCurrent()->index('created_at');
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else {
            if (!Schema::hasColumn('email_clicked', 'id')) {
                DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_clicked table id', 'ALTER TABLE `email_clicked` ADD `id` INT(11) NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`id`);', '0', NULL);");
            }
            if (!Schema::hasColumn('email_clicked', 'broadcast_id')) {
                DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_clicked table broadcast_id', 'ALTER TABLE `email_clicked` ADD `broadcast_id` INT(11) NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('email_clicked', 'scheduled_id')) {
               DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_clicked table scheduled_id', 'ALTER TABLE `email_clicked` ADD `scheduled_id` INT(11) NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('email_clicked', 'contact_id')) {
               DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_clicked table contact_id', 'ALTER TABLE `email_clicked` ADD `contact_id` INT(11) NULL DEFAULT NULL ;', '0', NULL);");
            }
            //  if (!Schema::hasColumn('email_clicked', 'list_id')) {
            //     DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update Open Table', 'ALTER TABLE `email_clicked` ADD `list_id` INT(11) NULL DEFAULT NULL AFTER `contact_id`, ADD INDEX `list_id` (`list_id`);', '0', NULL);");
            // }
            
            if (!Schema::hasColumn('email_clicked', 'sd_id')) {
                DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_clicked table sd_id', 'ALTER TABLE `email_clicked` ADD `sd_id` INT(11) NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('email_clicked', 'sn_id')) {
               DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_clicked table sn_id', 'ALTER TABLE `email_clicked` ADD `sn_id` INT(11) NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('email_clicked', 'campaign_schedule_logs_id')) {
               DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_clicked table campaign_schedule_logs_id', 'ALTER TABLE `email_clicked` ADD `campaign_schedule_logs_id` INT(11) NOT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('email_clicked', 'link_id')) {
                DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_clicked table link_id', 'ALTER TABLE `email_clicked` ADD `link_id` INT(11) NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('email_clicked', 'link')) {
                DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_clicked table link', 'ALTER TABLE `email_clicked` ADD `link` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('email_clicked', 'ip_address')) {
               DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_clicked table ip_address', 'ALTER TABLE `email_clicked` ADD `ip_address` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('email_clicked', 'ip_country')) {
               DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_clicked table ip_country', 'ALTER TABLE `email_clicked` ADD `ip_country` VARCHAR(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('email_clicked', 'ip_region')) {
                DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_clicked table ip_region', 'ALTER TABLE `email_clicked` ADD `ip_region` VARCHAR(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('email_clicked', 'ip_city')) {
               DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_clicked table ip_city', 'ALTER TABLE `email_clicked` ADD `ip_city` VARCHAR(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('email_clicked', 'ip_zip')) {
                DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_clicked table ip_zip', 'ALTER TABLE `email_clicked` ADD `ip_zip` VARCHAR(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('email_clicked', 'user_agent')) {
                DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_clicked table user_agent', 'ALTER TABLE `email_clicked` ADD `user_agent` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('email_clicked', 'platform')) {
               DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_clicked table platform', 'ALTER TABLE `email_clicked` ADD `platform` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('email_clicked', 'browser')) {
                DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_clicked table browser', 'ALTER TABLE `email_clicked` ADD `browser` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('email_clicked', 'device')) {
               DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_clicked table device', 'ALTER TABLE `email_clicked` ADD `device` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('email_clicked', 'is_bot')) {
               DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_clicked table is_bot', 'ALTER TABLE `email_clicked` ADD `is_bot` TINYINT(1) NULL DEFAULT NULL;', '0', NULL);");
            }
            if (!Schema::hasColumn('email_clicked', 'created_at')) {
               DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_clicked table created_at', 'ALTER TABLE `email_clicked` ADD `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ;', '0', NULL);");
            }
            if (!Schema::hasColumn('email_clicked', 'updated_at')) {
                DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update email_clicked table updated_at', 'ALTER TABLE `email_clicked` ADD `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ;', '0', NULL);");
            }
        
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('email_clicked');
    }

}
;
