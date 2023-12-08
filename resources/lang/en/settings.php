<?php
include("variables.php");
/**
 * Created by Mumara Team
 * Date: 07/13/2020
 */
/*-------------- 1. Application Settings -> General ----------------*/

$lang['application']['page']['title']                 			               = 'Application Settings';
$lang['application']['page']['description']           			               = 'Review application settings and tweak them according to the requirement.';
            
$lang['application']['general']['title']                                       = 'General';
$lang['application']['general']['form']['heading']                             = 'General Settings';
$lang['application']['general']['form']['force_secure_url']                    = 'Force Secure URL';
$lang['application']['general']['form']['force_secure_url_help']               = 'Enabling this option will enforce secure connections (HTTPS) on all internal links within Mumara. Please note that SSL installation is required for this feature to function properly.';
$lang['application']['general']['form']['debug_mode']                          ='Debug Mode';
$lang['application']['general']['form']['debug_mode_help']                     ='Enabling this feature allows you to access the Debug mode, which provides detailed error information for troubleshooting purposes.';
$lang['application']['general']['form']['development_mode']                    ='Development Mode';
$lang['application']['general']['form']['development_mode_help']               ='Enabling development mode will deactivate the internal caching system within the application.';
$lang['application']['general']['form']['url']                                 ='Application URL';
$lang['application']['general']['form']['url_help']                            ='The URL of '.$siteTitle.' installation. '.$siteTitle.' will automatically set this URL itself and you don\'t need to manually set it';
$lang['application']['general']['form']['server_ip']                           ='Server IP';
$lang['application']['general']['form']['server_ip_help']                      = 'This field displays the IP address of the server where your '.$siteTitle.' are installed.';
$lang['application']['general']['form']['time_zone']                           ='Time Zone';
$lang['application']['general']['form']['time_zone_help']                      ='Set the default timezone of the application. It is the reference timezone for all internal time-based system operations';
$lang['application']['general']['form']['rocket_import_chunk_size']            ='Rocket Import Chunk Size';
$lang['application']['general']['form']['rocket_import_chunk_size_help']       ='In order to maintain system stability, the database records will be processed in manageable chunks. Please specify the preferred number of records to be processed per chunk.';
$lang['application']['general']['form']['msg_per_connection']                  ='Number of Messages per Connection';
$lang['application']['general']['form']['msg_per_connection_help']             ='You can configure the batch size of emails per connection in this setting.';
$lang['application']['general']['form']['delete_log_after']                    ='Delete Campaign Logs After (Days)';
$lang['application']['general']['form']['delete_log_after_help']               ='The number of days you want the campaign logs to retain. To keep database optimized and light, you may  need to delete old and unnecessary campaign logs';
$lang['application']['general']['form']['hourly_speed']                        ='Hourly Sending Speed';
$lang['application']['general']['form']['hourly_speed_help']          		   ='The maximum number of cumulative emails to be sent per hour. (It is an application-level sending rate)';
$lang['application']['general']['form']['daily_sending_limit']        		   ='Daily Sending Limit';
$lang['application']['general']['form']['daily_sending_limit_help']   		   ='The maximum cumulative number of emails that can be sent from '.$siteTitle.' per day can be configured and set according to your specific requirements.';
$lang['application']['general']['form']['monthly_sending_limit']      		   ='Monthly Sending Limit';
$lang['application']['general']['form']['monthly_sending_limit_help'] 		   ='The maximum cumulative number of emails that can be sent from '.$siteTitle.' per month can be configured and set according to your specific requirements.';
$lang['application']['general']['form']['help_article_button']                 ='Disable Help Article buttons';
$lang['application']['general']['form']['help_article_button_help']            ='You have the option to disable the Help Article button.';
$lang['application']['general']['form']['heading']                             = 'General Settings';
$lang['application']['general']['form']['notification_heading']                 = 'Control the notifications that should be visible to the users by enabling/disabling the switches below.';
$lang['application']['general']['form']['rocket_import_default_mode']               ='Contacts Import Default Mode';
$lang['application']['general']['form']['rocket_import_default_mode_help']          ='Please specify the default mode for contact import. The "Normal" mode imports contacts individually, while the "Rocket" mode imports contacts in user-defined chunks.';

$lang['application']['general']['form']['user_can_select_file_from_server']             ='Allow users to select a file from the server';
$lang['application']['general']['form']['user_can_select_file_from_server_help']        ='You have the option to enable or disable users from downloading files from the server.';

$lang['application']['general']['form']['auto_refresh_live_events']                 ='Live events auto-refresh every';
$lang['application']['general']['form']['auto_refresh_live_events_help']            ='The delay, expressed in seconds, between two parallel requests to fetch live events data can be customized and adjusted according to your needs.';
$lang['application']['general']['section']['miscellaneous']                 				='Miscellaneous';

$lang['application']['general']['form']['allow_user_import-contacts_confirmed']='Disable users to import contacts as confirmed?';
$lang['application']['general']['form']['allow_user_import-contacts_confirmed_help']='You have the ability to restrict users to import contacts as confirmed.';
$lang['application']['general']['form']['allow_seding_node_email_unconfirmed_contacts']='Disable sending emails to the unconfirmed contacts';
$lang['application']['general']['form']['allow_seding_node_email_unconfirmed_contacts_help']='You have the option to restrict users from sending emails to unconfirmed contacts.';

$lang['application']['general']['form']['sending_node_module']                 ='Sending Node Module';

/**************** Hooks Section ***************/
$lang['application']['general']['section']['hooks']                 	         ='Hooks Settings';
$lang['application']['general']['form']['enable_hooks_error_logging']            ='Enable hooks error logging';
$lang['application']['general']['form']['enable_hooks_error_logging_help']       ='To control the logging of hooks errors, you have the option to enable or disable it by interacting with the toggle button provided.';

$lang['application']['general']['form']['return_all_vars_in_hooks']              ='Return all vars in hooks';
$lang['application']['general']['form']['hooks_vars_help']                       ='Enabling this feature will grant you access to view all the variables provided by hooks in the logs.';
$lang['application']['general']['form']['hooks_vars_disclaimer']                 ='Just use this option in development mode. It may cause the application to work slow.';
$lang['application']['general']['form']['cronjob_disclaimer']                    ='The queues will be executed automatically when the cron job runs';
$lang['application']['general']['form']['realtime_disclaimer']                   ='It will execute the queue:work command instantly when a hook event occurs.';
$lang['application']['general']['form']['supervisor_disclaimer']                 ='You\'ll need to add a supervisor to run the queue:work command.';
$lang['application']['general']['form']['when-to-execute-queues']                ='When to Execute Queues';
$lang['application']['general']['form']['cronjob']                               ='Cronjob';
$lang['application']['general']['form']['realtime']                              ='Realtime';
$lang['application']['general']['form']['supervisor']                            ='Supervisor';
$lang['application']['general']['form']['queue_driver']                          ='Queue driver';
$lang['application']['general']['form']['queue_driver_help']          			 ='<b>Database:</b> The database method utilizes the database driver to store and process the Laravel queues. <b> <br>Sync:</b>The default queue driver in Laravel is `sync` or synchronous. When using the sync driver, queued jobs are executed immediately within the existing process. This means that there is no actual queueing mechanism in place, and jobs are processed right away. While this can be convenient for local development or testing scenarios, it is not recommended for production environments. By using the sync driver in production, you forfeit the performance benefits gained from setting up a proper queue system.';
$lang['application']['general']['form']['queue_driver_database']   ='Database';
$lang['application']['general']['form']['queue_driver_sync']   	   ='Sync';
$lang['application']['contact']['form']['limit_domain_suppressed_support']   	 ='Limit domain suppressed Support';
$lang['application']['contact']['form']['limit_user_description']   	         ='By enabling this functionality, you can establish a domain suppression limit for users.';


/*-------------- 2. Application Settings -> Mail Settings ----------------*/

$lang['application']['mail']['title']                         			 = 'Mail';
$lang['application']['mail']['form']['heading']               			 = 'Mail Settings';
//$lang['application']['mail']['form']['desc']                  			 = 'Configure the mail settings for the systematic emails e.g notifications, forgot password, etc.';
$lang['application']['mail']['form']['mail_type']             			 ='Mail Method';
$lang['application']['mail']['form']['mail_function']         			 ='PHP Mail Function';
$lang['application']['mail']['form']['smtp']                  			 ='SMTP';
$lang['application']['mail']['form']['mail_type_help']        			 ='Please select a method for sending systematic emails to the administrator.';
$lang['application']['mail']['form']['host_help']             			 ='Host';
$lang['application']['mail']['form']['username_help']         			 ='Username';
$lang['application']['mail']['form']['password_help']         			 ='Password';
$lang['application']['mail']['form']['port_help']             			 ='Port';
$lang['application']['mail']['form']['encryption_help']       			 ='Encryption';
$lang['application']['mail']['form']['mail_encoding_help']    			 ='Mail Encoding';
$lang['application']['mail']['form']['sender_name']           			 ='Sender Name';
$lang['application']['mail']['form']['sender_name_help']      			 ='Name that the email will appear to be sent from';
$lang['application']['mail']['form']['sender_email']          			 ='Sender Email';
$lang['application']['mail']['form']['sender_email_help']     			 ='The email address that the email will appear to be sent from';
$lang['application']['mail']['form']['bcc_email']             			 ='BCC Email';
$lang['application']['mail']['form']['bcc_email_help']        			 ='It sends a copy of the system';
$lang['application']['mail']['form']['global_header_footer']        	 ='Add Global Header/Footer';
$lang['application']['mail']['form']['global_header_footer_alert']       ='The settings below will be applied to every email going out.';
$lang['application']['mail']['form']['global_header_footer_help']        ='You have the option to incorporate personalized Global Headers and footers into each of your broadcasts.';
$lang['application']['mail']['form']['email_global_header']              ='Email Global HTML Header';
$lang['application']['mail']['form']['email_global_header_help']         ='	HTML codes that will be automatically inserted at the top of every email going out';
$lang['application']['mail']['form']['email_global_footer']              ='Email Global HTML Footer';
$lang['application']['mail']['form']['email_global_footer_help']         ='HTML codes that will be automatically inserted at the bottom of every email going out';
$lang['application']['mail']['form']['force_unsubscribe_link']           ='Force Unsubscribe Link';
$lang['application']['mail']['form']['force_unsubscribe_link_help']      ='Enabling this feature allows you to enforce the inclusion of an unsubscribe link in every broadcast made by your users/clients.';
$lang['application']['mail']['form']['send_systematic_email_to_admin']      ='Send systematic emails to super-admins';
$lang['application']['mail']['form']['send_systematic_email_to_admin_help'] ='This feature facilitates the automatic sending of email notifications to the administrator whenever a new update is available.';

