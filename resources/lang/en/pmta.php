<?php
include("variables.php");
/**
 * Created by Mumara Team
 * Date: 07/08/2020
 */
/*-------------- 1. Setup -> Sending Node -> PMTA ----------------*/

$lang['page']['title']                 = 'PowerMTA Integration';
$lang['page']['description']           = 'Integrate your PowerMTA server with '.$siteTitle.' and let '.$siteTitle.' handle everything for you.';

/*-------------- 1.1 Setup -> Sending Node -> PMTA -> add new ----------------*/
$lang['add_new']['page']['title']                         = 'PMTA Configuration';
$lang['edit']['page']['title']                            = 'Edit Power MTA Server';
$lang['add_new']['page']['description']                   = 'Add new PowerMTA servers for email sending.';

/************* ** PMTA Configuration Step ** *************/
$lang['add_new']['step1']['title']                        = 'PMTA Configuration';
$lang['add_new']['step1']['description']                  = 'PMTA Configuration';

$lang['add_new']['step1']['form']['heading']              = 'Connect to the PowerMTA web monitor';
$lang['add_new']['step1']['form']['description']          = 'Select your installed version of PowerMTA and insert your PowerMTA web monitor address in the correct format (e.g. 192.168.0.11:8080). Select the correct operator i.e. HTTP:// or HTTPS://. If you don\'t have a valid SSL installed on PowerMTA web monitor.';
$lang['add_new']['step1']['form']['protocol']             = 'Protocol';
$lang['add_new']['step1']['form']['pmta_access_url']      = 'PowerMTA Web Monitor Access URL';
$lang['add_new']['step1']['form']['pmta_access_url_help'] = 'PowerMTA Web Monitor Access URL';
$lang['add_new']['step1']['form']['pmta_access_url_note'] = 'e.g. 192.168.0.1:8080. Add this line at the top of your PowerMTA config file and reload (without quotes) \'http-access :ip Admin\'';
$lang['add_new']['step1']['form']['verify_help'] = 'Upon verifying the connectivity, if you get a failed status, it means the '.$siteTitle.' server has no access to your PowerMTA web monitor. To make it work, verify if you have added the '.$siteTitle.' server\'s IP to your PowerMTA config.';
$lang['add_new']['step1']['form']['failed_note'] = 'You can still continue to the next step in the case of unsuccessful connectivity as '.$siteTitle.' will still overwrite everything at the end.';

/************* ** Server Connection Step ** *************/
$lang['add_new']['step2']['title']                        = 'Server Connection';
$lang['add_new']['step2']['description']                  = 'Server Connection';

$lang['add_new']['step2']['form']['heading']              = 'Server Connection';
$lang['add_new']['step2']['form']['description']          = 'So now, let\'s connect with the server where you have PowerMTA installed.';
$lang['add_new']['step2']['form']['server_name']          = 'Server Name';
$lang['add_new']['step2']['form']['server_name_help']     = 'Friendly name of the server for your identification purpose';
$lang['add_new']['step2']['form']['server_ip']            = 'Server IP';
$lang['add_new']['step2']['form']['server_ip_help']       = 'The main IP address of the Server';
$lang['add_new']['step2']['form']['ssh_port']             = 'SSH Port';
$lang['add_new']['step2']['form']['ssh_port_help']        = 'The port number to connect with SSH';
$lang['add_new']['step2']['form']['username']             = 'Username';
$lang['add_new']['step2']['form']['username_help']        = 'The username of the server (i.e. root)';
$lang['add_new']['step2']['form']['password']             = 'Password';
$lang['add_new']['step2']['form']['password_help']        = 'The password of the user';
$lang['add_new']['step2']['form']['operating_system']     = 'Operating System';
$lang['add_new']['step2']['form']['operating_system_help']= 'Select the operating system installed on this server';
$lang['add_new']['step2']['form']['centos6']     		  = 'CentOS 6.x';
$lang['add_new']['step2']['form']['centos7']     		  = 'CentOS 7.x';
$lang['add_new']['step2']['form']['ubuntu']      		  = 'Ubuntu';
$lang['add_new']['step2']['form']['step2_help'] 		  = 'Verifying the connection to your server is mandatory here. If the server connection fails, '.$siteTitle.' will not be able to put up the configuration file and create necessary folders';

