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
        if (!Schema::hasTable('bug_reports')) {
            Schema::create('bug_reports', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('section', 255)->nullable();
                $table->string('priority', 100);
                $table->string('subject', 255);
                $table->text('description')->nullable();
                $table->integer('user_id')->nullable();
                $table->integer('status')->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else
        {
            if (!Schema::hasColumn('bug_reports', 'id')) {
                Schema::table('bug_reports', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('bug_reports', 'section')) {
                Schema::table('bug_reports', function (Blueprint $table) {
                    $table->string('section', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('bug_reports', 'priority')) {
                Schema::table('bug_reports', function (Blueprint $table) {
                    $table->string('priority', 100);
                });
            }
            if (!Schema::hasColumn('bug_reports', 'subject')) {
                Schema::table('bug_reports', function (Blueprint $table) {
                    $table->string('subject', 255);
                });
            }
            if (!Schema::hasColumn('bug_reports', 'description')) {
                Schema::table('bug_reports', function (Blueprint $table) {
                    $table->text('description')->nullable();
                });
            }
            if (!Schema::hasColumn('bug_reports', 'user_id')) {
                Schema::table('bug_reports', function (Blueprint $table) {
                    $table->integer('user_id')->nullable();
                });
            }
            if (!Schema::hasColumn('bug_reports', 'status')) {
                Schema::table('bug_reports', function (Blueprint $table) {
                    $table->integer('status')->nullable();
                });
            }
            if (!Schema::hasColumn('bug_reports', 'created_at')) {
                Schema::table('bug_reports', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('bug_reports', 'updated_at')) {
                Schema::table('bug_reports', function (Blueprint $table) {
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
        Schema::dropIfExists('bug_reports');
    }

}
;
