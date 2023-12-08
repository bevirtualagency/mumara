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
        if (!Schema::hasTable('jobs')) {
            Schema::create('jobs', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('queue', 191)->index();
                $table->longText('payload');
                $table->unsignedTinyInteger('attempts');
                $table->unsignedInteger('reserved_at')->nullable();
                $table->unsignedInteger('available_at');
                $table->unsignedInteger('created_at');
            });
        }
        else{
            if (!Schema::hasColumn('jobs', 'id')) {
                Schema::table('jobs', function (Blueprint $table) {
                    $table->bigIncrements('id');
                });
            }
            if (!Schema::hasColumn('jobs', 'queue')) {
                Schema::table('jobs', function (Blueprint $table) {
                    $table->string('queue', 191)->index();
                });
            }
            if (!Schema::hasColumn('jobs', 'payload')) {
                Schema::table('jobs', function (Blueprint $table) {
                    $table->longText('payload');
                });
            }
            if (!Schema::hasColumn('jobs', 'attempts')) {
                Schema::table('jobs', function (Blueprint $table) {
                    $table->unsignedTinyInteger('attempts');
                });
            }
            if (!Schema::hasColumn('jobs', 'reserved_at')) {
                Schema::table('jobs', function (Blueprint $table) {
                    $table->unsignedInteger('reserved_at')->nullable();
                });
            }
            if (!Schema::hasColumn('jobs', 'available_at')) {
                Schema::table('jobs', function (Blueprint $table) {
                    $table->unsignedInteger('available_at');
                });
            }
            if (!Schema::hasColumn('jobs', 'created_at')) {
                Schema::table('jobs', function (Blueprint $table) {
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
        Schema::dropIfExists('jobs');
    }

}
;
