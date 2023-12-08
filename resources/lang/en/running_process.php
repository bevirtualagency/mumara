<?php
include("variables.php");
/**
 * Created by Mumara Team
 * Date: 07/22/2020
 */
/*-------------- Running Processes ----------------*/

$lang['page']['title']                 = 'Running Processes';
$lang['page']['description']           = 'Running Processes';

/************* ** View Scheduled Datatable ** *************/
$lang['table_headings']['id']         = 'ID';
$lang['table_headings']['user']       = 'User';
$lang['table_headings']['task']       = 'Task';
$lang['table_headings']['thread']     = 'Thread';
$lang['table_headings']['status']     = 'Status';
$lang['table_headings']['started']    = 'Started';
$lang['table_headings']['actions']    = 'Actions';

/************* ** Message ** *************/
$lang['message']['process_restarted']= 'Process successfuly restarted.';
$lang['message']['process_killed']= 'Process killed';
/************* ** General ** *************/
$lang['view_all_process']= 'View All Process';
$lang['kill_process']= 'Kill Process';
$lang['scheduled_at']= 'Scheduled at';
$lang['task']['suppressed_sync'] = 'Synchronizing contacts with the suppression table';
$lang['task']['running_campaign'] = 'Running Campaign';
$lang['task']['preparing_campaign'] = 'Preparing Campaign';
$lang['task']['list_exporting'] = 'List Exporting';
$lang['task']['updating_contacts'] = 'Updating Contacts';


return $lang;