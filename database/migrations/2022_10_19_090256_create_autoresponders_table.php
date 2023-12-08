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
        if (!Schema::hasTable('autoresponders')) {
            Schema::create('autoresponders', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('name', 255)->nullable()->charset("utf8mb4")->collation("utf8mb4_general_ci");
                $table->integer('autoresponder_group_id')->nullable();
                $table->integer('order_no')->nullable()->default(0);
                $table->string('perform_action_datetime_frequency', 50)->nullable()->charset("utf8mb4")->collation("utf8mb4_general_ci");
                $table->integer('perform_action_datetime_count')->nullable()->default(0);
                $table->string('email_subject', 255)->nullable()->charset("utf8mb4")->collation("utf8mb4_general_ci");
                $table->boolean('is_active')->default(true);
                $table->boolean('send_to_existing')->default(false);
                $table->longText('meta_attributes')->nullable()->charset("utf8mb4")->collation("utf8mb4_general_ci");
                $table->integer('user_id')->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
                $table->dateTime('run_at')->nullable();
                $table->dateTime('last_activity_at')->nullable();
                $table->dateTime('added_interval_date')->nullable();
            });
        }
        else
        {
             if (!Schema::hasColumn('autoresponders', 'id')) {
                Schema::table('autoresponders', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('autoresponders', 'name')) {
                Schema::table('autoresponders', function (Blueprint $table) {
                    $table->string('name', 255)->nullable()->charset("utf8mb4")->collation("utf8mb4_general_ci");
                });
            }
            if (!Schema::hasColumn('autoresponders', 'autoresponder_group_id')) {
                Schema::table('autoresponders', function (Blueprint $table) {
                    $table->integer('autoresponder_group_id')->nullable();
                });
            }
            if (!Schema::hasColumn('autoresponders', 'order_no')) {
                Schema::table('autoresponders', function (Blueprint $table) {
                    $table->integer('order_no')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('autoresponders', 'perform_action_datetime_frequency')) {
                Schema::table('autoresponders', function (Blueprint $table) {
                    $table->string('perform_action_datetime_frequency', 50)->nullable()->charset("utf8mb4")->collation("utf8mb4_general_ci");
                });
            }
            if (!Schema::hasColumn('autoresponders', 'perform_action_datetime_count')) {
                Schema::table('autoresponders', function (Blueprint $table) {
                    $table->integer('perform_action_datetime_count')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('autoresponders', 'email_subject')) {
                Schema::table('autoresponders', function (Blueprint $table) {
                    $table->string('email_subject', 255)->nullable()->charset("utf8mb4")->collation("utf8mb4_general_ci");
                });
            }
            if (!Schema::hasColumn('autoresponders', 'is_active')) {
                Schema::table('autoresponders', function (Blueprint $table) {
                    $table->boolean('is_active')->default(true);
                });
            }
            if (!Schema::hasColumn('autoresponders', 'send_to_existing')) {
                Schema::table('autoresponders', function (Blueprint $table) {
                    $table->boolean('send_to_existing')->default(false);
                });
            }
            if (!Schema::hasColumn('autoresponders', 'meta_attributes')) {
                Schema::table('autoresponders', function (Blueprint $table) {
                    $table->longText('meta_attributes')->nullable()->charset("utf8mb4")->collation("utf8mb4_general_ci");
                });
            }
            if (!Schema::hasColumn('autoresponders', 'user_id')) {
                Schema::table('autoresponders', function (Blueprint $table) {
                    $table->integer('user_id')->nullable();
                });
            }
            if (!Schema::hasColumn('autoresponders', 'created_at')) {
                Schema::table('autoresponders', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('autoresponders', 'updated_at')) {
                Schema::table('autoresponders', function (Blueprint $table) {
                   $table->timestamp('updated_at')->useCurrentOnUpdate();
                });
            }
            if (!Schema::hasColumn('autoresponders', 'run_at')) {
                Schema::table('autoresponders', function (Blueprint $table) {
                    $table->dateTime('run_at')->nullable();
                });
            }
            if (!Schema::hasColumn('autoresponders', 'last_activity_at')) {
                Schema::table('autoresponders', function (Blueprint $table) {
                    $table->dateTime('last_activity_at')->nullable();
                });
            }
            if (!Schema::hasColumn('autoresponders', 'added_interval_date')) {
                Schema::table('autoresponders', function (Blueprint $table) {
                    $table->dateTime('added_interval_date')->nullable();
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
        Schema::dropIfExists('autoresponders');
    }

}
;
