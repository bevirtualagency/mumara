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
        if (!Schema::hasTable('pmtas')) {
            Schema::create('pmtas', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('server_name', 99)->nullable();
                $table->string('smtp_host', 50)->nullable();
                $table->string('smtp_port', 50)->nullable();
                $table->string('server_ip', 255)->nullable();
                $table->string('server_password', 255)->nullable();
                $table->string('ssh_port', 50)->nullable();
                $table->longText('pmta_data')->nullable();
                $table->integer('user_id')->nullable();
                $table->smallInteger('domain_key_size')->nullable();
                $table->string('dkim_fallback_domain', 255)->nullable();
                $table->enum('config_error', ['no', 'yes'])->default('no');
                $table->enum('status', ['Active', 'Disabled'])->nullable()->default('Active');
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        } 
        else {
            if (!Schema::hasColumn('pmtas', 'id')) {
                Schema::table('pmtas', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('pmtas', 'server_name')) {
                Schema::table('pmtas', function (Blueprint $table) {
                    $table->string('server_name', 99)->nullable();
                });
            }
            if (!Schema::hasColumn('pmtas', 'smtp_host')) {
                Schema::table('pmtas', function (Blueprint $table) {
                    $table->string('smtp_host', 50)->nullable();
                });
            }
            if (!Schema::hasColumn('pmtas', 'smtp_port')) {
                Schema::table('pmtas', function (Blueprint $table) {
                    $table->string('smtp_port', 50)->nullable();
                });
            }
            if (!Schema::hasColumn('pmtas', 'server_ip')) {
                Schema::table('pmtas', function (Blueprint $table) {
                    $table->string('server_ip', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('pmtas', 'server_password')) {
                Schema::table('pmtas', function (Blueprint $table) {
                    $table->string('server_password', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('pmtas', 'ssh_port')) {
                Schema::table('pmtas', function (Blueprint $table) {
                    $table->string('ssh_port', 50)->nullable();
                });
            }
            if (!Schema::hasColumn('pmtas', 'pmta_data')) {
                Schema::table('pmtas', function (Blueprint $table) {
                    $table->longText('pmta_data')->nullable();
                });
            }
            if (!Schema::hasColumn('pmtas', 'user_id')) {
                Schema::table('pmtas', function (Blueprint $table) {
                    $table->integer('user_id')->nullable();
                });
            }
            if (!Schema::hasColumn('pmtas', 'domain_key_size')) {
                Schema::table('pmtas', function (Blueprint $table) {
                    $table->smallInteger('domain_key_size')->nullable();
                });
            }
            if (!Schema::hasColumn('pmtas', 'dkim_fallback_domain')) {
                Schema::table('pmtas', function (Blueprint $table) {
                    $table->string('dkim_fallback_domain', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('pmtas', 'config_error')) {
                Schema::table('pmtas', function (Blueprint $table) {
                    $table->enum('config_error', ['no', 'yes'])->default('no');
                });
            }
            if (!Schema::hasColumn('pmtas', 'status')) {
                Schema::table('pmtas', function (Blueprint $table) {
                    $table->enum('status', ['Active', 'Disabled'])->nullable()->default('Active');
                });
            }
            if (!Schema::hasColumn('pmtas', 'created_at')) {
                Schema::table('pmtas', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('pmtas', 'updated_at')) {
                Schema::table('pmtas', function (Blueprint $table) {
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
        Schema::dropIfExists('pmtas');
    }

}
;
