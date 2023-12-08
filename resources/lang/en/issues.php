<?php
include("variables.php");
/**
 * Created by Mumara Team
 * Date: 07/23/2020
 */
/*-------------- Issues ----------------*/

$lang['page']['title']                 = 'Issues';
$lang['page']['description']           = 'Issues Description';

/************* ** Issues Datatable ** *************/
$lang['table_headings']['user']            = 'User';
$lang['table_headings']['module']          = 'Module';
$lang['table_headings']['details']         = 'Details';
$lang['table_headings']['suggestions']     = 'Suggestions';
$lang['table_headings']['actions']         = 'Actions';

/*-------------- Issues -> add new ----------------*/
$lang['add_new']['page']['title']       = 'Add a Spintag';
$lang['edit']['page']['title']          = 'Edit Spintag';
$lang['add_new']['page']['description'] = 'It helps to be more specific by collecting additional and more personalized information using spintags. Enter the name of the spintag and a List of word values.';

$lang['add_new']['form']['heading']              = 'SpinTag Field Detail';
$lang['add_new']['form']['name']                 = 'Name / Placeholder';
$lang['add_new']['form']['name_help']            = 'This name will act as a variable in the broadcast content';
$lang['add_new']['form']['list_of_words']        = 'List of Words';
$lang['add_new']['form']['list_of_words_help']   = 'Line separated list of words or phrases that will be randomly selected while sending emails';

/************* ** General ** *************/
$lang['Retry_All'] = 'Retry All';
$lang['Resolve_All'] = 'Resolve All';
$lang['Last_Checked'] = 'Last Checked';
$lang['Mark_Resolved'] = 'Mark Resolved';
$lang['Retry'] = 'Retry';
$lang['resolved'] = 'Resolved';
$lang['not_resolved'] = 'Not Resolved';
$lang['in_progress'] = 'In Progress';
$lang['closeClockAlert'] = 'We have updated the cloaking method, you are advised to download the latest cloaking file and replace on your (:clockMethod) tracking domain(s) using cloaking method.';
$lang['closeClockAlertBtn'] = 'Ok, Got it.';

$lang['issues_controller']['issue_notification_description']              = 'Issue Notifications Description';
$lang['issues_controller']['issue_notification_title']              = 'Issue Notifications';
$lang['issues_controller']['add_new_title']              = 'Add New';
$lang['create_blade']['issue_notification_heading']              = 'Issue Notification Template';
$lang['create_blade']['notification_message_label']              = 'Notification Message';
$lang['create_blade']['notification_icon_label']              = 'Notification Icon';
$lang['create_blade']['apple_brands_span']              = 'apple - Brands';
$lang['create_blade']['add_issue_notification_title']              = 'Add Issue Notification Template';
return $lang;