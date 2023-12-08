<?php
include("variables.php");
/**
 * Created by Mumara Team
 * Date: 06/015/2020
 */
$lang= [];
/*-------------- 1. Lists - Add new list ----------------*/

/************* ** Page Top Bar ** *************/
$lang['title']                                     			   = 'Lists';
$lang['add_new']['page']['title']                  			   = 'Add Contact List';
$lang['add_new']['page']['description']            			   = "A contact list is where you can store your leads and their important information. You can add unlimited contact lists that can hold any number of contacts.";

/************* ** Form ** *************/

$lang['add_new']['form']['title']                  			    = 'Contact List Details';
$lang['add_new']['form']['list_name']              			    = 'List Name';
$lang['add_new']['form']['list_name_help']              	    = 'Name the contact list you are creating.';
$lang['add_new']['form']['group']                  			    = 'Group';
$lang['add_new']['form']['group_help']                  	    = 'Create/select a group you want this list to be sorted in.';
$lang['add_new']['form']['choose_a_group']         			    = 'Choose a Group';
$lang['add_new']['form']['new_group']              			    = 'Add New Group';
$lang['add_new']['form']['additional_fields']      			    = 'Additional Fields';
$lang['add_new']['form']['additional_fields_help']      	    = 'There are pre-defined custom fields that are used more often. However, you can also create custom fields as well and assign them to contact list(s). There are certain field types e.g text, dropdown, checkboxes, etc and each field type has a unique scope.';
$lang['add_new']['form']['custom_fields'] 		   			    = 'Custom Fields';
$lang['add_new']['form']['owner_name']    		   			    = 'Owner Name';
$lang['add_new']['form']['owner_name_help']    		   			= 'The person who owns this list. Owner name can also appear in "Mail-From" headers if you select sender info to be fetched from contact list details while scheduling a broadcast.';
$lang['add_new']['form']['owner_email']   		   			    = 'Owner Email';
$lang['add_new']['form']['owner_email_help']   		   			= "The email address of the list owner on one of the confirmed sending domains. It's important to add the owner's domain to the Sending Domains before a list can be created on it.";
$lang['add_new']['form']['assign_fields'] 		   			    = 'Assign Fields';
$lang['add_new']['form']['choose_domain'] 		   			    = 'Choose Domain';
$lang['add_new']['form']['choose_a_bounce_handler']			    = 'Choose a Bounce Handler';
$lang['add_new']['form']['bounce']['email_msg']    			    = 'Bounce email is empty. Add bounce mailbox!';
$lang['add_new']['form']['alert_danger_msg']       			    = 'Oh snap! Change a few things up and try submitting again.';
$lang['add_new']['form']['check_contacts']       			    = 'Update the custom fields of all contacts within this list';
$lang['add_new']['form']['check_contacts_message']       	    = 'If you have un-assigned any custom field, the data will be flushed for that field.';
$lang['add_new']['form']['check_contacts_message_note']       	= 'Note';
$lang['add_new']['form']['prioritize_visibility']       	= 'Prioritize Visibility';
//added by azeem dated 19-11-2021
$lang['add_new']['form']['contact']       	= 'Contact';
$lang['add_new']['form']['country']       	= 'Country';
$lang['add_new']['form']['list']                = 'List';
$lang['add_new']['form']['contact_on']       	= 'Contact on';
$lang['add_new']['form']['bounced']       	= 'Bounced';
$lang['add_new']['form']['unsubscribed']       	= 'Unsubscribed';
$lang['add_new']['form']['confirmed']       	= 'Confirmed';
$lang['add_new']['form']['spammed']       	= 'Spammed';
$lang['add_new']['form']['suppressed']       	= 'Suppressed';
$lang['add_new']['form']['active']       	= 'Active';
$lang['add_new']['form']['contact_included']   	= 'include Email, First name and Last name';

//end added by azeem dated 19-11-2021


