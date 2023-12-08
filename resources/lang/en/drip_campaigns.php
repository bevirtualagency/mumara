<?php
include("variables.php");
/**
 * Created by Mumara Team
 * Date: 06/24/2020
 */
/*-------------- 1. Campaigns -> Drip Campaigns ----------------*/

$lang['page']['title']       = 'Drip Campaigns';
$lang['page']['description'] = ''.$siteTitle.' Campaigns help you retain the leads by keeping an auto follow-up mechanism in place. Automate the customer journey from the very first interaction with your recipient to the time your lead converts into a sale. The dripping of your campaign was never that easy to configure as '.$siteTitle.' Campaigns have made it by refining the tedious part of automation.';

$lang['page']['button']['drip_groups']       = 'Drip Groups';
$lang['page']['button']['add_new_drip']      = 'Add a Drip';

/************* ** Drip Campaigns Datatable ** *************/
$lang['table_headings']['name']              = 'Name';
$lang['table_headings']['delay']             = 'Delay';
$lang['table_headings']['status'] 	         = 'Status';
$lang['table_headings']['added_on']          = $created_on;
$lang['table_headings']['actions']           = 'Actions';

/*^^^^^^^^^^^^^ End of Campaigns -> Drip Campaigns ^^^^^^^^^^^^^*/

/*-------------- 1.1 Campaigns -> Drip Campaigns -> Add New ----------------*/
$lang['add_new']['page']['title']            = 'Add a Drip';
$lang['edit']['page']['title']               = 'Edit Drip of';
$lang['add_new']['page']['description']      = 'Drip are automated emails sent to improve contact experience. Like setting up an email campaign, the process of creating the drip campaign consists of more than one step.';
// Setup Tab
$lang['add_new']['tab1']['heading']               		= 'Setup';
$lang['add_new']['tab1']['desc']                  		= 'Create Drip';
$lang['add_new']['tab1']['followup_name']         		= 'Drip Name';
$lang['add_new']['tab1']['followup_name_help']    		= 'Give it a friendly name for identification';
$lang['add_new']['tab1']['group_help']            		= 'Select the drip group to be added in';
$lang['add_new']['tab1']['status_help']           		= 'Set this drip as active or inactive. Inactive drips will not be processed';
$lang['add_new']['tab1']['send_to_existing']      		= 'Send to Existing';
$lang['add_new']['tab1']['send_to_existing_help']       = 'Send this drip to the pre-qualified contacts in the next trigger execution';

// Interval Tab
$lang['add_new']['tab2']['heading']          = 'Interval';
$lang['add_new']['tab2']['desc']             = 'Time To Send';
$lang['add_new']['tab2']['enter_account_details'] = 'When to execute this drip';
$lang['add_new']['tab2']['when_to_send'] = 'When to Send';
$lang['add_new']['tab2']['when_to_send_help'] = '<ul>
<li><strong>Upon Triggering:</strong>&nbsp;The&nbsp;drip will be queued for execution right after the trigger happens</li>
<li><strong>After Triggering:</strong>&nbsp;The&nbsp;drip will&nbsp;execute&nbsp;when the time difference matches the internal you set</li>
</ul>';
$lang['add_new']['tab2']['upon_triggering'] = 'Upon Triggering';
$lang['add_new']['tab2']['after_triggering'] = 'After Triggering';
// Message Body Tab
$lang['add_new']['tab3']['heading']           = 'Message Body';
$lang['add_new']['tab3']['desc']              = 'Create your drip message';
$lang['add_new']['tab3']['enter_account_details'] = 'Create your drip message';
$lang['add_new']['tab3']['email_subject']     = 'Email Subject';
$lang['add_new']['tab3']['email_subject_help']     = 'Subject line of the drip email that your recipients will receive';
$lang['add_new']['tab3']['html_body'] = 'HTML Body';
$lang['add_new']['tab3']['html_body_help'] = 'HTML version of the email body';
$lang['add_new']['tab3']['text_body'] = 'Text Body';
$lang['add_new']['tab3']['text_body_help'] = 'Text version of the email body';
$lang['add_new']['tab3']['smtp_to_use_for_preview'] = 'Preview Sending Node';
$lang['add_new']['tab3']['smtp_to_use_for_preview_help'] = 'Select a sending to send a preview of this drip';
$lang['add_new']['tab3']['domain_to_use_for_preview'] = 'Select a Sending Domain';
$lang['add_new']['tab3']['domain_to_use_for_preview_help'] = 'This sending domain will appear in the email headers as the originator of the email.';
$lang['add_new']['tab3']['send_preview_to_email']   = 'Preview Email';
$lang['add_new']['tab3']['send_preview_to_email_help']   = 'Write the email address where you want to receive the preview of the drip';
$lang['add_new']['tab3']['test_email'] = 'Test Email';
$lang['add_new']['tab3']['show_logs'] = 'Show Logs';
$lang['add_new']['tab3']['system_variable'] = 'Sending a preview will not convert the system variables e.g. web_version, unsubscribe link, etc';

