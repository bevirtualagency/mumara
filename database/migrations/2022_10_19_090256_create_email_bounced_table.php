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
        if (!Schema::hasTable('email_bounced')) {
            Schema::create('email_bounced', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('campaing_schedule_logs_id')->index('campaing_schedule_logs_id');
                $table->unsignedInteger('broadcast_id')->nullable();
                $table->unsignedInteger('schedule_id')->nullable()->index('schedule_id');
                $table->unsignedInteger('contact_id')->nullable();
                $table->integer('sd_id')->nullable();
                $table->integer('sn_id')->nullable();
                $table->string('email', 100)->nullable();
                $table->enum('type', ['soft', 'hard', 'no_process'])->nullable();
                $table->string('category', 255)->nullable();
                $table->string('code', 50)->nullable();
                $table->string('reason', 255)->nullable();
                $table->text('detail')->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else {
            if (!Schema::hasColumn('email_bounced', 'id')) {
                Schema::table('email_bounced', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('email_bounced', 'campaing_schedule_logs_id')) {
                Schema::table('email_bounced', function (Blueprint $table) {
                    $table->integer('campaing_schedule_logs_id')->index('campaing_schedule_logs_id');
                });
            }
            if (!Schema::hasColumn('email_bounced', 'broadcast_id')) {
                Schema::table('email_bounced', function (Blueprint $table) {
                    $table->unsignedInteger('broadcast_id')->nullable();
                });
            }
            if (!Schema::hasColumn('email_bounced', 'schedule_id')) {
                Schema::table('email_bounced', function (Blueprint $table) {
                    $table->unsignedInteger('schedule_id')->nullable()->index('schedule_id');
                });
            }
            if (!Schema::hasColumn('email_bounced', 'contact_id')) {
                Schema::table('email_bounced', function (Blueprint $table) {
                    $table->unsignedInteger('contact_id')->nullable();
                });
            }
            if (!Schema::hasColumn('email_bounced', 'sd_id')) {
                Schema::table('email_bounced', function (Blueprint $table) {
                    $table->integer('sd_id')->nullable();
                });
            }
            if (!Schema::hasColumn('email_bounced', 'sn_id')) {
                Schema::table('email_bounced', function (Blueprint $table) {
                    $table->integer('sn_id')->nullable();
                });
            }
            if (!Schema::hasColumn('email_bounced', 'email')) {
                Schema::table('email_bounced', function (Blueprint $table) {
                    $table->string('email', 100)->nullable();
                });
            }
            if (!Schema::hasColumn('email_bounced', 'type')) {
                Schema::table('email_bounced', function (Blueprint $table) {
                    $table->enum('type', ['soft', 'hard', 'no_process'])->nullable();
                });
            }
            if (!Schema::hasColumn('email_bounced', 'category')) {
                Schema::table('email_bounced', function (Blueprint $table) {
                    $table->string('category', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('email_bounced', 'code')) {
                Schema::table('email_bounced', function (Blueprint $table) {
                    $table->string('code', 50)->nullable();
                });
            }
            if (!Schema::hasColumn('email_bounced', 'reason')) {
                Schema::table('email_bounced', function (Blueprint $table) {
                    $table->string('reason', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('email_bounced', 'detail')) {
                Schema::table('email_bounced', function (Blueprint $table) {
                    $table->text('detail')->nullable();
                });
            }
            if (!Schema::hasColumn('email_bounced', 'created_at')) {
                Schema::table('email_bounced', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('email_bounced', 'updated_at')) {
                Schema::table('email_bounced', function (Blueprint $table) {
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
        Schema::dropIfExists('email_bounced');
    }

}
;
