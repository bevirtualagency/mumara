<?php
/**
 * Created by Mumara Team
 * Date: 06/01/2020
 */
include("variables.php");
$lang= [];

// Alerts
$lang['warning']['title']          = 'Warning!';


// Search
$lang['search']['title']           = 'Search';
$lang['search']['all']           = 'Search...';
$lang['search']['search_error']    = 'Please fill in the search fields';
$lang['delete_all_uploaded_files'] = 'Delete all uploaded files';

// Date and Time
$lang['day_of_month']     = 'Date of Month';
$lang['day_of_week']      = 'Day of Week';
$lang['monday']           = 'Monday';
$lang['tuesday']          = 'Tuesday';
$lang['wednesday']        = 'Wednesday';
$lang['thursday']         = 'Thursday';
$lang['friday']           = 'Friday';
$lang['saturday']         = 'Saturday';
$lang['sunday']           = 'Sunday';
$lang['sunday']           = 'Sunday';

$lang['after_every']      = 'Minute of the hour';
$lang['today']            = 'Today';
$lang['yesterday']        = 'Yesterday';
$lang['last7days']        = 'Last 7 Days';
$lang['last30days']       = 'Last 30 Days';
$lang['this_week']        = 'This week';
$lang['last_week']        = 'Last week';
$lang['this_month']       = 'This month';
$lang['last_month']       = 'Last month';
$lang['this_year']        = 'This year';
$lang['last_year']        = 'Last year';
$lang['custom']           = 'Custom';
$lang['time']             = 'Time';
$lang['seconds']          = 'Seconds';
$lang['miliseconds']          = 'Milliseconds';
$lang['minutes']          = 'Minutes';
$lang['hours']            = 'Hours';
$lang['days']             = 'Days';
$lang['weeks']            = 'Weeks';
$lang['months']           = 'Months';
$lang['years']            = 'Years';
$lang['any']              = 'Any';
$lang['monthly']          = 'Monthly';
$lang['weekly']           = 'Weekly';
$lang['daily']            = 'Daily';
$lang['hourly']           = 'Hourly';
$lang['month']           = 'Month';
// Triggers related\

$lang['include']          = 'Include';
$lang['exclude']          = 'Exclude';
$lang['on']               = 'On';
$lang['not_on']           = 'Not On';
$lang['within']           = 'Within';
$lang['not_within']       = 'Not Within';
$lang['equals']           = 'Equals';
$lang['does_not_equals']  = 'Doesn\'t Equals';
$lang['spam']             = 'Spam';
$lang['confirmed']        = 'Confirmed';
$lang['unconfirmed']      = 'Unconfirmed';
$lang['not_confirmed']    = 'Not confirmed';
$lang['yes']    = 'Yes';
$lang['no']    = 'No';
$lang['view_thumbnail']    = 'View thumbnail';
$lang['yes']              = 'Yes';
$lang['no']               = 'No';
$lang['soft']             = 'Soft';
$lang['hard']             = 'Hard';
$lang['copy_post_url']             = 'Copy Post URL';

// Statistics related

$lang['stats']['sent']          = 'Sent'; //dashboard.sending_statistics.sent
$lang['stats']['opened']        = 'Opened';
$lang['stats']['clicked']       = 'Clicked';
$lang['stats']['unsubscribed']  = 'Unsubscribed';
$lang['stats']['bounced']       = 'Bounced';
$lang['stats']['complaints']    = 'Complaints';
$lang['stats']['logs']          = 'Logs';
$lang['stats']['ab']            = 'A/B';
$lang['stats']['delivered']     = 'Delivered';
$lang['stats']['skipped']       = 'Skipped';
$lang['stats']['ctr']           = 'CTR';
$lang['stats']['abuse']         = 'Abuse';
$lang['stats']['injected']      = 'Injected';
$lang['stats']['delayed']       = 'Delayed';
$lang['stats']['spammed']       = 'Spammed';
$lang['stats']['deleted_subscribers']       = 'Deleted Subscribers';
$lang['stats']['failed']        = 'Failed';
$lang['stats']['chart_opened']        = 'Opened vs Unopened';
$lang['stats']['country_clicked']        = 'Countries by Email Opened';
$lang['stats']['click_link_chart']        = 'Clicks Chart';
$lang['stats']['links']        = 'Links'; // added by azeem for a/b testing t calculate top ten clicks
$lang['stats']['percentage']        = 'Percentage';// added by azeem for a/b testing t calculate top ten clicks


