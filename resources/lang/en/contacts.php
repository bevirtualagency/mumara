<?php
include("variables.php");
/**
 * Created by Mumara Team
 * Date: 06/19/2020
 */
/*-------------- 1. Contacts - Add new ----------------*/
$lang['add_new']['page']['title']       	      = 'Add a Contact';
$lang['add_new']['page']['description'] 	      = 'Add a contact to a list and store additional information of the contact by filling out additional/custom fields.';

/************* ** Form ** *************/
$lang['add_new']['form']['title']                 = 'Contact Details';
$lang['add_new']['form']['contact_list_help']     = 'select the contact list from the dropdown, to which you want to organize this contact';
$lang['add_new']['form']['email_address']         = 'Email Address';
$lang['add_new']['form']['email_address_help']    = 'It has to be a valid email address, otherwise '.$siteTitle.' will skip this row considering as invalid contact';
$lang['add_new']['form']['format_help']           = 'Format is a variation of the broadcast this contact will receive i.e HTML or TEXT version';
$lang['add_new']['form']['bounced']               = 'Bounced';
$lang['add_new']['form']['bounced_help']          = 'Add the contact as `Not Bounced`. Setting as hard bounced will prevent this contact from receive the emails';
$lang['add_new']['form']['not_bounced']           = 'Not Bounced';
$lang['add_new']['form']['soft_bounced']          = 'Soft Bounced';
$lang['add_new']['form']['hard_bounced']          = 'Hard Bounced';
$lang['add_new']['form']['unsubscribed']          = 'Unsubscribed';
$lang['add_new']['form']['unsubscribed_help']     = 'Add the contact as `No`. Setting to `Yes` will prevent the contact from receiving any email';
$lang['add_new']['form']['confirmation']          = 'Confirmation Status';
$lang['add_new']['form']['confirmation_help']     = 'Add this contact as a confirmed subscriber or unconfirmed';
$lang['add_new']['form']['status_help']           = 'Set the status of this contact as Active or Inactive';
$lang['add_new']['form']['suppressed']          = 'Suppressed';

/************* ** 2nd Step custom fields ** *************/  

/*============== End of add new page =========*/
$lang['edit']['page']['title']                     = 'Edit Contact';
$lang['detail']['modal']['contact_info']           = 'Contact Information';
$lang['detail']['modal']['custom_fields']          = 'Custom Fields';

/*------------- 2. Contacts -----------*/

$lang['page']['title']                             = 'View/Search Contacts';
$lang['page']['description']                       = 'List all contacts for a specific list or the whole database and perform additional actions e.g search, delete, edit etc.';

$lang['contact_detail']                            = 'Contact Details';
$lang['import_contacts']                           = 'Import Contacts';
$lang['bulk_actions']['button']['title']           = 'Bulk Actions';
$lang['bulk_actions']['button']['set_soft_bounce'] = 'Set as Soft Bounced';
$lang['bulk_actions']['button']['set_hard_bounce'] = 'Set as Hard Bounced';
$lang['bulk_actions']['button']['set_not_bounce']  = 'Set as Not Bounced';
$lang['bulk_actions']['button']['set_confirmed']   = 'Mark Confirmed';
$lang['bulk_actions']['button']['set_unconfirmed'] = 'Mark Unconfirmed';
$lang['bulk_actions']['button']['set_active']      = 'Set as Active';
$lang['bulk_actions']['button']['set_inactive']    = 'Set as inactive';

