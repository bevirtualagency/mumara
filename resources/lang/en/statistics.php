<?php
include("variables.php");
/**
 * Created by Mumara Team
 * Date: 07/14/2020
 */
/*-------------- 1. Statistics -> Broadcast Stats ----------------*/

$lang['broadcast']['page']['title']                 = 'Broadcast Stats';
$lang['broadcast']['page']['title']                 = 'Broadcast Stats';
$lang['broadcast']['page']['description']           = 'View detailed reporting of every email and broadcast that you have sent. The reporting includes open/click tracking, geo-information, graphical stats, delivery information, logs, and more.';

/************* ** Broadcast Stats Datatable ** *************/
$lang['broadcast']['column']['id']                 = 'ID';
$lang['broadcast']['column']['sr']                 = 'Sr.';
$lang['broadcast']['column']['label']              = 'Schedule Label';
$lang['broadcast']['column']['schedule_by']        = 'Scheduled By';
$lang['broadcast']['column']['campaign_name']      = 'Broadcast';
$lang['broadcast']['column']['type']               = 'Audience';
$lang['broadcast']['column']['start_time']         = 'Start Time';
$lang['broadcast']['column']['contacts']           = 'Contacts';
$lang['broadcast']['column']['sent']               = 'Sent';
$lang['broadcast']['column']['skipped']            = 'Skipped';
$lang['broadcast']['column']['opened']             = 'Opened';
$lang['broadcast']['column']['clicked']            = 'Clicked';
$lang['broadcast']['column']['unsubscribed']       = 'Unsubscribed';
$lang['broadcast']['column']['details']            = 'Details';
$lang['broadcast']['column']['download']            = 'Download'; //added azeem dated 28-10-2021
/*-------------- 1.1 Statistics -> Broadcast Stats -> Detailed Statistics ----------------*/
$lang['broadcast']['detail']['page']['title']            = 'Detailed Statistics';
$lang['broadcast']['detail']['page']['description']      = 'Email Campaign Results';
$lang['detail']['export_options']['title']               = 'Export Options';
$lang['detail']['export_options']['overview_pdf']        = 'Overview (pdf)';
$lang['detail']['export_options']['delivered_csv']       = 'Delivered (csv)';
$lang['detail']['export_options']['opened_csv']          = 'Opened (csv)';
$lang['detail']['export_options']['clicked_csv']         = 'Clicked (csv)';
$lang['detail']['export_options']['unsubscribed_csv']    = 'Unsubscribed (csv)';
$lang['detail']['export_options']['bounced_csv']         = 'Bounced (csv)';
$lang['detail']['export_options']['complaints_csv']      = 'Complaints (csv)';
$lang['detail']['export_options']['logs_csv']            = 'Logs (csv)';
$lang['detail']['export_options']['export_all']          = 'Export All';
// Summary Tab
$lang['detail']['summary']['title']      = 'Summary';
$lang['detail']['schedule_label']        = 'Schedule Label';
$lang['detail']['drip_group']            = 'Drip Group';
$lang['detail']['trigger']               = 'Trigger';
$lang['detail']['audience']              = 'Audience';
$lang['detail']['scheduled_by']          = 'Scheduled By';
$lang['detail']['sending_nodes']         = 'Sending Nodes';
$lang['detail']['sending_time']          = 'Time Started';
$lang['detail']['finished_time']         = 'Time Finished';
$lang['detail']['drip_age']              = 'Drip Age';
$lang['detail']['opened_title']          = 'Unique Opens / All Opens';
$lang['detail']['clicked_title']         = 'Unique Clicks / All Clicks';
$lang['detail']['bounces_title']         = 'Unique Bounces';
$lang['detail']['unsubs_title']          = 'Unique Unsubscribes';
$lang['detail']['ctr']                   = 'CTR';
$lang['detail']['username']              = 'Sent By';
$lang['detail']['broadcasts']            = 'Broadcasts';
$lang['detail']['hourly_speed']          = 'Hourly Speed';
$lang['detail']['trigger_age']           = 'Trigger Age';
$lang['detail']['campaign_duration']     = 'Campaign Duration';
$lang['detail']['total_contacts']        = 'Total Contacts';
$lang['detail']['threads']               = 'Threads';
$lang['detail']['sending_pattern']       = 'Sending Pattern';
$lang['detail']['sender_info']           = 'Sender Info';
$lang['detail']['From_SMTP']             = 'From SMTP';
$lang['detail']['sr']                    = 'Sr.';
$lang['detail']['id']                    = 'ID';
$lang['detail']['drip_result']           = 'Drip Results';
$lang['detail']['link']                  = 'Link'; 
$lang['detail']['client']                = 'Client';
$lang['detail']['no_of_open']            = '# of Opens';
$lang['detail']['others']                = 'Others';
$lang['detail']['deleted_list']          = 'Deleted List';

