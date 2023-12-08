<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
  
        if (Schema::hasColumn("user_email_limits", 'default_credits')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('default_credits', 'monthly_credits');
            });
        }

        if (Schema::hasColumn("user_email_limits", 'trans_default_credit')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('trans_default_credit', 'trans_monthly_credits');
            });
        }
        if (Schema::hasColumn("user_email_limits", 'contacts') and !Schema::hasColumn("user_email_limits", 'contacts_limit')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('contacts', 'contacts_limit');
            });
        }
        if (Schema::hasColumn("user_email_limits", 'domains')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('domains', 'domains_limit');
            });
        }
        if (Schema::hasColumn("user_email_limits", 'bridges')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('bridges', 'bridges_limit');
            });
        }
        if (Schema::hasColumn("user_email_limits", 'suppress_domains_limit')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('suppress_domains_limit', 'domain_suppression_limit');
            });
        }
        if (Schema::hasColumn("user_email_limits", 'dedicated_pools')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('dedicated_pools', 'dedicated_pools_limit');
            });
        }
        if (Schema::hasColumn("user_email_limits", 'dedicated_ips')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('dedicated_ips', 'dedicated_ips_limit');
            });
        }
        if (Schema::hasColumn("user_email_limits", 'added_contacts')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('added_contacts', 'contacts');
            });
        }
        if (Schema::hasColumn("user_email_limits", 'sent')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('sent', 'total_sent');
            });
        }
        if (Schema::hasColumn("user_email_limits", 'trans_sent')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('trans_sent', 'total_trans_sent');
            });
        }
        if (Schema::hasColumn("user_email_limits", 'delivered')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('delivered', 'total_delivered');
            });
        }
        if (Schema::hasColumn("user_email_limits", 'trans_delivered')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('trans_delivered', 'total_trans_delivered');
            });
        }
        if (Schema::hasColumn("user_email_limits", 'bounced') and !Schema::hasColumn('user_email_limits','total_bounced')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('bounced', 'total_bounced');
            });
        }
        if (Schema::hasColumn("user_email_limits", 'trans_bounced')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('trans_bounced', 'total_trans_bounced');
            });
        }
        if (Schema::hasColumn("user_email_limits", 'bounced_hard')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('bounced_hard', 'total_bounced_hard');
            });
        }
      
        if (Schema::hasColumn("user_email_limits", 'bounced_soft')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('bounced_soft', 'total_bounced_soft');
            });
        }

     
        if (Schema::hasColumn("user_email_limits", 'opened') and !Schema::hasColumn('user_email_limits','total_opens')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('opened', 'total_opens');
            });
        }
        if (Schema::hasColumn("user_email_limits", 'clicked') and !Schema::hasColumn('user_email_limits','total_clicks')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('clicked', 'total_clicks');
            });
        }
        if (Schema::hasColumn("user_email_limits", 'complaints') and !Schema::hasColumn('user_email_limits','total_complaints')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('complaints', 'total_complaints');
            });
        }
        if (Schema::hasColumn("user_email_limits", 'clicked_this_month') and !Schema::hasColumn('user_email_limits','clicks_this_month')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('clicked_this_month', 'clicks_this_month');
            });
        }
        if (Schema::hasColumn("user_email_limits", 'opened_this_month') and !Schema::hasColumn('user_email_limits','opens_this_month')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('opened_this_month', 'opens_this_month');
            });
        }
        if (Schema::hasColumn("user_email_limits", 'log_retention_disclaimer')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('log_retention_disclaimer', 'log_retention');
            });
        }
        if (Schema::hasColumn("user_email_limits", 'last_contact')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->dropColumn('last_contact');
            });
        }
        if (Schema::hasColumn("user_email_limits", 'suppress_last_contact')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->dropColumn('suppress_last_contact');
            });
        }

        
        if(!Schema::hasColumn("user_email_limits", 'total_bounced_hard')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->Integer('total_bounced_hard')->nullable()->default(0);
            });
        }
        if(!Schema::hasColumn("user_email_limits", 'total_bounced_soft')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->Integer('total_bounced_soft')->nullable()->default(0);
            });
        }
        if(!Schema::hasColumn("user_email_limits", 'total_trans_bounced_hard') and Schema::hasColumn("user_email_limits", 'total_trans_bounced')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->Integer('total_trans_bounced_hard')->after("total_trans_bounced")->nullable()->default(0);
            });
        }
        if(!Schema::hasColumn("user_email_limits", 'total_trans_bounced_soft') and Schema::hasColumn("user_email_limits", 'total_trans_bounced')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->Integer('total_trans_bounced_soft')->after("total_trans_bounced")->nullable()->default(0);
            });
        }

        if (!Schema::hasColumn("user_email_limits", 'trans_bounced_this_month') and Schema::hasColumn("user_email_limits", 'total_trans_sent')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->Integer('trans_bounced_this_month')->after('total_trans_sent')->nullable()->default(0);
            });
        }
        if (!Schema::hasColumn("user_email_limits", 'trans_delivered_this_month') and Schema::hasColumn("user_email_limits", 'total_trans_delivered')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->Integer('trans_delivered_this_month')->after('total_trans_delivered')->nullable()->default(0);
            });
        }
        if (!Schema::hasColumn("user_email_limits", 'trans_bounced_hard_this_month') and Schema::hasColumn("user_email_limits", 'total_trans_bounced')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->Integer('trans_bounced_hard_this_month')->nullable()->default(0);
            });
        }
        if (!Schema::hasColumn("user_email_limits", 'trans_bounced_soft_this_month') and Schema::hasColumn("user_email_limits", 'total_trans_bounced') ) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->Integer('trans_bounced_soft_this_month')->nullable()->default(0);
            });
        }

        if (!Schema::hasColumn("user_email_limits", 'total_trans_bounced_hard') and Schema::hasColumn("user_email_limits", 'total_trans_bounced')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->Integer('total_trans_bounced_hard')->nullable()->default(0);
                
            });
        }
        
        if (!Schema::hasColumn("user_email_limits", 'total_trans_bounced_soft')  and Schema::hasColumn("user_email_limits", 'total_trans_bounced') ) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->Integer('total_trans_bounced_soft')->nullable()->default(0);
            });
        }

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn("user_email_limits", 'monthly_credits')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('monthly_credits', 'default_credits');
            });
        }
        if (Schema::hasColumn("user_email_limits", 'trans_monthly_credits')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('trans_monthly_credits', 'trans_default_credit');
            });
        }

        if (Schema::hasColumn("user_email_limits", 'contacts_limit') and !Schema::hasColumn("user_email_limits", 'contacts')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('contacts_limit', 'contacts');
            });
        }

        if (Schema::hasColumn("user_email_limits", 'domains_limit')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('domains_limit', 'domains');
            });
        }

        if (Schema::hasColumn("user_email_limits", 'bridges_limit')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('bridges_limit', 'bridges');
            });
        }

        if (Schema::hasColumn("user_email_limits", 'domain_suppression_limit')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('domain_suppression_limit', 'suppress_domains_limit');
            });
        }

        if (Schema::hasColumn("user_email_limits", 'dedicated_pools_limit')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('dedicated_pools_limit', 'dedicated_pools');
            });
        }


        if (Schema::hasColumn("user_email_limits", 'dedicated_ips_limit')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('dedicated_ips_limit', 'dedicated_ips');
            });
        }

        if (Schema::hasColumn("user_email_limits", 'contacts')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('contacts', 'added_contacts');
            });
        }

        if (Schema::hasColumn("user_email_limits", 'total_sent')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('total_sent', 'sent');
            });
        }

        if (Schema::hasColumn("user_email_limits", 'total_trans_sent')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('total_trans_sent', 'trans_sent');
            });
        }

        if (Schema::hasColumn("user_email_limits", 'total_delivered')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('total_delivered', 'delivered');
            });
        }
        if (Schema::hasColumn("user_email_limits", 'total_trans_delivered')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('total_trans_delivered', 'trans_delivered');
            });
        }

        if (Schema::hasColumn("user_email_limits", 'total_bounced')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('total_bounced', 'bounced');
            });
        }
        if (Schema::hasColumn("user_email_limits", 'total_trans_bounced')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('total_trans_bounced', 'trans_bounced');
            });
        }
        if (Schema::hasColumn("user_email_limits", 'total_bounced_hard')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('total_bounced_hard', 'bounced_hard');
            });
        }
      
        if (Schema::hasColumn("user_email_limits", 'total_bounced_soft')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('total_bounced_soft', 'bounced_soft');
            });
        }

     
        if (Schema::hasColumn("user_email_limits", 'total_opens')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('total_opens', 'opened');
            });
        }
        if (Schema::hasColumn("user_email_limits", 'total_clicks')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('total_clicks', 'clicked');
            });
        }
        if (Schema::hasColumn("user_email_limits", 'total_complaints')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('total_complaints', 'complaints');
            });
        }
        if (Schema::hasColumn("user_email_limits", 'clicks_this_month')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('clicks_this_month', 'clicked_this_month');
            });
        }
        if (Schema::hasColumn("user_email_limits", 'opens_this_month')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('opens_this_month', 'opened_this_month');
            });
        }
        if (Schema::hasColumn("user_email_limits", 'log_retention')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->renameColumn('log_retention', 'log_retention_disclaimer');
            });
        }
        if (Schema::hasColumn("user_email_limits", 'last_contact')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->dropColumn('last_contact');
            });
        }
        if (Schema::hasColumn("user_email_limits", 'suppress_last_contact')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->dropColumn('suppress_last_contact');
            });
        }

        
        if(Schema::hasColumn("user_email_limits", 'total_bounced_hard')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->dropColumn('total_bounced_hard');
            });
        }
        if(Schema::hasColumn("user_email_limits", 'total_bounced_soft')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->dropColumn('total_bounced_soft');
            });
        }

        if(Schema::hasColumn("user_email_limits", 'total_trans_bounced_hard') and Schema::hasColumn("user_email_limits", 'total_trans_bounced')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->dropColumn('total_trans_bounced_hard');
            });
        }

        if(Schema::hasColumn("user_email_limits", 'total_trans_bounced_soft') and Schema::hasColumn("user_email_limits", 'total_trans_bounced')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->dropColumn('total_trans_bounced_soft');
            });
        }

        if (Schema::hasColumn("user_email_limits", 'trans_bounced_this_month') and Schema::hasColumn("user_email_limits", 'total_trans_sent')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->dropColumn('trans_bounced_this_month');
            });
        }
        if (Schema::hasColumn("user_email_limits", 'trans_delivered_this_month') and Schema::hasColumn("user_email_limits", 'total_trans_delivered')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->dropColumn('trans_delivered_this_month');
            });
        }

        if (Schema::hasColumn("user_email_limits", 'trans_bounced_hard_this_month') and Schema::hasColumn("user_email_limits", 'total_trans_bounced')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->dropColumn('trans_bounced_hard_this_month');
            });
        }
        if (Schema::hasColumn("user_email_limits", 'trans_bounced_soft_this_month') and Schema::hasColumn("user_email_limits", 'total_trans_bounced') ) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->dropColumn('trans_bounced_soft_this_month');
            });
        }

        if (Schema::hasColumn("user_email_limits", 'total_trans_bounced_hard') and Schema::hasColumn("user_email_limits", 'total_trans_bounced')) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->dropColumn('total_trans_bounced_hard');
            });
        }
        
        if (Schema::hasColumn("user_email_limits", 'total_trans_bounced_soft')  and Schema::hasColumn("user_email_limits", 'total_trans_bounced') ) {
            Schema::table("user_email_limits", function (Blueprint $table) {
                $table->dropColumn('total_trans_bounced_soft');
            });
        }
    }
};
