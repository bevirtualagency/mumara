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
        if (!Schema::hasTable('exported_files')) {
            Schema::create('exported_files', function (Blueprint $table) {
                $table->integer('id', true);
                $table->text('file_path')->nullable();
                $table->tinyInteger('type')->default(0);
                $table->integer('user_id')->nullable();
                $table->string('download_name', 255)->nullable();
                $table->string('ip_address', 20)->nullable();
                $table->tinyInteger('status')->default(0);
                $table->integer('module_id')->nullable();
                $table->longText('params')->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        } 
        else
        {
            if (!Schema::hasColumn('exported_files', 'id')) {
                Schema::table('exported_files', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('exported_files', 'file_path')) {
                Schema::table('exported_files', function (Blueprint $table) {
                    $table->text('file_path')->nullable();
                });
            }
            if (!Schema::hasColumn('exported_files', 'type')) {
                Schema::table('exported_files', function (Blueprint $table) {
                    $table->tinyInteger('type')->default(0);
                });
            }
            if (!Schema::hasColumn('exported_files', 'user_id')) {
                Schema::table('exported_files', function (Blueprint $table) {
                    $table->integer('user_id')->nullable();
                });
            }
            if (!Schema::hasColumn('exported_files', 'download_name')) {
                Schema::table('exported_files', function (Blueprint $table) {
                    $table->string('download_name', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('exported_files', 'ip_address')) {
                Schema::table('exported_files', function (Blueprint $table) {
                    $table->string('ip_address', 20)->nullable();
                });
            }
            if (!Schema::hasColumn('exported_files', 'status')) {
                Schema::table('exported_files', function (Blueprint $table) {
                    $table->tinyInteger('status')->default(0);
                });
            }
            if (!Schema::hasColumn('exported_files', 'module_id')) {
                Schema::table('exported_files', function (Blueprint $table) {
                    $table->integer('module_id')->nullable();
                });
            }
            if (!Schema::hasColumn('exported_files', 'params')) {
                Schema::table('exported_files', function (Blueprint $table) {
                    $table->longText('params')->nullable();
                });
            }
            if (!Schema::hasColumn('exported_files', 'created_at')) {
                Schema::table('exported_files', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('exported_files', 'updated_at')) {
                Schema::table('exported_files', function (Blueprint $table) {
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
        Schema::dropIfExists('exported_files');
    }

}
;
