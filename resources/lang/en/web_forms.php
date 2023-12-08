<?php
include("variables.php");
/**
 * Created by Mumara Team
 * Date: 07/09/2020
 */
/*-------------- 1. Setup -> Web Forms ----------------*/
$content_html = "New subscriber has been added to the the List: %%list_name%% using webform: %%webform_name%%";
$content_html .= "<br><br>This email has been generated and sent by %%app_title%% Web Form because you have opted in to receive notification by email upon webform submission. You can turn off this settings by editing the webform.<br><br>";
$content_html .=  "%%app_title%%";

$lang['page']['title']                 = 'Web Forms';
$lang['page']['description']           = 'Create web forms to embed into your website to get subscribers directly added to the contact list.';

/************* ** Web Forms Datatable ** *************/
$lang['table_headings']['id']                    = 'ID';
$lang['table_headings']['sr']                    = 'Sr.';
$lang['table_headings']['name']                  = 'Name';
$lang['table_headings']['double_option']         = 'Double Opt-in';
$lang['table_headings']['thankyou_action']       = 'Thank You Email';
$lang['table_headings']['added_on']              = $created_on;
$lang['table_headings']['actions']               = 'Actions';

/*-------------- 1.1 Setup -> Web Forms -> add new ----------------*/
$lang['add_new']['page']['title']       = 'Add Web Form';
$lang['edit']['page']['title']          = 'Edit Web Form';
$lang['add_new']['page']['description'] = 'Work with the following fields to setup the details of new form to place on the website, for the visitors/users to fill, in order to subscribe to the mailing list.';

/************* ** Details Tab ** *************/
$lang['add_new']['step1']['heading']              			 = 'Details';
$lang['add_new']['step1']['desc']                 			 = 'Details';
$lang['add_new']['form']['form_name']             			 = 'Name';
$lang['add_new']['form']['form_name_help']             		 = 'Friendly name of the webform';
$lang['add_new']['form']['double_option']         			 = 'Double Opt-in';
$lang['add_new']['form']['double_option_help']         		 = 'Enable this switch if you want to add the new subscribers with unconfirmed status. '.$siteTitle.' will send them an instant confirmation link by email before their status will be updated to confirmed.';
$lang['add_new']['form']['thankyou_email']        			 = 'Thank You Email';
$lang['add_new']['form']['thankyou_email_help']        		 = 'Enable if you want to send a thankyou email to the new subscribers';
$lang['add_new']['form']['email_new_contact_details']        = 'Email New Contact Details To';
$lang['add_new']['form']['email_new_contact_details_help']   = 'Insert the email address where you want to receive the notifications upon new subscribers';
$lang['add_new']['form']['format']                           = 'Email Content Format';
$lang['add_new']['form']['format_help']                      = 'Select which version of the email '.$siteTitle.' should send to the new subscribers. Or allow subscribers to decide themselves';
$lang['add_new']['form']['duplicates_help']                  = 'Select if you want to skip the duplicate subscribers or overwrite with the new details';
$lang['add_new']['form']['allow_contacts_to_choose']         = 'Allow contacts to choose';
$lang['add_new']['form']['sending_nodes']                    = 'Sending Nodes';
$lang['add_new']['form']['sending_nodes_help']               = 'Select the sending node that will be responsible to send welcome/confirmation email to the subscribers';
$lang['add_new']['form']['contact_list_help']                = 'Select the contact list (and the fields) that will catch the new subscribers';
$lang['add_new']['form']['select_fields']                    = 'Subscription Fields';
$lang['add_new']['form']['select_fields_help']               = 'Sort the fields to match with the desired output of the webform';

/************* ** Confirmation Tab ** *************/
$lang['add_new']['step2']['heading']                    = 'Confirmation';
$lang['add_new']['step2']['desc']                       = 'Confirmation';
$lang['add_new']['form']['confirmation_action']         = 'Redirect Subscriber To';
$lang['add_new']['form']['confirmation_action_help']         = '<p><strong>Show Confirmation Page:</strong><br>
Redirect subscriber to '.$siteTitle.'\'s built-in confirmation page<br>
<br>
<strong>Redirect to another Webpage:</strong><br>
Insert the Webpage URL where you want to redirect subscriber after the webform is filled</p>';
$lang['add_new']['form']['show_confirmation_page']      = 'Show Confirmation Page';
$lang['add_new']['form']['take_contact_to_a_website']   = 'Redirect to another Webpage';
$lang['add_new']['form']['show_json_response']   = 'Show JSON Response';
$lang['add_new']['form']['confirmation_page_content']   = 'Confirmation Page Content';
$lang['add_new']['form']['confirmation_page_content_help']   = 'The content that you want your subscriber to see after the subscription form is filled';
$lang['add_new']['form']['confirmation_page_content_text'] = '
Your email subscription is almost complete...