/*-------------- 3. Application Settings -> Sending Domain Settings ----------------*/

$lang['application']['sending_domain']['title']                         			 			     = 'Sending Domain';
$lang['application']['sending_domain']['form']['heading']               			 			     = 'Sending Domain Settings';
$lang['application']['sending_domain']['form']['default_dkim_selector']             			     ='Default DKIM selector';
$lang['application']['sending_domain']['form']['default_dkim_selector_help']             			 ='You have the option to configure a default DKIM selector within this system. Additionally, when adding a new masking domain, you can modify the DKIM selector associated with it.';
$lang['application']['sending_domain']['form']['default_tracking_domain_selector']             		 ='Default Tracking Domain Prefix';
$lang['application']['sending_domain']['form']['default_tracking_domain_selector_help']              ='You have the option to configure a Default Tracking Domain Prefix within this system. Additionally, when adding a new masking domain, you can modify the Tracking Domain Prefix associated with it.';
$lang['application']['sending_domain']['form']['domain_key_size_in_bits']             			     ='Domain Key Size in Bits';
$lang['application']['sending_domain']['form']['domain_key_size_in_bits_help']             			 ='Within this system, you are provided with the flexibility to select the desired size for the domain key.';
$lang['application']['sending_domain']['form']['allow_duplicate_sending_domains']     				 ="Allow users to add duplicate Sending Domains";
$lang['application']['sending_domain']['form']['allow_duplicate_sending_domains_help']				 ="In this system, you have the option to enable or restrict users from adding duplicate sending domains.";
$lang['application']['sending_domain']['form']['require_domain_ownership_verification']              ='Require Domain Ownership Verification';
$lang['application']['sending_domain']['form']['require_domain_ownership_verification_help']         ='You have the flexibility to configure whether it is mandatory for users to demonstrate ownership of the sending domain within this system.'.$siteTitle.' will further ask you about the previous domains i.e if you want the already added domains to be set as verified or unverified.';
$lang['application']['sending_domain']['form']['confirmation']             			                 ='Confirmation';
$lang['application']['sending_domain']['form']['set_existing_sending_domains_as_unverified']         = 'Set existing sending domains as unverified';
$lang['application']['sending_domain']['form']['all_domains_ownership']                              = 'Are you sure that you want all Sending Domains Ownership to be verified?';
$lang['application']['sending_domain']['form']['note_disable_existing_domains']                      = 'Note: This option will disable all existing sending domain unless they get verified. If unchecked, all existing sending domains will be auto-verified';
$lang['application']['sending_domain']['form']['enable_recheck_button_title']                        = 'Enable DNS Recheck Button after (Minutes)';
$lang['application']['sending_domain']['form']['enable_recheck_button_help']                         = 'You can set the interval for DNS checks in order to minimize frequent DNS requests and take advantage of DNS caching within this system.';

$lang['application']['sending_domain']['form']['bounce_domain_for_mx']='Bounce Domain for MX';
$lang['application']['sending_domain']['form']['spf_include_domain']='SPF Include Domain';
$lang['application']['sending_domain']['form']['spf_include_prefix']='Default Bounce Subdomain Prefix';

$lang['application']['sending_domain']['form']['domain_dns_check']='DNS lookup method for the confirm records';
$lang['application']['sending_domain']['form']['domain_dns_check_desc']='You have the flexibility to switch between these two DNS checking methods in order to prevent caching issues.';

$lang['application']['sending_domain']['form']['domain_dns_check_domain']='DNS lookup method to current records';
$lang['application']['sending_domain']['form']['domain_dns_check_desc_domain']='You have the flexibility to switch between these two DNS checking methods in order to prevent caching issues.';
$lang['application']['sending_domain']['form']['domain_dns_check_option1']=' Mumara Internal';
$lang['application']['sending_domain']['form']['domain_dns_check_option2']=' Google DNS';


$lang['application']['sending_domain']['form']['dns_lookup_commercial']=' DNS lookup default method';
$lang['application']['sending_domain']['form']['dns_lookup_commercial_desc']=' DNS lookup default method for commercial users';
$lang['application']['sending_domain']['form']['commercial_esp_mumara']=' Mumara API';
$lang['application']['sending_domain']['form']['commercial_esp_google']=' Google DNS';
$lang['application']['sending_domain']['form']['mumara_dns_checkup_key']='Mumara DNS Checkup Key';
$lang['application']['sending_domain']['form']['mumara_dns_checkup_key_desc']='Mumara DNS Checkup Key';



/*-------------- 4. Application Settings -> Broadcast Settings ----------------*/
$lang['application']['broadcast']['title']                         			 = 'Broadcast';
$lang['application']['broadcast']['form']['heading']               			 = 'Broadcast Settings';
$lang['application']['broadcast']['form']['allow_verify_domain'] 			 = 'Allow user to send from an email address that doesn\'t belong to a verified domain.';
$lang['application']['broadcast']['form']['auto_resume'] 					 = 'Auto resume broadcasts upon connection reestablishment';
$lang['application']['broadcast']['form']['auto_resume_help']                ='This feature automatically resumes your broadcast in the event of a SMTP connection failure. It ensures the continuity of your email delivery by handling the reestablishment of the connection seamlessly.';
$lang['application']['broadcast']['form']['double_optin_newsletter']        ='Ask for confirmation when someone unsubscribes';
$lang['application']['broadcast']['form']['double_optin_newsletter_help']   ='With this option, you have the ability to enable or disable a confirmation button for individuals who wish to unsubscribe from your mailing list. This provides control over the process and allows you to decide whether a confirmation step is required before a subscriber\'s unsubscription is finalized.';
$lang['application']['broadcast']['form']['disable_selection_sender_id']     ='Disable the selection of sender-id from the sending node on preview';
$lang['application']['broadcast']['form']['intellectual_pattern']            ='Use the intellectual pattern to select tracking domain';
$lang['application']['broadcast']['form']['intellectual_pattern_help']       ='When this option is enabled, Mumara will utilize your primary domain or main domain as a fallback in the event that your tracking domain encounters any issues.';
$lang['application']['broadcast']['form']['auto_inactive_minutes']           ='Recheck auto-inactive sending node connection after every';
$lang['application']['broadcast']['form']['auto_inactive_minutes_help']      ='The auto inactive sending node recheck occurs at a specified interval, measured in minutes. This process automatically verifies the status of auto-inactive sending nodes based on the configured time interval.';
$lang['application']['broadcast']['form']['auto_inactive_hours']             ='Recheck auto-inactive sending node connection for';
$lang['application']['broadcast']['form']['auto_inactive_hours_help']        ='This feature enables you to define the specific time duration at which the connection status of auto-inactive sending nodes is periodically rechecked.';
$lang['application']['broadcast']['form']['duplicate_open_after']            ='Ignore Duplicate Opens for';
$lang['application']['broadcast']['form']['duplicate_open_after_help']       ='This functionality allows you to set the time interval at which the system checks for open duplicates.';
$lang['application']['broadcast']['form']['list_unsub_email_title']          = 'List-unsubscribe email';
$lang['application']['broadcast']['form']['list_unsub_email_title_help']     ='It provides recipients with an easily accessible unsubscribe button that allows them to opt-out from receiving your emails automatically. This feature is supported by major email providers such as Gmail, Outlook, and others.';
$lang['application']['broadcast']['form']['smtp_driver']                                 = 'SMTP Driver';
$lang['application']['broadcast']['form']['smtp_driver_help']                            = 'Select the SMTP Module i.e. PHPMailer or SwiftMailer';
$lang['application']['broadcast']['form']['SwiftMailer']             			         ='Swift Mailer';
$lang['application']['broadcast']['form']['PHPMailer']             			             ='PHP Mailer';
$lang['application']['broadcast']['form']['symfony']             			             ='Symfony Mailer';
$lang['application']['broadcast']['form']['bounce_not_older_then_title']                 = 'Process POP/IMAP Bounces Not Older Than';
$lang['application']['broadcast']['form']['bounce_not_older_then_title_help']            = 'To optimize the system\'s performance, it is beneficial to limit '.$siteTitle.' from retrieving bounced emails older than a few days. Since the bounce cron continuously performs its tasks, there is no necessity to repeatedly crawl the entire bounced mailbox from the beginning.';
$lang['application']['broadcast']['form']['esp_method_title']                            = 'ESP Callbacks Processing Method';
$lang['application']['broadcast']['form']['realtime']                                    ='Realtime';
$lang['application']['broadcast']['form']['realtime_help']                               ='Realtime processing will process the callback as soon as it’s received from the ESP.';
$lang['application']['broadcast']['form']['cron_based']                                  ='Cron';
$lang['application']['broadcast']['form']['cron_based_help']                             ='Cron based processing will give some space to your server resources and execute at the serverside upon cron execution.';
$lang['application']['broadcast']['form']['broadcast_unsubscribe_link']                  ='"Insert unsubscribe link" switch default selection on schedule wizard';
$lang['application']['broadcast']['form']['sender_info_option']                          ='"Select sender-info" options default selection';
$lang['application']['broadcast']['form']['sender_info_option_help']                     ='When scheduling a broadcast, you have the option to select your default sender information. This allows you to specify the desired sender details that will be associated with the scheduled email campaign.';
$lang['application']['broadcast']['form']['broadcast_filter_dashboard']                  ='Display broadcasts filter on the Dashboard';
$lang['application']['broadcast']['form']['broadcast_filter_dashboard_help']             ='This functionality will activate the broadcast filter on the dashboard, allowing for the transmission of statistical charts.';
$lang['application']['broadcast']['form']['broadcast_restart_stuck']                     ='Restart stuck campaigns';
$lang['application']['broadcast']['form']['broadcast_restart_stuck_help']                ='This feature will automatically initiate the restart of your Broadcast in the event of any unforeseen issues or disruptions.';

