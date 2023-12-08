<?php
include("variables.php");
/**
 * Created by Mumara Team
 * Date: 07/10/2020
 */
/*-------------- 1. Users ----------------*/

$lang['page']['title']                   = 'Users';
$lang['page']['description']             = 'Create user accounts to let your clients send campaigns for themselves and utilize the resources you allocate them.';
$lang['waiting']['message'] = 'Please check back in few minutes while we are setting up things for you :-)';

/************* ** Users Datatable ** *************/
$lang['table_headings']['name']          = 'Name';
$lang['table_headings']['email']         = 'Email Address';
$lang['table_headings']['package']       = 'Package';
$lang['table_headings']['status']        = 'Status';
$lang['table_headings']['added_on']      = $created_on;
$lang['table_headings']['actions']       = 'Actions';
// Table Actions
$lang['status']['active']                = 'Activate';
$lang['status']['suspend']               = 'Suspend';
$lang['status']['unsuspend']             = 'Unsuspend';
$lang['status']['close_account']         = 'Close Account';
$lang['threads']         = 'Maximum Theads';

/*-------------- 1.1 Users -> add new ----------------*/
$lang['add_new']['page']['title']        = 'Add a User';
$lang['edit']['page']['title']           = 'Edit User Account';
$lang['add_new']['page']['description']  = 'Setup a new user account using the fields of the form below, each individual account within the application can setup its own contact list(s), create and schedule email campaigns as per the permission allowed by the admin, to the user`s role group of the particular user account.';
//User Detail Tab
$lang['add_new']['step1']['heading']                      = 'User Detail';
$lang['add_new']['step1']['desc']                         = 'User Detail';
$lang['add_new']['step1']['form']['name']                 = 'Name';
$lang['add_new']['step1']['form']['name_help']            = 'Name of the user/client';
$lang['add_new']['step1']['form']['email']                = 'Email Address';
$lang['add_new']['step1']['form']['email_help']           = 'The email address of the user/client';
$lang['add_new']['step1']['form']['allowed_ips']          = 'Allow IPs to access '.$siteTitle.'';
$lang['add_new']['step1']['form']['allowed_ips_help']     = 'Write the IP addresses from where your account can be accessed. one IP per line';
$lang['add_new']['step1']['form']['password']             = 'Password';
$lang['add_new']['step1']['form']['password_help']        = 'The password for the user that will be used to sign in';
$lang['add_new']['step1']['form']['confirm_password']     = 'Confirm Password';
$lang['add_new']['step1']['form']['confirm_password_help']= 'Rewrite the password for confirmation';

//Package Tab
$lang['add_new']['step2']['heading']                      = 'Package';
$lang['add_new']['step2']['desc']                         = 'Package';
$lang['add_new']['step2']['form']['package']              = 'Package';
$lang['add_new']['step2']['form']['package_help']         = 'Select the package that you want to assign to this user';

/*-------------- 2. Packages ----------------*/
$lang['packages']['page']['title']                   = 'Packages';
$lang['packages']['page']['description']             = 'Create packages and define limits on the number of emails, contacts, and other modules before you can start adding the users.';
/************* ** Packages Datatable ** *************/
$lang['packages']['table_headings']['id']            			 = 'ID';
$lang['packages']['table_headings']['sr']            			 = 'Sr.';
$lang['packages']['table_headings']['package_name']  			 = 'Package Name';
$lang['packages']['table_headings']['added_on']      			 = $created_on;
$lang['packages']['table_headings']['actions']       			 = 'Actions';
$lang['packages']['create_role']                                 = 'Create Role';
/*-------------- 2.1 Packages -> add new ----------------*/
$lang['packages']['add_new']['page']['title']        = 'Add a Package';
$lang['packages']['edit']['page']['title']           = 'Edit Package';
$lang['packages']['add_new']['page']['description']  = 'Here is the list of packages.';
//Package Details Tab
$lang['packages']['add_new']['step1']['heading']                                    = 'Package Details';
$lang['packages']['add_new']['step1']['desc']                                       = 'Package Details';
$lang['packages']['add_new']['step1']['form']['package']                            = 'Package Name';
$lang['packages']['add_new']['step1']['form']['package_help']                       = 'Name of the package';
$lang['packages']['add_new']['step1']['form']['role_group']                         = 'User Role';
$lang['packages']['add_new']['step1']['form']['role_group_help']                    = 'User role that you want to assign to this package';
$lang['packages']['add_new']['step1']['form']['hourly_speed']                       = 'Hourly Speed';
$lang['packages']['add_new']['step1']['form']['hourly_speed_help']                  = 'Hourly speed of the package. Make sure that the users subscribed to this package will not be able to send at more than this speed';
$lang['packages']['add_new']['step1']['form']['daily_limit']                        = 'Daily Limit';
$lang['packages']['add_new']['step1']['form']['daily_limit_help']                   = 'Maximum number of emails that the user cannot exceed per day';
$lang['packages']['add_new']['step1']['form']['monthly_quota']                      = 'Monthly Quota';
$lang['packages']['add_new']['step1']['form']['monthly_quota_help']                 = 'The maximum number of emails that the user can send per month.';
$lang['packages']['add_new']['step1']['form']['maximum_contacts']                   = 'Maximum Contacts';
$lang['packages']['add_new']['step1']['form']['maximum_contacts_help']              = 'The maximum number of contacts that the user can add/import';
$lang['packages']['add_new']['step1']['form']['maximum_sending_domains']            = 'Maximum Sending Domains';
$lang['packages']['add_new']['step1']['form']['maximum_sending_domains_help']       = 'The maximum number of sending domains that this user can add';
$lang['packages']['add_new']['step1']['form']['maximum_sending_nodes']              = 'Maximum Sending Nodes';
$lang['packages']['add_new']['step1']['form']['maximum_sending_nodes_help']         = 'The maximum number of sending nodes that this user can add';


