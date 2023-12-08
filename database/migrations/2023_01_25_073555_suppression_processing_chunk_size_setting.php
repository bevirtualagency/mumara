<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $count = DB::table('application_settings')->where('setting_name','suppression_processing_chunk_size')->count();
        if($count==0){
            DB::table('application_settings')->insert(array('setting_name'=>'suppression_processing_chunk_size','setting_value'=>5000));
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('application_settings')->where('setting_name','suppression_processing_chunk_size')->delete();
    }
}
;
