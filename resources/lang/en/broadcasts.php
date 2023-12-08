<?php
include("variables.php");
/**
 * Created by Mumara Team
 * Date: 06/23/2020
 */
/*-------------- 1. Broadcasts ----------------*/

$lang['page']['title']                 = 'Broadcasts';
$lang['page']['description']           = 'Broadcast is an email template that your recipients will receive, and it carries TEXT/HTML body content. You can create as many broadcasts as you want. Moreover '.$siteTitle.' has a Drag & Drop email builder addon that can let you create beautiful and responsive email templates in minutes.';

/************* ** Broadcasts Datatable ** *************/
$lang['table_headings']['name']        = 'Name';
$lang['table_headings']['group']       = 'Group';
$lang['table_headings']['subject'] 	   = 'Subject';
$lang['table_headings']['added_on']    = $created_on;
$lang['table_headings']['actions']     = 'Actions';

/*-------------- 1. Broadcasts - Add New ----------------*/
$lang['add_new']['page']['title']       					= 'Add New Broadcast';
$lang['edit']['page']['title']          					= 'Edit Broadcast';
$lang['edit']['page']['html_editor']['description'] 					    = 'To create your HTML/TEXT broadcast, provide the relevant information in the fields below. You can also add an email preheader to make your email more enticing.';
$lang['edit']['page']['builder']['description']                         = 'The Drag & Drop Builder is a great tool to make your broadcast more effective. You can insert widgets, appending modules, and tags available in the Drag & Drop Builder and make your broadcast more effective.';
$lang['add_new']['page']['description']                     = 'Use our HTML Editor or Drag & Drop Builder to create a new email campaign, use pre-designed email templates or create a new one, make use of custom variables, spin tags, and tools like dynamic content tags to create personalized email content and make it more engaging.';
// editor type
$lang['add_new']['option_title']                            = 'Select Option to create broadcast.';
$lang['add_new']['html_editor']['label']                    = 'HTML Editor';
$lang['add_new']['html_editor']['description']              = 'Create campaign with expert in code';
$lang['add_new']['drag_n_drop_editor']['label']             = 'Drag &amp; Drop Builder';
$lang['add_new']['drag_n_drop_editor']['description']       = 'Design campaign without code';
$lang['add_new']['impor_editor']['label']                   = 'Import From a URL';
$lang['add_new']['impor_editor']['description']             = 'Create campaign with external resources';

$lang['add_new']['form']['heading']                         = 'Broadcast Details';
$lang['add_new']['form']['broadcast_name']                  = 'Broadcast Name';
$lang['add_new']['form']['broadcast_name_help']             = 'Give a friendly name to this broadcast for identification';
$lang['add_new']['form']['email_subject']                   = 'Email Subject';
$lang['add_new']['form']['email_subject_help']              = 'Subject line of the email that your recipient will receive';
$lang['add_new']['form']['html_body']                       = 'HTML Body';
$lang['add_new']['form']['html_body_help']                  = 'HTML content of the email';
$lang['add_new']['form']['text_body']                       = 'Text Body';
$lang['add_new']['form']['text_body_help']                  = ' Text version of the email';
$lang['add_new']['form']['check_spam_score']                = 'Check Spam Score';
$lang['add_new']['form']['attach_file']                     = 'Attachments';
$lang['add_new']['form']['attach_file_help']                = 'Drop the files here you want to be attached to this broadcast';
$lang['add_new']['form']['drop_or_browse_file_here']        = 'Drop or browse file here';
$lang['add_new']['form']['previous_attachment']             = 'Previous Attachment(s)';
$lang['add_new']['form']['get_content_from_url']            = 'http://www.mytemplate.com/template.html';
$lang['add_new']['form']['campaign_url']                    = 'Insert the URL to fetch the content from';
$lang['add_new']['form']['campaign_url_label']                    = 'Campaign URL';
$lang['add_new']['form']['get']                             = 'Get!';
$lang['add_new']['form']['campaign_builder']                = 'Campaign Builder';
$lang['add_new']['form']['load_campaign_builder']           = 'Load Campaign Builder';
$lang['add_new']['form']['edit_content_area']               = 'Edit Content Area';
$lang['add_new']['form']['actions']                         = 'Actions';
$lang['add_new']['form']['download_image']                  = 'Download Images';
$lang['add_new']['form']['fetch_url']                       = 'Fetch Content from a URL';
$lang['add_new']['form']['fetch_url_help']                  = 'The html content will be fetched from the given URL and copied to the editor.';
$lang['add_new']['form']['fetch_images_help']               = 'Images will be downloaded locally and image paths will be converted with the local paths.';
$lang['add_new']['form']['leave_page_message']              = 'You have unsaved changes. Are you sure that you want to leave the page?';
$lang['add_new']['form']['enable_preheader']                = 'Add Email Preheader';
$lang['add_new']['form']['enable_preheader_help']           = 'The preheader text shows up next to or below the subject line in the inbox.';

