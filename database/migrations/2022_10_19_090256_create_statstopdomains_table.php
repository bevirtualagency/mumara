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
        if (!Schema::hasTable('statstopdomains')) {
            Schema::create('statstopdomains', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('user_id')->nullable();
                $table->text('data')->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else {
            if (!Schema::hasColumn('statstopdomains', 'id')) {
                Schema::table('statstopdomains', function (Blueprint $table) {
                    $table->increments('id');
                });
            }
            if (!Schema::hasColumn('statstopdomains', 'user_id')) {
                Schema::table('statstopdomains', function (Blueprint $table) {
                    $table->unsignedInteger('user_id')->nullable();
                });
            }
            if (!Schema::hasColumn('statstopdomains', 'data')) {
                Schema::table('statstopdomains', function (Blueprint $table) {
                    $table->text('data')->nullable();
                });
            }
            if (!Schema::hasColumn('statstopdomains', 'created_at')) {
                Schema::table('statstopdomains', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('statstopdomains', 'updated_at')) {
                Schema::table('statstopdomains', function (Blueprint $table) {
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
        Schema::dropIfExists('statstopdomains');
    }

}
;