An email has been sent to the email address you entered. Please click on the enclosed confirmation link to confirm your subscription.

Thank You';
$lang['add_new']['form']['update_page_content_text'] = 'You are already subscribed to this contact list. We have updated your details.';

$lang['add_new']['form']['confirmation_json_content_text'] = 'Your email subscription is almost complete. An email has been sent to the email address you entered. Please click on the enclosed confirmation link to confirm your subscription. Thank You';
$lang['add_new']['form']['website_address'] = 'Website Address';
$lang['add_new']['form']['website_address_help'] = 'Website Address';
$lang['add_new']['form']['sender_name'] = 'Sender Name';
$lang['add_new']['form']['sender_name_help'] = 'The name from which confirmation email will be sent';
$lang['add_new']['form']['sender_email'] = 'Sender Email';
$lang['add_new']['form']['sender_email_help'] = 'The email address that the email will appear to be sent from';
$lang['add_new']['form']['reply_email'] = 'Reply-to Email';
$lang['add_new']['form']['reply_email_help'] = 'Insert the email address where you want to get the replies (in case if a subscriber replies)';
$lang['add_new']['form']['email_subject'] = 'Email Subject';
$lang['add_new']['form']['email_subject_help'] = 'The subject line of the confirmation email';
$lang['add_new']['form']['confirm_your_subscription'] = 'Confirm your subscription!';
$lang['add_new']['form']['confirmation_email_html_content'] = 'Confirmation Email HTML Content';
$lang['add_new']['form']['confirmation_email_html_content_help'] = 'The HTML content of the confirmation email';
$lang['add_new']['form']['confirmation_email_html_content_text'] = '
Dear subscriber, your subscription is just a click away. Please click on the link below to confirm your subscription with us.
<br><br>
<a href="%%confirmurl%%"> Confirm Subscription </a>
<br>
<br>
Alternatively you can copy/paste the following URL in your browser to confirm the subscription.
<br><br>
%%confirmurl%%
<br><br>
Best Regards,<br>
<b>%%application_name%%</b>
<br>
<br>
Disclaimer: We are sending you this email on the behalf of your request for subscription with us. If you think you are getting this email in result of an error, you can void this email and unsubscribe forcefully.

';
$lang['add_new']['form']['confirmation_email_text_content'] = 'Confirmation Email Text Content';
$lang['add_new']['form']['confirmation_email_text_content_help'] = 'The Text content of the confirmation email';
$lang['add_new']['form']['confirmation_email_text_content_text'] = 'Your subscription is just a click away. Please copy/paste the following URL in your browser to confirm the subscription. 


%%confirmurl%%

Best Regards,

%%application_name%%

Disclaimer: We are sending you this email on the behalf of your request for subscription with us. If you think you are getting this email in result of an error, you can void this email and unsubscribe forcefully.';
$lang['add_new']['form']['json_response_text_content'] = 'JSON Response';
$lang['add_new']['form']['json_response_text_content_help'] = 'The JSON Response of the confirmation email';


/************* ** Thank You Tab ** *************/
$lang['add_new']['step3']['heading']                                    = 'Thank You';
$lang['add_new']['step3']['desc']                                       = 'Thank You';
$lang['add_new']['form']['thank_you_email_action']                      = 'Redirect Subscriber To';
$lang['add_new']['form']['thank_you_email_action_help']                      = '<td><strong>Show Thankyou Page:</strong><br>
Show '.$siteTitle.'\'s built-in Thankyou Page<br>
<br>
<strong>Take to another Webpage:</strong><br>
Take the subscriber to another webpage after subscription</td>';
$lang['add_new']['form']['show_thank_you_page']                      = 'Show Thankyou Page';
$lang['add_new']['form']['take_contact_to_a_website']                      = 'Take to another Webpage';
$lang['add_new']['form']['thankyou_page']                      = 'Thankyou Page Content';
$lang['add_new']['form']['thankyou_page_text'] = '
Your subscription is now complete.