//Package Details Tab
$lang['packages']['add_new']['step2']['heading']             = 'Additional Headers';
$lang['packages']['add_new']['step2']['desc']                = 'Additional Headers';
$lang['packages']['add_new']['step2']['form']                = 'Package Details';

//// New MTP and Group assign work 
$lang['packages']['pre_build_assets']                = 'Assign Pre-built Assets';
$lang['packages']['miscellaneous']                = 'Miscellaneous';
$lang['packages']['select_group']                = 'Select SMTP Group';
$lang['packages']['select_type']                = 'Select Type';
$lang['packages']['sending_nodes']                = 'Sending Nodes';
$lang['packages']['select_nodes']                = 'Select Nodes ';
$lang['packages']['sending_nodes_allow']                = 'Allow using Sender-info from Sending Nodes';
$lang['packages']['sending_list_allow']                = 'Allow using Sender-info from Contact Lists';
$lang['packages']['custom_allow']                = 'Allow using custom Sender-info option';

$lang['packages']['restrictions']["title"]               = 'Sending Domain Restrictions';
$lang['packages']['restrictions']['dkim']                = 'Require DKIM Authentication';
$lang['packages']['restrictions']['tracking']                = 'Require Tracking Domain Authentication';
$lang['packages']['restrictions']['bounce']                = 'Require Bounce Domain Authentication';

/*-------------- 3. User Roles ----------------*/
$lang['roles']['page']['title']                              = 'User Roles';
$lang['roles']['page']['description']                        = 'A user role defines the privileges and access to the application features that the users can utilize. Create user roles and assign them to the required packages you create. Every user will carry the privileges as per the associated role to his subscribed package.';
/************* ** User Roles Datatable ** *************/
$lang['roles']['table_headings']['id']            			 = 'ID';
$lang['roles']['table_headings']['sr']            			 = 'Sr.';
$lang['roles']['table_headings']['role_name']  			     = 'Role Name';
$lang['roles']['table_headings']['added_on']      			 = $created_on;
$lang['roles']['table_headings']['actions']       			 = 'Actions';
$lang['roles']['create_user_role']                           = 'Create User Role';
/*-------------- 3.1 User Roles -> add new ----------------*/
$lang['roles']['add_new']['page']['title']                   = 'Add a User Role';
$lang['roles']['edit']['page']['title']                      = 'Edit User Role';
$lang['roles']['add_new']['page']['description']             = 'Create a user group, assign the permission and access level to the new user group you have created, later you will be able to add new users to this group.';
$lang['roles']['add_new']['form']['heading']                 = 'User`s Role Group Details';
$lang['roles']['add_new']['form']['role_name']               = 'Role Name';
$lang['roles']['add_new']['form']['role_name_help']          = 'Friendly name of the User Role';
/************* ** Messages ** *************/
$lang['message']['user_status_update_alert']                 = 'Are you sure to update the user status?';
$lang['message']['user_status_updated']                      = 'User status updated';
$lang['message']['role_not_found']                           = 'Role needs to be create first before you can add a package';
$lang['message']['logged_in_success']                        = 'You have been logged in successfully.';
$lang['message']['credentials_do_not_match']                 = 'These credentials do not match our records.';
$lang['message']['Backup_Code_Copied']                       = 'Backup Code Successfully Copied';
$lang['message']['Profile_Updated'] 						 = 'Profile Successfully Updated!';
/************* ** General ** *************/
$lang['activity_title']            							 = 'User';
$lang['package']['activity_title'] 							 = 'Package Created';
$lang['roles']['activity_title']   							 = 'User Roles';


