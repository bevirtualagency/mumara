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
        if (!Schema::hasTable('fbl_emails')) {
            Schema::create('fbl_emails', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('campaing_schedule_logs_id')->unique('campaing_schedule_logs_id_2');
                $table->string('email', 100)->nullable();
                $table->mediumText('detail')->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else {
            if (!Schema::hasColumn('fbl_emails', 'id')) {
                Schema::table('fbl_emails', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('fbl_emails', 'campaing_schedule_logs_id')) {
                Schema::table('fbl_emails', function (Blueprint $table) {
                    $table->integer('campaing_schedule_logs_id')->unique('campaing_schedule_logs_id_2');
                });
            }
            if (!Schema::hasColumn('fbl_emails', 'email')) {
                Schema::table('fbl_emails', function (Blueprint $table) {
                    $table->string('email', 100)->nullable();
                });
            }
            if (!Schema::hasColumn('fbl_emails', 'detail')) {
                Schema::table('fbl_emails', function (Blueprint $table) {
                    $table->mediumText('detail')->nullable();
                });
            }
            if (!Schema::hasColumn('fbl_emails', 'created_at')) {
                Schema::table('fbl_emails', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('fbl_emails', 'updated_at')) {
                Schema::table('fbl_emails', function (Blueprint $table) {
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
        Schema::dropIfExists('fbl_emails');
    }

}
;
