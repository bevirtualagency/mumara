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
        if (!Schema::hasTable('autoresponder_groups')) {
            Schema::create('autoresponder_groups', function (Blueprint $table) {
                $table->integer('id', true);
                $table->boolean('status')->default(false);
                $table->string('name', 255)->nullable();
                $table->boolean('is_start')->default(false);
                $table->string('smtp_ids', 255)->nullable();
                $table->longText('meta_attributes')->nullable();
                $table->integer('user_id');
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else
        {
            if (!Schema::hasColumn('autoresponder_groups', 'id')) {
                Schema::table('autoresponder_groups', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('autoresponder_groups', 'status')) {
                Schema::table('autoresponder_groups', function (Blueprint $table) {
                    $table->boolean('status')->default(false);
                });
            }
            if (!Schema::hasColumn('autoresponder_groups', 'name')) {
                Schema::table('autoresponder_groups', function (Blueprint $table) {
                    $table->string('name', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('autoresponder_groups', 'is_start')) {
                Schema::table('autoresponder_groups', function (Blueprint $table) {
                    $table->boolean('is_start')->default(false);
                });
            }
            if (!Schema::hasColumn('autoresponder_groups', 'smtp_ids')) {
                Schema::table('autoresponder_groups', function (Blueprint $table) {
                    $table->string('smtp_ids', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('autoresponder_groups', 'meta_attributes')) {
                Schema::table('autoresponder_groups', function (Blueprint $table) {
                    $table->longText('meta_attributes')->nullable();
                });
            }
            if (!Schema::hasColumn('autoresponder_groups', 'user_id')) {
                Schema::table('autoresponder_groups', function (Blueprint $table) {
                    $table->integer('user_id');
                });
            }
            if (!Schema::hasColumn('autoresponder_groups', 'created_at')) {
                Schema::table('autoresponder_groups', function (Blueprint $table) {
                    $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
             if (!Schema::hasColumn('autoresponder_groups', 'updated_at')) {
                Schema::table('autoresponder_groups', function (Blueprint $table) {
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
        Schema::dropIfExists('autoresponder_groups');
    }

}
;
