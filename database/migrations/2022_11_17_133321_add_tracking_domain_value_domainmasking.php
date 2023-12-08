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
        if (!Schema::hasColumn('domain_maskings', 'tracking_domain_value')) {
            Schema::table('domain_maskings', function (Blueprint $table) {
                $table->string('tracking_domain_value')->after("tracking_domain")->nullable();
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
        if (Schema::hasColumn('domain_maskings', 'tracking_domain_value')) {
            Schema::table('domain_maskings', function (Blueprint $table) {
                $table->dropColumn('tracking_domain_value');
            });
        }
    }
}
;
