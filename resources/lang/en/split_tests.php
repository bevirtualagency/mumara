<?php
include("variables.php");
/**
 * Created by Mumara Team
 * Date: 06/25/2020
 */
/*-------------- 1. Campaigns -> Split Tests ----------------*/

$lang['page']['title']                 = 'Split Test';
$lang['page']['description']           = 'The ability to create different variants of your campaign and then testing these variants in laboratory settings will help you generate significantly improved results.';

/************* ** View Scheduled Datatable ** *************/
$lang['table_headings']['id']          = 'ID';
$lang['table_headings']['sr']          = 'Sr.';
$lang['table_headings']['name']        = 'Name';
$lang['table_headings']['based_on']    = 'Based on';
$lang['table_headings']['type'] 	   = 'Type';
$lang['table_headings']['added_on']    = 'Added on';
$lang['table_headings']['actions']     = 'Actions';

/*-------------- 1.1 Campaigns -> Split Test -> add new ----------------*/
$lang['add_new']['page']['title']       = 'Add New Split Test';
$lang['edit']['page']['title']          = 'Edit Split Test of';
$lang['add_new']['page']['description'] = 'You can test different variation to evaluate the best subject line, days in the week, and time in the day, to send email campaign for the best open and click rates.';

$lang['add_new']['form']['heading']                                  = 'Split Test Details';
$lang['add_new']['form']['split_test_name']                          = 'Split Test Name';
$lang['add_new']['form']['split_test_name_help']                     = 'Name of the split test being created';
$lang['add_new']['form']['based_on_campaign_performance'] 			 = 'Based on Campaign Performance';
$lang['add_new']['form']['based_on_campaign_performance_help']       = 'Choose the best variant of the broadcast';
$lang['add_new']['form']['based_on_list_performance']                = 'Based on List Performance';
$lang['add_new']['form']['based_on_list_performance_help']           = 'Choose the best performing contact list';
$lang['add_new']['form']['based_on_help']                            = 'Select minimum two of the broadcasts or contact lists (as per the selection above)';
$lang['add_new']['form']['winning_criteria']                         = 'Winning Criteria';
$lang['add_new']['form']['winning_criteria_help']                    = '<p><b>Open Rate:</b> Choose the winning element based on maximum open rate<br>
<b>Click-through Rate:</b>&nbsp;Choose the winning element based on maximum click-through rate<br>
<b>Click-through Rate for a specific hyperlink:</b>&nbsp;Choose the winning element based on maximum click-through rate for a specific hyperlink.</p>';
$lang['add_new']['form']['open_rate']                                = 'Open Rate';
$lang['add_new']['form']['decision_percentage']                      = 'Decision Percentage';
$lang['add_new']['form']['decision_percentage_help']                 = 'Emails will be sent in equal groups to this % of elements selected';
$lang['add_new']['form']['send_remaining_after']                     = 'Send Remaining After';
$lang['add_new']['form']['send_remaining_after_help'] 				 = 'Time duration to wait for the results before finding the winning element';
$lang['add_new']['form']['action_to_perform']                        = 'Action to Perform';
$lang['add_new']['form']['action_to_perform_help']                   = '<ul><li>Find winning element and update the results</li><li>Find winning element and send leftover to it</li></ul>';
$lang['add_new']['form']['action_to_perform_opt1']                   = 'Find winning element and update the results';
$lang['add_new']['form']['action_to_perform_opt2']                   = 'Find winning element and send leftover to it';
$lang['add_new']['form']['click_through_rate']                       = 'Unique click-through rate';
$lang['add_new']['form']['click_through_rate_specific_link']         = 'Unique click-through rate on specific link';


/************* ** Messages ** *************/
$lang['message']['decision_percentage_note']  = 'Emails will be sent in equal groups to above % of your list(s)';
$lang['message']['send_remaining_after_note'] = 'The best performing email will then be sent to the rest of your list(s) after schedule duration above Submit';
/************* ** General ** *************/
$lang['activity_title'] 	 = 'Split Test';
$lang['rescheduled'] 		 = 'Rescheduled';
$lang['schedule_a_campaign'] = 'Schedule a Campaign';

$lang['controller']['campaigns_split_test'] = 'campaigns';
$lang['controller']['show_split_test'] = 'show';


return $lang;