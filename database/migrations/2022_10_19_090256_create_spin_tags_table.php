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
        if (!Schema::hasTable('spin_tags')) {
            Schema::create('spin_tags', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('user_id')->nullable();
                $table->string('place_holder', 255)->nullable();
                $table->string('tag', 255)->nullable();
                $table->text('word_list')->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else {
            if (!Schema::hasColumn('spin_tags', 'id')) {
                Schema::table('spin_tags', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('spin_tags', 'user_id')) {
                Schema::table('spin_tags', function (Blueprint $table) {
                    $table->integer('user_id')->nullable();
                });
            }
            if (!Schema::hasColumn('spin_tags', 'place_holder')) {
                Schema::table('spin_tags', function (Blueprint $table) {
                    $table->string('place_holder', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('spin_tags', 'tag')) {
                Schema::table('spin_tags', function (Blueprint $table) {
                    $table->string('tag', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('spin_tags', 'word_list')) {
                Schema::table('spin_tags', function (Blueprint $table) {
                    $table->text('word_list')->nullable();
                });
            }
            if (!Schema::hasColumn('spin_tags', 'created_at')) {
                Schema::table('spin_tags', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('spin_tags', 'updated_at')) {
                Schema::table('spin_tags', function (Blueprint $table) {
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
        Schema::dropIfExists('spin_tags');
    }

}
;
