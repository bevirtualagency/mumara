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
        if (!Schema::hasColumn('packages', 'bounce_rate_limit')) {
            Schema::table('packages', function (Blueprint $table) {
                $table->Integer('bounce_rate_limit')->nullable();
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
        if (!Schema::hasColumn('packages', 'bounce_rate_limit')) {
            Schema::table('packages', function (Blueprint $table) {
                $table->dropColumn('bounce_rate_limit');
            });
        }
    }
}
;