/************* ** infowiz modal ** *************/
$lang['add_new']['infowiz']['welcome_msg']      	   			= 'Welcome to Campaigns+';
$lang['add_new']['infowiz']['congratulations']  	   			= 'Congratulations!';
$lang['add_new']['infowiz']['welcome_question'] 	   			= 'What you can do with '.$siteTitle.'?';
$lang['add_new']['infowiz']['welcome_question_point1'] 			= 'Send Email Campaigns';
$lang['add_new']['infowiz']['welcome_question_point2'] 			= 'Trigger based automated actions';
$lang['add_new']['infowiz']['welcome_question_point3'] 			= 'Authenticate Sending Domains';
$lang['add_new']['infowiz']['welcome_question_point4'] 			= 'Integrate with your favorite ESP';
$lang['add_new']['infowiz']['welcome_question_point5'] 			= 'Rotate Sending Nodes (SMTPs)';
$lang['add_new']['infowiz']['welcome_question_point6'] 			= 'Segment your data';
$lang['add_new']['infowiz']['welcome_question_point7'] 			= 'Auto Follow-ups (Drip Campaigns)';
$lang['add_new']['infowiz']['welcome_question_point8'] 			= 'Run Split Tests';
$lang['add_new']['infowiz']['welcome_more'] 		   			= 'And Much More...';
$lang['add_new']['infowiz']['import_your_contacts']    			= 'Import your contacts';
$lang['add_new']['infowiz']['csv'] 					   			= 'CSV';
$lang['add_new']['infowiz']['read_more'] 			   			= 'Read More';
$lang['add_new']['infowiz']['automate_your_marketing'] 			= 'Automate Your Marketing';
$lang['add_new']['infowiz']['automate_your_marketing_desc'] 	= 'The buzz about increasing the conversion rate with Trigger Based Campaigns is all real, where your marketing strategies are driven by the prospect’s activities/actions, rather than your own marketing timeline. In Campaign+ Triggers can help you start or stop the marketing automation activity, with an ability to explore variety of selections and preset types of automation.';
$lang['add_new']['infowiz']['segment_your_data']      			= 'Segment your data';
$lang['add_new']['infowiz']['segment_your_data_desc'] 			= 'Segmentation with all new possibilities to deeply dig your database and create contact groups of similar sort, and segments of contacts with comparable behavior. These better targeted small groups of contacts will help to significantly improve customer engagement and message response rate. Create your next targeted subset using extensive list of filters available at your disposal.';
$lang['add_new']['infowiz']['check_here_and_close']   			= 'Check here and close if you never see this help again.';


$lang['add_new']['infowiz']['x']   			= 'X';
$lang['contact_lists']['modal']['delete']['list']   			              = 'All the contacts inside the list and their associated data will be deleted. Are you sure to proceed?';
$lang['contact_lists']['modal']['delete']['selected_list']   			              = 'All the contacts inside the selected lists and their associated data will be deleted. Are you sure to proceed?';  
$lang['dedupe_contact']		              = 'Dedupe Contacts';  
$lang['contact']['contact_list']		              = 'Find matching contacts of this contact list among all contact lists and';  
$lang['delete']['all_contact_list']		              = 'Delete the matching contacts from all other contact lists';  
$lang['delete']['selected_contact_list']		              = 'Delete the matching contacts from this contact list';  
$lang['dedupe']		              = 'Dedupe';  
$lang['all_lists']		              = 'All Lists';  
$lang['list']['exist']		              = 'already Exists in';  
$lang['task']['background']		              = 'The task has been scheduled in the background';  
$lang['deduped']['list'] = 'Dedupe List'; 
$lang['succes']		              = 'success';  
$lang['segment']		              = 'Segments'; 
$lang['save']['save']		              = 'save_add'; 
$lang['segment']		              = 'Segments'; 
$lang['action']['verify_list']			              = 'Verify List'; 
$lang['action']['importing']			              = 'Importing';
$lang['action']['importing_history']			              = 'Import History';
$lang['sucess']			              = 'success';
$lang['expection']			              = 'Exception';
$lang['is_unsubscribed']['expection']				              = 'Updated Unsubscribed as Active for Selected Lists';
$lang['list_not_found']				              = 'List not found';

$lang['list_contacts_counters']				              = 'The contacts counters have been successfully updated';

