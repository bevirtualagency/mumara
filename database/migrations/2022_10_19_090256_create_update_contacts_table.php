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
        if (!Schema::hasTable('update_contacts')) {
            Schema::create('update_contacts', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('file', 155)->unique('file');
                $table->text('list_ids');
                $table->string('action', 50);
                $table->boolean('has_headers')->default(false);
                $table->unsignedInteger('processed')->default('0');
                $table->unsignedInteger('total')->default('0');
                $table->boolean('cancel_import')->default(false);
                $table->boolean('can_delete')->default(false);
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
       else {
         if (!Schema::hasColumn('update_contacts', 'id')) {
                Schema::table('update_contacts', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
             if (!Schema::hasColumn('update_contacts', 'file')) {
                Schema::table('update_contacts', function (Blueprint $table) {
                    $table->string('file', 155)->unique('file');
                });
            }
             if (!Schema::hasColumn('update_contacts', 'list_ids')) {
                Schema::table('update_contacts', function (Blueprint $table) {
                    $table->text('list_ids');
                });
            }
             if (!Schema::hasColumn('update_contacts', 'action')) {
                Schema::table('update_contacts', function (Blueprint $table) {
                    $table->string('action', 50);
                });
            }
             if (!Schema::hasColumn('update_contacts', 'has_headers')) {
                Schema::table('update_contacts', function (Blueprint $table) {
                    $table->boolean('has_headers')->default(false);
                });
            }
             if (!Schema::hasColumn('update_contacts', 'processed')) {
                Schema::table('update_contacts', function (Blueprint $table) {
                    $table->unsignedInteger('processed')->default('0');
                });
            }
             if (!Schema::hasColumn('update_contacts', 'total')) {
                Schema::table('update_contacts', function (Blueprint $table) {
                    $table->unsignedInteger('total')->default('0');
                });
            }
             if (!Schema::hasColumn('update_contacts', 'cancel_import')) {
                Schema::table('update_contacts', function (Blueprint $table) {
                    $table->boolean('cancel_import')->default(false);
                });
            }
             if (!Schema::hasColumn('update_contacts', 'can_delete')) {
                Schema::table('update_contacts', function (Blueprint $table) {
                    $table->boolean('can_delete')->default(false);
                });
            }
             if (!Schema::hasColumn('update_contacts', 'created_at')) {
                Schema::table('update_contacts', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
             if (!Schema::hasColumn('update_contacts', 'updated_at')) {
                Schema::table('update_contacts', function (Blueprint $table) {
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
        Schema::dropIfExists('update_contacts');
    }

}
;
