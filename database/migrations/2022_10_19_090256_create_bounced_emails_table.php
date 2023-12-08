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
        if (!Schema::hasTable('bounced_emails')) {
            Schema::create('bounced_emails', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('campaing_schedule_logs_id')->unique('campaing_schedule_logs_id_2');
                $table->string('email', 100)->nullable();
                $table->enum('type', ['soft', 'hard', 'no_process'])->nullable();
                $table->string('category', 255)->nullable();
                $table->string('code', 50)->nullable();
                $table->string('reason', 255)->nullable();
                $table->text('detail')->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else
        {
            if (!Schema::hasColumn('bounced_emails', 'id')) {
                Schema::table('bounced_emails', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
             if (!Schema::hasColumn('bounced_emails', 'campaing_schedule_logs_id')) {
                Schema::table('bounced_emails', function (Blueprint $table) {
                    $table->integer('campaing_schedule_logs_id')->unique('campaing_schedule_logs_id_2');
                });
            }
             if (!Schema::hasColumn('bounced_emails', 'email')) {
                Schema::table('bounced_emails', function (Blueprint $table) {
                    $table->string('email', 100)->nullable();
                });
            }
             if (!Schema::hasColumn('bounced_emails', 'type')) {
                Schema::table('bounced_emails', function (Blueprint $table) {
                    $table->enum('type', ['soft', 'hard', 'no_process'])->nullable();
                });
            }
             if (!Schema::hasColumn('bounced_emails', 'category')) {
                Schema::table('bounced_emails', function (Blueprint $table) {
                    $table->string('category', 255)->nullable();
                });
            }
             if (!Schema::hasColumn('bounced_emails', 'code')) {
                Schema::table('bounced_emails', function (Blueprint $table) {
                    $table->string('code', 50)->nullable();
                });
            }
             if (!Schema::hasColumn('bounced_emails', 'reason')) {
                Schema::table('bounced_emails', function (Blueprint $table) {
                    $table->string('reason', 255)->nullable();
                });
            }
             if (!Schema::hasColumn('bounced_emails', 'detail')) {
                Schema::table('bounced_emails', function (Blueprint $table) {
                    $table->text('detail')->nullable();
                });
            }
             if (!Schema::hasColumn('bounced_emails', 'created_at')) {
                Schema::table('bounced_emails', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
             if (!Schema::hasColumn('bounced_emails', 'updated_at')) {
                Schema::table('bounced_emails', function (Blueprint $table) {
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
        Schema::dropIfExists('bounced_emails');
    }

}
;
