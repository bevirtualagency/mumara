<?php
include("variables.php");
/**
 * Created by Mumara Team
 * Date: 06/16/2020
 */

/*-------------- 1. Add New Custom Fields ----------------*/

/************* ** Page Top Bar ** *************/
$lang['add_new']['page']['title']                         = 'Adding a custom field';
$lang['add_new']['field']['edit_title']                   = 'Edit Custom Field';
$lang['add_new']['page']['description']                   = 'It helps to be more specific by collecting additional and more personalized information using custom fields. Enter the name of the custom field and choose the type of the new field you want to create from the following options.';

/************* ** Form ** *************/

$lang['add_new']['form']['title']                         = 'Custom Field Details';
$lang['add_new']['field']['name']                         = 'Name';
$lang['add_new']['field']['name_help']                    = 'Name of the contact field';
$lang['add_new']['field']['field_order']                  = 'Field Order';
$lang['add_new']['field']['field_order_help']             = 'The sorting position/order of the field on add a contact page';
$lang['add_new']['field']['field_type']      			  = 'Type';
$lang['add_new']['field']['field_type_help'] 			  = 'Type of the field i.e Text Field, Multiline Text Field, Checkboxes, Dropdown, Radio Options, Date Field, JSON field';
$lang['add_new']['field']['required']        			  = 'Required';
$lang['add_new']['field']['required_help']   			  = 'If selected to Yes, it becomes a mandatory field for adding a contact to the associated list';
$lang['add_new']['field']['list_of_values']  			  = 'List of Values';
$lang['add_new']['field']['list_of_values_help']          = 'It appears when field type checkboxes or dropdown or radio options have been chosen';
$lang['add_new']['field']['contact_list']                 = 'Assign to Contact Lists';
$lang['add_new']['field']['contact_list_help']            = 'The lists you select here, this custom field will be assigned to them. However, you can also assign this field to a list while adding/editing a list.';

$lang['add_new']['field']['type']['values']['text']       = 'Text Field';
$lang['add_new']['field']['type']['values']['number']     = 'Numeric';
$lang['add_new']['field']['type']['values']['textarea']   = 'Multiline Text Field';
$lang['add_new']['field']['type']['values']['checkbox']   = 'Checkboxes';
$lang['add_new']['field']['type']['values']['select']     = 'Drop Down';
$lang['add_new']['field']['type']['values']['radio']      = 'Radio Buttons';
$lang['add_new']['field']['type']['values']['date']       = 'Date Field';
$lang['add_new']['field']['type']['values']['json']       = 'Json Field';

$lang['add_new']['form']['check_list']                    = 'Update the custom fields of all contacts within the selected list';
$lang['add_new']['form']['check_list_message']              = 'If you have un-assigned any custom field, the data will be flushed for that field.';
$lang['add_new']['form']['check_list_message_note']         = 'Note';
$lang['add_new']['form']['check_alphanumeric']         = 'Name should be alphanumeric.';

/*============== End of add new page =========*/


/*------------- 2. Lists - Custom Fields -----------/

/************* ** Page Top Bar ** *************/
$lang['page']['title']       = 'Custom Fields';
$lang['page']['description'] = 'Custom fields are used to store additional data of your leads/contacts other than just email addresses e.g first/last name, company, country, phone, etc.';


/************* ** Messages ** *************/
$lang['message']['used']         = 'Field used in contacts';
$lang['message']['id_used']      = 'Custom Field ID is being used!';
$lang['message']['field_exists'] = 'Custom Field already exist';


/************* ** General ** *************/
$lang['tools']          = 'Tools';
$lang['activity_title'] = 'Custom Field';


/************* ** Datatable ** *************/
$lang['table_headings']['name']          = 'Name';
$lang['table_headings']['sorting_order'] = 'Sorting Order';
$lang['table_headings']['type']          = 'Type';
$lang['table_headings']['created_at']          = 'Creation Date';
$lang['table_headings']['actions']       = 'Actions';

$lang['duplicate']['field']       = 'Custom field already exists.';
$lang['delete_field']['issue_1']  			   = 'Custom field is assigned to the contact list(s)';
$lang['delete_field']['issue_2']  			   = 'The custom field is not assigned to any contact list, but it has the data inside';

$lang['delete_field']['warning_1']  			   = '<b>Error:</b> This custom field is currently assigned to the contact lists. Un-assign it from the associated contact lists before it can be deleted.';
$lang['delete_field']['warning_2']  			   = '<b>Warning:</b> This custom field is not assigned to any contact list, but it has the data in it. Deleting this custom field will also flush the data inside.';
$lang['delete_field']['alert_1'] = 'If you want to delete them forcibly, the following actions are available.';
$lang['delete_field']['alert_2'] = 'Un-assign this custom field from linked contact lists and delete it.';
$lang['delete_field']['note'] = '<b>Note:</b> This operation will also flush the custom field data.';
$lang['delete_field']['consent'] = 'I understand that the custom field data will be flushed.';
$lang['delete_field']['delete_btn'] = 'Delete Field';
$lang['delete_field']['cancel_btn'] = 'Cancel';
$lang['alert']['alpha'] = 'First letter must be alphabetic character';
$lang['alert']['mix'] = 'Only letters number underscore and spaces allowed';
$lang['alert']['forbidden'] = '"," is forbidden in list of values.';
return $lang;