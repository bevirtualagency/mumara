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
        if (!Schema::hasTable('web_form_categories')) {
            Schema::create('web_form_categories', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('category', 255)->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
            DB::statement("INSERT INTO `web_form_categories` (`id`, `category`, `created_at`, `updated_at`) VALUES
(1, 'Susbcriber form', '2022-09-13 12:54:46', '2022-09-13 12:54:46'),
(2, 'Subscribe form minimal', '2022-09-13 12:54:46', '2022-09-13 12:54:46'),
(3, 'Subscribe form with background', '2022-09-13 12:54:46', '2022-09-13 12:54:46'),
(4, 'Campaign Monitor Form', '2022-09-13 12:54:46', '2022-09-13 12:54:46'),
(5, 'Contact Form', '2022-09-13 12:54:46', '2022-09-13 12:54:46'),
(6, 'Contact Form variant2', '2022-09-13 12:54:46', '2022-09-13 12:54:46'),
(7, 'Contact Form with adrress', '2022-09-13 12:54:46', '2022-09-13 12:54:46'),
        (8, 'Contact form address variant2', '2022-09-13 12:54:46', '2022-09-13 12:54:46');");
        }
        else {
            if (!Schema::hasColumn('web_form_categories', 'id')) {
                Schema::table('web_form_categories', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('web_form_categories', 'category')) {
                Schema::table('web_form_categories', function (Blueprint $table) {
                    $table->string('category', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('web_form_categories', 'created_at')) {
                Schema::table('web_form_categories', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('web_form_categories', 'updated_at')) {
                Schema::table('web_form_categories', function (Blueprint $table) {
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
        Schema::dropIfExists('web_form_categories');
    }

}
;
