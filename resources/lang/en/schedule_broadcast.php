<?php
include("variables.php");
/**
 * Created by Mumara Team
 * Date: 06/24/2020
 */
/*-------------- 1. Campaigns -> View Scheduled ----------------*/

$lang['view']['page']['title']       = 'View Scheduled';
$lang['view']['page']['delete']       = 'Delete'; //added by azeem dated 15-10-2021
$lang['view']['page']['select_options']       = 'Select Bulk Operation'; //added by azeem dated 15-10-2021
$lang['view']['page']['description'] = 'This page lists all of the scheduled broadcasts no matter if they are running, completed, paused, stopped, or even scheduled for the future along with real-time brief statistics of numbers i.e how many were scheduled and how many have been sent.';
$lang['view']['page']['primary_domain_unverified']           = 'Primary Domain is not verified.';
$lang['view']['page']['setup_primary_domain']                = 'Setup Primary Domain';
$lang['view']['page']['schedule_email_campaign']             = 'Schedule Email Campaign';
$lang['view']['page']['system_paused']             			 = 'System Paused';

$lang['view']['page']['hourly_speed']              			 = 'Hourly Speed';
$lang['view']['page']['edit_hourly_speed']         			 = 'Edit Hourly Speed';
$lang['view']['page']['system_paused']             			 = 'System Paused';
$lang['view']['page']['send_camapign']             			 = 'Send Camapign';
$lang['view']['page']['delete_campaign']           			 = 'Delete Campaign';
$lang['view']['page']['waiting_to_pause_campaign'] 			 = 'Waiting first to pause Campaign';
$lang['view']['page']['pause_campaign']            			 = 'Pause Campaign';
$lang['view']['page']['re_schedule_campaign']      			 = 'Re-schedule campaign';

$lang['view']['page']['sort']['all']           				= 'All';
$lang['view']['page']['sort']['scheduled']     				= 'Scheduled';
$lang['view']['page']['sort']['processing']    				= 'Running';
$lang['view']['page']['sort']['complete']      				= 'Completed';
$lang['view']['page']['sort']['paused']      				= 'Paused';
$lang['view']['page']['sort']['system_paused']      				= 'System Paused';
$lang['view']['page']['sort']['prepared']      				= 'Prepared';
$lang['view']['page']['sort']['resumed']      				= 'Resumed';
$lang['view']['page']['filters']['regular_campaigns']       = 'Regular Broadcasts';
$lang['view']['page']['filters']['segmented_campaigns']     = 'Segmented Broadcasts';
$lang['view']['page']['filters']['split_test'] 				= 'Split Tests';
$lang['view']['page']['filters']['evergreen'] 				= 'Evergreen';
$lang['view']['page']['delete_message']				= 'The associated statistics will also be deleted. Are you sure that you want to proceed?'; //added by azeem dated 20-10-2021
 

/************* ** View Scheduled Datatable ** *************/
$lang['view']['table_headings']['id']        = 'ID';
$lang['view']['table_headings']['name']        = 'Schedule Label';
$lang['view']['table_headings']['start_time']  = 'Start Time';
$lang['view']['table_headings']['status'] 	   = 'Status';
$lang['view']['table_headings']['contacts']    = 'Audience';
$lang['view']['table_headings']['progress']    = 'Progress';
$lang['view']['table_headings']['actions']     = 'Actions';

/*-------------- 1. Actions -> Schedule -> add new ----------------*/
$lang['add_new']['page']['title']       = 'Schedule';
$lang['edit']['page']['title']          = 'Re-scheduling the broadcast ';
$lang['add_new']['page']['description'] = 'The scheduling process is a wizard that helps you schedule a broadcast/campaign on the selected list(s) and criteria.';
// Setup Tab
$lang['add_new']['tab1']['heading']          		     = 'Setup';
$lang['add_new']['tab1']['desc']             		     = 'Setup';

