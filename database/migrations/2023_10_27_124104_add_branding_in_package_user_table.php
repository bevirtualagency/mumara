<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'allow_branding')) {
            Schema::table('users', function (Blueprint $table) {
                $table->Integer('allow_branding')->nullable();
            });
        }
        if (!Schema::hasColumn('packages', 'allow_branding')) {
            Schema::table('packages', function (Blueprint $table) {
                $table->Integer('allow_branding')->nullable();
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
        if (Schema::hasColumn('users', 'allow_branding')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('allow_branding');
            });
        }
        if (Schema::hasColumn('packages', 'allow_branding')) {
            Schema::table('packages', function (Blueprint $table) {
                $table->dropColumn('allow_branding');
            });
        }
    }
};