/*-------------- 5. Application Settings -> Segment Settings ----------------*/
$lang['application']['segment']['title']                         			 = 'Segment';
$lang['application']['segment']['form']['heading']               			 = 'Segment Settings';
$lang['application']['segment']['form']['chunk_size']                        = 'Chunk Size';
$lang['application']['segment']['form']['chunk_size_help']                   = 'To ensure system stability, the database records will be processed in manageable chunks. Please indicate the desired number of records to be processed per chunk.';
$lang['application']['segment']['form']["sleep_chunks"]                      = "Delay Between Chunks";
$lang['application']['segment']['form']["suppression_processing_chunk_size"] = "Suppression processing chunk size";
$lang['application']['segment']['form']["suppression_processing_chunk_size_help"] = "The suppression email processes are conducted in segmented chunks within the database records. Kindly specify the desired number of suppression records to be processed per chunk.";
$lang['application']['segment']['form']["sleep_chunks_help"]                 ="To ensure optimal system performance, you can specify the desired delay duration between processing each chunk. Please indicate the desired number of records to be processed per chunk and the corresponding delay duration. This allows for efficient management of tasks, such as chunk-based processing.";
$lang['application']['segment']['form']["delete_export_segment"]             ="Delete Exported Segments After";
$lang['application']['segment']['form']["delete_export_segment_help"]        ="Number of days after the exported segments files from the server should be deleted";
/*-------------- 6. Application Settings -> Trigger Settings ----------------*/
$lang['application']['trigger']['title']                         			 = 'Triggers';
$lang['application']['trigger']['form']['heading']               			 = 'Trigger Settings';
$lang['application']['trigger']['form']['chunk_size']                        = 'Chunk Size';
$lang['application']['trigger']['form']['triggers_cronjob_title']            = 'Number of executions per cronjob';
$lang['application']['trigger']['form']['triggers_cronjob_title_help']       = 'The maximum number of executions that a single cron job can handle can be customized. By default, it is set to -1, indicating unlimited executions.';
$lang['application']['trigger']['form']["triggers_execution_title"]          ="Number of records to process per execution";
$lang['application']['trigger']['form']["triggers_execution_title_help"]     ="In this setting, you have the ability to specify the number of records you wish to process per execution. The default value is set to 20, which helps maintain optimal performance of your server.";
/*-------------- 7. Application Settings -> Security Setting ----------------*/
$lang['application']['log']['title']                         			     = 'Logs';
$lang['application']['log']['form']['heading']               			     = 'Logs Setting';
$lang['application']['log']['form']['reporting_level']                       = 'Reporting Level';
$lang['application']['log']['form']['reporting_level_help']                  = 'Selecting an appropriate reporting level allows users to obtain the necessary insights and information for their specific needs, balancing between concise summaries and comprehensive details. Consider your reporting requirements and choose a level that best suits your analysis and decision-making processes.';

$lang['application']['log']['form']['open_unopen_chart']                       = 'Opened vs. Unopened chart type on the Statistics Pages';
$lang['application']['log']['form']['open_unopen_chart_help']                  = 'Users have the capability to seamlessly transition between chart types, each of which is conveniently showcased on the statistics summary page.';
$lang['application']['log']['form']['horizontal_bar_graph']                  = 'Bar Chart';
$lang['application']['log']['form']['pie_chart']                  = 'Pie Chart';

$lang['application']['log']['form']["debug"]    							 ="Debug";
$lang['application']['log']['form']["error"]    							 ="Error";
$lang['application']['log']['form']["critical"] 							 ="Critical";
$lang['application']['log']['form']["info"]                     			 ="Info";
$lang['application']['log']['form']["notice"]                   			 ="Notice";
$lang['application']['log']['form']["warning"]                  			 ="Warning";
$lang['application']['log']['form']["alert"]                    			 ="Alert";
$lang['application']['log']['form']["logs_callbacks_title"]     			 ="Log ESP Callbacks into Files";
$lang['application']['log']['form']["logs_callbacks_title_help"]			 ="It writes the callbacks to files";
$lang['application']['log']['form']["no_of_files"]              			 ="Number of files";
$lang['application']['log']['form']["no_of_files_help"]         			 ="Specify number of files for each esp node";
$lang['application']['log']['form']["delete_subscriper"]         			 ="Delete scheduled broadcast after";
$lang['application']['log']['form']["delete_subscriper_help"]         		 ="Enabling the option to delete scheduled campaigns after a specific number of days will also delete the associated statistics if enabled.";
$lang['application']['log']['form']["delete_emailopenlogs"]         	     ="Delete email opened logs after";
$lang['application']['log']['form']["delete_emailopenlogs_help"]         	 ="By enabling this feature, it will remove all openers data from your logs and statistics.";
$lang['application']['log']['form']["delete_emailclicks"]         	         ="Delete email clicked logs after";
$lang['application']['log']['form']["delete_emailclicks_help"]         	     ="By enabling this feature, it will remove all clickers data from your logs and statistics. ";
$lang['application']['log']['form']["delete_emailbounced"]         	         ="Delete email bounced logs after.";
$lang['application']['log']['form']["delete_emailbounced_help"]         	 ="By enabling this feature, it will remove all bounced data from your logs and statistics.";
$lang['application']['log']['form']["delete_unsubscribed"]         	         ="Delete email unsubscribed logs after. ";
$lang['application']['log']['form']["delete_unsubscribed_help"]         	 ="By enabling this feature, it will remove all unsubscribers data from your logs and statistics.";
$lang['application']['log']['form']["delete_user_logs"]         	         ="Delete user notification logs after";
$lang['application']['log']['form']["delete_user_logs_help"]         	     ="This feature provides the capability to remove user activity logs on the administrative side,";
/*-------------- 8. Application Settings -> Security Setting ----------------*/
$lang['application']['security']['title']                         			 = 'Security';
$lang['application']['security']['form']['heading']               			 = 'Security Settings';
$lang['application']['security']['form']['security_logout_title']            = 'Logout Idle Users Automatically';
$lang['application']['security']['form']['security_logout_title_help']       = 'You can configure a timer to automatically log out inactive users.';
$lang['application']['security']['form']['remember_me']       				 = 'Display Remember Me Option';
$lang['application']['security']['form']['remember_me_help']  				 = 'You have the flexibility to enable or disable the visibility of the "Remember Me" option during the login process.';
$lang['application']['security']['form']['session_storage']       		     = 'Active sessions storage driver';
$lang['application']['security']['form']['session_storage_help']  			 = 'You have the option to store your session files in either the storage folder of Mumara or within a database.';
/*-------------- 9. Application Settings -> API Keys Setting ----------------*/
$lang['application']['api_keys']['title']                         			 = 'Integrations';
$lang['application']['api_keys']['form']['heading']               			 = 'Integrations';
$lang['application']['api_keys']['form']['google_api_key']                   ='Google Map API Key';
$lang['application']['api_keys']['form']['google_api_key_help']              ='Insert your Google API key for the maps charts to avoid the limit-reach for your domain.';
$lang['application']['api_keys']['form']['google_analytics']                 ='Google Analytics';
$lang['application']['api_keys']['form']['google_analytics_code']            ='Measurement ID';
$lang['application']['api_keys']['form']['google_analytics_help']            ='Enhance the efficiency of tracking website traffic and user behavior by integrating your Google Measurement ID into your account.';
$lang['application']['api_keys']['form']['google_recaptcha']                 ='Google Recaptcha';
$lang['application']['api_keys']['form']['google_recaptcha_help']            ="Safeguard the login form from spam and abuse by implementing Google reCAPTCHA's advanced security measures.";
$lang['application']['api_keys']['form']['version']                          ='Version';
$lang['application']['api_keys']['form']['select_version']                          ='Select Version';
$lang['application']['api_keys']['form']['site_key']                         ='Site Key';
$lang['application']['api_keys']['form']['secret_key']                       ='Secret Key';
$lang['application']['api_keys']['form']['create_api_key']                   ='To create an API key:';
$lang['application']['api_keys']['form']['how_to_find_map_key']              ='<ol>
<li>In the <strong>GCP Console</strong>, on the project selector page, select or create a Google Cloud project for which you want to add an API Key. <a target="_blank"href="https://console.cloud.google.com/projectselector2/home/dashboard" rel="nofollow">Go to the project selector page</a></li>
<li>Go to the <strong>APIs &amp; Services &gt; Credentials</strong> page. <a target="_blank" href="https://console.cloud.google.com/apis/credentials" rel="nofollow">Go to the Credentials page</a></li>
<li>On the <strong>Credentials</strong> page, <strong>Create credentials > API key.</strong>The <strong>API key created</strong> dialog displays your newly created API key.</li>
<li>Click<strong> Close</strong>.</li>
<li>The new API key is listed on the <strong> Credentials</strong> page under <strong> API keys</strong>.</li>
<li>(Remember to <a target="_blank" href="https://developers.google.com/maps/documentation/javascript/get-api-key#restrict_key" rel="nofollow">restrict the API key</a> before using it in production.).</li>
</ol>';

$lang['application']['queue']['paths']                         			 = 'Performance';
$lang['application']['queue']['title']                          = 'Processing';
$lang['application']['queue']['title2']                          = 'Retention';
$lang['application']['queue']['description']                          = 'Paths';
$lang['application']['queue']['clicked_toggle_name']                          = 'Location where click files will be written:';
$lang['application']['queue']['clicked_toggle_description']                          = 'It will change clicked files path';
$lang['application']['queue']['clicked_location']                          = 'Clicked Files Path';
$lang['application']['queue']['opened_toggle_name']                          = 'Location where open files will be written:';
$lang['application']['queue']['opened_toggle_description']                    = 'It will change opened files path';
$lang['application']['queue']['opened_location']                          = 'Opened Files Path';
$lang['application']["click_tracking"]                        = 'Click Tracking';
$lang['application']["open_tracking"]                        = 'Open Tracking';
$lang['application']["realtime"]                        = 'Realtime';
$lang['application']["cron"]                        = 'Cron';

