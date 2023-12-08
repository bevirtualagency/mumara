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
        if (!Schema::hasTable('split_tests')) {
            Schema::create('split_tests', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('name', 255)->nullable();
                $table->enum('test_on', ['lists', 'campaigns'])->nullable()->default('campaigns');
                $table->string('campaign_list_ids', 255)->nullable();
                $table->enum('winner_type', ['opened', 'clicked', 'link'])->nullable();
                $table->integer('link_id')->nullable();
                $table->enum('test_type', ['show', 'send'])->nullable();
                $table->mediumText('test_type_attributes')->nullable();
                $table->dateTime('winner_campaign_list_send_datetime')->nullable();
                $table->integer('winner_campaign_list_id')->nullable();
                $table->integer('user_id')->nullable();
                $table->timestamp('created_at')->useCurrentOnUpdate();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else {
            if (!Schema::hasColumn('split_tests', 'id')) {
                Schema::table('split_tests', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('split_tests', 'name')) {
                Schema::table('split_tests', function (Blueprint $table) {
                    $table->string('name', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('split_tests', 'test_on')) {
                Schema::table('split_tests', function (Blueprint $table) {
                    $table->enum('test_on', ['lists', 'campaigns'])->nullable()->default('campaigns');
                });
            }
            if (!Schema::hasColumn('split_tests', 'campaign_list_ids')) {
                Schema::table('split_tests', function (Blueprint $table) {
                    $table->string('campaign_list_ids', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('split_tests', 'winner_type')) {
                Schema::table('split_tests', function (Blueprint $table) {
                    $table->enum('winner_type', ['opened', 'clicked', 'link'])->nullable();
                });
            }
            if (!Schema::hasColumn('split_tests', 'link_id')) {
                Schema::table('split_tests', function (Blueprint $table) {
                    $table->integer('link_id')->nullable();
                });
            }
            if (!Schema::hasColumn('split_tests', 'test_type')) {
                Schema::table('split_tests', function (Blueprint $table) {
                    $table->enum('test_type', ['show', 'send'])->nullable();
                });
            }
            if (!Schema::hasColumn('split_tests', 'test_type_attributes')) {
                Schema::table('split_tests', function (Blueprint $table) {
                    $table->mediumText('test_type_attributes')->nullable();
                });
            }
            if (!Schema::hasColumn('split_tests', 'winner_campaign_list_send_datetime')) {
                Schema::table('split_tests', function (Blueprint $table) {
                    $table->dateTime('winner_campaign_list_send_datetime')->nullable();
                });
            }
            if (!Schema::hasColumn('split_tests', 'winner_campaign_list_id')) {
                Schema::table('split_tests', function (Blueprint $table) {
                    $table->integer('winner_campaign_list_id')->nullable();
                });
            }
            if (!Schema::hasColumn('split_tests', 'user_id')) {
                Schema::table('split_tests', function (Blueprint $table) {
                    $table->integer('user_id')->nullable();
                });
            }
             if (!Schema::hasColumn('split_tests', 'created_at')) {
                Schema::table('split_tests', function (Blueprint $table) {
                  $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('split_tests', 'updated_at')) {
                Schema::table('split_tests', function (Blueprint $table) {
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
        Schema::dropIfExists('split_tests');
    }

}
;
