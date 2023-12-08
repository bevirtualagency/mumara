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
        if (!Schema::hasColumn('permissions', 'permission')) {
            Schema::table('permissions', function (Blueprint $table) {
                $table->string('permission', 255)->after("access_level")->nullable()->default(null);
            });
        }
        \App\Permission::where('id',277)->update(['permission'=>'drag_and_drop_builder']);

        \App\Permission::where('id',63)->update(['route'=>'exportSegment']);
        \App\Permission::where('id',95)->update(['route'=>'campaignReschedule']);
        \App\Permission::where('id',64)->update(['route'=>'copySegmentToList']);
        \App\Permission::where('id',65)->update(['route'=>'moveSegmentToList']);
        \App\Permission::where('id',381)->update(['route'=>'getContactDetail']);
        \App\Permission::where('id',405)->update(['route'=>'getBroadcastLogs']);

        \App\Permission::where('id',391)->update(['permission'=>'smtp']);
        \App\Permission::where('id',392)->update(['permission'=>'sendgrid']);
        \App\Permission::where('id',393)->update(['permission'=>'mailgun']);
        \App\Permission::where('id',394)->update(['permission'=>'amazon']);
        \App\Permission::where('id',395)->update(['permission'=>'sparkpost']);
        \App\Permission::where('id',396)->update(['permission'=>'elasticEmail']);
        \App\Permission::where('id',397)->update(['permission'=>'mailjet']);
        \App\Permission::where('id',398)->update(['permission'=>'smtp2go']);
        \App\Permission::where('id',399)->update(['permission'=>'postMark']);
        \App\Permission::where('id',400)->update(['permission'=>'gmail']);
        \App\Permission::where('id',401)->update(['permission'=>'outlook']);
        \App\Permission::where('id',402)->update(['permission'=>'yahoo']);
        \App\Permission::where('id',403)->update(['permission'=>'aol']);
        \App\Permission::where('id',481)->update(['permission'=>'MumaraOne']);

        \App\Permission::where('id',412)->update(['permission'=>'export_trigger_stats']);
        \App\Permission::where('id',430)->update(['permission'=>'export_drip_stats']);
        \App\Permission::where('id',407)->update(['permission'=>'export_broadcast_stats']);

        \App\Permission::where('id',423)->update(['permission'=>'get_trigger_bounce_stats']);
        \App\Permission::where('id',424)->update(['permission'=>'get_trigger_open_stats']);
        \App\Permission::where('id',425)->update(['permission'=>'get_trigger_click_stats']);
        \App\Permission::where('id',426)->update(['permission'=>'get_trigger_unsub_stats']);
        \App\Permission::where('id',427)->update(['permission'=>'get_trigger_spam_stats']);
        \App\Permission::where('id',428)->update(['permission'=>'get_trigger_log_stats']);
        \App\Permission::where('id',429)->update(['permission'=>'get_trigger_ab_stats']);

        \App\Permission::where('id',431)->update(['permission'=>'start_drip_campaigns']);
        \App\Permission::where('id',432)->update(['permission'=>'schedule_broadcast_to_segment']);
        \App\Permission::where('id',433)->update(['permission'=>'schedule_split_test']);
        \App\Permission::where('id',243)->orWhere('parent_id',243)->delete();

        \App\Permission::where('id',409)->update(['permission'=>'get_broadcast_open_stats']);
        \App\Permission::where('id',410)->update(['permission'=>'get_broadcast_click_stats']);
        \App\Permission::where('id',411)->update(['permission'=>'get_broadcast_unsub_stats']);
        \App\Permission::where('id',417)->update(['permission'=>'get_broadcast_spam_stats']);
        \App\Permission::where('id',418)->update(['permission'=>'get_broadcast_log_stats']);
        \App\Permission::where('id',420)->update(['permission'=>'get_broadcast_bounce_stats']);
        \App\Permission::where('id',434)->update(['permission'=>'get_broadcast_detail_stats']);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('permissions', 'permission')) {
            Schema::table('permissions', function (Blueprint $table) {
                $table->dropColumn('permissions');;
            });
        }
    }
};