$lang['application']['queue']['open_tracking_help']                 = 'Real-time tracking of your opens is available, or you can choose to track them periodically using a cron job.';
$lang['application']['queue']['click_tracking_help']                = 'Real-time tracking of your clicks is available, or you can choose to track them periodically using a cron job. ';
$lang['application']['queue']['esp_method_help']                    = 'Real-time tracking of your ESP Callbacks is available, or you can choose to track them periodically using a cron job. ';


/*--------------  Cron Settings ----------------*/
$lang['cron']['page']['title']                                      	= 'Cron Settings';
$lang['cron']['page']['desc']                                       	= 'Cron is a time-based job scheduler that auto executes the operations. Setup cronjob to perform operations like email scheduling, segmenting, triggering, bounce processing, feedback loop processing, and more.';
$lang['cron']['form']['heading']                                    	="Cron Settings";
$lang['cron']['form']['email_sending']                              	= 'Email Sending';
$lang['cron']['form']['email_sending_help']                         	= 'The frequency of starting newly scheduled broadcasts';
$lang['cron']['form']['trigger_scheduling']                         	= 'Trigger Scheduling';
$lang['cron']['form']['trigger_scheduling_help']                    	= 'The frequency of executing triggers criteria. Triggers are executed one by one in descending order (as they are arranged)';
$lang['cron']['form']['bounce_processing']      					    = 'Bounce Processing';
$lang['cron']['form']['bounce_processing_help'] 					    = 'The delay before the next execution of the delivery reports';
$lang['cron']['form']['fbl_processing']         					    = 'FBL Processing';
$lang['cron']['form']['fbl_processing_help']    					    = 'The delay before the next execution of spam complaints processing';
$lang['cron']['form']['cbp']                    					    = 'Callbacks Processing';
$lang['cron']['form']['cbp_help']               					    = 'Schedule time for Callbacks Processing';
$lang['cron']['form']['maintenance_cron']       					    = 'Maintenance Cron';
$lang['cron']['form']['maintenance_cron_help']                          = 'Schedule time for maintenance';
$lang['cron']['form']['segments_recount']       					    = 'Segments Recount';
$lang['cron']['form']['segments_recount_help']                          = 'Recount segments after every X hours';
$lang['cron']['form']['pending_stats']                          = 'Pending Stats';
$lang['cron']['form']['pending_stats_help']                          = 'Pending Stats after every X minutes/hours';
$lang['cron']['form']['delete_exported_files']                          = 'Delete exported files after every X /hours';
$lang['cron']['form']['evergreen_campaign_title']                          = 'Evergreen Campaigns';
$lang['cron']['form']['evergreen_campaign_desc']                          = 'Check Campaign for Evergreen Schedules. Disable if there is no evergreen campaign.';
$lang['cron']['form']['suppress_subscriber_title']                          = 'Suppression Processing';
$lang['cron']['form']['suppress_subscriber_desc']                          = 'Suppress subscriber after every X hours';

$lang['cron']['form']['trigger_checkup']                          = 'Triggers Checkup';
$lang['cron']['form']['trigger_checkup_desc']                          = 'Some triggers tasks are failed for some reasons. You can retry it.';
$lang['cron']['form']['queue_work']                          = 'Queue Work';
$lang['cron']['form']['queue_work_desc']                     = 'Interval for the queue work execution cron.';

$lang['cron']['form']['stucked_campaigns']                          = 'Stucked Campaigns';
$lang['cron']['form']['stucked_campaigns_desc']                     = 'Stucked campaigns cron after every X hours.';

/*--------------  Global Headers ----------------*/
$lang['header']['page']['title']               = 'Global Headers';
$lang['header']['page']['desc']                = 'Global Headers are the headers to be sent with every email, in addition to '.$siteTitle.'\'s default headers. The major purpose of adding additional headers is custom tracking.';         
// Table Headings         
$lang['header']['column']['label']             = 'Header';
$lang['header']['column']['value']             = 'Value';
$lang['header']['column']['added_on']          = $created_on;
$lang['header']['column']['actions']           = 'Actions';
// Add new         
$lang['header']['form']['label']               = 'Header Label';
$lang['header']['form']['label_help']          = 'Header Label';
$lang['header']['form']['value']               = 'Header Value';
$lang['header']['form']['value_help']          = 'Header Value';
$lang['header']['form']['label_help']          = 'Only alphanumeric characters and hyphens (-) are supported';


/*--------------  Licensing ----------------*/
$lang['license']['page']['title'] 			   = 'Licensing';
$lang['license']['page']['desc']  			   = 'View, insert or update your license information to activate the product and add-ons.';

$lang['license']['form']['client_area']        = 'Go to Clientarea';
$lang['license']['form']['contact_us']         = 'Contact us';
$lang['license']['form']['license_activation'] = 'License Activation';
$lang['license']['form']['licensed_to']        = 'Licensed To';
$lang['license']['form']['license_key']        = 'License Key';
$lang['license']['form']['registeredto']       = 'Registered to';
$lang['license']['form']['license_type']       = 'License Type';
$lang['license']['form']['plan']               = 'Plan';
$lang['license']['form']['valid_domain']       = 'Valid Domain';
$lang['license']['form']['valid_ip'] 		   = 'Valid IP';
$lang['license']['form']['valid_directory']    = 'Valid Directory';
$lang['license']['form']['addons']             = 'Addons';
$lang['license']['form']['created']            = 'Created';
$lang['license']['form']['expires']            = 'Expires';
$lang['license']['form']['no_expiry']          = 'No Expiry';

/*--------------  API Key ----------------*/
$lang['api']['page']['title'] 			       = 'API Key';
$lang['api']['page']['desc']  			       = 'Generate API token to connect '.$siteTitle.' with any third-party application or your website using '.$siteTitle.' Restful API.';
//API Credentials        
// Table Headings         
$lang['api']['step1']['column']['api_token']        	                 = 'API Token';
$lang['api']['step1']['column']['description']      	                 = 'Description';
$lang['api']['step1']['column']['role']             	                 = 'Role';
$lang['api']['step1']['column']['token_name']             	                 = 'Token Name';
$lang['api']['step1']['column']['user']             	                 = 'User';
$lang['api']['step1']['column']['ip_ddresses']      	                 = 'IP Addresses';
$lang['api']['step1']['column']['last_access']      	                 = 'Last Access';
$lang['api']['step1']['column']['status']           	                 = 'Status';
$lang['api']['step1']['column']['action']           	                 = 'Action';
// Add New
$lang['api']['step1']['title']           	                 			 = 'API Credentials';
$lang['api']['step1']['form']['generate_new']                			 = 'Generate New API Credential';
$lang['api']['step1']['form']['description']                 			 = 'Description';
$lang['api']['step1']['form']['rate_limit']                 			 = 'Rate Limit';
$lang['api']['step1']['form']['rl']['help']                		 		 = 'Allowed number of requests per minute';
$lang['api']['step1']['form']['api_role']                    			 = 'API Role';
$lang['api']['step1']['form']['select_api_role']             			 = 'Select API Role';
$lang['api']['step1']['form']['allowed_ip_ddress']           			 = 'Allowed IP Address';
$lang['api']['step1']['form']['allowed_ip_ddress_help']      			 = 'Add the IP addresses or subnets (separated by a new line) that are allowed to use this API Token.';
$lang['api']['step1']['form']['generate']                                = 'Generate';
//API Roles
$lang['api']['step2']['title']           	                             = 'API Roles';

// Table Headings         
$lang['api']['step2']['column']['role_name']        	                 = 'Role Name';
$lang['api']['step2']['column']['description']      	                 = 'Description';
$lang['api']['step2']['column']['action']           	                 = 'Action';
//Add New
$lang['api']['step2']['form']['allowes_api_actions']           	         = 'Allowed API Actions';
$lang['api']['step2']['form']['create_new']           	                 = 'Create API Role';
$lang['api']['step2']['form']['add_client']           	                 = 'Add Client';
$lang['api']['step2']['form']['create_save']           	                 = 'Create/Save API Token';
$lang['api']['step2']['form']['token_name']           	                 = 'Token Name';
$lang['api']['step2']['form']['modules']           	                     = 'Modules';
$lang['api']['step2']['form']['check_all']           	                 = 'Check All';
$lang['api']['step2']['form']['current_ip_address']           	         = 'Current IP Address';
/*-------------- Primary Domain ----------------*/
$lang['primary_domain']['page']['title'] 			       				 = 'Primary Domain';
$lang['primary_domain']['page']['desc']  			       				 = 'The primary domain is an alternative domain name other than the '.$siteTitle.' installation domain that is responsible for tracking and DNS redirection. It is mainly used to keep '.$siteTitle.'\'s main domain undisclosed. You can, however, use the same domain for the primary URL as your installed domain.';
$lang['primary_domain']['form']['heading']           	                 = 'Domain Details';
$lang['primary_domain']['form']['recheck']                               = 'Recheck';
$lang['primary_domain']['form']['add_a_record']                          = 'Add an "A Record"';
$lang['primary_domain']['form']['a_record']                              = 'A Record';
$lang['primary_domain']['form']['login_to_dns_zone']                     = 'Login to the DNS zone of your domain <b>:domain</b> and add the following entry.';
/*-------------- Branding ----------------*/
$lang['branding']['page']['title'] 			       				         = 'Branding';
$lang['branding']['page']['desc']  			       				         = 'Make '.$siteTitle.' look like your own brand by replacing the default seal, title, logos, color scheme, and theme.';
// Application Branding
$lang['branding']['step1']['title']          	                         = 'Application';
$lang['branding']['step1']['form']['heading']                            = 'Application Branding'; 
$lang['branding']['step1']['form']['help_icon_switch']                   = 'Display help icon in the top navigation bar';   
$lang['branding']['step1']['form']['application_title']                  = 'Application Title';   
$lang['branding']['step1']['form']['application_title_help']             = 'You can customize the title of your application in this section.';
$lang['branding']['step1']['form']['copyright_statement']                = 'Copyright Statement';   
$lang['branding']['step1']['form']['copyright_statement_help']           = 'Change the copyright statement at the footer of the application';   
$lang['branding']['step1']['form']['login_screen_title']                 = 'Login Screen Title';   
$lang['branding']['step1']['form']['login_screen_title_help']            = 'Title/heading on the login page';   
$lang['branding']['step1']['form']['login_screen_slogan']                = 'Login Screen Slogan';   
$lang['branding']['step1']['form']['login_screen_slogan_help']           = 'Slogan/subheading on the login page';   

