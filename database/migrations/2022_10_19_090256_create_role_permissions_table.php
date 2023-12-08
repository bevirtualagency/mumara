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
        if (!Schema::hasTable('role_permissions')) {
            Schema::create('role_permissions', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('role_id')->nullable();
                $table->integer('permission_id')->nullable();
                $table->timestamp('created_at')->nullable()->useCurrent();
                $table->timestamp('updated_at')->useCurrentOnUpdate();
            });
            DB::statement("INSERT INTO `role_permissions` (`id`, `role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(1, 1, 16, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(2, 1, 17, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(3, 1, 18, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(4, 1, 19, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(5, 1, 20, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(6, 1, 21, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(7, 1, 22, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(8, 1, 23, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(9, 1, 199, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(10, 1, 24, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(11, 1, 25, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(12, 1, 26, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(13, 1, 180, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(14, 1, 27, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(15, 1, 28, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(16, 1, 29, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(17, 1, 30, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(18, 1, 31, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(19, 1, 32, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(20, 1, 33, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(21, 1, 34, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(22, 1, 35, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(23, 1, 37, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(24, 1, 38, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(25, 1, 39, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(26, 1, 185, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(27, 1, 186, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(28, 1, 187, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(29, 1, 188, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(30, 1, 207, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(31, 1, 209, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(32, 1, 215, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(33, 1, 217, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(34, 1, 221, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(35, 1, 228, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(36, 1, 230, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(37, 1, 236, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(38, 1, 241, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(39, 1, 243, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(40, 1, 248, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(41, 1, 249, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(42, 1, 250, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(43, 1, 251, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(44, 1, 252, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(45, 1, 253, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(46, 1, 254, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(47, 1, 255, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(48, 1, 256, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(49, 1, 45, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(50, 1, 46, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(51, 1, 47, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(52, 1, 48, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(53, 1, 49, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(54, 1, 50, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(55, 1, 51, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(56, 1, 52, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(57, 1, 53, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(58, 1, 54, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(59, 1, 55, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(60, 1, 56, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(61, 1, 57, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(62, 1, 58, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(63, 1, 59, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(64, 1, 60, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(65, 1, 61, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(66, 1, 62, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(67, 1, 63, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(68, 1, 64, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(69, 1, 65, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(70, 1, 66, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(71, 1, 67, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(72, 1, 68, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(73, 1, 69, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(74, 1, 70, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(75, 1, 71, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(76, 1, 72, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(77, 1, 73, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(78, 1, 74, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(79, 1, 75, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(80, 1, 76, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(81, 1, 77, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(82, 1, 78, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(83, 1, 79, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(84, 1, 80, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(85, 1, 81, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(86, 1, 82, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(87, 1, 83, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(88, 1, 84, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(89, 1, 85, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(90, 1, 204, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(91, 1, 205, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(92, 1, 198, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(93, 1, 200, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(94, 1, 86, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(95, 1, 87, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(96, 1, 88, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(97, 1, 89, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(98, 1, 90, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(99, 1, 91, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(100, 1, 92, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(101, 1, 93, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(102, 1, 94, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(103, 1, 95, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(104, 1, 96, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(105, 1, 97, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(106, 1, 98, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(107, 1, 99, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(108, 1, 100, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(109, 1, 181, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(110, 1, 182, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(111, 1, 183, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(112, 1, 184, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(113, 1, 101, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(114, 1, 102, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(115, 1, 103, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(116, 1, 104, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(117, 1, 105, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(118, 1, 106, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(119, 1, 107, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(120, 1, 108, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(121, 1, 109, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(122, 1, 110, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(123, 1, 111, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(124, 1, 112, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(125, 1, 113, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(126, 1, 114, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(127, 1, 115, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(128, 1, 116, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(129, 1, 117, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(130, 1, 118, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(131, 1, 119, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(132, 1, 120, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(133, 1, 121, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(134, 1, 122, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(135, 1, 123, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(136, 1, 124, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(137, 1, 125, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(138, 1, 126, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(139, 1, 127, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(140, 1, 128, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(141, 1, 202, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(142, 1, 203, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(143, 1, 129, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(144, 1, 130, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(145, 1, 131, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(146, 1, 132, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(147, 1, 133, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(148, 1, 134, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(149, 1, 135, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(150, 1, 136, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(151, 1, 137, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(152, 1, 138, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(153, 1, 174, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(154, 1, 139, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(155, 1, 140, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(156, 1, 141, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(157, 1, 142, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(158, 1, 143, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(159, 1, 150, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(160, 1, 151, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(161, 1, 152, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(162, 1, 153, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(163, 1, 154, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(164, 1, 155, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(165, 1, 156, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(166, 1, 157, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(167, 1, 158, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(168, 1, 159, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(169, 1, 160, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(170, 1, 161, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(171, 1, 162, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(172, 1, 163, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(173, 1, 189, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(174, 1, 190, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(175, 1, 191, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(176, 1, 192, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(177, 1, 201, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(178, 1, 193, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(179, 1, 194, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(180, 1, 195, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(181, 1, 196, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(182, 1, 197, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(183, 1, 208, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(184, 1, 210, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(185, 1, 211, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(186, 1, 212, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(187, 1, 213, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(188, 1, 216, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(189, 1, 218, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(190, 1, 222, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(191, 1, 223, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(192, 1, 224, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(193, 1, 225, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(194, 1, 229, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(195, 1, 231, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(196, 1, 237, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(197, 1, 238, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(198, 1, 239, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(199, 1, 240, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(200, 1, 242, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(201, 1, 244, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(202, 1, 245, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(203, 1, 246, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(204, 1, 257, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(205, 1, 258, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(206, 1, 259, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(207, 1, 260, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(208, 1, 261, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(209, 1, 262, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(210, 1, 263, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(211, 1, 264, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(212, 1, 265, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(213, 1, 266, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(214, 1, 267, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(215, 1, 268, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(216, 1, 269, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(217, 1, 270, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(218, 1, 271, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(219, 1, 272, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
(220, 1, 273, '2022-10-27 10:16:05', '2022-10-27 10:16:05'),
        (221, 1, 7, '2022-10-27 10:16:05', '2022-10-27 10:16:05');");
        }
        else {
            if (!Schema::hasColumn('role_permissions', 'id')) {
                Schema::table('role_permissions', function (Blueprint $table) {
                    $table->integer('id', true);
                });
            }
            if (!Schema::hasColumn('role_permissions', 'role_id')) {
                Schema::table('role_permissions', function (Blueprint $table) {
                    $table->integer('role_id')->nullable();
                });
            }
            if (!Schema::hasColumn('role_permissions', 'permission_id')) {
                Schema::table('role_permissions', function (Blueprint $table) {
                    $table->integer('permission_id')->nullable();
                });
            }
            if (!Schema::hasColumn('role_permissions', 'created_at')) {
                Schema::table('role_permissions', function (Blueprint $table) {
                   $table->timestamp('created_at')->nullable()->useCurrent();
                });
            }
            if (!Schema::hasColumn('role_permissions', 'updated_at')) {
                Schema::table('role_permissions', function (Blueprint $table) {
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
        Schema::dropIfExists('role_permissions');
    }

}
;