$lang['add_new']['tab1']['form']['schedule_label']       = 'Schedule Label';
$lang['add_new']['tab1']['form']['schedule_label_help']  = 'Friendly name to identify on `view scheduled` and `statistics page`';
$lang['add_new']['tab1']['form']['campaign_type']        = 'Campaign Type';
$lang['add_new']['tab1']['form']['campaign_type_help']   = '<p><strong>Regular:</strong> Schedule it to broadcast or multiple broadcasts (in rotation)
<ul>
<li>Audience: Select the audience type i.e Contact&nbsp;Lists or Segment&nbsp;(radio option)</li>
</ul>
<strong>Split Test:</strong> Schedule a split test for the criteria that you have already created</p>';
$lang['add_new']['tab1']['form']['schedule_label_title'] = 'Select previously used criteria';
$lang['add_new']['tab1']['form']['segment_list']         = 'Segment List';
$lang['add_new']['tab1']['form']['split_test_list']      = 'Split Test List';
$lang['add_new']['tab1']['form']['campaign_list']        = 'Campaign List';
$lang['add_new']['tab1']['form']['no_list_select']        = 'Select the list';
$lang['add_new']['tab1']['form']['split_test_not_found']           = 'No split test created';
$lang['add_new']['tab1']['form']['select_split_test']           = 'Select the split test';
//added by azeem dated 13-10-2022 for edit cutom criteria
$lang['add_new']['tab1']['form']['any_country']           = 'Any Country';
$lang['add_new']['tab1']['form']['selected_country']           = 'Selected Country';
$lang['add_new']['tab1']['form']['select_country']           = 'Select Country';

// Type Tab
$lang['add_new']['tab2']['heading']                      = 'Type';
$lang['add_new']['tab2']['desc']                         = 'Setup Type';
$lang['add_new']['tab2']['campaign_not_found']           = 'Campaign not found';



// Sender Tab
$lang['add_new']['tab3']['heading']                      	  = 'Sender';
$lang['add_new']['tab3']['desc']                         	  = 'Sender Detail';
$lang['add_new']['tab3']['form']['sender_list']          	  = 'Sending Nodes';
$lang['add_new']['tab3']['form']['sender_list_help']     	  = 'Select the sending node(s) you want to relay emails from';
$lang['add_new']['tab3']['form']['smtp_sequence']        	  = 'SMTP Sequence';
$lang['add_new']['tab3']['form']['smtp_sequence_help']   	  = '<p><strong>Batches:</strong> '.$siteTitle.' feeds messages to the sending node in batches and rotates sending node after batch completion<br><span><strong>Note:</strong> You can set the batch size in Application Settings</span><br><br><strong>Loop:</strong> '.$siteTitle.' feeds messages to the sending node one by one and for multi-selected sending nodes, it rotates after every email.</p>';
$lang['add_new']['tab3']['form']['batches']              	  = 'Batches (Sends Fast)';
$lang['add_new']['tab3']['form']['loop']                 	  = 'Loop';
$lang['add_new']['tab3']['form']['smtp_selection']       	  = 'Sending Node Selection';
$lang['add_new']['tab3']['form']['smtp_selection_help']       = '<td><strong>Sequential:</strong> '.$siteTitle.' picks up the sending node for the next batch in sequence order (by node ID, in case of multiple selections)<br><br><strong>Random:</strong> '.$siteTitle.' selects the sending node for the next batch randomly (from the selected sending nodes)</td>';
$lang['add_new']['tab3']['form']['sequential']                = 'Sequential';
$lang['add_new']['tab3']['form']['random']                    = 'Random';
$lang['add_new']['tab3']['form']['sending_domain_option']     = 'Sending Domain Option';
$lang['add_new']['tab3']['form']['no_sending_no_select']     = 'Select the sending node';
$lang['add_new']['tab3']['form']['no_campaign_select']     = 'Select the campaign';
$lang['add_new']['tab3']['form']['no_segemnt_select']     = 'Select the segment';
$lang['add_new']['tab3']['form']['smtp_not_found']     = 'Node not found';

