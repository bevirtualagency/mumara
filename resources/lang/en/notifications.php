<?php
include("variables.php");
/************* ** User Notifications ** *************/
$lang['import_subscribers_completed'] = 'A contact list %%file_name%% has been imported into %%list_name%%'; 
$lang['export_subscribers_completed'] = 'The list %%list_name%% has been exported successfully';
$lang['export_segment_completed'] = 'The segment %%segment_name%% has been exported successfully';
$lang['segment_completed'] = 'The segment %%segment_name%% has been created successfully';
$lang['broadcast_scheduling'] = 'The broadcast %%broadcast_name%% has been scheduled'; 
$lang['schedule_broadcast_started'] = 'The scheduled broadcast %%broadcast_name%% has been started';
$lang['schedule_broadcast_finished'] = 'The broadcast %%broadcast_name%% has been finished'; 
$lang['broadcast_paused_monthly'] = 'The broadcast %%broadcast_name%% has been auto-paused due to the monthly limit reached'; 
$lang['broadcast_paused_daily'] = 'The broadcast %%broadcast_name%% has been auto-paused due to the daily limit reached';
$lang['broadcast_system_paused'] = 'The broadcast %%broadcast_name%% has been system-paused due to the sending node failure'; 
$lang['broadcast_paused'] = 'The broadcast %%broadcast_name%% has been paused'; 
$lang['smtp_failed'] = 'The sending node %%smtp_name%% is failed'; //The sending node %%smtp_name%% is failed
$lang['deleted_list'] = 'Deleted List';
$lang['deleted_file'] = 'Deleted File';
$lang['view_contact_list'] = 'View contact list';
$lang['download_file'] = 'Download file';
$lang['deleted_segment'] = 'Deleted_segment';
$lang['view_segmented_contacts'] = 'View segmented contacts';
$lang['view_scheduled_broadcasts'] = 'View scheduled broadcasts';
$lang['deleted_scheduled_broadcasts'] = 'Deleted exported scheduled broadcasts file';
$lang['view_statistics'] = 'View statistics';
$lang['go_to_statistics'] = 'Go to statistics';
$lang['view_sending_node'] = 'View sending node';
$lang['deleted_sending_node'] = 'Deleted sending node';
$lang['mark_as_read'] = 'Mark as Read';
$lang['mark_as_unread'] = 'Mark as Unread';
$lang['export_suppressed_email_completed'] = 'The suppressed email list %%file_name%% has been exported successfully';
$lang['export_suppressed_domain_completed'] = 'The suppressed domain list %%file_name%% has been exported successfully';
$lang['export_broadcast_logs'] = 'The scheduled broadcast %%broadcast_name%% logs has been exported successfully';
$lang['delete_broadcast_logs'] = 'File Deleted';
$lang['all_stats'] = 'All stats  of Schedule campaign:%%schedule_campaign%%  has successfully been exported';
$lang['open_email'] = 'open Email Log of Schedule campaign:%%schedule_campaign%%  has successfully been exported';
$lang['click_email'] = 'Click Email Log of Schedule campaign:%%schedule_campaign%%  has successfully been exported'; 
$lang['unsubscribed_email'] = 'Unsubscribed Email Logs of Schedule campaign:%%schedule_campaign%%  has successfully been exported';
$lang['bounced_email'] = 'Bounce Email Logs of Schedule campaign:%%schedule_campaign%%  has successfully been exported';
$lang['complaint_email'] = 'Complaint Email Logs of Schedule campaign:%%schedule_campaign%%  has successfully been exported';


$lang['campaign_stopped_by_policy_title'] = 'Stopped by Policy';
$lang['campaign_stopped_by_policy_hardbounce'] = 'This campaign has been stopped by System policy as the hard bounce rate reaches 10%.';
$lang['campaign_stopped_policy_notification'] = 'One of your campaign has been stopped by System policy as the hard bounce rate reaches :percentage%.';

$lang['notification_controller']['subscription_email_title'] = 'Subscription Email sent';
$lang['notification_controller']['subscription_complete_title'] = 'Subscription Complete';
$lang['notification_controller']['wooops_title'] = 'Woooops';

$lang['errors_404_blade']['oops_heading_title'] = 'Oops';
$lang['errors_404_blade']['not_found_title'] = 'Not Found';
$lang['errors_404_blade']['something_wrong_para'] = 'Looks like something went wrong.';
$lang['errors_404_blade']['we_working_para'] = 'We are working on it';
$lang['errors_404_blade']['go_dashboard_action'] = 'Go to Dashboard';
$lang['errors_503_blade']['mumara_error_title'] = 'Mumara | Error Page';
$lang['errors_503_blade']['access_denied_heading'] = 'Access Denied';
$lang['errors_503_blade']['how_you_get_para'] = 'How did you get here';
$lang['errors_503_blade']['not_find_page_para'] = 'Sorry we can not seem to find the page you are looking for.';
$lang['errors_503_blade']['mis_spelling_url_para'] = 'There may be a misspelling in the URL entered,';
$lang['errors_503_blade']['page_no_exist_para'] = 'or the page you are looking for may no longer exist.';
$lang['errors_505_blade']['access_denied_title'] = 'Access Denied';

$lang['errors_subscription_blade']['subscription_sucessful_heading'] = 'Subscription Successfull';
$lang['errors_subscription_blade']['subscription_complete_div'] = 'Your subscription is now complete.';
$lang['errors_subscription_blade']['subscription_contact_list_div'] = 'Thank you for subscribing to our contact list.';

$lang['subscription_email_blade']['subscription_complete_heading'] = 'Subscription almost complete';
$lang['subscription_email_blade']['your_subscription_complete_div'] = 'Your subscription is almost complete.';
$lang['subscription_email_blade']['email_sent_confirm_sub_div'] = 'An email has been sent to the email address you entered. Please click on the enclosed confirmation link to confirm your subscription.';
$lang['subscription_email_blade']['thank_you_heading'] = 'Thank You';

$lang['woops_blade']['woop_heading'] = 'Woops';
$lang['woops_blade']['look_page_heading'] = 'Looks like this page Doesn`t exist.';
$lang['woops_blade']['variations_random_div'] = 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or words which don`t look even slightly believable.';
$lang['woops_blade']['button_submit'] = 'Submit';
$lang['woops_blade']['helpful_links_button'] = 'Helpful Links';
$lang['woops_blade']['action_dashboard'] = 'Dashboard';
$lang['woops_blade']['action_view_lists'] = 'View Lists';
$lang['woops_blade']['action_view_contacts'] = 'View Contacts';
$lang['woops_blade']['action_view_campaings'] = 'View Campaigns';
$lang['woops_blade']['action_create_webform'] = 'Create a Webform';
$lang['woops_blade']['action_application_settings'] = 'Application Settings';
$lang['woops_blade']['action_white_labeling'] = 'White Labeling';
$lang['woops_blade']['action_broadcast_stats'] = 'Broadcast Stats';
$lang['woops_blade']['action_update_application'] = 'Update Application';
//SMTP_FAILED
return $lang;