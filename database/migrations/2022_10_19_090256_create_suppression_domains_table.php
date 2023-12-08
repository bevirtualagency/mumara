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
        if (!Schema::hasTable('suppression_domains')) {
            Schema::create('suppression_domains', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('reference', 255)->nullable();
                $table->string('domain', 100)->nullable();
                $table->integer('list_id')->nullable();
                $table->integer('import_id')->nullable();
                $table->boolean('is_suppressed')->default(false);
                $table->integer('user_id');
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();

                $table->index(['domain', 'list_id', 'import_id', 'user_id'], 'domain');
            });
        }
        else {
            if (!Schema::hasColumn('suppression_domains', 'id')) {
                Schema::table('suppression_domains', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('suppression_domains', 'reference')) {
                Schema::table('suppression_domains', function (Blueprint $table) {
                    $table->string('reference', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('suppression_domains', 'domain')) {
                Schema::table('suppression_domains', function (Blueprint $table) {
                    $table->string('domain', 100)->nullable();
                });
            }
            if (!Schema::hasColumn('suppression_domains', 'list_id')) {
                Schema::table('suppression_domains', function (Blueprint $table) {
                    $table->integer('list_id')->nullable();
                });
            }
            if (!Schema::hasColumn('suppression_domains', 'import_id')) {
                Schema::table('suppression_domains', function (Blueprint $table) {
                    $table->integer('import_id')->nullable();
                });
            }
            if (!Schema::hasColumn('suppression_domains', 'is_suppressed')) {
                Schema::table('suppression_domains', function (Blueprint $table) {
                    $table->boolean('is_suppressed')->default(false);
                });
            }
            if (!Schema::hasColumn('suppression_domains', 'user_id')) {
                Schema::table('suppression_domains', function (Blueprint $table) {
                    $table->integer('user_id');
                });
            }
            if (!Schema::hasColumn('suppression_domains', 'created_at')) {
                Schema::table('suppression_domains', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('suppression_domains', 'updated_at')) {
                Schema::table('suppression_domains', function (Blueprint $table) {
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
        Schema::dropIfExists('suppression_domains');
    }

}
;
