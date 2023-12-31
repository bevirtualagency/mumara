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
        if (!Schema::hasColumn('user_notifications', 'notification_url')) {
            Schema::table('user_notifications', function (Blueprint $table) {
                $table->text('notification_url')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        
    }

}
;
