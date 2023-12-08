<?php
include("variables.php");
/**
 * Created by Mumara Team
 * Date: 06/30/2020
 */
/*-------------- 1. Setup -> Bounce Addresses ----------------*/

$lang['page']['title']       							= 'Bounce Addresses';
$lang['page']['description'] 							= "A bounce address is the return-path address in your email header that is responsible to receive delivery reports of the failed messages. Without a bounce address, your email isn't fully qualified and technically it's the main sender of the email that authenticates SPF (Sender Policy Framework).";

/************* ** Bounce Addresses Datatable ** *************/
$lang['table_headings']['bounce_address']         	    = 'Bounce Address';
$lang['table_headings']['host']    					    = 'Host';
$lang['table_headings']['username']     				= 'Username';
$lang['table_headings']['method']     					= 'Method';
$lang['table_headings']['port']     					= 'Port';
$lang['table_headings']['verify_status']                = 'Verify Status';
$lang['table_headings']['error']     					= 'Error';
$lang['table_headings']['actions']     					= 'Actions';

/************* ** Actions ** *************/
$lang['action']['test_connect']  						= 'Test Connection';
$lang['action']['set_active']    						= 'Set as active';
$lang['action']['set_inactive']  						= 'Set as inactive';
$lang['action']['export_to_csv'] 						= 'Export to CSV';

/*-------------- 1.1 Setup -> Bounce Addresses -> add new ----------------*/
$lang['add_new']['page']['title']                       = 'Add a Bounce Address';
$lang['edit']['page']['title']                          = 'Edit Bounce Addresses of';
$lang['add_new']['page']['description']                 = 'Use the following fields to create new account for the processing of the bounced emails. Processing the bounced emails will keep your list clean free from bad and invalid email addresses, it also trims down the possibility of getting blacklisted or suspended.';

$lang['add_new']['form']['heading'] = 'Bounce Address Detail';
$lang['add_new']['form']['common_port_143'] = 'Common Port: 143';
$lang['add_new']['form']['common_port_110'] = 'Common Port: 110';

$lang['add_new']['form']['bounce_email']    = 'Bounce Email Address';
$lang['add_new']['form']['bounce_email_help']    = "Email address where you'll receive bounces";

$lang['add_new']['form']['process_bounce']    = 'Process Bounces';
$lang['add_new']['form']['process_bounce_help']    = 'Let '.$siteTitle.' login to your bounce mailbox, read delivery reports and process them accordingly';

$lang['add_new']['form']['active_help']    = 'Enable processing of bounced emails';

$lang['add_new']['form']['method']    = 'Method';
$lang['add_new']['form']['method_help']    = '<b>POP</b>: POP method downloads the emails from Inbox <br>
<b>IMAP</b>: IMAP synchronizes the mailbox and folders';

$lang['add_new']['form']['host']    = 'Host';
$lang['add_new']['form']['host_help']    = 'The hostname of the server where bounce email is hosted';

$lang['add_new']['form']['username']    = 'Username';
$lang['add_new']['form']['username_help']    = '	Username to log in to bounce mailbox';

$lang['add_new']['form']['password']    = 'Password';
$lang['add_new']['form']['password_help']    = 'The password to login to bounce mailbox';

$lang['add_new']['form']['port']         = 'Port';
$lang['add_new']['form']['port_help']    = 'Port number of the bounce mailbox server';

$lang['add_new']['form']['folder']         = 'Folder';
$lang['add_new']['form']['folder_help']    = 'Folder name to process bounces from. Default: INBOX';

$lang['add_new']['form']['validate_certificate']         = 'Validate Certificate';
$lang['add_new']['form']['validate_certificate_help']    = 'Validate SSL certificate of the bounce mail server';

$lang['add_new']['form']['mail_encryption']         = 'Mail Encryption';
$lang['add_new']['form']['mail_encryption_help']    = 'Encryption of the incoming bounced emails i.e SSL or TLS';

$lang['add_new']['form']['delete_emails_after_bounce_processing']         = 'Delete Emails after Processing';
$lang['add_new']['form']['delete_emails_after_bounce_processing_help']    = 'Delete emails from bounce mailbox once they are processed by '.$siteTitle;
$lang['add_new']['form']['delete_only_processed']    = 'Delete only processed emails';
$lang['add_new']['form']['delete_all_emails']    = 'Delete all emails inside the mailbox';

$lang['add_new']['form']['verify_connection']    = 'Verify Connection';
$lang['add_new']['form']['verify_connection_help']    = "It's a button to validate bounce authentication if ".$siteTitle." is able to login to your bounce mailbox";

/************* ** Messages ** *************/
$lang['message']['verify_connection_error']   = 'Connection Error:';
$lang['message']['verify_connection_success'] = 'Successfully Connected:';
$lang['message']['note']                      = 'Bounce address is the mailbox where '.$siteTitle.' sends delivery reports of the failed attempts.';
/************* ** General ** *************/
$lang['activity_title']     				  = 'Bounce Handling';
$lang['pmta_control']       				  = 'This setting is being controlled by PowerMTA';
$lang['encryption']['none'] 				  = 'None';
$lang['encryption']['tls']  				  = 'TLS';
$lang['encryption']['ssl']  				  = 'SSL';
$lang['test_connection']['title']             = 'Test Connection';
$lang['test_connection']['bounce_name']       = 'Bounce Name';
$lang['test_connection']['test_status']       = 'Test Status';
$lang['test_connection']['status']            = 'Status';
$lang['attach']['to_list']            = 'Bounce address is attached to the assets';
$lang['attach']['assets']['desc_1']           = 'The bounce address you are trying to delete is currently attached to the following assets.';
$lang['attach']['assets']['desc_2']           = 'Before you can delete this bounce address, you`ll need to un-assign it from the connected assets. Or you can use the below option to replace the bounce address for the connected assets to the selected bounce address.';
$lang['deleted']           = 'Bounce Account has been successfully deleted';
$lang['opps']           = 'Opps Something went wrong';
$lang['attach_and_delete']           = 'Transfer & Delete';
$lang['select']           = 'Select a Bounce Address';


$lang['controller']['smpts_li']           = 'SMTPs';
$lang['controller']['contact_list_li']           = 'Contact List';
$lang['controller']['bounce_address_error']           = 'Bounce Address Delete ';
$lang['controller']['bounce_delete_error']           = 'Bounce Delete';
$lang['controller']['bounce_add_error']           = 'Bounce Add';
$lang['controller']['bounce_edit_error']           = 'Bounce Edit';
$lang['index_blade']['sending_node_ul']           = 'Sending Node 1, Sending Node 2, Sending Node 3';
$lang['index_blade']['contact_list_ul']           = 'Contact List 1, Contact List 2, Contact List 3';
$lang['index_blade']['filed_required_div']           = 'This field is required.';



return $lang;