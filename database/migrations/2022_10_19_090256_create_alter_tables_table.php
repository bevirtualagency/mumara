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
        if (!Schema::hasTable('alter_tables')) {
            Schema::create('alter_tables', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('name', 255)->nullable();
                $table->enum('type', ['query', 'command'])->default('query');
                $table->text('query');
                $table->tinyInteger('status')->default(0);
                $table->text('fields')->nullable();
                $table->boolean('try_attempts')->default(false);
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
                $table->time('execute_at')->nullable();
            });
        }
        else
        {
            if (!Schema::hasColumn('alter_tables', 'id')) {
                Schema::table('alter_tables', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('alter_tables', 'name')) {
                Schema::table('alter_tables', function (Blueprint $table) {
                    $table->string('name', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('alter_tables', 'type')) {
                Schema::table('alter_tables', function (Blueprint $table) {
                    $table->enum('type', ['query', 'command'])->default('query');
                });
            }
            if (!Schema::hasColumn('alter_tables', 'query')) {
                Schema::table('alter_tables', function (Blueprint $table) {
                    $table->text('query');
                });
            }
            if (!Schema::hasColumn('alter_tables', 'status')) {
                Schema::table('alter_tables', function (Blueprint $table) {
                    $table->tinyInteger('status')->default(0);
                });
            }
            if (!Schema::hasColumn('alter_tables', 'fields')) {
                Schema::table('alter_tables', function (Blueprint $table) {
                    $table->text('fields')->nullable();
                });
            }
            if (!Schema::hasColumn('alter_tables', 'try_attempts')) {
                Schema::table('alter_tables', function (Blueprint $table) {
                    $table->boolean('try_attempts')->default(false);
                });
            }
            if (!Schema::hasColumn('alter_tables', 'created_at')) {
                Schema::table('alter_tables', function (Blueprint $table) {
                    $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('alter_tables', 'updated_at')) {
                Schema::table('alter_tables', function (Blueprint $table) {
                   $table->timestamp('updated_at')->useCurrentOnUpdate();
                });
            }
            if (!Schema::hasColumn('alter_tables', 'execute_at')) {
                Schema::table('alter_tables', function (Blueprint $table) {
                    $table->time('execute_at')->nullable();
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
        Schema::dropIfExists('alter_tables');
    }

}
;
