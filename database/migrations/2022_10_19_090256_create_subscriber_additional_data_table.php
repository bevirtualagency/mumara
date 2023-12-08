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
        if (!Schema::hasTable('subscriber_additional_data')) {
            Schema::create('subscriber_additional_data', function (Blueprint $table) {
                $table->integer('subscriber_id')->index('subscriber_id');
                $table->integer('custom_field_id')->nullable()->index('custom_field_id');
                $table->text('value')->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else {
            if (!Schema::hasColumn('subscriber_additional_data', 'subscriber_id')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update subscriber_additional_data table subscriber_id', 'ALTER TABLE `subscriber_additional_data` ADD `subscriber_id` INT(11) NOT NULL FIRST;CREATE INDEX subscriber_additional_data_fk ON subscriber_additional_data (subscriber_id);', '0', NULL);");
            }
             if (!Schema::hasColumn('subscriber_additional_data', 'custom_field_id')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update subscriber_additional_data table custom_field_id', 'ALTER TABLE `subscriber_additional_data` ADD `custom_field_id` INT(11) NULL DEFAULT NULL;CREATE INDEX subscriber_additional_data_ibfk_1 ON subscriber_additional_data (custom_field_id);', '0', NULL);");
            }
             if (!Schema::hasColumn('subscriber_additional_data', 'value')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update subscriber_additional_data table value', 'ALTER TABLE  `subscriber_additional_data` ADD `value` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ;', '0', NULL);");
            }
             if (!Schema::hasColumn('subscriber_additional_data', 'created_at')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update subscriber_additional_data table created_at', 'ALTER TABLE `subscriber_additional_data` ADD `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ;', '0', NULL);");
            }
             if (!Schema::hasColumn('subscriber_additional_data', 'updated_at')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update subscriber_additional_data table updated_at', 'ALTER TABLE `subscriber_additional_data` ADD `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ;', '0', NULL);");
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('subscriber_additional_data');
    }

}
;
