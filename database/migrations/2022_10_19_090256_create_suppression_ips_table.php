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
        if (!Schema::hasTable('suppression_ips')) {
            Schema::create('suppression_ips', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('ip_range', 255)->nullable();
                $table->string('min_ip', 255)->nullable();
                $table->string('max_ip', 255)->nullable();
                $table->string('list_id', 255)->nullable();
                $table->string('reference', 255)->nullable();
                $table->integer('user_id');
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else {
            if (!Schema::hasColumn('suppression_ips', 'id')) {
                Schema::table('suppression_ips', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('suppression_ips', 'ip_range')) {
                Schema::table('suppression_ips', function (Blueprint $table) {
                    $table->string('ip_range', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('suppression_ips', 'min_ip')) {
                Schema::table('suppression_ips', function (Blueprint $table) {
                    $table->string('min_ip', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('suppression_ips', 'max_ip')) {
                Schema::table('suppression_ips', function (Blueprint $table) {
                    $table->string('max_ip', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('suppression_ips', 'list_id')) {
                Schema::table('suppression_ips', function (Blueprint $table) {
                    $table->string('list_id', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('suppression_ips', 'reference')) {
                Schema::table('suppression_ips', function (Blueprint $table) {
                    $table->string('reference', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('suppression_ips', 'user_id')) {
                Schema::table('suppression_ips', function (Blueprint $table) {
                    $table->integer('user_id');
                });
            }
            if (!Schema::hasColumn('suppression_ips', 'created_at')) {
                Schema::table('suppression_ips', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('suppression_ips', 'updated_at')) {
                Schema::table('suppression_ips', function (Blueprint $table) {
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
        Schema::dropIfExists('suppression_ips');
    }

}
;