/*^^^^^^^^^^^^^ End of Campaigns -> Drip Campaigns -> Add New ^^^^^^^^^^^^^*/

/*-------------- 2. Campaigns -> Drip Campaigns -> Drip Groups ----------------*/

$lang['groups']['page']['title']        = 'View Drip Groups';
$lang['groups']['page']['description']  = 'List of currently available Drip Group across the application/ user account to view and manage.';
$lang['groups']['page']['add_group']    = 'Add Drip Group';
$lang['groups']['page']['add_new_drip'] = 'Add a Drip';

/************* ** Drip Groups Datatable ** *************/
$lang['groups']['table_headings']['name']        = 'Group Name';
$lang['groups']['table_headings']['drip_count']  = 'Drip Count';
$lang['groups']['table_headings']['created_date']= 'Created Date';
$lang['groups']['table_headings']['actions']     = 'Actions';
/*^^^^^^^^^^^^^ End of Campaigns -> Drip Campaigns -> Drip Groups ^^^^^^^^^^^^^*/

/*-------------- 2. Campaigns -> Drip Campaigns -> Drip Groups -> Add Drip Group ----------------*/
$lang['groups']['add_new']['page']['title']        = 'Add Drip Group';
$lang['groups']['edit']['page']['title']           = 'Edit Drip Group of';
$lang['groups']['add_new']['page']['description']  = 'Add Drip Group.';
$lang['groups']['add_new']['activity_title'] = 'Follow-up Group';

$lang['groups']['add_new']['form']['heading']  = 'Drip Group Details';
$lang['groups']['add_new']['form']['smtp_list']  = 'Sending Nodes';
$lang['groups']['add_new']['form']['smtp_list_help']  = 'Select the sending nodes that will be responsible to relay the drips. Multiple selections will put the selected sending nodes to perform in rotation';
$lang['groups']['add_new']['form']['track_opens_help']  = 'Whether you want to track opening of drips inside';
$lang['groups']['add_new']['form']['track_clicks_help']  = 'Whether you want to track link clicking of drips inside';
$lang['groups']['add_new']['form']['unsubscribe_link_help']  = 'Allow '.$siteTitle.' to automatically insert an unsubscribe link inside every drip email body';
$lang['groups']['add_new']['form']['sender_info']  = 'Sender Information';
$lang['groups']['add_new']['form']['sender_info_help']  = '<p>Sender-info of the drip email i.e sender name, sender email, reply-to email, return-path. You have multiple options here, whether to fetch the sender info automatically or insert custom info
<ul>
<li><strong>From Sending Node:</strong> Fetch sender-info from Sending Node details</li>
<li><strong>Custom:</strong> Use/select custom sender-info for this drip group</li>
</ul>
</p>';
$lang['groups']['add_new']['form']['choose_from_name_as_listed_in_list'] = 'Choose From Name as listed in List';
$lang['groups']['add_new']['form']['choose_from_name_as_listed_in_smtp'] = 'Choose From Name as listed in SMTP';
$lang['groups']['add_new']['form']['domain'] = 'Domain';