// Settings Tab
$lang['add_new']['tab4']['heading']                                        = 'Settings';
$lang['add_new']['tab4']['thread_warning_msg']                             = '<strong>Warning:</strong> Using number of threads more than your server can handle may result in the server crash and slow operations. Your current running threads are';
$lang['add_new']['tab4']['desc']                                           = 'Final Settings';
$lang['add_new']['tab4']['form']['send_campaign']                          = 'When to send';
$lang['add_new']['tab4']['form']['send_campaign_help']                     = '<td><strong>Send Now:</strong>&nbsp;This option schedules the broadcast for instant delivery<br><br><strong>Send Later:</strong>&nbsp;This option lets you select a date and time when to start the campaign<br></td>';
$lang['add_new']['tab4']['form']['send_now']                               = 'Send Now';
$lang['add_new']['tab4']['form']['send_later']                             = 'Send Later';
$lang['add_new']['tab4']['form']['threads']                                = 'Threads';
$lang['add_new']['tab4']['form']['threads_help']                           = 'Number of parallel processes to run';
$lang['add_new']['tab4']['form']['sending_time']                           = 'Sending Time';
$lang['add_new']['tab4']['form']['hourly_speed_limit']      			   = 'Hourly Speed';
$lang['add_new']['tab4']['form']['hourly_speed_limit_help'] 			   = 'Set the hourly speed of email sending. It will throttle the feeding process to MTA and spread over 60 minutes';
$lang['add_new']['tab4']['form']['skip_duplicate']          			   = 'Skip Duplicates';
$lang['add_new']['tab4']['form']['skip_unconfirmed']          			   = 'Skip Un-confirmed';
$lang['add_new']['tab4']['form']['skip_duplicate_help']     			   = 'It checks for duplicate emails before starting the campaign and skips the duplicate contacts found. Enabling this switch may slow down your campaign preparation.';
$lang['add_new']['tab4']['form']['skip_unconfirmed_desc']     			   = 'It will skip all contacts with the unconfirmed status from receiving the broadcast.';
$lang['add_new']['tab4']['form']['list_unsubscribe_header'] 			   = 'Add List-Unsubscribe Header';
$lang['add_new']['tab4']['form']['choose_from_name_as_listed_in_list']     = 'Overwrite From Name';
$lang['add_new']['tab4']['form']['choose_from_name_as_listed_in_smtp']     = 'Overwrite From Name';
$lang['add_new']['tab4']['form']['list_unsubscribe_header'] 			   = 'Add List-Unsubscribe Header';
$lang['add_new']['tab4']['form']['select_domain']           			   = 'Select Domain';
$lang['add_new']['tab4']['form']['sender_information']      			   = 'Sender Information';

/************* ** Messages ** *************/
$lang['message']['campaign_scheduled_successfully'] = 'Campaign scheduled successfully';

/************* ** General ** *************/
$lang['evergreen_campaign_title'] 	 = 'Schedule an Evergreen Campaign';
$lang['evergreen_select_option'] 	 = 'Recurring Frequency';
$lang['evergreen_select_option_help'] 	 = 'Select the frequency that this campaign should recur automatically.';
$lang['evergreen_campaign_description'] 	 = 'The wizard below will help you schedule an Evergreen Campaign with the selected parameters on a defined frequency.';
$lang['activity_title'] 	 = 'Campaign';
$lang['rescheduled']    	 = 'Rescheduled';
$lang['schedule']    	 = 'Schedule';
$lang['schedule_a_campaign'] = 'Schedule a Campaign';
$lang['search']['lists'] = 'Search Lists';
$lang['search']['camps'] = 'Search Broadcasts';
$lang['search']['nodes'] = 'Search Nodes';
$lang['search']['segments'] = 'Search Segments';
$lang['not_found']['segments'] = 'Segment not found';
$lang['custom']['is_custom_criteria'] = 'Custom Criteria';
$lang['custom']['is_custom_criteria_help'] = 'Contacts Filter Criteria';


return $lang;