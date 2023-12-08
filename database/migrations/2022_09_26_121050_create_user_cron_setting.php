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
        if (!Schema::hasTable('user_cron_settings')) {
            Schema::create('user_cron_settings', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('cron_name', 55)->nullable();
                $table->integer('cron_value')->nullable();
                $table->string('cron_time', 20)->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            });

            DB::statement("INSERT INTO `user_cron_settings` (`id`, `cron_name`, `cron_value`) VALUES
                (1, 'email_send_cron', 1 ),
                (2, 'trigger_cron', 15),
                (3, 'bounce_process_cron', 120),
                (4, 'fbl_cron', 360),
                (5, 'maintenance_cron', 1440),
                (6, 'segments_recount', 1440),
                (7, 'pending_stats', 15),
                (8, 'delete_exported_files', 1440),
                (9, 'click_tracking', 1),
                (10, 'limits_reset', 24),
                (11, 'evergreen_campaigns', 5),
                (12, 'triggers_checkup', 1440);");
            }
        else {
            if (!Schema::hasColumn('user_cron_settings', 'id')) {
                Schema::table('user_cron_settings', function (Blueprint $table) {
                    $table->bigIncrements('id');
                });
            }
            if (!Schema::hasColumn('user_cron_settings', 'cron_name')) {
                Schema::table('user_cron_settings', function (Blueprint $table) {
                    $table->string('cron_name', 55)->nullable();
                });
            }
            if (!Schema::hasColumn('user_cron_settings', 'cron_value')) {
                Schema::table('user_cron_settings', function (Blueprint $table) {
                    $table->integer('cron_value')->nullable();
                });
            }
            if (!Schema::hasColumn('user_cron_settings', 'cron_time')) {
                Schema::table('user_cron_settings', function (Blueprint $table) {
                    $table->string('cron_time', 20)->nullable();
                });
            }
            if (!Schema::hasColumn('user_cron_settings', 'created_at')) {
                Schema::table('user_cron_settings', function (Blueprint $table) {
                    $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
             if (!Schema::hasColumn('user_cron_settings', 'updated_at')) {
                Schema::table('user_cron_settings', function (Blueprint $table) {
                   $table->timestamp('updated_at')->useCurrentOnUpdate();
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
        Schema::dropIfExists('user_cron_settings');
    }

}
;
