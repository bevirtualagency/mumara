<?php
include("variables.php");
/**
 * Created by Mumara Team
 * Date: 06/26/2020
 */
/*-------------- 1. Actions -> Triggers ----------------*/

$lang['page']['title']       = 'Triggers';
$lang['page']['description'] = 'Perform automated actions upon the occurrence of any event or engagement e.g send an email to a person who has just opened a previous email from your side or suppress a contact who has recently marked you as spam.';

/************* ** Triggers Datatable ** *************/
$lang['table_headings']['name']        = 'Name';
$lang['table_headings']['status'] 	   = 'Status';
$lang['table_headings']['added_on']    = 'Added on';
$lang['table_headings']['actions']     = 'Actions';
$lang['table_headings']['trigger_action']     = 'Actions Performed';

/*-------------- 1.1 Actions -> Triggers -> add new ----------------*/
$lang['add_new']['page']['title']       = 'Add New Trigger';
$lang['edit']['page']['title'] = 'Edit Trigger of';
$lang['add_new']['page']['description'] = 'Trigger allows setting an email campaign to be sent out automatically to the contacts, based on momentous events, such as their birthdays or anniversaries etc.';
// Setup Tab
$lang['add_new']['tab1']['heading']          = 'Setup';
$lang['add_new']['tab1']['desc']             = 'Create Setup';

$lang['add_new']['tab1']['form']['status'] = 'Status';
$lang['add_new']['tab1']['form']['status_help'] = 'Active/Inactive. Inactive triggers will not be executed';
$lang['add_new']['tab1']['form']['name'] = 'Name';
$lang['add_new']['tab1']['form']['name_help'] = 'Name of the trigger';

$lang['add_new']['tab1']['form']['event_criteria'] = 'Event Criteria';
$lang['add_new']['tab1']['form']['event_criteria_help'] = '';
$lang['add_new']['tab1']['form']['select_criteria'] = 'Select Criteria';
$lang['add_new']['tab1']['form']['event_criteria_option1'] = 'Contact is added to a List';
$lang['add_new']['tab1']['form']['event_criteria_option2'] = 'Contact is added to a Segment';
$lang['add_new']['tab1']['form']['segment_list'] = 'Segment List';
$lang['add_new']['tab1']['form']['split_test_list'] = 'Split Test List';
$lang['add_new']['tab1']['form']['campaign_list'] = 'Campaign List';
$lang['add_new']['tab1']['form']['select_date'] = 'Select Date';
$lang['add_new']['tab1']['form']['segment_ist'] = 'Segment List';

$lang['add_new']['tab1']['form']['list_type'] = 'List Type';
$lang['add_new']['tab1']['form']['list_type_help'] = 'It appears if the event criteria is based on "contact list submission"';
$lang['add_new']['tab1']['form']['list_type_global'] = 'Any List';
$lang['add_new']['tab1']['form']['list_type_global_help'] = 'Event happens when the contact is added to any of the contact lists';
$lang['add_new']['tab1']['form']['list_type_selected'] = 'Selected Lists';
$lang['add_new']['tab1']['form']['list_type_selected_help'] = 'Event happens when the contact is added to one of the selected contact lists';

$lang['add_new']['tab1']['form']['select_lists_help'] = "Based on the above selection, you'll be asked here to select the contact list(s) or segment(s).";


// Action Tab
$lang['add_new']['tab2']['heading']          = 'Action';
$lang['add_new']['tab2']['desc']             = 'Trigger Action';

$lang['add_new']['tab2']['form']['custom_field'] = 'Custom Field';
$lang['add_new']['tab2']['form']['suppression'] = 'Suppression';
$lang['add_new']['tab2']['form']['suppression_global'] = 'Global suppression list';
$lang['add_new']['tab2']['form']['suppression_associated'] = 'List associated suppression list';
$lang['add_new']['tab2']['form']['select_email_campaign'] = 'Broadcast';
$lang['add_new']['tab2']['form']['select_email_campaign_help'] = 'Select the broadcast from the dropdown that you want the recipient to receive';
$lang['add_new']['tab2']['form']['smpt_list'] = 'Sending Node';
$lang['add_new']['tab2']['form']['smpt_list_help'] = 'Select the sending node that will be responsible to relay the email';
$lang['add_new']['tab2']['form']['select_date_field'] = 'Select Date Field';