//added aby azeem dated 03-11-2021
// Open, Clicked, Unsubscribed Tab 
$lang['detail']['ocu']['column']['id']                    = 'ID';
$lang['detail']['ocu']['column']['email']                 = 'Email Address';
$lang['detail']['ocu']['column']['list']                  = 'List/Segment';
$lang['detail']['ocu']['column']['link_clicked']          = 'Link Clicked';
$lang['detail']['ocu']['column']['open_ip']               = 'IP Address';
$lang['detail']['ocu']['column']['bots']                  = 'Bot';
$lang['detail']['ocu']['column']['city']                  = 'City';
$lang['detail']['ocu']['column']['region']                = 'Region';
$lang['detail']['ocu']['column']['zip']                   = 'Zip';
$lang['detail']['ocu']['column']['country']               = 'Country';
$lang['detail']['ocu']['column']['browser']               = 'Browser';
$lang['detail']['ocu']['column']['os']                    = 'OS';
$lang['detail']['ocu']['column']['open_time']             = 'Date/Time';
// Bounced Tab 
$lang['detail']['bounced']['column']['bounce_type']       = 'Type';
$lang['detail']['bounced']['column']['code']              = 'Code (Rule id)';
$lang['detail']['bounced']['column']['bounce_reason']     = 'Reason';
$lang['detail']['bounced']['column']['bounce_details']    = 'Details';
$lang['detail']['bounced']['column']['sending_node']      = 'Sending Node';
$lang['detail']['bounced']['column']['message_id']        = 'Message ID';
// Logs Tab 
$lang['detail']['logs']['column']['activity']             = 'Activity';
$lang['detail']['logs']['column']['status']               = 'Status';
$lang['detail']['logs']['column']['sending_node']         = 'Sending Node';
$lang['detail']['logs']['column']['message']              = 'Message-ID';
$lang['detail']['logs']['column']['created_at']           = $created_on;
$lang['detail']['logs']['column']['last_activity']        = 'Last Activity';
$lang['detail']['logs']['column']['mta_response']        = 'Response';

$lang['controller']['contact_heading']           = 'Contact Lists';
$lang['controller']['segments_heading']           = 'Segments';
$lang['controller']['email_delevered_head']           = 'Email';
$lang['controller']['time_delevered_header']           = 'Delivered Time';
$lang['controller']['echo_permission_error']           = 'permission_error';
$lang['controller']['log_click_star_error']           = 'Export click stas are not saved ';
$lang['controller']['list_name_Not_found']           = 'Not Found';
$lang['controller']['contact_display_id']           = 'Click to display';
$lang['evergreen_campaigns']['option_select_campaign']           = 'Select Campaign';
$lang['details_blade']['span_open']           = 'Opened';
$lang['details_blade']['span_unopen']           = 'Unopened';
$lang['details_blade']['segments_td']           = 'Segments';
$lang['details_blade']['split_test_span']           = 'Split Test';
$lang['details_blade']['winning_broadcast_td']           = 'Winning Broadcast';
$lang['details_blade']['label_exclusive']           = 'Exclude bots';
$lang['details_blade']['label_display_email']           = 'Display Emails';
$lang['details_blade']['label_condition']           = 'Conditions';
$lang['details_blade']['label_add_condition']           = 'Add Condition';
$lang['details_blade']['label_and_select']           = 'and';
$lang['details_blade']['button_close']           = 'Close';
$lang['details_blade']['button_add']           = 'Add';

$lang['autoresponder_details_blade']['tittle_open_unique_total']           = 'Unique Opens / Total Opens';
$lang['autoresponder_details_blade']['tittle_clicked_unique_total']           = 'Unique Clicked / Total Clicked';
$lang['email_campaigns_blade']['bold_heading_note']           = 'Note.';
$lang['email_campaigns_blade']['div_txt_statistics_data']           = 'The statistics data for older than';
$lang['email_campaigns_blade']['div_txt_statistics_data_end_warning']           = 'days will be deleted automatically.';
$lang['email_campaigns_blade']['bold_heading_note']           = 'Note.';
$lang['email_campaigns_blade']['bold_heading_note']           = 'Note.';






/*-------------- 2. Statistics -> Trigger Stats ----------------*/

$lang['trigger']['page']['title']                 = 'Trigger Stats';
$lang['trigger']['page']['description']           = 'Triggers are the defined automated actions performed upon occurring an event. An event is your defined criteria of anything being happened that '.$siteTitle.' can understand.';

