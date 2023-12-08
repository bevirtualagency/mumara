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
        if (!Schema::hasTable('smtps')) {
            Schema::create('smtps', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('name', 255)->nullable();
                $table->string('host', 255)->nullable();
                $table->string('username', 255)->nullable();
                $table->string('password', 1027)->nullable();
                $table->integer('port')->nullable();
                $table->string('smtp_encryption', 20)->nullable();
                $table->boolean('allow_self_signed')->default(false);
                $table->boolean('verify_peer')->default(false);
                $table->boolean('verify_peer_name')->default(false);
                $table->enum('mail_encoding', ['quoted-printable', 'base64', '8bit', 'binary'])->default('quoted-printable');
                $table->integer('group_id')->nullable();
                $table->tinyInteger('status')->default(1);
                $table->string('from_name', 255)->nullable();
                $table->string('from_email', 255)->nullable();
                $table->integer('bounce_email_id')->nullable();
                $table->integer('masked_domain_id')->nullable();
                $table->string('reply_email', 255)->nullable();
                $table->integer('pmta_id')->default(0)->index('pmta_id');
                $table->integer('user_id')->nullable();
                $table->string('test_status', 255)->nullable();
                $table->string('type', 55)->nullable()->default('smtp');
                $table->string('domain_name', 100)->nullable();
                $table->string('api_key', 255)->nullable();
                $table->boolean('process_delivery_status')->default(false);
                $table->string('process_delivery_reports', 100)->nullable();
                $table->text('settings')->nullable();
                $table->text('additional_headers')->nullable();
                $table->text('api_credentials')->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
                $table->dateTime('auto_inactive_datetime')->nullable();
            });
        }
        else {
            if (!Schema::hasColumn('smtps', 'id')) {
                Schema::table('smtps', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('smtps', 'name')) {
                Schema::table('smtps', function (Blueprint $table) {
                    $table->string('name', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('smtps', 'host')) {
                Schema::table('smtps', function (Blueprint $table) {
                    $table->string('host', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('smtps', 'username')) {
                Schema::table('smtps', function (Blueprint $table) {
                    $table->string('username', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('smtps', 'password')) {
                Schema::table('smtps', function (Blueprint $table) {
                    $table->string('password', 1027)->nullable();
                });
            }
            if (!Schema::hasColumn('smtps', 'port')) {
                Schema::table('smtps', function (Blueprint $table) {
                    $table->integer('port')->nullable();
                });
            }
            if (!Schema::hasColumn('smtps', 'smtp_encryption')) {
                Schema::table('smtps', function (Blueprint $table) {
                    $table->string('smtp_encryption', 20)->nullable();
                });
            }
            if (!Schema::hasColumn('smtps', 'allow_self_signed')) {
                Schema::table('smtps', function (Blueprint $table) {
                    $table->boolean('allow_self_signed')->default(false);
                });
            }
            if (!Schema::hasColumn('smtps', 'verify_peer')) {
                Schema::table('smtps', function (Blueprint $table) {
                    $table->boolean('verify_peer')->default(false);
                });
            }
            if (!Schema::hasColumn('smtps', 'verify_peer_name')) {
                Schema::table('smtps', function (Blueprint $table) {
                    $table->boolean('verify_peer_name')->default(false);
                });
            }
            if (!Schema::hasColumn('smtps', 'mail_encoding')) {
                Schema::table('smtps', function (Blueprint $table) {
                    $table->enum('mail_encoding', ['quoted-printable', 'base64', '8bit', 'binary'])->default('quoted-printable');
                });
            }
            if (!Schema::hasColumn('smtps', 'group_id')) {
                Schema::table('smtps', function (Blueprint $table) {
                    $table->integer('group_id')->nullable();
                });
            }
            if (!Schema::hasColumn('smtps', 'status')) {
                Schema::table('smtps', function (Blueprint $table) {
                    $table->tinyInteger('status')->default(1);
                });
            }
            if (!Schema::hasColumn('smtps', 'from_name')) {
                Schema::table('smtps', function (Blueprint $table) {
                    $table->string('from_name', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('smtps', 'from_email')) {
                Schema::table('smtps', function (Blueprint $table) {
                    $table->string('from_email', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('smtps', 'bounce_email_id')) {
                Schema::table('smtps', function (Blueprint $table) {
                    $table->integer('bounce_email_id')->nullable();
                });
            }
            if (!Schema::hasColumn('smtps', 'masked_domain_id')) {
                Schema::table('smtps', function (Blueprint $table) {
                    $table->integer('masked_domain_id')->nullable();
                });
            }
            if (!Schema::hasColumn('smtps', 'reply_email')) {
                Schema::table('smtps', function (Blueprint $table) {
                    $table->string('reply_email', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('smtps', 'pmta_id')) {
                Schema::table('smtps', function (Blueprint $table) {
                    $table->integer('pmta_id')->default(0)->index('pmta_id');
                });
            }
            if (!Schema::hasColumn('smtps', 'user_id')) {
                Schema::table('smtps', function (Blueprint $table) {
                    $table->integer('user_id')->nullable();
                });
            }
            if (!Schema::hasColumn('smtps', 'test_status')) {
                Schema::table('smtps', function (Blueprint $table) {
                    $table->string('test_status', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('smtps', 'type')) {
                Schema::table('smtps', function (Blueprint $table) {
                    $table->string('type', 55)->nullable()->default('smtp');
                });
            }
            if (!Schema::hasColumn('smtps', 'domain_name')) {
                Schema::table('smtps', function (Blueprint $table) {
                    $table->string('domain_name', 100)->nullable();
                });
            }
            if (!Schema::hasColumn('smtps', 'api_key')) {
                Schema::table('smtps', function (Blueprint $table) {
                    $table->string('api_key', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('smtps', 'process_delivery_status')) {
                Schema::table('smtps', function (Blueprint $table) {
                    $table->boolean('process_delivery_status')->default(false);
                });
            }
            if (!Schema::hasColumn('smtps', 'process_delivery_reports')) {
                Schema::table('smtps', function (Blueprint $table) {
                    $table->string('process_delivery_reports', 100)->nullable();
                });
            }
            if (!Schema::hasColumn('smtps', 'settings')) {
                Schema::table('smtps', function (Blueprint $table) {
                    $table->text('settings')->nullable();
                });
            }
            if (!Schema::hasColumn('smtps', 'additional_headers')) {
                Schema::table('smtps', function (Blueprint $table) {
                    $table->text('additional_headers')->nullable();
                });
            }
            if (!Schema::hasColumn('smtps', 'api_credentials')) {
                Schema::table('smtps', function (Blueprint $table) {
                    $table->text('api_credentials')->nullable();
                });
            }
            if (!Schema::hasColumn('smtps', 'created_at')) {
                Schema::table('smtps', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('smtps', 'updated_at')) {
                Schema::table('smtps', function (Blueprint $table) {
                   $table->timestamp('updated_at')->useCurrentOnUpdate();
                });
            }
            if (!Schema::hasColumn('smtps', 'auto_inactive_datetime')) {
                Schema::table('smtps', function (Blueprint $table) {
                    $table->dateTime('auto_inactive_datetime')->nullable();
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
        Schema::dropIfExists('smtps');
    }

}
;
