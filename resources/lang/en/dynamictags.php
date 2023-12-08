<?php
include("variables.php");
/**
 * Created by Mumara Team
 * Date: 06/25/2020
 */
/*-------------- 1. Campaigns -> Dynamic Content Tags ----------------*/

$lang['page']['title']       = 'Dynamic Content Tags';
$lang['page']['description'] = 'Dynamic Content Tag offers a tool to make your email marketing more intelligent. It helps you practically implement data-driven email marketing for improving email engagements. Use of the contact details from the data fields can’t be better and more initiative than this. You draw rules for the contacts with similar details and layout a separate content that can match their preferences and behavior, and CampaignsPlus takes care of the rest.';

/************* ** View Scheduled Datatable ** *************/
$lang['table_headings']['dynamic_tag']       = 'Dynamic Tag';
$lang['table_headings']['preferred_content'] = 'If Criteria Met';
$lang['table_headings']['content']           = 'Else';
$lang['table_headings']['added_on']          = $created_on;
$lang['table_headings']['actions']           = 'Actions';

/*-------------- 1.1 Campaigns -> Dynamic Content Tags -> add new ----------------*/
$lang['add_new']['page']['title']                   = 'Add a Dynamic Content Tag';
$lang['edit']['page']['title']                      = 'Edit Dynamic Content Tag of ';
$lang['add_new']['page']['description']             = 'Increase the relevancy of your email content by sending personalized content using dynamic content tags.';
$lang['add_new']['page']['description_old']             = 'Increase the relevancy of your email content by sending personalized content using dynamic content tags. Use the following fields to create a new dynamic content tag.';

$lang['add_new']['form']['heading']                 = 'Tag Details';
$lang['add_new']['form']['heading_old']                 = 'Dynamic Content tag Details';
$lang['add_new']['form']['select_an_option']        = 'Select an Option';
$lang['add_new']['form']['name']                    = 'Tag';
$lang['add_new']['form']['name_old']                    = 'Name';
$lang['add_new']['form']['name_help']            	= 'Write a friendly tag name that will be used as a placeholder within the broadcast content.';
$lang['add_new']['form']['name_help_bottom']            	= 'Only alphanumeric lowercase characters are supported.';
$lang['add_new']['form']['name_help_old']            	= 'Name of the dynamic content tag';
$lang['add_new']['form']['unit_rules']           	= 'and';
$lang['add_new']['form']['unit_rules_help']      	= 'Conditions of the criteria to meet';
$lang['add_new']['form']['custom_field']         	= 'Custom Field';
$lang['add_new']['form']['date_field']           	= 'Date Field';
$lang['add_new']['form']['contacts_list']        	= 'Contact List';
$lang['add_new']['form']['email_campaign']       	= 'Broadcast';
$lang['add_new']['form']['if_criteria_met']      	= 'Content Units';
$lang['add_new']['form']['if_criteria_met_old']      	= 'If Criteria Met';
$lang['add_new']['form']['if_criteria_met_help'] 	= 'The content unit is a defined set of content when a specific criteria is met.';
$lang['add_new']['form']['if_criteria_met_help_old'] 	= 'Content to embed if criteria is met';
$lang['add_new']['form']['else']                    = 'Else';
$lang['add_new']['form']['else_help']               = 'Content to embed if criteria isn`t met';

/************* ** messages ** *************/
$lang['message']['exists']              = 'Dynamic tag already exists'; // dyn_tags.exists
$lang['message']['dynamic_tag_created'] = 'Dynamic tag created';
$lang['message']['dynamic_tag_updated'] = 'Dynamic tag updated';
/************* ** General ** *************/
$lang['activity_title'] = 'Dynamic Content Tag';