Thank you for subscribing to our contact list.

';
$lang['add_new']['form']['thankyou_page_help']                       = 'The content that you want your subscriber to see after subscription completion';
$lang['add_new']['form']['thank_you_from_name']                      = 'Sender Name';
$lang['add_new']['form']['thank_you_from_name_help']                 = 'The name from which the thank you email will be sent';
$lang['add_new']['form']['thank_you_from_email']                 = 'Sender Email';
$lang['add_new']['form']['thank_you_from_email_help']                 = 'The email address that the thank you email will appear to be sent from';
$lang['add_new']['form']['thank_you_reply_email']                 = 'Reply-to Email';
$lang['add_new']['form']['thank_you_reply_email_help']                 = 'Insert the email address where you want to get the replies (in case if a subscriber replies)';
$lang['add_new']['form']['thank_you_email_subject']                 = 'Email Subject';
$lang['add_new']['form']['thank_you_email_subject_help']                 = 'The subject line of the thank you email';
$lang['add_new']['form']['thank_you_email_subject_text']                 = 'Thank you for your subscription!';
$lang['add_new']['form']['thank_you_email_subject_help']                 = 'The subject line of the thank you email';
$lang['add_new']['form']['thankyou_email_html_content'] = 'Email HTML Content';
$lang['add_new']['form']['thankyou_email_html_content_help'] = 'The HTML content of the thank you email';
$lang['add_new']['form']['thankyou_email_html_content_text'] = 'Dear Subscriber,<br><br>
Your subscription is now confirmed. We’ll keep you updated!
<br><br>
Thank You
<br><br>
Best Regards,<br>
%%application_name%%

';
$lang['add_new']['form']['thankyou_email_text_content'] = 'Email Text Content';
$lang['add_new']['form']['thankyou_email_text_content_help'] = 'The Text content of the thank you email';
$lang['add_new']['form']['thankyou_email_content_text'] = 'Dear Subscriber,
Your subscription is now confirmed. We’ll keep you updated!

Thank You

Best Regards,
%%application_name%%
';
$lang['add_new']['form']['dynamic_tags'] = 'Dynamic Tags';
$lang['add_new']['form']['select_custom_variables'] = 'Select Custom Variables';

/************* ** Error Tab ** *************/
$lang['add_new']['step4']['heading']              = 'Error';
$lang['add_new']['step4']['desc']                 = 'Error';
$lang['add_new']['form']['error_actions']          = 'Redirect To';
$lang['add_new']['form']['error_actions_help']          = '<td><strong>Show Error Page:</strong><br>
Show '.$siteTitle.'\'s built-in Error Page<br>
<br>
<strong>Redirect to another Webpage:</strong><br>
Insert the webpage URL where you want to redirect the subscriber upon an error</td>';
$lang['add_new']['form']['show_error_page'] = 'Show Error Page';
$lang['add_new']['form']['take_the_contact_to_following_website'] = 'Redirect to another Webpage';
$lang['add_new']['form']['error_page'] = 'Error Page Content';
$lang['add_new']['form']['error_page_help'] = 'The content that will be shown to the subscriber in case of an error. (If "Show Error Page" option is selected above)';
$lang['add_new']['form']['error_page_text'] = 
"An error has occurred while trying to subscribe you to our contact list:
<br><br>
%%error%%"
;


$lang['add_new']['form']['error'] = 'Error';
$lang['add_new']['form']['system_variables'] = 'System Variables';
$lang['add_new']['form']['today_date'] = 'Today\'s Date';
$lang['add_new']['form']['list_name'] = 'List Name';
$lang['add_new']['form']['list_id'] = 'List ID';

/************* ** Dynamic Tags ** *************/

