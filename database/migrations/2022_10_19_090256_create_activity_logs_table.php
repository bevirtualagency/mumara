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
        if (!Schema::hasTable('activity_logs')) {
            Schema::create('activity_logs', function (Blueprint $table) {
                $table->bigInteger('id', true);
                $table->string('ip', 30)->nullable();
                $table->integer('user_id')->nullable();
                $table->string('activity', 255)->nullable();
                $table->string('type', 20)->nullable();
                $table->text('description')->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else {
            if (!Schema::hasColumn('activity_logs', 'id')) {
                Schema::table('activity_logs', function (Blueprint $table) {
                    $table->bigInteger('id', true);
                });
            }
            if (!Schema::hasColumn('activity_logs', 'ip')) {
                Schema::table('activity_logs', function (Blueprint $table) {
                    $table->string('ip', 30)->nullable();
                });
            }
            if (!Schema::hasColumn('activity_logs', 'user_id')) {
                Schema::table('activity_logs', function (Blueprint $table) {
                    $table->integer('user_id')->nullable();
                });
            }
            if (!Schema::hasColumn('activity_logs', 'activity')) {
                Schema::table('activity_logs', function (Blueprint $table) {
                    $table->string('activity', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('activity_logs', 'type')) {
                Schema::table('activity_logs', function (Blueprint $table) {
                    $table->string('type', 20)->nullable();
                });
            }
            if (!Schema::hasColumn('activity_logs', 'description')) {
                Schema::table('activity_logs', function (Blueprint $table) {
                    $table->text('description')->nullable();
                });
            }
            if (!Schema::hasColumn('activity_logs', 'created_at')) {
                Schema::table('activity_logs', function (Blueprint $table) {
                     $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
             if (!Schema::hasColumn('activity_logs', 'updated_at')) {
                Schema::table('activity_logs', function (Blueprint $table) {
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
        Schema::dropIfExists('activity_logs');
    }

}
;
