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
        if (!Schema::hasTable('bounces')) {
            Schema::create('bounces', function (Blueprint $table) {
                $table->integer('id', true);
                $table->tinyInteger('process_bounce_report')->default(1);
                $table->string('name', 255)->nullable();
                $table->string('host', 255)->nullable();
                $table->mediumInteger('port')->nullable();
                $table->string('username', 255)->nullable();
                $table->string('password', 1027)->nullable();
                $table->string('folder', 50)->nullable();
                $table->boolean('validate_certificates')->nullable()->default(false);
                $table->string('bounce_encryption', 20)->nullable();
                $table->boolean('delete_emails')->nullable()->default(false);
                $table->enum('processing_protocols', ['pop', 'imap'])->nullable();
                $table->integer('user_id')->nullable();
                $table->integer('pmta_id')->default(0)->index('pmta_id');
                $table->string('test_status', 50);
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
                $table->boolean('is_active')->default(true);
                $table->boolean('has_error')->default(false);
                $table->integer('email_number')->nullable()->default(0);
            });
        }
        else
        {
             if (!Schema::hasColumn('bounces', 'id')) {
                Schema::table('bounces', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('bounces', 'process_bounce_report')) {
                Schema::table('bounces', function (Blueprint $table) {
                    $table->tinyInteger('process_bounce_report')->default(1);
                });
            }
            if (!Schema::hasColumn('bounces', 'name')) {
                Schema::table('bounces', function (Blueprint $table) {
                    $table->string('name', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('bounces', 'host')) {
                Schema::table('bounces', function (Blueprint $table) {
                    $table->string('host', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('bounces', 'port')) {
                Schema::table('bounces', function (Blueprint $table) {
                    $table->mediumInteger('port')->nullable();
                });
            }
            if (!Schema::hasColumn('bounces', 'username')) {
                Schema::table('bounces', function (Blueprint $table) {
                    $table->string('username', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('bounces', 'password')) {
                Schema::table('bounces', function (Blueprint $table) {
                    $table->string('password', 1027)->nullable();
                });
            }
            if (!Schema::hasColumn('bounces', 'folder')) {
                Schema::table('bounces', function (Blueprint $table) {
                    $table->string('folder', 50)->nullable();
                });
            }
            if (!Schema::hasColumn('bounces', 'validate_certificates')) {
                Schema::table('bounces', function (Blueprint $table) {
                    $table->boolean('validate_certificates')->nullable()->default(false);
                });
            }
            if (!Schema::hasColumn('bounces', 'bounce_encryption')) {
                Schema::table('bounces', function (Blueprint $table) {
                    $table->string('bounce_encryption', 20)->nullable();
                });
            }
            if (!Schema::hasColumn('bounces', 'delete_emails')) {
                Schema::table('bounces', function (Blueprint $table) {
                    $table->boolean('delete_emails')->nullable()->default(false);
                });
            }
            if (!Schema::hasColumn('bounces', 'processing_protocols')) {
                Schema::table('bounces', function (Blueprint $table) {
                    $table->enum('processing_protocols', ['pop', 'imap'])->nullable();
                });
            }
            if (!Schema::hasColumn('bounces', 'user_id')) {
                Schema::table('bounces', function (Blueprint $table) {
                    $table->integer('user_id')->nullable();
                });
            }
            if (!Schema::hasColumn('bounces', 'pmta_id')) {
                Schema::table('bounces', function (Blueprint $table) {
                    $table->integer('pmta_id')->default(0)->index('pmta_id');
                });
            }
            if (!Schema::hasColumn('bounces', 'test_status')) {
                Schema::table('bounces', function (Blueprint $table) {
                    $table->string('test_status', 50);
                });
            }
            if (!Schema::hasColumn('bounces', 'created_at')) {
                Schema::table('bounces', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('bounces', 'updated_at')) {
                Schema::table('bounces', function (Blueprint $table) {
                   $table->timestamp('updated_at')->useCurrentOnUpdate();
                });
            }
            if (!Schema::hasColumn('bounces', 'is_active')) {
                Schema::table('bounces', function (Blueprint $table) {
                    $table->boolean('is_active')->default(true);
                });
            }
            if (!Schema::hasColumn('bounces', 'has_error')) {
                Schema::table('bounces', function (Blueprint $table) {
                    $table->boolean('has_error')->default(false);
                });
            }
             if (!Schema::hasColumn('bounces', 'email_number')) {
                Schema::table('bounces', function (Blueprint $table) {
                    $table->integer('email_number')->nullable()->default(0);
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
        Schema::dropIfExists('bounces');
    }

}
;