$lang['dynamic_tags']['title'] = 'Dynamic Tags';
$lang['dynamic_tags']['select_custom_variables'] = 'Select Custom Variables';
$lang['dynamic_tags']['custom_fields'] = 'Custom Fields';
$lang['dynamic_tags']['masking_domain'] = 'Tracking Domain';
$lang['dynamic_tags']['tracking_domain'] = 'Tracking Domain';
/************* ** Message ** *************/
$lang['message']['form_copied'] = 'Form successfully copied.';
$lang['message']['double_option'] = 'Double optin option wasn\'t selected so these settings have been bypassed';
$lang['message']['file_not_found'] = 'File does not exist!';
/************* ** General ** *************/
$lang['activity_title'] = 'Website Form';
$lang['subscription_form'] = 'Subscription Form';
$lang['open_form'] = 'Open Form';
$lang['get_html'] = 'Get HTML';
$lang['form_html'] = 'Web Form HTML';
$lang['public_key'] = 'Public Key';
$lang['secret_key'] = 'Secret Key';
$lang['btn']['gcaptcha'] = 'Google Recaptcha';
$lang['add_new']['form']['gcaptcha']                = 'Click to Enable Google Recaptcha v3';
$lang['add_new']['form']['public_key']                = 'Public Key of google recaptcha v3 APi Credentials.';
$lang['add_new']['form']['secret_key']                = 'Secret Key of google recaptcha v3 APi Credentials';
$lang['add_new']['form']['form_design']                = 'Form Template';
$lang['add_new']['help']['form_design']                = 'Select form template and this template will apply on your webform';
$lang['add_new']['form']['form_design_help']           = 'Select the webform template';
$lang['add_new']['form']['select_webform_design']           = 'Select the web form template';
$lang['add_new']['form']['web_form_templates']           = 'Templates';

$lang['add_new']['help']['gcaptcha']                = 'Google Recaptcha v3';
$lang['add_new']['help']['public_key']                = 'Google Recaptcha v3 Public key';
$lang['add_new']['help']['secret_key']                = 'Google Recaptcha v3 Secret key';
$lang['add_new']['form']['blank_template'] = 'Blank template';
$lang['add_new']['help']['blank_template'] = "Enable if you dont't want to use any template";

$lang['admin_notification']     =   'Admin Notification';
$lang['admin_notification_help']     =   'Enable if you want to send email notification to admin.';

$lang['web_form_design']['title'] = 'Web Form Templates';
$lang['web_form_design']['description'] = 'These templates will be applied on the web forms';
$lang['web_form_design']['sr'] = 'Sr';
$lang['web_form_design']['name'] = 'Template name';
$lang['web_form_design']['image'] = 'Preview';
$lang['web_form_design']['view_design'] = 'View template';
$lang['web_form_design']['created_on'] = 'Created On';
$lang['web_form_design']['action'] = 'Actions';
$lang['web_form_design']['default'] = 'Predefined';
$lang['web_form_design']['activity_log']['create'] = 'Web form template Deleted';

$lang['form_input']['return_path']     =   'Return-Path';
$lang['input']['return_path']['help']     =   'Return-Path';
$lang['input']['return_path']['help_desc']     =   'Return Path Description';
$lang['admin_content']['default']     =   $content_html;

$lang['admin_content']['title']     =   'Admin Email content';
$lang['textarea']['admin_content']['help']     =   'Admin email content';
$lang['textarea']['admin_content']['help_desc']     =   'Admin email content description';
$lang['textarea']['admin_content']['title']     =   'Admin email content';

$lang['admin_subject']['title']     =   'Admin Email Subject';
$lang['input']['admin_subject']['help']     =   'Admin email subject';
$lang['input']['admin_subject']['help_desc']     =   'Admin email subject description';
$lang['input']['admin_subject']['title']     =   'Admin email subject';
$lang['admin_subject']['default']     = 'New Contact has been added';

$lang['create_web_form_design']['label']['title'] = 'Create Web Form template';
$lang['create_web_form_design']['label']['description'] = 'Create Web form template for your web forms';
$lang['create_web_form_design']['label']['name'] = 'Template name';
$lang['create_web_form_design']['label']['name_help'] = 'This Name will dislay in the webform listing';
$lang['create_web_form_design']['label']['design'] = 'Template Source Code';
$lang['create_web_form_design']['label']['design_help'] = 'Place here template source code here, make sure that its look should be like your snapshort preview picture';

$lang['create_web_form_design']['label']['preview_picture'] = 'Template preview picture';
$lang['create_web_form_design']['label']['preview_picture_help'] = 'Upload snapshort of the template which will be look like this.';
$lang['create_web_form_design']['label']['form_type'] = 'Form type';
$lang['create_web_form_design']['label']['form_type_help'] = 'Form type help';
$lang['create_web_form_design']['help']['form_type'] = 'Form type help description';
$lang['create_web_form_design']['select']['form_type'] = 'Select the form type';

