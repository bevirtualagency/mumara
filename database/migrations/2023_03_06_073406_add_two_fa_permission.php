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
        addChildPermission('Two-Factor Authentication',1,'web',0,0,'all',1000,'enable2fa',1);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \App\Permission::where('route','enable2fa')->where('route_type','web')->delete();
    }
}
;