$lang['create_pacage_blade']['label_max_segments']   							 = 'Maximum Segments';
$lang['create_pacage_blade']['label_max_triggers']   							 = 'Maximum Triggers';
$lang['create_pacage_blade']['label_trigger_actions_limit']   					 = 'Trigger actions monthly limit';
$lang['create_pacage_blade']['label_max_evergreen_campaigns']   				 = 'Maximum Evergreen Campaigns';
$lang['create_pacage_blade']['popover_max_evergreen_add']   					 = 'The maximum number of Evergreen campaigns the user can add.';
$lang['create_pacage_blade']['label_credit_enable']   							 = 'Enable Credits';
$lang['create_pacage_blade']['popover_check_credit']   							 = 'Enabling credits system will perform an additional check before sending an email from the user account if the sufficient credits are available.';
$lang['create_pacage_blade']['label_allow_overuse']   							 = 'Allow Overuse';
$lang['create_pacage_blade']['popover_allow_email_overuse']   			         = 'Allow users to keep sending emails without interruption even if the credits are exhausted. In this case, the credits will go negative.';
$lang['create_pacage_blade']['additional_header_heading']   							 = 'Additional Headers';
$lang['create_pacage_blade']['label_bounce_addresses']   							 = 'Bounce Addresses';
$lang['create_pacage_blade']['label_select_bounce_address']   							 = 'Select Bounce Address';
$lang['create_pacage_blade']['label_sending_domains']   							 = 'Sending Domains';
$lang['create_pacage_blade']['label_select_sending_domains']   							 = 'Select Sending Domains';
$lang['controller']['echo_success_only']   							 = 'success';
$lang['controller']['action_credits_add']   							 = 'Add credits';
$lang['controller']['action_user_login_ghost']   							 = 'Login as User';
$lang['controller']['tittle_add_users']   							 = 'Add User';
$lang['create_pacage_blade']['']   							 = 'Add User';
$lang['create_pacage_blade']['']   							 = 'Add User';
$lang['create_pacage_blade']['']   							 = 'Add User';
$lang['create_pacage_blade']['']   							 = 'Add User';

/*-------------- Profile Page ----------------*/
$lang['profile']['title'] = 'Profile';
$lang['profile']['details'] = 'Details';
$lang['profile']['name'] = 'Name';
$lang['profile']['address_line1'] = 'Address Line 1';
$lang['profile']['address_line2'] = 'Address Line 2';
$lang['profile']['post_code'] = 'Post Code';
$lang['profile']['phone'] = 'Phone';
$lang['profile']['mobile'] = 'Mobile';
$lang['profile']['security'] = 'Security';
$lang['profile']['allowed_ips'] = 'Allow IPs to access '.$siteTitle.'';
$lang['profile']['Disable_Two_Factor'] = 'Disable Two-Factor Authentication';
$lang['profile']['Enable_Two_Factor'] = 'Enable Two-Factor Authentication';
/************* ** User Notifications ** *************/
$lang['user_notifications']['mark_all_read'] = 'Mark all read';
$lang['user_notifications']['import_subscribers_completed'] = 'List-%%list_name%% has successfully been imported';
$lang['user_notifications']['export_subscribers_completed'] = 'List-%%list_name%% has successfully been exported';
$lang['user_notifications']['export_segment_completed'] = 'Segment-%%segment_name%% has successfully been exported';
$lang['user_notifications']['segment_completed'] = 'Segment-%%segment_name%% has successfully been created';
$lang['user_notifications']['schedule_campaign_started'] = 'Schedule campaign :schedule_campaign has successfully been started';
$lang['user_notifications']['schedule_campaign_finished'] = 'Schedule campaign :schedule_campaign has successfully been finished';

//*******  Session Remove  ********//
$lang['lang_view_sessions']= 'View Sessions';
$lang['lang_view_sessions_desc']= 'View Sessions Desscription';
$lang['session']['active']= 'Active Sessions';
$lang['session']['manage']= 'View and manage all of your active sessions.';
$lang['session']['no_record']= 'You dont have any session accounts';