$lang['delete']['popup_sure'] = 'Are you sure?';
$lang['delete']['popup_not_revert'] = "You won't be able to revert this";
$lang['delete']['popup_button_delete'] = 'Yes, delete it!';
$lang['delete']['popup_button_cancel'] = 'Cancel';
$lang['delete']['popup_deleted'] = 'Deleted!';
$lang['delete']['popup_tag_deleted'] = 'Your tag has been deleted.';
$lang['delete']['popup_button_close'] = 'Close';
$lang['add_new']['form']['heading'] = 'New Unit';
$lang['add_new']['form']['add_title'] = 'Add Rule';
$lang['add_new']['form']['edit_title'] = 'Edit Rule';
$lang['add_new']['form']['heading_edit'] = 'Edit Unit';
$lang['add_new']['form']['title'] = 'Title';
$lang['add_new']['form']['if_qualify'] = 'If the rule qualifies';
$lang['add_new']['form']['if_not_qualify'] = "If the rule doesn't qualify";
$lang['add_new']['form']['html_body'] = 'HTML Body:';
$lang['add_new']['form']['text_body'] = 'Text Body:';
$lang['add_new']['form']['cancel'] = 'Cancel';
$lang['add_new']['form']['add_rule'] = 'Add Rule';
$lang['opt']['recipient'] = 'Recipient Details';
$lang['opt']['email'] = 'Email Address';
$lang['opt']['profile'] = 'Profile Field';
$lang['opt']['member_of'] = 'Is Member of';
$lang['opt']['lists'] = 'Contact Lists';
$lang['opt']['groups'] = 'Groups';
$lang['opt']['confirmation'] = 'Confirmation Status';
$lang['opt']['created_at'] = 'Creation Date';
$lang['opt_grp']['timeDate'] = 'Time and Date';
$lang['opt']['now'] = 'Time Right Now';
$lang['opt']['today'] = 'Date Today';
$lang['opt']['day_of_month'] = 'Date Of Month';
$lang['opt']['week'] = 'Day Of Week';
$lang['opt']['month'] = 'This Month';
$lang['opt_grp']['broadcast'] = 'Broadcast Details';
$lang['opt_grp']['sch_details'] = 'Schedule Details';
$lang['opt']['broadcast'] = 'Broadcast Name';
$lang['opt']['broadcast_creation'] = 'Broadcast Creation Date';
$lang['opt']['broadcast_group'] = 'Broadcast Group';
$lang['opt']['broadcast_subject'] = 'Broadcast Subject';
$lang['opt']['attachment'] = 'Attachments';
$lang['opt']['schedule'] = 'Schedule Label';
$lang['opt']['camp_type'] = 'Campaign Type';
$lang['opt']['aud_type'] = 'Audience Type';
$lang['opt']['segment'] = 'Segment';
$lang['opt']['camp'] = 'Broadcast';
$lang['opt']['split_list'] = 'Split Test';
$lang['opt']['list'] = 'List';
$lang['opt']['list_name'] = 'List Name';
$lang['filter']['has'] = 'Has an attachment';
$lang['filter']['has_not'] = 'Has Not';
$lang['opt']['occurred_after'] = 'Occurring after';
$lang['btn']['add'] = 'Add Unit';
$lang['btn']['edit'] = 'Update Unit';
$lang['is_not'] = 'Isn\'t';
$lang['equal'] = 'Equal to';
$lang['not_equal'] = 'Not Equal to';
$lang['does_not_contain'] = "Doesn't contain";
$lang['greater_than'] = "Greater than";
$lang['lesser_than'] = "Lesser than";
$lang['lesser_and_equal'] = "Lesser than or equal to";
$lang['greater_and_equal'] = "Greater than or equal to";
$lang['first_char'] = "First character is";
$lang['return_content']['all'] = "Return cumulative content of all qualified units";
$lang['return_content']['single'] = "Return the content when the first unit qualifies";
$lang['content_type']['text'] = "Text editor";
$lang['content_type']['html'] = "HTML editor";
$lang['content_type']['select'] = "Select the editor";

$lang['add_blade']['add_unit_action'] = 'Add unit';
$lang['add_blade']['tag_alphanumeric_command'] = 'Tag must be alphanumeric';
$lang['add_blade']['keydown_keyup_return'] = 'input keydown keyup mousedown mouseup select contextmenu drop';
$lang['add_blade']['body_required_command'] = 'Text Body is required';
$lang['add_blade']['unit_required_command'] = 'Unit title is required';
$lang['controller']['unit_rule_required_return'] = 'Unit rule required';
$lang['controller']['date_required_return'] = 'Date is required.';
$lang['controller']['error_occurred_return'] = 'an error occurred';
$lang['controller']['add_one_rule_return'] = 'Add at least one rule.';
$lang['create_blade']['error_occurred_return'] = 'opp`s! Please Complete the form .';
$lang['controller']['is_option_txt'] = 'is';
$lang['controller']['isnt_option_txt'] = 'isn\'t';
$lang['controller']['contains_option_txt'] = 'contains';
$lang['controller']['doesnt_contains_option_txt'] = 'doesn\'t contain';

return $lang;