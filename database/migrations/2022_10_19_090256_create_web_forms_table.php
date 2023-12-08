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
        if (!Schema::hasTable('web_forms')) {
            Schema::create('web_forms', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('name', 255)->nullable();
                $table->enum('type', ['subscription'])->nullable();
                $table->longText('form_attributes')->nullable();
                $table->text('content_html')->nullable();
                $table->integer('user_id');
                $table->integer('design_id')->nullable();
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else {
            if (!Schema::hasColumn('web_forms', 'id')) {
                Schema::table('web_forms', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('web_forms', 'name')) {
                Schema::table('web_forms', function (Blueprint $table) {
                    $table->string('name', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('web_forms', 'type')) {
                Schema::table('web_forms', function (Blueprint $table) {
                    $table->enum('type', ['subscription'])->nullable();
                });
            }
            if (!Schema::hasColumn('web_forms', 'form_attributes')) {
                Schema::table('web_forms', function (Blueprint $table) {
                    $table->longText('form_attributes')->nullable();
                });
            }
            if (!Schema::hasColumn('web_forms', 'content_html')) {
                Schema::table('web_forms', function (Blueprint $table) {
                    $table->text('content_html')->nullable();
                });
            }
            if (!Schema::hasColumn('web_forms', 'user_id')) {
                Schema::table('web_forms', function (Blueprint $table) {
                    $table->integer('user_id');
                });
            }
            if (!Schema::hasColumn('web_forms', 'design_id')) {
                Schema::table('web_forms', function (Blueprint $table) {
                    $table->integer('design_id')->nullable();
                });
            }
            if (!Schema::hasColumn('web_forms', 'created_at')) {
                Schema::table('web_forms', function (Blueprint $table) {
               $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('web_forms', 'updated_at')) {
                Schema::table('web_forms', function (Blueprint $table) {
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
        Schema::dropIfExists('web_forms');
    }

}
;
