<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('evergreen_campaigns')) {
            Schema::create('evergreen_campaigns', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('name', 255)->nullable();
                $table->text('criteria')->nullable();
                $table->enum('status', ['active','inactive'])->nullable();
                $table->integer('user_id')->nullable();
                $table->integer('runs')->nullable();
                $table->dateTime('created_at')->index()->nullable();
                $table->dateTime('updated_at')->nullable();
                $table->dateTime('last_run')->nullable();
            });
        }
        else {
            if (!Schema::hasColumn('evergreen_campaigns', 'id')) {
                Schema::table('evergreen_campaigns', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }

            if (!Schema::hasColumn('evergreen_campaigns', 'name')) {
                Schema::table('evergreen_campaigns', function (Blueprint $table) {
                    $table->string('name', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('evergreen_campaigns', 'criteria')) {
                Schema::table('evergreen_campaigns', function (Blueprint $table) {
                    $table->text('criteria')->nullable();
                });
            }
            if (!Schema::hasColumn('evergreen_campaigns', 'status')) {
                Schema::table('evergreen_campaigns', function (Blueprint $table) {
                    $table->enum('status', ['active','inactive'])->nullable();
                });
            }
            if (!Schema::hasColumn('evergreen_campaigns', 'user_id')) {
                Schema::table('evergreen_campaigns', function (Blueprint $table) {
                    $table->integer('user_id')->nullable();
                });
            }
            if (!Schema::hasColumn('evergreen_campaigns', 'runs')) {
                Schema::table('evergreen_campaigns', function (Blueprint $table) {
                    $table->integer('runs')->nullable();
                });
            }
            if (!Schema::hasColumn('evergreen_campaigns', 'created_at')) {
                Schema::table('evergreen_campaigns', function (Blueprint $table) {
                    $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('evergreen_campaigns', 'updated_at')) {
                Schema::table('evergreen_campaigns', function (Blueprint $table) {
                    $table->timestamp('updated_at')->useCurrentOnUpdate();
                });
            }
             if (!Schema::hasColumn('evergreen_campaigns', 'last_run')) {
                Schema::table('evergreen_campaigns', function (Blueprint $table) {
                    $table->dateTime('last_run')->nullable();
                });
            }

        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evergreen_campaigns');
    }
}
;
