<?php
include("variables.php");
/**
 * Created by Mumara Team
 * Date: 06/18/2020
 */

/*------------- 1. Lists - Suppression- Email Suppression -----------*/

$lang['email']['page']['title']       = 'Email Suppression';
$lang['email']['page']['description'] = 'Email suppression is where you can add/import the email addresses to suppress them directly from receiving any further email.';
$lang['email']['sup_email_inside'] = 'Suppressed Emails Inside ';

/************* ** Import Modal ** *************/
$lang['email']['modal']['title'] ='Email Suppression';
$lang['email']['modal']['description'] ='Importing email addresses to the suppression will stop '.$siteTitle.' from sending any further emails to these addresses. You can add email addresses to global suppression or associate them to a contact list.';

/************* ** Datatable ** *************/
$lang['email']['table_headings']['id'] = 'ID';
$lang['email']['table_headings']['sr'] = 'Sr.';
$lang['email']['table_headings']['email'] = 'Email';
$lang['email']['table_headings']['md5'] = 'MD5';
$lang['email']['table_headings']['no_encryption'] = 'No Encryption';
$lang['email']['table_headings']['reference'] = 'Reference';
$lang['email']['table_headings']['contacts'] = 'Contact List';
$lang['email']['table_headings']['users'] = 'User';
$lang['email']['table_headings']['added_on'] = $created_on;
$lang['email']['table_headings']['actions'] = 'Actions';
$lang['email']['table_headings']['email_encryption']='Email Encryption';
$lang['email']['table_headings']['email_encryption_desc']='Encryption of the emails you are suppressing. If your emails are not encrypted, select "None".';


/************* ** Messages ** *************/
$lang['email']['message']['delete_with_reference'] = 'Are you sure you want remove all the emails with this reference?';
$lang['email']['message']['delete_reference_and_email'] = 'Delete Refrence and Emails';
$lang['email']['message']['no_cleint_select_id'] = 'No user selected';

/*============== End of  Email Suppression =========*/

/*------------- 2. Lists - Suppression- Domain Suppression -----------*/

$lang['domain']['page']['title']       = 'Domain Suppression';
$lang['domain']['page']['heading']     = 'Suppressed Domains';
$lang['domain']['page']['description'] = 'Block/Suppress all those domains that you don\'t want to send emails. In most cases, people need to suppress all those domains that are generating a high number of complaints or the domains that are not performing good ROI for you.';
$lang['domain']['update_domain'] = 'Update Domain';
$lang['domain']['contact_list'] = 'Contact List';
$lang['domain']['delete_reference'] = 'Flush Reference';

/************* ** Import Modal ** *************/
$lang['domain']['modal']['title'] ='Suppress Domains';
$lang['domain']['modal']['description'] ='Importing domains to the suppression will stop '.$siteTitle.' from sending any further emails to all such email addresses that belongs to these domains. You can add domains to global suppression or associate them to a contact list.';

/************* ** Datatable ** *************/
$lang['domain']['table_headings']['sr'] = 'Sr.';
$lang['domain']['table_headings']['domain'] = 'Domain Name';
$lang['domain']['table_headings']['reference'] = 'Reference';
$lang['domain']['table_headings']['list'] = 'Associated List';
$lang['domain']['table_headings']['added_on'] =  $created_on;
$lang['domain']['table_headings']['actions'] = 'Actions';


/************* ** Messages ** *************/
$lang['domain']['message']['delete_with_reference'] = 'Are you sure you want to delete all domains within reference?';
$lang['domain']['message']['domain_update_success'] = 'Domain Updated Successfully';
$lang['domain']['message']['invalid'] = 'Invalid Domain Name';
$lang['domain']['message']['already_exists'] = 'Domain Already Exists';

/*============== End of  Domain Suppression =========*/

/*------------- 3. Lists - Suppression- IP Suppression -----------*/

$lang['ip']['page']['title']       = 'IP Suppression';
$lang['ip']['page']['description'] = 'Suppress email addresses by adding their engaged IP addresses to the suppression. If you add an IP address to the suppression, '.$siteTitle.' will look into geo-tracking details of the contacts before starting a broadcast and will skip those contact that has a previous activity with that IP address. For example, if a person has clicked on a link or has opened an email sent by you from an IP address that was added to the suppression list, this contact will not receive any further email from your side.';

/************* ** IP Suppression Datatable ** *************/
$lang['ip']['table_headings']['ip_address'] = 'IP Address';
$lang['ip']['table_headings']['contact_list'] = 'Contact List';
$lang['ip']['table_headings']['reference'] = 'Reference';
$lang['ip']['table_headings']['added_on'] = $created_on;
$lang['ip']['table_headings']['actions'] = 'Actions';
/************* ** IP Suppression Modal ** *************/
$lang['ip']['modal']['field']['ip_address'] = 'IP Address';
$lang['ip']['modal']['field']['ip_address_help'] = 'Add a range of IP addresses and subnets in the following format <br>
<b>Range</b>: 192.168.0.0-255<br>
<b>Subnet</b>: 192.168.0.0/24';
$lang['ip']['modal']['field']['contact_list'] = 'Contact List';
$lang['ip']['modal']['field']['reference'] = 'Reference';

