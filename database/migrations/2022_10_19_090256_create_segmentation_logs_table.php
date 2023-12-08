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
        if (!Schema::hasTable('segmentation_logs')) {
            Schema::create('segmentation_logs', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('segment_id')->nullable();
                $table->integer('user_id')->nullable();
                $table->string('action', 255)->nullable();
                $table->mediumText('description')->nullable();
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else {
            if (!Schema::hasColumn('segmentation_logs', 'id')) {
                  DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update segmentation_logs table id', 'ALTER TABLE `segmentation_logs` ADD `id` INT(11) NOT NULL FIRST;', '0', NULL);");
            }
            if (!Schema::hasColumn('segmentation_logs', 'segment_id')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update segmentation_logs table segment_id', 'ALTER TABLE `segmentation_logs` ADD `segment_id` INT(11) NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('segmentation_logs', 'user_id')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update segmentation_logs table user_id', 'ALTER TABLE `segmentation_logs` ADD `user_id` INT(11) NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('segmentation_logs', 'action')) {
                  DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update segmentation_logs table action', 'ALTER TABLE `segmentation_logs` ADD `action` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('segmentation_logs', 'description')) {
                  DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update segmentation_logs table description', 'ALTER TABLE `segmentation_logs` ADD `description` MEDIUMTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('segmentation_logs', 'created_at')) {
                  DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update segmentation_logs table updated_at', 'ALTER TABLE `segmentation_logs` ADD `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ;', '0', NULL);");
            }
            if (!Schema::hasColumn('segmentation_logs', 'updated_at')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update segmentation_logs table updated_at', 'ALTER TABLE `segmentation_logs` ADD `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ;', '0', NULL);");
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('segmentation_logs');
    }

}
;
