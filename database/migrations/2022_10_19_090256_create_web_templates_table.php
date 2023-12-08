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
        if (!Schema::hasTable('web_templates')) {
            Schema::create('web_templates', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('name', 255)->nullable();
                $table->string('url', 255)->nullable();
                $table->longText('content_html')->nullable();
                $table->integer('user_id')->nullable();
                $table->boolean('active')->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else {
             if (!Schema::hasColumn('web_templates', 'id')) {
                Schema::table('web_templates', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('web_templates', 'name')) {
                Schema::table('web_templates', function (Blueprint $table) {
                    $table->string('name', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('web_templates', 'url')) {
                Schema::table('web_templates', function (Blueprint $table) {
                    $table->string('url', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('web_templates', 'content_html')) {
                Schema::table('web_templates', function (Blueprint $table) {
                    $table->longText('content_html')->nullable();
                });
            }
            if (!Schema::hasColumn('web_templates', 'user_id')) {
                Schema::table('web_templates', function (Blueprint $table) {
                    $table->integer('user_id')->nullable();
                });
            }
            if (!Schema::hasColumn('web_templates', 'active')) {
                Schema::table('web_templates', function (Blueprint $table) {
                    $table->boolean('active')->nullable();
                });
            }
            if (!Schema::hasColumn('web_templates', 'created_at')) {
                Schema::table('web_templates', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('web_templates', 'updated_at')) {
                Schema::table('web_templates', function (Blueprint $table) {
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
        Schema::dropIfExists('web_templates');
    }

}
;
