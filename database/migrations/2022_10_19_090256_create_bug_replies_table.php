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
        if (!Schema::hasTable('bug_replies')) {
            Schema::create('bug_replies', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('bug_id')->nullable();
                $table->enum('user_type', ['client', 'staff'])->default('staff');
                $table->text('reply');
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
        }
        else
        {
            if (!Schema::hasColumn('bug_replies', 'id')) {
                Schema::table('bug_replies', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('bug_replies', 'bug_id')) {
                Schema::table('bug_replies', function (Blueprint $table) {
                    $table->integer('bug_id')->nullable();
                });
            }
            if (!Schema::hasColumn('bug_replies', 'user_type')) {
                Schema::table('bug_replies', function (Blueprint $table) {
                    $table->enum('user_type', ['client', 'staff'])->default('staff');
                });
            }
            if (!Schema::hasColumn('bug_replies', 'reply')) {
                Schema::table('bug_replies', function (Blueprint $table) {
                    $table->text('reply');
                });
            }
            if (!Schema::hasColumn('bug_replies', 'created_at')) {
                Schema::table('bug_replies', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('bug_replies', 'updated_at')) {
                Schema::table('bug_replies', function (Blueprint $table) {
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
        Schema::dropIfExists('bug_replies');
    }

}
;
