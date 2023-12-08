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
        $result = DB::table("application_settings")->where("setting_name","open_unopen_chart");
        if($result->count()>0){
            DB::table("application_settings")->where("setting_name","open_unopen_chart")->update(array(
                'setting_value'=>'horizontal_bar_graph'
            ));
        }else{
            DB::table("application_settings")->insert(array(
                'setting_name'=>'open_unopen_chart',
                'setting_value'=>'horizontal_bar_graph'
            ));
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table("application_settings")->where("setting_name","open_unopen_chart")->delete();
    }
}
;
