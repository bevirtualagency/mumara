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
        if (!Schema::hasTable('custom_css')) {
            Schema::create('custom_css', function (Blueprint $table) {
                $table->integer('id', true);
                $table->longText('css')->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else
        {
            if (!Schema::hasColumn('custom_css', 'id')) {
                Schema::table('custom_css', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('custom_css', 'css')) {
                Schema::table('custom_css', function (Blueprint $table) {
                    $table->longText('css')->nullable();
                });
            }
            if (!Schema::hasColumn('custom_css', 'created_at')) {
                Schema::table('custom_css', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('custom_css', 'updated_at')) {
                Schema::table('custom_css', function (Blueprint $table) {
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
        Schema::dropIfExists('custom_css');
    }

}
;
