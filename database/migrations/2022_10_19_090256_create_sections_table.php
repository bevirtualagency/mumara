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
        if (!Schema::hasTable('sections')) {
            Schema::create('sections', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('name', 255);
            });
            DB::statement("INSERT INTO `sections` (`id`, `name`) VALUES
(1, 'List'),
(2, 'SMTP'),
(3, 'Campaign'),
        (4, 'Email Template');");
        }
        else {
            if (!Schema::hasColumn('sections', 'id')) {
                Schema::table('sections', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('sections', 'name')) {
                Schema::table('sections', function (Blueprint $table) {
                    $table->string('name', 255);
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
        Schema::dropIfExists('sections');
    }

}
;