//Send a Preview
$lang['send_preview']['form']['heading']                            = 'Send a Preview';
$lang['send_preview']['form']['send_preview_button']                            = 'Send Preview';
$lang['send_preview']['form']['smtp_to_use_for_preview']            = 'Select a Sending Node';
$lang['send_preview']['form']['smtp_to_use_for_preview_description']            = 'The email will be relayed from the selected sending node as a carrier.';
$lang['send_preview']['form']['domain_to_use_for_preview']            = 'Select a Sending Domain';
$lang['send_preview']['form']['domain_to_use_for_preview_description']= 'This sending domain will appear in the email headers as the originator of the email.';
$lang['send_preview']['form']['send_preview_to_email']              = 'Email Address where the preview will be sent';
$lang['send_preview']['form']['send_preview_to_email_description']              = 'This email address will receive the test preview of the above broadcast.';
$lang['send_preview']['form']['send_test_preview']              	= 'Send a test preview';
$lang['send_preview']['form']['custom_variable_contact_email_id']   = 'Contact ID for Custom Variables';
$lang['send_preview']['form']['custom_variable_contact_email_id_Helptext']  = 'If your broadcast has custom fields, then they will be replaced with the custom fields data belongs to this Contact ID. If left blank, the custom fields will not be converted.';

//Check Spam Score modal
$lang['check_spam_score_modal']['heading']     = 'Check Spam Score';
$lang['check_spam_score_modal']['note']        = 'Note';
$lang['check_spam_score_modal']['note_msg1']   = 'The higher the positive score is for your email, the higher the probability that the message is spam.';
$lang['check_spam_score_modal']['note_msg2']   = 'Generally your email should have a score of 5.0 or lower to be considered passing.';
$lang['check_spam_score_modal']['status']      = 'Status';
$lang['check_spam_score_modal']['score']       = 'Score';

// drag-and-drop-zone
$lang['add_new']['form']['drag_drop_zone']['penguin_initialized']               = 'Previous Attachment(s)';
$lang['add_new']['form']['drag_drop_zone']['penguin_initialized']               = 'Penguin initialized';
$lang['add_new']['form']['drag_drop_zone']['all_pending_transfers_finished']    = 'All pending transfers finished';
$lang['add_new']['form']['drag_drop_zone']['new_file_added']                    = 'New file added';
$lang['add_new']['form']['drag_drop_zone']['starting_the_upload_of']            = 'Starting the upload of';
$lang['add_new']['form']['drag_drop_zone']['canceled_by_user']                  = 'Canceled by User';
$lang['add_new']['form']['drag_drop_zone']['uploading'] 						= 'Uploading';
$lang['add_new']['form']['drag_drop_zone']['file']      						= 'File';
// drag-and-drop-zone messages
$lang['add_new']['form']['drag_drop_zone']['server_response_for_file']          = 'Server Response for file';
$lang['add_new']['form']['drag_drop_zone']['upload_of_file']                    = 'Upload of file';
$lang['add_new']['form']['drag_drop_zone']['upload_complete']                   = 'Upload Complete';
$lang['add_new']['form']['drag_drop_zone']['no_files_uploaded']                 = 'No files uploaded.';
$lang['add_new']['form']['drag_drop_zone']['plugin_cannot_be_used_here']        = 'Plugin cant be used here, running Fallback callback';
$lang['add_new']['form']['drag_drop_zone']['cannot_be_added'] 					= 'cannot be added';
$lang['add_new']['form']['drag_drop_zone']['size_excess_limit']                 = 'size excess limit';
$lang['add_new']['form']['select_module']                                       = 'Sending Node Module';
$lang['add_new']['form']['select_serder_info']                                  = 'Sender Information';
$lang['add_new']['form']['select_module_desc']                                  = 'Sender-info will be taken from the selected option.';
$lang['add_new']['form']['select_domain']                                       = 'Select Domain';
$lang['add_new']['form']['from_sending_node']                                   = 'From Sending Node';

