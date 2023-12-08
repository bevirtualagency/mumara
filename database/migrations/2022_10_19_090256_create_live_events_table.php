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
        if (!Schema::hasTable('live_events')) {
            Schema::create('live_events', function (Blueprint $table) {
                $table->integer('id', true);
                $table->tinyInteger('type')->nullable();
                $table->string('event', 255)->nullable();
                $table->tinyInteger('sort')->default(1);
                $table->integer('module')->nullable();
                $table->integer('user_id')->nullable();
                $table->string('route', 255)->nullable();
                $table->text('params')->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else {
            if (!Schema::hasColumn('live_events', 'id')) {
                Schema::table('live_events', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('live_events', 'type')) {
                Schema::table('live_events', function (Blueprint $table) {
                    $table->tinyInteger('type')->nullable();
                });
            }
            if (!Schema::hasColumn('live_events', 'event')) {
                Schema::table('live_events', function (Blueprint $table) {
                    $table->string('event', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('live_events', 'sort')) {
                Schema::table('live_events', function (Blueprint $table) {
                    $table->tinyInteger('sort')->default(1);
                });
            }
            if (!Schema::hasColumn('live_events', 'module')) {
                Schema::table('live_events', function (Blueprint $table) {
                    $table->integer('module')->nullable();
                });
            }
            if (!Schema::hasColumn('live_events', 'user_id')) {
                Schema::table('live_events', function (Blueprint $table) {
                    $table->integer('user_id')->nullable();
                });
            }
            if (!Schema::hasColumn('live_events', 'route')) {
                Schema::table('live_events', function (Blueprint $table) {
                    $table->string('route', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('live_events', 'params')) {
                Schema::table('live_events', function (Blueprint $table) {
                    $table->text('params')->nullable();
                });
            }
            if (!Schema::hasColumn('live_events', 'created_at')) {
                Schema::table('live_events', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('live_events', 'updated_at')) {
                Schema::table('live_events', function (Blueprint $table) {
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
        Schema::dropIfExists('live_events');
    }

}
;
