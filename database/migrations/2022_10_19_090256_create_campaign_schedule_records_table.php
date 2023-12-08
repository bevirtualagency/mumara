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
        if (!Schema::hasTable('campaign_schedule_records')) {
            Schema::create('campaign_schedule_records', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('campaign_schedule_id')->nullable()->index('campaign_schedule_id');
                $table->integer('email_id')->nullable();
                $table->string('email', 100)->nullable();
                $table->integer('batch_no')->nullable()->default(1)->index('batch_no');
            });
        }
        else {
               if (!Schema::hasColumn('campaign_schedule_records', 'id')) {
                Schema::table('campaign_schedule_records', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('campaign_schedule_records', 'campaign_schedule_id')) {
                Schema::table('campaign_schedule_records', function (Blueprint $table) {
                    $table->integer('campaign_schedule_id')->nullable()->index('campaign_schedule_id');
                });
            }
            if (!Schema::hasColumn('campaign_schedule_records', 'email_id')) {
                Schema::table('campaign_schedule_records', function (Blueprint $table) {
                    $table->integer('email_id')->nullable();
                });
            }
            if (!Schema::hasColumn('campaign_schedule_records', 'email')) {
                Schema::table('campaign_schedule_records', function (Blueprint $table) {
                    $table->string('email', 100)->nullable();
                });
            }
            if (!Schema::hasColumn('campaign_schedule_records', 'batch_no')) {
                Schema::table('campaign_schedule_records', function (Blueprint $table) {
                    $table->integer('batch_no')->nullable()->default(1)->index('batch_no');
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
        Schema::dropIfExists('campaign_schedule_records');
    }

}
;