/************* ** Messages ** *************/
$lang['message']['empty_html_contents']     = 'Empty HTML contents!';
$lang['message']['empty_subject_field']     = 'Empty Subject Field!';
$lang['message']['alert_error']             = 'Error: Failed to check Spam Score!';
$lang['message']['alert_request']           = 'Please enter a valid URL.';
$lang['message']['alert_warning']           = 'URL entered is invalid..!';
$lang['message']['successfully_moved']      = 'successfully removed.';
$lang['message']['doing_excellent_job']     = 'You’re doing excellent job so far. It’s the time now to schedule a broadcast and see how does it perform.';


/************* ** General ** *************/
$lang['activity_title']        									= 'Campaign';
$lang['title']        									        = 'Campaigns';
$lang['email_preview']         									= 'Email Preview';
$lang['dynamic_fields']        									= 'Dynamic Fields';
$lang['insert_dynamic_fields'] 									= 'Insert Dynamic Fields';
$lang['insert']                									= 'Insert';
$lang['add_new_group']         									= 'Add New Group';
$lang['group']                 									= 'Group';
$lang['choose_group']          									= 'Choose Group';
$lang['insert_variables']                                       = 'Insert Variables';
$lang['system_variables']['label']                              = 'System Variables';
$lang['system_variables']['option']['sender_name']              = 'Sender Name';
$lang['system_variables']['option']['sender_email']             = 'Sender Email';
$lang['system_variables']['option']['recipient_email']          = 'Recipient Email';
$lang['system_variables']['option']['reply_to_Email']           = 'Reply-to Email';
$lang['system_variables']['option']['bounce_email_return_path'] = 'Bounce Email';
$lang['system_variables']['option']['todays_date']              = 'Today\'s Date';
$lang['system_variables']['option']['web_version_url']          = 'Web Version';
$lang['system_variables']['option']['broadcast_name']          = 'Broadcast name';
$lang['system_variables']['option']['list_name']                = 'List Name';
$lang['system_variables']['option']['list_id']                  = 'List ID';
$lang['system_variables']['option']['message_id']               = 'Message ID';
$lang['system_variables']['option']['campaign_id']              = 'Campaign ID';
$lang['system_variables']['option']['sending_url_domain']       = 'Sending Domain';
$lang['system_variables']['option']['sending_masking_domain']   = 'Tracking Domain';
$lang['system_variables']['option']['tracking_domain']   = 'Tracking Domain';
$lang['system_variables']['option']['schedule_id']              = 'Schedule ID';
$lang['system_variables']['option']['confirm_link']             = 'Confirmation Link';
$lang['system_variables']['option']['unsubscribe_link']         = 'Unsubscribe Link';
$lang['addition_field_variables']['label']                      = 'Additional Fields';
$lang['error_field_variables']['label']                      = 'Error Field';

$lang['addition_field_variables']['option']['contact_id']       = 'Contact ID';
$lang['spintags_variables']['label']                            = 'SpinTags';
$lang['dynamic_content_variables']['label']                     = 'Dynamic Contents';
$lang['copy_as_text'] 											= 'Copy as Text';
$lang['unsubscribe']  											= 'Unsubscribe';
$lang['confirm']      											= 'Confirm';
$lang['web_version']  											= 'Web Version';
$lang['waiting']      											= 'Waiting';
$lang['First_Broadcast']      								    = 'Create Your First Broadcast';
$lang['Schedule_First_Broadcast']      						    = 'Schedule Your First Broadcast';
$lang['Schedule_Broadcast']      						        = 'Schedule Broadcast';
$lang['daily_limit_reached']      						        = 'Your daily sending limit has been reached';
$lang['monthly_limit_reached']      						    = 'Your monthly sending limit has been reached';
$lang['insufficient_credits']      						        = 'Your credits are insufficient';
$lang['insufficient_credits']      						        = 'Your credits are insufficient';
$lang['leave']      						                    = 'Leave';
$lang['keep_editing']      						                = 'Keep editing';
$lang['send_preview']['note']      						        = '<small><strong>Note</strong>:Save the broadcast before sending a preview if you have modified the content, otherwise pre-saved content will be sent</small>';
$lang['send_preview']['new_note']                               = '<small><strong>Note</strong>:Save the broadcast before you can send a preview</small>';
$lang['exit']                                                 = 'Exit';
//added by azeem dated 13-09-2022  web_view of email
$lang['web_view_subscriber_not_exist']                                                 = 'Error: Contact may have been deleted';



