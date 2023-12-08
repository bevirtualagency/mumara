<?php
include("variables.php");
/**
 * Created by Mumara Team
 * Date: 02/8/2023
 */
/*-------------- 1. Actions -> Templates ----------------*/

$lang['page']['title']   = 'Templates';
$lang['page']['desc']   = 'Templates Description';
$lang['temmplates']['page_title']   = 'Templates Section';
$lang['temmplates']['page_desc']   = 'Choose from one of our available pre-designed templates or upload your own. You can view all installed/uploaded templates that you can manage (edit, delete, etc.) here.';
$lang['market']['page_title']   = 'Template Marketplace';
$lang['market']['page_desc']   = 'Template Marketplace Description';
$lang['temmplates']['upload']   = 'Upload a Template';
$lang['view_temmplate']['page_title']   = 'Template Details';
$lang['view_temmplate']['page_desc']   = 'Templates Details Description';
$lang['message']['went_wrong']   = 'Unauthorized license key';

$lang['template_controller']['client_id_exception']   = 'clientid missing';
$lang['template_controller']['service_id_id_exception']   = 'serviceid missing';
$lang['template_controller']['no_file_upload_exception']   = 'No file upload';
$lang['template_controller']['zip_file_exception']   = 'Only .zip file allowed';

$lang['template_controller']['thumbnail_file_exception']   = 'thumbnail.png file not found';
$lang['template_controller']['index_file_exception']   = 'index.html file not found';
$lang['template_controller']['header_file_exception']   = 'header.html file not found';
$lang['template_controller']['footer_file_exception']   = 'footer.html file not found';
$lang['template_controller']['template_file_exception']   = 'template.json file not found';
$lang['template_controller']['error_processing_exception']   = 'Error Processing Request';
$lang['template_controller']['message_campaign_drafted']   = 'Campaign drafted successfully';
$lang['template_controller']['unable_install_templates_msg']   = 'Unable to install the template.';

$lang['marketplace_blade']['template_id_blank_command']   = 'Template id can not be blank.';
$lang['marketplace_blade']['already_installedtext']   = 'Already Installed';
$lang['marketplace_blade']['back_templates_action']   = 'Back to Templates';
$lang['marketplace_blade']['span_scroll']   = 'Scroll';
$lang['marketplace_blade']['end_templates_div']   = 'End of Templates';
$lang['marketplace_blade']['commercial_feature_heading']   = 'Commerical Feature';
$lang['marketplace_blade']['feature_not_supported_para']   = 'This feature isn`t supported in your current subscription. You`ll need to upgrade your license to Commerical.';
$lang['marketplace_blade']['upgrade_license_button']   = 'Upgrade License';

$lang['templates_blade']['contact_support_command']   = 'Contact support for unable template upload services!';
$lang['templates_blade']['assigned_by_admin_span']   = 'Assigned by Admin';
$lang['templates_blade']['edit_template_action']   = 'Edit Template';
$lang['templates_blade']['delete_action']   = 'Delete';
$lang['templates_blade']['upload_zip_file_div']   = ' Upload the zip file of your addon provided by your vendor. Mumara Site will do an initial checkup before uploading.';
$lang['templates_blade']['upload_button']   = 'Upload';
$lang['templates_blade']['cancel_button']   = 'Cancel';
$lang['templates_blade']['uploading_txt_div']   = 'Uploading';
$lang['templates_blade']['template_zip_strong']   = 'Template.zip';
$lang['marketplace_blade']['']   = '';
$lang['marketplace_blade']['']   = '';

$lang['']['']   = '';
return $lang;