/************* ** Messages ** *************/
$lang['message']['alert_copy'] = 'Are you sure to copy the Follow-up?';
$lang['message']['no_smtp_is_selected'] = 'No SMTP is selected.';
$lang['message']['preview_email']['success'] = 'Preview email successfully sent!';
$lang['message']['preview_email']['failure'] = 'Preview email not sent due to SMTP issue!';
$lang['message']['unsubscribed'] = 'You have been unsubscribed successfully.';
$lang['message']['drip_copied'] = 'Drip Campaign Successfully Copied';
$lang['message']['updated'] = 'Successfully Updated';



/************* ** General ** *************/
$lang['email_preview'] = 'Email Preview';
$lang['view'] = 'View Drips';
$lang['dynamic_fields'] = 'Dynamic Fields';
$lang['insert_dynamic_fields'] = 'Insert Dynamic Fields';
$lang['activity_title'] = 'Auto Follow-up';
$lang['email_campaigns'] = 'Email Campaigns';
$lang['global'] = 'Global All Campaigns';
$lang['opened'] = 'Opened Email Campaigns';
$lang['link_clicked'] = 'Link Clicked';
$lang['copied'] = 'Drip has been successfully copied.';

$lang['controller']['copy_txt_action'] = 'Copy';
$lang['controller']['send_date_time_triggering'] = 'Upon Triggering';
$lang['grouping_blade']['Drip_name_th'] = 'Drip Name';
$lang['grouping_blade']['group_name_th'] = 'Group Name';
$lang['grouping_blade']['delay_txt_th'] = 'Delay';
$lang['grouping_blade']['status_txt_th'] = 'Status';
$lang['grouping_blade']['added_on_txt_th'] = 'Added on';
$lang['grouping_blade']['actions_txt_th'] = 'Actions';
$lang['grouping_blade']['local_leads_td'] = 'Local Leads (Follow up # 3)';
$lang['grouping_blade']['social_leads_td'] = 'Social Leads (Manual)';
$lang['grouping_blade']['days_txt_td'] = 'days';
$lang['grouping_blade']['local_leads_three_td'] = 'Local Leads (Follow up # 2)';
$lang['grouping_blade']['local_leads_one_td'] = 'Local Leads (Follow up # 1)';
$lang['grouping_blade']['instant_txt_td'] = 'Instant';
$lang['grouping_blade']['test_follow_up_td'] = 'Test Follow up - 8 minutes';
$lang['grouping_blade']['wasif_test_td'] = 'Wasif Test';
$lang['grouping_blade']['minutes_txt_td'] = 'minutes';
$lang['grouping_blade']['after_send_existing_td'] = 'After 6 minutes - Send to existing';
$lang['grouping_blade']['after_twentyfive_send_existing_td'] = 'After 25 Minutes - Send to Existing';
$lang['grouping_blade']['after_ten_send_existing_td'] = 'After 10 Minutes (send to existing)';
$lang['grouping_blade']['thankyou_subscription_td'] = '1- Thank You (Subscription Confirmation)';
$lang['grouping_blade']['lp_leads_td'] = 'LP Leads';
$lang['grouping_blade']['intro_mumara_campaigns_td'] = '2- Introduction to Mumara Campaigns+';
$lang['grouping_blade']['your_inquiry_campaigns_td'] = '3- Fwd: Your Inquiry about Mumara Campaigns+';
$lang['grouping_blade']['after_one_month_td'] = '4- After 1 Month';
$lang['grouping_blade']['months_txt_td'] = 'months';
$lang['grouping_blade']['after_two_month_td'] = '5- After 2 Months';
$lang['grouping_blade'][''] = '';
$lang['grouping_blade'][''] = '';

return $lang;
