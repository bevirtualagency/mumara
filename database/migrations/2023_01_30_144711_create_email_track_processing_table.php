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
        if (!Schema::hasTable('email_track_processing')) {
            Schema::create('email_track_processing', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('user_id')->nullable();
                $table->enum('type', ['open', 'click'])->default('open');
                $table->integer('broadcast_id')->nullable();
                $table->integer('scheduled_id')->nullable()->index('scheduled_id');
                $table->integer('contact_id')->nullable()->index('contact_id');
                $table->integer('campaign_schedule_logs_id')->index('campaign_schedule_logs_id');
                $table->integer('link_id')->nullable();
                $table->string('link')->nullable();
                $table->string('ip_address', 50)->nullable();
                $table->string('ip_country', 55)->nullable();
                $table->string('ip_region', 55)->nullable();
                $table->string('ip_city', 55)->nullable();
                $table->string('ip_zip', 10)->nullable();
                $table->string('user_agent')->nullable();
                $table->string('platform', 50)->nullable();
                $table->string('browser', 50)->nullable();
                $table->string('device', 50)->nullable();
                $table->boolean('is_bot')->nullable();
                $table->boolean('status')->default(false);
                $table->integer('number_rand')->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        } else { 
            if (!Schema::hasColumn('email_track_processing', 'id')) {
                Schema::table('email_track_processing', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('email_track_processing', 'user_id')) {
                Schema::table('email_track_processing', function (Blueprint $table) {
                    $table->integer('user_id')->nullable();
                });
            }


            if (!Schema::hasColumn('email_track_processing', 'type')) {
                Schema::table('email_track_processing', function (Blueprint $table) { 
                    $table->enum('type', ['open', 'click'])->default('open');
                });
            }
            if(!Schema::hasColumn('email_track_processing', 'broadcast_id')) {
                Schema::table('email_track_processing', function (Blueprint $table) { 
                    $table->integer('broadcast_id')->nullable(); 
                });
            }
            if (!Schema::hasColumn('email_track_processing', 'scheduled_id')) {
                Schema::table('email_track_processing', function (Blueprint $table) { 
                    $table->integer('scheduled_id')->nullable()->index('scheduled_id');
                });
            }
            if (!Schema::hasColumn('email_track_processing', 'contact_id')) {
            Schema::table('email_track_processing', function (Blueprint $table) { 
            $table->integer('contact_id')->nullable()->index('contact_id');
            });
            }
            
            if (!Schema::hasColumn('email_track_processing', 'campaign_schedule_logs_id')) {
            Schema::table('email_track_processing', function (Blueprint $table) { 
            $table->integer('campaign_schedule_logs_id')->index('campaign_schedule_logs_id');
            });
            }
            
            if (!Schema::hasColumn('email_track_processing', 'link_id')) {
            Schema::table('email_track_processing', function (Blueprint $table) { 
                $table->integer('link_id')->nullable(); });
            }
            if (!Schema::hasColumn('email_track_processing', 'link')) {
            Schema::table('email_track_processing', function (Blueprint $table) { 
                $table->string('link')->nullable(); });
            }
            if (!Schema::hasColumn('email_track_processing', 'ip_address')) {
            Schema::table('email_track_processing', function (Blueprint $table) { 
                $table->string('ip_address', 50)->nullable(); });
            }
            if (!Schema::hasColumn('email_track_processing', 'ip_country')) {
            Schema::table('email_track_processing', function (Blueprint $table) { 
                $table->string('ip_country', 55)->nullable(); });
            }
            if (!Schema::hasColumn('email_track_processing', 'ip_region')) {
            Schema::table('email_track_processing', function (Blueprint $table) { 
                $table->string('ip_region', 55)->nullable(); });
            }
            if (!Schema::hasColumn('email_track_processing', 'ip_city')) {
            Schema::table('email_track_processing', function (Blueprint $table) { 
                $table->string('ip_city', 55)->nullable(); });
            }
            if (!Schema::hasColumn('email_track_processing', 'ip_zip')) {
            Schema::table('email_track_processing', function (Blueprint $table) { 
                $table->string('ip_zip', 10)->nullable(); });
            }
            if (!Schema::hasColumn('email_track_processing', 'user_agent')) {
            Schema::table('email_track_processing', function (Blueprint $table) { 
                $table->string('user_agent')->nullable(); });
            }
            if (!Schema::hasColumn('email_track_processing', 'platform')) {
            Schema::table('email_track_processing', function (Blueprint $table) { 
                $table->string('platform', 50)->nullable(); });
            }
            if (!Schema::hasColumn('email_track_processing', 'browser')) {
            Schema::table('email_track_processing', function (Blueprint $table) { 
                $table->string('browser', 50)->nullable(); });
            }
            if (!Schema::hasColumn('email_track_processing', 'device')) {
            Schema::table('email_track_processing', function (Blueprint $table) { 
                $table->string('device', 50)->nullable(); });
            }
            if (!Schema::hasColumn('email_track_processing', 'is_bot')) {
            Schema::table('email_track_processing', function (Blueprint $table) { 
                $table->boolean('is_bot')->nullable(); });
            }
            if (!Schema::hasColumn('email_track_processing', 'status')) {
            Schema::table('email_track_processing', function (Blueprint $table) { 
                $table->boolean('status')->default(false); });
            }
            if (!Schema::hasColumn('email_track_processing', 'number_rand')) {
            Schema::table('email_track_processing', function (Blueprint $table) { 
                $table->integer('number_rand')->nullable(); });
            }
            if (!Schema::hasColumn('email_track_processing', 'created_at')) {
            Schema::table('email_track_processing', function (Blueprint $table) { 
                $table->timestamp('created_at')->nullable()->useCurrent(); });
            }
            if (!Schema::hasColumn('email_track_processing', 'updated_at')) {
            Schema::table('email_track_processing', function (Blueprint $table) { 
                $table->timestamp('updated_at')->useCurrentOnUpdate(); });
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
        Schema::dropIfExists('email_track_processing');
    }
};
;