/************* ** Messages ** *************/
$lang['ip']['message']['delete_ip_with_reference'] =  'Are You Sure to Delete Reference and its IPs';
$lang['ip']['message']['already_exist'] = 'Ip already exist in selected list';
$lang['ip']['message']['invalid_ips'] = 'These are invlid IPs';
/*============== End of IP Suppression =========*/

/************* ** General ** *************/
$lang['title'] = 'Suppression';
$lang['download_link'] = 'Click here to download';
$lang['cancel_import'] = 'Cancel import';
$lang['global'] = 'Global';
$lang['upload_dir'] = 'Upload your file to :path to be imported';
$lang['delete_with_reference'] = 'Delete With Reference';

/************* ** Import Modal ** *************/
$lang['modal']['form']['select_list']='Select List';
$lang['modal']['form']['select_list_help']='Here you can decide whether to add/import the :type to suppression globally to select a contact list to associate with.';
$lang['modal']['form']['method']='Method';
$lang['modal']['form']['method_help']='<b>Upload a CSV file</b>: This option lets you import your CSV file containing the list of :type <br>
<b>Select a file from server</b>: You can upload the CSV file to :path folder and then select it here. This option is feasible to import larger files<br>
<b>Write/paste :type</b>: Alternatively, you can paste the :type separate by new line';
$lang['modal']['form']['select_file']='Select File';
$lang['modal']['form']['upload_csv_file'] =$csv_upload;
$lang['modal']['form']['select_file_from_server'] = $csv_select;
$lang['modal']['form']['email_input'] = 'Write/paste email addresses';
$lang['modal']['form']['domain_input'] = 'Write/paste domain names';
$lang['modal']['form']['email_address'] = 'Email Address';
$lang['modal']['form']['choose_file']='Choose file';
$lang['modal']['form']['browse']='Browse';
$lang['modal']['form']['max_file_size']='Max File Size';
$lang['modal']['form']['uploading_file']='Uploading File';
$lang['modal']['form']['email']='Email';
$lang['modal']['form']['domain']='Domain';
$lang['modal']['form']['reference']='Reference';
$lang['modal']['form']['reference_help']='Put any reference name here so you remember why exactly you\'ve suppressed these emails';
$lang['modal']['form']['line_contains_headers']='Header Included?';
$lang['modal']['form']['line_contains_headers_help']='Keep it to `Yes` if the first row of your file contains headers and it needs to be skipped during import';
$lang['modal']['form']['rocket_speed']='Rocket Import';
$lang['modal']['form']['button']['import']='Import';



/************* ** Common Messages ** *************/
$lang['message']['delete_all_files'] = 'Are you sure want to delete all uploaded files?';
$lang['message']['import_operation_success'] = "<div class='alert alert-success alert-light alert-bold' role='alert' id='resultbar'><b> <div id='imported'>0</div> </b>&nbsp;contacts were imported out of &nbsp; <b> <div id='total_alert'>0</div> </b>&nbsp;contacts based on your import rules.</div>";
$lang['message']['delete_with_empty_reference'] = 'Cannot Delete with empty Reference';
$lang['message']['sync_suppression_message'] = 'If you delete from the global suppression list, make sure you press the Sync Suppression button.';
$lang['message']['command_running_background'] = 'The export process has been started in background, you`ll be to download it once ready.';
$lang['message']['file_not_exist'] = 'File not found';
$lang['message']['unautherize_url'] = 'You are not autherized to download this file';

/************* **Supression ** *************/
$lang['domain']['table_headings']['activity'] = 'Suppression Domain List';
$lang['email']['table_headings']['activity'] = 'Suppression Email List';

$lang['domain_suppression_limit'] = 'You can add up to :limit domain(s) in suppression. The limit left is :left.';

$lang['suppress_user_limit_title'] = 'Inherit suppressed domains limit from the package';
$lang['suppress_package_limit_title'] = 'Suppressed Domains limit';
$lang['suppress_system_limit_title'] = 'Suppressed Domains Limit';
$lang['resync_erro_message'] = 'Resync cannot be start because Suppression is already in running state';
$lang['suppression_running_time'] = '<b>Note: </b>&nbsp; The suppression list is synchronized with subscribers every <code>:minutes</code> minutes.';
$lang['suppression_running_disable'] = '<b>Note: </b>&nbsp; The suppression processing cron is disabled. Manage the  <a href="/settings/cron"> &nbsp;crons here</a>.';
$lang['suppression_running_disable_user'] = '<b>Note: </b>&nbsp; The suppression processing has been disabled by the admin. Contact the administrator for further details.';

$lang['controller']['supressed_list_error'] = 'Export Supressed list not saved';
$lang['index_blade']['importing_txt_div'] = 'Importing';
$lang['index_blade']['into_txt_div'] = 'into';

$lang['index_blade_email_suppression']['resync_suppression_button'] = 'Resync Suppression';
$lang['index_blade_email_suppression']['save_txt_button'] = 'Save';

$lang['suppression_controller']['operation_successful_msg'] = 'Operation is successful';

$lang[''][''][''] = '';
return $lang;