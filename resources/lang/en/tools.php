<?php
include("variables.php");
/**
 * Created by Mumara Team
 * Date: 06/25/2020
 */
/*-------------- 1. Tools -> Cron Status ----------------*/

$lang['cron_status']['page']['title']                 = 'Cron Status';
$lang['cron_status']['page']['description']           = 'Cron Status Help';
$lang['cron_status']['heading']                       = 'Cron Information';
$lang['cron_status']['job_command']                   = 'Cron Job Command';
$lang['cron_status']['job_time']                      = 'Cron Job Time';
$lang['cron_status']['every']                         = 'Every';
$lang['cron_status']['mins']                          = 'Min(s)';
$lang['cron_status']['email_scheduling']              = 'Email Scheduling';
$lang['cron_status']['last_run']                      = 'Last Run';
$lang['cron_status']['mins_ago_at']                   = 'mins ago';
$lang['cron_status']['not_yet'] = 'Not Yet';
$lang['cron_status']['trigger_processing'] = 'Trigger Processing';
$lang['cron_status']['bounce_processing'] = 'Bounce Processing';
$lang['cron_status']['fbl_processing'] = 'FBL Processing';
$lang['cron_status']['callbacks_processing'] = 'Callbacks Processing';
$lang['cron_status']['maintenance_cron'] = 'Maintenance Cron';

/*-------------- 2. Tools -> Bug Report ----------------*/

$lang['bug_report']['page']['title']                 = 'Bug Report';
$lang['bug_report']['page']['description']           = 'List of all reported bugs with their status.';
$lang['bug_report']['open']="Open";
$lang['bug_report']['reply']="Reply";
$lang['bug_report']['view_reply']="View Reply";
$lang['bug_report']['send_message']="Send Message";
$lang['bug_report']['medium']="Medium";
$lang['bug_report']['high']="High";
$lang['bug_report']['low']="Low";

/************* ** Bug Reply Table ** *************/
$lang['bug_report']['bug_reply']         ="Bug Reply";
$lang['bug_reply']['sr']                 ="Sr.";
$lang['bug_reply']['user_type']          ="User Type";
$lang['bug_reply']['reply']              ="Reply";
$lang['bug_reply']['reply_date']         ="Reply Date";
/************* ** Bug Report Datatable ** *************/
$lang['bug_report']['table']['column']['section'] ="Section"; 
$lang['bug_report']['table']['column']['subject'] ="Subject"; 
$lang['bug_report']['table']['column']['description'] ="Description"; 
$lang['bug_report']['table']['column']['priority'] ="Priority"; 
$lang['bug_report']['table']['column']['status'] ="Status"; 
$lang['bug_report']['table']['column']['added_on'] =$created_on; 
$lang['bug_report']['table']['column']['details'] ="Details"; 

/*-------------- 3. Tools -> PHP Info ----------------*/
$lang['phpinfo']['page']['title']                 = 'PHP Info';
$lang['phpinfo']['page']['description']           = 'Showing all PHP Info';
/************* ** Message ** *************/
$lang['message']['replied_successfully'] = 'Replied Successfully';
$lang['message']['oops'] = 'Oops Something went Wrong';
$lang['message']['reported'] = 'Bug Reply Reported Successfully';
$lang['message']['bug_reported'] = 'Bug Reported successfully';
/************* ** General ** *************/
$lang['title'] = 'Tools';
$lang['update'] = 'Update';
/// exported files  
$lang['exported_files']['label']['title'] = 'Exported Files';
$lang['exported_files']['label']['description'] = 'Exported files page is where you view and export your contact list, segments export list etc.';
$lang['exported_files']['label']['file_name'] = 'Name';   
$lang['exported_files']['label']['deleted_time'] = 'Deleting In';   
$lang['exported_files']['label']['username'] = 'User';   
$lang['exported_files']['label']['created_at'] = 'Creation Date';  
$lang['exported_files']['label']['action'] = 'Action';  
$lang['exported_files']['label']['delete'] = 'Delete';  
$lang['exported_files']['label']['download'] = 'Download';  
$lang['exported_files']['label']['file_type'] = 'Type';
$lang['exported_files']['label']['preparing'] = 'Preparing';

$lang['exported_files']['label']['stats'] = 'All Stats'; 

$lang['exported_files']['label']['contact_list'] = 'Contact List'; 
$lang['exported_files']['label']['segment'] = 'Segment'; 
$lang['exported_files']['label']['email_suppression'] = 'Email Suppression'; 
$lang['exported_files']['label']['domain_suppression'] = 'Domain Suppression'; 

$lang['exported_files']['label']['hours'] = 'Hours'; 
$lang['exported_files']['label']['minutes'] = 'Minutes'; 
$lang['exported_files']['label']['seconds'] = 'Seconds'; 
$lang['exported_files']['label']['delete_all'] = 'Delete All'; 
$lang['exported_files']['label']['download_in_progress'] = 'Dowbnloading in Progress'; 

$lang['exported_files']['download_list'] = 'Download Contact List'; 
$lang['exported_files']['download_segment'] = 'Download Segment'; 
$lang['exported_files']['download_suprresed_email'] = 'Download Supressed Email List'; 
$lang['exported_files']['download_suprresed_domain'] = 'Download Supressed Domain List'; 
$lang['exported_files']['download_logs'] = 'Download Logs'; 
$lang['exported_files']['page']['title'] = 'Exported Files';
$lang['exported_files']['label']['logs'] = 'Logs';
$lang['exported_files']['label']['opens'] = 'Opens';
$lang['exported_files']['label']['clicks'] = 'Clicks';
$lang['exported_files']['label']['unsubscribed '] = 'Unsubscribed';
$lang['exported_files']['label']['bounced '] = 'Bounced';
$lang['exported_files']['label']['complaints '] = 'Complaints';


$lang['feedback_loop']['title'] = 'Processed';
 








$lang['controller']['curl_connecting_error_log'] = 'cURL error when connecting to';
$lang['controller']['label'] = '';

return $lang;