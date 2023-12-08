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
        if (!Schema::hasTable('packages')) {
            Schema::create('packages', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('package_name', 255)->nullable();
                $table->integer('role_id')->nullable();
                $table->integer('user_id');
                $table->integer('lists_limit')->default(-1);
                $table->integer('subscribers_limit')->default(-1);
                $table->integer('smtps_limit')->default(-1);
                $table->integer('monthly_email_limit')->default(-1);
                $table->integer('daily_email_limit')->default(-1);
                $table->integer('hourly_email_limit')->default(-1);
                $table->string('modules', 255)->nullable();
                $table->string('list_ids', 255)->nullable();
                $table->string('segment_ids', 255)->nullable();
                $table->string('email_template_ids', 255)->nullable();
                $table->integer('sending_domain_limit');
                $table->integer('segments_limit')->nullable();
                $table->integer('triggers_limit')->nullable();
                $table->tinyInteger('allow_smtp')->default(1);
                $table->string('sending_domains', 255)->nullable();
                $table->string('smtp_type', 255)->nullable();
                $table->string('smtp_ids', 255)->nullable();
                $table->string('sending_options', 255)->nullable();
                $table->string('smtp_groups', 255)->nullable();
                $table->string('bounce_emails', 255)->nullable();
                $table->tinyInteger('allow_tracking')->default(1);
                $table->text('additional_headers')->nullable();
                $table->boolean('oversending')->default(false);
                $table->unsignedInteger('oversending_price')->nullable();
                $table->unsignedInteger('oversending_limit')->nullable();
                $table->boolean('allow_overuse')->nullable();
                $table->boolean('credits_enabled')->nullable();
                $table->boolean('update_existing_users_setting')->default(true);
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
                $table->integer('max_threads')->nullable();
            });
        }
        else {
            if (!Schema::hasColumn('packages', 'id')) {
                Schema::table('packages', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('packages', 'package_name')) {
                Schema::table('packages', function (Blueprint $table) {
                    $table->string('package_name', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('packages', 'role_id')) {
                Schema::table('packages', function (Blueprint $table) {
                    $table->integer('role_id')->nullable();
                });
            }
            if (!Schema::hasColumn('packages', 'user_id')) {
                Schema::table('packages', function (Blueprint $table) {
                    $table->integer('user_id');
                });
            }
            if (!Schema::hasColumn('packages', 'lists_limit')) {
                Schema::table('packages', function (Blueprint $table) {
                    $table->integer('lists_limit')->default(-1);
                });
            }
            if (!Schema::hasColumn('packages', 'subscribers_limit')) {
                Schema::table('packages', function (Blueprint $table) {
                    $table->integer('subscribers_limit')->default(-1);
                });
            }
            if (!Schema::hasColumn('packages', 'smtps_limit')) {
                Schema::table('packages', function (Blueprint $table) {
                    $table->integer('smtps_limit')->default(-1);
                });
            }
            if (!Schema::hasColumn('packages', 'monthly_email_limit')) {
                Schema::table('packages', function (Blueprint $table) {
                    $table->integer('monthly_email_limit')->default(-1);
                });
            }
            if (!Schema::hasColumn('packages', 'daily_email_limit')) {
                Schema::table('packages', function (Blueprint $table) {
                    $table->integer('daily_email_limit')->default(-1);
                });
            }
            if (!Schema::hasColumn('packages', 'hourly_email_limit')) {
                Schema::table('packages', function (Blueprint $table) {
                    $table->integer('hourly_email_limit')->default(-1);
                });
            }
            if (!Schema::hasColumn('packages', 'modules')) {
                Schema::table('packages', function (Blueprint $table) {
                    $table->string('modules', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('packages', 'list_ids')) {
                Schema::table('packages', function (Blueprint $table) {
                    $table->string('list_ids', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('packages', 'segment_ids')) {
                Schema::table('packages', function (Blueprint $table) {
                    $table->string('segment_ids', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('packages', 'email_template_ids')) {
                Schema::table('packages', function (Blueprint $table) {
                    $table->string('email_template_ids', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('packages', 'sending_domain_limit')) {
                Schema::table('packages', function (Blueprint $table) {
                    $table->integer('sending_domain_limit');
                });
            }
            if (!Schema::hasColumn('packages', 'segments_limit')) {
                Schema::table('packages', function (Blueprint $table) {
                    $table->integer('segments_limit')->nullable();
                });
            }
            if (!Schema::hasColumn('packages', 'triggers_limit')) {
                Schema::table('packages', function (Blueprint $table) {
                    $table->integer('triggers_limit')->nullable();
                });
            }
            if (!Schema::hasColumn('packages', 'allow_smtp')) {
                Schema::table('packages', function (Blueprint $table) {
                    $table->tinyInteger('allow_smtp')->default(1);
                });
            }
            if (!Schema::hasColumn('packages', 'sending_domains')) {
                Schema::table('packages', function (Blueprint $table) {
                    $table->string('sending_domains', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('packages', 'smtp_type')) {
                Schema::table('packages', function (Blueprint $table) {
                    $table->string('smtp_type', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('packages', 'smtp_ids')) {
                Schema::table('packages', function (Blueprint $table) {
                    $table->string('smtp_ids', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('packages', 'sending_options')) {
                Schema::table('packages', function (Blueprint $table) {
                    $table->string('sending_options', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('packages', 'smtp_groups')) {
                Schema::table('packages', function (Blueprint $table) {
                    $table->string('smtp_groups', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('packages', 'bounce_emails')) {
                Schema::table('packages', function (Blueprint $table) {
                    $table->string('bounce_emails', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('packages', 'allow_tracking')) {
                Schema::table('packages', function (Blueprint $table) {
                    $table->tinyInteger('allow_tracking')->default(1);
                });
            }
            if (!Schema::hasColumn('packages', 'additional_headers')) {
                Schema::table('packages', function (Blueprint $table) {
                    $table->text('additional_headers')->nullable();
                });
            }
            if (!Schema::hasColumn('packages', 'oversending')) {
                Schema::table('packages', function (Blueprint $table) {
                    $table->boolean('oversending')->default(false);
                });
            }
            if (!Schema::hasColumn('packages', 'oversending_price')) {
                Schema::table('packages', function (Blueprint $table) {
                    $table->unsignedInteger('oversending_price')->nullable();
                });
            }
            if (!Schema::hasColumn('packages', 'oversending_limit')) {
                Schema::table('packages', function (Blueprint $table) {
                    $table->unsignedInteger('oversending_limit')->nullable();
                });
            }
            if (!Schema::hasColumn('packages', 'allow_overuse')) {
                Schema::table('packages', function (Blueprint $table) {
                    $table->boolean('allow_overuse')->nullable();
                });
            }
            if (!Schema::hasColumn('packages', 'credits_enabled')) {
                Schema::table('packages', function (Blueprint $table) {
                    $table->boolean('credits_enabled')->nullable();
                });
            }
            if (!Schema::hasColumn('packages', 'update_existing_users_setting')) {
                Schema::table('packages', function (Blueprint $table) {
                    $table->boolean('update_existing_users_setting')->default(true);
                });
            }
            if (!Schema::hasColumn('packages', 'created_at')) {
                Schema::table('packages', function (Blueprint $table) {
                  $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('packages', 'updated_at')) {
                Schema::table('packages', function (Blueprint $table) {
                   $table->timestamp('updated_at')->useCurrentOnUpdate();
                });
            }
            if (!Schema::hasColumn('packages', 'max_threads')) {
                Schema::table('packages', function (Blueprint $table) {
                    $table->integer('max_threads')->nullable();
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
        Schema::dropIfExists('packages');
    }

}
;
