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
        if (!Schema::hasTable('broadcast_links')) {
            Schema::create('broadcast_links', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('broadcast_id')->nullable();
                $table->string('link', 255)->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else
        {
            if (!Schema::hasColumn('broadcast_links', 'id')) {
                Schema::table('broadcast_links', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('broadcast_links', 'broadcast_id')) {
                Schema::table('broadcast_links', function (Blueprint $table) {
                    $table->integer('broadcast_id')->nullable();
                });
            }
            if (!Schema::hasColumn('broadcast_links', 'link')) {
                Schema::table('broadcast_links', function (Blueprint $table) {
                    $table->string('link', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('broadcast_links', 'created_at')) {
                Schema::table('broadcast_links', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('broadcast_links', 'updated_at')) {
                Schema::table('broadcast_links', function (Blueprint $table) {
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
        Schema::dropIfExists('broadcast_links');
    }

}
;
