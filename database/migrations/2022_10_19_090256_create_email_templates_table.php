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
        if (!Schema::hasTable('email_templates')) {
            Schema::create('email_templates', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('name', 255)->nullable();
                $table->integer('group_id')->nullable();
                $table->longText('content_html')->nullable();
                $table->integer('user_id')->nullable();
                $table->boolean('is_default')->default(false);
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else {
             if (!Schema::hasColumn('email_templates', 'id')) {
                Schema::table('email_templates', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('email_templates', 'name')) {
                Schema::table('email_templates', function (Blueprint $table) {
                    $table->string('name', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('email_templates', 'group_id')) {
                Schema::table('email_templates', function (Blueprint $table) {
                    $table->integer('group_id')->nullable();
                });
            }
            if (!Schema::hasColumn('email_templates', 'content_html')) {
                Schema::table('email_templates', function (Blueprint $table) {
                    $table->longText('content_html')->nullable();
                });
            }
            if (!Schema::hasColumn('email_templates', 'user_id')) {
                Schema::table('email_templates', function (Blueprint $table) {
                    $table->integer('user_id')->nullable();
                });
            }
            if (!Schema::hasColumn('email_templates', 'is_default')) {
                Schema::table('email_templates', function (Blueprint $table) {
                    $table->boolean('is_default')->default(false);
                });
            }
            if (!Schema::hasColumn('email_templates', 'created_at')) {
                Schema::table('email_templates', function (Blueprint $table) {
                  $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('email_templates', 'updated_at')) {
                Schema::table('email_templates', function (Blueprint $table) {
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
        Schema::dropIfExists('email_templates');
    }

}
;