$lang['status']['span_opened_total']       = 'Opened';
$lang['status']['span_unopen_total']       = 'Unopened';
$lang['status']['label_exclusive_bots']       = 'Exclude bots';
$lang['status']['show_label_display_email']       = 'Display Emails';


/************* ** Apps ** *************/
$lang['apps']['smtp']            = 'SMTP';
$lang['apps']['mailgun']         = 'Mailgun';
$lang['apps']['sendgrid']        = 'Sendgrid';
$lang['apps']['amazon_ses']      = 'Amazon SES';
$lang['apps']['powerMTA']        = 'PowerMTA';
$lang['apps']['buy_addon']       = 'Buy Addon';
$lang['apps']['gmail']           = 'Gmail';
$lang['apps']['outlook']         = 'Outlook';
$lang['apps']['yahoo']           = 'Yahoo';
$lang['apps']['aol']             = 'AOL';
$lang['apps']['sparkpost']       = 'Sparkpost';
$lang['apps']['elastic_email']   = 'Elastic Email';
$lang['apps']['mailjet']         = 'Mailjet';
$lang['apps']['smtp2go']         = 'Smtp2Go';
$lang['apps']['postmark']        = 'Postmark';
$lang['apps']['top_ten_clicks']        = 'Top clicks';
$lang['apps']['clicks_by_browser']        = 'Clicks by browser'; 
/************* ** General ** *************/
$lang['verify_connection']['error'] = 'Connection Error:';
$lang['verify_connection']['success'] = 'Successfully Connected:';
$lang['header']['report_a_bug']                = 'Report a Bug';
$lang['header']['version']                     = 'Version';
$lang['header']['update_now']                  = 'Update Now';
$lang['import']['import_allowed_file_formats'] = 'Supported formats: csv, txt';
$lang['label']['change']                       = 'Change';
$lang['label']['success']                       = 'Success';
$lang['label']['buy_now'] 					   = 'Buy Now';
$lang['label']['demo_version'] 				   = 'This is a demo version';
$lang['label']['demo_service_not_available']   = 'This service is not available in demo version';
$lang['label']['geoip_dependencies']           = 'Geoip Dependencies';
$lang['label']['download_geoip_dependencies']  = 'Download Geoip Dependencies';
$lang['label']['download_geoip']  			   = 'Download the script for geo data in the stats';
$lang['label']['remove']                       = 'Remove';
$lang['label']['location']                       = 'Location';
$lang['label']['duplicates']                   = 'Duplicates';
$lang['label']['csv']                          = 'CSV';
$lang['label']['skip']                         = 'Skip';
$lang['label']['overwrite']                    = 'Overwrite';
$lang['label']['update']                       = 'Update';
$lang['label']['initial_setup']                = 'Initial Setup';
$lang['label']['notifications']                = 'Notifications';
$lang['label']['issues']                       = 'Issues';
$lang['label']['installed_version']            = 'Installed Version';
$lang['label']['last_updated']                 = 'Last Updated';
$lang['label']['latest_version']               = 'Latest version';
$lang['label']['release_date']                 = 'Release Date';
$lang['label']['view_complete_changelog']      = 'View complete changelog';
$lang['label']['update_under_progress']        = 'Update under progress';
$lang['label']['Setup_Guide']                  = 'Initial Setup Guide';
$lang['label']['view_contacts'] 			   = 'View Contacts';
$lang['label']['importing']     			   = 'Importing';
$lang['label']['to']            			   = 'To';
$lang['label']['waiting']       			   = 'Waiting';
$lang['label']['group']         			   = 'Group';
$lang['label']['group_name']    			   = 'Group Name';
$lang['label']['add_new_group'] 			   = 'Add New Group';
$lang['label']['group_help']    			   = 'Select the group or create one by clicking the [+] sign';
$lang['label']['select_group']  			   = 'Choose Group';
$lang['label']['select_option'] 			   = 'Select Option';
$lang['label']['email_address'] 			   = 'Email Address';
$lang['label']['run_now'] 					   = 'Run Now';
$lang['label']['pop']      					   = 'POP';
$lang['label']['imap']     					   = 'IMAP';
$lang['label']['host']     					   = 'Host';
$lang['label']['port']     					   = 'Port';
$lang['label']['username'] 					   = 'Username';
$lang['label']['password'] 					   = 'Password';
$lang['label']['current_password'] 			   = 'Current Password';
$lang['label']['new_password'] 			       = 'New Password';
$lang['label']['confirm_password'] 			   = 'Confirm Password ';
$lang['label']['Operating_System'] 			   = 'Operating System';
$lang['label']['Browser'] 			           = 'Browser';
$lang['label']['login']      				   = 'Login';
$lang['label']['finish']     				   = 'Finish';
$lang['label']['previous']   				   = 'Previous';
$lang['label']['next_step']  				   = 'Next Step';
$lang['label']['need_help']  				   = 'Need Help?';
$lang['label']['click_copy'] 				   = 'Click here to Copy URL';
$lang['label']['mail_encoding'] 			   = 'Mail Encoding';
$lang['label']['8bit'] 				           = '8 Bit';
$lang['label']['7bit'] 				           = '7 Bit';
$lang['label']['binary'] 				       = 'Binary';
$lang['label']['base64'] 				       = 'Base64';
$lang['label']['quoted_printable'] 			   = 'Quoted Printable';

