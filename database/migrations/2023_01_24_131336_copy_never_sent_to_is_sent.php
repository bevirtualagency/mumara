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
        try{
             DB::table('alter_tables')->insert([
                'name'=>'Update subscribers Table copy never_sent to is sent',
                'query'=>'UPDATE subscribers SET is_sent = never_sent',
                'status'=>0,
                'fields'=>null,
            ]);
        } catch(\Exception $e) { }
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
;