/*-------------- 1. Broadcasts - Choose Template ----------------*/
$lang['breadcrumbs']['template']  					= 'Template';
$lang['template']['page']['title']       					= 'Select Broadcast Template';
$lang['template']['page']['description']       					= 'You can view all of the templates that are available to you here, and use them to send your broadcasts, simply edit them with HTML Editor or Drag & Drop Builder. You can also search for templates by category from the drop-down menu or by using the search box.';



/*-------------- 1. Templates ----------------*/

$lang['templates']['page']['title']             = 'Templates';
$lang['templates']['page']['description']       = 'Broadcast Templates Desciption';

$lang['templates']['market_page']['title']             = 'Templates Gallery';
$lang['templates']['market_page']['description']       = 'Here you can view dozens of pre-designed templates, and install them to create as many broadcasts as you want. The installed templates will be shown in the templates section.';
$lang['templates']['hide_installed']            = 'Hide Installed';
$lang['templates']['hide_installed_description']= 'Click this checkbox to hide pre-installed templates from the gallery.';
$lang['templates']['button']                    = 'Templates';
$lang['templates']['table']['name']             = 'Name';
$lang['templates']['table']['template']         = 'Template';
$lang['templates']['table']['client_enabled']   = 'User Enable';
$lang['templates']['table']['category']         = 'Category';
$lang['templates']['table']['reiews']           = 'Reviews';
$lang['templates']['table']['created_on']       = 'Created On';
$lang['templates']['table']['actions']          = 'Actions';
$lang['templates']['button_upload']             = 'Upload Template';
$lang['templates']['license_alert']             = 'This feature isn\'t supported in your current subscription. You\'ll need to upgrade your license to Commerical edition.';
$lang['templates']['button_marketplace']        = 'Template Market';
$lang['templates']['button_temp_marketplace']   = 'Templates Gallery';
$lang['templates']['table']['status']           = 'Status';
$lang['templates']['Blank_Template']            = 'Blank Template';
$lang['templates']['all_Template']            = 'All Template';
$lang['templates']['Blank']                     = 'Blank';
$lang['templates']['No_Template_Added']         = 'No Template Added';
$lang['templates']['Select_Category']           = 'Select Category';
$lang['templates']['Select_Installed']           = 'Select Installed';
$lang['templates']['All_Categories']            = 'All Categories';
$lang['templates']['Search_Template']           = 'Search Template';
$lang['templates']['Editor']                    = 'Editor';
$lang['templates']['HTML_Editor']               = 'HTML Editor';
$lang['templates']['Use_HTML_Editor']           = 'Use HTML Editor';
$lang['templates']['Builder']                   = 'Builder';
$lang['templates']['Drag_Drop_Builder']         = 'Drag & Drop Builder';
$lang['templates']['Use_Builder']               = 'Use Builder';
$lang['templates']['import_from_url']           = 'Import From a URL';
$lang['templates']['import_template']           = 'Import Template';
$lang['templates']['show_to_user']              = 'Show to user';
$lang['templates']['uninstalled']              = 'Uninstalled';
$lang['templates']['installed']              = 'Installed';

$lang['message']['template_acivated']           = 'Template Successfully Acivated.';
$lang['message']['template_de-acivated']        = 'Template Successfully Deacivated.';
$lang['message']['template_remove_warning']     = "Once deleted, it will be removed from templates!";
$lang['message']['template_removed']            = 'Template has been removed!';
$lang['message']['template_updated']            = "Template updated successfully!";
$lang['message']['template_uploaded']           = "Template Successfully uploaded.";