$lang['label']['format'] 					   = 'Format';
$lang['label']['time_format'] 				   = 'Date/Time Format';
$lang['label']['html']   					   = 'HTML';
$lang['label']['text']   					   = 'Text';

$lang['label']['encryption'] 				   = 'Encryption';
$lang['label']['none']       				   = 'None';
$lang['label']['tls']        				   = 'TLS';
$lang['label']['ssl']        				   = 'SSL';

$lang['label']['skip_duplicate']                  = 'Skip Duplicate';
$lang['label']['skip_duplicate_help']             = 'Skip duplicate email for open and click';


$lang['label']['track_opens']                  = 'Track Opens';
$lang['label']['track_opens_help']             = 'Track opening of the HTML emails';
$lang['label']['track_clicks']                 = 'Track Clicks';
$lang['label']['track_clicks_help']            = 'Track all links that are being clicked';
$lang['label']['embed_unsubscribe_link']       = 'Insert Unsubscribe Link';
$lang['label']['embed_unsubscribe_link_help']  = 'Inserts a unique unsubscribe link in the footer of HTML body of the email';
$lang['label']['unsubscribe_link']             = 'Unsubscribe Link';
$lang['label']['unsubscribe_email']            = 'Unsubscribe Email';
$lang['label']['unsubscribe_email_help']       = 'Inserts a unique unsubscribe link in the footer of HTML body of the email';
$lang['label']['unsubscribe_link_help']        = 'An unsubscribe link allows the recipient of your email to unsubscribe rather than hitting your email as spam, to discontinue further emailing';

