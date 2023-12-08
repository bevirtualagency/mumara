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
        if (!Schema::hasTable('subscriber_imports')) {
            Schema::create('subscriber_imports', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('list_id')->nullable();
                $table->integer('user_id')->nullable();
                $table->enum('type', ['normal', 'email', 'domain', 'ip'])->default('normal');
                $table->string('file', 255)->nullable();
                $table->string('custom_fields', 255)->nullable();
                $table->tinyInteger('is_running')->nullable()->default(0);
                $table->tinyInteger('is_complete')->default(0);
                $table->tinyInteger('threads')->default(1);
                $table->unsignedInteger('running_thread')->default('0');
                $table->integer('total_import')->nullable()->default(0);
                $table->integer('imported')->nullable()->default(0);
                $table->integer('duplicates')->nullable()->default(0);
                $table->integer('overwritten')->default(0);
                $table->integer('invalids')->nullable()->default(0);
                $table->text('meta_attributes')->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else 
        {
            if (!Schema::hasColumn('subscriber_imports', 'id')) {
                Schema::table('subscriber_imports', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('subscriber_imports', 'list_id')) {
                Schema::table('subscriber_imports', function (Blueprint $table) {
                    $table->integer('list_id')->nullable();
                });
            }
            if (!Schema::hasColumn('subscriber_imports', 'user_id')) {
                Schema::table('subscriber_imports', function (Blueprint $table) {
                    $table->integer('user_id')->nullable();
                });
            }
            if (!Schema::hasColumn('subscriber_imports', 'type')) {
                Schema::table('subscriber_imports', function (Blueprint $table) {
                    $table->enum('type', ['normal', 'email', 'domain', 'ip'])->default('normal');
                });
            }
            if (!Schema::hasColumn('subscriber_imports', 'file')) {
                Schema::table('subscriber_imports', function (Blueprint $table) {
                    $table->string('file', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('subscriber_imports', 'custom_fields')) {
                Schema::table('subscriber_imports', function (Blueprint $table) {
                    $table->string('custom_fields', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('subscriber_imports', 'is_running')) {
                Schema::table('subscriber_imports', function (Blueprint $table) {
                    $table->tinyInteger('is_running')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('subscriber_imports', 'is_complete')) {
                Schema::table('subscriber_imports', function (Blueprint $table) {
                    $table->tinyInteger('is_complete')->default(0);
                });
            }
            if (!Schema::hasColumn('subscriber_imports', 'threads')) {
                Schema::table('subscriber_imports', function (Blueprint $table) {
                    $table->tinyInteger('threads')->default(1);
                });
            }
            if (!Schema::hasColumn('subscriber_imports', 'running_thread')) {
                Schema::table('subscriber_imports', function (Blueprint $table) {
                    $table->unsignedInteger('running_thread')->default('0');
                });
            }
            if (!Schema::hasColumn('subscriber_imports', 'total_import')) {
                Schema::table('subscriber_imports', function (Blueprint $table) {
                    $table->integer('total_import')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('subscriber_imports', 'imported')) {
                Schema::table('subscriber_imports', function (Blueprint $table) {
                    $table->integer('imported')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('subscriber_imports', 'duplicates')) {
                Schema::table('subscriber_imports', function (Blueprint $table) {
                    $table->integer('duplicates')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('subscriber_imports', 'overwritten')) {
                Schema::table('subscriber_imports', function (Blueprint $table) {
                    $table->integer('overwritten')->default(0);
                });
            }
            if (!Schema::hasColumn('subscriber_imports', 'invalids')) {
                Schema::table('subscriber_imports', function (Blueprint $table) {
                    $table->integer('invalids')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('subscriber_imports', 'meta_attributes')) {
                Schema::table('subscriber_imports', function (Blueprint $table) {
                    $table->text('meta_attributes')->nullable();
                });
            }
            if (!Schema::hasColumn('subscriber_imports', 'created_at')) {
                Schema::table('subscriber_imports', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('subscriber_imports', 'updated_at')) {
                Schema::table('subscriber_imports', function (Blueprint $table) {
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
        Schema::dropIfExists('subscriber_imports');
    }

}
;
