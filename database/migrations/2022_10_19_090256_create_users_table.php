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
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name', 255);
                $table->string('email', 100)->unique();
                $table->string('password', 255);
                $table->string('one_time_password', 255)->nullable();
                $table->rememberToken();
                $table->string('api_token', 155)->nullable()->unique('api_token');
                $table->text('login_ips')->nullable();
                $table->string('countrycode', 255)->nullable();
                $table->string('country', 255)->nullable();
                $table->string('time_zone', 20)->nullable();
                $table->string('address_line_1', 255)->nullable();
                $table->string('address_line_2', 255)->nullable();
                $table->string('city', 20)->nullable();
                $table->string('state', 20)->nullable();
                $table->string('post_code', 20)->nullable();
                $table->string('phone', 20)->nullable();
                $table->string('mobile', 20)->nullable();
                $table->integer('user_id')->nullable();
                $table->enum('role', ['super_admin', 'admin', 'client'])->nullable();
                $table->integer('role_id')->nullable();
                $table->integer('package_id')->nullable();
                $table->boolean('is_admin')->default(false);
                $table->boolean('is_staff')->default(false);
                $table->boolean('is_client')->nullable()->default(false);
                $table->enum('status', ['active', 'suspended', 'closed'])->default('active');
                $table->integer('parent_id')->default(0);
                $table->boolean('logout')->default(false);
                $table->boolean('is_setup_completed')->default(false);
                $table->softDeletes();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
                $table->string('timezone', 100)->nullable()->default('UTC');
                $table->dateTime('last_login')->nullable();
                $table->integer('max_threads')->nullable();
                $table->boolean('multi_threading')->default(false);
                $table->text('app_settings')->nullable();
            });
        }
        else {
            if (!Schema::hasColumn('users', 'id')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->increments('id');
                });
            }
            if (!Schema::hasColumn('users', 'name')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->string('name', 255);
                });
            }
            if (!Schema::hasColumn('users', 'email')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->string('email', 100)->unique();
                });
            }
            if (!Schema::hasColumn('users', 'password')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->string('password', 255);
                });
            }
            if (!Schema::hasColumn('users', 'one_time_password')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->string('one_time_password', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('users', 'remember_token')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->rememberToken();
                });
            }
            if (!Schema::hasColumn('users', 'api_token')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->string('api_token', 155)->nullable()->unique('api_token');
                });
            }
            if (!Schema::hasColumn('users', 'login_ips')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->text('login_ips')->nullable();
                });
            }
            if (!Schema::hasColumn('users', 'countrycode')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->string('countrycode', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('users', 'country')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->string('country', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('users', 'time_zone')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->string('time_zone', 20)->nullable();
                });
            }
            if (!Schema::hasColumn('users', 'address_line_1')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->string('address_line_1', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('users', 'address_line_2')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->string('address_line_2', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('users', 'city')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->string('city', 20)->nullable();
                });
            }
            if (!Schema::hasColumn('users', 'state')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->string('state', 20)->nullable();
                });
            }
            if (!Schema::hasColumn('users', 'post_code')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->string('post_code', 20)->nullable();
                });
            }
            if (!Schema::hasColumn('users', 'phone')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->string('phone', 20)->nullable();
                });
            }
            if (!Schema::hasColumn('users', 'mobile')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->string('mobile', 20)->nullable();
                });
            }
            if (!Schema::hasColumn('users', 'user_id')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->integer('user_id')->nullable();
                });
            }
            if (!Schema::hasColumn('users', 'role')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->enum('role', ['super_admin', 'admin', 'client'])->nullable();
                });
            }
            if (!Schema::hasColumn('users', 'role_id')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->integer('role_id')->nullable();
                });
            }
            if (!Schema::hasColumn('users', 'package_id')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->integer('package_id')->nullable();
                });
            }
            if (!Schema::hasColumn('users', 'is_admin')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->boolean('is_admin')->default(false);
                });
            }
            if (!Schema::hasColumn('users', 'is_staff')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->boolean('is_staff')->default(false);
                });
            }
            if (!Schema::hasColumn('users', 'is_client')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->boolean('is_client')->nullable()->default(false);
                });
            }
            if (!Schema::hasColumn('users', 'status')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->enum('status', ['active', 'suspended', 'closed'])->default('active');
                });
            }
            if (!Schema::hasColumn('users', 'parent_id')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->integer('parent_id')->default(0);
                });
            }
            if (!Schema::hasColumn('users', 'logout')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->boolean('logout')->default(false);
                });
            }
            if (!Schema::hasColumn('users', 'is_setup_completed')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->boolean('is_setup_completed')->default(false);
                });
            }
            if (!Schema::hasColumn('users', 'deleted_at')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->softDeletes();
                });
            }
            if (!Schema::hasColumn('users', 'created_at')) {
                Schema::table('users', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('users', 'updated_at')) {
                Schema::table('users', function (Blueprint $table) {
                   $table->timestamp('updated_at')->useCurrentOnUpdate();
                });
            }
            if (!Schema::hasColumn('users', 'timezone')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->string('timezone', 100)->nullable()->default('UTC');
                });
            }
            if (!Schema::hasColumn('users', 'last_login')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->dateTime('last_login')->nullable();
                });
            }
            if (!Schema::hasColumn('users', 'max_threads')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->integer('max_threads')->nullable();
                });
            }
            if (!Schema::hasColumn('users', 'multi_threading')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->boolean('multi_threading')->default(false);
                });
            }
            if (!Schema::hasColumn('users', 'app_settings')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->text('app_settings')->nullable();
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
        Schema::dropIfExists('users');
    }

}
;
