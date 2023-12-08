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
        if (!Schema::hasTable('lists')) {
            Schema::create('lists', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('name', 255)->nullable();
                $table->integer('group_id')->nullable();
                $table->string('owner_name', 255)->nullable();
                $table->string('owner_email', 255)->nullable();
                $table->string('reply_email', 255)->nullable();
                $table->integer('bounce_email_id')->nullable();
                $table->boolean('is_deleted')->default(false);
                $table->boolean('validate')->default(false);
                $table->integer('user_id')->nullable();
                $table->integer('total_subscribers')->nullable();
                $table->boolean('export_status')->default(false);
                $table->integer('export_count')->default(0);
                $table->boolean('download_status')->default(false);
                $table->boolean('import_status')->default(false);
                $table->enum('zapier_connected', ['0', '1'])->nullable();
                $table->boolean('copying')->default(false);
                $table->boolean('import_cancel')->default(false);
                $table->integer('contacts_limit')->nullable();
                $table->boolean('edit_disable')->nullable()->default(false);
                $table->boolean('force_unconfirmed')->nullable()->default(false);
                $table->boolean('disable_import')->default(false);
                $table->text('visible_fields')->nullable();
                $table->boolean('is_blocked')->default(false);
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else
        {
             if (!Schema::hasColumn('lists', 'id')) {
                Schema::table('lists', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
             if (!Schema::hasColumn('lists', 'name')) {
                Schema::table('lists', function (Blueprint $table) {
                    $table->string('name', 255)->nullable();
                });
            }
             if (!Schema::hasColumn('lists', 'group_id')) {
                Schema::table('lists', function (Blueprint $table) {
                    $table->integer('group_id')->nullable();
                });
            }
             if (!Schema::hasColumn('lists', 'owner_name')) {
                Schema::table('lists', function (Blueprint $table) {
                    $table->string('owner_name', 255)->nullable();
                });
            }
             if (!Schema::hasColumn('lists', 'owner_email')) {
                Schema::table('lists', function (Blueprint $table) {
                    $table->string('owner_email', 255)->nullable();
                });
            }
             if (!Schema::hasColumn('lists', 'reply_email')) {
                Schema::table('lists', function (Blueprint $table) {
                    $table->string('reply_email', 255)->nullable();
                });
            }
             if (!Schema::hasColumn('lists', 'bounce_email_id')) {
                Schema::table('lists', function (Blueprint $table) {
                    $table->integer('bounce_email_id')->nullable();
                });
            }
             if (!Schema::hasColumn('lists', 'is_deleted')) {
                Schema::table('lists', function (Blueprint $table) {
                    $table->boolean('is_deleted')->default(false);
                });
            }
             if (!Schema::hasColumn('lists', 'validate')) {
                Schema::table('lists', function (Blueprint $table) {
                    $table->boolean('validate')->default(false);
                });
            }
             if (!Schema::hasColumn('lists', 'user_id')) {
                Schema::table('lists', function (Blueprint $table) {
                    $table->integer('user_id')->nullable();
                });
            }
             if (!Schema::hasColumn('lists', 'total_subscribers')) {
                Schema::table('lists', function (Blueprint $table) {
                    $table->integer('total_subscribers')->nullable();
                });
            }
             if (!Schema::hasColumn('lists', 'export_status')) {
                Schema::table('lists', function (Blueprint $table) {
                    $table->boolean('export_status')->default(false);
                });
            }
             if (!Schema::hasColumn('lists', 'export_count')) {
                Schema::table('lists', function (Blueprint $table) {
                    $table->integer('export_count')->default(0);
                });
            }
             if (!Schema::hasColumn('lists', 'download_status')) {
                Schema::table('lists', function (Blueprint $table) {
                    $table->boolean('download_status')->default(false);
                });
            }
             if (!Schema::hasColumn('lists', 'import_status')) {
                Schema::table('lists', function (Blueprint $table) {
                    $table->boolean('import_status')->default(false);
                });
            }
             if (!Schema::hasColumn('lists', 'zapier_connected')) {
                Schema::table('lists', function (Blueprint $table) {
                    $table->enum('zapier_connected', ['0', '1'])->nullable();
                });
            }
             if (!Schema::hasColumn('lists', 'copying')) {
                Schema::table('lists', function (Blueprint $table) {
                    $table->boolean('copying')->default(false);
                });
            }
             if (!Schema::hasColumn('lists', 'import_cancel')) {
                Schema::table('lists', function (Blueprint $table) {
                    $table->boolean('import_cancel')->default(false);
                });
            }
             if (!Schema::hasColumn('lists', 'contacts_limit')) {
                Schema::table('lists', function (Blueprint $table) {
                    $table->integer('contacts_limit')->nullable();
                });
            }
             if (!Schema::hasColumn('lists', 'edit_disable')) {
                Schema::table('lists', function (Blueprint $table) {
                    $table->boolean('edit_disable')->nullable()->default(false);
                });
            }
             if (!Schema::hasColumn('lists', 'force_unconfirmed')) {
                Schema::table('lists', function (Blueprint $table) {
                    $table->boolean('force_unconfirmed')->nullable()->default(false);
                });
            }
             if (!Schema::hasColumn('lists', 'disable_import')) {
                Schema::table('lists', function (Blueprint $table) {
                    $table->boolean('disable_import')->default(false);
                });
            }
             if (!Schema::hasColumn('lists', 'visible_fields')) {
                Schema::table('lists', function (Blueprint $table) {
                    $table->text('visible_fields')->nullable();
                });
            }
             if (!Schema::hasColumn('lists', 'is_blocked')) {
                Schema::table('lists', function (Blueprint $table) {
                    $table->boolean('is_blocked')->default(false);
                });
            }
             if (!Schema::hasColumn('lists', 'created_at')) {
                Schema::table('lists', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
             if (!Schema::hasColumn('lists', 'updated_at')) {
                Schema::table('lists', function (Blueprint $table) {
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
        Schema::dropIfExists('lists');
    }

}
;
