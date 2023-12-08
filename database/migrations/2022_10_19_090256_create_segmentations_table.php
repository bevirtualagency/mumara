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
        if (!Schema::hasTable('segmentations')) {
            Schema::create('segmentations', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('name', 255)->nullable();
                $table->string('list_type', 20)->nullable();
                $table->text('meta_attributes')->nullable();
                $table->integer('total')->nullable()->default(0);
                $table->integer('processed')->nullable()->default(0);
                $table->boolean('is_completed')->default(false);
                $table->string('action', 50)->nullable();
                $table->enum('status', ['processing', 'paused', 'canceled'])->default('processing');
                $table->boolean('is_running')->default(false);
                $table->integer('list_id')->nullable();
                $table->integer('user_id')->nullable();
                $table->string('segment_list_ids', 255)->nullable();
                $table->tinyInteger('segment_type')->nullable();
                $table->text('export_meta_attributes')->nullable();
                $table->enum('duplicate_action', ['skip_existing', 'overwrite_existing', 'update_existing', 'delete_existing'])->nullable();
                $table->string('exported_file_name', 255)->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else {
            if (!Schema::hasColumn('segmentations', 'id')) {
                Schema::table('segmentations', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('segmentations', 'name')) {
                Schema::table('segmentations', function (Blueprint $table) {
                    $table->string('name', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('segmentations', 'list_type')) {
                Schema::table('segmentations', function (Blueprint $table) {
                    $table->string('list_type', 20)->nullable();
                });
            }
            if (!Schema::hasColumn('segmentations', 'meta_attributes')) {
                Schema::table('segmentations', function (Blueprint $table) {
                    $table->text('meta_attributes')->nullable();
                });
            }
            if (!Schema::hasColumn('segmentations', 'total')) {
                Schema::table('segmentations', function (Blueprint $table) {
                    $table->integer('total')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('segmentations', 'processed')) {
                Schema::table('segmentations', function (Blueprint $table) {
                    $table->integer('processed')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('segmentations', 'is_completed')) {
                Schema::table('segmentations', function (Blueprint $table) {
                    $table->boolean('is_completed')->default(false);
                });
            }
            if (!Schema::hasColumn('segmentations', 'action')) {
                Schema::table('segmentations', function (Blueprint $table) {
                    $table->string('action', 50)->nullable();
                });
            }
            if (!Schema::hasColumn('segmentations', 'status')) {
                Schema::table('segmentations', function (Blueprint $table) {
                    $table->enum('status', ['processing', 'paused', 'canceled'])->default('processing');
                });
            }
            if (!Schema::hasColumn('segmentations', 'is_running')) {
                Schema::table('segmentations', function (Blueprint $table) {
                    $table->boolean('is_running')->default(false);
                });
            }
            if (!Schema::hasColumn('segmentations', 'list_id')) {
                Schema::table('segmentations', function (Blueprint $table) {
                    $table->integer('list_id')->nullable();
                });
            }
            if (!Schema::hasColumn('segmentations', 'user_id')) {
                Schema::table('segmentations', function (Blueprint $table) {
                    $table->integer('user_id')->nullable();
                });
            }
            if (!Schema::hasColumn('segmentations', 'segment_list_ids')) {
                Schema::table('segmentations', function (Blueprint $table) {
                    $table->string('segment_list_ids', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('segmentations', 'segment_type')) {
                Schema::table('segmentations', function (Blueprint $table) {
                    $table->tinyInteger('segment_type')->nullable();
                });
            }
            if (!Schema::hasColumn('segmentations', 'export_meta_attributes')) {
                Schema::table('segmentations', function (Blueprint $table) {
                    $table->text('export_meta_attributes')->nullable();
                });
            }
            if (!Schema::hasColumn('segmentations', 'duplicate_action')) {
                Schema::table('segmentations', function (Blueprint $table) {
                    $table->enum('duplicate_action', ['skip_existing', 'overwrite_existing', 'update_existing', 'delete_existing'])->nullable();
                });
            }
            if (!Schema::hasColumn('segmentations', 'exported_file_name')) {
                Schema::table('segmentations', function (Blueprint $table) {
                    $table->string('exported_file_name', 255)->nullable();
                });
            }
             if (!Schema::hasColumn('segmentations', 'created_at')) {
                Schema::table('segmentations', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('segmentations', 'updated_at')) {
                Schema::table('segmentations', function (Blueprint $table) {
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
        Schema::dropIfExists('segmentations');
    }

}
;
