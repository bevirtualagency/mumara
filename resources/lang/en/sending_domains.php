<?php
include("variables.php");
/**
 * Created by Mumara Team
 * Date: 07/03/2020
 */
/*-------------- 1. Setup -> Sending Domains ----------------*/

$lang['page']['title']             = 'Sending Domains';
$lang['page']['description']       = 'Sending domains are the domains that appear in message headers and the email appears to be sent from these domains. Once you add a sending domain, '.$siteTitle.' generates DNS keys to authenticate the domain.';

$lang['page']['data_moved']                              = 'Data moved';
$lang['table']['action']['view_sending_domain']          = 'View Sending Domain';
$lang['table']['action']['set_ownership_verified']       = 'Set Ownership as Verified';
$lang['table']['action']['verify_public_domain_key']     = 'Verify Public Domain Key';
$lang['table']['action']['verify_redirection']           = 'Verify Redirection';
$lang['table']['action']['download_domain_key_pair']     = 'Download Domain Key Pair';
$lang['table']['action']['download_public_domain_key']   = 'Download Public Domain Key';

$lang['table']['dkim']['verified']                       = 'DKIM Verified';
$lang['table']['dkim']['failed']                         = 'DKIM Failed';
$lang['table']['dkim']['off']                            = 'DKIM is off';
$lang['table']['custom_tracking_off']                    ="Custom tracking is off";
$lang['table']['verification_required']                  ="Verification Required";
$lang['table']['verification_failed']                    ="Verification Failed";
/************* ** View Scheduled Datatable ** *************/
$lang['table_headings']['sending_domain']                = 'Sending Domain';
$lang['table_headings']['tracking_domain']               = 'Tracking Domain';
$lang['table_headings']['tracking_prefix']               = 'Tracking Prefix';
$lang['table_headings']['redirection_type']              = 'Redirection Type';
$lang['table_headings']['dkim']                          = 'DKIM';
$lang['table_headings']['redirection']                   = 'Redirection';
$lang['table_headings']['verified']                      = 'Verified';
$lang['table_headings']['unverified']                    = 'Unverified';
$lang['table_headings']['created_on']                    = $created_on;
$lang['table_headings']['actions']                       = 'Actions';

/*-------------- 1.1 Setup -> Sending Domains -> add new ----------------*/
$lang['add_new']['page']['title']                  		 = 'Add Sending Domain';
$lang['add_new']['page']['description']            		 = 'Domain masking helps concealing the identity of your primary/local domain by forwarding your visitor to another website/domain name.';

$lang['add_new']['form']['heading']                		 = 'Setup details for Sending';
$lang['add_new']['form']['sending_domain']         		 = 'Sending Domain';
$lang['add_new']['form']['sending_domain_text']    		 = 'insert your domain name without www and http/https. e.g. myagency.com.';
$lang['add_new']['form']['sending_domain_help']    		 = 'Insert the Sending Domain that you want to add';
$lang['add_new']['form']['use_secure_url_help']    		 = 'If enabled than '.$siteTitle.' will sue HTTPS protocol for the tracking domain';

/*-------------- 1.1 Setup -> Sending Domains -> Edit ----------------*/
$lang['edit']['page']['title']                            = 'Edit Sending Domain of';
$lang['edit']['page']['authenticate_your_domain']         = 'Authenticate Your Domain';
$lang['edit']['page']['recheck']                          = 'Recheck';
$lang['edit']['page']['recheck_msg']                      = 'Button is disabled untill';
$lang['edit']['page']['domain_ownership_required']        = 'Domain Ownership Verification Required';
$lang['edit']['page']['domain_ownership_note']            = 'Before you can start using the sending domain, you`ll need to verify the domain`s ownership by one of the following method.';
$lang['edit']['page']['upload_file']                      = 'Upload a File';
$lang['edit']['page']['dns_record']                       = 'Add a DNS Record';
$lang['edit']['page']['download_and_upload_file']         = 'Download the file by clicking on the link below and upload to the root folder of';
$lang['edit']['page']['download_this_file']  			  = 'Download this file';
$lang['edit']['page']['access_publicly_url'] 			  = 'Upload to click.hh.com root folder so it gets accessible publicly via this UR';
$lang['edit']['page']['verify_link']         			  = 'Verify if this link is working';
$lang['edit']['page']['download_here']       			  = 'Download Here';
$lang['edit']['page']['add_txt_record']      			  = 'Add the following TXT record';
$lang['edit']['page']['host']                             = 'Host';
$lang['edit']['page']['type']                             = 'Type';
$lang['edit']['page']['value']                            = 'Value';
$lang['edit']['page']['button']['verify_domain']          = 'Verify Domain';
$lang['edit']['page']['dkim_auth']                        = 'DKIM Authentication';
$lang['edit']['page']['enable_dkim']                      = 'Sign Outgoing Emails';
$lang['edit']['page']['enable_mumara']                    = 'Once enabled, '.$siteTitle.' will be responsible to sign your email messages with a domain key. After enabling it, make sure that you add the public dns entry.';
$lang['edit']['page']['generate_dkim']['title']           = 'Generate Public and Private Domain Keys';
$lang['edit']['page']['generate_dkim']['description']     = 'Generate Public and Private Domain Keys';

