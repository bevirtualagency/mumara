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
        if (!Schema::hasTable('suppression_emails')) {
            Schema::create('suppression_emails', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('label', 255)->nullable();
                $table->string('email', 255)->nullable()->index('email_key');                
                $table->integer('list_id')->nullable();
                $table->integer('import_id')->nullable();
                $table->boolean('is_suppressed')->default(false);
                $table->integer('user_id');
                $table->integer('campaign_id')->nullable();
                $table->string('supression_type', 30)->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else {
            if (!Schema::hasColumn('suppression_emails', 'id')) {
                DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update subscriber table id', 'ALTER TABLE `suppression_emails` ADD `id` INT(11) NOT NULL FIRST;', '0', NULL);");
            }
            if (!Schema::hasColumn('suppression_emails', 'label')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update subscriber table id', 'ALTER TABLE `suppression_emails` ADD `label` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('suppression_emails', 'email')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update subscriber table id', 'ALTER TABLE `suppression_emails` ADD `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL , ADD INDEX `email_key` (`email`);', '0', NULL);");
            }
            if (!Schema::hasColumn('suppression_emails', 'list_id')) {
                DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update subscriber table list_id', 'ALTER TABLE `suppression_emails` ADD `list_id` INT(11) NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('suppression_emails', 'import_id')) {
                  DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update subscriber table import_id', 'ALTER TABLE `suppression_emails` ADD `import_id` INT(11) NULL DEFAULT NULL ', '0', NULL);");
            }
            if (!Schema::hasColumn('suppression_emails', 'is_suppressed')) {
                  DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update subscriber table is_suppressed', 'ALTER TABLE `suppression_emails` ADD `is_suppressed` TINYINT(1) NOT NULL DEFAULT 0 ;', '0', NULL);");
            }
            if (!Schema::hasColumn('suppression_emails', 'user_id')) {
                  DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update subscriber table user_id', 'ALTER TABLE `suppression_emails` ADD `user_id` INT(11) NOT NULL;', '0', NULL);");
            }
            if (!Schema::hasColumn('suppression_emails', 'campaign_id')) {
                  DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update subscriber table campaign_id', 'ALTER TABLE `suppression_emails` ADD `campaign_id` INT(11) NULL DEFAULT NULL', '0', NULL);");
            }
            if (!Schema::hasColumn('suppression_emails', 'supression_type')) {
                  DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update subscriber table supression_type', 'ALTER TABLE `suppression_emails` ADD `supression_type` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('suppression_emails', 'created_at')) {
                  DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update subscriber table created_at', 'ALTER TABLE `suppression_emails` ADD `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP , ADD INDEX `created_at` (`created_at`);', '0', NULL);");
            }
            if (!Schema::hasColumn('suppression_emails', 'updated_at')) {
                  DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update subscriber table updated_at', 'ALTER TABLE `suppression_emails` ADD `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ;', '0', NULL);");
            }

        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('suppression_emails');
    }

}
;