$lang['create_web_form_design']['label']['styles'] = 'Styles';
$lang['create_web_form_design']['label']['styles_help'] = 'Styles help';



$lang['create_web_form_design']['form_message']['name'] = 'Enter the template name';
$lang['create_web_form_design']['form_message']['category_id'] = 'Select the form type';
$lang['create_web_form_design']['form_message']['permission_not_allow'] = 'Permission not allow to upload preview picture in the folder';
$lang['create_web_form_design']['form_message']['extension_fail'] = 'Invalid file extension';
$lang['create_web_form_design']['form_message']['invalid_file'] = 'File not valid';
$lang['create_web_form_design']['form_message']['invalid_file'] = 'File not valid';
$lang['create_web_form_design']['form_message']['error_in_save'] = 'Oops! there is something wrong with database connection';
$lang['create_web_form_design']['form_message']['success'] = 'Web form template has been successfully saved';
$lang['create_web_form_design']['form']['revert_default'] = 'Revert to default';
$lang['create_web_form_design']['help']['revert_default'] = "Enable if you want to use default design";

/*-------------- 1. Setup -> Web Forms ----------------*/

$lang['page_template']['page_title']                 = 'Web Form Template';
$lang['page_template']['title']                 = 'Select Web Form Template';
$lang['page_template']['description']           = 'Create your own Web Form Template or use one of our Pre-Made Templates.';

$lang['view_web_form_design']['title'] = 'View web from design';
$lang['view_web_form_design']['description'] = 'View web from design description';
$lang['make_copt_form_design']['not_exist'] = "ID does not exist";
$lang['make_copt_form_design']['success'] = "Copy created successfully";
$lang['make_copt_form_design']['copy'] = "Make a copy";
$lang['copy_url']['success'] = "The Post URL has been copied";
$lang['create_web_form_design']['keep_editing'] = "Save & keep Editing";
$lang['form']['not_exist'] = "Webform  does't exist in the Mumara";
$lang['form']['list_not_exist'] = "List ID which is attached with the webfrom, that list id does't exist";
$lang['form']['invalid_token'] = "Invalid Token";
$lang['form']['insufficient_request_score'] = "Insufficient request score";
$lang['form']['redirection_url'] = "Subscriptio is confirmed but The webform is redirect to another page.";

$lang['web_form_controller']['email_address_confirmed_echo'] = "Your email address has been confirmed. Thank You!";
$lang['web_form_controller']['setup_smtp_settings_exception'] = "Please setup/update your SMTP settings in application settings mail menu.";
$lang['web_form_controller']['system_variables_title'] = "System Variables";
$lang['web_form_controller']['additional_variables_title'] = "Additional Variables";
$lang['web_form_controller']['insufficient_request_score_echo'] = "Insufficient request score.";

$lang['create_web_form_designs_blade']['supported_extensions_span'] = "Supported extensions: jpg, png, gif. Suggested dimensions: 750px x 150px";
$lang['create_web_form_designs_blade']['html_txt_label'] = "HTML";
$lang['create_web_form_designs_blade']['web_template_preview_heading'] = "Web Template Preview";

$lang['web_forms_create_blade']['variable_placed_successfully_command'] = "Variable placed successfully!";
$lang['web_forms_create_blade']['label_selected_template'] = "Selected Template:";
$lang['web_forms_create_blade']['cancel_change_temp_action'] = "Cancel Change Template";
$lang['web_forms_create_blade']['system_additional_variables'] = "You can use variable from system and additioanl variables to click on relivant button.";
$lang['web_forms_create_blade']['additional_system_variables_heading'] = "Additional &amp; System Variables";
$lang['web_forms_create_blade']['variables_button'] = "Variables";

$lang['web_forms_templates_blade']['span_template_added'] = "No Template Added";
$lang['web_forms_templates_blade']['label_search_template'] = "Search Template";
$lang['web_forms_templates_blade']['blank_template_button'] = "Blank Template";
$lang['web_forms_templates_blade']['use_this_button'] = "Use This";


//web form designs

return $lang;