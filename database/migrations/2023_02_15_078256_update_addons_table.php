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
        if (Schema::hasTable('addons')) {
           if (!Schema::hasColumn('addons', 'license_key')) {
                Schema::table('addons', function (Blueprint $table) {
                    $table->text('license_key')->nullable();
                });
            }
            if (!Schema::hasColumn('addons', 'local_key')) {
                Schema::table('addons', function (Blueprint $table) {
                    $table->text('local_key')->nullable();
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
        Schema::dropIfExists('addons');
    }

}
;
