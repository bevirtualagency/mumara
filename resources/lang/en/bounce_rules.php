<?php
include("variables.php");
/**
 * Created by Mumara Team
 * Date: 07/02/2020
 */
/*-------------- 1. Setup -> Bounce Rules ----------------*/

$lang['page']['title']             = 'Bounce Rules';
$lang['page']['description']       = 'Bounce is classified into two categories mainly, Soft as momentary delivery error and Hard bounced as permanent delivery issues. Since ISPs tend to return the bounce report in a somewhat unique way, different than the others in expressing the bounce codes. '.$siteTitle.' Campaigns enables you to put forward your own rules to classify the bounces as hard and soft according to the codes and error it returned with. The accurate categorization helps remediate bounces.';

$lang['page']['button']['reset']   = 'Reset to default';
/************* ** View Scheduled Datatable ** *************/
$lang['table_headings']['label']   = 'Label';
$lang['table_headings']['reason']  = 'Reason';
$lang['table_headings']['details'] = 'Details';
$lang['table_headings']['code']    = 'Code';
$lang['table_headings']['type']    = 'Type';
$lang['table_headings']['status']  = 'Status';
$lang['table_headings']['actions'] = 'Actions';

/*-------------- 1.1 Setup -> Bounce Rules -> add new ----------------*/
$lang['add_new']['page']['title']       = 'Add a Bounce Rule';
$lang['edit']['page']['title']          = 'Edit Bounce Rules';
$lang['add_new']['page']['description'] = 'Add a Bounce Rule to define your criteria for a soft bounce or hard bounce.';

$lang['add_new']['form']['heading']                = 'Bounce Rule Criteria';
$lang['add_new']['form']['bounce_details']         = 'Bounce Details';
$lang['add_new']['form']['status']                 = 'Status';
$lang['add_new']['form']['label']                  = 'Name';
$lang['add_new']['form']['criteria']               = 'Criteria';
$lang['add_new']['form']['conditions']             = 'Conditions';
$lang['add_new']['form']['bounce_code']            = 'Bounce Code';
$lang['add_new']['form']['bounce_reason']          = 'Bounce Reason';
$lang['add_new']['form']['bounce_details']         = 'Bounce Details';
$lang['add_new']['form']['add_condition']          = 'Add Condition';
$lang['add_new']['form']['actions']                = 'Actions';
$lang['add_new']['form']['process_as']             = 'Bounce Type';
$lang['add_new']['form']['set_bounce_type']        = 'Set Bounce Type';
$lang['add_new']['form']['soft_bounce']            = 'Soft';
$lang['add_new']['form']['hard_bounce']            = 'Hard';
$lang['add_new']['form']['dont_process']           = 'Don`t Process';

/************* ** General ** *************/
$lang['activity_title']         = 'Bounce Reason';
$lang['any']                    = 'Any';
$lang['and']                    = 'and';
$lang['select_condition']       = 'Select Condition';
$lang['select_bounce_criteria'] = 'SSelect Bounce Criteria';
$lang['no_process']             = 'Don`t Process';

/************* ** Message ** *************/

$lang['message']['sync_rule_alert']            = 'Are you sure you want to replace the current bounce rules with the latest bounce rules from '.$siteTitle.' server?';
$lang['message']['sync_rule_success']          = 'Successfully Synchronized';
$lang['message']['delete']                     = 'First row cannot be delete';
$lang['message']['one_criteria_required']      = 'Error: At least one criteria is required.';
$lang['message']['created']                    = 'Bounce rule has been successfully added.';
$lang['message']['updated']                    = 'Bounce rule has been successfully updated.';
$lang['message']['sorting']['saved']           = 'Bounce sorting has been successfully updated.';
$lang['message']['exits']                      = 'Bounce rule already exists.';
$lang['module']['message']                      = "We have updated the Bounce Rules and it's suggested that you synchronize it now.";
$lang['module']['switch']                       = "Synchronize Bounce Rules";

$lang['controller']['bounce_reason_add_error']                       = "Bounce Reason Add";
$lang['controller']['bounce_reason_edit_error']                       = "Bounce Reason Edit";
$lang['controller']['bounce_reason_txt_error']                       = "Bounce Reason";
$lang['bounce_blade']['notice_txt_bold']                       = "Notice!";

return $lang;