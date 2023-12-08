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
        if (!Schema::hasTable('tasks')) {
            Schema::create('tasks', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('user_id')->nullable();
                $table->integer('thread_id')->nullable();
                $table->integer('task_id')->nullable();
                $table->integer('record_id')->nullable();
                $table->integer('thread_number')->nullable();
                $table->string('task', 55)->nullable()->default('query');
                $table->enum('type', ['query', 'command'])->nullable()->default('query');
                $table->boolean('status')->nullable()->default(false)->comment('0:pending, 1:complete, 2: Running, 3: Failed');
                $table->string('value', 1000)->nullable();
                $table->string('data', 1000)->nullable();
                $table->string('response', 255)->nullable();
                $table->boolean('attempts')->nullable()->default(false);
                $table->integer('priority')->nullable()->default(1);
                $table->dateTime('created_at')->nullable();
                $table->dateTime('updated_at')->nullable();
                $table->timestamp('start_time')->nullable();
                $table->tinyInteger('is_running')->default(1);
                $table->timestamp('end_time')->nullable();
            });
            DB::statement("INSERT INTO `tasks` (`id`, `user_id`, `thread_id`, `task_id`, `record_id`, `thread_number`, `task`, `type`, `status`, `value`, `data`, `response`, `attempts`, `priority`, `created_at`, `updated_at`, `start_time`, `is_running`, `end_time`) VALUES
(1, 2, NULL, NULL, NULL, 1, 'config_optimize', 'command', 0, 'config:cache', NULL, NULL, 3, 1, NULL, NULL, NULL, 1, NULL),
(3, 2, NULL, NULL, NULL, 1, 'initial_setup', 'command', 0, 'initial:setup', NULL, NULL, 3, 1, NULL, NULL, NULL, 1, NULL),
        (2, 2, NULL, NULL, 0, 1, 'defaultDesign', 'command', 0, 'revert:defaultDesigns', '', NULL, 3, 1, NULL, NULL, NULL, 1, NULL);");
        }
        else {
            if (!Schema::hasColumn('tasks', 'id')) {
                Schema::table('tasks', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('tasks', 'user_id')) {
                Schema::table('tasks', function (Blueprint $table) {
                    $table->integer('user_id')->nullable();
                });
            }
            if (!Schema::hasColumn('tasks', 'thread_id')) {
                Schema::table('tasks', function (Blueprint $table) {
                    $table->integer('thread_id')->nullable();
                });
            }
            if (!Schema::hasColumn('tasks', 'task_id')) {
                Schema::table('tasks', function (Blueprint $table) {
                    $table->integer('task_id')->nullable();
                });
            }
            if (!Schema::hasColumn('tasks', 'record_id')) {
                Schema::table('tasks', function (Blueprint $table) {
                    $table->integer('record_id')->nullable();
                });
            }
            if (!Schema::hasColumn('tasks', 'thread_number')) {
                Schema::table('tasks', function (Blueprint $table) {
                    $table->integer('thread_number')->nullable();
                });
            }
            if (!Schema::hasColumn('tasks', 'task')) {
                Schema::table('tasks', function (Blueprint $table) {
                    $table->string('task', 55)->nullable()->default('query');
                });
            }
            if (!Schema::hasColumn('tasks', 'type')) {
                Schema::table('tasks', function (Blueprint $table) {
                    $table->enum('type', ['query', 'command'])->nullable()->default('query');
                });
            }
            if (!Schema::hasColumn('tasks', 'status')) {
                Schema::table('tasks', function (Blueprint $table) {
                    $table->boolean('status')->nullable()->default(false)->comment('0:pending, 1:complete, 2: Running, 3: Failed');
                });
            }
            if (!Schema::hasColumn('tasks', 'value')) {
                Schema::table('tasks', function (Blueprint $table) {
                    $table->string('value', 1000)->nullable();
                });
            }
            if (!Schema::hasColumn('tasks', 'data')) {
                Schema::table('tasks', function (Blueprint $table) {
                    $table->string('data', 1000)->nullable();
                });
            }
            if (!Schema::hasColumn('tasks', 'response')) {
                Schema::table('tasks', function (Blueprint $table) {
                    $table->string('response', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('tasks', 'attempts')) {
                Schema::table('tasks', function (Blueprint $table) {
                    $table->boolean('attempts')->nullable()->default(3);
                });
            }
            if (!Schema::hasColumn('tasks', 'priority')) {
                Schema::table('tasks', function (Blueprint $table) {
                    $table->integer('priority')->nullable()->default(1);
                });
            }
            if (!Schema::hasColumn('tasks', 'created_at')) {
                Schema::table('tasks', function (Blueprint $table) {
                 $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('tasks', 'updated_at')) {
                Schema::table('tasks', function (Blueprint $table) {
                 $table->timestamp('updated_at')->useCurrentOnUpdate();
                });
            }
            if (!Schema::hasColumn('tasks', 'start_time')) {
                Schema::table('tasks', function (Blueprint $table) {
                    $table->timestamp('start_time')->nullable();
                });
            }
            if (!Schema::hasColumn('tasks', 'is_running')) {
                Schema::table('tasks', function (Blueprint $table) {
                    $table->tinyInteger('is_running')->default(1);
                });
            }
            if (!Schema::hasColumn('tasks', 'end_time')) {
                Schema::table('tasks', function (Blueprint $table) {
                    $table->timestamp('end_time')->nullable();
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
        Schema::dropIfExists('tasks');
    }

}
;