/************* ** SMTP Settings Step ** *************/
$lang['add_new']['step3']['title']                        = 'SMTP Settings';
$lang['add_new']['step3']['description']                  = 'Configure the SMTP settings that your Nodes will be connected with.';

$lang['add_new']['step3']['form']['heading']              = 'SMTP Settings';
$lang['add_new']['step3']['form']['description']          = 'Configure the SMTP settings that your Nodes will be connected with.';
$lang['add_new']['step3']['form']['host_help'] 			  = 'The hostname of the SMTP(s) that are being added as Sending Nodes.';
$lang['add_new']['step3']['form']['host_suggestion'] 	  = 'This is a suggested SMTP host. You can change it according to your requirement.';
$lang['add_new']['step3']['form']['port_help'] 			  = 'Port number of the SMTP connection that you want to be.';
$lang['add_new']['step3']['form']['encryption'] 		  = 'Mail Encryption';
$lang['add_new']['step3']['form']['encryption_help'] 	  = 'Set it to None if you don\'t want PowerMTA to encrypt your outgoing emails.';

/************* ** PMTA Settings Step ** *************/
$lang['add_new']['step4']['title']                        			  = 'PMTA Settings';
$lang['add_new']['step4']['description']                  			  = 'PMTA Settings';

$lang['add_new']['step4']['form']['heading']              			  = 'PowerMTA Settings';
$lang['add_new']['step4']['form']['description']          			  = 'Setup PowerMTA general and required settings by filling up the fields accordingly. We have pre-filled the default optimized values, just modify it if you really know what you are doing.';
$lang['add_new']['step4']['form']['physical_path']    			      = 'Physical Path';
$lang['add_new']['step4']['form']['physical_path_help']    			  = 'The installed location of the PowerMTA';
$lang['add_new']['step4']['form']['management_port']      			  = 'Management Port';
$lang['add_new']['step4']['form']['management_port_help']      		  = 'The PowerMTA management port for the web monitor';
$lang['add_new']['step4']['form']['admin_ips']            			  = 'Admin IPs';
$lang['add_new']['step4']['form']['admin_ips_help']       			  = 'IP addresses that should be given admin access to the PowerMTA web monitor.';
$lang['add_new']['step4']['form']['log_file']                         = 'Log File';
$lang['add_new']['step4']['form']['log_file_help']                    = 'The log file and the location to be stored at.';
$lang['add_new']['step4']['form']['log_rotation']                     = 'Log Rotation';
$lang['add_new']['step4']['form']['log_rotation_help']                = 'Specifies the number of files to keep when rotating the logging files.';
$lang['add_new']['step4']['form']['accounting_files']                 = 'Accounting Files';
$lang['add_new']['step4']['form']['accounting_files_help']            = 'The name of the accounting files and the physical location to be stored at.';
$lang['add_new']['step4']['form']['account_files_rotation']           = 'Accounting Files Rotation';
$lang['add_new']['step4']['form']['account_files_rotation_help']      = 'Delete accounting files after a specific duration';
$lang['add_new']['step4']['form']['diag_files']                       = 'Diag Files';
$lang['add_new']['step4']['form']['diag_files_help']                  = 'The name of the accounting files and the physical location to be stored at.';
$lang['add_new']['step4']['form']['diag_files_rotation']              = 'Diag Files Rotation';
$lang['add_new']['step4']['form']['diag_files_rotation_help']         = 'Delete diag files after a specific duration';
$lang['add_new']['step4']['form']['spool_path']                       = 'Spool Path';
$lang['add_new']['step4']['form']['spool_path_help']                  = 'Define the location of the spool files where PowerMTA will queue the messages for delivery';
$lang['add_new']['step4']['form']['domain_keys_path']                 = 'Domain-Keys Path';
$lang['add_new']['step4']['form']['domain_keys_path_help']            = 'The physical location of the folder where the private domain-keys will be stored';
$lang['add_new']['step4']['form']['dkim_selector']                    = 'DKIM Selector';
$lang['add_new']['step4']['form']['dkim_selector_help']               = 'The default selector/prefix of the domain keys (e.g selector._domainkey.domain.com)';
$lang['add_new']['step4']['form']['tracking_domain_prefix']           = 'Tracking Domain Prefix';
$lang['add_new']['step4']['form']['tracking_domain_prefix_help']      = 'The default subdomain/prefix of the sending domain that will be used for tracking purposes.';
$lang['add_new']['step4']['form']['vmta_prefix']                      = 'VMTA Prefix';
$lang['add_new']['step4']['form']['vmta_prefix_help']                 = 'The prefix of the VMTA being created that will be incremented sequentially.';
$lang['add_new']['step4']['form']['authentications']         		  = 'Authentications';
$lang['add_new']['step4']['form']['dkim_fallback_domain']    		  = 'DKIM Fallback Domain';
$lang['add_new']['step4']['form']['dkim_fallback_domain_help']    	  = 'The default DKIM domain that will be replaced as a signatory domain upon DKIM failure of the sending domain.';
$lang['add_new']['step4']['form']['domain_key_size_in_bits'] 		  = 'Domain Key Size in Bits';
$lang['add_new']['step4']['form']['domain_key_size_in_bits_help'] 	  = 'The size of the domain key in bits that '.$siteTitle.' will generate for your sending domains.';