/************* ** Contacts Datatable ** *************/
$lang['table_headings']['contact']     			   = 'Contact';
$lang['table_headings']['country']     			   = 'Country';
$lang['table_headings']['list'] 	   			   = 'List';
$lang['table_headings']['added_on']    			   = $created_on;
$lang['table_headings']['bounced'] 	   			   = 'Bounced';
$lang['table_headings']['unsubscribed']			   = 'Unsubscribed';
$lang['table_headings']['confirmed']   			   = 'Confirmed';
$lang['table_headings']['group_name']			   = 'Group';
$lang['table_headings']['actions']                 = 'Actions';
$lang['table_headings']['active']                 = 'Active';
$lang['table_headings']['spammed']                 = 'Spammed';
$lang['table_headings']['suppressed']                 = 'Suppressed';
$lang['table_headings']['re_order']                 = 'Re-order Columns';
$lang['table_headings']['pre_columns']                 = 'Prioritize Columns';
$lang['table_headings']['pre_columns_text']                 = 'Select the columns you want to make visible for this contact list and re-arrange the order for prioritization.';


/*------------- 2.1 Contacts Email History  -----------*/
$lang['email_history']['page']['title']       	   = 'Email History';
$lang['email_history']['page']['description'] 	   = 'Email history description';
$lang['email_history']['subscriber_details']  	   = 'Contact Details';
$lang['email_history']['created_at']          	   = $created_on;

// Event Log
$lang['email_history']['event_log']                              = 'Event Log';
$lang['email_history']['campaign_table_heading']                 = 'Campaigns';
$lang['email_history']['triggers_table_heading']                 = 'Triggers';
$lang['email_history']['autoresponders_table_heading']           = 'Drip Campaigns';
$lang['email_history']['event_log_table_heading']['sr']          = 'Sr.';
$lang['email_history']['event_log_table_heading']['name']        = 'Name';
$lang['email_history']['event_log_table_heading']['sent']        = 'Sent';
$lang['email_history']['event_log_table_heading']['bounced']     = 'Bounced';
$lang['email_history']['event_log_table_heading']['opened']      = 'Opened';
$lang['email_history']['event_log_table_heading']['open_count']  = 'Open Count';
$lang['email_history']['event_log_table_heading']['clicked']     = 'Clicked';
$lang['email_history']['event_log_table_heading']['click_count'] = 'Clicked Count';
$lang['email_history']['event_log_table_heading']['status']      = 'Status';

/************* ** Messages ** *************/
$lang['message']['limit_exceeded']                               = 'Opsss... You are trying to import :total_subscribers contacts which is more than the remaining limit of :remaining_limit contacts. Please upload a smaller file or upgrade your plan';
$lang['message']['limit_exceeded1']                               = 'Contacts limit has been exceeded';
$lang['message']['list_limit_exceeded']                               = 'This contact list is limited to :subscribers_limit contacts';
$lang['message']['limit_exceeded_admin']                               = 'There is a problem adding more contacts. Please contact the administrator!';
$lang['message']['no_rights_more_contact']                               = 'Your have no rights to add more contacts.';

$lang['message']['limit_exceeded_copy']                          = 'Contacts limit has been exceeded. You can copy this list';
$lang['message']['limit_exceeded_demo']                          = 'Contacts limit has been exceeded. Only 5000 contacts can be imported in demo version';
$lang['message']['bulk_update_complete']                         = 'Bulk update has been successfully completed';
$lang['message']['all_files_deleted']                            = 'All uploaded files have been deleted';
$lang['message']['access_denied']                                = 'Access Denied.';
$lang['message']['contact_email_exists']                         = 'Subscriber :email already exists in the list :list_name';
$lang['message']['selected_lists']                               = 'Selected Lists';
$lang['message']['email_mapping_error']                          = 'One mapped field must be an email to proceed.';
$lang['message']['no_list_error']                                = 'You need to create a Contact List before you can start importing your contacts.';
$lang['message']['import_operation_success']                     = "<div class='alert alert-success alert-light alert-bold' role='alert' id='resultbar'><b> <div id='imported'>0</div> </b>&nbsp;contacts were imported out of &nbsp; <b> <div id='total_alert'>0</div> </b>&nbsp;contacts based on your import rules.</div>";
$lang['message']['subscriber_not_found']                         = 'The associated subscriber not found or has been deleted.';

/************* ** General ** *************/
$lang['select_country'] = 'Select Country';
$lang['choose_a_list']  = 'Choose a list';
$lang['activity_title'] = 'Contact';
$lang['title'] = 'Contacts';
$lang['note'] = 'Add/Import your contacts whom you want to send your first broadcast.';

