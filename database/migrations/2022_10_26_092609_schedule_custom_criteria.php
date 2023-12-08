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

    public function up()
    {
        Schema::table('campaign_schedules', function (Blueprint $table) { 
            if (!Schema::hasColumn('campaign_schedules', 'is_custom_criteria')) {
                $table->tinyInteger('is_custom_criteria')->after('top_domains')->nullable();
            }
            if (!Schema::hasColumn('campaign_schedules', 'custom_criteria')) {
                $table->text('custom_criteria')->after('is_custom_criteria')->nullable();
            }
            if (!Schema::hasColumn('campaign_schedules', 'custom_qry')) {
                $table->text('custom_qry')->after('custom_criteria')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('campaign_schedules', function (Blueprint $table) {
            $table->dropColumn('is_custom_criteria');
            $table->dropColumn('custom_criteria');
            $table->dropColumn('custom_qry');
        });
    }

}
;