/************* ** IPs and Domains Step ** *************/
$lang['add_new']['step5']['title']                                    = 'IPs and Domains';
$lang['add_new']['step5']['description']                              = 'IPs and Domains';

$lang['add_new']['step5']['form']['heading']                          = 'IPs and Domains';
$lang['add_new']['step5']['form']['description']                      = 'Define the IP addresses and the sending domains that will be used for the email sending purposes. '.$siteTitle.' will generate the best combination of IP addresses over the domains on the next page that you\'ll have the ability to rearrange according to your requirement (if any).';
$lang['add_new']['step5']['form']['ip_addresses']			          = 'IP Addresses';
$lang['add_new']['step5']['form']['ip_addresses_help']			      = 'The IP addresses added in your server that you want to get involved in email sending purposes.';
$lang['add_new']['step5']['form']['sending_domains']			      = 'Sending Domains';
$lang['add_new']['step5']['form']['sending_domains_help']			  = 'The domains that will be responsible to relay emails.';
$lang['add_new']['step5']['form']['enter_a_subnet']			          = 'Enter a Subnet';
$lang['add_new']['step5']['form']['enter_a_subnet_help']			  = 'If you have a full subnet, add it in an easy way.';

/************* ** IPs to Domain Mapping Step ** *************/
$lang['add_new']['step6']['title']                        		      = 'IPs to Domain Mapping';
$lang['add_new']['step6']['description']                  		      = 'IPs to Domain Mapping';
		      
$lang['add_new']['step6']['form']['heading']              		      = 'IPs to Domains Mapping';
$lang['add_new']['step6']['form']['description']          		      = 'Drag the IP address to any domain panel to be used under respective group. We have however divided the IP addresses equally for the best configuration. You have an option to create a single SMTP for all IP addresses within the group, or to create an individual SMTP for every IP address.';
$lang['add_new']['step6']['form']['one_two_one'] 				  = 'One SMTP Account Per IP';
$lang['add_new']['step6']['form']['one_two_all'] 				  = 'One SMTP Account For All IP(s)';
$lang['add_new']['step6']['form']['group_name_help'] 			  = 'The group name under which these SMTPs will be sorted';
$lang['add_new']['step6']['form']['from_name_help'] 			  = 'The sender\'s name that the email will appear to be sent from (if the sender-info is set to be fetched from sending nodes)';
$lang['add_new']['step6']['form']['from_email_help'] 			  = 'The sender\'s email that will appear in email headers (if the sender-info is set to be fetched from sending nodes)';
$lang['add_new']['step6']['form']['reply_email_help'] 			  = 'The email address responsible to receive replies if the emails were sent from this Senindg Node';
$lang['add_new']['step6']['form']['bounce_email_help'] 			  = 'The email address where the delivery status notifications of the failed messages will be sent by the MTA';
$lang['add_new']['step6']['form']['tracking_domain'] 			  = 'Tracking Domain';
$lang['add_new']['step6']['form']['tracking_domain_help'] 		  = 'The sub-domain that will mask/brand the hyperlinks and image source URLs in the email content body.';