// Default Images
$lang['branding']['step2']['title']          	                         = 'Default Images';
$lang['branding']['step2']['form']['heading']                            = 'Default Images';  
$lang['branding']['step2']['form']['dashboard_logo']                     = 'Dashboard Logo';  
$lang['branding']['step2']['form']['dashboard_logo_help']                = 'Dimensions: 167px by 40px<br>Image Extension: .png';  
$lang['branding']['step2']['form']['login_logo']                         = 'Login Screen Logo';  
$lang['branding']['step2']['form']['login_logo_help']                    = 'Dimensions: 247px by 60px<br>Image Extension: .png';  
$lang['branding']['step2']['form']['favicon']                            = 'Favicon';  
$lang['branding']['step2']['form']['favicon_help']                       = 'Dimensions: 16px by 16px<br>Image Extension: .ico';  
$lang['branding']['step2']['form']['preloader_image']                    = 'Preloader Image';  
$lang['branding']['step2']['form']['preloader_image_help']               = 'Dimensions: 230px by 230px<br>Image Extension: .jpg';  
$lang['branding']['step2']['form']['landing_banner']                     = 'Login Banner';  
$lang['branding']['step2']['form']['landing_banner_help']                = 'Dimensions: 1800px by 2000px<br>Image Extension: .png';  

// Custom CSS
$lang['branding']['step3']['title']          	                         = 'Custom CSS';
$lang['branding']['step3']['form']['heading']                            = 'Override Custom CSS';  
/************* ** Alert Messages ** *************/
$lang['message']['settings_updated']           			    			 = 'Settings updated successfully';
$lang['message']['all_domains_ownership']      			    			 = 'Are you sure that you want all Sending Domains Ownership to be verified?';
$lang['message']['running_in_background']      			    			 = 'Cron successfully running in background!';
$lang['message']['alert_licensing']            			    			 = 'Please Enter a Valid Activation Key.';
$lang['message']['alert_license_key']          			    			 = "Opppssss! Your license key isn`t working. Please update your license key or <a href='mailto:support@mumara.com'>Contact Support</a>"; 
$lang['message']['invalid_license_key']        			    			 = "Your license is not valid for this installation. You may need to reissue the license from your clientarea. ";
$lang['message']['alert_unregistered']         			    			 = 'Opppssss! This is an unregistered installation. Please contact us Immediately.';
$lang['message']['credential_successfully_created']         			 = 'API credential successfully created.';
$lang['message']['role_successfully_created']               			 = 'Role has been saved Successfully.';
$lang['message']['role_deleted']                            			 = 'Role has been deleted Successfully.';
$lang['message']['role_not_found']                          			 = 'Role Not Found.';
$lang['message']['role_in_use']                             			 = 'Role is attached to tokens, first delete the associated tokens in order to delete this role.';
$lang['message']['token_successfully_created']              			 = 'Token has been saved Successfully';
$lang['message']['token_deleted']                           			 = 'Token has been deleted Successfully.';
$lang['message']['token_not_found']                         			 = 'Token Not Found.';
$lang['message']['primary_domain_success']                  			 = 'Primary domain successfully confirmed!';
$lang['message']['primary_domain_failed']                   			 = 'Primary domain failed!';
$lang['message']['primary_domain_saved']                    			 ='Primary Domain Successfully Added';
$lang['message']['cron_settings_updated']                    			 ='Cron Settings Updated Successfully';
$lang['message']['empty_custom_css']                    			     ='Custom CSS is empty.';
$lang['message']['updated_custom_css']                    			     ='Custom Styling Successfully Updated.';
$lang['message']['no_change']                    			             = 'No any change commit.';
$lang['message']['settings_saved']   									 = 'Setting Successfully Saved';
$lang['message']['settings_updated'] 									 = 'Application Settings Updated Successfully';
$lang['message']['no_response'] 									     = 'No response from the licensing server';
$lang['message']['site_upgraded'] 									     = 'Site successfully upgraded';
$lang['message']['shell_exec_disabled_on_upgrade']                       = 'shell_exec is disabled please enable it otherwise upgrade can take more then 300+ seconds';
/************* ** General ** *************/
$lang['title'] 					                			             = 'Settings';
$lang['confirmation']   					                			 = 'Confirmation';
$lang['first_name']     					                			 = 'First Name';
$lang['verify_domains'] 					                			 = 'Verify Domains';
$lang['pixels'] 					                			         = 'Pixels';
$lang['app_setting']['label']['idle_timeout']                            = 'Idle session timeout';
$lang['app_setting']['label']['time']                                    = 'Time';
$lang['app_setting']['label']['time_in_mins']                            = 'Time in minutes';
$lang['app_setting']['label']['remember_session']                        = 'Allow users to remeber sesssion';
$lang['app_setting']['pop_up_label']['idle_timeout']                     = 'Session Idle time alert';
$lang['app_setting']['alert']['before_logout']                           = 'Your session is about to expire due to inactivity. Click stay connected in order to keep logged in!';
$lang['app_setting']['label']['delete_export_file_after_days']                        = 'Delete Exported Files After';
$lang['app_setting']['label']['delete_export_file_after_days_description']            = "This feature enables the automatic deletion of exported files located in the 'Tool -> Exported Files' section based on a specified time interval.";

