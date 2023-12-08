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
        if (!Schema::hasTable('two_fa')) {
            Schema::create('two_fa', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('user_id');
                $table->boolean('google2fa_enable')->default(false);
                $table->string('google2fa_secret')->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else {
            if (!Schema::hasColumn('two_fa', 'id')) {
                Schema::table('two_fa', function (Blueprint $table) {
                    $table->increments('id');
                });
            }
            if (!Schema::hasColumn('two_fa', 'user_id')) {
                Schema::table('two_fa', function (Blueprint $table) {
                    $table->unsignedInteger('user_id');
                });
            }
            if (!Schema::hasColumn('two_fa', 'google2fa_enable')) {
                Schema::table('two_fa', function (Blueprint $table) {
                    $table->boolean('google2fa_enable')->default(false);
                });
            }
            if (!Schema::hasColumn('two_fa', 'google2fa_secret')) {
                Schema::table('two_fa', function (Blueprint $table) {
                    $table->string('google2fa_secret')->nullable();
                });
            }
            if (!Schema::hasColumn('two_fa', 'created_at')) {
                Schema::table('two_fa', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('two_fa', 'updated_at')) {
                Schema::table('two_fa', function (Blueprint $table) {
                   $table->timestamp('updated_at')->useCurrentOnUpdate();
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('two_fa');
    }

}
;