/************* ** Configure Bounce Mailboxes Step ** *************/
$lang['add_new']['step7']['title']                                    = 'Configure Bounce Mailboxes';
$lang['add_new']['step7']['description']                              = 'Configure Bounce Mailboxes';

$lang['add_new']['step7']['form']['heading']                          = 'Configure Bounce Mailboxes';
$lang['add_new']['step7']['form']['description']                      = 'Process delivery reports from PowerMTA accounting files';

$lang['add_new']['step7']['form']['host_help'] 			              = 'Hostname of the mail server where this email address is hosted';
$lang['add_new']['step7']['form']['port_help'] 			              = 'Port number of the mail server to make POP/IMAP connection';
$lang['add_new']['step7']['form']['username_help'] 	                  = 'Username of the mailbox';
$lang['add_new']['step7']['form']['password_help'] 		              = 'Password of the mailbox';
$lang['add_new']['step7']['form']['encryption'] 		              = 'Encryption';
$lang['add_new']['step7']['form']['encryption_help'] 	              = 'Choose the encryption method if your mailserver needs the connection to be encrypted';
$lang['add_new']['step7']['form']['method'] 	                      = 'Method';
$lang['add_new']['step7']['form']['method_help'] 	                  = 'Select from POP/IMAP (as advised by the mailbox provider)';
$lang['add_new']['step7']['form']['verify_connection_help'] 	      = 'It verifies the connection with your mail server before processing ahead';


/************* ** Setup Sending Domains Step ** *************/
$lang['add_new']['step8']['title']                        = 'Authenticate Sending/Tracking Domains';
$lang['add_new']['step8']['description']                  = 'Authenticate Sending/Tracking Domains';

$lang['add_new']['step8']['form']['heading']              = 'Authenticate Sending & Tracking Domains';
$lang['add_new']['step8']['form']['description']          = ''.$siteTitle.' generates Forward DNS, Reverse DNS, CNAME, and Domain Keys to get your sending domains authenticated. Expand the toggle(s) to get the values of the DNS entries for the sending domains. Moreover, you can click on the Download button and update them later.';


/************* ** PMTA Configuration Step ** *************/
$lang['add_new']['step9']['title']                        = 'Review of PowerMTA Configuration';
$lang['add_new']['step9']['description']                  = 'PMTA Configuration';

$lang['add_new']['step9']['form']['heading']              = 'Review of PowerMTA Configuration';
$lang['add_new']['step9']['form']['description']          = 'It shows the configuration file that has been generated as per your inputs. If you want to tweak anything in the configuration file, you can do it in this step but make sure that you really know what you are doing.';


/************* ** Finished Step ** *************/
$lang['add_new']['step10']['title']                        				= 'Setting up PowerMTA';
$lang['add_new']['step10']['description']                  				= 'Setting up PowerMTA';
				
