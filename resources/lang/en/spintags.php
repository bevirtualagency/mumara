<?php
include("variables.php");
/**
 * Created by Mumara Team
 * Date: 06/25/2020
 */
/*-------------- 1. Campaigns -> Spintags ----------------*/

$lang['page']['title']                 = 'Spintags';
$lang['page']['description']           = 'Spintags helps you adding variations in your campaign to keep it somewhat different for every contact in the list.';

/************* ** View Scheduled Datatable ** *************/
$lang['table_headings']['tag']         = 'Tag';
$lang['table_headings']['added_on']    = $created_on;
$lang['table_headings']['actions']     = 'Actions';

/*-------------- 1.1 Campaigns -> Spintags -> add new ----------------*/
$lang['add_new']['page']['title']       = 'Add a Spintag';
$lang['edit']['page']['title']          = 'Edit Spintag';
$lang['add_new']['page']['description'] = 'It helps to be more specific by collecting additional and more personalized information using spintags. Enter the name of the spintag and a List of word values.';

$lang['add_new']['form']['heading']              = 'SpinTag Field Detail';
$lang['add_new']['form']['name']                 = 'Name / Placeholder';
$lang['add_new']['form']['name_help']            = 'This name will act as a variable in the broadcast content';
$lang['add_new']['form']['list_of_words']        = 'List of Words';
$lang['add_new']['form']['list_of_words_help']   = 'Line separated list of words or phrases that will be randomly selected while sending emails';

/************* ** General ** *************/
$lang['activity_title'] = 'Spintag';

$lang['controller']['arry_txt_field'] = 'Text Field';
$lang['controller']['multiline_txt_field'] = 'Multiline Text Field';
$lang['controller']['checkbox_arry_txt_field'] = 'Checkboxes';
$lang['controller']['drop_down_arry_txt_field'] = 'Drop Down';
$lang['controller']['radio_button_arry_txt_field'] = 'Radio Buttons';
$lang['controller']['date_arry_txt_field'] = 'Date Field';
return $lang;