$lang['para']['database_backup'] 					                			             = 'Schedule database backup to run Daily, Weekly and Monthly.';
$lang['monday'] = 'Mon';
$lang['tuesday'] = 'Tue';
$lang['wednesday'] = 'Wed';
$lang['thursday'] = 'Thu';
$lang['friday'] = 'Fri';
$lang['saturday'] = 'Sat';
$lang['sun'] = 'Sun';
$lang['action']['click_here'] = 'Click Here';
$lang['heading']['contact'] = 'Contact Info';
$lang['button']['submit'] = 'Submit';
$lang['id_s']         = 'Id';
$lang['email_s']         = 'Email';
$lang['key_generated']         = 'Private and Public Key Generated.';
$lang['fail_key_generated']         = 'Failed to generate keys.';
$lang['fail_key_generated']         = 'Email Footer Preview';
$lang['para_enabling']         = 'Enabling this feature will alter some tables and it may take several hours for larger databases. We suggest you take a full backup of your database for the safer side before enabling this option.';
$lang['close_b']         = 'Close';
$lang['proceed_b']         = 'Proceed';
$lang['database_backup']         = 'Database Backup Suggested';
$lang['md5_suppression']         = 'md5 Suppression Support';
$lang['disable_editemail']         = 'Disable editing the email address of the contact';
$lang['disable_editemail_help']         = 'You have the option to disable the editing of email addresses for both administrators and users, ensuring the integrity and stability of subscriber information.';
$lang['force_webforms']         = 'Force double opt-in in webforms';
$lang['popover_suppression_md5']         = 'Enabling this feature will grant users the ability to import MD5 format support into the suppression list.';
$lang['popover_double_webform']         = 'By enabling this feature, upon submission of your webforms, subscribers will receive a confirmation email that kindly requests their confirmation to complete the subscription process.';
$lang['normal_l']         = 'Normal';
$lang['rocket_l']         = 'Rocket';
$lang['note_bold']         = 'Note:';
$lang['note_text_changing_driver']         = 'Upon changing the driver, all current connected users will be logged out including you.';
$lang['days_t']         = 'Days';
$lang['custom_label']         = 'Custom';
$lang['sending_label']         = 'Sending Node';
$lang['contact_label']         = 'Contact List';
$lang['button_verify']         = 'Verify';
$lang['txt_div_t']         = 'TXT';
$lang['host_table_th']         = 'Host';
$lang['type_table_th']         = 'Type';
$lang['value_table_th']         = 'Value';
$lang['txt_para']         = 'Add the following "TXT" record';
$lang['content_dns_domain']         = 'Login to the DNS zone of your domain';
$lang['content_and_entry']         = ' and add the following entry.';
$lang['privte_key_div']         = 'Private Key';
$lang['public_key_div']         = 'Public Key';
$lang['generate_key_div']         = 'Generate Keys';
$lang['regenerate_key_div']         = 'Regenerate Keys';
$lang['size_bits_label']         = 'Key Size in Bits';
$lang['fallback_dkim_label']         = 'Fallback DKIM Domain';
$lang['fallback_selector_label']         = 'Fallback DKIM Selector';
$lang['fallback_dkim_heading']         = 'Fallback DKIM';
$lang['enable_dkim_label']         = 'Enable Fallback DKIM';
$lang['tip_bold_heading']         = ' Tip:';
$lang['start_dkim_para']         = 'Fallback DKIM is';
$lang['off_dkim_span']         = 'OFF';
$lang['end_dkim_div']         = 'You should consider turning it ON to keep the outgoing emails authenticated when the DKIM is disabled for the sending domain.';
$lang['select_domain']         = 'Intellectual pattern to select tracking domain is ';
$lang['end_consider_para']         = 'You should consider turning it ON to keep the email hyperlinks functional when email tracking is enabled but the custom tracking domain is disabled.';
$lang['label_overwrite_domain']         = 'Overwrite Tracking Domain Value';
$lang['disable_cloak_label']         = 'Disable CLOAK option for the Tracking Domain';
$lang['disable_htaccess_domain']         = 'Disable .HTACCESS option for the Tracking Domain';
$lang['disable_cname_domain']         = 'Disable CNAME option for the Tracking Domain';
$lang['disable_users_regenerate']         = 'Disable users to Regenerate the Domain Keys';
$lang['disable_users_download']         = 'Disable users to Download Domain Keys';
$lang['disable_users_bounce']         = 'Disable users to edit the default Bounce Domain';
$lang['disable_users_edit_prefix']         = 'Disable users to edit the default Tracking Domain Prefix';
$lang['disable_users_edit_DKIM']         = 'Disable users to edit the default DKIM Selector';
$lang['disable_send_unauthenticated']         = 'Disable sending from unauthenticated domains';
$lang['php_redirect']         = 'File name for the tracking domain in case of "PHP Redirect"';
$lang['php_redirect_help']         = 'The filename specified here will be assigned to your cloaking file.';
$lang['leave_domains']         = 'Leave the existing sending domains verification statuses as they are';
$lang['set_domains_send']         = 'Set existing sending domains as verified';
$lang['route_bounce']         = 'Route to a Bounce Server';
$lang['label_pop_imap']         = 'POP / IMAP';
$lang['popover_set_pop_imap']         = 'In this system, you are given the choice to select between POP/IMAP protocols for handling emails or to route bounced emails to a dedicated bounce server.';
$lang['bounce_methord_label']         = 'Bounce processing method';
$lang['dig_code']         = 'dig';
$lang['your_server_install']         = 'needs to be installed on your server in order to make it work.';
$lang['feedback_id_gmail']         = 'Insert Gmail Feedback-ID header';
$lang['header_feedback_outgoing']         = 'This feature automatically inserts the Gmail feedback ID into all emails sent to gmail.com addresses.';
$lang['old_little_txt']         = 'Old';
$lang['core_small_txt']         = '(core)';
$lang['new_little_txt']         = 'New';
$lang['modular_small_txt']         = '(modular)';
$lang['email_support_txt']         = 'Support Email';
$lang['email_support_users']         = 'This email address will be made visible to users for support purposes.';
$lang['Maximum_contact_limit']         = 'Maximum contacts limit';
$lang['whole_system_max_contacts']         = 'Maximum contacts limit whole system';
$lang['domain_verification_error']         = 'Domain verification error.';
$lang['domain_verification_successfull']         = 'Domain verified successfully.';
$lang['md5_disable_successfull']         = 'md5 disabled successfully!';
$lang['md5_enables_successfull']         = 'md5 enabled successfully!';
$lang['heading_contacts_setting']         = 'Contacts Setting';
$lang['contact_list']['label'] = 'Contact Lists';
$lang['module']['para_dummy_text'] = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy.';
$lang['modules']['label_search'] = 'Contact Search';
$lang['contacts_import_export']         = 'Import/Export Contacts';
$lang['contact']['list_group']         = 'Contact List Groups';
$lang['modules_custom']['label']         = 'Custom Fields';
$lang['label_campaign_editor']         = 'Campaign Editor';
$lang['campaign_scheduling_label']         = 'Campaign Scheduling';
$lang['label_bounce_handle']         = 'Bounce Handling';
$lang['image_file_label']         = 'Image/File Gallery';
$lang['modules_label_statistics']         = 'Statistics';
$lang['modules_label_security']         = 'Security';
$lang['modules_label_maintenance_m']         = 'Maintenance Mode';
$lang['modules_label_auto_upgrade']         = 'Auto Upgrade';
$lang['modules']['label_helpdesk']         = 'Helpdesk Support';
$lang['modules_label_segments']         = 'Segments';
$lang['modules_label_suppression']         = 'Suppression Management';
$lang['modules']['label_split'] = 'Split Tests';
$lang['modules_label_masking']         = 'Masking/Sending Domains';
$lang['modules_spintags_label']         = 'Spintags';
$lang['modules_autoresponders_label']         = 'Autoresponders';
$lang['modules_triggers_label']         = 'Triggers';
$lang['modules_dynamic_label']         = 'Dynamic Content Tags';
$lang['modules_website_label']         = 'Website Forms';
$lang['modules_feedback_label']         = 'Feedback Loops';
$lang['modules_email_t_label']         = 'Email Templates';
$lang['modules_multi_t_label']         = 'Multi Threading';
$lang['modules_siteaddress_label']         = 'Allow Site Address in Sender Domain / SMTP';
$lang['modules_Dashboard_d_label']         = 'Dashboard Disclaimer';
$lang['modules_heading_para']         = 'Heading';
$lang['showaddons_available_span']         = 'Available Addons';
$lang['showaddons_campaigns_d_para']         = 'Campaigns+ Addons Description';
$lang['showaddons_campaigns_addons_span']         = 'Campaigns+ Addons';
$lang['showaddons_all_addons_action']         = 'All Addons';
$lang['showaddons_purchased_action']         = 'Purchased';
$lang['showaddons_available_action']         = 'Available';
$lang['showaddons_email_builder_heading']         = 'Drag & Drop Email Builder';
$lang['showaddons_price_bold']         = 'Price:';
$lang['showaddons']['dummy_data'] = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker.';
$lang['showaddons']['action_learn']         = 'Learn More';
$lang['showaddons']['action_buy_addon']         = 'Buy Addon';
$lang['showaddons']['span_purchased']         = 'Purchased';
$lang['showaddons_emojis_heading']         = 'Emojis';
$lang['showaddons_powermta_heading']         = 'PowerMTA Integration';
$lang['showaddons_white_labeling_heading']         = 'White Labeling';
$lang['showaddons_campaigns_pixel_heading']         = 'Campaigns+ Pixel';
$lang['update_invalid_key_alert']         = 'Invalid Key!';
$lang['update_expired_key_alert']         = 'Expired Key!';
$lang['update_suspended_key_alert']         = 'Suspended Key!';
$lang['update_invalid_r_alert']         = 'Invalid Response!';
$lang['update_Mumara_td']         = 'Mumara Campaigns+';
$lang['update_view_log_td']         = 'View change log';
$lang['update_updatesbg_para']         = 'Please wait while we are processing some of the updates in background';
$lang['upgrade']['tittle_upgrade']         = 'Upgrade';
$lang['upgrade_campaigns_latest_para']         = 'Upgrade Campaigns+ to latest available version.';
$lang['upgrade_version_heading']         = 'Upgrade Version';
$lang['upgrade_update_version_th']         = 'Update Version Detail';
$lang['upgrade_description_td']         = 'Description';
$lang['upgrade_old_version_td']         = 'Old Version';
$lang['upgrade_available_version_td']         = 'Available Version';
$lang['upgrade_last_update_td']         = 'Last Update';
$lang['upgrade_campaign_adminpannel_td']         = 'Campaign+ Admin Panel';
$lang['upgrade_campaign_plus_td']         = 'Campaign+';
$lang['upgrade_new_versionupdate_td']         = 'New Version Update';
$lang['upgrade_update_version_td']         = 'Update Version';
$lang['upgrade_latest_version_td']         = 'You have the latest version of Campaign+,Your Current Version:';
$lang['upgrade_detail_action_td']         = 'Detail';
$lang['upgrade_current_version_action_td']         = 'Current Version';
$lang['upgrade_version_process_td']         = 'Upgrade Version Proccess';
$lang['upgrade_download_zip_td']         = 'Download Zip';
$lang['upgrade_downloading_div']         = 'Downloading';
$lang['upgrade_zip_downloading']         = 'Zip Downloaded';
$lang['upgrade_extract_zip_td']         = 'Extract Zip';
$lang['upgrade_extracting_div']         = 'Extracting';
$lang['upgrade_zip_extracted']         = 'Zip Extracted';
$lang['upgrade_Installation_update_td']         = 'Installation Updates';
$lang['upgrade_updating_div']         = 'Updating';
$lang['upgrade_files_updated_div']         = 'Files Updated';
$lang['upgrade_update_sql_td']         = 'Update SQL';
$lang['upgrade_sql_updated_div']         = 'SQL Updated';
$lang['upgrade_remove_old_files_td']         = 'Remove Old Version Files';
$lang['upgrade_removed_old_files_div']         = 'Old Version Files Removed';
$lang['upgrade_removing_old_files_div']         = 'Removing Old Version Files';
$lang['upgrade_successfully_updated']         = 'successfully updated to';
$lang['update_new_mumara_campaigns']         = 'Mumara Campaigns+';
$lang['update_new_campaigns_plus']         = 'Campaign+';
$lang['controller']['no_key_found']         = 'No key found';
$lang['controller']['custom_header']         = 'custom_header';
$lang['controller']['user_modules']         = 'User Modules';
$lang['controller']['edit_pixel_modules']         = 'Edit a Pixel';
$lang['controller']['add_pixel_modules']         = 'Add a Pixel';
$lang['controller']['let_app_batch']         = 'Let App Decide';
$lang['crons_blade']['label_click_to_tracking']         = 'Click Tracking';
$lang['pixel_analytic']['alert_choose_options']         = 'You can choose only 3 options, remove extra clicked options';
$lang['pixel_analytic']['select_sent_option']         = 'Sent Option';
$lang['pixel_analytic']['select_deliver_option']         = 'Deliver Option';
$lang['pixel_analytic']['select_failed_option']         = 'Failed Option';
$lang['pixel_analytic']['select_undefined_option']         = 'Undefined Option';
$lang['pixel_analytic']['select_pending_option']         = 'Pending Options';
$lang['pixel_analytic']['select_bounce_option']         = 'Bounce Options';
$lang['pixel_analytic']['select_today_stats']         = 'Today`s Stats';
$lang['pixel_analytic']['select_last_weak_stats']         = 'Last Weak Stats';
$lang['pixel_analytic']['select_this_month_stats']         = 'This Month Stats';
$lang['pixel_analytic']['select_last_year_stats']         = 'Last Year Stats';
$lang['pixel_analytic']['select_all_time_stats']         = 'All Time Stats';
$lang['pixel_analytic']['select_custom_select_stats']         = 'Custom Select Stats';
$lang['pixel_analytic']['span_input_to']         = 'to';
$lang['pixel_analytic']['search_button_custom']         = 'Search';
$lang['pixel_analytic']['fill_search_field_div']         = 'Please fill in the search fields';
$lang['pixel_analytic']['action_add_event']         = 'Add Event';
$lang['pixel_analytic']['bold_txt_events_from']         = 'Events from 31 October 2018';
$lang['pixel_analytic']['select_opt_events']         = 'Events';
$lang['pixel_analytic']['select_opt_campaign_pageview']         = 'CampaignsPlus PageView';
$lang['pixel_analytic']['select_opt_campaign_triggers_pageview']         = 'CampaignsPlus Triggers PageView';
$lang['pixel_analytic']['select_opt_campaign_drip_pageview']         = 'CampaignsPlus Drip PageView';
$lang['pixel_analytic']['select_opt_campaign_schedule_pageview']         = 'CampaignsPlus Schedule PageView';
$lang['pixel_analytic']['select_opt_campaign_settings_pageview']         = 'CampaignsPlus Settings PageView';
$lang['pixel_analytic']['select_opt_campaign_list_pageview']         = 'CampaignsPlus ListView';
$lang['pixel_analytic']['select_opt_campaign_dashboard_pageview']         = 'CampaignsPlus DashboardView';
$lang['pixel_analytic']['time_received_11']         = 'Last received 11 minutes ago';
$lang['pixel_analytic']['time_received_14']         = 'Last received 14 minutes ago';
$lang['pixel_analytic']['time_received_21']         = 'Last received 21 minutes ago';
$lang['pixel_analytic']['time_received_28']         = 'Last received 28 minutes ago';
$lang['pixel_analytic']['time_received_45']         = 'Last received 45 minutes ago';
$lang['pixel_analytic']['time_received_58']         = 'Last received 58 minutes ago';
$lang['pixel_analytic']['time_received_1hour']         = 'Last received 1 hour ago';
$lang['pixel_analytic']['time_received_2hour']         = 'Last received 2 hour ago';
$lang['pixel_analytic']['time_received_5hour']         = 'Last received 5 hour ago';
$lang['pixel_analytic']['time_received_8hour']         = 'Last received 8 hour ago';
$lang['pixel_analytic']['time_received_14hour']         = 'Last received 14 hour ago';
$lang['pixel_analytic']['time_received_19hour']         = 'Last received 19 hour ago';
$lang['pixel_analytic']['time_received_23hour']         = 'Last received 23 hour ago';
$lang['pixel_analytic']['time_received_1day']         = 'Last received 1 day ago';