$lang['label']['sender_info']                  = 'Sender Information';
$lang['label']['sender_info_help']             = '<td>Sender information indicates who the email is coming from e.g sender\'s name, email address, reply-to, return-path.<br><br><strong>From Contact List:</strong> It will fetch the sender details from Contact List details<br><strong>From Sending Node:</strong>&nbsp;It will fetch the sender details from Sending Node details<br>
<strong>Custom:</strong> Insert custom Sender Information</td>';
$lang['label']['from_list']                             = 'From Contact List';
$lang['label']['from_smtp']                             = 'From Sending Node';
$lang['label']['custom']                                = 'Custom';
$lang['label']['from_name']                             = 'From Name';
$lang['label']['from_name_help']                             = 'Provide the name of the person/company, who is sending this email message, the name will appear in from field of the recipient’s email client.';
$lang['label']['from_email']                            = 'From Email';
$lang['label']['from_email_help']                       = 'Email of the person/company who is sending the email message. It helps recipients to recognize the sender of the email.';
$lang['label']['bounce_email']                          = 'Bounce Email';
$lang['label']['bounce_email_help']  		   			= 'The email address where you want to receive the delivery reports of the failed messages. You need to add this email address to bounce addresses first.';
$lang['label']['reply_email'] 							= 'Reply-to Email';
$lang['label']['reply_email_help'] 					    = 'The email address where you want to receive the replies from the recipients.';
$lang['label']['choose_bounce_email']                   = 'Choose Bounce Email';
$lang['label']['choose_from_name_as_listed_in_list']    = 'Choose From Name as listed in List';
$lang['label']['choose_from_name_as_listed_in_smtp']    = 'Choose From Name as listed in SMTP';
$lang['label']['check_list_help']                       = 'It will update all contacts and add/remove the effected fields. This could be useful for segmentation.';

$lang['label']['System_Information'] 				    = 'Plan Details';
$lang['label']['Registered_To'] 				        = 'Registered To';
$lang['label']['package'] 				                = 'Package';
$lang['label']['registered'] 				            = 'Registered';
$lang['label']['Billing_Cycle'] 				        = 'Billing Cycle';
$lang['label']['expires'] 				                = 'Expires';
$lang['label']['name'] 				                    = 'Name';
$lang['label']['plan'] 				                    = 'Plan';
$lang['label']['Credits'] 				                    = 'Credits';
$lang['label']['response'] 							    = 'Response';
$lang['label']['minus_1_for_unlimited'] 				= '-1 for unlimited.';
$lang['label']['contact_list']       					= 'Contact List';
$lang['label']['contact_lists']      					= 'Contact Lists';
$lang['label']['note_no_list_found'] 					= 'Sorry, No List found';
$lang['label']['retry'] 					            = 'Retry';
$lang['label']['Mark_Resolved'] 					            = 'Mark Resolved';
$lang['label']['no_segment_found'] 						= 'Sorry, No Segment Found';
$lang['label']['create_one_here']  						= 'Create one here';
$lang['label']['regular']          						= 'Regular';
$lang['label']['running']          						= 'Running';
$lang['label']['pending']          						= 'Pending';
$lang['label']['force_restart']          			    = 'Force Restart';
$lang['label']['force_delete']							= 'Force Delete';
$lang['label']['restore']							    = 'Restore';
$lang['label']['refresh'] 								= 'Refresh';
$lang['label']['disabled'] 								= 'Disabled';
$lang['label']['disable'] 								= 'Disable';
$lang['label']['evergreen']        						= 'Evergreen';
$lang['label']['split_test']       						= 'Split Test';
$lang['label']['segments']         						= 'Segments';
$lang['label']['select_all']  							= 'Select all';
$lang['label']['select']      							= 'Select';
$lang['label']['email']       							= 'Email';
$lang['label']['campaign']    							= 'Campaign';
$lang['label']['web_version'] 							= 'Web Version';
$lang['label']['processing'] 							= 'Processing';
$lang['label']['processing_alert'] 						= 'Please do not close this window while processing!';
$lang['label']['lists']      							= 'Lists';
$lang['label']['campaigns']  							= 'Campaigns';
$lang['label']['learn_more'] 							= 'Learn more';
$lang['label']['setup_cron'] 							= 'Setup Cron';
$lang['label']['setup'] 							    = 'Setup';
$lang['label']['global'] 							    = 'Global';
$lang['label']['warning_notification'] 					= 'Warning Notification';
$lang['label']['click_here']     	   					= 'Click here';
$lang['label']['unique_opens']   	   					= 'Unique Opens';
$lang['label']['total_opens']    	   					= 'Total Opens';
$lang['label']['unique_clicked'] 	   					= 'Unique Clicked';
$lang['label']['total_clicked'] 						= 'Total Clicked';
$lang['label']['unsubscribe']   						= 'Unsubscribe';
$lang['label']['confirm']       						= 'Confirm';
$lang['label']['type']       						    = 'Type';
$lang['label']['value']       						    = 'Value';
$lang['label']['country']       						= 'Country';
$lang['label']['time_zone']       						= 'Time Zone';
$lang['label']['locale']       						= 'Locale';
$lang['label']['language']       						= 'Language';
$lang['label']['english']       						= 'English';
$lang['label']['city']       						    = 'City';
$lang['label']['state']       						    = 'State';
$lang['label']['select_file']   						= 'Select file';
$lang['label']['choose_file']   						= 'Choose file';
$lang['label']['select_list']   						= 'Select List';
$lang['label']['select_lists']                          = 'Select Lists';
$lang['label']['create_one_here']                       = 'Create one here';
$lang['label']['done']     								= 'Done';
$lang['label']['rename']   								= 'Rename';
$lang['label']['add']   								= 'Add';
$lang['label']['terminate']   							= 'Terminate';
$lang['label']['View_more']   							= 'View more';
$lang['label']['Enable_Disable']   						= 'Enable/Disable';
$lang['label']['No_data_found']   						= 'No data found';
$lang['label']['verify']   								= 'Verify';
$lang['label']['http']     								= 'HTTP';
$lang['label']['https']    								= 'HTTPS';
$lang['label']['download'] 								= 'Download';
$lang['label']['verifying'] 							= 'Verifying';
$lang['label']['sr'] 								    = 'Sr.';

