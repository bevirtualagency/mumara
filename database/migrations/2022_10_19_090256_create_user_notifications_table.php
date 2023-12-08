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
        if (!Schema::hasTable('user_notifications')) {
            Schema::create('user_notifications', function (Blueprint $table) {
                $table->integer('id', true);
                $table->tinyInteger('type')->nullable();
                $table->integer('user_id');
                $table->string('notification', 255)->nullable();
                $table->boolean('is_read')->default(false);
                $table->tinyInteger('is_show')->nullable();
                $table->text('meta_data')->nullable();
                $table->integer('module_id')->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else {
            if (!Schema::hasColumn('user_notifications', 'id')) {
                Schema::table('user_notifications', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
             if (!Schema::hasColumn('user_notifications', 'type')) {
                Schema::table('user_notifications', function (Blueprint $table) {
                    $table->tinyInteger('type')->nullable();
                });
            }
             if (!Schema::hasColumn('user_notifications', 'user_id')) {
                Schema::table('user_notifications', function (Blueprint $table) {
                    $table->integer('user_id');
                });
            }
            if (!Schema::hasColumn('user_notifications', 'notification')) {
                Schema::table('user_notifications', function (Blueprint $table) {
                    $table->string('notification', 255)->nullable();
                });
            }
            

            if (!Schema::hasColumn('user_notifications', 'is_read')) {
                Schema::table('user_notifications', function (Blueprint $table) {
                    $table->boolean('is_read')->default(false);
                });
            }
             if (!Schema::hasColumn('user_notifications', 'is_show')) {
                Schema::table('user_notifications', function (Blueprint $table) {
                    $table->tinyInteger('is_show')->nullable();
                });
            }
             if (!Schema::hasColumn('user_notifications', 'meta_data')) {
                Schema::table('user_notifications', function (Blueprint $table) {
                    $table->text('meta_data')->nullable();
                });
            }
             if (!Schema::hasColumn('user_notifications', 'module_id')) {
                Schema::table('user_notifications', function (Blueprint $table) {
                    $table->integer('module_id')->nullable();
                });
            }
             if (!Schema::hasColumn('user_notifications', 'created_at')) {
                Schema::table('user_notifications', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
             if (!Schema::hasColumn('user_notifications', 'updated_at')) {
                Schema::table('user_notifications', function (Blueprint $table) {
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
        Schema::dropIfExists('user_notifications');
    }

}
;
