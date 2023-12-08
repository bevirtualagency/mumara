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
        if (!Schema::hasTable('user_settings')) {
            Schema::create('user_settings', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('list_view', 10)->nullable();
                $table->string('list_tree_state', 99)->nullable();
                $table->integer('user_id');
                $table->text('notification_setting')->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent()->default(date("Y-m-d H:i:s"));
                $table->timestamp('updated_at')->useCurrentOnUpdate()->default(date("Y-m-d H:i:s"));
                $table->string('default_smtp', 255)->nullable();
                $table->string('mail_type', 20)->nullable();
                $table->longText('mail_attributes')->nullable();
                $table->string('modules', 255)->nullable();
                $table->string('addons', 255)->nullable();
                $table->integer('users')->default(0);
                $table->integer('contacts')->nullable();
                $table->integer('segments')->nullable();
                $table->integer('triggers')->nullable();
            });
            DB::statement("INSERT INTO `user_settings` (`id`, `list_view`, `list_tree_state`, `user_id`, `notification_setting`, `created_at`, `updated_at`, `default_smtp`, `mail_type`, `mail_attributes`, `modules`, `addons`, `users`, `contacts`, `segments`, `triggers`) VALUES
(1, 'list', NULL, 1, NULL, NULL, '2018-12-03 22:09:04', NULL, NULL, NULL, 'segments,suppression,split_tests,masking_domains,spin_tags,autoresponders,triggers,dynamic_content,web_forms,feedback_loop,email_templates,multi_threading,site_address_smtp', NULL, 0, NULL, NULL, NULL),
(2, 'list', NULL, 2, NULL, NULL, '2019-04-25 11:15:55', NULL, NULL, NULL, 'segments,suppression,split_tests,masking_domains,spin_tags,autoresponders,triggers,dynamic_content,web_forms,feedback_loop,email_templates,multi_threading,site_address_smtp', '', 0, NULL, NULL, NULL);");
        }
        else {
            if (!Schema::hasColumn('user_settings', 'id')) {
                Schema::table('user_settings', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('user_settings', 'list_view')) {
                Schema::table('user_settings', function (Blueprint $table) {
                    $table->string('list_view', 10)->nullable();
                });
            }
            if (!Schema::hasColumn('user_settings', 'list_tree_state')) {
                Schema::table('user_settings', function (Blueprint $table) {
                    $table->string('list_tree_state', 99)->nullable();
                });
            }
            if (!Schema::hasColumn('user_settings', 'user_id')) {
                Schema::table('user_settings', function (Blueprint $table) {
                    $table->integer('user_id');
                });
            }
            if (!Schema::hasColumn('user_settings', 'notification_setting')) {
                Schema::table('user_settings', function (Blueprint $table) {
                    $table->text('notification_setting')->nullable();
                });
            }
            if (!Schema::hasColumn('user_settings', 'created_at')) {
                Schema::table('user_settings', function (Blueprint $table) {
                    $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->nullable()->default(date("Y-m-d H:i:s"));
                });
            }
            if (!Schema::hasColumn('user_settings', 'updated_at')) {
                Schema::table('user_settings', function (Blueprint $table) {
                    $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->nullable()->useCurrent()->default(date("Y-m-d H:i:s"));
                });
            }
            if (!Schema::hasColumn('user_settings', 'default_smtp')) {
                Schema::table('user_settings', function (Blueprint $table) {
                    $table->string('default_smtp', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('user_settings', 'mail_type')) {
                Schema::table('user_settings', function (Blueprint $table) {
                    $table->string('mail_type', 20)->nullable();
                });
            }
            if (!Schema::hasColumn('user_settings', 'mail_attributes')) {
                Schema::table('user_settings', function (Blueprint $table) {
                    $table->longText('mail_attributes')->nullable();
                });
            }
            if (!Schema::hasColumn('user_settings', 'modules')) {
                Schema::table('user_settings', function (Blueprint $table) {
                    $table->string('modules', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('user_settings', 'addons')) {
                Schema::table('user_settings', function (Blueprint $table) {
                    $table->string('addons', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('user_settings', 'users')) {
                Schema::table('user_settings', function (Blueprint $table) {
                    $table->integer('users')->default(0);
                });
            }
            if (!Schema::hasColumn('user_settings', 'contacts')) {
                Schema::table('user_settings', function (Blueprint $table) {
                    $table->integer('contacts')->nullable();
                });
            }
            if (!Schema::hasColumn('user_settings', 'segments')) {
                Schema::table('user_settings', function (Blueprint $table) {
                    $table->integer('segments')->nullable();
                });
            }
            if (!Schema::hasColumn('user_settings', 'triggers')) {
                Schema::table('user_settings', function (Blueprint $table) {
                    $table->integer('triggers')->nullable();
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
        Schema::dropIfExists('user_settings');
    }

}
;
