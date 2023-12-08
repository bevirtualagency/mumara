<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        if (!Schema::hasTable('suppression_references')) {
            Schema::create('suppression_references', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('type')->nullable();
                $table->boolean('is_running')->nullable();
                $table->integer('contact_id')->nullable();
                $table->integer('suppression_email_id')->nullable();
                $table->integer('suppression_domain_id')->nullable();
                $table->integer('supervisor_id')->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
            if (DB::table('suppression_references')->where('id', 1)->count() == 0) {
                DB::table('suppression_references')->insert(array(
                    'id' => 1,
                    'type' => 1,
                    'is_running' => 0,
                    'contact_id' => 0,
                    'suppression_email_id' => 0,
                    'suppression_domain_id' => 0,
                    'supervisor_id' => 0,
                    'created_at' => date('Y-m-d H:i:d'),
                    'updated_at' => date('Y-m-d H:i:d'),
                ));
            }
        } else {
            if (!Schema::hasColumn('suppression_references', 'id')) {
                Schema::table('suppression_references', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('suppression_references', 'type')) {
                Schema::table('suppression_references', function (Blueprint $table) {
                    $table->integer('type')->nullable();
                });
            }
            if (!Schema::hasColumn('suppression_references', 'is_running')) {
                Schema::table('suppression_references', function (Blueprint $table) {
                    $table->boolean('is_running')->nullable();
                });
            }
            if (!Schema::hasColumn('suppression_references', 'contact_id')) {
                Schema::table('suppression_references', function (Blueprint $table) {
                    $table->integer('contact_id')->nullable();
                });
            }
            if (!Schema::hasColumn('suppression_references', 'suppression_email_id')) {
                Schema::table('suppression_references', function (Blueprint $table) {
                    $table->integer('suppression_email_id')->nullable();
                });
            }
            if (!Schema::hasColumn('suppression_references', 'suppression_domain_id')) {
                Schema::table('suppression_references', function (Blueprint $table) {
                    $table->integer('suppression_domain_id')->nullable();
                });
            }
            if (!Schema::hasColumn('suppression_references', 'supervisor_id')) {
                Schema::table('suppression_references', function (Blueprint $table) {
                    $table->integer('supervisor_id')->nullable();
                });
            }
            if (!Schema::hasColumn('suppression_references', 'created_at')) {
                Schema::table('suppression_references', function (Blueprint $table) {
                    $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('suppression_references', 'updated_at')) {
                Schema::table('suppression_references', function (Blueprint $table) {
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
        Schema::dropIfExists('suppression_references');
    }

}
;
