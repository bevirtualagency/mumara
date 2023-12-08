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
        // addChildPermission('Evergreen statistics','1','web','0','0','all',30,'statistics.evergreen.index',11);
        // addChildPermission('Add Evergreen Campaign','1','web','0','0','all',1,'campaign.evergreen.create',278);
        // addChildPermission('Edit Evergreen Campaigns','1','web','0','0','all',2,'edit.evergreen',278);
        // addChildPermission('Delete Evergreen Campaigns','1','web','0','0','all',3,'delete.evergreen',278);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
;