/*------------- 3. Contacts - Import Contacts -----------*/
$lang['import']['page']['title']                              = 'Import Contacts';
$lang['import']['page']['description']                        = 'Import bulk contacts from a csv file and map the additional fields. The importing process makes it super easy and fast for your to get your contacts inserted into '.$siteTitle.' within few minutes.';
$lang['import']['form']['heading']                            ="Contact Detail";
$lang['import']['form']['import_file']                        = 'File Source';
$lang['import']['form']['import_file_help']                   = 'Select file source i.e upload from your computer or choose it from already uploaded files on the server';
$lang['import']['form']['email_address_help']                 = 'It has to be a valid email address, otherwise '.$siteTitle.' will skip this row considering as invalid contact';
$lang['import']['form']['select_file_help']                   = '	Select the file from your computer or from the server (depending upon the selection you made above)';
$lang['import']['form']['contact_list_help']                  = 'Select a contact list you want the contacts to be imported in';
$lang['import']['form']['create_a_list']                      = 'Create a List';
$lang['import']['form']['import_speed']                       = 'Import Speed Booster';
$lang['import']['form']['import_speed_help']                  = 'Increase the import speed up to 4 times by opening parallel sockets';
$lang['import']['form']['format_help']                        = 'Which version of the email/broadcast these contacts will receive i.e HTML or TEXT';
$lang['import']['form']['file_format']                        = 'File Format';
$lang['import']['form']['file_format_help']                   = 'Choose the format of your file you are importing';
$lang['import']['form']['duplicates_help']                    = 'If duplicates are found, do you want '.$siteTitle.' to skip duplicates or overwrite the previous contacts with new info';
$lang['import']['form']['contacts_from']                      = 'Importing Contacts From';
$lang['import']['form']['select_none']                        = 'None';
$lang['import']['form']['confirmation_status']                = 'Confirmation Status';
$lang['import']['form']['confirmation_status_help']           = 'Import these contacts with a confirmed status so they receive your emails smoothly';
$lang['import']['form']['contact_status']                     = 'Contact Status';
$lang['import']['form']['contact_status_help']                = 'Import these contacts with an active status so '.$siteTitle.' doesn\'t filter them out before sending emails';
$lang['import']['form']['line_contains_headers_help']         = 'Whether the first line of your csv file contains header or not. If yes then '.$siteTitle.' skips the first line during import';
$lang['import']['form']['select_date_format']                 = 'Select date format';
$lang['import']['form']['override_creation_date']             = 'Override Creation Date';
$lang['import']['form']['override_creation_date_help']        = 'It is useful when you have triggers and drips running based on contact\'s creation date.';
$lang['import']['form']['notification']                       = 'You can navigate away from this page now. The import will keep running in the background!';
$lang['import']['form']['record_processed'] 				  = 'No of Records Processed';
//$lang['import']['api']['step1_success'] 				  = 'Import first has been successfully completed';
$lang['import']['api']['file_not_exist'] 				  = "The file doesn't exist";
$lang['import']['api']['running_in_background'] 		          = 'The import has been started in background';
$lang['import']['api']['email_column_error'] 				  = 'A mandatory column missing (email)';
$lang['import']['api']['list_not_exist'] 				  = "The contact list doesn't exist";

