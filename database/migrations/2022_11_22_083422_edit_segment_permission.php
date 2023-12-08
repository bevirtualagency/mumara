<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        $iseExist = DB::table('permissions')->where('id', 499)->count();
        if ($iseExist == 0) {
            DB::table('permissions')->insert([
                'id' => 499,
                'parent_id' => 18,
                'default_title' => "Edit a segment ",
                'title' => "Edit a segment",
                'is_available' => 1,
                'sequence' => 2,
                'route_type' => "web",
                'route' => "segment.edit",
                'skip_in_acl' => 0,
                'hidden_in_acl' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'access_level' => "all",
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::table('permissions')->where("id", 499)->delete();
    }

}
;