/*-------------- Login Page ----------------*/

$lang['login']['title'] = ''.$siteTitle;
$lang['activity_log'] = 'User';
$lang['login']['heading'] = 'Login';
$lang['login']['description'] = 'Use your registered email address and password to log in';
$lang['login']['remember_me'] = 'Remember Me';
$lang['login']['forget_password'] = 'Forget Password?';
$lang['login']['reset_password']['title_h1'] = 'Reset Password';
$lang['login']['reset_password']['heading'] = 'Reset Password';
$lang['login']['reset_password']['heading_desc'] = 'Provide your details to proceed.';
$lang['login']['reset_password']['description'] = 'Enter your e-mail address below to reset your password.';
$lang['login']['reset_password']['title'] = 'Forgot Password ?';
$lang['login']['reset_password']['email'] = 'Email Address';
$lang['login']['reset_password']['sendlink'] = 'Send Password Reset Link';
$lang['login']['reset_password']['confirm'] = 'Confirm Password';
$lang['login']['reset_password']['copyrights'] = 'Copyrights';
$lang['login']['reset_password']['reset_email_sent'] = 'Password Reset Email sent successfully!';
$lang['login']['reset_password']['invalid_link'] = 'Invalid Reset Link';
$lang['login']['reset_password']['password_changed'] = 'Your password has been changed successfully.';
$lang['login']['reset_password']['password_not_matched'] = 'Password not matched!';
$lang['login']['disclaimer'] = "";


$lang['inherit_contacts_limit'] = 'Inherit contacts limit from package';
$lang['allow_user_branding'] = 'Allow Branding';


$lang['sub_user_controller']['create_clients_role_title'] = 'Create Client\'s Role Group';
$lang['sub_user_controller']['clients_role_title'] = 'Client\'s Role Group';
$lang['sub_user_controller']['create_pacage_title'] = 'Create Package';
$lang['sub_user_controller']['package_description'] = 'Package';
$lang['sub_user_controller']['created_description'] = 'Created';
$lang['sub_user_controller']['edit_pacage_title'] = 'Edit Package';

$lang['user_controller']['no_rights_session'] = 'Your have no rights to add more users.';
$lang['user_controller']['settings_updated_session'] = 'Setting Updated';
$lang['user_controller']['view_contact_list_action'] = 'View contact list';
$lang['user_controller']['view_here_action'] = 'View here';
$lang['user_controller']['user_settings_title'] = 'User Settings';
$lang['user_controller'][''] = 'View contact list';

$lang['clients_blade']['form_errors_command'] = 'You have some form errors. Please check below.';
$lang['clients_blade']['add_credit_label'] = 'Add Credit';
$lang['clients_blade']['users_limit_button'] = 'Users Limit:';
$lang['clients_blade']['add_credits_heading'] = 'Add/Update Credits';
$lang['clients_blade'][''] = 'Users Limit:';

$lang['create_package_blade']['client_management_span'] = 'Client Management';
$lang['create_role_blade']['client_role_group_span'] = 'Client\'s Role Group Details';

$lang['create_blade']['create_package_para'] = ' You need to create a package before a user can be added';
$lang['create_blade']['inherit_hourly_rate_label'] = 'Inherit hourly rate from package';
$lang['create_blade']['inherit_triggers_limit_label'] = 'Inherit triggers actions limit from package';
$lang['create_blade']['inherit_monthly_limit_label'] = 'Inherit monthly limit from package';
$lang['create_blade']['inherit_daily_limit_label'] = 'Inherit daily limit from package';

$lang['index_blade']['view_clients_span'] = 'View Clients';
$lang['index_blade']['view_all_clients_heading'] = 'View all Clients';
$lang['index_blade']['add_client_button'] = 'Add Client';
$lang['index_blade']['package_txt_th'] = 'Package';

$lang['security_blade']['session_account_span'] = 'Session Account';
$lang['security_blade']['hours_ago_span'] = 'hours ago';
$lang['security_blade']['view_more_div'] = 'View more';
$lang['security_blade']['successfully_added_msg'] = 'successfully added.';

$lang['user_setting_blade']['user_setting_txt'] = 'User Setting';

$lang['view_pacage_blade']['package_name_th'] = 'Package Name';

$lang['view_role_blade']['view_client_role_group'] = 'View Client\'s Role Group';
$lang['view_role_blade']['create_client_role_button'] = 'Create Client Role';
$lang[''][''] = '';
return $lang;