$lang['controller']['exporty_supressed_error']		              = 'Export Supressed list not saved'; 
$lang['controller']['export_list_error']		              = 'Export List stop error:'; 


/*============== End of add new page =========*/


/*------------- 2. Lists - Contact Lists -----------/

/************* ** Page Top Bar ** *************/
$lang['contact_lists']['missing_sending_domain']      						  = 'Missing Sending Domain';
$lang['contact_lists']['page']['title']       						  = 'Contact Lists';
$lang['contact_lists']['page']['description'] 						  = 'Contact lists page is where you view your created lists with multiple sorting options (default sorting is by creation date in descending order). You can view, edit and manage existing contact lists and groups, moreover perform additional actions e.g add a contact, import contacts, make a copy, export to CSV, split list, merge into another list, etc.';

/************* ** Contact Lists Dropdown Actions ** *************/
$lang['contact_lists']['actions']['select']       					  = 'Select Action';
$lang['contact_lists']['actions']['delete_lists'] 					  = 'Delete Selected Lists';
$lang['contact_lists']['actions']['delete_lists_contacts'] 			  = 'Delete contacts within selected lists';
$lang['contact_lists']['actions']['mark_confirm']   				  = 'Mark as Confirmed';
$lang['contact_lists']['actions']['mark_unconfirm'] 				  = 'Mark as Unconfirmed';
$lang['contact_lists']['actions']['receive_html']   				  = 'Update Format to HTML';
$lang['contact_lists']['actions']['receive_text']   				  = 'Update Format to TEXT';
$lang['contact_lists']['actions']['mark_soft_bounce_active']          = 'Mark Soft Bounced as Active';
$lang['contact_lists']['actions']['mark_hard_bounce_active']          = 'Mark hard Bounced  as Active';
$lang['contact_lists']['actions']['mark_unsubscribed_active']         = 'Mark Unsubscribed as Active';
$lang['contact_lists']['actions']['contacts_status_to_ctive']         = 'Set to Active';
$lang['contact_lists']['actions']['contacts_status_to_inctive']       = 'Set to Inactive';
$lang['contact_lists']['actions']['delete_soft_bounced_contacts'] 	  = 'Delete Soft Bounced';
$lang['contact_lists']['actions']['delete_hard_bounced_contacts'] 	  = 'Delete Hard Bounced';
$lang['contact_lists']['actions']['delete_suppressed_contacts']       = 'Delete Suppressed';
$lang['contact_lists']['actions']['delete_unsubscribed_contacts']     = 'Delete Unsubscribed';
$lang['contact_lists']['actions']['go']                               = 'GO'; 

/* ################### Modals ############# */

$lang['contact_lists']['modal']['soft_or_hard_delete']                = 'Soft or Hard Delete'; 
$lang['contact_lists']['modal']['soft_delete'] 			              = 'Soft Delete'; 
$lang['contact_lists']['modal']['hard_delete'] 			              = 'Hard Delete'; 

$lang['contact_lists']['modal']['import']['import_history']           = 'Import History';
$lang['contact_lists']['modal']['import']['importing']                = 'Importing';

$lang['contact_lists']['modal']['merge']['title']                     = 'Merge List';
$lang['contact_lists']['modal']['merge']['processing']                = 'Processing';
$lang['contact_lists']['modal']['merge']['processing_note']           = 'Please do not close this window while processing!';
$lang['contact_lists']['modal']['merge']['into']                      = 'Into';

$lang['contact_lists']['modal']['move-list']['move_list']             = 'Move List to other group';
$lang['contact_lists']['modal']['move-list']['choose_group']          = 'Choose a Group';

$lang['contact_lists']['modal']['copy-list']['title']    	          = '<label> Are you sure to copy the list  &nbsp;"<strong> :list_name </strong>"</label><br>';
$lang['contact_lists']['modal']['copy-list']['progress'] 	          = 'Copying Progress....';
$lang['contact_lists']['modal']['copy-list']['copying']  	          = 'Copying';
$lang['contact_lists']['modal']['copy-list']['copying_note']          = 'Press close button to stop Copy.';
$lang['contact_lists']['modal']['copy-list']['copy_contacts']         = 'Only Contact emails will be copied';
$lang['contact_lists']['modal']['copy-list']['copy_contacts_label']   = 'Copy Contacts';
$lang['contact_lists']['modal']['copy-list']['no_of_copies']          = 'Number of Copies';
$lang['contact_lists']['modal']['copy-list']['copy']                  = 'Copy';