$lang['add_blade']['editor_heading']           = "Editor";
$lang['add_blade']['html_editor_heading']           = "HTML Editor";
$lang['add_blade']['html_editor_button']           = "Use HTML Editor";
$lang['add_blade']['builder_heading']           = "Builder";
$lang['add_blade']['drag_drop_heading']           = "Drag & Drop Builder";
$lang['add_blade']['use_builder_button']           = "Use Builder";
$lang['choose_blade']['view_template_action']           = "View Templates";
$lang['custom_criteria_blade']['want_to_delete_confirm']           = "Are you sure you want to delete this?";
$lang['custom_criteria_blade']['select_option_placeholder']           = "Select Option";
$lang['evergreen_campaigns_blade']['select_campaign_option']           = "Select Campaign";
$lang['schedule_view_blade']['txt_note_bold']           = "Note:";
$lang['schedule_view_blade']['statistics_data_div']           = "The statistics data for older than";
$lang['schedule_view_blade']['days_deleted_div']           = "days will be deleted automatically.";
$lang['schedule_view_blade']['hourly_speed_th']           = "Hourly Speed";
$lang['schedule_blade']['scheduling_broadcast_para']           = "You are scheduling the broadcast to a list that has 0 contacts inside.";
$lang['schedule_blade']['scheduling_broadcast_list_zero']           = "You are scheduling the broadcast without selecting a list";
$lang['schedule_blade']['opsss_heading']           = "Opssss";
$lang['schedule_blade']['schedule_again_button']           = "Schedule again";
$lang['schedule_blade']['new_subject_line_label']           = "New Subject Line";
$lang['schedule_blade']['span_yearly']           = "Yearly";
$lang['templates_backup_blade']['catalog_collection_action']           = "Catalog Collection";
$lang['templates_backup_blade']['mumara_template_span']           = "Mumara Template";
$lang['templates_backup_blade']['catalog_span']           = "Catalog";
$lang['templates_backup_blade']['campaign_group_span']           = "Campaign Group";
$lang['templates_backup_blade']['july_month']           = "July";
$lang['templates_backup_blade']['invoice_template_action']           = "Invoice Template";
$lang['templates_backup_blade']['invoice_txt_span']           = "Invoice";
$lang['templates_backup_blade']['main_one_span']           = "Main-01";
$lang['templates_backup_blade']['main_one_template_span']           = "Main-01 Template";
$lang['templates_backup_blade']['main_text_span']           = "Main";
$lang['templates_backup_blade']['template_text_span']           = "Template";
$lang['controller']['successfully_saved_message']           = "Selection successfully saved.";
$lang['controller']['force_pause_action']           = "Force Pause Campaign";
$lang['controller']['campaign_description']           = "Campaign";
$lang['controller']['group_name_label']           = "Group Name";
$lang['controller']['additional_header_error']           = "error  additional headers";
$lang['controller']['smtp_error']           = "error  smtp";
$lang['controller']['prepare_error']           = "PrepareCampaign";
$lang['controller']['result_not_found_return']           = "result not found1";
$lang['controller']['result_not_found_two_return']           = "result not found2";
$lang['controller']['result_not_found_three_return']           = "result not found3";
$lang['controller']['successfull_txt_echo']           = "Successful!";
$lang['controller']['record_already_exist_echo']           = "Recored alreay exist.!";
$lang['controller']['sent_successfull_return']           = "Sent successfully";
$lang['controller']['try_latter_return']           = "Something went wrong, please try later.";
$lang['controller']['successfull_txtecho']           = "Successful!";
$lang['create_blade']['clean_canvas_confirm']           = "Are you sure to clean the canvas?";
$lang['create_blade']['clear_canvas_title']           = "Clear canvas";
$lang['create_blade']['inserted_link_cansole_error']           = "could not find inserted link";
$lang['create_blade']['email_subject_placeholder']           = "Enter email subject";
$lang['create_blade']['link_type_label']           = "Link Type";
$lang['create_blade']['Subject_txt_label']           = "Subject";
$lang['create_blade']['body_content_placeholder']           = "Enter email body content";
$lang['create_blade']['link_text_placeholder']           = "Link Text";
$lang['create_blade']['enter_link_text_placeholder']           = "Enter link text content";
$lang['create_blade']['link_tittle_label']           = "Link Title";
$lang['create_blade']['enter_title_on_hover_placeholder']           = "Enter title (appears as a tooltip on hover)";
$lang['create_blade']['save_txt_button']           = "Save";
$lang['custom_criteria_blade']['suppressed_checkbox']           = "Suppressed";
$lang['custom_criteria_blade']['any_country_input']           = "Any Country";
$lang['custom_criteria_blade']['selected_country_span']           = "Selected Country";
$lang['custom_criteria_blade']['new_subject_label']           = "New Subject Line";
$lang['custom_criteria_blade']['selected_country_span']           = "Selected Country";

$lang['additional_header']['heading']   =   'Additional Headers';
$lang['additional_header']['description']   =   'Find out the additional options below and set if needed.';
$lang['additional_header']['note']   =   'Note: Spaces and special characters are not supported except hyphens (-)';
$lang['additional_header']['title']   =   'Additional Headers';
$lang['additional_header']['btn_add']   =   'Add New';

return $lang;
