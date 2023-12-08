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
        if (!Schema::hasTable('groups')) {
            Schema::create('groups', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('name', 255)->nullable();
                $table->integer('section_id')->nullable();
                $table->boolean('is_deleted')->default(false);
                $table->boolean('is_movable')->default(true);
                $table->integer('parent_group_id')->default(0);
                $table->integer('user_id');
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            });
            DB::statement("INSERT INTO `groups` (`id`, `name`, `section_id`, `is_deleted`, `is_movable`, `parent_group_id`, `user_id`) VALUES
(1, '..', 1, 0, 0, 0, 2),
(2, 'Unsorted', 1, 0, 0, 1, 2);");
        }
        else
        {
             if (!Schema::hasColumn('groups', 'id')) {
                Schema::table('groups', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('groups', 'name')) {
                Schema::table('groups', function (Blueprint $table) {
                    $table->string('name', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('groups', 'section_id')) {
                Schema::table('groups', function (Blueprint $table) {
                    $table->integer('section_id')->nullable();
                });
            }
            if (!Schema::hasColumn('groups', 'is_deleted')) {
                Schema::table('groups', function (Blueprint $table) {
                    $table->boolean('is_deleted')->default(false);
                });
            }
            if (!Schema::hasColumn('groups', 'is_movable')) {
                Schema::table('groups', function (Blueprint $table) {
                    $table->boolean('is_movable')->default(true);
                });
            }
            if (!Schema::hasColumn('groups', 'parent_group_id')) {
                Schema::table('groups', function (Blueprint $table) {
                    $table->integer('parent_group_id')->default(0);
                });
            }
            if (!Schema::hasColumn('groups', 'user_id')) {
                Schema::table('groups', function (Blueprint $table) {
                    $table->integer('user_id');
                });
            }
            if (!Schema::hasColumn('groups', 'created_at')) {
                Schema::table('groups', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('groups', 'updated_at')) {
                Schema::table('groups', function (Blueprint $table) {
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
        Schema::dropIfExists('groups');
    }

}
;
