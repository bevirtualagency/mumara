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
        if (!Schema::hasTable('email_complaints')) {
            Schema::create('email_complaints', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('campaing_schedule_logs_id')->index('campaing_schedule_logs_id');
                $table->integer('broadcast_id')->nullable();
                $table->integer('scheduled_id')->nullable()->index('scheduled_id');
                $table->integer('contact_id')->nullable();
                $table->integer('sd_id')->nullable();
                $table->integer('sn_id')->nullable();
                $table->string('email', 100)->nullable();
                $table->mediumText('detail')->nullable();
                $table->unsignedInteger('fbl_id')->nullable();
                $table->string('message_id', 255)->nullable();
                $table->unsignedInteger('trigger_id')->nullable();
                $table->unsignedInteger('user_id')->nullable();
                $table->timestamp('abused_at')->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else {
            if (!Schema::hasColumn('email_complaints', 'id')) {
                Schema::table('email_complaints', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('email_complaints', 'campaing_schedule_logs_id')) {
                Schema::table('email_complaints', function (Blueprint $table) {
                    $table->integer('campaing_schedule_logs_id')->index('campaing_schedule_logs_id');
                });
            }
            if (!Schema::hasColumn('email_complaints', 'broadcast_id')) {
                Schema::table('email_complaints', function (Blueprint $table) {
                    $table->integer('broadcast_id')->nullable();
                });
            }
            if (!Schema::hasColumn('email_complaints', 'scheduled_id')) {
                Schema::table('email_complaints', function (Blueprint $table) {
                    $table->integer('scheduled_id')->nullable()->index('scheduled_id');
                });
            }
            if (!Schema::hasColumn('email_complaints', 'contact_id')) {
                Schema::table('email_complaints', function (Blueprint $table) {
                    $table->integer('contact_id')->nullable();
                });
            }
            if (!Schema::hasColumn('email_complaints', 'sd_id')) {
                Schema::table('email_complaints', function (Blueprint $table) {
                    $table->integer('sd_id')->nullable();
                });
            }
            if (!Schema::hasColumn('email_complaints', 'sn_id')) {
                Schema::table('email_complaints', function (Blueprint $table) {
                    $table->integer('sn_id')->nullable();
                });
            }
            if (!Schema::hasColumn('email_complaints', 'email')) {
                Schema::table('email_complaints', function (Blueprint $table) {
                    $table->string('email', 100)->nullable();
                });
            }
            if (!Schema::hasColumn('email_complaints', 'detail')) {
                Schema::table('email_complaints', function (Blueprint $table) {
                    $table->mediumText('detail')->nullable();
                });
            }
            if (!Schema::hasColumn('email_complaints', 'fbl_id')) {
                Schema::table('email_complaints', function (Blueprint $table) {
                    $table->unsignedInteger('fbl_id')->nullable();
                });
            }
            if (!Schema::hasColumn('email_complaints', 'message_id')) {
                Schema::table('email_complaints', function (Blueprint $table) {
                    $table->string('message_id', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('email_complaints', 'trigger_id')) {
                Schema::table('email_complaints', function (Blueprint $table) {
                    $table->unsignedInteger('trigger_id')->nullable();
                });
            }
            if (!Schema::hasColumn('email_complaints', 'user_id')) {
                Schema::table('email_complaints', function (Blueprint $table) {
                    $table->unsignedInteger('user_id')->nullable();
                });
            }
            if (!Schema::hasColumn('email_complaints', 'abused_at')) {
                Schema::table('email_complaints', function (Blueprint $table) {
                    $table->timestamp('abused_at')->nullable();
                });
            }
            if (!Schema::hasColumn('email_complaints', 'created_at')) {
                Schema::table('email_complaints', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('email_complaints', 'updated_at')) {
                Schema::table('email_complaints', function (Blueprint $table) {
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
        Schema::dropIfExists('email_complaints');
    }

}
;
