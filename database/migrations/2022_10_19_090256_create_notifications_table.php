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
        if (!Schema::hasTable('notifications')) {
            Schema::create('notifications', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('title', 255)->nullable();
                $table->text('description')->nullable();
                $table->boolean('is_publish')->default(false);
                $table->integer('user_id');
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else {
             if (!Schema::hasColumn('notifications', 'id')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update notifications table id', 'ALTER TABLE `notifications` ADD `id` INT(11) NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`id`);', '0', NULL);");
            }
            if (!Schema::hasColumn('notifications', 'title')) {
                DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update notifications table title', 'ALTER TABLE `notifications` ADD `title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('notifications', 'description')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update notifications table description', 'ALTER TABLE `notifications` ADD `description` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('notifications', 'is_publish')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update notifications table is_publish', 'ALTER TABLE `notifications` ADD `is_publish` TINYINT(1) NOT NULL DEFAULT 0 ;', '0', NULL);");
            }
            if (!Schema::hasColumn('notifications', 'user_id')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update notifications table user_id', 'ALTER TABLE `notifications` ADD `user_id` INT(11) NOT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('notifications', 'created_at')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update notifications table created_at', 'ALTER TABLE `notifications` ADD `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP , ADD INDEX `created_at` (`created_at`)', '0', NULL);");
            }
            if (!Schema::hasColumn('notifications', 'updated_at')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update notifications table updated_at', 'ALTER TABLE `notifications` ADD `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ;', '0', NULL);");
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('notifications');
    }

}
;