$lang['label']['actions']         						= 'Actions';
// Sending nodes actions
$lang['label']['test_connection'] 						= 'Test Connection';
$lang['label']['import']          						= 'Import';
$lang['label']['export']          						= 'Export';
$lang['label']['set_active']      						= 'Set as Active';
$lang['label']['set_inactive']    						= 'Set as Inactive';
$lang['label']['make_copy']       						= 'Make a Copy';
$lang['label']['copy_clipboard']  						= 'Click here to Copy to clipboard';
$lang['label']['copy_success']    						= 'Successfully Copied';
$lang['label']['export_to_csv']   						= 'Export to CSV';
// Status
$lang['label']['status']          						= 'Status';
$lang['label']['active']          						= 'Active';
$lang['label']['inactive']        						= 'Inactive';
$lang['label']['auto_inactive']   						= 'Auto Inactive';
$lang['label']['verified']        						= 'Verified';
$lang['label']['unverified']      						= 'Unverified';
$lang['label']['assign_by_admin']      						= 'Assigned by Admin';
$lang['label']['end_of_notification']      						= 'End of notifications';
$lang['label']['return_path']      						= 'Add Return-Path';
$lang['label']['reply_path']      						= 'Different Reply Email';

/************* ** General ** *************/
$lang['minus_1_for_unlimited']         					= '-1 for unlimited';
$lang['success_copied']                                 = 'Successfully Copied';
$lang['actions']         						        = 'Bulk Actions';
/************* ** Table columns ** *************/

