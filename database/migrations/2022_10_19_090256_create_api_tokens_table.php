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
        if (!Schema::hasTable('api_tokens')) {
            Schema::create('api_tokens', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('role_id');
                $table->unsignedInteger('user_id');
                $table->string('name', 255);
                $table->timestamp('last_access')->nullable();
                $table->boolean('status')->default(true);
                $table->text('auth_ips')->nullable();
                $table->string('api_token', 255)->nullable();
                $table->unsignedInteger('rate_limit')->default('60')->comment('rate limit for number of requests per min');
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else{
             if (!Schema::hasColumn('api_tokens', 'id')) {
                Schema::table('api_tokens', function (Blueprint $table) {
                    $table->increments('id');
                });
            }
             if (!Schema::hasColumn('api_tokens', 'role_id')) {
                Schema::table('api_tokens', function (Blueprint $table) {
                    $table->integer('role_id');
                });
            }
             if (!Schema::hasColumn('api_tokens', 'user_id')) {
                Schema::table('api_tokens', function (Blueprint $table) {
                    $table->unsignedInteger('user_id');
                });
            }
             if (!Schema::hasColumn('api_tokens', 'name')) {
                Schema::table('api_tokens', function (Blueprint $table) {
                    $table->string('name', 255);
                });
            }
             if (!Schema::hasColumn('api_tokens', 'last_access')) {
                Schema::table('api_tokens', function (Blueprint $table) {
                    $table->timestamp('last_access')->nullable();
                });
            }
             if (!Schema::hasColumn('api_tokens', 'status')) {
                Schema::table('api_tokens', function (Blueprint $table) {
                    $table->boolean('status')->default(true);
                });
            }
             if (!Schema::hasColumn('api_tokens', 'auth_ips')) {
                Schema::table('api_tokens', function (Blueprint $table) {
                    $table->text('auth_ips')->nullable();
                });
            }
             if (!Schema::hasColumn('api_tokens', 'api_token')) {
                Schema::table('api_tokens', function (Blueprint $table) {
                    $table->string('api_token', 255)->nullable();
                });
            }
             if (!Schema::hasColumn('api_tokens', 'rate_limit')) {
                Schema::table('api_tokens', function (Blueprint $table) {
                    $table->unsignedInteger('rate_limit')->default('60')->comment('rate limit for number of requests per min');
                });
            }
             if (!Schema::hasColumn('api_tokens', 'created_at')) {
                Schema::table('api_tokens', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
             if (!Schema::hasColumn('api_tokens', 'updated_at')) {
                Schema::table('api_tokens', function (Blueprint $table) {
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
        Schema::dropIfExists('api_tokens');
    }

}
;
