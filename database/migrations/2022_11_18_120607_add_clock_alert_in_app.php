-<?php

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
        try {
            DB::statement('INSERT INTO application_settings SET setting_name = "closeClockAlert",  setting_value = (SELECT count(*) FROM domain_maskings WHERE type="index")');
        } catch (\Exception $e) {
            Log::info("Error in up CreateTableIndexes: ".$e->getMessage());  
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('app', function (Blueprint $table) {
            //
        });
    }
}
;
