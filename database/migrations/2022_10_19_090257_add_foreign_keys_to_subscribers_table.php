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
             if (Schema::hasTable('subscribers')) {
            Schema::table('subscribers', function (Blueprint $table) {
                $table->foreign(['list_id'], 'subscribers_ibfk_1')->references(['id'])->on('lists');
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
        Schema::table('subscribers', function (Blueprint $table) {
            $table->dropForeign('subscribers_ibfk_1');
        });
    }

}
;
