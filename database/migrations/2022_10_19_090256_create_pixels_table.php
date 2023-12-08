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
        if (!Schema::hasTable('pixels')) {
            Schema::create('pixels', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('pixel_id', 255)->nullable();
                $table->string('name', 255)->nullable();
                $table->integer('event_id')->nullable();
                $table->string('url', 500)->nullable();
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else {
            if (!Schema::hasColumn('pixels', 'id')) {
                Schema::table('pixels', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
             if (!Schema::hasColumn('pixels', 'pixel_id')) {
                Schema::table('pixels', function (Blueprint $table) {
                    $table->string('pixel_id', 255)->nullable();
                });
            }
             if (!Schema::hasColumn('pixels', 'name')) {
                Schema::table('pixels', function (Blueprint $table) {
                    $table->string('name', 255)->nullable();
                });
            }

             if (!Schema::hasColumn('pixels', 'event_id')) {
                Schema::table('pixels', function (Blueprint $table) {
                    $table->integer('event_id')->nullable();
                });
            }
             if (!Schema::hasColumn('pixels', 'url')) {
                Schema::table('pixels', function (Blueprint $table) {
                    $table->string('url', 500)->nullable();
                });
            }
             if (!Schema::hasColumn('pixels', 'created_at')) {
                Schema::table('pixels', function (Blueprint $table) {
               $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
             if (!Schema::hasColumn('pixels', 'updated_at')) {
                Schema::table('pixels', function (Blueprint $table) {
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
        Schema::dropIfExists('pixels');
    }

}
;
