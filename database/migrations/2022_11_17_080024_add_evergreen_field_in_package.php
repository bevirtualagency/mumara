<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('packages', 'trigger_actions')) {
            Schema::table('packages', function (Blueprint $table) {
                $table->integer('trigger_actions')->after("triggers_limit")->default(NULL);                
            });
        }
        if (!Schema::hasColumn('packages', 'evergreen_campaigns')) {
            Schema::table('packages', function (Blueprint $table) {                
                $table->integer('evergreen_campaigns')->after("triggers_limit")->default(NULL);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       if (Schema::hasColumn('packages', 'evergreen_campaigns')) {
            Schema::table('packages', function (Blueprint $table) {
                $table->dropColumn('evergreen_campaigns');
                $table->dropColumn('trigger_actions');
            });
        }
    }
}
;