$lang['contact_lists']['modal']['split']['title']                     = 'Split Lists';
$lang['contact_lists']['modal']['split']['split_by']                  = 'Split By';

/************* ** Contact Lists View ** *************/
$lang['contact_lists']['view']['list_view']                           = 'List View';
$lang['contact_lists']['view']['tree_view']                           = 'Tree View';

/************* ** Contact List Actions ** *************/
$lang['contact_lists']['actions']['add_subscriber_to_list']  		  = 'Add a contact';
$lang['contact_lists']['actions']['import_list']             		  = 'Import contacts';
$lang['contact_lists']['actions']['export_to_csv']           		  = 'Export contacts';
$lang['contact_lists']['actions']['copy']                    		  = 'Make a copy';
$lang['contact_lists']['actions']['split_list']              		  = 'Split list';
$lang['contact_lists']['actions']['move_list']               		  = 'Move list to another';
$lang['contact_lists']['actions']['merge_list']              		  = 'Merge into another';
$lang['contact_lists']['actions']['reCountListSubscribers']  		  = 'Re-count Subscribers';
$lang['contact_lists']['actions']['edit']                    		  = 'Edit';
$lang['contact_lists']['actions']['delete']                  		  = 'Delete';
$lang['contact_lists']['actions']['no_of_contacts_per_list'] 		  = 'No of Contacts Per List';
$lang['contact_lists']['actions']['no_of_contact_lists']     		  = 'No of Contact Lists';
$lang['contact_lists']['actions']['export_process_started']  		  = 'The export process has been started in background, you`ll be to download it once ready.';
$lang['contact_lists']['actions']['exported']  		  = 'Exporting';
$lang['contact_lists']['export']['cancel']  		  = 'Cancel';
$lang['contact_lists']['export']['retry']  		  = 'Retry';
$lang['contact_lists']['export']['resume_export_msg']  		  = 'Export resumed successfully';
$lang['contact_lists']['export_stop']['confirmation']  		  = 'Are you sure to stop export?';
$lang['contact_lists']['export_stop']['message']  		  = 'Exporting List-%%list_name%% has been Terminated Successfully';


/************* ** Contact List group view actions ** *************/
$lang['contact_lists']['actions']['edit']        					  = 'Rename group';
$lang['contact_lists']['actions']['delete_move'] 					  = 'Delete group and move lists to Unsorted';
$lang['contact_lists']['actions']['delete']      					  = 'Delete group and all lists inside';


/************* ** Messages ** *************/
$lang['contact_lists']['message']['alert_sure']                       = 'Are you sure to create';
$lang['contact_lists']['message']['soft_or_hard_delete']              = 'Soft delete will keep the contacts systematic details e.g. id, creation_date, bounced, etc, and deletes all other personal info e.g. email address, custom fields data, etc to preserve the logs. However, hard delete will delete everything.';
$lang['contact_lists']['message']['contact_in_each']                  = 'Contact In each List';
$lang['contact_lists']['message']['confirmation_message']             = 'Are you sure to';
$lang['contact_lists']['message']['selected_lists']                   = 'Selected Lists';
$lang['contact_lists']['message']['success_delete']                   = 'Record deleted successfully.';
$lang['contact_lists']['message']['verifying']                        = 'Verifying';
$lang['contact_lists']['message']['success_group_saved']              = 'Group successfully saved.';
$lang['contact_lists']['message']['success_group_deleted']            = 'Group successfully deleted.';
$lang['contact_lists']['message']['alert_delete_group']               = 'Are you sure to delete this group?';
$lang['contact_lists']['message']['success_list_moved']               = 'List Moved Successfully.';
$lang['contact_lists']['message']['alert_list_exists']                = 'List already Exists In Selected Group.';
$lang['contact_lists']['message']['alert_merge']                      = 'Are you sure to merge?';
$lang['contact_lists']['message']['success_copied']                   = 'Lists Successfully copied.';
$lang['contact_lists']['message']['list_limit']                       = 'Lists limit exceeded, your are not allowed to create the List.';
$lang['contact_lists']['message']['segments_triggers_alert_delete']   = 'Lists Connected to Segments or Triggers Cannot be Deleted';
  
