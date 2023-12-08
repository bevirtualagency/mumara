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
        Schema::table('email_track_processing', function (Blueprint $table) {
            if (!Schema::hasColumn('email_track_processing', 'sd_id')) {
                Schema::table('email_track_processing', function (Blueprint $table) {
                    $table->unsignedBigInteger('sd_id');
                });
            }
            if (!Schema::hasColumn('email_track_processing', 'sn_id')) {
                Schema::table('email_track_processing', function (Blueprint $table) {
                    $table->unsignedBigInteger('sn_id');
                });
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
};
