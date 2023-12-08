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
        if (!Schema::hasTable('failed_jobs')) {
            Schema::create('failed_jobs', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->text('connection');
                $table->text('queue');
                $table->longText('payload');
                $table->longText('exception');
                $table->timestamp('failed_at')->useCurrent();
            });
        }
        else {
            if (!Schema::hasColumn('failed_jobs', 'id')) {
                Schema::table('failed_jobs', function (Blueprint $table) {
                    $table->bigIncrements('id');
                });
            }
            if (!Schema::hasColumn('failed_jobs', 'connection')) {
                Schema::table('failed_jobs', function (Blueprint $table) {
                    $table->text('connection');
                });
            }
            if (!Schema::hasColumn('failed_jobs', 'queue')) {
                Schema::table('failed_jobs', function (Blueprint $table) {
                    $table->text('queue');
                });
            }
            if (!Schema::hasColumn('failed_jobs', 'payload')) {
                Schema::table('failed_jobs', function (Blueprint $table) {
                    $table->longText('payload');
                });
            }
            if (!Schema::hasColumn('failed_jobs', 'exception')) {
                Schema::table('failed_jobs', function (Blueprint $table) {
                    $table->longText('exception');
                });
            }
            if (!Schema::hasColumn('failed_jobs', 'failed_at')) {
                Schema::table('failed_jobs', function (Blueprint $table) {
                    $table->timestamp('failed_at')->useCurrent();
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
        Schema::dropIfExists('failed_jobs');
    }

}
;
