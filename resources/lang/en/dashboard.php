<?php
include("variables.php");
/**
 * Created by Mumara Team
 * Date: 06/29/2020
 */
/*-------------- 1. Campaigns -> Spintags ----------------*/

$lang['page']['title']       = 'Dashboard';
// $lang['page']['description'] = 'View and manage currently available spin tags.';

/************* ** View Scheduled Datatable ** *************/
$lang['table_headings']['tag']        = 'Tag';
$lang['table_headings']['added_on']    = 'Added on';
$lang['table_headings']['actions']     = 'Actions';

/*-------------- Messages ----------------*/
$lang['message']['isssue_in_application'] = 'There are issues in the application.';
$lang['message']['device_stats_error']    = 'No device stats available.';
$lang['message']['license_key_verified']  = 'License Key successfully verified.';
$lang['message']['invalid_license_key']   = 'Invalid license key';
$lang['message']['license_key_expired'] = 'License key is Expired';
$lang['message']['license_key_suspended'] = 'License key is Suspended';
$lang['message']['invalid_response'] = 'Invalid Response';
$lang['message']['failed_license_key'] = 'Failed to verify the license key';
$lang['message']['db_verified'] = 'DB successfully verified.';
$lang['message']['db_connection_failed'] = 'Failed to connect to MySQL';
$lang['message']['app_installed_successfully'] = 'Application has been successfully installed!';
$lang['message']['set_cron_msg'] = 'Now please set the following entry into the server cron:';
$lang['message']['to_login_system'] = 'to login the system.';
$lang['message']['no_live_event'] = 'Waiting for events…';
$lang['message']['domain_disclaimer'] = 'These statistics are fetched from the scheduled campaigns and in some cases, it may not be accurate.';

/************* ** General ** *************/
$lang['unknown'] = 'Unknown';
$lang['autorefresh'] = 'Auto Refresh';
$lang['live_events'] = 'Live Events';
$lang['admin_events'] = 'Admin Events';
$lang['user_events'] = 'User Events';
$lang['view_issue'] = 'View Issue';
$lang['view_all_issues'] = 'View All Issues';
$lang['progress'] = 'Progress';
$lang['email_sent'] = 'Email Sent';
$lang['sending_nodes'] = 'Sending Nodes';
$lang['contacts'] = 'Contacts';
$lang['domains'] = 'Domains';
$lang['users'] = 'Users';
$lang['ram'] = 'RAM'; // dyn_tags.exists
$lang['cpu'] = 'CPU'; // dyn_tags.exists
$lang['sending_statistics'] = 'Sending Statistics';
$lang['sending_statistics_helptext'] = '';
$lang['sending_stats']= 'Sending Statistics';
$lang['apps'] = 'Apps';
$lang['integrated_apps'] = 'Integrated Apps';
$lang['top_domains'] = 'Top Domains';
$lang['opened_by_device'] = 'Opened by Device';
$lang['recent_schedules'] = 'Recent Schedules';
$lang['broadcasts'] = 'Broadcasts';
$lang['triggers'] = 'Triggers';
$lang['drips'] = 'Drips';
$lang['activity_log']['recent_activities'] = 'Recent Activities';
$lang['activity_log']['see_all'] = 'See All';
$lang['opened_by_countries'] = 'Opened by Countries';
$lang['country_name'] = 'Country Name';
$lang['opens'] = 'Opens';
$lang['trigger_stats_name'] = 'Name';
$lang['trigger_act_performance'] = 'Act. Performed';
$lang['no_of_performance'] = 'No Of Actions';
$lang['detail'] = 'Detail';
$lang['drip_stats_label'] = 'Label';
$lang['live_sending'] = 'Live Sending';
$lang['everyone'] = 'Everyone';
$lang['onliy_admins'] = 'Only Admins';
$lang['specific_users'] = 'Specific User';
$lang['segments_limit'] = 'Segments Limit';
$lang['triggers_limit'] = 'Triggers limit';
$lang['never_run'] = 'Never Run';
$lang['calculate_time'] = 'Calculating Time...';
$lang['desc'] = 'DESC';
$lang['campaign_log_id'] = 'Campaign Log ID';
$lang['subscriber'] = 'Subscriber';
$lang['email'] = 'Email';
$lang['label'] = 'Label';
$lang['opened'] = 'Opened';
$lang['clicked'] = 'Clicked';
$lang['monday'] = 'Monday';
$lang['tuesday'] = 'Tuesday';
$lang['wednesday'] = 'Wednesday';
$lang['thursday'] = 'Thursday';
$lang['friday'] = 'Friday';
$lang['saturday'] = 'Saturday';
$lang['sunday'] = 'Sunday';
$lang['jan'] = 'Jan';
$lang['feb'] = 'Feb';
$lang['mar'] = 'Mar';
$lang['apr'] = 'Apr';
$lang['may'] = 'May';
$lang['jun'] = 'Jun';
$lang['jul'] = 'Jul';
$lang['aug'] = 'Aug';
$lang['sep'] = 'Sep';
$lang['oct'] = 'Oct';
$lang['nov'] = 'Nov';
$lang['dec'] = 'Dec';
$lang['statistics_refreshed_every_hour'] = 'These statistics are refreshed every hour';
$lang['option']['all_user'] = 'All Users';
$lang['no_data'] = 'No data available';
$lang['b']['notice'] = '<b>Notice!</b>';
$lang['action']['switch'] = 'Switch Now';
/***** Top bar****/

