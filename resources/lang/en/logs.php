<?php
include("variables.php");
/**
 * Created by Mumara Team
 * Date: 07/15/2020
 */
/*-------------- 1. Tools -> Logs -> Debug Logs ----------------*/
$lang['debug']['page']['title']                          = 'Debug Logs';
$lang['debug']['page']['description']                    = 'To help you learn more about what\'s happening within your application, '.$siteTitle.' provides robust logging services that allow you to log messages, the system error log.';
$lang['debug']['delete_log_file']                        = 'DELETE LOG FILE';

/*-------------- 2. Tools -> Logs ->  Debug Logs -> Explore Log File ----------------*/
$lang['debug']['explore']['page']['title']               = 'Explore Log File';
$lang['debug']['explore']['page']['description']         = 'Explore Log File';

/*-------------- 2. Tools -> Logs -> Authentication Logs ----------------*/
$lang['authentication']['page']['title']                 = 'Authentication Logs';
$lang['authentication']['page']['description']           = 'Authentication Logs';

/*-------------- 2. Tools -> Logs -> Activity Logs ----------------*/
$lang['activity']['page']['title']                       = 'Activity Logs';
$lang['activity']['page']['description']                 = 'Activity Logs';

/*-------------- 2. Tools -> Logs -> failed Jobs Logs ----------------*/
$lang['jobs']['page']['title']                       = 'Failed Jobs Logs';
$lang['jobs']['page']['description']                 = 'Failed Jobs Logs';
$lang['jobs']['page']['connection']                 = 'Connection';
$lang['jobs']['page']['queue']                 = 'Queue';
$lang['jobs']['page']['exception']                 = 'Exception';
$lang['jobs']['page']['failed_at']                 = 'Failed At';
/*-------------- 2. Tools -> Logs -> Esp Callbacks ----------------*/
$lang['callbacks']['page']['title']                      = 'Esp Callback Logs';
$lang['callbacks']['page']['description']                = 'Esp Callback Logs';

/************* ** Logs Datatable ** *************/
$lang['table']['column']['id']            = 'ID';
$lang['table']['column']['sr']            = 'Sr.';
$lang['table']['column']['name']          = 'Name';
$lang['table']['column']['ip']            = 'IP';
$lang['table']['column']['activity']      = 'Activity';
$lang['table']['column']['description']   = 'Description';
$lang['table']['column']['creation_date'] = $created_on;

/************* ** Messaage ** *************/
$lang['message']['delete_alert']      = 'Are you sure you want to <span class="badge badge-danger">DELETE</span> this log file';
$lang['message']['ajax_error']        = 'AJAX ERROR ! Check the console !';
$lang['message']['lack_of_coffee']    = 'OOPS ! This is a lack of coffee exception !';
$lang['message']['response_copied']   = 'Data Response successfully copied.';

/************* ** Levels ** *************/
$lang['level']['all']        = 'All';
$lang['level']['emergency']  = 'Emergency';
$lang['level']['alert']      = 'Alert';
$lang['level']['critical']   = 'Critical';
$lang['level']['error']      = 'Error';
$lang['level']['notice']     = 'Notice';
$lang['level']['warning']    = 'Warning';
$lang['level']['info']       = 'Info';
$lang['level']['debug']      = 'Debug';
/************* ** General ** *************/
$lang['title']            = 'Logs';
$lang['activity_title']   = 'Logs';
$lang['log_viewer']       = 'Log Viewer';
$lang['levels']           = 'Levels';
$lang['info']             = 'Log info';
$lang['file_path']        = 'File path';
$lang['log_entries']      = 'Log entries';
$lang['size']             = 'Size';
$lang['created_at']       = 'Created at';
$lang['updated_at']       = 'Updated at';
$lang['ENV']              = 'ENV';
$lang['Level']            = 'Level';
$lang['Time']             = 'Time';
$lang['Header']           = 'Header';
$lang['Actions']          = 'Actions';
$lang['stack']            = 'Stack';
$lang['general']['empty-logs']            = 'Logs not found';

$lang['logs_campaign_blade']['campaign_schedule_blade_title']        = 'Campaign Schedule Logs'; 
$lang['logs_campaign_blade']['logs_txt_span']        = 'Logs'; 

$lang['logs_bootstrap_master']['log_viewer_action']        = 'LogViewer'; 
$lang['logs_bootstrap_master']['dashboard_action']        = 'Dashboard'; 
$lang['logs_bootstrap_master']['version_para']        = 'version'; 
$lang['logs_bootstrap_master']['created_with_para']        = 'Created with'; 
$lang['logs_bootstrap_master']['arcanedev_with_para']        = 'by ARCANEDEV';
$lang['logs_bootstrap_master']['title_log_created_by']        = 'LogViewer - Created by ARCANEDEV'; 

$lang['logs_show_blade']['log_heading']        = 'Log';
$lang['logs_show_blade']['span_page_txt']        = 'Page';
$lang['logs_show_blade']['span_of_txt']        = 'of';
return $lang;