$lang['contact_lists']['message']['list_deleted_success']             = 'Selected Lists Deleted Successfully';
$lang['contact_lists']['message']['list_contact_deleted_success']     = 'Contact Delete process is running on background. List will be available as soon contacts will be deleted.';  
$lang['contact_lists']['message']['status_update_confirmed']          = 'Status Successfully Updated to confirm';
$lang['contact_lists']['message']['status_update_unconfirmed']        = 'Status Successfully Updated to not confirm';
$lang['contact_lists']['message']['status_update_html']               = 'Format Updated to receive HTML';
$lang['contact_lists']['message']['status_update_text']               = 'Format Updated to receive text';
$lang['contact_lists']['message']['status_delete_soft_bounce']        = 'Deleted Soft Bounces for Selected Lists';
$lang['contact_lists']['message']['status_delete_hard_bounce']        = 'Deleted Hard Bounces for Selected Lists';
$lang['contact_lists']['message']['status_delete_unsubscribed']       = 'Successfully Deleted Unsubscribed for Selected Lists';
$lang['contact_lists']['message']['status_delete_suppressed']         = 'Successfully Deleted Suppressed for Selected Lists';
$lang['contact_lists']['message']['status_convert_soft_active']       = 'Updated Soft Bounces as Active for Selected Lists';
$lang['contact_lists']['message']['status_convert_hard_active']       = 'Updated Hard Bounces as Active for Selected Lists';
$lang['contact_lists']['message']['status_update_active']             = 'Updated Status as Active for Selected Lists';
$lang['contact_lists']['message']['status_update_inactive']           = 'Updated Status as Inactive for Selected Lists';
$lang['contact_lists']['message']['status_unsubscribe_active']        = 'Updated Unsubscribed as Active for Selected Lists';

/************* ** General ** *************/
$lang['activity_title'] = 'Contact List';
$lang['edit']['title']  = 'Edit List';
$lang['merge']          = 'Merge';
$lang['note']           = 'Create a contact list that can store your contacts/subscribers information.';

$lang['list_not_found']           = 'List not found'; //aded by azeem dated 28-10-2021
$lang['file_not_found']           = 'File not found'; //aded by azeem dated 28-10-2021


/************* ** Datatable ** *************/
$lang['contact_lists']['table_headings']['group_list_name']            = 'Group / List Name';
$lang['contact_lists']['table_headings']['list_name']                  = 'List Name';
$lang['contact_lists']['table_headings']['group_name']                 = 'Group Name';
$lang['contact_lists']['table_headings']['subscribers']                = 'Contacts';
$lang['contact_lists']['table_headings']['created_by']                 = 'Added By';
$lang['contact_lists']['table_headings']['last_activity'] 			   = 'Last Activity';
$lang['contact_lists']['table_headings']['actions']     			   = 'Actions';
$lang['contact_lists']['table_headings']['created_on']  			   = 'Created On';
$lang['contact_lists']['table_headings']['updated_on']  			   = 'Last Updated';
$lang['delete_list']['alert']  			   = '<b>Error:</b> Un-assign the contact list from the associated assets and then delete it.';
$lang['delete_list']['mdl_title'] = 'Associated assets';


$lang['eligible_domains']   =   'Eligible Domains';
$lang['ineligible_domains']   =   'Ineligible Domains';

$lang['additional_header']['heading']   =   'Additional Headers';
$lang['additional_header']['description']   =   'Find out the additional options below and set if needed.';
$lang['additional_header']['note']   =   'Note: Spaces and special characters are not supported except hyphens (-)';
$lang['additional_header']['title']   =   'Additional Headers';
$lang['additional_header']['btn_add']   =   'Add New';



return $lang;