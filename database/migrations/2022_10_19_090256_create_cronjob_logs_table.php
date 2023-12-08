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
        if (!Schema::hasTable('cronjob_logs')) {
            Schema::create('cronjob_logs', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('cron', 255)->nullable();
                $table->dateTime('datetime')->nullable();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
                $table->timestamp('created_at')->nullable()->useCurrent();
            });
        }
        else {
            if (!Schema::hasColumn('cronjob_logs', 'id')) {
                Schema::table('cronjob_logs', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('cronjob_logs', 'cron')) {
                Schema::table('cronjob_logs', function (Blueprint $table) {
                    $table->string('cron', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('cronjob_logs', 'datetime')) {
                Schema::table('cronjob_logs', function (Blueprint $table) {
                    $table->dateTime('datetime')->nullable();
                });
            }
            if (!Schema::hasColumn('cronjob_logs', 'updated_at')) {
                Schema::table('cronjob_logs', function (Blueprint $table) {
                   $table->timestamp('updated_at')->useCurrentOnUpdate();
                });
            }
            if (!Schema::hasColumn('cronjob_logs', 'created_at')) {
                Schema::table('cronjob_logs', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
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
        Schema::dropIfExists('cronjob_logs');
    }

}
;
