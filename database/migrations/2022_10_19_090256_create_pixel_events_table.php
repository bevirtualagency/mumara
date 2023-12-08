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
        if (!Schema::hasTable('pixel_events')) {
            Schema::create('pixel_events', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('name', 255)->nullable();
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else
        {
            if (!Schema::hasColumn('pixel_events', 'id')) {
                Schema::table('pixel_events', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('pixel_events', 'name')) {
                Schema::table('pixel_events', function (Blueprint $table) {
                    $table->string('name', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('pixel_events', 'created_at')) {
                Schema::table('pixel_events', function (Blueprint $table) {
               $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('pixel_events', 'updated_at')) {
                Schema::table('pixel_events', function (Blueprint $table) {
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
        Schema::dropIfExists('pixel_events');
    }

}
;
