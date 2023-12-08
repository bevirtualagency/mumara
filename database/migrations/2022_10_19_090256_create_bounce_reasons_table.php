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
        if (!Schema::hasTable('bounce_reasons')) {
            Schema::create('bounce_reasons', function (Blueprint $table) {
                $table->integer('id', true);
                $table->string('label', 255)->nullable();
                $table->string('code', 50)->nullable();
                $table->enum('code_condition', ['is', 'contains'])->default('is');
                $table->string('reason', 255)->nullable();
                $table->enum('details_condition', ['is', 'contains'])->default('is');
                $table->enum('reason_condition', ['is', 'contains'])->default('is');
                $table->string('details', 255)->nullable();
                $table->enum('type', ['soft', 'hard', 'no_process'])->nullable();
                $table->boolean('status')->default(true);
                $table->boolean('is_default')->default(false)->index('is_default');
                $table->unsignedInteger('sort_order')->nullable();
                $table->integer('user_id');
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            });
            DB::statement("INSERT INTO `bounce_reasons` (`id`, `label`, `code`, `code_condition`, `reason`, `details_condition`, `reason_condition`, `details`, `type`, `status`, `is_default`, `sort_order`, `user_id`) VALUES
(1, 'The email account is over quota', '4.2.2', 'is', NULL, 'is', 'is', NULL, 'soft', 1, 1, 1, 2),
(2, 'Address does not exist', '5.0.0', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 2, 2),
(3, 'Other address status', '5.1.0', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 3, 2),
(4, 'Bad destination mailbox address', '5.1.1', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 4, 2),
(5, 'Bad destination system address', '5.1.2', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 5, 2),
(6, 'Bad destination mailbox address syntax', '5.1.3', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 6, 2),
(7, 'Destination mailbox address ambiguous', '5.1.4', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 7, 2),
(8, 'Destination mailbox address invalid', '5.1.5', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 8, 2),
(9, 'Mailbox has moved', '5.1.6', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 9, 2),
(10, 'Bad sender’s mailbox address syntax', '5.1.7', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 10, 2);");
            DB::statement("INSERT INTO `bounce_reasons` (`id`, `label`, `code`, `code_condition`, `reason`, `details_condition`, `reason_condition`, `details`, `type`, `status`, `is_default`, `sort_order`, `user_id`) VALUES
(11, 'Bad sender’s system address', '5.1.8', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 11, 2),
(12, 'Other or undefined mailbox status', '5.2.0', 'is', NULL, 'is', 'is', NULL, 'soft', 1, 1, 12, 2),
(13, 'Mailbox disabled not accepting messages', '5.2.1', 'is', NULL, 'is', 'is', NULL, 'soft', 1, 1, 13, 2),
(14, 'Mailbox full', '5.2.2', 'is', NULL, 'is', 'is', NULL, 'soft', 1, 1, 14, 2),
(15, 'Message length exceeds administrative limit.', '5.2.3', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 15, 2),
(16, 'Mailing list expansion problem', '5.2.4', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 16, 2),
(17, 'Other or undefined mail system status', '5.3.0', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 17, 2),
(18, 'Mail system full', '5.3.1', 'is', NULL, 'is', 'is', NULL, 'soft', 1, 1, 18, 2),
(19, 'System not accepting network messages', '5.3.2', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 19, 2);");

            DB::statement("INSERT INTO `bounce_reasons` (`id`, `label`, `code`, `code_condition`, `reason`, `details_condition`, `reason_condition`, `details`, `type`, `status`, `is_default`, `sort_order`, `user_id`) VALUES
(20, 'System not capable of selected features', '5.3.3', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 20, 2),
(21, 'Message too big for system', '5.3.4', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 21, 2),
(22, 'Other or undefined network or routing status', '5.4.0', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 22, 2),
(23, 'No answer from host', '5.4.1', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 23, 2),
(24, 'Bad connection', '5.4.2', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 24, 2),
(25, 'Routing server failure', '5.4.3', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 25, 2),
(26, 'Unable to route', '5.4.4', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 26, 2),
(27, 'Network congestion', '5.4.5', 'is', NULL, 'is', 'is', NULL, 'soft', 1, 1, 27, 2),
(28, 'Routing loop detected', '5.4.6', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 28, 2),
(29, 'Delivery time expired', '5.4.7', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 29, 2),
(30, 'Other or undefined protocol status', '5.5.0', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 30, 2);");
            DB::statement("INSERT INTO `bounce_reasons` (`id`, `label`, `code`, `code_condition`, `reason`, `details_condition`, `reason_condition`, `details`, `type`, `status`, `is_default`, `sort_order`, `user_id`) VALUES
(31, 'Invalid command', '5.5.1', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 31, 2),
(32, 'Syntax error', '5.5.2', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 32, 2),
(33, 'Too many recipients', '5.5.3', 'is', NULL, 'is', 'is', NULL, 'soft', 1, 1, 33, 2),
(34, 'Invalid command arguments', '5.5.4', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 34, 2),
(35, 'Wrong protocol version', '5.5.5', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 35, 2),
(36, 'Other or undefined media error', '5.6.0', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 36, 2),
(37, 'Media not supported', '5.6.1', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 37, 2),
(38, 'Conversion required and prohibited', '5.6.2', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 38, 2),
(39, 'Conversion required but not supported', '5.6.3', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 39, 2),
(40, 'Conversion with loss performed', '5.6.4', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 40, 2);");
            DB::statement("INSERT INTO `bounce_reasons` (`id`, `label`, `code`, `code_condition`, `reason`, `details_condition`, `reason_condition`, `details`, `type`, `status`, `is_default`, `sort_order`, `user_id`) VALUES
(41, 'Conversion failed', '5.6.5', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 41, 2),
(42, 'Other or undefined security status', '5.7.0', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 42, 2),
(43, 'Delivery not authorized message refused', '5.7.1', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 43, 2),
(44, 'Mailing list expansion prohibited', '5.7.2', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 44, 2),
(45, 'Security conversion required but not possible', '5.7.3', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 45, 2),
(46, 'Security features not supported', '5.7.4', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 46, 2),
(47, 'Cryptographic failure', '5.7.5', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 47, 2),
(48, 'Cryptographic algorithm not supported', '5.7.6', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 48, 2),
(49, 'Message integrity failure', '5.7.7', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 49, 2),
(50, 'Hard bounce with no bounce code found. It could be an invalid email or rejected email from your mail server (such as from a sending limit).', '9.1.1', 'is', NULL, 'is', 'is', NULL, 'hard', 1, 1, 50, 2);");
        }
        else
        {
             if (!Schema::hasColumn('bounce_reasons', 'id')) {
                Schema::table('bounce_reasons', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
             if (!Schema::hasColumn('bounce_reasons', 'label')) {
                Schema::table('bounce_reasons', function (Blueprint $table) {
                    $table->string('label', 255)->nullable();
                });
            }
             if (!Schema::hasColumn('bounce_reasons', 'code')) {
                Schema::table('bounce_reasons', function (Blueprint $table) {
                    $table->string('code', 50)->nullable();
                });
            }
             if (!Schema::hasColumn('bounce_reasons', 'code_condition')) {
                Schema::table('bounce_reasons', function (Blueprint $table) {
                    $table->enum('code_condition', ['is', 'contains'])->default('is');
                });
            }
             if (!Schema::hasColumn('bounce_reasons', 'reason')) {
                Schema::table('bounce_reasons', function (Blueprint $table) {
                    $table->string('reason', 255)->nullable();
                });
            }
             if (!Schema::hasColumn('bounce_reasons', 'details_condition')) {
                Schema::table('bounce_reasons', function (Blueprint $table) {
                    $table->enum('details_condition', ['is', 'contains'])->default('is');
                });
            }
            if (!Schema::hasColumn('bounce_reasons', 'reason_condition')) {
                Schema::table('bounce_reasons', function (Blueprint $table) {
                    $table->enum('reason_condition', ['is', 'contains'])->default('is');
                });
            }
            if (!Schema::hasColumn('bounce_reasons', 'details')) {
                Schema::table('bounce_reasons', function (Blueprint $table) {
                    $table->string('details', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('bounce_reasons', 'type')) {
                Schema::table('bounce_reasons', function (Blueprint $table) {
                    $table->enum('type', ['soft', 'hard', 'no_process'])->nullable();
                });
            }
            if (!Schema::hasColumn('bounce_reasons', 'status')) {
                Schema::table('bounce_reasons', function (Blueprint $table) {
                    $table->boolean('status')->default(true);
                });
            }
            if (!Schema::hasColumn('bounce_reasons', 'is_default')) {
                Schema::table('bounce_reasons', function (Blueprint $table) {
                    $table->boolean('is_default')->default(false)->index('is_default');
                });
            }
            if (!Schema::hasColumn('bounce_reasons', 'sort_order')) {
                Schema::table('bounce_reasons', function (Blueprint $table) {
                    $table->unsignedInteger('sort_order')->nullable();
                });
            }
            if (!Schema::hasColumn('bounce_reasons', 'user_id')) {
                Schema::table('bounce_reasons', function (Blueprint $table) {
                    $table->integer('user_id');
                });
            }
            if (!Schema::hasColumn('bounce_reasons', 'created_at')) {
                Schema::table('bounce_reasons', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('bounce_reasons', 'updated_at')) {
                Schema::table('bounce_reasons', function (Blueprint $table) {
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
        Schema::dropIfExists('bounce_reasons');
    }

}
;
