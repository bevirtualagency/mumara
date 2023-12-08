<?php
include("variables.php");
/**
 * Created by Mumara Team
 * Date: 09/16/2020
 */
/*-------------- Addons ----------------*/

$lang['page']['title']                 = 'Addons';
$lang['page']['description']           = 'Install new addons, update addons, or enable/disable pre-installed addons.';
$lang['addon_installed']               = 'Success: :the addon has been successfully installed';
$lang['addon_uninstalled']             = 'Success: :the addon has been successfully Uninstalled';
$lang['not_found']                     = 'Error: addon does not exist';
$lang['status']['updated']             = 'Success: addon status has been successfully updated';
$lang['method']['not_found']           = 'Error: method :method does not exist.';
$lang['class']['not_found']            = 'Error: class :class does not exist';
$lang['integration']['not_found']      = 'Error: Provider does not exist';
$lang['save']                          = 'Save';
$lang['view_all']                      = 'View All Addons';
$lang['check_update']                  = 'Check for updates';
$lang['list_of_addons']                = 'List of Addons';
$lang['read_more']                     = 'Read more';
$lang['version']                       = 'Version';
$lang['update_available']              = 'Update Available';
$lang['launch']                        = 'Launch';
$lang['settings']                        = 'Settings';
$lang['activate']                      = 'Activate';
$lang['install']                       = 'Install';
$lang['deactivate']                    = 'Deactivate';
$lang['uninstall']                     = 'Uninstall';
$lang['remove']                        = 'Remove';
$lang['activated']                     = 'Activated';
$lang['deactivated']                   = 'Deactivated';
$lang['installed']                     = 'Installed';
/*-------------- Upload Addon ----------------*/
$lang['modal']['upload_addon']          = 'Upload an Addon';
$lang['modal']['upload_addon_desc']     = 'Upload the zip file of your addon provided by your vendor. '.$siteTitle.' will do an initial checkup before uploading.';
$lang['modal']['select_file']           = 'Select File';
$lang['modal']['upload_button']         = 'Upload';
$lang['modal']['uploading']             = 'Uploading';
/*-------------- Messages ----------------*/
$lang['message']['check_update_success']         = 'Success: A cron is running in background to check for updates.';
$lang['message']['license_key_saved']            = 'License key successfully saved!';
$lang['message']['install_dir']['not_found']     = 'Error: Install directory does not exist';
$lang['message']['uninstall_dir']['not_found']   = 'Error: Uninstall directory does not exist';
$lang['message']['sql_file']['not_found']        = 'Error: Sql file does not exist';
$lang['message']['not_exists']                   = ':name addon does not exist.';
$lang['message']['file_not_exist']               = ':file does not exist.';
$lang['message']['addon_removed']                = 'Addon has been successfully removed';
$lang['message']['addon_updated']                = 'Addon has been successfully updated';
$lang['message']['addon_uploaded']               = 'Addon has been successfully uploaded';
$lang['message']['license_verfied']              = 'The license key has been verified.';
$lang['message']['license_key_not_found']        = 'License key not found';
$lang['message']['addon_already_exists']         = 'Addon :name already exists';
$lang['message']['invalid_addon']                = 'Zip must have 1 root folder which will be considered addon name.';
$lang['message']['zip_extension_not_found']      = 'Zip extension not installed.';
$lang['message']['upload_file_size']             = 'Zip file size should not exceed :size';
$lang['message']['upload_max_filesize']          = 'You are trying to upload a file bigger than the allowed upload filesize limit set in php.ini';
$lang['max']                                     = 'Max';
$lang['issue']['resolved']                       = 'Success: Issue has been successfully resolved.';
$lang['issue']['not_resolved']                   = 'Error: opp`s something went wrong. try again later.';
$lang['message']['no_addon_available']           = 'No addon available';
$lang['resolve']['bt_title']                     = 'Click to mark as resolved';
$lang['btn_title']['retry']                      = 'Retry';
$lang['btn_title']['verify']                     = 'Verify';
$lang['insert_license_key']                      = 'Insert License Key';
$lang['license_key']                             = 'License Key';
$lang['license_required']                        = 'License Required';
$lang['license_required_desc']                   = 'This addon requires a valid license before you can proceed with the installation.';


$lang['controller']['php_exec_disable_exception']                = 'PHP exec is disbled';
$lang['controller']['error_downloading_file_exception']                = 'Error in downloading file';
$lang['googlefa_index_blade']['second_factor_auth_div']                = 'Second factor authentication is required to login. Copy the code from your Authenticator application';
$lang['googlefa_index_blade']['write_down_paper_div']                = 'Write this down on paper and keep it safe. It will be needed if you ever lose your 2nd factor device or it is unavailable to you again in future.';
$lang['googlefa_index_blade']['continue_action']                = 'Continue';
$lang['googlefa_index_blade']['access_device_backup_div']                = 'Can`t access your 2fa device?<br>Login using backup code';
$lang['googlefa_index_blade']['login_two_factor']                = 'Login using Two-Factor code';
$lang['googlefa_index_blade']['processing_span']                = 'Processing...';
$lang['googlefa_index_blade']['backup_code_successfully_command']                = 'Backup Code Successfully Copied.';
$lang['googlefa_index_blade']['login_continue_navigate_text']                = 'The login was successful. Press the continue button to navigate to the Dashboard!';
$lang['googlefa_index_blade']['backup_code_valid_text']                = 'Backup Codes are valid once only. It will now be reset.';
$lang['googlefa_index_blade']['passed_auth_sussessfully_text']                = 'You are successfully passed authentication. Click Continue to go on dashboard.';

$lang['index_blade']['version_text_span']                = 'Version:';
$lang['index_blade']['vendor_span']                = 'Vendor:';
$lang['index_blade']['support_expire_on_span']                = 'Support expiring on:';
$lang['index_blade']['activate_addon_div']                = 'Click to Activate Addon';
$lang['index_blade']['deactivate_addon_div']                = 'Click to Deactivate Addon';
$lang['index_blade']['uninstall_addon_div']                = 'Click to Uninstall Addon';
$lang['index_blade']['install_addon_div']                = 'Click to Install Addon';
$lang['index_blade']['remove_addon_div']                = 'Click to Remove Addon';
$lang['index_blade']['enter_license_txt']                = 'Please enter license key';
$lang['index_backup_blade']['form_errors_command']                = 'You have some form errors. Please check below.';
$lang['index_blade']['controller']                = '';
return $lang;