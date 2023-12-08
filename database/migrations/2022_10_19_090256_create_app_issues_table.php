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
        if (!Schema::hasTable('app_issues')) {
            Schema::create('app_issues', function (Blueprint $table) {
                $table->increments('id');
                $table->string('user', 255);
                $table->string('module', 255);
                $table->unsignedInteger('module_id')->default('0');
                $table->text('issue');
                $table->text('resolution')->nullable();
                $table->text('module_link')->nullable();
                $table->string('js_test_method', 255)->nullable();
                $table->unsignedInteger('ref_id')->unique('ref_id');
                $table->tinyInteger('is_critical')->default(0);
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else
        {
            if (!Schema::hasColumn('app_issues', 'id')) {
                Schema::table('app_issues', function (Blueprint $table) {
                    $table->increments('id');
                });
            }
            if (!Schema::hasColumn('app_issues', 'user')) {
                Schema::table('app_issues', function (Blueprint $table) {
                    $table->string('user', 255);
                });
            }
            if (!Schema::hasColumn('app_issues', 'module')) {
                Schema::table('app_issues', function (Blueprint $table) {
                    $table->string('module', 255);
                });
            }
            if (!Schema::hasColumn('app_issues', 'module_id')) {
                Schema::table('app_issues', function (Blueprint $table) {
                    $table->unsignedInteger('module_id')->default('0');
                });
            }
            if (!Schema::hasColumn('app_issues', 'issue')) {
                Schema::table('app_issues', function (Blueprint $table) {
                    $table->text('issue');
                });
            }
            if (!Schema::hasColumn('app_issues', 'resolution')) {
                Schema::table('app_issues', function (Blueprint $table) {
                    $table->text('resolution')->nullable();
                });
            }
            if (!Schema::hasColumn('app_issues', 'module_link')) {
                Schema::table('app_issues', function (Blueprint $table) {
                    $table->text('module_link')->nullable();
                });
            }
            if (!Schema::hasColumn('app_issues', 'js_test_method')) {
                Schema::table('app_issues', function (Blueprint $table) {
                    $table->string('js_test_method', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('app_issues', 'ref_id')) {
                Schema::table('app_issues', function (Blueprint $table) {
                    $table->unsignedInteger('ref_id')->unique('ref_id');
                });
            }
            if (!Schema::hasColumn('app_issues', 'is_critical')) {
                Schema::table('app_issues', function (Blueprint $table) {
                    $table->tinyInteger('is_critical')->default(0);
                });
            }
            if (!Schema::hasColumn('app_issues', 'created_at')) {
                Schema::table('app_issues', function (Blueprint $table) {
                    $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('app_issues', 'updated_at')) {
                Schema::table('app_issues', function (Blueprint $table) {
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
        Schema::dropIfExists('app_issues');
    }

}
;
