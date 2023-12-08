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
        if (!Schema::hasTable('active_sessions')) {
            Schema::create('active_sessions', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedInteger('user_id');
                $table->unsignedTinyInteger('remember')->default('0');
                $table->string('file_name')->nullable()->unique('file_name');
                $table->text('geo_info')->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else {
            if (!Schema::hasColumn('active_sessions', 'id')) {
                Schema::table('active_sessions', function (Blueprint $table) {
                    $table->bigIncrements('id');
                });
            }
             if (!Schema::hasColumn('active_sessions', 'user_id')) {
                Schema::table('active_sessions', function (Blueprint $table) {
                    $table->unsignedInteger('user_id');
                });
            }
             if (!Schema::hasColumn('active_sessions', 'remember')) {
                Schema::table('active_sessions', function (Blueprint $table) {
                    $table->unsignedTinyInteger('remember')->default('0');
                });
            }
             if (!Schema::hasColumn('active_sessions', 'file_name')) {
                Schema::table('active_sessions', function (Blueprint $table) {
                    $table->string('file_name')->nullable()->unique('file_name');
                });
            }
             if (!Schema::hasColumn('active_sessions', 'geo_info')) {
                Schema::table('active_sessions', function (Blueprint $table) {
                    $table->text('geo_info')->nullable();
                });
            }
             if (!Schema::hasColumn('active_sessions', 'created_at')) {
                Schema::table('active_sessions', function (Blueprint $table) {
                     $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
             if (!Schema::hasColumn('active_sessions', 'updated_at')) {
                Schema::table('active_sessions', function (Blueprint $table) {
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
        Schema::dropIfExists('active_sessions');
    }

}
;