$lang['add_new']['tab2']['form']['segment_type'] = 'Segment Type';
$lang['add_new']['tab2']['form']['segment_type_global'] = 'Global All Segemts';
$lang['add_new']['tab2']['form']['segment_type_selected'] = 'Selected Segemts';

$lang['add_new']['tab2']['form']['campaign_type'] = 'Campaign Type';
$lang['add_new']['tab2']['form']['campaign_type_global'] = 'Global All Campaigns';
$lang['add_new']['tab2']['form']['campaign_type_selected'] = 'Selected Campaigns';

$lang['add_new']['tab2']['form']['link_clicked'] = 'Link Clicked';
$lang['add_new']['tab2']['form']['when_to_execute'] = 'When to Execute';
$lang['add_new']['tab2']['form']['when_to_execute_help'] = '<p><strong>Instantly:</strong> It performs the action as soon as the event occurs<br><strong>After the Event:</strong> It performs the action after the define delay/interval></p>';
$lang['add_new']['tab2']['form']['after_the_event'] = 'After the Event';
$lang['add_new']['tab2']['form']['instantly'] = 'Instantly';
$lang['add_new']['tab2']['form']['frequency'] = 'Frequency';
$lang['add_new']['tab2']['form']['to_email'] = 'To email';
$lang['add_new']['tab2']['form']['subject'] = 'Subject';
//Action to Perform
$lang['add_new']['action_to_perform']['title'] = 'Action to Perform';
$lang['add_new']['action_to_perform']['send_broadcast'] = 'Send a broadcast';
$lang['add_new']['action_to_perform']['send_notification_email'] = 'Send a notification email to admin';
$lang['add_new']['action_to_perform']['start_drip_group'] = 'Start a drip group';
$lang['add_new']['action_to_perform']['stop_drip_group'] = 'Stop a drip group';
$lang['add_new']['action_to_perform']['change_subscriber_status'] = "Change contact's status";
$lang['add_new']['action_to_perform']['change_subscriber_format'] = "Change contact's format";
$lang['add_new']['action_to_perform']['change_subscriber_validation_status'] = 'Change subscriber`s validation status';
$lang['add_new']['action_to_perform']['update_field_value'] = 'Update a custom field value';
$lang['add_new']['action_to_perform']['move_subscriber'] = 'Move contact to another list';
$lang['add_new']['action_to_perform']['copy_subscriber'] = 'Copy contact to another list';
$lang['add_new']['action_to_perform']['remove_subscriber'] = 'Remove contact';
$lang['add_new']['action_to_perform']['add_to_suppresion'] = 'Add contact to suppression list';

// Frequency
$lang['add_new']['frequency']['title'] = 'Frequency';
$lang['add_new']['frequency']['values']['run_once'] = 'Run Once';
$lang['add_new']['frequency']['values']['repeat_every_month'] = 'Repeat Every Month';
$lang['add_new']['frequency']['values']['repeat_every_year'] = 'Repeat Every Year';

/************* ** Messages ** *************/
$lang['message']['save_order'] = 'Trigger Sorting has been successfully update';
$lang['message']['alert_success'] = 'Trigger status changed successfully..!';
$lang['message']['alert_failed'] = 'Trigger status changed attempt failed..!';
$lang['message']['empty_field_true'] = 'Empty field true';

/************* ** General ** *************/
$lang['activity_title'] = 'Trigger';
$lang['if_duplicates_found'] = 'If Duplicates Found';
$lang['skip_duplicate_keep_original']   = 'Skip duplicate and keep in original list';
$lang['skip_duplicate_remove_original'] = 'Skip duplicate and remove from original list';
$lang['overwrite_duplicate'] = 'Overwrite duplicate (will remove from original list)';
$lang['skip_duplicate'] = 'Skip duplicate';
$lang['overwrite_duplicate'] = 'Overwrite duplicate';
$lang['update_duplicate'] = 'Update duplicate';
$lang['select_autoresponder'] = 'Select a Drip Campaign';

