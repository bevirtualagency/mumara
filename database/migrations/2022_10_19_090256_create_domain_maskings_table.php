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
        if (!Schema::hasTable('domain_maskings')) {
            Schema::create('domain_maskings', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('domain', 255)->nullable();
                $table->enum('type', ['htaccess', 'cname', 'index'])->nullable()->default('htaccess');
                $table->integer('user_id')->nullable();
                $table->integer('pmta_id')->nullable()->default(0);
                $table->text('spf')->nullable();
                $table->text('dkim_public')->nullable();
                $table->text('dkim_private')->nullable();
                $table->text('dkim_public_key')->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
                $table->string('tracking_domain', 100)->nullable();
                $table->enum('tracking_status', ['Active', 'Inactive', 'Suspended', 'Failed'])->default('Inactive');
                $table->tinyInteger('bounce_status')->nullable();
                $table->boolean('domain_status')->default(true)->comment('1:Active');
                $table->boolean('is_confirm_dns')->default(false);
                $table->boolean('is_confirm')->default(false);
                $table->boolean('is_confirm_redirect')->nullable()->default(false);
                $table->boolean('is_confirm_mx')->nullable()->default(false);
                $table->boolean('is_confirm_spf')->nullable()->default(false);
                $table->string('email_selector', 55)->nullable();
                $table->string('bounce_selector', 55)->nullable()->default('bounce');
                $table->tinyInteger('is_verified')->nullable();
                $table->tinyInteger('is_enable_dkim')->default(0);
                $table->tinyInteger('is_confirm_clicked')->default(0);
                $table->tinyInteger('is_ssl_enabled')->nullable();
                $table->boolean('is_sandbox_domain')->default(false);
            });
        }
        else {
            if (!Schema::hasColumn('domain_maskings', 'id')) {
                Schema::table('domain_maskings', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('domain_maskings', 'domain')) {
                Schema::table('domain_maskings', function (Blueprint $table) {
                    $table->string('domain', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('domain_maskings', 'type')) {
                Schema::table('domain_maskings', function (Blueprint $table) {
                    $table->enum('type', ['htaccess', 'cname', 'index'])->nullable()->default('htaccess');
                });
            }
            if (!Schema::hasColumn('domain_maskings', 'user_id')) {
                Schema::table('domain_maskings', function (Blueprint $table) {
                    $table->integer('user_id')->nullable();
                });
            }
            if (!Schema::hasColumn('domain_maskings', 'pmta_id')) {
                Schema::table('domain_maskings', function (Blueprint $table) {
                    $table->integer('pmta_id')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('domain_maskings', 'spf')) {
                Schema::table('domain_maskings', function (Blueprint $table) {
                    $table->text('spf')->nullable();
                });
            }
            if (!Schema::hasColumn('domain_maskings', 'dkim_public')) {
                Schema::table('domain_maskings', function (Blueprint $table) {
                    $table->text('dkim_public')->nullable();
                });
            }
            if (!Schema::hasColumn('domain_maskings', 'dkim_private')) {
                Schema::table('domain_maskings', function (Blueprint $table) {
                    $table->text('dkim_private')->nullable();
                });
            }
            if (!Schema::hasColumn('domain_maskings', 'dkim_public_key')) {
                Schema::table('domain_maskings', function (Blueprint $table) {
                    $table->text('dkim_public_key')->nullable();
                });
            }
            if (!Schema::hasColumn('domain_maskings', 'created_at')) {
                Schema::table('domain_maskings', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('domain_maskings', 'updated_at')) {
                Schema::table('domain_maskings', function (Blueprint $table) {
                   $table->timestamp('updated_at')->useCurrentOnUpdate();
                });
            }
            if (!Schema::hasColumn('domain_maskings', 'tracking_domain')) {
                Schema::table('domain_maskings', function (Blueprint $table) {
                    $table->string('tracking_domain', 100)->nullable();
                });
            }
            if (!Schema::hasColumn('domain_maskings', 'tracking_status')) {
                Schema::table('domain_maskings', function (Blueprint $table) {
                    $table->enum('tracking_status', ['Active', 'Inactive', 'Suspended', 'Failed'])->default('Inactive');
                });
            }
            if (!Schema::hasColumn('domain_maskings', 'bounce_status')) {
                Schema::table('domain_maskings', function (Blueprint $table) {
                    $table->tinyInteger('bounce_status')->nullable();
                });
            }
            if (!Schema::hasColumn('domain_maskings', 'domain_status')) {
                Schema::table('domain_maskings', function (Blueprint $table) {
                    $table->boolean('domain_status')->default(true)->comment('1:Active');
                });
            }
            if (!Schema::hasColumn('domain_maskings', 'is_confirm_dns')) {
                Schema::table('domain_maskings', function (Blueprint $table) {
                    $table->boolean('is_confirm_dns')->default(false);
                });
            }
            if (!Schema::hasColumn('domain_maskings', 'is_confirm')) {
                Schema::table('domain_maskings', function (Blueprint $table) {
                    $table->boolean('is_confirm')->default(false);
                });
            }
            if (!Schema::hasColumn('domain_maskings', 'is_confirm_redirect')) {
                Schema::table('domain_maskings', function (Blueprint $table) {
                    $table->boolean('is_confirm_redirect')->nullable()->default(false);
                });
            }
            if (!Schema::hasColumn('domain_maskings', 'is_confirm_mx')) {
                Schema::table('domain_maskings', function (Blueprint $table) {
                    $table->boolean('is_confirm_mx')->nullable()->default(false);
                });
            }
            if (!Schema::hasColumn('domain_maskings', 'is_confirm_spf')) {
                Schema::table('domain_maskings', function (Blueprint $table) {
                    $table->boolean('is_confirm_spf')->nullable()->default(false);
                });
            }
            if (!Schema::hasColumn('domain_maskings', 'email_selector')) {
                Schema::table('domain_maskings', function (Blueprint $table) {
                    $table->string('email_selector', 55)->nullable();
                });
            }
            if (!Schema::hasColumn('domain_maskings', 'bounce_selector')) {
                Schema::table('domain_maskings', function (Blueprint $table) {
                    $table->string('bounce_selector', 55)->nullable()->default('bounce');
                });
            }
            if (!Schema::hasColumn('domain_maskings', 'is_verified')) {
                Schema::table('domain_maskings', function (Blueprint $table) {
                    $table->tinyInteger('is_verified')->nullable();
                });
            }
            if (!Schema::hasColumn('domain_maskings', 'is_enable_dkim')) {
                Schema::table('domain_maskings', function (Blueprint $table) {
                    $table->tinyInteger('is_enable_dkim')->default(0);
                });
            }
            if (!Schema::hasColumn('domain_maskings', 'is_confirm_clicked')) {
                Schema::table('domain_maskings', function (Blueprint $table) {
                    $table->tinyInteger('is_confirm_clicked')->default(0);
                });
            }
            if (!Schema::hasColumn('domain_maskings', 'is_ssl_enabled')) {
                Schema::table('domain_maskings', function (Blueprint $table) {
                    $table->tinyInteger('is_ssl_enabled')->nullable();
                });
            }
            if (!Schema::hasColumn('domain_maskings', 'is_sandbox_domain')) {
                Schema::table('domain_maskings', function (Blueprint $table) {
                    $table->boolean('is_sandbox_domain')->default(false);
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
        Schema::dropIfExists('domain_maskings');
    }

}
;
