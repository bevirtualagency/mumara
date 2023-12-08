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
        if (!Schema::hasTable('custom_headers')) {
            Schema::create('custom_headers', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('header_label', 255)->nullable();
                $table->string('header_value', 255)->nullable();
                $table->integer('user_id');
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else {
            if (!Schema::hasColumn('custom_headers', 'id')) {
                Schema::table('custom_headers', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
             if (!Schema::hasColumn('custom_headers', 'header_label')) {
                Schema::table('custom_headers', function (Blueprint $table) {
                    $table->string('header_label', 255)->nullable();
                });
            }
             if (!Schema::hasColumn('custom_headers', 'header_value')) {
                Schema::table('custom_headers', function (Blueprint $table) {
                    $table->string('header_value', 255)->nullable();
                });
            }
             if (!Schema::hasColumn('custom_headers', 'user_id')) {
                Schema::table('custom_headers', function (Blueprint $table) {
                    $table->integer('user_id');
                });
            }
             if (!Schema::hasColumn('custom_headers', 'created_at')) {
                Schema::table('custom_headers', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
             if (!Schema::hasColumn('custom_headers', 'updated_at')) {
                Schema::table('custom_headers', function (Blueprint $table) {
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
        Schema::dropIfExists('custom_headers');
    }

}
;