$lang['controller']['session']['contact_admin']                         = 'There is a problem adding more contacts. Please contact the administrator!';
$lang['controller']['file_type']                         = 'The file must be a file of type ';
$lang['controller']['data_not_found']                         = 'Not Found';
$lang['bulk_update']['total_contact_td']                         = 'Total Contacts:';
$lang['bulk_update']['imported_td']                         = 'Imported:';
$lang['bulk_update']['duplicates_td']                         = 'Duplicates:';
$lang['bulk_update']['invalids_td']                         = 'Invalids:';
$lang['bulk_update']['cancel_import_td']                         = 'Cancel import';
$lang['bulk_update']['operation_aborated_div']                         = 'The operation has been aborted';
$lang['bulk_update']['new_contact_div']                         = 'new contacts';
$lang['bulk_update']['imported_div']                         = 'imported';
$lang['bulk_update']['out_of_div']                         = 'out of';
$lang['bulk_update']['Import_rules_div']                         = 'contacts based on your import rules.';
$lang['create_blade']['small_note_confirm_email_subscription']                         = 'Note: This contact will need to confirm the email subscription before he/she can start receiving the campaigns.';
$lang['custom_fields_blade']['Option_chosse']                         = 'Choose an Option';
$lang['import_blade']['small_note_confirm_email']                         = 'Note: These contacts will need to confirm the email subscription before he/she can start receiving the campaigns.';
$lang['index_blade']['button_contacts_limit']                         = 'Contacts Limit:';
$lang['index_blade']['button_Close']                         = 'Close';
$lang['index_blade']['json_browser_val']                         = 'JSON browser support required for this demo.';
$lang['controller']['echo_file_not_found']                         = 'file not found';
$lang['bulk_update']['total_contact_td']                         = '';


/*------------- 3. Contacts - Bulk Update -----------*/
$lang['bulk_update']['page']['title']                               = 'Bulk Update';
$lang['bulk_update']['page']['description']                         = 'Perform Bulk action on contacts in the file to the selected list.';
$lang['bulk_update']['form']['contact_list_help']                   = 'Select the contact list(s) to be updated';
$lang['bulk_update']['form']['action']                              = 'Action';
$lang['bulk_update']['form']['action_help']                         = 'Select the action from the dropdown to be performed';
$lang['bulk_update']['form']['choose_action']                       = 'Choose Action';
$lang['bulk_update']['form']['actions']['delete']                   = 'Delete contacts';
$lang['bulk_update']['form']['actions']['unsubscribe']              = 'Update to unsubscribed';
$lang['bulk_update']['form']['actions']['unsubscribed_as_active']   = 'Update to not unsubscribed';
$lang['bulk_update']['form']['actions']['soft_bounce']              = 'Update to soft bounced';
$lang['bulk_update']['form']['actions']['hard_bounce']              = 'Update to hard bounced';
$lang['bulk_update']['form']['actions']['active']                   = 'Update status to active';
$lang['bulk_update']['form']['actions']['inactive']                 = 'Update status to inactive';
$lang['bulk_update']['form']['actions']['confirmed']                = 'Update confirmation status to confirmed';
$lang['bulk_update']['form']['actions']['unconfirmed']              = 'Update confirmation status to unconfirmed';
$lang['bulk_update']['form']['actions']['html']                     = 'Update format to receive HTML';
$lang['bulk_update']['form']['actions']['text']                     = 'Update format to receive TEXT';
$lang['bulk_update']['task']['scheduled']                           = 'A background task has been successfully scheduled to update contacts.';
$lang['bulk_update']['task']['title']                           = 'Update contacts';
$lang['bulk_update']['task']['records_in_file']                           = 'Total records in file';
$lang['bulk_update']['task']['records_in_lists']                           = 'Total records in lists';
$lang['bulk_update']['task']['processed']                           = 'Processed records';
$lang['bulk_update']['task']['updating']                           = 'Updating ';
$lang['bulk_update']['task']['using']                           = 'using';
$lang['bulk_update']['task']['cancel']                           = 'update has been cancelled';
$lang['bulk_update']['task']['updated']                           = 'lists has been successfully updated using';
$lang['bulk_update']['task']['preparing']                           = 'Preparing to start updated';
$lang['bulk_update']['task']['background']                           = 'You can navigate away from this page now. The import will keep running in the background!';

/*------------- 2.1 Contacts Email History  -----------*/
$lang['timeline']['page']['title']       	   = 'Subscriber Timeline';
$lang['timeline']['page']['description'] 	   = 'Subscriber Timeline description';

return $lang;