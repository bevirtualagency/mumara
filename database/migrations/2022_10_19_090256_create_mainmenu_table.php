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
        if (!Schema::hasTable('mainmenu')) {
            Schema::create('mainmenu', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('parent_id')->nullable();
                $table->string('module_name', 255)->nullable();
                $table->text('routes')->nullable();
                $table->string('link', 100)->nullable();
                $table->integer('sequence')->nullable();
                $table->text('permission')->nullable();
                $table->text('icons')->nullable();
                $table->tinyInteger('type')->nullable()->default(0);
                $table->tinyInteger('is_view')->nullable()->default(1);
                $table->tinyInteger('new_flag')->nullable()->default(0);
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            });

            DB::statement("INSERT INTO `mainmenu` (`id`, `parent_id`, `module_name`, `routes`, `link`, `sequence`, `permission`, `icons`, `type`, `is_view`, `new_flag`, `created_at`, `updated_at`) VALUES
(1, 0, 'lists.title', 'lists||list/add||list/{list}/edit||list/{list}||list-management/{list}||fields||field/add||field/{field}/edit||segments||segment/add||segments/*||suppression-email||suppression-domain||suppression-ip||segments/view-segment/{id}||segments/export/{id}||segments/subscribers/{id}', '#', 1, NULL, '<svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\" class=\"kt-svg-icon\">\r\n <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\r\n <rect id=\"bound\" x=\"0\" y=\"0\" width=\"24\" height=\"24\"/>\r\n <path d=\"M10.5,5 L19.5,5 C20.3284271,5 21,5.67157288 21,6.5 C21,7.32842712 20.3284271,8 19.5,8 L10.5,8 C9.67157288,8 9,7.32842712 9,6.5 C9,5.67157288 9.67157288,5 10.5,5 Z M10.5,10 L19.5,10 C20.3284271,10 21,10.6715729 21,11.5 C21,12.3284271 20.3284271,13 19.5,13 L10.5,13 C9.67157288,13 9,12.3284271 9,11.5 C9,10.6715729 9.67157288,10 10.5,10 Z M10.5,15 L19.5,15 C20.3284271,15 21,15.6715729 21,16.5 C21,17.3284271 20.3284271,18 19.5,18 L10.5,18 C9.67157288,18 9,17.3284271 9,16.5 C9,15.6715729 9.67157288,15 10.5,15 Z\" id=\"Combined-Shape\" fill=\"#000000\"/>\r\n <path d=\"M5.5,8 C4.67157288,8 4,7.32842712 4,6.5 C4,5.67157288 4.67157288,5 5.5,5 C6.32842712,5 7,5.67157288 7,6.5 C7,7.32842712 6.32842712,8 5.5,8 Z M5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 C6.32842712,10 7,10.6715729 7,11.5 C7,12.3284271 6.32842712,13 5.5,13 Z M5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 C6.32842712,15 7,15.6715729 7,16.5 C7,17.3284271 6.32842712,18 5.5,18 Z\" id=\"Combined-Shape\" fill=\"#000000\" opacity=\"0.3\"/>\r\n </g>\r\n</svg>', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(2, 0, 'contacts.title', 'contacts||contact/{contact}||contact/{contact}/edit||contact/add||contacts/import||contacts/update||contact/email/history/{id?}||contact/list/{id}||list/{id}/contact/add||list/{id}/contacts||list/{id}/contacts/import', '#', 2, NULL, '<svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\" class=\"kt-svg-icon\">\r\n <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\r\n <rect id=\"bound\" x=\"0\" y=\"0\" width=\"24\" height=\"24\"/>\r\n <path d=\"M5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z\" id=\"Combined-Shape\" fill=\"#000000\"/>\r\n </g>\r\n</svg>', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(3, 0, 'broadcasts.title', 'broadcasts||broadcast/{id}/edit||broadcast/add||broadcast/add/{id}||broadcast/schedule||spintags||dynamictags||dynamictag/{id}/edit||drips||drips/*||drip/group/view||drip/group/{id}/edit||drip/group/add||drip/add||splittests||splittest/{id}/edit||splittest/add||schedule/new/*||spintag/add||dynamictag/add||scheduled||broadcasts/schedule||spintag/{id}/edit||broadcast/create/{id}||drip/{id}/edit||scheduled/{type?}', '#', 3, NULL, '<svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\" class=\"kt-svg-icon\">\r\n <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\r\n <polygon id=\"Shape\" points=\"0 0 24 0 24 24 0 24\"/>\r\n <rect id=\"Rectangle\" fill=\"#000000\" opacity=\"0.3\" transform=\"translate(13.000000, 6.000000) rotate(-450.000000) translate(-13.000000, -6.000000) \" x=\"12\" y=\"8.8817842e-16\" width=\"2\" height=\"12\" rx=\"1\"/>\r\n <path d=\"M9.79289322,3.79289322 C10.1834175,3.40236893 10.8165825,3.40236893 11.2071068,3.79289322 C11.5976311,4.18341751 11.5976311,4.81658249 11.2071068,5.20710678 L8.20710678,8.20710678 C7.81658249,8.59763107 7.18341751,8.59763107 6.79289322,8.20710678 L3.79289322,5.20710678 C3.40236893,4.81658249 3.40236893,4.18341751 3.79289322,3.79289322 C4.18341751,3.40236893 4.81658249,3.40236893 5.20710678,3.79289322 L7.5,6.08578644 L9.79289322,3.79289322 Z\" id=\"Path-104\" fill=\"#000000\" fill-rule=\"nonzero\" transform=\"translate(7.500000, 6.000000) rotate(-270.000000) translate(-7.500000, -6.000000) \"/>\r\n <rect id=\"Rectangle-Copy\" fill=\"#000000\" opacity=\"0.3\" transform=\"translate(11.000000, 18.000000) scale(1, -1) rotate(90.000000) translate(-11.000000, -18.000000) \" x=\"10\" y=\"12\" width=\"2\" height=\"12\" rx=\"1\"/>\r\n <path d=\"M18.7928932,15.7928932 C19.1834175,15.4023689 19.8165825,15.4023689 20.2071068,15.7928932 C20.5976311,16.1834175 20.5976311,16.8165825 20.2071068,17.2071068 L17.2071068,20.2071068 C16.8165825,20.5976311 16.1834175,20.5976311 15.7928932,20.2071068 L12.7928932,17.2071068 C12.4023689,16.8165825 12.4023689,16.1834175 12.7928932,15.7928932 C13.1834175,15.4023689 13.8165825,15.4023689 14.2071068,15.7928932 L16.5,18.0857864 L18.7928932,15.7928932 Z\" id=\"Path-104-Copy\" fill=\"#000000\" fill-rule=\"nonzero\" transform=\"translate(16.500000, 18.000000) scale(1, -1) rotate(270.000000) translate(-16.500000, -18.000000) \"/>\r\n </g>\r\n</svg>', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(4, 0, 'common.label.actions', 'schedule/new/{id?}||triggers||trigger/{id}/edit||trigger/add||campaign/schedule/{id?}', '#', 4, NULL, '<svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\" class=\"kt-svg-icon\">\r\n <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\r\n <rect id=\"bound\" x=\"0\" y=\"0\" width=\"24\" height=\"24\"></rect>\r\n <path d=\"M8,13.1668961 L20.4470385,11.9999863 L8,10.8330764 L8,5.77181995 C8,5.70108058 8.01501031,5.63114635 8.04403925,5.56663761 C8.15735832,5.31481744 8.45336217,5.20254012 8.70518234,5.31585919 L22.545552,11.5440255 C22.6569791,11.5941677 22.7461882,11.6833768 22.7963304,11.794804 C22.9096495,12.0466241 22.7973722,12.342628 22.545552,12.455947 L8.70518234,18.6841134 C8.64067359,18.7131423 8.57073936,18.7281526 8.5,18.7281526 C8.22385763,18.7281526 8,18.504295 8,18.2281526 L8,13.1668961 Z\" id=\"Combined-Shape\" fill=\"#000000\"></path>\r\n <path d=\"M4,16 L5,16 C5.55228475,16 6,16.4477153 6,17 C6,17.5522847 5.55228475,18 5,18 L4,18 C3.44771525,18 3,17.5522847 3,17 C3,16.4477153 3.44771525,16 4,16 Z M1,11 L5,11 C5.55228475,11 6,11.4477153 6,12 C6,12.5522847 5.55228475,13 5,13 L1,13 C0.44771525,13 6.76353751e-17,12.5522847 0,12 C-6.76353751e-17,11.4477153 0.44771525,11 1,11 Z M4,6 L5,6 C5.55228475,6 6,6.44771525 6,7 C6,7.55228475 5.55228475,8 5,8 L4,8 C3.44771525,8 3,7.55228475 3,7 C3,6.44771525 3.44771525,6 4,6 Z\" id=\"Combined-Shape\" fill=\"#000000\" opacity=\"0.3\"></path>\r\n </g>\r\n</svg>', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(5, 0, 'common.label.setup', 'bounce/mailbox/{id}/edit||bounce/mailboxes||bounce/rule/{id}/edit||bounce/rules||domain/{id}/edit||domains||node/{type}/{id}/edit||nodes||form/{id}/edit||forms||fbls||staff/role/*||staff/role||staff/*||staff/roles||staff/role/add||staff/administrators||threads/*||bounce/mailbox/add||bounce/rule/add||domain/add||node/list/view||pmta/integration/create||fbl/add||staff/administrator/add||threads||node/add/{id}||pmta/config/view/{id}||form/add/{design_id?}||fbl/{id}/edit||staff/administrator/{staff}/edit||threads/{id?}||staff/role/{id}/edit||setup/processed-fbls/{id?}||node/{id}/add||staff/administrator/{id}/edit||addons/all||node/add||node/{id}/edit||view-web-form-designs||create-web-form-design/{id?}||forms/template', '#', 5, NULL, '<svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\" class=\"kt-svg-icon\">\r\n <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\r\n <rect id=\"bound\" x=\"0\" y=\"0\" width=\"24\" height=\"24\"></rect>\r\n <path d=\"M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z\" id=\"Combined-Shape\" fill=\"#000000\"></path>\r\n <path d=\"M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z\" id=\"Combined-Shape\" fill=\"#000000\" opacity=\"0.3\"></path>\r\n </g>\r\n</svg>', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(6, 0, 'users.page.title', 'users||user/add||clients/*||clients||user/{id}/edit||client/create||client/package/{id}/edit||clients/packages||client/package||package/role/{id}/edit||client/package/add||package/role/view||package/role/add', '#', 6, '-1', '<svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\" class=\"kt-svg-icon\">\r\n <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\r\n <polygon id=\"Shape\" points=\"0 0 24 0 24 24 0 24\"/>\r\n <path d=\"M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z\" id=\"Mask\" fill=\"#000000\" fill-rule=\"nonzero\" opacity=\"0.3\"/>\r\n <path d=\"M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z\" id=\"Mask-Copy\" fill=\"#000000\" fill-rule=\"nonzero\"/>\r\n </g>\r\n</svg>', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(7, 0, 'settings.title', 'setting/general||settings/cron||settings/headers/{id?}||email-template||email-template/*||setting/notification||setting/notification/*||settings/api/keys||settings/whitelabel||settings/license||settings/primary/domain||settings/api/keys/{id?}', '#', 7, NULL, '<svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\" class=\"kt-svg-icon\">\r\n <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\r\n <rect id=\"bound\" x=\"0\" y=\"0\" width=\"24\" height=\"24\"/>\r\n <path d=\"M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z\" id=\"Combined-Shape\" fill=\"#000000\"/>\r\n </g>\r\n</svg>', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(8, 0, 'statistics.title', 'statistics/broadcasts/details/{campaign_schedule_id}||statistics/broadcasts||statistics/drips||statistics/triggers||statistics/drips/details/{autoresponder_id}||statistics/triggers/drip/{triggerId}/{dripId}||statistics/triggers/drips/{campaign_schedule_id}', '#', 8, NULL, '<svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\" class=\"kt-svg-icon\">\r\n <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\r\n <rect id=\"bound\" x=\"0\" y=\"0\" width=\"24\" height=\"24\"/>\r\n <rect id=\"Rectangle-62-Copy\" fill=\"#000000\" opacity=\"0.3\" x=\"7\" y=\"4\" width=\"3\" height=\"13\" rx=\"1.5\"/>\r\n <rect id=\"Rectangle-62-Copy-2\" fill=\"#000000\" opacity=\"0.3\" x=\"12\" y=\"9\" width=\"3\" height=\"8\" rx=\"1.5\"/>\r\n <path d=\"M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z\" id=\"Path-95\" fill=\"#000000\" fill-rule=\"nonzero\"/>\r\n <rect id=\"Rectangle-62-Copy-4\" fill=\"#000000\" opacity=\"0.3\" x=\"17\" y=\"11\" width=\"3\" height=\"6\" rx=\"1.5\"/>\r\n </g>\r\n</svg>', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(9, 0, 'tools.title', 'setting/update||cron/status||bugs/list||tools/logs/debug||tools/logs/access||tools/logs/callbacks||phpinfo||dbcheck||tools/logs/debug/list||tools/logs/debug/{date}/{level}||tools/logs/authentication||tools/logs/failedJobs||tools/exported/files', '#', 9, '375', '<svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"24px\" height=\"24px\" viewBox=\"0 0 24 24\" version=\"1.1\" class=\"kt-svg-icon\">\r\n <g stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\">\r\n <rect id=\"bound\" x=\"0\" y=\"0\" width=\"24\" height=\"24\"></rect>\r\n <rect id=\"Rectangle-7\" fill=\"#000000\" x=\"4\" y=\"4\" width=\"7\" height=\"7\" rx=\"1.5\"></rect>\r\n <path d=\"M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z\" id=\"Combined-Shape\" fill=\"#000000\" opacity=\"0.3\"></path>\r\n </g>\r\n</svg>', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(10, 1, 'lists.add_new.page.title', 'list/add', 'list.create', 1, '45', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(11, 1, 'lists.contact_lists.page.title', 'lists||list/{list}/edit', 'list.index', 2, '16', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(12, 1, 'custom_fields.page.title', 'fields||field/{field}||field/add||field/{field}/edit', 'fields.index', 3, '17', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(13, 1, 'segments.page.title', 'segments||segment/*||segment/add||segments/view-segment/{id}||segments/export/{id}||segments/subscribers/{id}', 'segments.index', 4, '18', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(14, 1, 'suppression.title', 'suppression-email||suppression-email/*||suppression-domain||suppression-domain/*||suppression-ip||suppression-ip/*', '#', 5, '289', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(15, 14, 'suppression.email.page.title', 'suppression-email||suppression-email/*', 'suppression-email.index', 1, '19', 'kt-menu__link-bullet kt-menu__link-bullet--line', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(16, 14, 'suppression.domain.page.title', 'suppression-domain||suppression-domain/*', 'suppression-domain.index', 2, '20', 'kt-menu__link-bullet kt-menu__link-bullet--line', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(17, 14, 'suppression.ip.page.title', 'suppression-ip||suppression-ip/*', 'suppression-ip.index', 3, '21', 'kt-menu__link-bullet kt-menu__link-bullet--line', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(18, 2, 'contacts.add_new.page.title', 'contact/add||list/{id}/contact/add', 'contact.create', 1, '299', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(19, 2, 'contacts.page.title', 'contacts||contact/list/{contact}||contact/email/history/*||contact/{contact}/edit||contact/email/history/{id?}||contact/list/{id}||list/{id}/contacts', 'contact.index', 2, '298', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(20, 2, 'contacts.import_contacts', 'contacts/import||list/{id}/contacts/import', 'contact.import', 3, '23', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(21, 2, 'contacts.bulk_update.page.title', 'contacts/update', 'contact.bulk-update', 4, '199', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(22, 3, 'broadcasts.page.title', 'broadcasts||broadcast/{id}/edit||broadcast/add||broadcast/add/{id}', 'broadcasts.index', 1, '24', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(23, 3, 'evergreen.menu_title', 'campaign/evergreen-campaign-view', 'campaign.evergreen.index', 2, '278', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 0, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(24, 3, 'drip_campaigns.page.title', 'drips||drip/group/{id}||drips||drip/add||drip/group/view||drip/group/add||drip/group/{id}/edit||drip/{id}/edit', 'drips.group.view', 3, '185', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(26, 3, 'split_tests.page.title', 'splittests||splittest/{id}/edit||splittest/add', 'splittest.index', 5, '26', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(27, 3, 'spintags.page.title', 'spintags||spintag/{id}/edit||spintag/add', 'spintag.index', 6, '9', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(28, 3, 'dynamictags.page.title', 'dynamictags||dynamictag/{id}/edit||dynamictag/add', 'dynamictag.index', 7, '206', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(29, 3, 'schedule_broadcast.view.page.title', 'scheduled||broadcasts/schedule/view/{type?}', 'broadcast.schedule.view.all', 8, '93', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(30, 4, 'schedule_broadcast.schedule', 'schedule/new/{id?}||campaign/schedule/{id?}', 'broadcast.schedule.create', 1, '25', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(31, 4, 'triggers.title', 'triggers||trigger/{id}/edit||trigger/add', 'trigger.index', 2, '4', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(32, 5, 'bounce_addresses.page.title', 'bounce/mailboxes||bounce/mailbox/{id}/edit||bounce/mailbox/add', 'bounce.index', 1, '28', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(33, 5, 'bounce_rules.page.title', 'bounce/rules||bounce/rule/{id}/edit||bounce/rule/add', 'bounce-rules.index', 2, '29', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(34, 5, 'sending_domains.page.title', 'domains||domain/{id}/edit||domain/add', 'domain.index', 3, '7', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(35, 5, 'sending_nodes.page.title', 'nodes||node/{type}/{id}/edit||node/list/view||pmta/integration/create||node/{id}/add||pmta/config/view/{id}||node/add||node/{id}/edit', 'node.index', 4, '5', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(36, 5, 'web_forms.page.title', 'forms||form/add/{design_id?}||form/{id}/edit||view-web-form-designs||create-web-form-design/{id?}||forms/template', 'form.index', 5, '8', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(37, 5, 'fbl.page.title', 'fbls||fbl/add||fbl/{id}/edit||setup/processed-fbls/{id?}', 'fbl.index', 6, '10', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(38, 5, 'staff.title', 'staff/administrator/add||staff/roles||staff/administrators||staff/*||staff/role/add||staff/administrator/{id}/edit||staff/role/{id}/edit', '#', 7, '214', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(39, 38, 'staff.admin.page.title', 'staff/administrator/add||staff/administrators||staff/administrator/{id}/edit||staff/{staff}/edit', 'staff.index', 1, '217', 'kt-menu__link-bullet kt-menu__link-bullet--line', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(40, 38, 'staff.role.page.title', 'staff/roles||staff/role/add||staff/role/{id}/edit', 'staff.roles.index', 2, '221', 'kt-menu__link-bullet kt-menu__link-bullet--line', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(41, 5, 'multithreading.page.title', 'threads/*||threads||threads/{id?}', 'setting.multi-threading', 8, '249', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(42, 6, 'users.page.title', 'users||user/add||user/{id}/edit', 'clients.index', 1, '230', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(43, 6, 'users.packages.page.title', 'clients/packages||client/package/{id}/edit||client/package/add||client/package', 'client.package.view', 2, '243', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(44, 6, 'users.roles.page.title', 'package/role||package/role/{id}/edit||package/role/view||package/role/add', 'package.role.view', 3, '175', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(45, 7, 'settings.application.page.title', 'setting/general', 'setting.general', 1, '248', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(46, 7, 'settings.cron.page.title', 'settings/cron', 'setting.crons', 2, '364', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(47, 7, 'settings.header.page.title', 'settings/headers/{id?}', 'setting.header1', 3, '285', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(48, 7, 'settings.license.page.title', 'settings/license', 'license', 4, '254', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(49, 7, 'settings.api.page.title', 'settings/api/keys', 'api_management', 5, '283', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(50, 7, 'settings.branding.page.title', 'settings/whitelabel', 'setting.whitelabel', 6, '275', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(51, 8, 'statistics.broadcast.page.title', 'statistics/broadcasts||statistics/broadcasts/details/{campaign_schedule_id}', 'statistics.broadcasts.index', 1, '279', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(52, 8, 'statistics.evergreen.page.title', 'statistics/evergreen||statistics/evergreen/{id}', 'statistics.evergreen.index', 2, '279', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1,0, '2019-07-18 12:00:00', '2019-07-19 05:15:00'),
(54, 8, 'statistics.trigger.page.title', 'statistics/triggers||statistics/triggers/drip/{triggerId}/{dripId}||statistics/triggers/drips/{campaign_schedule_id}', 'statistics.trigger.index', 4, '282', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(55, 9, 'logs.title', 'tools/logs/debug||tools/logs/access||tools/logs/callbacks||tools/logs/authentication||tools/logs/debug/list||tools/logs/debug/{date}/{level}||tools/logs/authentication||tools/logs/failedJobs', '#', 1, '374', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(56, 9, 'tools.update', 'settings/update', 'setting.update.index', 2, '273', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(57, 9, 'tools.cron_status.page.title', 'cron/status', 'cron-status', 3, '379', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(59, 7, 'settings.primary_domain.page.title', 'settings/primary/domain', 'setting.primary.domain', 7, '365', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(60, 2, 'contacts.email_history.page.title', 'contact/email/history/{id?}', 'contact.email.history', 5, NULL, 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 0, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(61, 55, 'logs.debug.page.title', 'tools/logs/debug', 'logViewer', 1, '-1', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, NULL, '2022-10-27 10:16:03'),
(62, 55, 'logs.activity.page.title', 'tools/logs/access', 'activity-log.index', 2, '376', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(63, 55, 'logs.callbacks.page.title', 'tools/logs/callbacks', 'c.index', 3, '378', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(69, 55, 'logs.authentication.page.title', 'tools/logs/authentication', 'authentication-log', 2, '377', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 16:00:00', '2022-10-27 10:16:03'),
(76, 37, 'tools.feedback_loop.title', 'setup/processed-fbls/{id?}', 'processedFbls', 5, '174', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 0, 0, '2019-08-06 12:00:00', '2022-10-27 10:16:03'),
(77, 9, 'tools.phpinfo.page.title', 'tools/phpinfo', 'phpInfo', 4, '476', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 12:00:00', '2022-10-27 10:16:03'),
(78, 18, 'contacts.add_new.page.title', 'list/{id}/contact/add', 'contactAddToList', 1, '299', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 0, 0, '2020-10-01 12:00:00', '2022-10-27 10:16:03'),
(79, 19, 'contacts.page.title', 'list/{id}/contacts', 'list.contacts', 6, '298', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 0, 0, '2020-10-01 12:00:00', '2022-10-27 10:16:03'),
(80, 20, 'contacts.import_contacts', 'list/{id}/contacts/import', 'importIntoList', 1, '23', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 0, 0, '2020-10-01 12:00:00', '2022-10-27 10:16:03'),
(81, 9, 'dbcheck.title', 'dbcheck', 'dbcheck', 5, '475', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 02:00:00', '2022-10-27 10:16:03'),
(82, 5, 'addons.view_all', 'addons/all', 'addons', 9, '477', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2020-09-22 02:00:00', '2022-10-27 10:16:03'),
(83, 55, 'logs.jobs.page.title', 'tools/logs/failedJobs', 'activity.failedJobs', 4, '-1', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2019-07-18 07:00:00', '2022-10-27 10:16:03'),
(84, 9, 'tools.exported_files.label.title', 'tools/exported/files', 'exported.files', 6, '482', 'kt-menu__link-bullet kt-menu__link-bullet--dot', 1, 1, 0, '2022-01-24 07:07:03', '2022-10-27 10:16:03');");
        }
        else {
            if (!Schema::hasColumn('mainmenu', 'id')) {
                Schema::table('mainmenu', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
             if (!Schema::hasColumn('mainmenu', 'parent_id')) {
                Schema::table('mainmenu', function (Blueprint $table) {
                    $table->integer('parent_id')->nullable();
                });
            }
             if (!Schema::hasColumn('mainmenu', 'module_name')) {
                Schema::table('mainmenu', function (Blueprint $table) {
                    $table->string('module_name', 255)->nullable();
                });
            }
             if (!Schema::hasColumn('mainmenu', 'routes')) {
                Schema::table('mainmenu', function (Blueprint $table) {
                    $table->text('routes')->nullable();
                });
            }
             if (!Schema::hasColumn('mainmenu', 'link')) {
                Schema::table('mainmenu', function (Blueprint $table) {
                    $table->string('link', 100)->nullable();
                });
            }
             if (!Schema::hasColumn('mainmenu', 'sequence')) {
                Schema::table('mainmenu', function (Blueprint $table) {
                    $table->integer('sequence')->nullable();
                });
            }
             if (!Schema::hasColumn('mainmenu', 'permission')) {
                Schema::table('mainmenu', function (Blueprint $table) {
                    $table->text('permission')->nullable();
                });
            }
             if (!Schema::hasColumn('mainmenu', 'icons')) {
                Schema::table('mainmenu', function (Blueprint $table) {
                    $table->text('icons')->nullable();
                });
            }
             if (!Schema::hasColumn('mainmenu', 'type')) {
                Schema::table('mainmenu', function (Blueprint $table) {
                    $table->tinyInteger('type')->nullable()->default(0);
                });
            }
             if (!Schema::hasColumn('mainmenu', 'is_view')) {
                Schema::table('mainmenu', function (Blueprint $table) {
                    $table->tinyInteger('is_view')->nullable()->default(1);
                });
            }
             if (!Schema::hasColumn('mainmenu', 'new_flag')) {
                Schema::table('mainmenu', function (Blueprint $table) {
                    $table->tinyInteger('new_flag')->nullable()->default(0);
                });
            }
             if (!Schema::hasColumn('mainmenu', 'created_at')) {
                Schema::table('mainmenu', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
             if (!Schema::hasColumn('mainmenu', 'id')) {
                Schema::table('mainmenu', function (Blueprint $table) {
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
        Schema::dropIfExists('mainmenu');
    }

}
;