$lang['table']['column']['created_on'] 					= $created_on;
$lang['table']['column']['updated_on'] 					= $updated_on;
$lang['table']['column']['created_by'] 					= $created_by;
/************* ** Form action buttons ** *************/
$lang['form']['buttons']['save_add']                 =  "$save_add";
$lang['form']['buttons']['save_add_help']            =  "It saves the current list and resets the form to add a new one.";
$lang['form']['buttons']['save_and_keep_editing']    =  "$save_and_keep_editing";
$lang['form']['buttons']['save_exit']                =  "$save_exit";
$lang['form']['buttons']['save_exit_help']           =  'It saves the list and navigates to the "View Lists" page.';
$lang['form']['buttons']['save']   		             =  $save;
$lang['form']['buttons']['cancel'] 		             =  $cancel;
$lang['form']['buttons']['cancel_help']              =  "It cancels the operation";
$lang['form']['buttons']['submit'] 		             =  $submit;
$lang['form']['buttons']['reset']  		             =  $reset;
$lang['form']['buttons']['edit']   		             =  $edit;
$lang['form']['buttons']['delete'] 		             =  $delete;
$lang['form']['buttons']['update'] 		             =  "Update";
$lang['form']['buttons']['detail'] 		             =  "Detail";
$lang['form']['buttons']['close']  		             =  "Close";
$lang['form']['buttons']['copy']   		             =  "Copy";
$lang['form']['buttons']['export'] 		             =  "Export";
$lang['form']['buttons']['yes']    		             =  "Yes";
$lang['form']['buttons']['no']     		             =  "No";
$lang['form']['buttons']['skip']   		             =  "Skip";
$lang['form']['buttons']['next']   		             =  "Next";
$lang['form']['buttons']['back']   		             =  "Back";
$lang['form']['buttons']['continue']   	             =  "Continue";
$lang['form']['buttons']['move']   		             =  "Move";
$lang['form']['buttons']['tools']  		             =  "Tools";
$lang['form']['buttons']['duplicate']                =  "Duplicate";
$lang['form']['buttons']['add_new']                  =  $add_new;
$lang['form']['buttons']['add']                      = "Add";
$lang['form']['buttons']['export_all']                      = "Export all";

$lang['status']['updated'] = 'Record status has been successfully updated'; // status.updated

