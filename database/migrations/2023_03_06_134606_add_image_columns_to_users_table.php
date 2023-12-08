<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     if (!Schema::hasColumn('users', 'profile_img')) {
                Schema::table('users', function (Blueprint $table) {
                   $table->string('profile_img')->nullable();
                });
            }
            if (!Schema::hasColumn('users', 'profile_img_store')) {
                Schema::table('users', function (Blueprint $table) {
                   $table->string('profile_img_store')->nullable();
                });
            }

}
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {  
    if (Schema::hasColumn('users', 'profile_img')) {
            Schema::table('users', function (Blueprint $table) {
             $table->dropColumn('profile_img');   
            });
        }
    if (Schema::hasColumn('users', 'profile_img_store')) {
            Schema::table('users', function (Blueprint $table) {
             $table->dropColumn('profile_img_store');   
            });
        }
    }
}
