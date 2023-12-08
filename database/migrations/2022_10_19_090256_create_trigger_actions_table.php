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
        if (!Schema::hasTable('trigger_actions')) {
            Schema::create('trigger_actions', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('trigger_id')->nullable();
                $table->integer('action_count')->nullable()->default(0);
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else {
            if (!Schema::hasColumn('trigger_actions', 'id')) {
                Schema::table('trigger_actions', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('trigger_actions', 'trigger_id')) {
                Schema::table('trigger_actions', function (Blueprint $table) {
                    $table->integer('trigger_id')->nullable();
                });
            }
            if (!Schema::hasColumn('trigger_actions', 'action_count')) {
                Schema::table('trigger_actions', function (Blueprint $table) {
                    $table->integer('action_count')->nullable()->default(0);
                });
            }
            if (!Schema::hasColumn('trigger_actions', 'created_at')) {
                Schema::table('trigger_actions', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('trigger_actions', 'updated_at')) {
                Schema::table('trigger_actions', function (Blueprint $table) {
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
        Schema::dropIfExists('trigger_actions');
    }

}
;
