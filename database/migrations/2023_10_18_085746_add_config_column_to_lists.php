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
        if (!Schema::hasColumn('lists', 'additional_settings')) {
            Schema::table('lists', function (Blueprint $table) {
                $table->text('additional_settings')->collation('utf8mb4_general_ci')->nullable()->default(NULL);
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
        if (Schema::hasColumn('lists', 'additional_settings')) {
            Schema::table('lists', function (Blueprint $table) {
                $table->dropColumn('additional_settings');
            });
        }
    }
};
