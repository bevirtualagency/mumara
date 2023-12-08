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
       DB::table("web_form_categories")->where('id',7)->update(array('category'=>'Contact Form with address'));
       DB::table("web_form_categories")->where('id',1)->update(array('category'=>'Subscription form'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table("web_form_categories")->where('id',7)->update(array('category'=>'Contact Form with adrress'));
        DB::table("web_form_categories")->where('id',1)->update(array('category'=>'Subscription form'));
    }
}
;