$lang['edit']['page']['authenticate_title'] 			  = 'Authenticate your sending domain by setting up DKIM';
$lang['edit']['page']['authenticate_help1'] 			  = 'To add DNS entries, you’ll need to have an access to the dns zone for the domain';
$lang['edit']['page']['authenticate_help2'] 			  = 'Login to DNS zone and add the following entries.';

$lang['edit']['page']['regenerate_DKIM']    			  = 'Regenerate DKIM';
$lang['edit']['page']['regenerate_keys']    			  = 'Regenerate Keys';
$lang['edit']['page']['download_private_key']             = 'Download Private Key';

$lang['edit']['page']['custom_tracking_domain']           = 'Custom Tracking Domain';
$lang['edit']['page']['enable_custom_tracking_domain']    = 'Enable custom tracking domain';
$lang['edit']['page']['enable_custom_tracking_domain_msg'] = 'Setup custom tracking domain to brand the hyperlinks and images path for the outgoing emails.';

$lang['edit']['page']['cname']       						= 'CNAME';
$lang['edit']['page']['cname_help1'] 						= 'Login to the DNS zone of your domain';
$lang['edit']['page']['cname_help2'] 						= 'and add the following entry.';

$lang['edit']['page']['htaccess']       					= 'htaccess';
$lang['edit']['page']['htaccess_help1'] 					= 'Download the file, extract it and upload .htaccess file to the root folder of the domain';
$lang['edit']['page']['htaccess_help2'] 					= '(The method is more reliable when you don’t want to expose your primary domain IP in trace-route.)';

$lang['edit']['page']['htaccess_download_button'] 			= 'Click here to download .htaccess file.';

$lang['edit']['page']['dkim']        						= 'DKIM';
$lang['edit']['page']['public_key']  						= 'Public Key';
$lang['edit']['page']['private_key'] 						= 'Private Key';

$lang['edit']['page']['spf']                                = 'SPF';
$lang['edit']['page']['domain_key_identification_method']   = 'Domain Key Identification Method';
$lang['edit']['page']['dkim_info']                          = 'DomainKeys Identified Mail (DKIM) is an email authentication method designed to detect forged sender addresses in emails, (email spoofing), a technique often used in phishing and email spam.';

$lang['edit']['page']['generate_keys']              		= 'Generate Keys';
$lang['edit']['page']['setup_tracking_domain']      		= 'Setup Tracking Domain';
$lang['edit']['page']['setup_tracking_domain_help'] 		= 'This subdomain will be used for all hyperlinks and tracking pixel (if the campaign is set to track opens and clicks).';
$lang['edit']['page']['php_redirect']['note']              	= 'Note: ';
$lang['edit']['page']['php_redirect']['code']              	= 'allow_url_fopen';
$lang['edit']['page']['php_redirect']['message']              	= ' must be enabled in the PHP settings of your tracking domain';


/************* ** General ** *************/
$lang['activity_title']               = 'Sending Domain';
$lang['dkim_verified']                = 'DKIM Verified';
$lang['dkim_failed']                  = 'DKIM Failed';
$lang['tracking_domain_verified']     = 'Tracking Domain Verified';
$lang['tracking_domain_failed'] 	  = 'Tracking Domain Failed';
$lang['use_secure_url']         	  = 'Use Secure URL';
$lang['domain_status']         	  = 'Domain Status';
$lang['domain_verified']    		  = 'Domain verified.';
$lang['domain_unverified']  		  = 'Domain un-verified.';
$lang['modal_note']         		  = 'Primary domain needs to be propagated before you can add a sending domain';
$lang['set_primary_domain'] 		  = 'Set Primary Domain';
$lang['lists']              		  = 'Lists';
$lang['sending_nodes']      		  = 'Sending Nodes';
$lang['move_data']          		  = 'Move Data to';
$lang['select_domain']      		  = 'Select domain';
$lang['confirm_delete']     		  = 'Confirm Delete';

