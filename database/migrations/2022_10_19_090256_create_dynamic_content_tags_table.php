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
        if (!Schema::hasTable('dynamic_content_tags')) {
            Schema::create('dynamic_content_tags', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('name', 255)->nullable();
                $table->string('label', 255)->nullable();
                $table->mediumText('unit_rules')->nullable();
                $table->longText('content_html_if');
                $table->longText('content_html')->nullable();
                $table->integer('user_id')->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else {
            if (!Schema::hasColumn('dynamic_content_tags', 'id')) {
                Schema::table('dynamic_content_tags', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('dynamic_content_tags', 'name')) {
                Schema::table('dynamic_content_tags', function (Blueprint $table) {
                    $table->string('name', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('dynamic_content_tags', 'label')) {
                Schema::table('dynamic_content_tags', function (Blueprint $table) {
                    $table->string('label', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('dynamic_content_tags', 'unit_rules')) {
                Schema::table('dynamic_content_tags', function (Blueprint $table) {
                    $table->mediumText('unit_rules')->nullable();
                });
            }
            if (!Schema::hasColumn('dynamic_content_tags', 'content_html_if')) {
                Schema::table('dynamic_content_tags', function (Blueprint $table) {
                    $table->longText('content_html_if');
                });
            }
            if (!Schema::hasColumn('dynamic_content_tags', 'content_html')) {
                Schema::table('dynamic_content_tags', function (Blueprint $table) {
                    $table->longText('content_html')->nullable();
                });
            }
            if (!Schema::hasColumn('dynamic_content_tags', 'user_id')) {
                Schema::table('dynamic_content_tags', function (Blueprint $table) {
                    $table->integer('user_id')->nullable();
                });
            }
            if (!Schema::hasColumn('dynamic_content_tags', 'created_at')) {
                Schema::table('dynamic_content_tags', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('dynamic_content_tags', 'updated_at')) {
                Schema::table('dynamic_content_tags', function (Blueprint $table) {
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
        Schema::dropIfExists('dynamic_content_tags');
    }

}
;
