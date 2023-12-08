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
        if (!Schema::hasTable('links')) {
            Schema::create('links', function (Blueprint $table) {
                $table->integer('id', true);
                $table->text('link')->nullable();
            });
        }
        else{
             if (!Schema::hasColumn('links', 'id')) {
                Schema::table('links', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('links', 'link')) {
                Schema::table('links', function (Blueprint $table) {
                    $table->text('link')->nullable();
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
        Schema::dropIfExists('links');
    }

}
;