/************ Session **********/
$lang['session']['expire_alert']                     = 'Your Session is About to Expire!';
$lang['session']['logout']                           = 'Logout';
$lang['session']['stay_connected']                   = 'Stay Connected';
/************ Alert Messages **********/
$lang['message']['following_basic_steps']                = 'Complete the following basic steps to qualify for the first broadcast.';
$lang['message']['asset_not_allowed']                = 'You are editing the asset that belongs to a user';
$lang['message']['GeoIP_updated']                    = 'GeoIP updated successfully';
$lang['message']['GeoIP_permission']                 = 'Permission denied in /geoip folder. Give writable (0777) permissions to /geoip directory recursively.';
$lang['message']['license_verification_failed']      = 'License Verification Failed';
$lang['message']['export_process_background']        = 'The export process has been started in background, It will download automatically once its ready.';
$lang['message']['success_copied']                   = 'Successfully Copied';
$lang['message']['no_running_cron']              	 = "<b>Warning!</b> No running cron found. You'll need to setup a cronjob before you can start using application.";
$lang['message']['install_folder_warning']       	 = 'For security concerns, please delete /install folder';
$lang['message']['background_running_warning']   	 = "<b>Warning!</b> there are certain updates running in background. It's not advised to schedule further broadcasts until this message disappears.";
$lang['message']['delete_warning']                   = 'Are you sure you want to delete?';
$lang['message']['mode']                             = 'The application is running under :mode mode.';
$lang['message']['switch']                           = 'Switch to :mode';
$lang['message']['groups_created']                   = 'Group(s) successfully added!';
$lang['message']['no_files_uploaded']                = 'No files uploaded.';
$lang['message']['file_info_disabled']               = 'Fileinfo extension is not enabled';
$lang['message']['preparing_file']                   = 'Preparing the file to be imported';
$lang['message']['form_error']                       = 'You have some form errors. Please check below.';
$lang['message']['form_success']                     = 'Your form validation is successful!';
$lang['message']['alert_no_action']                  = 'No Action Selected.';
$lang['message']['alert_no_record']                  = 'No record selected.';
$lang['message']['success_operation']                = 'Operation is Successfull';
$lang['message']['went_wrong']                       = 'Something went wrong';
$lang['message']['alert_delete']                     = 'Are you sure to delete the record?';
$lang['message']['alert_confirm']                    = 'Do you really want to perform this action?';
$lang['message']['all_steps_completed']              = 'Congratulations! You have successfully completed initial steps.';
$lang['message']['FileSizeError']                    = 'The file you are trying to import exceeds the maximum allowed file size set of <b>:max_file</b> in your PHP configuration';
$lang['message']['local_infile']        			 = 'LOAD DATA LOCAL INFILE is disabled in MySql. You need to turn it on before you can use rocket import feature. <a href="https://school.mumara.com/troubleshoot/enabling-load-data-local-infile-in-mysql" class="kt-link kt-font-bold">How to turn it on?</a>';
$lang['message']['are_you_sure']                     = 'Are you sure?';
$lang['message']['cannot_revert']                     = 'You won\'t be able to revert this!';
$lang['message']['delete']                           = 'Record deleted successfully.';
$lang['message']['trigger_used']                     = 'Group is being used in trigger';
$lang['message']['drip_used']                        = 'Group is being used in Drip.';
$lang['message']['group_used']                       = 'Group is being used in Campaign';
$lang['message']['group_used_smtp']                  = 'Group is being used in Sending Node';
$lang['message']['send_domain_used']                 = 'Domain is being used in Sending Node or List';
$lang['message']['not_deleted']                      = 'Record Not Deleted';
$lang['message']['create']                           = 'Record Successfully created.';
$lang['message']['update']                           = 'Record Successfully updated.';
$lang['message']['updated']                          = ':title Successfully updated.';
$lang['message']['not_create']                       = 'Record Not created';
$lang['message']['update']                           = 'Record updated successfully';
$lang['message']['not_update']                       = 'Record not updated successfully';
$lang['message']['copy']                             = 'Copying has been started on the backend.';
$lang['message']['schedule_zero_contacts']           = "An error occurred: You're scheduling to 0 contacts";
$lang['message']['error_occurred']                   = "An error occurred";
$lang['message']['invalid_file_extension']           = 'Invalid File Extension';
$lang['message']['invalid_file'] 					 = 'Invalid File';
$lang['message']['opps']                             = "Error: Something went wrong! try again.";
$lang['message']['permission_denied']                = "Permission Denied";
$lang['message']['file_error']                       = "Error Processing File";
$lang['message']['no_record_found']                  = 'No record found.';
$lang['message']['select_one_list']                  = 'Select At least one list';
$lang['message']['confirmation_alert']               = 'Are you sure to perform action';
$lang['message']['issue_resolved']                   = ' Issue has been successfully resolved';
$lang['message']['view_change_log'] 				 = 'View change log';
$lang['message']['saved'] 				 			 = 'Successfully saved.';
$lang['message']['invalid_name'] 				     = 'A :section name can\'t contain any of the following characters:\\/:*?"<>|@';
$lang['message']['developer_license'] 				 = "This installation is running a developer's license and this domain shouldn't be publicly accessible.";
$lang['message']['primary_domain_not_verified'] 	 = "Primary domain is not verified";
// Import
$lang['message']['import_operation_aborted']         = 'The operation has been aborted';
$lang['message']['import_operation_success']         = "<b id='imported_alert'>0</b>&nbsp;new contacts&nbsp;<span id='grammar'>were</span>&nbsp;imported <span id='updated_alert'></span>&nbsp;out of&nbsp;<b id='total_alert'>0</b>&nbsp;contacts based on your import rules.";
$lang['message']['limit_exceeded']         = "<b>Warning:</b> :type sending limit has been exceeded for your account. Please contact your service provider for an upgrade.";
$lang['message']['alert_delete_evergreen_all']         = "Are you sure you really want to delete this Evergreen campaign? It will also delete the associated scheduled broadcasts and logs. ";
$lang['message']['alert_delete_evergreen']         = "Are you sure you want to delete this Evergreen campaign? ";
$lang['message']['temp_permission']                 = 'Permission denied in /temp folder. Give writable (0777) permissions to /temp directory recursively.';
/************* ** Activity Log Messages ** *************/
$lang['activity_log_messages']['created']['activity']    = 'Created';
$lang['activity_log_messages']['created']['description'] = 'Created Successfully';
$lang['activity_log_messages']['deleted']['activity']    = 'Deleted';
$lang['activity_log_messages']['deleted']['description'] = 'Deleted Successfully';
$lang['activity_log_messages']['updated']['activity']    = 'Updated';
$lang['activity_log_messages']['updated']['description'] = 'Updated Successfully';
$lang['activity_log_messages']['not_created'] 			 = 'Not Created';
$lang['activity_log_messages']['not_deleted'] 			 = 'Not Deleted';
$lang['activity_log_messages']['not_updated'] 			 = 'Not Updated';