$lang['pixel_analytic']['name_data_th']         = 'Name';
$lang['pixel_analytic']['last_activity_data_th']         = 'Last Activity';
$lang['pixel_analytic']['events_received_data_th']         = 'Events received';
$lang['pixel_analytic']['setup_your_pixel_span']         = 'Setup your pixel';
$lang['pixel_analytic']['start_setup_methord_label']         = 'Start a setup method';
$lang['pixel_analytic']['postback_url_heading']         = 'Postback URL';
$lang['pixel_analytic']['dummy_text_p']         = 'The dummy copy at this site is made from a dictionary of 500 words from Ciceros original source and ... Lorem Ipsum dummy text based on artificial languages.';
$lang['pixel_analytic']['install_website_heading']         = 'Install in your website or application';
$lang['pixel_analytic']['create_postback_url_label']         = 'Create a Postback URL';
$lang['pixel_analytic']['select_custom_event']         = 'Select from below predefined commonly used events or define your own custom event.';
$lang['pixel_analytic']['page_view_label']         = 'PageView';
$lang['pixel_analytic']['registered_checkbox_label']         = 'Registered';
$lang['pixel_analytic']['purchase_checkbox_label']         = 'Purchased';
$lang['pixel_analytic']['add_to_cart_checkbox_label']         = 'AddToCart';
$lang['pixel_analytic']['lead_checkbox_label']         = 'Lead';
$lang['pixel_analytic']['custom_checkbox_label']         = 'Custom';
$lang['pixel_analytic']['eg_text_label']         = 'e.g: Purchased(c=usd,v=47.00)';
$lang['pixel_analytic']['track_campaign_checkbox_label']         = 'Track Campaign Conversions';
$lang['pixel_analytic']['note_var1_div']         = 'e.g: var1=$mid<br>  Note: var1 can be any variable supported by your destination network.';
$lang['pixel_analytic']['install_on_website_label']         = 'Install on Your Website';
$lang['pixel_analytic']['not_done_text_para']         = 'You’re not done here. You need to add the following codes to your destination webpage so it catches the footprints of the contact and parse back in the postback URL when event occur.<br>
                                    “” For example or something similar “”';
$lang['pixel_analytic']['copy_code_text_heading']         = 'Copy this code &amp; paste into your website';
$lang['pixel_analytic']['copy_code_clipboard_div']         = 'Copy code to clipboard';
$lang['pixel_analytic']['copied_clipboard_span_div']         = 'Copied to clipboard';
$lang['pixel_analytic']['test_postback_url_label']         = 'Test Postback URL';
$lang['pixel_analytic']['postback_on_website_txt']         = 'If you are done with installing the Postback URL on your website, let’s test it.';
$lang['pixel_analytic']['progress_imp_heading']         = 'Progress:';
$lang['pixel_analytic']['generate_msg_id_td']         = 'Generating Message-ID';
$lang['pixel_analytic']['test_visitor_td']         = 'Sending a test visitor';
$lang['pixel_analytic']['test_domain_td']         = 'test@domain.com';
$lang['pixel_analytic']['waiting_postback_td']         = 'Waiting for Postback';
$lang['pixel_analytic']['result_bold_text']         = 'Result:';
$lang['pixel_analytic']['successful_div_text']         = 'Successful';
$lang['pixel_analytic']['back_button_text']         = 'Back';
$lang['pixel_analytic']['continue_button_text']         = 'Continue';
$lang['pixel_analytic']['done_button_text']         = 'Done';
$lang['pixel_analytic']['generate_sample_action']         = 'Generate Sample URL';
$lang['pixel_analytic']['submit_url_label']         = 'Submit URL';
$lang['pixel_analytic']['generate_url_button']         = 'Generate URL';
$lang['pixel_analytic']['cancel_url_button']         = 'Cancel';
$lang['pixel_analytic']['successfully_copied_command']         = 'Successfully copied.';
$lang['pixel_analytic']['destination_url_label']         = 'Destination URL';
$lang['pixel_create_blade']['pixel_successfully_command']         = 'Pixel have been created successfully.';
$lang['pixel_create_blade']['pixel_updated_command']         = 'Pixel have been updated successfully.';
$lang['pixel_create_blade']['select_an_event']         = 'Select an Event';
$lang['debugging_blade']['select_all_event_option']         = 'All Events';
$lang['debugging_blade']['select_campaign_option']         = 'Campaign';
$lang['debugging_blade']['select_triggers_option']         = 'Triggers';
$lang['debugging_blade']['select_drip_option']         = 'Drip';
$lang['debugging_blade']['select_sehedules_option']         = 'Schedules';
$lang['debugging_blade']['refresh_button']         = 'Refresh';
$lang['debugging_blade']['select_page_view_option']         = 'Page View';
$lang['debugging_blade']['select_trigger_page_view_option']         = 'Trigger Page View';
$lang['debugging_blade']['select_setting_page_view_option']         = 'Setting Page View';
$lang['debugging_blade']['select_drip_page_view_option']         = 'Drip Page View';
$lang['debugging_blade']['select_all_app_version_option']         = 'All App versions';
$lang['debugging_blade']['select_unknown_option']         = 'Unknown';
$lang['debugging_blade']['select_all_device_oss_option']         = 'All devices OSs';
$lang['debugging_blade']['select_window_option']         = 'Window';
$lang['debugging_blade']['select_linus_option']         = 'Linus';
$lang['debugging_blade']['select_mac_option']         = 'Mac';
$lang['debugging_blade']['select_andorid_option']         = 'Android';
$lang['debugging_blade']['select_time_logged_th']         = 'Time Logged';
$lang['debugging_blade']['select_device_os_th']         = 'Device OS';
$lang['debugging_blade']['select_app_version_th']         = 'App version';
$lang['debugging_blade']['select_event_th']         = 'Event';
$lang['debugging_blade']['select_value_th']         = 'Value';
$lang['debugging_blade']['select_parameters_th']         = 'Parameters';
$lang['debugging_blade']['select_url_only_th']         = 'URL';
$lang['debugging_blade']['table_windows_td']         = 'Windows';
$lang['debugging_blade']['table_campaingsplus_page_view_td']         = 'CampaignsPlus Page View';
$lang['debugging_blade']['table_current_url_td']         = 'Current URL';
$lang['debugging_blade']['table_newsletter_mumara_td']         = 'newsletter.mumara.host';
$lang['debugging_blade']['table_campaingsplus_trigger_td']         = 'CampaignsPlus Trigger Page View';
$lang['debugging_blade']['table_referer_domain_td']         = 'Referer Domain';
$lang['debugging_blade']['table_newsletter_mumara_trigger_td']         = 'newsletter.mumara.host/trigger';
$lang['debugging_blade']['table_campaingsplus_setting_td']         = 'CampaignsPlus Setting Page View';
$lang['debugging_blade']['table_newsletter_mumara_setting_td']         = 'newsletter.mumara.host/setting';

$lang['index_blade']['alert_select_event']         = 'Please select an event...';
$lang['index_blade']['mumara_pixel_th']         = 'Mumara Pixel';
$lang['index_blade']['pixel_id_small']         = 'Pixel ID:';
$lang['index_blade']['last20min_div']         = 'Last received 20 minutes ago';
$lang['index_blade']['action_txt_button']         = 'Actions';
$lang['index_blade']['install_action_tag']         = 'Install';
$lang['index_blade']['analytics_action_tag']         = 'Analytics';
$lang['index_blade']['edit_action_tag']         = 'Edit';
$lang['index_blade']['delete_action_tag']         = 'Delete';
$lang['index_blade']['events_occurred_div']         = 'Events Occurred';
$lang['index_blade']['top_events_div']         = 'Top Events';
$lang['index_blade']['monthly_activity_div']         = 'Monthly Activity';
$lang['index_blade']['no_pixel_found_td']         = 'No Pixel Found...!';
$lang['index_blade']['setup_your_pixel_span']         = 'Setup your pixel';
$lang['index_blade']['setup_methord_label']         = 'Start a setup method';
$lang['index_blade']['post_url_head']         = 'Postback URL';
$lang['index_blade']['dummy_txt_para']         = 'The dummy copy at this site is made from a dictionary of 500 words from Ciceros original source and ... Lorem Ipsum dummy text based on artificial languages.';
$lang['index_blade']['install_in_website_head']         = 'Install in your website or application';
$lang['index_blade']['event_tracking_action']         = 'Event Tracking';
$lang['index_blade']['add_event_track_head']         = 'Add the events you would like to track';
$lang['index_blade']['select_event_categories_para']         = 'Select the event categories that are meaningful to your business and choose how you would like to track them.';
$lang['index_blade']['custom_label_checkbox']         = 'Custom';
$lang['index_blade']['event_fits_div']         = 'Can not see an event that fits? ';
$lang['index_blade']['custom_events_action']         = 'Learn more about custom events';
$lang['index_blade']['pixel_install_method_label']         = 'Pixel Installation Method';
$lang['index_blade']['pixel_code_header_para']         = 'Add the pixel code to your site so that it loads on each web page. This is typically done by adding it to the global header of your website.';
$lang['index_blade']['locate_code_header_heading']         = 'Locate the header code for your website';
$lang['index_blade']['header_website_bold_div']         = 'Find the <b>&lt;head&gt; &lt;/head&gt; tags</b> in your web page code, or locate the <b>header template</b> in your CMS or web platform. ';
$lang['index_blade']['learn_template_bold_action']         = 'Learn where to find this template or code';
$lang['index_blade']['web_management_remaining_div']         = 'in different web management systems.';
$lang['index_blade']['pixel_website_header_heading']         = 'Copy the entire pixel code and paste it into the website header';
$lang['index_blade']['pixel_paste_header_div']         = ' Paste the pixel code at the bottom of the header section, just above the ';
$lang['index_blade']['facebook_pixels_div_rem']         = 'tag. Facebook pixel code can be added above or below existing tracking tags (such as Google Analytics) in your site header.';
$lang['index_blade']['check_pixel_code_end_para']         = 'If the status is still No activity yet after 20 minutes, your pixel code may not be installed correctly. Get guidance on installing your pixel. You can also visit Test Events in Events Manager to check your setup and troubleshoot individual pages.';
$lang['index_blade']['insert_pixel_bold_code']         = 'insert_pixel_code_here';
$lang['index_blade']['']         = '';
$lang['index_blade']['']         = '';

