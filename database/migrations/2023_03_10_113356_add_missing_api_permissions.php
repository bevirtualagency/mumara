<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingApiPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       $list_parent = \App\Permission::where('default_title','List Management')->where('route_type','api')->first();
       if(!is_null($list_parent)) {
           if(!\App\Permission::where('route_type','api')->where('route','getListGroups')->exists())
           addChildPermission('Get List Groups', '1', 'api', '0', '0', 'all', '7', 'getListGroups', $list_parent->id);
       }
        $broadcast_parent = \App\Permission::where('default_title','Broadcast Management')->where('route_type','api')->first();
        if(!is_null($broadcast_parent)) {
            if(!\App\Permission::where('route_type','api')->where('route','getBroadcastGroups')->exists())
            addChildPermission('Get Broadcast Groups', '1', 'api', '0', '0', 'all', '6', 'getBroadcastGroups', $broadcast_parent->id);
            if(!\App\Permission::where('route_type','api')->where('route','getScheduledBroadcasts')->exists())
            addChildPermission('Get Scheduled Broadcasts', '1', 'api', '0', '0', 'all', '7', 'getScheduledBroadcasts', $broadcast_parent->id);
        }//
        $broadcast_statistics_parent = \App\Permission::where('default_title','Boradcast Statisctics')->orWhere('title','Boradcast Statisctics')->where('route_type','api')->first();
        if(!is_null($broadcast_statistics_parent))
            $broadcast_statistics_parent = \App\Permission::where('default_title', 'Broadcast Statistics')->where('route_type', 'api')->first();
        else
            \App\Permission::where('default_title','Boradcast Statisctics')->orWhere('title','Boradcast Statisctics')->where('route_type','api')->update(['default_title' => 'Broadcast Statistics','title'=>'Broadcast Statistics']);
        if(!is_null($broadcast_statistics_parent))
            $broadcast_statistics_parent = addParentPermission('Broadcast Statistics','1','api','0','0','all','12',0);
        if(!is_null($broadcast_statistics_parent)) {
            if(!\App\Permission::where('route_type','api')->where('route','getLogsByIds')->exists())
            addChildPermission('Get Logs By ID(s)', '1', 'api', '0', '0', 'all', '9', 'getLogsByIds', $broadcast_statistics_parent->id);
        }
        $sending_domain_parent = \App\Permission::where('default_title','Sending Domain')->where('route_type','api')->first();
        if(!is_null($sending_domain_parent)) {
            if(!\App\Permission::where('route_type','api')->where('route','getSendingDomains')->exists())
            addChildPermission('Get Sending Domains', '1', 'api', '0', '0', 'all', '2', 'getSendingDomains', $sending_domain_parent->id);
        }
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
