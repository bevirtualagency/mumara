<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
        public function up()
    {
        DB::statement("INSERT INTO `alter_tables` (`id`, `name`, `type`, `query`, `status`, `fields`, `try_attempts`, `created_at`, `updated_at`) VALUES
(null, 'addListQuery', 'query', 'UPDATE email_opened SET email_opened.list_id = (SELECT subscribers.list_id FROM subscribers WHERE email_opened.contact_id = subscribers.id);', 0, NULL, 3, '2022-11-11 14:05:38', '2022-11-11 14:04:31'),
(null, 'addListQuery', 'query', 'UPDATE email_clicked SET email_clicked.list_id = (SELECT subscribers.list_id FROM subscribers WHERE email_clicked.contact_id = subscribers.id);', 0, NULL, 3, '2022-11-11 14:05:38', '2022-11-11 14:04:31'),
(null, 'addListQuery', 'query', 'UPDATE email_unsubscribed SET email_unsubscribed.list_id = (SELECT subscribers.list_id FROM subscribers WHERE email_unsubscribed.contact_id = subscribers.id);', 0, NULL, 3, '2022-11-11 14:05:38', '2022-11-11 14:04:31');
");
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table("alter_tables")->where("name","addListQuery")->delete();
    }
}
;