$lang['subscriber_manually_added'] = 'Subscriber is manually added to a list';
$lang['subscriber_imported'] = 'Subscriber is imported to a list';
$lang['subscriber_added_via_webform'] = 'Subscriber is added via web form';
$lang['subscriber_added_via_api'] = 'Subscriber is added via API';
$lang['apply_all'] = 'Apply all';

$lang['subscriber_creation_date'] = "Subscriber's creation date";
$lang['subscriber_birthday'] = "Subscriber's Birthday";
$lang['on_calendar_date'] = "On specific calendar date";
$lang['campaign_opened'] = "A campaign has been opened";
$lang['link_clicked'] = "A link has been clicked";
$lang['bounced'] = "Bounced";
$lang['bounced_code'] = "Bounced Code";
$lang['custom_criteria'] = "Custom Criteria";
$lang['title'] = 'Triggers';
$lang['triggerPauseTitle'] = 'Trigger contains a blocked contact list';
$lang['triggerPauseDescription'] = 'This trigger contains a blocked contact list, so it can\'t be activated. You can edit this trigger and re-save it to make it functional.';
$lang['monthlyActionLimit'] = 'The monthly actions limit has been reached.';
$lang['trigger_limit_notification'] = "The trigger <b>:trigger_name</b> has been set inactive as your monthly limit for trigger actions has been reached.";
$lang['trigger_list_blocked_notification'] = "The trigger <b>:trigger_name</b> has been set inactive as it contains a blocked contact list.";
$lang['trigger_actions_limit'] = "The limit for the trigger actions has been exceeded. The effected triggers will be auto-activated upon limit reset.";
$lang['trigger_actions_usage'] = "You have utilized :precentage% of your assigned trigger actions limit (used: :usedLimit, limit: :totalLimit).";

$lang['trigger_controller']['contact_administrator_action'] = 'Contact administrator!';
$lang['trigger_controller']['session_limit_reached'] = 'Opsss... The limit has been reached.';
$lang['trigger_controller']['trigger_campaign_create_error'] = 'Trigger Campaign Create Error';
$lang['trigger_controller']['trigger_drip_create_error'] = 'Trigger Drip Create Error';
$lang['trigger_controller']['trigger_qualified_txt_small'] = 'By selecting this option, the trigger will not just find the newly qualified contacts but it will run recursively on all contacts of the selected lists';
$lang['trigger_controller']['contacts_recursively_label'] = 'Apply to all contacts recursively';
$lang['trigger_controller']['triggers_sorting_array'] = 'Triggers Sorting';
$lang['trigger_controller']['triggers_sorting_description'] = 'Triggers Sorting Description';
$lang['trigger_controller']['triggers_soring_title'] = 'Triggers Soring';
$lang['trigger_controller']['unsubscribed_successfully_echo'] = 'You have been unsubscribed successfully.';
$lang['trigger_controller']['label_select_date'] = 'Select Date';
$lang['trigger_controller']['select_choose_option'] = 'Choose an Option';
$lang['trigger_controller']['options_label'] = 'Options:';
$lang['trigger_controller'][''] = '';
$lang['trigger_controller'][''] = '';

$lang['create_blade']['changed_any_value_span'] = 'Changed to any value';
$lang['create_blade']['changed_this_value_span'] = 'Changed to this value';
$lang['create_blade']['select_field_option'] = 'Select a Field';
$lang['create_blade']['selected_field_span'] = 'Selected field';
$lang['create_blade']['any_field_span'] = 'Any field';
$lang['create_blade']['select_field_value_change'] = 'When a field value is changed';

$lang['sorting_blade']['triggers_blocked_contact_list_command'] = 'This trigger contains a blocked contact list and can\'t be activated';
$lang['sorting_blade']['bold_note'] = 'Note';
$lang['sorting_blade']['triggers_set_run_ever'] = 'The triggers are set to run every';
$lang['sorting_blade']['minutes_txt'] = 'minutes.';
$lang['sorting_blade']['change_this_cron_setting'] = 'You can change this in the Cron Settings.';
$lang['sorting_blade'][''] = '.';
$lang['sorting_blade'][''] = '.';
return $lang;