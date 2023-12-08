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
        
        if (!Schema::hasColumn('segmentations', 'is_show_trigger')) {
            Schema::table('segmentations', function (Blueprint $table) {
                $table->Integer('is_show_trigger')->nullable()->default(1);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        if (Schema::hasColumn('segmentations', 'is_show_trigger')) {
            Schema::table('segmentations', function (Blueprint $table) {
                $table->dropColumn('is_show_trigger');
            });
        }
    }

}
;
