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
        Schema::table('segmentations', function (Blueprint $table) {
            if (!Schema::hasColumn('segmentations', 'segment_query')) {
                $table->text('segment_query')->after('exported_file_name')->nullable();
            }            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('segmentations', function (Blueprint $table) {
            $table->dropColumn('segment_query');            
        });
    }

}
;
