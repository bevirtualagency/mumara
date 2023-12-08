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
        if (!Schema::hasTable('email_unsubscribed')) {
            Schema::create('email_unsubscribed', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('broadcast_id')->nullable();
                $table->integer('campaing_schedule_logs_id')->index('campaing_schedule_logs_id');
                $table->integer('scheduled_id')->nullable()->index('scheduled_id');
                $table->integer('contact_id')->nullable();
                $table->integer('sd_id')->nullable();
                $table->integer('sn_id')->nullable();
                $table->string('email', 100)->nullable();
                $table->string('ip_address', 30)->nullable();
                $table->string('ip_country', 55)->nullable();
                $table->string('ip_region', 55)->nullable();
                $table->string('ip_city', 55)->nullable();
                $table->string('ip_zip', 10)->nullable();
                $table->string('user_agent', 1000)->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else {
            if (!Schema::hasColumn('email_unsubscribed', 'id')) {
                Schema::table('email_unsubscribed', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
             if (!Schema::hasColumn('email_unsubscribed', 'broadcast_id')) {
                Schema::table('email_unsubscribed', function (Blueprint $table) {
                    $table->integer('broadcast_id')->nullable();
                });
            }
             if (!Schema::hasColumn('email_unsubscribed', 'campaing_schedule_logs_id')) {
                Schema::table('email_unsubscribed', function (Blueprint $table) {
                    $table->integer('campaing_schedule_logs_id')->index('campaing_schedule_logs_id');
                });
            }
             if (!Schema::hasColumn('email_unsubscribed', 'scheduled_id')) {
                Schema::table('email_unsubscribed', function (Blueprint $table) {
                    $table->integer('scheduled_id')->nullable()->index('scheduled_id');
                });
            }
             if (!Schema::hasColumn('email_unsubscribed', 'contact_id')) {
                Schema::table('email_unsubscribed', function (Blueprint $table) {
                    $table->integer('contact_id')->nullable();
                });
            }
             if (!Schema::hasColumn('email_unsubscribed', 'sd_id')) {
                Schema::table('email_unsubscribed', function (Blueprint $table) {
                    $table->integer('sd_id')->nullable();
                });
            }
             if (!Schema::hasColumn('email_unsubscribed', 'sn_id')) {
                Schema::table('email_unsubscribed', function (Blueprint $table) {
                    $table->integer('sn_id')->nullable();
                });
            }
             if (!Schema::hasColumn('email_unsubscribed', 'email')) {
                Schema::table('email_unsubscribed', function (Blueprint $table) {
                    $table->string('email', 100)->nullable();
                });
            }
             if (!Schema::hasColumn('email_unsubscribed', 'ip_address')) {
                Schema::table('email_unsubscribed', function (Blueprint $table) {
                    $table->string('ip_address', 30)->nullable();
                });
            }
             if (!Schema::hasColumn('email_unsubscribed', 'ip_country')) {
                Schema::table('email_unsubscribed', function (Blueprint $table) {
                    $table->string('ip_country', 55)->nullable();
                });
            }
             if (!Schema::hasColumn('email_unsubscribed', 'ip_region')) {
                Schema::table('email_unsubscribed', function (Blueprint $table) {
                    $table->string('ip_region', 55)->nullable();
                });
            }
             if (!Schema::hasColumn('email_unsubscribed', 'ip_city')) {
                Schema::table('email_unsubscribed', function (Blueprint $table) {
                    $table->string('ip_city', 55)->nullable();
                });
            }
             if (!Schema::hasColumn('email_unsubscribed', 'ip_zip')) {
                Schema::table('email_unsubscribed', function (Blueprint $table) {
                    $table->string('ip_zip', 10)->nullable();
                });
            }
             if (!Schema::hasColumn('email_unsubscribed', 'user_agent')) {
                Schema::table('email_unsubscribed', function (Blueprint $table) {
                    $table->string('user_agent', 1000)->nullable();
                });
            }
             if (!Schema::hasColumn('email_unsubscribed', 'created_at')) {
                Schema::table('email_unsubscribed', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('email_unsubscribed', 'updated_at')) {
                Schema::table('email_unsubscribed', function (Blueprint $table) {
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
        Schema::dropIfExists('email_unsubscribed');
    }

}
;
