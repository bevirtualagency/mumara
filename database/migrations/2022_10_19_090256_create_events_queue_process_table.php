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
        if (!Schema::hasTable('events_queue_process')) {
            Schema::create('events_queue_process', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('event_type', 50)->nullable();
                $table->string('event_action', 50)->nullable();
                $table->string('action_type', 15)->nullable()->comment('instant or later');
                $table->text('data')->nullable();
                $table->integer('record_id')->nullable();
                $table->boolean('status')->nullable()->comment('1=> pending, 2=>processing, 3=>completed');
                $table->integer('process_id')->nullable();
                $table->dateTime('created_at')->nullable();
                $table->dateTime('updated_at')->nullable();

                $table->index(['event_action', 'process_id'], 'event_action');
            });
        }
        else {
            if (!Schema::hasColumn('events_queue_process', 'id')) {
                Schema::table('events_queue_process', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('events_queue_process', 'event_type')) {
                Schema::table('events_queue_process', function (Blueprint $table) {
                    $table->string('event_type', 50)->nullable();
                });
            }
            if (!Schema::hasColumn('events_queue_process', 'event_action')) {
                Schema::table('events_queue_process', function (Blueprint $table) {
                    $table->string('event_action', 50)->nullable();
                });
            }
            if (!Schema::hasColumn('events_queue_process', 'action_type')) {
                Schema::table('events_queue_process', function (Blueprint $table) {
                    $table->string('action_type', 15)->nullable()->comment('instant or later');
                });
            }
            if (!Schema::hasColumn('events_queue_process', 'data')) {
                Schema::table('events_queue_process', function (Blueprint $table) {
                    $table->text('data')->nullable();
                });
            }
            if (!Schema::hasColumn('events_queue_process', 'record_id')) {
                Schema::table('events_queue_process', function (Blueprint $table) {
                    $table->integer('record_id')->nullable();
                });
            }
            if (!Schema::hasColumn('events_queue_process', 'status')) {
                Schema::table('events_queue_process', function (Blueprint $table) {
                    $table->boolean('status')->nullable()->comment('1=> pending, 2=>processing, 3=>completed');
                });
            }
            if (!Schema::hasColumn('events_queue_process', 'process_id')) {
                Schema::table('events_queue_process', function (Blueprint $table) {
                    $table->integer('process_id')->nullable();
                });
            }
            if (!Schema::hasColumn('events_queue_process', 'created_at')) {
                Schema::table('events_queue_process', function (Blueprint $table) {
                 $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('events_queue_process', 'updated_at')) {
                Schema::table('events_queue_process', function (Blueprint $table) {
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
        Schema::dropIfExists('events_queue_process');
    }

}
;