/************ Datatable Filters **********/
$lang['filter']['our_records']  				   		 = 'Our Records';
$lang['filter']['user_records'] 				   		 = 'User Records';
$lang['filter']['user_select']  				   		 = 'Select A User';
$lang['filter']['filter_by_admin']  			   		 = 'Filter by admin';
$lang['filter']['all_users']  			   		         = 'All users';
$lang['filter']['all_admins']  			   		         = 'All admins';


/************* ** Rocket Import ** *************/
$lang['import']['rocket']['total_contacts']        		 = 'Total Contacts';
$lang['import']['rocket']['importing']             		 = 'Importing Contacts';
$lang['import']['rocket']['imported']              		 = 'Imported';
$lang['import']['rocket']['removing_duplicates']   		 = 'Removing Duplicates';
$lang['import']['rocket']['removing_invalids']     		 = 'Removing Invalids';

/************* ** Normal Import ** *************/
$lang['import']['normal']['total_contacts']              = 'Total Contacts';
$lang['import']['normal']['imported_successfuly']        = 'Imported successfully';
$lang['import']['normal']['imported']                    = 'Imported';
$lang['import']['normal']['duplicates']                  = 'Duplicates';
$lang['import']['normal']['invalids']                    = 'Invalids';



$lang['description']                                     = 'Description';



$lang['upgrade_application']['copy_failed']['message'] = 'Copying File failed';
$lang['campaign_delete'] = 'Campaign has been deleted.';
$lang['schedule_broadcast_deleted'] = 'Schedule Broadcast Deleted';
///// 
$lang['bounce_rate_limit_in_package']= 'Stop running campaigns when bounce rate reaches';
$lang['select_broadcast']= 'Select Broadcast';
$lang['all']= 'All';

$lang['delete_assets_modal_blade']['label_for_lists'] = 'Lists';
$lang['delete_assets_modal_blade']['action_contact_lists'] = 'Contact List';
$lang['delete_assets_modal_blade']['label_move_data'] = 'Move Data to';
$lang['delete_assets_modal_blade']['button_assign_delete'] = 'Re-assign and Delete';

$lang['custome_css_blade']['command_empty_css'] = 'Empty Css Box.';
$lang['custome_css_blade']['command_custome_styling'] = 'Custom Styling Successfully Updated.';
$lang['custome_css_blade']['command_nothing_change'] = 'Nothing to change.';

$lang['email_template']['create_blade']['file_size_span'] = 'File Size (Not found)';

$lang['error']['single_check'] = 'Minimum one selection is required.';
$lang['error']['double_check'] = 'Minimum two selections are required.';



return $lang;