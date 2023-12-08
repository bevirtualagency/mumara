<?php
include("variables.php");
/**
 * Created by Mumara Team
 * Date: 07/10/2020
 */
/*-------------- 1. Setup -> Staff Management -> Administrators ----------------*/

$lang['admin']['page']['title']                 = 'Administrators';
$lang['admin']['page']['description']           = 'Create additional administrators and assign them different roles to manage the administrative process.';

/************* ** Administrators Datatable ** *************/
$lang['admin']['table_headings']['name']         = 'Admin Name';
$lang['admin']['table_headings']['email']        = 'Email Address';
$lang['admin']['table_headings']['role']         = 'Role';
$lang['admin']['table_headings']['added_on']     = $created_on;
$lang['admin']['table_headings']['actions']      = 'Actions';

/*-------------- 1.1 Setup -> Staff Management -> Administrators -> add new ----------------*/
$lang['admin']['add_new']['page']['title']       = 'Add an Administrator';
$lang['admin']['edit']['page']['title']          = 'Edit Administrator';
$lang['admin']['add_new']['page']['description'] = 'Create additional administrators and assign them different roles to manage the administrative process.';

$lang['admin']['add_new']['form']['heading']                      = 'Staff Details';
$lang['admin']['add_new']['form']['name']                         = 'Admin Name';
$lang['admin']['add_new']['form']['name_help']                    = 'Name of the administrator to be added';
$lang['admin']['add_new']['form']['email']                        = 'Email Address';
$lang['admin']['add_new']['form']['email_help']                   = 'The email address of the administrator';
$lang['admin']['add_new']['form']['password']                     = 'Password';
$lang['admin']['add_new']['form']['password_help']                = 'The password of the administrator that will be used to sign in';
$lang['admin']['add_new']['form']['confirm_password']             = 'Confirm Password';
$lang['admin']['add_new']['form']['confirm_password_help']        = 'Write the password again for confirmation';
$lang['admin']['add_new']['form']['admin_role']                   = 'Admin Role';
$lang['admin']['add_new']['form']['admin_role_help']              = 'Select the admin role to assign required privileges';
/*-------------- 2. Setup -> Staff Management -> Admin Roles ----------------*/
$lang['role']['page']['title']                 = 'Admin Roles';
$lang['role']['page']['description']           = 'An "Admin Role" is a set of privileges that is created to assign required privileges to the administrators.';

/************* ** Admin Roles Datatable ** *************/
$lang['role']['table_headings']['id']           = 'ID';
$lang['role']['table_headings']['sr']           = 'Sr.';
$lang['role']['table_headings']['name']         = 'Role Name';
$lang['role']['table_headings']['added_on']     = $created_on;
$lang['role']['table_headings']['actions']      = 'Actions';

/*-------------- 2.1 Setup -> Staff Management -> Admin Roles -> add new ----------------*/
$lang['role']['add_new']['page']['title']       	= 'Add Admin Role';
$lang['role']['edit']['page']['title']          	= 'Edit Admin Role';
$lang['role']['add_new']['page']['description'] 	= 'An "Admin Role" is a set of privileges that is created to assign required privileges to the administrators.';
$lang['role']['add_new']['form']['heading']    	    = 'Admin Role Details';
$lang['role']['add_new']['form']['role_name']    	= 'Role Name';
$lang['role']['add_new']['form']['role_name_help']  = 'Friendly name of the Admin Role';

/************* ** General ** *************/
$lang['title']          		  = 'Staff Management';
$lang['retry_operation']          = 'Retry Operation';
$lang['activity_title'] 		  = 'User Roles';
$lang['assign_assets']            = 'Assign assets to another admin?';
$lang['select_admin']             = 'Select admin';
$lang['delete_assets']            = 'Delete the assigned assets?';
$lang['message']['soft_delete']   = '<b>Soft Delete:</b> It will delete the account but will not delete the associated data.';
$lang['message']['hard_delete']   = '<b>Hard Delete:</b> It will delete the account and will also delete the associated data';

$lang['modal']['title']          		  = 'Delete Admin';
$lang['modal']['select_admin']          		  = 'Select Admin';
$lang['modal']['delete_option_help1']     = 'All contributions by ';
$lang['modal']['delete_option_help2']     = ' will be re-assigned to the selected admin.';
$lang['modal']['delete_option_help3']     = 'All assets that were added by ';
$lang['modal']['delete_option_help4']     = ', will also be deleted.';
$lang['modal']['assign_option_help1']     = 'This process is irrevocable. Are you sure you want to proceed?';

$lang['create_blade']['hourly_sending_rate_label']     = 'Hourly Sending Rate';
$lang['create_blade']['not_set_value_popover']     = 'If it is not set to any value, there will be no limit on hourly email sending speed for the campaigns scheduled by this admin.';
$lang['create_blade']['daily_sending_limit_label']     = 'Daily Sending Limit';
$lang['create_blade']['not_set_value_dailylimit_popover']     = 'If it is not set to any value, there will be no daily limit on the emails sent by this admin.';
$lang['create_blade']['monthly_sending_limit_label']     = 'Monthly Sending Limit';
$lang['create_blade']['not_set_value_monthlylimit_popover']     = 'If it is not set to any value, there will be no monthly limit on the emails sent by this admin.';
return $lang;