/************* ** Notifications ** *************/
$lang['application']['notifications']['title'] 					             = 'Notifications';
$lang['application']['notifications']['heading']                    	     = 'User Notification Settings';
//$lang['application']['notifications']['heading_description'] 				 = 'You can manage the visibility of notifications to users by enabling or disabling the switches provided below.';
$lang['application']['notifications']['form']['vclist'] 				     = 'Contact list has been imported';
$lang['application']['notifications']['form']['list_exported'] 				 = 'List has been exported';
$lang['application']['notifications']['form']['segment_exported'] 			 = 'Segment has been exported';
$lang['application']['notifications']['form']['segment_created'] 			 = 'Segment has been created';
$lang['application']['notifications']['form']['broadcast_scheduled'] 		 = 'Broadcast has been scheduled';
$lang['application']['notifications']['form']['broadcast_started'] 			 = 'Scheduled broadcast has been started';
$lang['application']['notifications']['heading_description']                 = 'Control the notifications that should be visible to the users by enabling/disabling the switches below.';
$lang['application']['notifications']['form']['vclist_help'] 			     = 'Enable or disable the visibility of contact list import notifications on the dashboard for users.';
$lang['application']['notifications']['form']['list_exported_help'] 			     = 'Enable or disable the visibility of List export notifications on the dashboard for users.';
$lang['application']['notifications']['form']['segment_exported_help'] 			     = 'Enable or disable the visibility of segment export notifications on the dashboard for users.';
$lang['application']['notifications']['form']['segment_created_help'] 			     = 'Enable or disable the visibility of segment creation notifications on the dashboard for users.';
$lang['application']['notifications']['form']['broadcast_scheduled_help'] 			     = 'Enable or disable the visibility of broadcast has been scheduled notifications on the dashboard for users.';
$lang['application']['notifications']['form']['broadcast_started_help'] 			     = 'Enable or disable the visibility of broadcast has been started notifications on the dashboard for users.';
$lang['application']['notifications']['form']['broadcast_finished_help'] 			     = 'Enable or disable the visibility of broadcast has been finished notifications on the dashboard for users.';
$lang['application']['notifications']['form']['broadcast_autopaused_monthly_limit_help'] 			     = 'Enable or disable the visibility of broadcast auto-paused due to monthly limit notifications on the dashboard for users.';
$lang['application']['notifications']['form']['broadcast_autopaused_daily_limit_help'] 			     = 'Enable or disable the visibility of broadcast auto-paused due to daily limit notifications on the dashboard for users.';
$lang['application']['notifications']['form']['broadcast_systempaused_node_help'] 			     = 'Enable or disable the visibility of broadcast paused due to sending node failure notifications on the dashboard for users.';
$lang['application']['notifications']['form']['trigger_notifications_help'] 			     = 'Enable or disable the visibility of trigger inactivity notifications on the dashboard for users.';


$lang['application']['notifications']['form']['broadcast_finished'] 			                	= 'Broadcast has been finished';
$lang['application']['notifications']['form']['broadcast_autopaused_monthly_limit'] 				= 'Broadcast auto-paused due to the monthly limit reached';
$lang['application']['notifications']['form']['broadcast_autopaused_daily_limit'] 			    	= 'Broadcast auto-paused due to the daily limit reached';
$lang['application']['notifications']['form']['broadcast_systempaused_node'] 			        	= 'Broadcast system-paused due to the sending node failure';
$lang['application']['notifications']['form']['sending_node_failed'] 				                = 'Sending node failed';
$lang['application']['notifications']['form']['trigger_action_status'] 				                = 'Triggers action status';
$lang['application']['notifications']['form']['trigger_notifications'] 			                	= 'Trigger has been automatically set as inactive.';
$lang['application']['count_limits']['realtime']				                                    = 'Realtime';
$lang['application']['count_limits']['monthly']				                                        = 'Monthly';
$lang['application']['count_limits']['never']				                                        = 'Never';
$lang['application']['count_limits']['title']				                                        = 'Recount limits upon contacts deletion';
$lang['message']['primary_domain'] 			                                                    	= 'This domain is restricted and can not be used as a primary domain. Try with another domain!';
$lang['active_session']['type']['file']                                                             = 'File';
$lang['active_session']['type']['db']                                                               = 'Database';

$lang['message']['folder_not_found'] = "The folder doesn\'t exist";
$lang['message']['folder_permission_error'] = "The folder doesn\'t have recursive writable (0777) permissions";


$lang['application']['enable_unsub_form_title']	 = 'Enable Unsubscribe Form';
$lang['application']['enable_unsub_form_desc']	 = 'This functionality enables the inclusion of an unsubscribe form for subscribers who wish to opt out from your mailing lists. :domain_name';

$lang['branding']['step4']['title']                                       = 'Head Section';
$lang['branding']['step4']['form']['heading']                             = 'Head Section Code';
$lang['message']['updated_custom_head']                                   ='Custom Head Successfully Updated.';

$lang['conversations']['index_second_blade']['selected_array_alert'] = 'Selected arrays...';
$lang['conversations']['index_second_blade']['day_baloon_txt'] = 'Day';
$lang['conversations']['index_second_blade']['year_baloon_txt'] = 'Year';
$lang['conversations']['index_second_blade']['event_postback_span'] = 'Select one event for a single postback.';
$lang['conversations']['index_blade']['purchased_v_div'] = 'Purchased(c=usd,v=47.00)';
$lang['conversations']['index_blade']['system_variables_mumara_div'] = 'Before you can track conversions by campaign, you’ll need to add a couple of system variables in your email hyperlinks that will allow Mumara to track which contact exactly performed the event.';
$lang['conversations']['index_blade']['url_parameters_embed_div'] = 'Embed the following tracking URL parameters at the end of hyperlinks that you want to track conversions for';
$lang['conversations']['index_blade']['note_var_network_div'] = 'Note: var can be any variable supported by your destination network. It could be var, var2, var3, s1, s2 etc.';
$lang['conversations']['index_blade']['destination_url_div'] = 'So if your destination URL is';
$lang['conversations']['index_blade']['then_will_become_div'] = 'then it will become';
$lang['conversations']['index_blade']['note_postback_url_div'] = 'Note: &#123;&#123;var1&#125;&#125; is the postback variable that your destination website/network will send you back. It is not mandatory that the variable will be posted back in "", it could be any identifier so make sure you use the correct one. e.g %%var1%%, &#123;var1&#125;, (var1) etc.';
$lang['conversations']['index_blade']['catches_footprints_div'] = 'You’re not done here. You need to add the following codes to your destination webpage so it catches the footprints of the contact and parse back in the postback URL when event occur.';
$lang['conversations']['index_blade']['then_will_become_div'] = 'then it will become'; 
$lang['conversations']['index_blade']['error_txt_div'] = 'Error';

$lang['conversations']['index_second_blade']['enter_url_alert'] = 'Please enter an URL.';
$lang['conversations']['index_second_blade']['url_invalid_alert'] = 'URL entered is Invalid.';
$lang['conversations']['index_second_blade']['select_one_event_alert'] = 'You can select one event at a time...';


$lang['application']['general']['form']['disable_cname_domain_help']        = 'You can choose to disable the CNAME option for the tracking domain within the system, restricting users from utilizing it.';
$lang['application']['general']['form']['disable_htaccess_domain_help']        = 'You can configure the system to disable the .htaccess option for the tracking domain, preventing users from utilizing it.';
$lang['application']['general']['form']['disable_cloak_label_help']        = 'You have the capability to disable the CLOAK option for the tracking domain, restricting users from utilizing it within the system.';
$lang['application']['general']['form']['count_limits_help']        = 'Please set the default mode for recounting contacts after deletion by users.';
$lang['application']['general']['form']['disable_selection_sender_id_help']        = 'This feature allows you to enable or disable Sender Information while sending a test preview on broad cast edit page';
$lang['application']['general']['form']['broadcast_unsubscribe_link_help']        = 'You have the option to set the default on/off status of the unsubscribe button in the schedule wizard.';
$lang['application']['general']['form']['esp_method_title_help']        = 'The choice between real-time and cron method depends on your specific needs and the nature of your application. If you require immediate actions and real-time tracking of email events, the real-time method is more suitable. On the other hand, if real-time processing is not critical and batch processing at intervals is sufficient, the cron method can be a more efficient approach.';
$lang['application']['general']['form']['gravatar']        = 'Gravatar Integration';
$lang['application']['general']['form']['allow_user_branding']        = 'Embed User Branding';
$lang['application']['general']['form']['gravatar_help']            ='Users with matching login email addresses can now access their profile pictures from Gravatar.';

$lang['application']['general']['form']['gravatar_allowed']        = 'Your profile image will now be automatically synchronized from Gravatar';
$lang['application']['general']['form']['gravatar_not_allowed']        = 'Gravatar is not allowed in your country';
return $lang;