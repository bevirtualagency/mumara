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
        if (!Schema::hasTable('fbls')) {
            Schema::create('fbls', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('name', 255)->nullable();
                $table->string('host', 255)->nullable();
                $table->mediumInteger('port')->nullable();
                $table->string('username', 255)->nullable();
                $table->string('password', 255)->nullable();
                $table->string('folder', 255)->nullable();
                $table->boolean('validate_certificates')->nullable()->default(false);
                $table->string('fbl_encryption', 20)->nullable();
                $table->boolean('delete_emails')->nullable()->default(false);
                $table->enum('processing_protocols', ['pop', 'imap'])->nullable();
                $table->integer('user_id')->nullable();
                $table->integer('complaints')->default(0);
                $table->enum('status', ['active', 'inactive', 'error'])->default('inactive');
                $table->text('error')->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else {
            if (!Schema::hasColumn('fbls', 'id')) {
                Schema::table('fbls', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('fbls', 'name')) {
                Schema::table('fbls', function (Blueprint $table) {
                    $table->string('name', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('fbls', 'host')) {
                Schema::table('fbls', function (Blueprint $table) {
                    $table->string('host', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('fbls', 'port')) {
                Schema::table('fbls', function (Blueprint $table) {
                    $table->mediumInteger('port')->nullable();
                });
            }
            if (!Schema::hasColumn('fbls', 'username')) {
                Schema::table('fbls', function (Blueprint $table) {
                    $table->string('username', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('fbls', 'password')) {
                Schema::table('fbls', function (Blueprint $table) {
                    $table->string('password', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('fbls', 'folder')) {
                Schema::table('fbls', function (Blueprint $table) {
                    $table->string('folder', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('fbls', 'validate_certificates')) {
                Schema::table('fbls', function (Blueprint $table) {
                    $table->boolean('validate_certificates')->nullable()->default(false);
                });
            }
            if (!Schema::hasColumn('fbls', 'fbl_encryption')) {
                Schema::table('fbls', function (Blueprint $table) {
                    $table->string('fbl_encryption', 20)->nullable();
                });
            }
            if (!Schema::hasColumn('fbls', 'delete_emails')) {
                Schema::table('fbls', function (Blueprint $table) {
                    $table->boolean('delete_emails')->nullable()->default(false);
                });
            }
            if (!Schema::hasColumn('fbls', 'processing_protocols')) {
                Schema::table('fbls', function (Blueprint $table) {
                    $table->enum('processing_protocols', ['pop', 'imap'])->nullable();
                });
            }
            if (!Schema::hasColumn('fbls', 'user_id')) {
                Schema::table('fbls', function (Blueprint $table) {
                    $table->integer('user_id')->nullable();
                });
            }
            if (!Schema::hasColumn('fbls', 'complaints')) {
                Schema::table('fbls', function (Blueprint $table) {
                    $table->integer('complaints')->default(0);
                });
            }
            if (!Schema::hasColumn('fbls', 'status')) {
                Schema::table('fbls', function (Blueprint $table) {
                    $table->enum('status', ['active', 'inactive', 'error'])->default('inactive');
                });
            }
            if (!Schema::hasColumn('fbls', 'error')) {
                Schema::table('fbls', function (Blueprint $table) {
                    $table->text('error')->nullable();
                });
            }
            if (!Schema::hasColumn('fbls', 'created_at')) {
                Schema::table('fbls', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('fbls', 'updated_at')) {
                Schema::table('fbls', function (Blueprint $table) {
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
        Schema::dropIfExists('fbls');
    }

}
;
