<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        if (!Schema::hasTable('roles')) {
            Schema::create('roles', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('name', 255)->nullable();
                $table->integer('user_id')->nullable();
                $table->boolean('is_staff')->default(false);
                $table->enum('type', ['web', 'api'])->default('web');
                $table->string('description', 255)->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
            DB::statement("INSERT INTO `roles` (`id`, `name`, `user_id`, `is_staff`, `type`, `description`) VALUES
        (1, 'Super Administrator', 1, 1, 'web', NULL);");
        } else {
            if (!Schema::hasColumn('roles', 'id')) {
                Schema::table('roles', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
             if (!Schema::hasColumn('roles', 'name')) {
                Schema::table('roles', function (Blueprint $table) {
                    $table->string('name', 255)->nullable();
                });
            }
             if (!Schema::hasColumn('roles', 'user_id')) {
                Schema::table('roles', function (Blueprint $table) {
                    $table->integer('user_id')->nullable();
                });
            }
             if (!Schema::hasColumn('roles', 'is_staff')) {
                Schema::table('roles', function (Blueprint $table) {
                    $table->boolean('is_staff')->default(false);
                });
            }
             if (!Schema::hasColumn('roles', 'type')) {
                Schema::table('roles', function (Blueprint $table) {
                    $table->enum('type', ['web', 'api'])->default('web');
                });
            }
             if (!Schema::hasColumn('roles', 'description')) {
                Schema::table('roles', function (Blueprint $table) {
                    $table->string('description', 255)->nullable();
                });
            }
             if (!Schema::hasColumn('roles', 'created_at')) {
                Schema::table('roles', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
             if (!Schema::hasColumn('roles', 'updated_at')) {
                Schema::table('roles', function (Blueprint $table) {
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
        Schema::dropIfExists('roles');
    }

}
;
