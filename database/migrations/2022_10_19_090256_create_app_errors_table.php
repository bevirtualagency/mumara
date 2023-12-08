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
        if (!Schema::hasTable('app_errors')) {
            Schema::create('app_errors', function (Blueprint $table) {
                $table->increments('id');
                $table->string('type', 255);
                $table->unsignedInteger('type_id');
                $table->integer('user_id');
                $table->text('error');
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else
        {
            if (!Schema::hasColumn('app_errors', 'id')) {
                Schema::table('app_errors', function (Blueprint $table) {
                    $table->increments('id');
                });
            }
             if (!Schema::hasColumn('app_errors', 'type')) {
                Schema::table('app_errors', function (Blueprint $table) {
                    $table->string('type', 255);
                });
            }
             if (!Schema::hasColumn('app_errors', 'type_id')) {
                Schema::table('app_errors', function (Blueprint $table) {
                    $table->unsignedInteger('type_id');
                });
            }
             if (!Schema::hasColumn('app_errors', 'user_id')) {
                Schema::table('app_errors', function (Blueprint $table) {
                    $table->integer('user_id');
                });
            }
             if (!Schema::hasColumn('app_errors', 'error')) {
                Schema::table('app_errors', function (Blueprint $table) {
                    $table->text('error');
                });
            }
             if (!Schema::hasColumn('app_errors', 'created_at')) {
                Schema::table('app_errors', function (Blueprint $table) {
                    $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
             if (!Schema::hasColumn('app_errors', 'updated_at')) {
                Schema::table('app_errors', function (Blueprint $table) {
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
        Schema::dropIfExists('app_errors');
    }

}
;