$lang['topbar']['import_subscribers']= 'Import Subscribers';
$lang['topbar']['suppression_import']= 'Suppression Import';
$lang['topbar']['database_update_progress']= 'Database update in progress';
$lang['topbar']['deleting_list']= 'Deleting List';
$lang['topbar']['no_process_running']= 'No process running';
$lang['topbar']['Currently_Running_Processes']= 'Currently Running Processes';
$lang['allowed_ip_addresses_help']= 'Add the IP addresses or subnets (separated by a new line) that are allowed to use this API Token.';
$lang['topbar']['force_delete']= 'Force Delete';
$lang['topbar']['cumulative_usage']= 'Displaying cumulative usage and analytics data of the admins & users';
$lang['topbar']['trash_all_records']= 'Trash All Records';
$lang['topbar']['download_exported_files']= 'Download Exported Files';
$lang['topbar']['knowledgebase'] = 'Knowledge base';
$lang['topbar']['community_support'] = 'Community Support';
$lang['topbar']['feature_request'] = 'Feature Request';
$lang['topbar']['bug_report'] = 'Bug Report';
$lang['topbar']['profile'] = 'My Profile';
$lang['topbar']['profile_desc'] = 'View or update your profile information';
$lang['topbar']['security'] = 'Security';
$lang['topbar']['logout'] = 'Logout';
$lang['topbar']['switch_back'] = 'Switch Back';
$lang['topbar']['settings'] = 'Settings';
$lang['topbar']['settings_desc'] = 'View or update your setting';
$lang['topbar']['account_settings'] = 'Check account security or change password';
$lang['topbar']['optimizing_tables'] = 'Optimizing Tables';
$lang['topbar']['restart_optimizing'] = 'Restart Optimizing';
$lang['topbar']['view_all'] = 'View All';

//added by azeem dated 18-10-2021 live events
$lang['mumara_live_events']['clicked_event_list'] = '%%subscriber_name%% has clicked on an email %%link%%'; 
$lang['mumara_live_events']['clicked_event_trigger'] = '%%subscriber_name%% has clicked on a triggered email %%link%%'; ;
$lang['mumara_live_events']['clicked_event_drip'] = '%%subscriber_name%% has clicked on a drip %%link%%';

$lang['mumara_live_events']['clicked_event_list_email'] = "Email";
$lang['mumara_live_events']['clicked_event_list_drip'] = "Drip";
$lang['mumara_live_events']['clicked_event_list_trigger'] = "Trigger";

$lang['mumara_live_events']['open_event_campaign'] = '%%subscriber_name%% has opened an %%email%%';
$lang['mumara_live_events']['open_event_trigger'] = '%%subscriber_name%% has opened a triggered %%trigger_name%%'; 
$lang['mumara_live_events']['open_event_drip'] = '%%subscriber_name%% has opened a %%drip_name%%'; 

$lang['mumara_live_events']['unsub_event_campaign'] = '%%subscriber_name%% has been unsubscribed from the list %%list_name%%'; 
$lang['mumara_live_events']['contact_added'] = 'A %%subscriber_name%% has been added to the list %%list_name%%'; 
$lang['mumara_live_events']['link'] = 'link'; 
$lang['mumara_live_events']['link_not_found'] = 'Link not found'; 
//$lang['mumara_live_events']['unsub_event_trigger'] = '%%subscriber_name%% has unsubscribe from the %%trigger_name%% trigger';
//$lang['mumara_live_events']['unsub_event_drip'] = '%%subscriber_name%% has unsubscribe from the %%drip_name%% drip';
$lang['mumara_live_events']['deleted_list'] = 'Deleted list';
$lang['mumara_live_events']['some_one'] = 'Someone';
$lang['mumara_live_events']['contact_n'] = 'Contact';
$lang['mumara_live_events']['deleted_trigger'] = 'Deleted Trigger';
$lang['mumara_live_events']['deleted_drip'] = 'Deleted Drip';
$lang['mumara_live_events']['deleted_campaign'] = 'Deleted Campaign';
$lang['mumara_live_events']['deleted_list'] = 'Deleted List';
$lang['contact_lists'] = 'Contact Lists';
$lang['monthly_limit'] = 'Monthly Email Limit';
$lang['daily_limit'] = 'Daily Email Limit';
$lang['broadcasts'] = 'Broadcasts';
$lang['debug_mode_alter'] = 'Your application is running in debug mode, which could leak sensitive information. You can switch off the debug mode in Application Settings.';
$lang['database_time_not_utc'] = 'Your database\'s timezone is not set to UTC. Please update it.';

return $lang;