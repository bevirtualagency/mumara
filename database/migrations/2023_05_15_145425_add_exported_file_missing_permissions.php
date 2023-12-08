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
        $parent = \App\Permission::where('route','exported.files')->first();
        if(!is_null($parent))
        {
            addChildPermission('Download Exported Files','1','web','0','0','all',1,'suppression.export.download.csv',$parent->id);
            $parent->update(['default_title'=>'Exported Files','title'=>'Exported Files']);
            $per = \App\Permission::where('route','delete.exported.file')->first();
            if(!is_null($per))
                $per->update(['parent_id'=>$parent->id,'access_level'=>'all','is_available'=>1,'skip_in_acl'=>0,'hidden_in_acl'=>0]);
            else
            addChildPermission('Delete Exported File','1','web','0','0','all',1,'delete.exported.file',$parent->id);
            addChildPermission('Delete All Exported Files','1','web','0','0','all',1,'delete.exported.all.file',$parent->id);
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
};
