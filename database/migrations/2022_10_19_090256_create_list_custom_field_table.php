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
        if (!Schema::hasTable('list_custom_field')) {
            Schema::create('list_custom_field', function (Blueprint $table) {
                $table->integer('list_id')->nullable()->index('fk_list_id');
                $table->integer('custom_field_id')->nullable()->index('fk_custom_field_id');
            });
        }
        else{
            if (!Schema::hasColumn('list_custom_field', 'list_id')) {
                Schema::table('list_custom_field', function (Blueprint $table) {
                    $table->integer('list_id')->nullable()->index('fk_list_id');
                    $table->foreign(['list_id'], 'fk_list_id')->references(['id'])->on('lists');
                });
            }
            if (!Schema::hasColumn('list_custom_field', 'custom_field_id')) {
                Schema::table('list_custom_field', function (Blueprint $table) {
                    $table->integer('custom_field_id')->nullable()->index('fk_custom_field_id');
                     $table->foreign(['custom_field_id'], 'fk_custom_field_id')->references(['id'])->on('custom_fields');
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
        Schema::dropIfExists('list_custom_field');
    }

}
;
