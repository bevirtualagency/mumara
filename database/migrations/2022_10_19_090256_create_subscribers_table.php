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
        if (!Schema::hasTable('subscribers')) {
            Schema::create('subscribers', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('email', 100)->nullable()->index('email');
                $table->string('md5', 255)->nullable();
                $table->string('domain_name', 100)->nullable()->index('domain_name');
                $table->integer('list_id')->nullable()->index('list_id');
                $table->integer('import_id')->nullable();
                $table->enum('added', ['manual', 'import', 'webform', 'api'])->default('manual');
                $table->enum('bounced', ['no_process', 'soft', 'hard'])->nullable()->default('no_process');
                $table->boolean('is_spamed')->default(false);
                $table->boolean('is_unsubscribed')->default(false);
                $table->boolean('is_confirmed')->default(true);
                $table->boolean('is_verified')->default(false);
                $table->boolean('is_active')->default(true);
                $table->boolean('never_sent')->nullable();
                $table->tinyInteger('is_sent')->nullable();
                $table->enum('format', ['text', 'html'])->nullable();
                $table->string('image', 11)->nullable();
                $table->enum('suppression_type', ['email', 'domain', 'ip'])->nullable();
                $table->integer('suppression_id')->nullable();
                $table->integer('user_id')->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else {
            
            if (!Schema::hasColumn('subscribers', 'id')) {
                DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update subscriber table id', 'ALTER TABLE `subscribers` ADD `id` INT(11) NOT NULL FIRST;', '0', NULL);");
            }
            if (!Schema::hasColumn('subscribers', 'email')) {     
                   DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update subscriber table email', 'ALTER TABLE `subscribers` ADD `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL , ADD INDEX `email` (`email`);', '0', NULL);");                                                                                                                                  
            }
            if (!Schema::hasColumn('subscribers', 'md5')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update subscriber table md5', 'ALTER TABLE `subscribers` ADD `md5` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ;', '0', NULL);");
            }      
            if (!Schema::hasColumn('subscribers', 'domain_name')) {
                   DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update subscriber table domain_name', 'ALTER TABLE `subscribers` ADD `domain_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL , ADD INDEX `domain_name` (`domain_name`) ;', '0', NULL);");
            }
            if (!Schema::hasColumn('subscribers', 'list_id')) {
                   DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update subscriber table list_id', 'ALTER TABLE `subscribers` ADD `list_id` INT(11) NULL DEFAULT NULL ;CREATE INDEX subscribers_ibfk_1 ON subscribers (list_id);', '0', NULL);");                   
            }
            if (!Schema::hasColumn('subscribers', 'import_id')) {
                    DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update subscriber table import_id', 'ALTER TABLE `subscribers` ADD `import_id` INT(11) NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('subscribers', 'added')) {
                $enum = "ALTER TABLE `subscribers` ADD `added` ENUM('manual','import','webform','api') NULL DEFAULT 'manual';";
                $array = array(
                    'name'=>'Update subscriber table added',
                    'query'=>$enum,
                    'status'=>0,
                    'fields'=>null
                );
                DB::table("alter_tables")->insert($array);
            }
            if (!Schema::hasColumn('subscribers', 'bounced')) {
                $enum = "ALTER TABLE `subscribers` ADD `bounced` ENUM('no_process','soft','hard') NULL DEFAULT 'no_process';";
               $array = array(
                    'name'=>'Update subscriber table bounced',
                    'query'=>$enum,
                    'status'=>0,
                    'fields'=>null
                );
                DB::table("alter_tables")->insert($array);
            }
            if (!Schema::hasColumn('subscribers', 'is_spamed')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update subscriber table is_spamed', 'ALTER TABLE `subscribers` ADD `is_spamed` TINYINT(1) NULL DEFAULT 0 ;', '0', NULL);");
            }
            if (!Schema::hasColumn('subscribers', 'is_unsubscribed')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update subscriber table is_unsubscribed', 'ALTER TABLE `subscribers` ADD `is_unsubscribed` TINYINT(1) NULL DEFAULT 0 ;', '0', NULL);");
            }
            if (!Schema::hasColumn('subscribers', 'is_confirmed')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update subscriber table is_confirmed', 'ALTER TABLE `subscribers` ADD `is_confirmed` TINYINT(1) NULL DEFAULT 1;', '0', NULL);");
            }
            if (!Schema::hasColumn('subscribers', 'is_verified')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update subscriber table is_verified', 'ALTER TABLE `subscribers` ADD `is_verified` TINYINT(1) NOT NULL DEFAULT 0 ;', '0', NULL);");
            }
            if (!Schema::hasColumn('subscribers', 'is_active')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update subscriber table is_active', 'ALTER TABLE `subscribers` ADD `is_active` TINYINT(1) NOT NULL DEFAULT 1 ;', '0', NULL);");
            }
            if (!Schema::hasColumn('subscribers', 'never_sent')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update subscriber table never_sent', 'ALTER TABLE `subscribers` ADD `never_sent` TINYINT(1) NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('subscribers', 'is_sent')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update subscriber table is_sent', 'ALTER TABLE `subscribers` ADD `is_sent` TINYINT(4) NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('subscribers', 'format')) {
                 $enum = "ALTER TABLE `subscribers` ADD `format` ENUM('text','html') NULL DEFAULT NULL;";
               $array = array(
                    'name'=>'Update subscriber table format',
                    'query'=>$enum,
                    'status'=>0,
                    'fields'=>null
                );
                DB::table("alter_tables")->insert($array);  
            }
            if (!Schema::hasColumn('subscribers', 'image')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update subscriber table image', 'ALTER TABLE `subscribers` ADD `image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('subscribers', 'suppression_type')) {
                $enum = "ALTER TABLE `subscribers` ADD `suppression_type` ENUM('email','domain','ip') NULL DEFAULT NULL;";
               $array = array(
                    'name'=>'Update subscriber table suppression_type',
                    'query'=>$enum,
                    'status'=>0,
                    'fields'=>null
                );
                DB::table("alter_tables")->insert($array);  
            }
            if (!Schema::hasColumn('subscribers', 'suppression_id')) {                
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update subscriber table suppression_id', 'ALTER TABLE `subscribers` ADD `suppression_id` INT(11) NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('subscribers', 'user_id')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update subscriber table user_id', 'ALTER TABLE `subscribers` ADD `user_id` INT(11) NULL DEFAULT NULL ;', '0', NULL);");
            }
            if (!Schema::hasColumn('subscribers', 'created_at')) {
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update subscriber table created_at', 'ALTER TABLE `subscribers` ADD `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP , ADD INDEX `created_at` (`created_at`);', '0', NULL);");
            }
            if (!Schema::hasColumn('subscribers', 'updated_at')) {               
                 DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `query`, `status`, `fields` ) VALUES (NULL, 'Update subscriber table updated_at', 'ALTER TABLE `subscribers` ADD `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ;', '0', NULL);");
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('subscribers');
    }

}
;
