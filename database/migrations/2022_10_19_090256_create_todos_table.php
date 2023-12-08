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
        if (!Schema::hasTable('todos')) {
            Schema::create('todos', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('name', 255)->nullable();
                $table->text('description')->nullable();
                $table->string('route', 255)->nullable();
                $table->tinyInteger('is_done')->nullable();
                $table->integer('sequence')->nullable();
            });
        }
        else {
             if (!Schema::hasColumn('todos', 'id')) {
                Schema::table('todos', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('todos', 'name')) {
                Schema::table('todos', function (Blueprint $table) {
                    $table->string('name', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('todos', 'description')) {
                Schema::table('todos', function (Blueprint $table) {
                    $table->text('description')->nullable();
                });
            }
            if (!Schema::hasColumn('todos', 'route')) {
                Schema::table('todos', function (Blueprint $table) {
                    $table->string('route', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('todos', 'is_done')) {
                Schema::table('todos', function (Blueprint $table) {
                    $table->tinyInteger('is_done')->nullable();
                });
            }
            if (!Schema::hasColumn('todos', 'sequence')) {
                Schema::table('todos', function (Blueprint $table) {
                    $table->integer('sequence')->nullable();
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
        Schema::dropIfExists('todos');
    }

}
;
