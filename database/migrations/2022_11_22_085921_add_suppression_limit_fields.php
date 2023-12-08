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
        if (!Schema::hasColumn('packages', 'suppress_domains_limit')) {
            Schema::table('packages', function (Blueprint $table) {
                $table->Integer('suppress_domains_limit')->nullable()->default(NULL);
            });
        }
        if (!Schema::hasColumn('user_email_limits', 'domain_suppression_limit')) {
            Schema::table('user_email_limits', function (Blueprint $table) {
                $table->Integer('domain_suppression_limit')->nullable()->default(NULL);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn('suppress_domains_limit');
        });

        Schema::table('user_email_limits', function (Blueprint $table) {
            $table->dropColumn('domain_suppression_limit');
        });
    }

}
;