// $lang['add_new']['step10']['form']['heading']              				= 'Hurrah... PowerMTA Setup is Complete Now!';
$lang['add_new']['step10']['form']['heading']              				= 'Configuring and integrating with PowerMTA Server';
$lang['add_new']['step10']['form']['description']          				= 'The PowerMTA server is being configured and integrated with '.$siteTitle.'';
$lang['add_new']['step10']['form']['connecting_to_pmta']   				= 'Connecting to PowerMTA web monitor';
$lang['add_new']['step10']['form']['connecting_to_server'] 				= 'Connecting to the server';
$lang['add_new']['step10']['form']['checking_required_folder']          = 'Checking for required folders';
$lang['add_new']['step10']['form']['backup_pmta_config']                = 'Backing up current PowerMTA configuration';
$lang['add_new']['step10']['form']['configure_pmta']                    = 'Configuring PowerMTA';
$lang['add_new']['step10']['form']['verify_private_domain_key']         = 'Verifying private domain key';
$lang['add_new']['step10']['form']['configure_bounce_handler']          = 'Configuring bounce handler';
$lang['add_new']['step10']['form']['configure_sending_domains']         = 'Configuring sending domains';
$lang['add_new']['step10']['form']['configure_sending_nodes']           = 'Configuring sending nodes';
$lang['add_new']['step10']['form']['starting_pmta']                      = 'Starting PowerMTA';
$lang['add_new']['step10']['form']['restart_pmta']                      = 'Restarting PowerMTA web monitor';
$lang['add_new']['step10']['form']['verifying_connections']             = 'Verifying connections';
$lang['add_new']['step10']['form']['re_check']                          = 'Re-check';
/************* ** PMTA View Config ** *************/
$lang['config']['hvaving_trouble']='Having trouble?';
$lang['config']['view_this_topic']='View this topic';
$lang['config']['original']='Original';
$lang['config']['table_column']['server_name'] = 'Server Name';
$lang['config']['table_column']['smtp_host'] = 'SMTP Host';
$lang['config']['table_column']['smtp_port'] = 'SMTP Port';
$lang['config']['table_column']['server_ip'] = 'Server IP';
$lang['config']['table_column']['pmta_port'] = 'PowerMTA Port';
$lang['config']['buttons']['reload_pmta']='Reload PMTA';
$lang['config']['buttons']['restart_pmta']='Restart PMTA';
$lang['config']['buttons']['restart_pmta_console']='Restart PMTA HTTP Console';
$lang['config']['buttons']['reboot_server']='Reboot Server';
/************* ** Message ** *************/
$lang['message']['verifying'] = 'Verifying';
$lang['message']['propagated'] = 'Primary domain needs to be propagated before you can add PowerMTA';
$lang['message']['no_key_found'] = 'No key found';
$lang['message']['server_not_connected'] = 'Error: Server not connected';
$lang['message']['config_updated_successfully'] = 'Config updated successfully';
$lang['message']['Unable_to_connect'] = 'Unable to connect';
$lang['message']['login_failed'] = 'Login Failed';
$lang['message']['login_successful'] = 'Login Successful';
$lang['message']['connection_verified'] = 'Connection Verified';
$lang['message']['connected_with_web_monitor'] = 'Connected: Running';
$lang['message']['not_connected_with_web_monitor'] = 'Connected: Stopped';
$lang['message']['pmta_reloaded'] = 'PowerMTA Reloaded';
$lang['message']['pmta_restarted'] = 'PowerMTA Restarted';
$lang['message']['pmta_web_monitor_restarted'] = 'PowerMTA web monitor Restarted';
$lang['message']['server_restarted'] = 'Server Restarted';
$lang['message']['mysql_restarted'] = 'Mysql Restarted';
$lang['message']['invalid_command'] = 'Invalid Command.';
/************* ** General ** *************/
$lang['activity_title'] = 'Spintag';
$lang['reverse_dsn_ptr'] = 'Reverse DNS (PTR)';
$lang['integrations'] = 'Integrations';
$lang['title'] = 'PowerMTA';
$lang['set_primary_domain'] = 'Set Primary Domain';
$lang['enter_subnet'] = 'Enter Subnet';
$lang['congratulations'] = 'Congratulations!';
$lang['congratulations_help'] = 'Your Power MTA Server has been successfully created!';
$lang['verify_connection'] = 'Verify Connection';
$lang['view_configuration'] = 'View Configuration';
$lang['download_configurations'] = 'Download Configuration';
$lang['configuration_for'] = 'Configuration for :server_name';
$lang['server_connection'] = 'Server Connection';
$lang['domains_to_add'] = 'Domains to Add';
$lang['add_masking_domains'] = 'Add Masking Domains';
$lang['add_bounce_emails'] = 'Add Bounce Emails';
$lang['add_smtp'] = 'Add SMPT/IPs';
$lang['accounts_added'] = 'IP/SMTP Accounts will be added';
$lang['fdns_entries'] = 'FDNS/RDNS entries will be exported as CSV';

$lang['integration_controller']['edit_configuration_action'] = 'Edit Configurations';
$lang['integration_controller']['unauthorized_msg_span'] = 'Unauthorized';
$lang['pmta_create_blade']['download_records_action'] = 'Download Records';
$lang['pmta_create_blade']['version_label'] = 'Version';

$lang['pmta_blade']['created_at_th'] = 'Created At';

$lang['integration_controller'][''] = '';
return $lang;