/************* ** Trigger Stats Datatable ** *************/
$lang['trigger']['column']['id']                 = 'ID';
$lang['trigger']['column']['sr']                 = 'Sr.';
$lang['trigger']['column']['name']               = 'Name';
$lang['trigger']['column']['criteria']           = 'Audience';
$lang['trigger']['column']['action']             = 'Action';
$lang['trigger']['column']['contact_count']      = 'Total actions';
$lang['trigger']['column']['last_activity']      = 'Last activity';
$lang['trigger']['column']['details']            = 'Details';
/*-------------- 2.1 Statistics -> Trigger Stats -> Drip Statistics ----------------*/
$lang['drip']['detail']['page']['title']          = 'Trigger Details';
/************* ** Drip Statistics Datatable ** *************/
$lang['drip']['column']['name']               = 'Drip Name';
$lang['drip']['column']['interval']           = 'Interval';
$lang['drip']['column']['last_activity']      = 'Last activity';
$lang['drip']['column']['details']            = 'Details';

/************* ** Modals ** *************/
$lang['modal']['contact_details']      = 'Contact Details';
$lang['modal']['skipped_details']      = 'Skipped Details';
$lang['modal']['suppressed']           = 'Suppressed';
$lang['modal']['domain_suppressed']    = 'Domain Suppressed';
$lang['modal']['duplicate_email']      = 'Duplicate Emails';

$lang['modal']['download_customer_field']['title']= 'Export Statistics';
$lang['modal']['download_customer_field']['description']= 'The export process is about to begin and a CSV file will be downloaded to your computer.';
$lang['modal']['download_customer_field']['checkbox']= "Also include the recipient's Custom Field data";
$lang['modal']['download_customer_field']['button_name']= "Export ";
$lang['modal']['download_customer_field']['bots_open']= "Bots column included in opened?";
$lang['modal']['download_customer_field']['bots_click']= "Bots column included in clicked?";
$lang['modal']['download_customer_field']['bots_open_click_all']= "Bots column included in opened/clicked?";
$lang['modal']['stats_download']['running_in_background']= "Export Stats in Background";
$lang['modal']['stats_download']['running_in_background_message']= "Download All Stats Command is running in Background";


/************* ** Message ** *************/
$lang['message']['stats_not_found']    = 'Campaign Stats not found!';
$lang['message']['no_stats_found']     = 'No Stats Found!';
/************* ** General ** *************/
$lang['title'] = 'Statistics';
$lang['every_minute']   = 'Click stats are updated every 1 minute.';
$lang['last_updated']   = 'Last updated at';
$lang['all']            = 'All';
$lang['unique']         = 'Unique';
$lang['contact_delete']         = '<i>Deleted Contact</i>';
////******************open clicks******************

$lang['export']['open']['email']         = 'Email';
$lang['export']['open']['open_time']         = 'Open Time';
$lang['export']['open']['open_ip']         = 'Open IP';
$lang['export']['open']['city']         = 'City';
$lang['export']['open']['region']         = 'Region';
$lang['export']['open']['country']         = 'Country';
$lang['export']['open']['browser']         = 'Browser';
$lang['export']['open']['os']         = 'OS';
$lang['export']['open']['bot']         = 'Bot';
$lang['export']['clicked']['link']         = 'Link';
////******************Unsubscriber******************
$lang['export']['unsubscribed']['time']         = 'UnSubscribed Time';
////******************Bounce******************
$lang['export']['bounce']['time']         = 'Bounce Time';
$lang['export']['bounce']['type']         = 'Bounce Type';
$lang['export']['bounce']['code']         = 'Bounce Code';
$lang['export']['bounce']['reason']       = 'Bounce Reason';
////******************Complaints******************
$lang['export']['complain']['time']         = 'Complain Time';
////******************Logs******************
$lang['export']['logs']['activity']         = 'Activity';
$lang['export']['logs']['status']         = 'Status';
$lang['export']['logs']['response']         = 'Response';
$lang['export']['logs']['sending_node']         = 'Sending Node';
$lang['export']['logs']['message_id']         = 'Message ID';
$lang['export']['logs']['activity']         = 'Activity';

$lang['export']['logs']['bounced']         = 'Bounced';
$lang['export']['logs']['abuse']         = 'Abuse';
$lang['export']['logs']['injected']         = 'Injected';
$lang['export']['logs']['blocked']         = 'Blocked';
$lang['export']['logs']['delayed']         = 'Delayed';
$lang['export']['logs']['sent']         = 'Sent';
$lang['export']['logs']['delivered']         = 'Delivered';
$lang['export']['logs']['unsubscribed']         = 'Unsubscribed';
$lang['export']['logs']['opened']         = 'Opened';
$lang['export']['logs']['clicked']         = 'Clicked';
$lang['export']['logs']['failed']         = 'Failed';
$lang['export']['list']['created_at']         = 'Created At';

$lang['view_custom_criteria']['custom_criteria']         = 'Custom Criteria';
$lang['view_custom_criteria']['title']         = 'View Custom Criteria';


/*-------------- 1. Statistics -> Evergreen Stats ----------------*/

$lang['evergreen']['page']['title']                 = 'Evergreen Stats';
$lang['evergreen']['page']['description']           = 'View detailed reporting of every email and evergreen broadcast that you have sent. The reporting includes open/click tracking, geo-information, graphical stats, delivery information, logs, and more.';




return $lang;