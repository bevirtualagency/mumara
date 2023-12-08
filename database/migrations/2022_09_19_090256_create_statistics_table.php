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
        if (!Schema::hasTable('statistics')) {
            Schema::create('statistics', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('campaign_schedule_id')->nullable()->index('campaign_schedule_id');
                $table->integer('user_id')->nullable();
                $table->string('user_name', 255)->nullable();
                $table->string('campaing_schedule_label', 255)->nullable();
                $table->text('campaing_label')->nullable();
                $table->text('list_sgement_name')->nullable();
                $table->dateTime('schedule_datetime')->nullable();
                $table->integer('total_scheduled')->nullable();
                $table->integer('total_unsubscribed')->nullable()->default(0);
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }

        else{
            if (!Schema::hasColumn('statistics', 'id')) {
                Schema::table('statistics', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('statistics', 'campaign_schedule_id')) {
                Schema::table('statistics', function (Blueprint $table) {
                    $table->integer('campaign_schedule_id')->nullable()->index('campaign_schedule_id');
                });
            }
            if (!Schema::hasColumn('statistics', 'user_id')) {
                Schema::table('statistics', function (Blueprint $table) {
                    $table->integer('user_id')->nullable();
                });
            }
            if (!Schema::hasColumn('statistics', 'user_name')) {
                Schema::table('statistics', function (Blueprint $table) {
                    $table->string('user_name', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('statistics', 'campaing_schedule_label')) {
                Schema::table('statistics', function (Blueprint $table) {
                    $table->string('campaing_schedule_label', 255)->nullable();
                });
            }
             if (!Schema::hasColumn('statistics', 'campaing_label')) {
                Schema::table('statistics', function (Blueprint $table) {
                    $table->text('campaing_label')->nullable();
                });
            }
             if (!Schema::hasColumn('statistics', 'list_sgement_name')) {
                Schema::table('statistics', function (Blueprint $table) {
                    $table->text('list_sgement_name')->nullable();
                });
            }
             if (!Schema::hasColumn('statistics', 'schedule_datetime')) {
                Schema::table('statistics', function (Blueprint $table) {
                    $table->dateTime('schedule_datetime')->nullable();
                });
            }
             if (!Schema::hasColumn('statistics', 'total_scheduled')) {
                Schema::table('statistics', function (Blueprint $table) {
                    $table->integer('total_scheduled')->nullable();
                });
            }
             if (!Schema::hasColumn('statistics', 'total_unsubscribed')) {
                Schema::table('statistics', function (Blueprint $table) {
                    $table->integer('total_unsubscribed')->nullable()->default(0);
                });
            }
             if (!Schema::hasColumn('statistics', 'created_at')) {
                Schema::table('statistics', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
               if (!Schema::hasColumn('statistics', 'updated_at')) {
                Schema::table('statistics', function (Blueprint $table) {
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
        Schema::dropIfExists('statistics');
    }

}
;
