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
        if (!Schema::hasTable('conversion_trackings')) {
            Schema::create('conversion_trackings', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('event_id')->nullable();
                $table->string('additional_param', 255)->nullable();
                $table->string('url', 400)->nullable();
                $table->string('browser', 255)->nullable();
                $table->string('ip', 255)->nullable();
                $table->string('message_id', 255)->nullable();
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else {
            if (!Schema::hasColumn('conversion_trackings', 'id')) {
                Schema::table('conversion_trackings', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('conversion_trackings', 'event_id')) {
                Schema::table('conversion_trackings', function (Blueprint $table) {
                    $table->integer('event_id')->nullable();
                });
            }
            if (!Schema::hasColumn('conversion_trackings', 'additional_param')) {
                Schema::table('conversion_trackings', function (Blueprint $table) {
                    $table->string('additional_param', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('conversion_trackings', 'url')) {
                Schema::table('conversion_trackings', function (Blueprint $table) {
                    $table->string('url', 400)->nullable();
                });
            }
            if (!Schema::hasColumn('conversion_trackings', 'browser')) {
                Schema::table('conversion_trackings', function (Blueprint $table) {
                    $table->string('browser', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('conversion_trackings', 'ip')) {
                Schema::table('conversion_trackings', function (Blueprint $table) {
                    $table->string('ip', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('conversion_trackings', 'message_id')) {
                Schema::table('conversion_trackings', function (Blueprint $table) {
                    $table->string('message_id', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('conversion_trackings', 'created_at')) {
                Schema::table('conversion_trackings', function (Blueprint $table) {
                  $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('conversion_trackings', 'updated_at')) {
                Schema::table('conversion_trackings', function (Blueprint $table) {
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
        Schema::dropIfExists('conversion_trackings');
    }

}
;
