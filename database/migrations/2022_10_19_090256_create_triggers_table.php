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
        if (!Schema::hasTable('triggers')) {
            Schema::create('triggers', function (Blueprint $table) {
                $table->integer('id', true);
                $table->boolean('status')->nullable();
                $table->string('disable_reason', 255)->nullable();
                $table->string('name', 255)->nullable();
                $table->string('type', 255)->nullable();
                $table->mediumText('meta_attributes')->nullable();
                $table->integer('user_id')->nullable();
                $table->string('list_ids', 255)->nullable();
                $table->integer('autoresponder_id')->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
                $table->dateTime('run_at')->nullable();
                $table->dateTime('last_activity_at')->nullable();
                $table->integer('sort_order')->nullable()->default(0);
                $table->dateTime('first_activity_at')->nullable();
            });
        } else {
            if (!Schema::hasColumn('triggers', 'id')) {
                Schema::table('triggers', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('triggers', 'status')) {
                Schema::table('triggers', function (Blueprint $table) {
                    $table->boolean('status')->nullable();
                });
            }
            if (!Schema::hasColumn('triggers', 'disable_reason')) {
                Schema::table('triggers', function (Blueprint $table) {
                    $table->string('disable_reason', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('triggers', 'name')) {
                Schema::table('triggers', function (Blueprint $table) {
                    $table->string('name', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('triggers', 'type')) {
                Schema::table('triggers', function (Blueprint $table) {
                    $table->string('type', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('triggers', 'meta_attributes')) {
                Schema::table('triggers', function (Blueprint $table) {
                    $table->mediumText('meta_attributes')->nullable();
                });
            }
            if (!Schema::hasColumn('triggers', 'user_id')) {
                Schema::table('triggers', function (Blueprint $table) {
                    $table->integer('user_id')->nullable();
                });
            }
            if (!Schema::hasColumn('triggers', 'list_ids')) {
                Schema::table('triggers', function (Blueprint $table) {
                    $table->string('list_ids', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('triggers', 'autoresponder_id')) {
                Schema::table('triggers', function (Blueprint $table) {
                    $table->integer('autoresponder_id')->nullable();
                });
            }
            if (!Schema::hasColumn('triggers', 'created_at')) {
                Schema::table('triggers', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('triggers', 'updated_at')) {
                Schema::table('triggers', function (Blueprint $table) {
                   $table->timestamp('updated_at')->useCurrentOnUpdate();
                });
            }
            if (!Schema::hasColumn('triggers', 'run_at')) {
                Schema::table('triggers', function (Blueprint $table) {
                    $table->dateTime('run_at')->nullable();
                });
            }
            if (!Schema::hasColumn('triggers', 'last_activity_at')) {
                Schema::table('triggers', function (Blueprint $table) {
                    $table->dateTime('last_activity_at')->nullable();
                });
            }
            if (!Schema::hasColumn('triggers', 'sort_order')) {
                Schema::table('triggers', function (Blueprint $table) {
                    $table->integer('sort_order')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('triggers', 'first_activity_at')) {
                Schema::table('triggers', function (Blueprint $table) {
                    $table->dateTime('first_activity_at')->nullable();
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
        Schema::dropIfExists('triggers');
    }

}
;
