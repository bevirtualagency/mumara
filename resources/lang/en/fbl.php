<?php
include("variables.php");
/**
 * Created by Mumara Team
 * Date: 07/10/2020
 */
/*-------------- 1. Setup -> Feedback Loops ----------------*/

$lang['page']['title']                 = 'Feedback Loops';
$lang['page']['description']           = 'Get rid of the problematic subscribers who are reporting you as abuse by processing feedback loops (also known as FBL). The mailbox provider forwards the message complained about back to the sender at a designated email address that has been set up, primarily so that the sender can suppress this user in their database.';
$lang['processed']['title']           = 'Processed Feedback Loops';
$lang['processed']['description']           = 'Processed Feedback Loops Description';

/************* ** Feedback Loops Datatable ** *************/
$lang['table_headings']['name']         = 'Name';
$lang['table_headings']['email']         = 'FBL Email';
$lang['table_headings']['status']         = 'Status';
$lang['table_headings']['last_processed']         = 'Last Processed';
$lang['table_headings']['host']         = 'Host';
$lang['table_headings']['username']     = 'Username';
$lang['table_headings']['method']       = 'Method';
$lang['table_headings']['port']         = 'Port';
$lang['table_headings']['added_on']     = $created_on;
$lang['table_headings']['complaints']     = 'Complaints';
$lang['table_headings']['actions']      = 'Actions';
$lang['th']['abuser']      = 'Abuser';
$lang['th']['contact']      = 'Contact ID';
$lang['th']['user']      = 'User';
$lang['th']['broadcast']      = 'Campaign/Trigger';
$lang['th']['abused_at']      = 'Complaint Time';
$lang['th']['log_id']      = 'Log ID';
$lang['th']['message_id']      = 'Message ID';
$lang['th']['sr']      = 'Sr.';

/*-------------- 1.1 Setup -> Feedback Loops -> add new ----------------*/
$lang['add_new']['page']['title']       = 'Add a Feedback Loop';
$lang['edit']['page']['title']          = 'Edit Feedback Loop';
$lang['add_new']['page']['description'] = 'View and manage the available FBL accounts.';

$lang['add_new']['form']['heading']                              = 'Feedback Loop Details';
$lang['add_new']['form']['email']                                = 'FBL Email';
$lang['add_new']['form']['email_help']                           = 'The email address of the FBL mailbox';
$lang['add_new']['form']['host']                                 = 'Server Host';
$lang['add_new']['form']['host_help']                            = 'The Hostname of the server where the FBL mailbox is hosted';
$lang['add_new']['form']['port']                                 = 'Port';
$lang['add_new']['form']['port_help']                            = 'Port number of the mailbox server';
$lang['add_new']['form']['username']                             = 'Mailbox Username';
$lang['add_new']['form']['username_help']                        = 'Username of the FBL mailbox';
$lang['add_new']['form']['password']                             = 'Mailbox Password';
$lang['add_new']['form']['password_help']                        = 'The password of the FBL mailbox';
$lang['add_new']['form']['folder']                               = 'Folder';
$lang['add_new']['form']['folder_help']                          = 'The folder where incoming complaints land. Default: Inbox';
$lang['add_new']['form']['validate_certificate']                 = 'Validate Certificate';
$lang['add_new']['form']['validate_certificate_help']            = 'Select Yes if the server requires validation of the SSL certificate';
$lang['add_new']['form']['encryption_help']                      = 'Select the right option if the connection to remote server needs encryption';
$lang['add_new']['form']['delete_emails']                        = 'Delete Emails after Processing';
$lang['add_new']['form']['delete_emails_help']                   = 'Delete the complaint messages (emails) once they are processed';
$lang['add_new']['form']['connection_method']                    = 'Connection Method';
$lang['add_new']['form']['connection_method_help']               = 'Choose the connection method. i.e. POP or IMAP';

/************* ** General ** *************/
$lang['activity_title'] = 'Feedback Loop';
$lang['validate_connection'] = 'Validate Connection';

$lang['fbl_controller']['error_msg_text'] = 'Error MSG:';
$lang['create_blade']['activity_title'] = 'Status';
$lang['activity_titleabc']['actsivity_title'] = ' MSG:';
return $lang;