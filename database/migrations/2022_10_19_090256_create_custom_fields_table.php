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
        if (!Schema::hasTable('custom_fields')) {
            Schema::create('custom_fields', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('name', 255)->nullable();
                $table->string('tag', 255)->nullable();
                $table->string('type', 30)->nullable();
                $table->boolean('is_default')->default(false);
                $table->boolean('is_required')->default(false);
                $table->text('options')->nullable();
                $table->mediumInteger('field_order')->nullable()->default(1);
                $table->string('list_ids', 255)->nullable();
                $table->integer('user_id')->nullable();
                $table->boolean('is_deleted')->default(false);
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
            DB::statement("INSERT INTO `custom_fields` (`id`, `name`, `tag`, `type`, `is_default`, `is_required`, `options`, `field_order`, `list_ids`, `user_id`, `is_deleted`) VALUES
(1, 'First Name', 'first_name', 'text', 1, 0, NULL, 2, NULL, 2, 0),
(2, 'Last Name', 'last_name', 'text', 1, 0, NULL, 3, NULL, 2, 0 ),
(3, 'Birth Date', 'birth_date', 'date', 1, 0, NULL, 4, NULL, 2, 0 ),
(4, 'City', 'city', 'text', 1, 0, NULL, 10, NULL, 2, 0 ),
(5, 'State', 'state', 'text', 1, 0, NULL, 9, NULL, 2, 0 ),
(6, 'Country', 'country', 'select', 1, 0, NULL, 8, NULL, 2, 0 ),
(7, 'Zip Code', 'zip_code', 'text', 1, 0, NULL, 11, NULL, 2, 0 ),
(8, 'Mobile', 'mobile', 'text', 1, 0, NULL, 6, NULL, 2, 0 ),
(9, 'Phone', 'phone', 'text', 1, 0, NULL, 5, NULL, 2, 0 ),
(10, 'Fax', 'fax', 'text', 1, 0, NULL, 12, NULL, 2, 0 ),
(11, 'Company', 'company', 'text', 1, 0, NULL, 7, NULL, 2, 0 ),
(12, 'Title', 'title', 'text', 1, 0, NULL, 1, NULL, 2, 0 );");
        }
        else {
             if (!Schema::hasColumn('custom_fields', 'id')) {
                Schema::table('custom_fields', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('custom_fields', 'name')) {
                Schema::table('custom_fields', function (Blueprint $table) {
                    $table->string('name', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('custom_fields', 'tag')) {
                Schema::table('custom_fields', function (Blueprint $table) {
                    $table->string('tag', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('custom_fields', 'type')) {
                Schema::table('custom_fields', function (Blueprint $table) {
                    $table->string('type', 30)->nullable();
                });
            }
            if (!Schema::hasColumn('custom_fields', 'is_default')) {
                Schema::table('custom_fields', function (Blueprint $table) {
                    $table->boolean('is_default')->default(false);
                });
            }
            if (!Schema::hasColumn('custom_fields', 'is_required')) {
                Schema::table('custom_fields', function (Blueprint $table) {
                    $table->boolean('is_required')->default(false);
                });
            }
            if (!Schema::hasColumn('custom_fields', 'options')) {
                Schema::table('custom_fields', function (Blueprint $table) {
                    $table->text('options')->nullable();
                });
            }
            if (!Schema::hasColumn('custom_fields', 'field_order')) {
                Schema::table('custom_fields', function (Blueprint $table) {
                    $table->mediumInteger('field_order')->nullable()->default(1);
                });
            }
            if (!Schema::hasColumn('custom_fields', 'list_ids')) {
                Schema::table('custom_fields', function (Blueprint $table) {
                    $table->string('list_ids', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('custom_fields', 'user_id')) {
                Schema::table('custom_fields', function (Blueprint $table) {
                    $table->integer('user_id')->nullable();
                });
            }
            if (!Schema::hasColumn('custom_fields', 'is_deleted')) {
                Schema::table('custom_fields', function (Blueprint $table) {
                    $table->boolean('is_deleted')->default(false);
                });
            }
            if (!Schema::hasColumn('custom_fields', 'created_at')) {
                Schema::table('custom_fields', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('custom_fields', 'updated_at')) {
                Schema::table('custom_fields', function (Blueprint $table) {
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
        Schema::dropIfExists('custom_fields');
    }

}
;
