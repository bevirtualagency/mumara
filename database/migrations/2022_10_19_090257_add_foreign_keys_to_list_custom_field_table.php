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
              if (Schema::hasTable('list_custom_field')) {
            Schema::table('list_custom_field', function (Blueprint $table) {
                $table->foreign(['custom_field_id'], 'fk_custom_field_id')->references(['id'])->on('custom_fields');
                $table->foreign(['list_id'], 'fk_list_id')->references(['id'])->on('lists');
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
        Schema::table('list_custom_field', function (Blueprint $table) {
            $table->dropForeign('fk_custom_field_id');
            $table->dropForeign('fk_list_id');
        });
    }

}
;
