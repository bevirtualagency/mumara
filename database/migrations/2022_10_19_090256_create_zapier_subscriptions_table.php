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
        if (!Schema::hasTable('zapier_subscriptions')) {
            Schema::create('zapier_subscriptions', function (Blueprint $table) {
                $table->increments('id');
                $table->string('url')->unique('url');
                $table->string('zap_type', 255);
                $table->text('subscription_data');
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else {
            if (!Schema::hasColumn('zapier_subscriptions', 'id')) {
                Schema::table('zapier_subscriptions', function (Blueprint $table) {
                    $table->increments('id');
                });
            }
            if (!Schema::hasColumn('zapier_subscriptions', 'url')) {
                Schema::table('zapier_subscriptions', function (Blueprint $table) {
                    $table->string('url')->unique('url');
                });
            }
            if (!Schema::hasColumn('zapier_subscriptions', 'zap_type')) {
                Schema::table('zapier_subscriptions', function (Blueprint $table) {
                    $table->string('zap_type', 255);
                });
            }
            if (!Schema::hasColumn('zapier_subscriptions', 'subscription_data')) {
                Schema::table('zapier_subscriptions', function (Blueprint $table) {
                    $table->text('subscription_data');
                });
            }
            if (!Schema::hasColumn('zapier_subscriptions', 'created_at')) {
                Schema::table('zapier_subscriptions', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('zapier_subscriptions', 'updated_at')) {
                Schema::table('zapier_subscriptions', function (Blueprint $table) {
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
        Schema::dropIfExists('zapier_subscriptions');
    }

}
;
