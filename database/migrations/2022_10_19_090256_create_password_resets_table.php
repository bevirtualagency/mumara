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
        if (!Schema::hasTable('password_resets')) {
            Schema::create('password_resets', function (Blueprint $table) {
                $table->string('email', 191)->index();
                $table->string('token', 191)->index();
                $table->boolean('status');
                $table->timestamp('created_at')->nullable()->useCurrent();
            });
        }
        else {
            if (!Schema::hasColumn('password_resets', 'email')) {
                Schema::table('password_resets', function (Blueprint $table) {
                    $table->string('email', 191)->index();
                });
            }
            if (!Schema::hasColumn('password_resets', 'token')) {
                Schema::table('password_resets', function (Blueprint $table) {
                    $table->string('token', 191)->index();
                });
            }
            if (!Schema::hasColumn('password_resets', 'status')) {
                Schema::table('password_resets', function (Blueprint $table) {
                    $table->boolean('status');
                });
            }
            if (!Schema::hasColumn('password_resets', 'created_at')) {
                Schema::table('password_resets', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
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
        Schema::dropIfExists('password_resets');
    }

}
;
