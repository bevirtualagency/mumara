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
        if (!Schema::hasTable('permissions')) {
            Schema::create('permissions', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('parent_id')->nullable();
                $table->string('default_title', 255)->nullable();
                $table->string('title', 255)->nullable();
                $table->boolean('is_available')->default(true);
                $table->integer('sequence')->default(10000);
                $table->enum('route_type', ['web', 'api'])->default('web');
                $table->string('route', 255)->nullable();
                $table->boolean('skip_in_acl')->default(false);
                $table->boolean('hidden_in_acl')->default(false);
                $table->enum('access_level', ['super_admin', 'admin', 'all'])->default('all');
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            });
            DB::statement("INSERT INTO `permissions` (`id`, `parent_id`, `default_title`, `title`, `is_available`, `sequence`, `route_type`, `route`, `skip_in_acl`, `hidden_in_acl`, `access_level`, `created_at`, `updated_at`) VALUES
(1, 0, 'Head', 'Head', 1, 1, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(2, 0, 'Subscribers', 'Subscribers', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(3, 0, 'Campaigns', 'Campaigns', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(4, 1, 'Triggers', 'Triggers', 1, 19, 'web', 'trigger.index', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(5, 1, 'Sending Nodes', 'Sending Nodes', 1, 21, 'web', 'node.index', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(6, 0, 'Bounce', 'Bounce', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(7, 1, 'Sending Domains', 'Sending Domains', 1, 20, 'web', 'domain.index', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(8, 1, 'Web Forms', 'Web Forms', 1, 27, 'web', 'form.index', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(9, 1, 'Spintags', 'Spintags', 1, 13, 'web', 'spintag.index', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(10, 1, 'Feedback Loops', 'Feedback Loops', 1, 28, 'web', 'fbl.index', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(11, 1, 'Statistics', 'Statistics', 1, 30, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(13, 0, 'Email Templates', 'Email Templates', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(14, 0, 'Integration', 'Integration', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(15, 0, 'Autoresponders', 'Autoresponders', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(16, 1, 'Contact Lists', 'Contact Lists', 1, 1, 'web', 'list.index', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(17, 1, 'Custom Fields', 'Custom Fields', 1, 5, 'web', 'fields.index', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(18, 1, 'Segmentation', 'Segmentation', 1, 5, 'web', 'segments.index', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(19, 289, 'Email Suppression', 'Email Suppression', 1, 8, 'web', 'suppression-email.index', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(20, 289, 'Domains Suppression', 'Domains Suppression', 1, 9, 'web', 'suppression-domain.index', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(21, 289, 'IP Suppression', 'IP Suppression', 1, 10, 'web', 'suppression-ip.index', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(23, 298, 'Import contacts', 'Import contacts', 1, 6, 'web', 'contact.import', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(24, 1, 'Broadcasts', 'Broadcasts', 1, 11, 'web', 'broadcasts.index', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(25, 24, 'Schedule broadcast', 'Schedule broadcast', 1, 5, 'web', 'broadcast.schedule.create', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(26, 1, 'Split Tests', 'Split Tests', 1, 15, 'web', 'splittest.index', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(28, 1, 'Bounce Addresses', 'Bounce Addresses', 1, 24, 'web', 'bounce.index', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(29, 1, 'Bounce Rules', 'Bounce Rules', 1, 25, 'web', 'bounce-rules.index', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(37, 13, 'Email Template', 'Email Template', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(38, 13, 'View Email Templates', 'View Email Templates', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(45, 16, 'Add a list', 'Add a list', 1, 1, 'web', 'list.create', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(47, 16, 'Edit List', 'Edit List', 1, 6, 'web', 'list.edit', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(48, 16, 'Make a copy', 'Make a copy', 1, 2, 'web', 'list.copy', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(49, 16, 'Delete Lists', 'Delete Lists', 1, 7, 'web', 'list.delList', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(51, 298, 'Export contacts', 'Export contacts', 3, 7, 'web', 'list.export', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(52, 16, 'Split List', 'Split List', 1, 3, 'web', 'list.split', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(53, 16, 'Delete lists Bulk', 'Delete lists Bulk', 1, 8, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(54, 17, 'Add a custom field', 'Add a custom field', 1, 1, 'web', 'fields.create', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(56, 17, 'Edit custom field', 'Edit custom field', 1, 2, 'web', 'fields.edit', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(57, 17, 'Delete custom fields', 'Delete custom fields', 1, 3, 'web', 'fields.destroy', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(59, 18, 'Add a segment ', 'Add a segment', 1, 1, 'web', 'segment.add', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(62, 18, 'Delete segments', 'Delete segments', 1, 4, 'web', 'segments.destroy', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(63, 18, 'Export segments', 'Export segments', 1, 5, 'web', 'exportSegment', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(64, 18, 'Copy segment to a list', 'Copy segment to a list', 1, 6, 'web', 'copySegmentToList', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(65, 18, 'Move segment to a list', 'Move segment to a list', 1, 7, 'web', 'moveSegmentToList', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(67, 19, 'Suppress an email address', 'Suppress an email address', 1, 10000, 'web', 'suppression-email.store', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(69, 19, 'Remove email addresses from suppression', 'Remove email addresses from suppression', 1, 10000, 'web', 'suppression-email.destroy', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(71, 20, 'Suppress a domain', 'Suppress a domain', 1, 1, 'web', 'suppression-domain.store', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(73, 20, 'Edit suppressed domain', 'Edit suppressed domain', 1, 2, 'web', 'suppression-domain.edit', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(74, 20, 'Delete suppressed domain', 'Delete suppressed domain', 1, 3, 'web', 'suppression-domain.destroy', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(76, 21, 'Suppress an IP address or subnet', 'Suppress an IP address or subnet', 1, 1, 'web', 'suppression-ip.store', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(78, 21, 'Edit suppressed IP address', 'Edit suppressed IP address', 1, 2, 'web', 'suppression-ip.edit', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(79, 21, 'Delete suppressed IP addresses', 'Delete suppressed IP addresses', 1, 3, 'web', 'suppression-ip.destroy', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(86, 24, 'Add a broadcast', 'Add a broadcast', 1, 1, 'web', 'broadcasts.add', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(88, 24, 'Edit broadcast', 'Edit broadcast', 1, 2, 'web', 'broadcasts.edit', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(89, 24, 'Delete broadcasts', 'Delete broadcasts', 1, 4, 'web', 'broadcasts.destroy', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(90, 24, 'Make a copy', 'Make a copy', 1, 3, 'web', 'broadcasts.copy', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(93, 24, 'View scheduled broadcasts', 'View scheduled broadcasts', 1, 6, 'web', 'broadcast.schedule.view.all', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(94, 24, 'Delete scheduled broadcasts', 'Delete scheduled broadcasts', 1, 7, 'web', 'broadcast.schedule.delete', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(95, 24, 'Re-schedule a Broadcast', 'Re-schedule a Broadcast', 1, 8, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(96, 26, 'Create a split test', 'Create a split test', 1, 10000, 'web', 'splittest.create', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(98, 26, 'Edit split test', 'Edit split test', 1, 10000, 'web', 'splittest.edit', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(99, 26, 'Delete split tests', 'Delete split tests', 1, 10000, 'web', 'splittest.destroy', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(101, 5, 'Add a sending node', 'Add a sending node', 1, 1, 'web', 'node.create-new', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(103, 5, 'Edit sending node', 'Edit sending node', 1, 2, 'web', 'node.edit', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(104, 5, 'Delete sending nodes', 'Delete sending nodes', 1, 3, 'web', 'node.destroy', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(105, 5, 'Make a copy', 'Make a copy', 1, 4, 'web', 'node.copy', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(108, 5, 'Export', 'Export', 1, 6, 'web', 'node.export', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(109, 5, 'Import', 'Import', 1, 5, 'web', 'import.smtp', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(110, 28, 'Add a bounce Address', 'Add a bounce Address', 1, 10000, 'web', 'bounce.create', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(112, 28, 'Edit bounce address', 'Edit bounce address', 2, 10000, 'web', 'bounce.edit', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(113, 28, 'Delete bounce addresses', 'Delete bounce addresses', 3, 10000, 'web', 'bounce.destroy', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(115, 29, 'Add a bounce rule', 'Add a bounce rule', 1, 1, 'web', 'bounce-rules.create', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(117, 29, 'Edit bounce rule', 'Edit bounce rule', 1, 2, 'web', 'bounce-rules.edit', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(118, 29, 'Delete bounce rules', 'Delete bounce rules', 1, 3, 'web', 'bounce-rules.destroy', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(119, 7, 'Add a sending domain', 'Add a sending domain', 1, 1, 'web', 'domain.create', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(121, 7, 'Edit sending domain', 'Edit sending domain', 1, 2, 'web', 'domain.edit', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(122, 7, 'Delete sending domains', 'Delete sending domains', 1, 3, 'web', 'domain.destroy', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(124, 8, 'Create a web form', 'Create a web form', 1, 1, 'web', 'form.create', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(126, 8, 'Edit web form', 'Edit web form', 1, 2, 'web', 'form.edit', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(127, 8, 'Delete web forms', 'Delete web forms', 1, 5, 'web', 'form.destroy', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(129, 9, 'Add a spintag', 'Add a spintag', 1, 1, 'web', 'spintag.create', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(131, 9, 'Edit spintag', 'Edit spintag', 1, 2, 'web', 'spintag.edit', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(132, 9, 'Delete spintag', 'Delete spintag', 1, 3, 'web', 'spintag.destroy', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(134, 10, 'Add a feedback loop', 'Add a feedback loop', 1, 1, 'web', 'fbl.create', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(136, 10, 'Edit a feedback loop', 'Edit a feedback loop', 1, 2, 'web', 'fbl.edit', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(137, 10, 'Delete feedback loops', 'Delete feedback loops', 1, 3, 'web', 'fbl.destroy', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(139, 404, 'Bounced', 'Bounced', 1, 10000, 'web', 'statistics.broadcasts.bounced', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(140, 404, 'Opens', 'Opens', 1, 10000, 'web', 'statistics.broadcasts.opens', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(141, 404, 'Clicked', 'Clicked', 1, 10000, 'web', 'statistics.broadcasts.clicked', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(142, 404, 'Un-Subscribed', 'Un-Subscribed', 1, 10000, 'web', 'statistics.broadcasts.unsubscribed', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(143, 404, 'Complaints', 'Complaints', 1, 10000, 'web', 'statistics.broadcasts.complaints', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(150, 37, 'Add Email Template', 'Add Email Template', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(151, 37, 'View Email Templates', 'View Email Templates', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(152, 37, 'Edit', 'Edit', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(153, 37, 'Copy', 'Copy', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(154, 37, 'Delete', 'Delete', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(156, 38, 'Export to Campaign', 'Export to Campaign', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(157, 38, 'View as HTML', 'View as HTML', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(159, 288, 'View PowerMTA', 'View PowerMTA', 1, 1, 'web', 'getPmtas', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(160, 288, 'View configuration', 'View configuration', 1, 2, 'web', 'pmta.config.view', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(161, 288, 'Download configuration', 'Download configuration', 1, 3, 'web', 'downloadConfig', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(162, 288, 'Delete PowerMTA', 'Delete PowerMTA', 1, 4, 'web', 'pmta.destroy', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(174, 10, 'View Processed Feedback Loops', 'View Processed Feedback Loops', 1, 10000, 'web', 'processedFbls', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(175, 1, 'User Roles', 'User Roles', 1, 34, 'web', 'package.role.view', 1, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(176, 175, 'Create User Role', 'Create User Role', 1, 10000, 'web', 'package.role.create', 1, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(178, 175, 'Edit', 'Edit', 1, 10000, 'web', 'package.role.edit', 1, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(179, 175, 'Delete', 'Delete', 1, 10000, 'web', 'subuser-role.destroy', 1, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(185, 1, 'Drip Campaigns', 'Drip Campaigns', 1, 12, 'web', 'drips.group.view', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(189, 185, 'Add a drip', 'Add a drip', 1, 5, 'web', 'drips.create', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(193, 187, 'Create Autoresponder Group', 'Create Autoresponder Group', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(194, 188, 'View Autoresponder Groups', 'View Autoresponder Groups', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(195, 188, 'Edit', 'Edit', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(196, 188, 'Delete', 'Delete', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(197, 188, 'Delete All', 'Delete All', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(199, 298, 'Bulk contacts update', 'Bulk contacts update', 1, 8, 'web', 'contact.bulk-update.store', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18')");

            DB::statement("INSERT INTO `permissions` (`id`, `parent_id`, `default_title`, `title`, `is_available`, `sequence`, `route_type`, `route`, `skip_in_acl`, `hidden_in_acl`, `access_level`, `created_at`, `updated_at`) VALUES
(203, 8, 'Get HTML content', 'Get HTML content', 1, 3, 'web', 'form.loadData', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(206, 1, 'Dynamic Content Tags', 'Dynamic Content Tags', 1, 14, 'web', 'dynamictag.index', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(207, 206, 'Add a dynamic content tag', 'Add a dynamic content tag', 1, 1, 'web', 'dynamictag.create', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(211, 206, 'Edit dynamic content tag', 'Edit dynamic content tag', 1, 2, 'web', 'dynamictag.edit', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(212, 206, 'Delete dynamic content tags', 'Delete dynamic content tags', 1, 3, 'web', 'dynamictag.destroy', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(214, 0, 'Staff Management', 'Staff Management', 1, 10000, 'web', '', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(215, 214, 'Add a Staff Person', 'Add a Staff Person', 1, 10000, 'web', 'staff.create', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(218, 217, 'View all Staff Persons', 'View all Staff Persons', 1, 10000, 'web', 'staff.index', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(219, 217, 'Edit', 'Edit', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(220, 217, 'Delete', 'Delete', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(221, 214, 'Staff Roles', 'Staff Roles', 1, 10000, 'web', 'staff.roles.index', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(222, 221, 'Create Staff Role', 'Create Staff Role', 1, 10000, 'web', 'staff.roles.create', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(224, 221, 'Edit', 'Edit', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(225, 221, 'Delete', 'Delete', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(226, 218, 'Delete All', 'Delete All', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(227, 0, 'Client Management', 'Client Management', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(228, 227, 'Add a Client', 'Add a Client', 1, 10000, 'web', 'user.create', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(229, 228, 'Add a Client', 'Add a Client', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(230, 227, 'View all Clients', 'View all Clients', 1, 10000, 'web', 'user.index', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(231, 230, 'View all Clients', 'View all Clients', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(232, 231, 'Edit', 'Edit', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(233, 231, 'Delete', 'Delete', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(234, 231, 'Delete All', 'Delete All', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(239, 236, 'Edit', 'Edit', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(240, 236, 'Delete', 'Delete', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(242, 227, 'Create a package', 'Create a Package', 1, 10000, 'web', 'create.package.page', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(243, 227, 'View Packages', 'View Packages', 1, 10000, 'web', 'client.package.view', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(245, 243, 'Edit', 'Edit', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(246, 243, 'Delete', 'Delete', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(248, 363, 'General Settings', 'General Settings', 1, 10000, 'web', 'setting.general', 1, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(249, 1, 'Multithreading', 'Multithreading', 1, 29, 'web', 'setting.multi-threading', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(250, 247, 'Custom Headers', 'Custom Headers', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(251, 247, 'Notification Center', 'Notification Center', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(252, 247, 'Notification SMTP', 'Notification SMTP', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(253, 247, 'Auto Backup', 'Auto Backup', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(254, 363, 'License Key', 'License Key', 1, 10000, 'web', 'license', 1, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(255, 247, 'User Modules', 'User Modules', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(256, 247, 'Upgrade', 'Upgrade', 1, 10000, 'web', 'setting.update.index', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(257, 248, 'General', 'General', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(258, 248, 'Mail', 'Mail', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(259, 248, 'Database', 'Database', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(261, 250, 'Add Custom Header', 'Add Custom Header', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(262, 250, 'View Custom Header', 'View Custom Header', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(263, 250, 'Edit', 'Edit', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(264, 250, 'Delete', 'Delete', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(265, 251, 'Add Notification', 'Add Notification', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(266, 251, 'View Notifications', 'View Notifications', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(267, 251, 'Edit', 'Edit', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(268, 251, 'Delete', 'Delete', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(269, 252, 'Notification SMTP', 'Notification SMTP', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(270, 253, 'Auto Backup', 'Auto Backup', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(272, 255, 'User Modules', 'User Modules', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(273, 256, 'Upgrade', 'Upgrade', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(275, 363, 'White Labeling', 'White Labeling', 1, 38, 'web', 'setting.whitelabel', 1, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(277, 24, 'Drag & Drop Email Builder', 'Drag & Drop Email Builder', 1, 100001, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(278, 1, 'Evergreen Campaigns', 'Evergreen Campaigns', 0, 17, 'web', NULL, 1, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(279, 11, 'Broadcast statistics', 'Broadcast statistics', 1, 30, 'web', 'statistics.broadcasts.index', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(282, 11, 'Trigger Statistics', 'Trigger Statistics', 1, 33, 'web', 'statistics.trigger.index', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(283, 1, 'API', 'API', 1, 35, 'web', 'api_management', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(284, 1, 'Notification Center', 'Notification Center', 1, 36, 'web', 'notifications', 1, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(285, 1, 'Global Headers', 'Global Headers', 1, 37, 'web', 'setting.header', 1, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(288, 101, 'PowerMTA Integration', 'PowerMTA Integration', 1, 2, 'web', 'pmta.integration.create', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(289, 1, 'Suppression', 'Suppression', 1, 7, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(298, 1, 'Contacts', 'Contacts', 1, 1, 'web', 'contact.index', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(299, 298, 'Add a contact', 'Add a contact', 1, 1, 'web', 'contact.create', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(301, 298, 'Edit contact', 'Edit contact', 1, 4, 'web', 'contact.edit', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(302, 298, 'Delete contacts', 'Delete contacts', 1, 5, 'web', 'contact.destroy', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(304, 5, 'Test Connection', 'Test Connection', 1, 7, 'web', 'node.connection.test', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(305, 5, 'Set as Active/Inactive', 'Set as Active/Inactive', 1, 8, 'web', 'node.status.update', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(352, 185, 'View Drips', 'View Drips', 1, 4, 'web', 'drips.index', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(353, 185, 'Add drip group', 'Add drip group', 1, 1, 'web', 'drips.group.create', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(354, 185, 'Edit drip', 'Edit drip', 1, 6, 'web', 'drips.edit', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(355, 185, 'Delete drips', 'Delete drips', 1, 8, 'web', 'drips.destroy', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(356, 288, 'Rollback PMTA', 'Rollback PMTA', 1, 5, 'web', 'rollbackPmta', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(357, 214, 'Edit Staff', 'Edit Staff', 1, 10000, 'web', 'staff.edit', 1, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(358, 214, 'Delete Staff', 'Delete Staff', 1, 10000, 'web', 'staff.destroy', 1, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(359, 221, 'Edit Staff Role', 'Edit Staff Role', 1, 10000, 'web', 'staff.roles.edit', 1, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(360, 221, 'Delete Staff Role', 'Delete Staff Role', 1, 10000, 'web', 'staff.roles.delete', 1, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(361, 227, 'Edit Package', 'Edit Package', 1, 10000, 'web', 'client.package.edit', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(362, 227, 'Delete Package', 'Delete Package', 1, 10000, 'web', 'client.package.delete', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(363, 1, 'Settings', 'Settings', 1, 10000, 'web', NULL, 1, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(364, 363, 'Cron Settings', 'Cron Settings', 1, 10000, 'web', 'setting.crons', 1, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(365, 363, 'Primary Domain', 'Primary Domain', 1, 10000, 'web', 'setting.primary.domain', 1, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(366, 374, 'Debug Logs', 'Debug Logs', 0, 10000, 'web', 'logViewer', 1, 0, 'super_admin', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(368, 366, 'List Logs', 'List Logs', 0, 10000, 'web', 'logsList', 1, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(369, 366, 'Show by level', 'Show by level', 0, 10000, 'web', 'showByLevel', 1, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(370, 366, 'Show', 'Show', 0, 10000, 'web', 'showLog', 1, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(371, 366, 'Search', 'Search', 0, 10000, 'web', 'searchLog', 1, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(372, 366, 'Download', 'Download', 0, 10000, 'web', 'downloadLog', 1, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(373, 366, 'Delete', 'Delete', 0, 10000, 'web', 'deleteLog', 1, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(374, 375, 'Logs', 'Logs', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(375, 1, 'Tools', 'Tools', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(376, 374, 'Activity Logs', 'Activity Logs', 1, 10000, 'web', 'activity-log.index', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(377, 374, 'Authentication Logs', 'Authentication Logs', 0, 10000, 'web', 'authentication-log', 1, 0, 'super_admin', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(378, 374, 'Callback Logs', 'Callback Logs', 0, 10000, 'web', 'c.index', 1, 0, 'super_admin', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(379, 375, 'Cron Status', 'Cron Status', 0, 10000, 'web', 'cron-status', 1, 0, 'super_admin', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(381, 298, 'View contact details', 'View contact details', 1, 2, 'web', 'getContactDetail', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(382, 298, 'View contact log', 'View contact log', 1, 3, 'web', 'contact.email.history', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(383, 18, 'View segment criteria', 'View segment criteria', 1, 3, 'web', 'viewSegment', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(384, 185, 'Edit drip group', 'Edit drip group', 1, 2, 'web', 'drips.group.edit', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(385, 185, 'Delete drip groups', 'Delete drip groups', 1, 3, 'web', 'drips.group.delete', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(386, 185, 'Make a copy', 'Make a copy', 1, 7, 'web', 'copyDrip', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(387, 4, 'Add a trigger', 'Add a trigger', 1, 1, 'web', 'trigger.create', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(388, 4, 'Edit trigger', 'Edit trigger', 1, 2, 'web', 'trigger.edit', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(389, 4, 'Delete triggers', 'Delete triggers', 1, 3, 'web', 'trigger.destroy', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(390, 8, 'Download web form', 'Download web form', 1, 4, 'web', 'form.html.download', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(391, 101, 'SMTP', 'SMTP', 1, 1, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(392, 101, 'Sendgrid', 'Sendgrid', 1, 3, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(393, 101, 'Mailgun', 'Mailgun', 1, 4, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(394, 101, 'Amazon SES', 'Amazon SES', 1, 6, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(395, 101, 'Sparkpost', 'Sparkpost', 1, 7, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(396, 101, 'Elastic Emai', 'Elastic Emai', 1, 8, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(397, 101, 'Mailjet', 'Mailjet', 1, 9, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(398, 101, 'SMTP2GO', 'SMTP2GO', 1, 10, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(399, 101, 'Postmark', 'Postmark', 1, 11, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(400, 101, 'Gmail', 'Gmail', 1, 12, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(401, 101, 'Outlook', 'Outlook', 1, 13, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(402, 101, 'Yahoo', 'Yahoo', 1, 14, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(403, 101, 'Aol', 'Aol', 1, 14, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(404, 279, 'Detailed Stats', 'Detailed Stats', 1, 1, 'web', 'statistics.broadcasts.detail', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(405, 404, 'Logs Tab', 'Logs Tab', 1, 10000, 'web', 'getBroadcastLogs', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(406, 404, 'A/B', 'A/B', 1, 10000, 'web', 'campaignContent', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(407, 404, 'Export Statistics', 'Export Statistics', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(408, 282, 'Broadcast Stats', 'Broadcast Stats', 1, 1, 'web', 'statistics.triggers.broadcast', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(409, 434, 'Opened', 'Opened', 1, 2, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(410, 434, 'Clicked', 'Clicked', 1, 3, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(411, 434, 'Un-subscribed', 'Un-subscribed', 1, 4, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(412, 434, 'Export statistics', 'Export statistics', 1, 8, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(413, 18, 'View contacts', 'View contacts', 1, 2, 'web', 'viewSegmentSubscribers', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(414, 16, 'Merge into another list', 'Merge into another list', 1, 2, 'web', 'getMergeLists', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(415, 16, 'Move contacts to another list', 'Move contacts to another list', 1, 2, 'web', 'moveList', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(416, 8, 'Make a copy', 'Make a copy', 1, 2, 'web', 'form.copy', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(417, 434, 'Complaints', 'Complaints', 1, 5, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(418, 434, 'Logs Tab', 'Logs Tab', 1, 6, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(419, 434, 'A/B', 'A/B', 1, 7, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(420, 434, 'Bounced', 'Bounced', 1, 1, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(421, 282, 'Drip Statistics', 'Drip Statistics', 1, 2, 'web', 'statistics.triggers.drip', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(422, 421, 'Detailed stats', 'Detailed stats', 1, 1, 'web', 'statistics.triggers.drips.detail', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(423, 422, 'Bounced', 'Bounced', 1, 1, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(424, 422, 'Opened', 'Opened', 1, 2, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(425, 422, 'Clicked', 'Clicked', 1, 3, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(426, 422, 'Un-Subscribed', 'Un-Subscribed', 1, 4, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(427, 422, 'Complaints', 'Complaints', 1, 5, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(428, 422, 'Logs Tab', 'Logs Tab', 1, 6, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(429, 422, 'A/B', 'A/B', 1, 7, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(430, 422, 'Export statistics', 'Export statistics', 1, 8, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(431, 185, 'Start drip campaigns', 'Start drip campaigns', 1, 9, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(432, 18, 'Schedule broadcast to a segment', 'Schedule broadcast to a segment', 1, 2, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(433, 26, 'Schedule a split test', 'Schedule a split test', 1, 10000, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(434, 408, 'Detailed Stats', 'Detailed Stats', 1, 1, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(474, 185, 'Copy drip', 'Copy drip', 1, 6, 'web', 'drip.copy', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(475, 374, 'DB Check', 'DB Check', 0, 10000, 'web', 'dbcheck', 1, 0, 'super_admin', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(476, 374, 'PHP Info', 'PHP Info', 0, 10000, 'web', 'phpInfo', 1, 0, 'super_admin', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(477, 1, 'Addons', 'Addons', 1, 29, 'web', 'addons', 1, 0, 'super_admin', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(478, 93, 'Delete Multiple schedule Campaigns', 'Delete Multiple schedule Campaigns', 1, 1, 'web', 'delete.selected.schedule.campaigns', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(479, 101, 'Mumara One', 'Mumara One', 1, 15, 'web', NULL, 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(482, 375, 'Exported Files', 'Exported Files', 1, 10000, 'web', 'exported.files', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(483, 482, 'Delete Exported File', 'Delete Exported File', 1, 10000, 'web', 'delete.exported.file', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(484, 482, 'Delete All Exported Files', 'Delete All Exported Files', 1, 10000, 'web', 'delete.exported.all.file', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(485, 482, 'Download Exported Files', 'Download Exported Files', 1, 10000, 'web', 'suppression.export.download.csv', 0, 0, 'all', '2022-09-09 10:23:18', '2022-09-09 10:23:18'),
(487, 375, 'Activity Logs', 'Activity Logs', 0, 10000, 'web', 'activity-log.index', 1, 0, 'all', '2022-09-13 08:59:57', '2022-09-09 10:23:18'),
(490, 8, 'Templates', 'Templates', 1, 27, 'web', 'view.web.form.design', 0, 0, 'all', '2022-09-13 09:01:37', '2022-09-09 10:23:18'),
(491, 490, 'Add Template', 'Add Template ', 1, 2, 'web', 'create.web.form.design', 0, 0, 'all', '2022-09-13 09:01:37', '2022-09-09 10:23:18'),
(492, 490, 'Make a copy', 'Make a copy', 1, 2, 'web', 'make.a.copy', 0, 0, 'all', '2022-09-13 09:01:37', '2022-09-09 10:23:18'),
(493, 8, 'Copy Post URL', 'Copy Post URL', 1, 3, 'web', 'get.form.url', 0, 0, 'all', '2022-09-13 09:01:37', '2022-09-09 10:23:18'),
(495, 11, 'Evergreen statistics', 'Evergreen statistics', 1, 30, 'web', 'statistics.evergreen.index', 0, 0, 'all', '2022-12-29 13:01:45', '2022-12-29 13:01:45'),
(496, 278, 'Add Evergreen Campaign', 'Add Evergreen Campaign', 1, 1, 'web', 'campaign.evergreen.create', 0, 0, 'all', '2022-12-29 13:01:45', '2022-12-29 13:01:45'),
(497, 278, 'Edit Evergreen Campaigns', 'Edit Evergreen Campaigns', 1, 2, 'web', 'edit.evergreen', 0, 0, 'all', '2022-12-29 13:01:45', '2022-12-29 13:01:45'),
(498, 278, 'Delete Evergreen Campaigns', 'Delete Evergreen Campaigns', 1, 3, 'web', 'delete.evergreen', 0, 0, 'all', '2022-12-29 13:01:45', '2022-12-29 13:01:45');");
        }
        else
        {
            if (!Schema::hasColumn('permissions', 'id')) {
                Schema::table('permissions', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('permissions', 'parent_id')) {
                Schema::table('permissions', function (Blueprint $table) {
                    $table->integer('parent_id')->nullable();
                });
            }
            if (!Schema::hasColumn('permissions', 'default_title')) {
                Schema::table('permissions', function (Blueprint $table) {
                    $table->string('default_title', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('permissions', 'title')) {
                Schema::table('permissions', function (Blueprint $table) {
                    $table->string('title', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('permissions', 'is_available')) {
                Schema::table('permissions', function (Blueprint $table) {
                    $table->boolean('is_available')->default(true);
                });
            }
            if (!Schema::hasColumn('permissions', 'sequence')) {
                Schema::table('permissions', function (Blueprint $table) {
                    $table->integer('sequence')->default(10000);
                });
            }
            if (!Schema::hasColumn('permissions', 'route_type')) {
                Schema::table('permissions', function (Blueprint $table) {
                    $table->enum('route_type', ['web', 'api'])->default('web');
                });
            }
            if (!Schema::hasColumn('permissions', 'route')) {
                Schema::table('permissions', function (Blueprint $table) {
                    $table->string('route', 255)->nullable();
                });
            }
            if (!Schema::hasColumn('permissions', 'skip_in_acl')) {
                Schema::table('permissions', function (Blueprint $table) {
                    $table->boolean('skip_in_acl')->default(false);
                });
            }
            if (!Schema::hasColumn('permissions', 'hidden_in_acl')) {
                Schema::table('permissions', function (Blueprint $table) {
                    $table->boolean('hidden_in_acl')->default(false);
                });
            }
            if (!Schema::hasColumn('permissions', 'access_level')) {
                Schema::table('permissions', function (Blueprint $table) {
                    $table->enum('access_level', ['super_admin', 'admin', 'all'])->default('all');
                });
            }
            if (!Schema::hasColumn('permissions', 'created_at')) {
                Schema::table('permissions', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('permissions', 'updated_at')) {
                Schema::table('permissions', function (Blueprint $table) {
                   $table->timestamp('updated_at')->useCurrentOnUpdate();
                });
            }

        }
        //api permission
        \App\Permission::where('route_type','api')->delete();
        $list_parent = addParentPermission('List Management','1','api','0','0','all','1','0');
        if(!is_null($list_parent)) {
            addChildPermission('Add New List', '1', 'api', '0', '0', 'all', '1', 'addList', $list_parent->id);
            addChildPermission('View List', '1', 'api', '0', '0', 'all', '2', 'getList', $list_parent->id);
            addChildPermission('Views Lists', '1', 'api', '0', '0', 'all', '3', 'getLists', $list_parent->id);
            addChildPermission('Edit', '1', 'api', '0', '0', 'all', '4', 'updateList', $list_parent->id);
            addChildPermission('Delete', '1', 'api', '0', '0', 'all', '5', 'deleteList', $list_parent->id);
            addChildPermission('Delete List Group', '1', 'api', '0', '0', 'all', '6', 'deleteListGroup', $list_parent->id);
            addChildPermission('Get List Groups', '1', 'api', '0', '0', 'all', '7', 'getListGroups', $list_parent->id);
        }
        $contact_parent = addParentPermission('Contact Management','1','api','0','0','all','2','0');
        if(!is_null($contact_parent)) {
            addChildPermission('Add Contact', '1', 'api', '0', '0', 'all', '1', 'addContact', $contact_parent->id);
            addChildPermission('View Contact By Id', '1', 'api', '0', '0', 'all', '2', 'getSubscriber', $contact_parent->id);
            addChildPermission('View Contacts', '1', 'api', '0', '0', 'all', '3', 'getSubscribers', $contact_parent->id);
            addChildPermission('Delete Contact By Id', '1', 'api', '0', '0', 'all', '4', 'deleteSubscriber', $contact_parent->id);
            addChildPermission('Delete Contact By Email', '1', 'api', '0', '0', 'all', '5', 'deleteContactByEmail', $contact_parent->id);
            addChildPermission('Edit By Id', '1', 'api', '0', '0', 'all', '6', 'updateSubscriber', $contact_parent->id);
            addChildPermission('Edit By Email', '1', 'api', '0', '0', 'all', '7', 'updateContactByEmail', $contact_parent->id);
            addChildPermission('Mark as Complaint', '1', 'api', '0', '0', 'all', '8', 'markAsComplaint', $contact_parent->id);
            addChildPermission('Mark as Unsubscribed', '1', 'api', '0', '0', 'all', '9', 'markAsBounced', $contact_parent->id);
            addChildPermission('Mark as Bounced', '1', 'api', '0', '0', 'all', '10', 'markAsUnsubscribed', $contact_parent->id);
            addChildPermission('Import Contact List', '1', 'api', '0', '0', 'all', '11', 'importContacts', $contact_parent->id);
        }
        $broadcast_parent = addParentPermission('Broadcast Management','1','api','0','0','all','3','0');
        if(!is_null($broadcast_parent)) {
            addChildPermission('Add Broadcast', '1', 'api', '0', '0', 'all', '1', 'createCampaign', $broadcast_parent->id);
            addChildPermission('View Campaign By Id', '1', 'api', '0', '0', 'all', '2', 'getCampaign', $broadcast_parent->id);
            addChildPermission('View Campaigns', '1', 'api', '0', '0', 'all', '3', 'getCampaigns', $broadcast_parent->id);
            addChildPermission('Edit', '1', 'api', '0', '0', 'all', '4', 'updateCampaign', $broadcast_parent->id);
            addChildPermission('Delete', '1', 'api', '0', '0', 'all', '5', 'deleteCampaign', $broadcast_parent->id);
            addChildPermission('Get Broadcast Groups', '1', 'api', '0', '0', 'all', '6', 'getBroadcastGroups', $broadcast_parent->id);
            addChildPermission('Get Scheduled Broadcasts', '1', 'api', '0', '0', 'all', '7', 'getScheduledBroadcasts', $broadcast_parent->id);
            addChildPermission('Add A Drip', '1', 'api', '0', '0', 'all', '8', 'addADrip', $broadcast_parent->id);
        }
        $custom_fields_parent = addParentPermission('Custom Fields','1','api','0','0','all','4','0');
        if(!is_null($custom_fields_parent)) {
            addChildPermission('Add Custom Field To List', '1', 'api', '0', '0', 'all', '1', 'addCustomFieldToList', $custom_fields_parent->id);
            addChildPermission('Add Custom Field', '1', 'api', '0', '0', 'all', '2', 'addCustomField', $custom_fields_parent->id);
            addChildPermission('View By Id', '1', 'api', '0', '0', 'all', '3', 'getCustomField', $custom_fields_parent->id);
            addChildPermission('View List Custom fields', '1', 'api', '0', '0', 'all', '4', 'getListCustomFields', $custom_fields_parent->id);
            addChildPermission('View Custom fields', '1', 'api', '0', '0', 'all', '5', 'getCustomFields', $custom_fields_parent->id);
            addChildPermission('Edit', '1', 'api', '0', '0', 'all', '6', 'updateCustomField', $custom_fields_parent->id);
            addChildPermission('Delete', '1', 'api', '0', '0', 'all', '7', 'deleteCustomField', $custom_fields_parent->id);
        }
        $suppression_parent = addParentPermission('Suppression','1','api','0','0','all','5','0');
        if(!is_null($suppression_parent)) {
            addChildPermission('Suppress', '1', 'api', '0', '0', 'all', '1', 'suppress', $suppression_parent->id);
            addChildPermission('View', '1', 'api', '0', '0', 'all', '2', 'getSuppressed', $suppression_parent->id);
            addChildPermission('Delete', '1', 'api', '0', '0', 'all', '3', 'deleteSuppresses', $suppression_parent->id);
        }
        $actions_parent = addParentPermission('Actions','1','api','0','0','all','6','0');
        if(!is_null($actions_parent)) {
            addChildPermission('Schedule Broadcast', '1', 'api', '0', '0', 'all', '1', 'broadcastSchedule', $actions_parent->id);
            addChildPermission('Add A Trigger', '1', 'api', '0', '0', 'all', '2', 'addATrigger', $actions_parent->id);
        }
        $bounce_addresses_parent = addParentPermission('Bounce Addresses','1','api','0','0','all','7','0');
        if(!is_null($bounce_addresses_parent)) {
            addChildPermission('Add Bounce Account', '1', 'api', '0', '0', 'all', '1', 'addBounceMailboxes', $bounce_addresses_parent->id);
            addChildPermission('View Bounce Accounts', '1', 'api', '0', '0', 'all', '2', 'getBounceMailboxes', $bounce_addresses_parent->id);
            addChildPermission('Edit Bounce Account', '1', 'api', '0', '0', 'all', '3', 'updateBounceMailboxes', $bounce_addresses_parent->id);
            addChildPermission('Delete Bounce Account(s)', '1', 'api', '0', '0', 'all', '4', 'deleteBounceMailboxes', $bounce_addresses_parent->id);
        }
        $fbl_addresses_parent = addParentPermission('FBL Addresses','1','api','0','0','super_admin','8','0');
        if(!is_null($fbl_addresses_parent)) {
            addChildPermission('Add FBL Account', '1', 'api', '0', '0', 'super_admin', '1', 'addFBLAccount', $fbl_addresses_parent->id);
            addChildPermission('View FBL Account', '1', 'api', '0', '0', 'super_admin', '2', 'getFBLAccounts', $fbl_addresses_parent->id);
            addChildPermission('Edit FBL Account', '1', 'api', '0', '0', 'super_admin', '3', 'updateFBLAccount', $fbl_addresses_parent->id);
            addChildPermission('Delete FBL Account(s)', '1', 'api', '0', '0', 'super_admin', '4', 'deleteFBLAccounts', $fbl_addresses_parent->id);
        }
        $spintags_parent = addParentPermission('Spintags','1','api','0','0','all','9','0');
        if(!is_null($spintags_parent)) {
            addChildPermission('Add Spintag', '1', 'api', '0', '0', 'all', '1', 'addSpinTag', $spintags_parent->id);
            addChildPermission('View Spintags', '1', 'api', '0', '0', 'all', '2', 'getSpinTags', $spintags_parent->id);
            addChildPermission('Edit Spintag', '1', 'api', '0', '0', 'all', '3', 'updateSpinTag', $spintags_parent->id);
            addChildPermission('Delete Spintag(s)', '1', 'api', '0', '0', 'all', '4', 'deleteSpinTags', $spintags_parent->id);
        }
        $bounce_rules_parent = addParentPermission('Bounce Rules','1','api','0','0','super_admin','10','0');
        if(!is_null($bounce_rules_parent)) {
            addChildPermission('Add Bounce Rule', '1', 'api', '0', '0', 'super_admin', '1', 'addBounceRule', $bounce_rules_parent->id);
            addChildPermission('View Bounce Rules', '1', 'api', '0', '0', 'super_admin', '2', 'getBounceRules', $bounce_rules_parent->id);
            addChildPermission('Edit Bounce Rule', '1', 'api', '0', '0', 'super_admin', '3', 'updateBounceRule', $bounce_rules_parent->id);
            addChildPermission('Delete Bounce Rule(s)', '1', 'api', '0', '0', 'super_admin', '4', 'deleteBounceRules', $bounce_rules_parent->id);
        }
        $sending_domain_parent = addParentPermission('Sending Domain','1','api','0','0','all','11','0');
        if(!is_null($sending_domain_parent)) {
            addChildPermission('Add Sending Domain', '1', 'api', '0', '0', 'all', '1', 'addSendingDomain', $sending_domain_parent->id);
            addChildPermission('Get Sending Domains', '1', 'api', '0', '0', 'all', '2', 'getSendingDomains', $sending_domain_parent->id);
        }
        $broadcast_statistics_parent = addParentPermission('Broadcast Statistics','1','api','0','0','all','12','0');
        if(!is_null($broadcast_statistics_parent)) {
            addChildPermission('Summary', '1', 'api', '0', '0', 'all', '1', 'getStatsSummary', $broadcast_statistics_parent->id);
            addChildPermission('Bounced', '1', 'api', '0', '0', 'all', '2', 'getStatsBounces', $broadcast_statistics_parent->id);
            addChildPermission('Opened', '1', 'api', '0', '0', 'all', '3', 'getStatsOpens', $broadcast_statistics_parent->id);
            addChildPermission('Clicked', '1', 'api', '0', '0', 'all', '4', 'getStatsClicks', $broadcast_statistics_parent->id);
            addChildPermission('Unsubscribed', '1', 'api', '0', '0', 'all', '5', 'getStatsUnsubscribes', $broadcast_statistics_parent->id);
            addChildPermission('Complaints', '1', 'api', '0', '0', 'all', '6', 'getStatsComplaints', $broadcast_statistics_parent->id);
            addChildPermission('Logs', '1', 'api', '0', '0', 'all', '7', 'getStatsLogs', $broadcast_statistics_parent->id);
            addChildPermission('Get Broadcast Stats Global', '1', 'api', '0', '0', 'all', '8', 'getGlobalStats', $broadcast_statistics_parent->id);
            addChildPermission('Get Logs By ID(s)', '1', 'api', '0', '0', 'all', '9', 'getLogsByIds', $broadcast_statistics_parent->id);
        }
        $logs_parent = addParentPermission('Logs','1','api','0','0','all','13','0');
        if(!is_null($logs_parent)) {
            addChildPermission('Activity Logs', '1', 'api', '0', '0', 'all', '1', 'getActivityLogs', $logs_parent->id);
        }
        $user_management_parent = addParentPermission('User Management','1','api','0','0','super_admin','14','0');
        if(!is_null($user_management_parent)) {
            addChildPermission('Add User', '1', 'api', '0', '0', 'super_admin', '1', 'createUser', $user_management_parent->id);
            addChildPermission('Edit User', '1', 'api', '0', '0', 'super_admin', '1', 'updateUser', $user_management_parent->id);
            addChildPermission('Delete User', '1', 'api', '0', '0', 'super_admin', '1', 'deleteUser', $user_management_parent->id);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('permissions');
    }

}
;
