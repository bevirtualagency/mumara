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
        
        try {
            if (Schema::hasTable('subscriber_additional_data')) {
            Schema::table('subscriber_additional_data', function (Blueprint $table) {
                $table->foreign(['subscriber_id'], 'subscriber_additional_data_fk')->references(['id'])->on('subscribers');
                $table->foreign(['custom_field_id'], 'subscriber_additional_data_ibfk_1')->references(['id'])->on('custom_fields');
            });
        }
        } catch (\Exception $e) {
            // echo $e->getMessage();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('subscriber_additional_data', function (Blueprint $table) {
            $table->dropForeign('subscriber_additional_data_fk');
            $table->dropForeign('subscriber_additional_data_ibfk_1');
        });
    }

}
;