/************* ** Message ** *************/

$lang['message']['note']         = 'Sending domain appears as the sender’s domain when your recipients receive emails. E.g if a person receives an email from joseph@letscommunicate.com, the sending domain is letscommunicate.com.';
$lang['message']['keys_generates_successfully']         = 'keys have been generates successfully';
$lang['message']['domain_verified']                     = 'Domain has been verified';
$lang['message']['domain_not_verified']                 = 'Domain has not been verified';
$lang['message']['no_SPF_found']                        = 'No SPF found';
$lang['message']['domains_are_not_being_used']          = 'Domains that are not being used in sending nodes or lists have been successfully deleted';
$lang['message']['confirmDelete']                       = '<strong>:masking1_domain</strong> deleted successfully and data move to <strong>:masking2_domain</strong>';
$lang['message']['domain_already_linked']               = 'Domain :domain is already linked.';
$lang['message']['domain_already_exists']               = 'Domain :domain already exists';
$lang['message']['maximum_sending_domain_limit']        = 'You have used your "Maximum Sending Domain limit" of :limit';
$lang['message']['not_allowed_error']                   = 'You are not allowed to add this domain';
$lang['message']['successfully_updated']                = 'Successfully updated!';
$lang['message']['regenerate_keys']                     = 'Are you sure that you want to regenerate public and private keys?';
$lang['message']['alert']                               = 'Please enter domain key first';
$lang['message']['alert_confirmation']                  = 'Confirmation failed';
$lang['message']['problem_generate_key']                = 'There is problem to generate the keys!';
$lang['message']['congrats_domain_confirmed']           = 'Congrats! Domain is set as confirmed.';
$lang['message']['technical_error']                     = 'Technical Error!';
$lang['message']['tracking_domainnot_verifying']        = 'If you are sure that you have done the redirection steps correctly then <a href="https://school.mumara.com/training/why-your-tracking-domain-isnt-verifying/" target="_blank"><b>this article</b></a> may help you find the reason.';
$lang['message']['dns_alert_info']        = 'If you have recently updated the DNS records, it may take a few hours to propagate fully.';
$lang['message']['cname_resolve_msg1']        = 'The CNAME record was resolved successfully but your tracking domain may not still work as the DocumentRoot for :domain isn\'t pointing to the Mumara directory. Read <a href="https://school.mumara.com/training/why-your-tracking-domain-isnt-verifying/">this article</a> to learn more';
$lang['message']['cname_resolve_msg2']        = 'No valid SSL certificate is found on :domain, so tracking links will not work. Install an SSL certificate or turn off "Use Secure" switch at the top right';
$lang['assign']['to_other']  = 'You can re-assign the assets to another domain.';

$lang['create_blade']['host_txt_th']  = 'Host';
$lang['create_blade']['value_txt_th']  = 'Value';
$lang['create_blade']['type_txt_th']  = 'Type';
$lang['create_blade']['provider_txt_th']  = 'Provider';
$lang['create_blade']['status_txt_th']  = 'Status';
$lang['create_blade']['response_txt_th']  = 'Response';
$lang['create_blade']['small_priority']  = 'priority';
$lang['create_blade']['current_value_th']  = 'Current Value';
$lang['create_blade']['enter_value_th']  = 'Enter This Value';
$lang['create_blade']['txt_text_th']  = 'TXT';
$lang['create_blade']['domain_txt_th']  = 'Domain';
$lang['create_blade']['spf_record_domain_div']  = 'Add the following SPF record to your sending domain to make sure you qualify Sender Policy Framework standards authentication.';
$lang['create_blade']['custom_bounce_domain_label']  = 'Custom Bounce Domain';
$lang['create_blade']['download_php_file_action']  = 'Click here to download .php file.';
$lang['create_blade']['cloak_txt_div']  = 'Cloak';
$lang['create_blade']['download_file_th']  = 'Download File';
$lang['create_blade']['download_generated_php_file_div']  = 'Download the generated PHP file and place at the root folder of you tracking domain';
$lang['create_blade']['authentication_failed_span']  = 'Authentication Failed';
$lang['create_blade']['pending_authentication_span']  = 'Pending Authentication';
$lang['create_blade']['suspended_span']  = 'Suspended';
$lang['controller']['pending_span']  = 'Pending';
$lang['controller']['passed_span_txt']  = 'Passed';
$lang['create_blade']['mx_txt_div']  = 'MX';
$lang['index_blade']['select_domain_html']  = 'select a domain';
$lang['index_blade']['domain_limit_button']  = 'Domains Limit';

$lang['']['']  = '';
return $lang;