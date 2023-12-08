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
        if (!Schema::hasTable('stats_pending')) {
            Schema::create('stats_pending', function (Blueprint $table) {
                $table->increments('id');
                $table->string('type', 10)->nullable();
                $table->boolean('status')->default(false)->comment('0 pending, 1 complete, 2 processing');
                $table->integer('number_rand')->nullable();
                $table->integer('log_id')->nullable();
                $table->integer('job_id')->nullable();
                $table->integer('subscriber_id')->nullable();
                $table->string('email', 100)->nullable();
                $table->string('bounce_type', 100)->nullable();
                $table->string('code', 100)->nullable();
                $table->text('reason')->nullable();
                $table->text('detail')->nullable();
                $table->string('source_ip', 20)->nullable();
                $table->string('destination_ip', 20)->nullable();
                $table->string('vmta', 100)->nullable();
                $table->string('message_id', 255)->nullable();
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else {
            if (!Schema::hasColumn('stats_pending', 'id')) {
                Schema::table('stats_pending', function (Blueprint $table) {
                    $table->increments('id');
                });
            }
             if (!Schema::hasColumn('stats_pending', 'type')) {
                Schema::table('stats_pending', function (Blueprint $table) {
                    $table->string('type', 10)->nullable();
                });
            }
             if (!Schema::hasColumn('stats_pending', 'status')) {
                Schema::table('stats_pending', function (Blueprint $table) {
                    $table->boolean('status')->default(false)->comment('0 pending, 1 complete, 2 processing');
                });
            }
             if (!Schema::hasColumn('stats_pending', 'number_rand')) {
                Schema::table('stats_pending', function (Blueprint $table) {
                    $table->integer('number_rand')->nullable();
                });
            }
             if (!Schema::hasColumn('stats_pending', 'log_id')) {
                Schema::table('stats_pending', function (Blueprint $table) {
                    $table->integer('log_id')->nullable();
                });
            }
             if (!Schema::hasColumn('stats_pending', 'job_id')) {
                Schema::table('stats_pending', function (Blueprint $table) {
                    $table->integer('job_id')->nullable();
                });
            }
             if (!Schema::hasColumn('stats_pending', 'subscriber_id')) {
                Schema::table('stats_pending', function (Blueprint $table) {
                    $table->integer('subscriber_id')->nullable();
                });
            }
             if (!Schema::hasColumn('stats_pending', 'email')) {
                Schema::table('stats_pending', function (Blueprint $table) {
                    $table->string('email', 100)->nullable();
                });
            }
             if (!Schema::hasColumn('stats_pending', 'bounce_type')) {
                Schema::table('stats_pending', function (Blueprint $table) {
                    $table->string('bounce_type', 100)->nullable();
                });
            }
             if (!Schema::hasColumn('stats_pending', 'code')) {
                Schema::table('stats_pending', function (Blueprint $table) {
                    $table->string('code', 100)->nullable();
                });
            }
             if (!Schema::hasColumn('stats_pending', 'reason')) {
                Schema::table('stats_pending', function (Blueprint $table) {
                    $table->text('reason')->nullable();
                });
            }
             if (!Schema::hasColumn('stats_pending', 'detail')) {
                Schema::table('stats_pending', function (Blueprint $table) {
                    $table->text('detail')->nullable();
                });
            }
             if (!Schema::hasColumn('stats_pending', 'source_ip')) {
                Schema::table('stats_pending', function (Blueprint $table) {
                    $table->string('source_ip', 20)->nullable();
                });
            }
             if (!Schema::hasColumn('stats_pending', 'destination_ip')) {
                Schema::table('stats_pending', function (Blueprint $table) {
                    $table->string('destination_ip', 20)->nullable();
                });
            }
             if (!Schema::hasColumn('stats_pending', 'vmta')) {
                Schema::table('stats_pending', function (Blueprint $table) {
                    $table->string('vmta', 100)->nullable();
                });
            }
             if (!Schema::hasColumn('stats_pending', 'message_id')) {
                Schema::table('stats_pending', function (Blueprint $table) {
                    $table->string('message_id', 255)->nullable();
                });
            }
             if (!Schema::hasColumn('stats_pending', 'created_at')) {
                Schema::table('stats_pending', function (Blueprint $table) {
               $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('stats_pending', 'updated_at')) {
                Schema::table('stats_pending', function (Blueprint $table) {
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
        Schema::dropIfExists('stats_pending');
    }

}
;
