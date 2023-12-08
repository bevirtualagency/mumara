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
        if (!Schema::hasTable('campaigns')) {
            DB::statement("CREATE TABLE IF NOT EXISTS `campaigns` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `group_id` int DEFAULT NULL,
  `content_url` tinyint(1) NOT NULL DEFAULT '0',
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `content_html` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `content_text` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `enable_preheader` enum('on','off') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email_pre_header_text` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `user_id` int DEFAULT NULL,
  `is_campaign_builder` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;");
            /*
              Schema::create('campaigns', function (Blueprint $table) {
              $table->integer('id', true);
              $table->string('name', 255)->nullable();
              $table->string('subject', 255)->nullable();
              $table->integer('group_id')->nullable();
              $table->boolean('content_url')->default(false);
              $table->string('url', 255)->nullable();
              $table->longText('content_html')->nullable();
              $table->longText('content_text')->nullable();
              $table->enum('enable_preheader', ['on', 'off'])->nullable();
              $table->longText('email_pre_header_text')->nullable();
              $table->integer('user_id')->nullable();
              $table->boolean('is_campaign_builder')->default(false);
              $table->timestamp('created_at')->nullable()->useCurrent();
              $table->timestamp('updated_at')->useCurrentOnUpdate();
              });
             */
        }
         else {
            if (!Schema::hasColumn('campaigns', 'id')) {
                Schema::table('campaigns', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('campaigns', 'name')) {
                Schema::table('campaigns', function (Blueprint $table) {
                   $table->string('name', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('campaigns', 'subject')) {
                Schema::table('campaigns', function (Blueprint $table) {
                   $table->string('subject', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('campaigns', 'group_id')) {
                Schema::table('campaigns', function (Blueprint $table) {
                   $table->integer('group_id')->nullable();
                });
            }
            if (!Schema::hasColumn('campaigns', 'content_url')) {
                Schema::table('campaigns', function (Blueprint $table) {
                   $table->boolean('content_url')->default(false);
                });
            }
            if (!Schema::hasColumn('campaigns', 'url')) {
                Schema::table('campaigns', function (Blueprint $table) {
                   $table->string('url', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('campaigns', 'content_html')) {
                Schema::table('campaigns', function (Blueprint $table) {
                   $table->longText('content_html')->nullable();
                });
            }
            if (!Schema::hasColumn('campaigns', 'content_text')) {
                Schema::table('campaigns', function (Blueprint $table) {
                   $table->longText('content_text')->nullable();
                });
            }
            if (!Schema::hasColumn('campaigns', 'enable_preheader')) {
                Schema::table('campaigns', function (Blueprint $table) {
                   $table->enum('enable_preheader', ['on', 'off'])->nullable();
                });
            }
            if (!Schema::hasColumn('campaigns', 'user_id')) {
                Schema::table('campaigns', function (Blueprint $table) {
                    $table->integer('user_id')->nullable();
                });
            }
            if (!Schema::hasColumn('campaigns', 'is_campaign_builder')) {
                Schema::table('campaigns', function (Blueprint $table) {
                   $table->boolean('is_campaign_builder')->default(false);
                });
            }
            if (!Schema::hasColumn('campaigns', 'created_at')) {
                Schema::table('campaigns', function (Blueprint $table) {
                  $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('campaigns', 'updated_at')) {
                Schema::table('campaigns', function (Blueprint $table) {
                   $table->timestamp('updated_at')->useCurrentOnUpdate();
                });
            }
            if (!Schema::hasColumn('campaigns', 'email_pre_header_text')) {
                Schema::table('campaigns', function (Blueprint $table) {
                   $table->longText('email_pre_header_text')->nullable();
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
        Schema::dropIfExists('campaigns');
    }

}
;
