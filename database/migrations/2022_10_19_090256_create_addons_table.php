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
        if (!Schema::hasTable('addons')) {
            Schema::create('addons', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name', 255)->nullable();
                $table->string('type', 255)->nullable();
                $table->string('vendor', 255)->nullable();
                $table->string('installed_version', 10)->nullable();
                $table->string('available_version', 10)->nullable();
                $table->enum('status', ['unavailable', 'available', 'installed', 'inactive', 'active', 'error'])->default('unavailable');
                $table->text('error')->nullable();
                $table->string('install_dir', 255);
                $table->text('license_key')->nullable();
                $table->text('local_key')->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            });
        }
        else
        {
            if (!Schema::hasColumn('addons', 'id')) {
                Schema::table('addons', function (Blueprint $table) {
                    $table->increments('id');
                });
            }
             if (!Schema::hasColumn('addons', 'name')) {
                Schema::table('addons', function (Blueprint $table) {
                    $table->string('name', 255)->nullable();
                });
            }
             if (!Schema::hasColumn('addons', 'type')) {
                Schema::table('addons', function (Blueprint $table) {
                    $table->string('type', 255)->nullable();
                });
            }
             if (!Schema::hasColumn('addons', 'vendor')) {
                Schema::table('addons', function (Blueprint $table) {
                    $table->string('vendor', 255)->nullable();
                });
            }
             if (!Schema::hasColumn('addons', 'installed_version')) {
                Schema::table('addons', function (Blueprint $table) {
                    $table->string('installed_version', 10)->nullable();
                });
            }
             if (!Schema::hasColumn('addons', 'available_version')) {
                Schema::table('addons', function (Blueprint $table) {
                    $table->string('available_version', 10)->nullable();
                });
            }
             
             if (!Schema::hasColumn('addons', 'status')) {
                Schema::table('addons', function (Blueprint $table) {
                    $table->enum('status', ['unavailable', 'available', 'installed', 'inactive', 'active', 'error'])->default('unavailable');
                });
            }
             if (!Schema::hasColumn('addons', 'error')) {
                Schema::table('addons', function (Blueprint $table) {
                    $table->text('error')->nullable();
                });
            }
             if (!Schema::hasColumn('addons', 'install_dir')) {
                Schema::table('addons', function (Blueprint $table) {
                    $table->string('install_dir', 255);
                });
            }
            if (!Schema::hasColumn('addons', 'license_key')) {
                Schema::table('addons', function (Blueprint $table) {
                    $table->text('license_key')->nullable();
                });
            }
            if (!Schema::hasColumn('addons', 'local_key')) {
                Schema::table('addons', function (Blueprint $table) {
                    $table->text('local_key')->nullable();
                });
            }
             if (!Schema::hasColumn('addons', 'created_at')) {
                Schema::table('addons', function (Blueprint $table) {
                    $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('addons', 'updated_at')) {
                Schema::table('addons', function (Blueprint $table) {
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
        Schema::dropIfExists('addons');
    }

}
;
