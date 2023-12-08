<?php
include("variables.php");
/**
 * Created by Mumara Team
 * Date: 06/25/2020
 */
/*-------------- 1. Setup -> Sending Nodes ----------------*/

$lang['page']['title']                             = 'Sending Nodes';
$lang['page']['description']                       = 'Sending Node (also called MTA) is the mail carrier that carries the email from '.$siteTitle.' and delivers it to the recipient\'s mail server. There are several types of sending nodes integrated with '.$siteTitle.'';

$lang['page']['tab1']['title']                     = 'Nodes';
$lang['page']['tab1']['filter']['all']             = 'All';
$lang['page']['tab1']['filter']['smtp']            = 'SMTP';
$lang['page']['tab1']['filter']['sendgrid']        = 'Sendgrid';
$lang['page']['tab1']['filter']['mailgun']         = 'Mailgun';

/************* ** Sending Nodes tab1 datatable ** *************/
$lang['tab1']['table_headings']['name']            = 'Name';
$lang['tab1']['table_headings']['group']           = 'Group';
$lang['tab1']['table_headings']['type']            = 'Type';
$lang['tab1']['table_headings']['from_name']       = 'From Name';
$lang['tab1']['table_headings']['reply_email']     = 'Reply Email';
$lang['tab1']['table_headings']['status']          = 'Status';
$lang['tab1']['table_headings']['added_on']        = $created_on;
$lang['tab1']['table_headings']['actions']         = 'Actions';

$lang['page']['tab2']['title']                     = 'Servers';
/************* ** Sending Nodes tab2 datatable ** *************/
$lang['tab2']['table_headings']['sr']              = 'Sr.';
$lang['tab2']['table_headings']['server_name']     = 'Server Name';
$lang['tab2']['table_headings']['host']            = 'Host';
$lang['tab2']['table_headings']['server_ip']       = 'Server IP';
$lang['tab2']['table_headings']['added_on']        = $created_on;
$lang['tab2']['table_headings']['actions']         = 'Actions';

$lang['tab2']['Edit_Configuration']                = 'Edit Configuration';
$lang['tab2']['Server_Name']                       = 'Server Name';
$lang['tab2']['Server_IP']                         = 'Server IP';
$lang['tab2']['Root_User']                         = 'Root User';
$lang['tab2']['Password']                          = 'Password';
$lang['tab2']['SSH_Port']                          = 'SSH Port';
$lang['tab2']['Protocol']                          = 'Protocol';
$lang['tab2']['http']                              = 'http';
$lang['tab2']['https']                             = 'https';

/************* ** Sending Nodes Test Connection ** *************/
$lang['test_connection']['smtp_name']  					    = 'SMTP Name';
$lang['test_connection']['group_name'] 					    = 'Group Name';
$lang['test_connection']['connectivity_desc'] 			    = 'This process will start testing connectivity of the selected sending nodes. Please select from the following actions if necessary.'; 
$lang['test_connection']['connection']                      = 'Test Connections';
$lang['test_connection']['set_successful']                  = 'Set successful Sending Nodes as active';
$lang['test_connection']['set_unsuccessful']                = 'Set unsuccessful Sending Nodes as inactive';
$lang['test_connection']['note']                            = 'Please note! Test connection will only work for simple SMTPs. If you want to test other sending nodes you have to send a test email to get them verified.';
$lang['test_connection']['start']                           = 'Start';
$lang['test_connection']['table_headings']['name']          = 'Name';
$lang['test_connection']['table_headings']['type']          = 'Type';
$lang['test_connection']['download_results']                = 'Download Results';
/************* ** Sending Nodes Import ** *************/
$lang['import']['modal']['title']                           = 'Import Smpts';
$lang['import']['modal']['smtp_type']                 		= 'SMTP Type';
$lang['import']['modal']['download_sample']                 = 'Download sample';
$lang['import']['modal']['table_headings']['sr']            = 'Sr.';
$lang['import']['modal']['table_headings']['name']          = 'Name';
$lang['import']['modal']['table_headings']['import_status'] = 'Import Status';
$lang['import']['modal']['table_headings']['errors']        = 'Errors & Notices';
$lang['import']['modal']['missing_column_error']            = "Missing :name column";
$lang['import']['modal']['missing_value_error']             = "<b>Skipped (Missing Value):</b> :label";
$lang['import']['modal']['wrong_format_error']              = "<b>Skipped (Wrong Format):</b> :label";
$lang['import']['modal']['domain_missing_error']            = "<b>Skipped:</b> The domain doesn't exist in your Sending Domains";
$lang['import']['modal']['tracking_missing_error']            = "<b>Skipped:</b> The Tracking domain doesn't exist in your Sending Domains";
$lang['import']['modal']['bounce_email_missing_error']      = "<b>Skipped:</b> The bounce email doesn't exist in your Bounce Addresses";
$lang['import']['modal']['group_name_missing_error']        = "<b>Notice:</b> Group name doesn't exit, so adding this as a new group";
$lang['import']['modal']['group_value_missing_error']       = "<b>Notice:</b> Missing value for group name, so adding to the unsorted group";
$lang['import']['modal']['notice_error']                    = '<b>Notice:</b> Missing value for :column, so updating to the default value <b>:default</b>';
/************* ** Sending Nodes -> All Nodes ************/
$lang['all']['page']['title']                    		    = 'Add Sending Node';
$lang['all']['page']['description']              		    = 'Select a Sending Node Type';	
$lang['all']['page']['select_provider']          		    = 'Select Provider';
$lang['all']['page']['upgrade']                  		    = 'Upgrade';
$lang['all']['page']['upgrade_pkg_details']      		    = 'You cannot do this action. Please upgrade your package and feel free to use advance features.';
/************* ** Sending Nodes -> Add new ** *************/
$lang['add_new']['page']['title']                           = 'Add a Sending Node';
$lang['edit']['page']['title']                              = 'Edit a Sending Node';
$lang['add_new']['page']['description']                     = 'Provide the required details and connect with your sending server.';
// Account Tab
$lang['add_new']['account_tab']['title']                    = 'Account';
$lang['add_new']['account_tab']['description']              = 'Account';
$lang['add_new']['account_tab']['form']['heading']          = 'Node Details';
$lang['add_new']['account_tab']['form']['description']      = 'General details and sender information of the sending node.';
$lang['add_new']['form']['status_help']                     = '<p><strong>Active:</strong> Active sending nodes are ready to relay the emails<br>
<strong>Inactive:</strong> Inactive sending nodes don\'t appear in the scheduling process</p>';
$lang['add_new']['form']['node_name']                       = 'Node Name';
$lang['add_new']['form']['node_name_help']                  = 'Friendly name of the sending node for identification purpose';
$lang['add_new']['form']['mail_encoding']                   = 'Mail Encoding';
$lang['add_new']['form']['mail_encoding_help']              = 'Select the encoding of the outgoing messages';
$lang['add_new']['form']['quoted_printable']                = 'Quoted Printable';
$lang['add_new']['form']['8bit']   							= '8 Bit';
$lang['add_new']['form']['base64'] 							= 'Base64';
$lang['add_new']['form']['binary'] 							= 'Binary';
// Sender Tab
$lang['add_new']['sender_tab']['title']           						   = 'Sender';
$lang['add_new']['sender_tab']['description']     						   = 'Sender';
$lang['add_new']['sender_tab']['form']['heading'] 						   = 'Connection Details';
$lang['add_new']['sender_tab']['form']['description'] 		               = 'Select a provider and input the authentication details.';
$lang['add_new']['form']['sender_name']               		               = 'Sender Name';
$lang['add_new']['form']['sender_name_help']          		               = 'Name that the email will appear to be sent from.';
$lang['add_new']['form']['sender_email']              		               = 'Sender Email';
$lang['add_new']['form']['sender_email_help']         		               = 'The email will appear to be sent from this email address at the recipient\'s server. (Responsible for DKIM Authentication)';
$lang['add_new']['form']['choose_bounce_email']       		               = 'Choose a Bounce Email';
$lang['add_new']['form']['tracking_domain']        						   = 'Tracking Domain';
$lang['add_new']['form']['choose_tracking_domain'] 						   = 'Choose Tracking Domain';
$lang['add_new']['form']['tracking_domain_help']    					   = 'The domain/subdomain that appears in all hyperlinks and images.';
// Connectivity Tab
$lang['add_new']['connectivity_tab']['title']       					   = 'Connectivity';
$lang['add_new']['connectivity_tab']['description'] 					   = 'Connectivity';
$lang['add_new']['form']['host']                                           = 'SMTP Host';
$lang['add_new']['form']['host_help']                                      = 'Hostname of the SMTP server to connect with';
$lang['add_new']['form']['username_help']                                  = 'Username of the SMTP';
$lang['add_new']['form']['password_help']                                  = 'Password of the SMTP';
$lang['add_new']['form']['port']                                           = 'Port';
$lang['add_new']['form']['port_help']       							   = 'Port number of the SMTP server to connect with';
$lang['add_new']['form']['encryption']      							   = 'Encryption Type';
$lang['add_new']['form']['encryption_help'] 							   = '<td>It\'s the encryption of the email message to protect the content of the email from being read by entities other than the original recipients.<br><br>
<span style=\'font-size:14px\'><strong>None:</strong> The SMTP server doesn\'t require any encryption<br><strong>TLS:</strong>&nbsp;TLS is a cryptographic protocol that provides end-to-end communications security over networks and is widely used for internet communications and online transactions.<br><strong>SSL:</strong>&nbsp;It is a layer over the plaintext communication, allowing email servers to upgrade their plaintext communication to encrypted communication.</span></td>';
$lang['add_new']['form']['validate']    								    = 'Validate';
$lang['add_new']['form']['show_logs']   								    = 'Show Logs';
// Settings Tab
$lang['add_new']['settings_tab']['title']                                   = 'Settings';
$lang['add_new']['settings_tab']['description']                             = 'Settings';
$lang['add_new']['settings_tab']['form']['heading']                         = 'Additional Settings';
$lang['add_new']['settings_tab']['form']['description']                     ='Find out the additional options below and set if needed.';
$lang['add_new']['settings_tab']['form']['note']                            ='Note: Spaces and special characters are not supported except hyphens (-)';
$lang['add_new']['form']['additional_headers']                              ='Additional Headers';
$lang['add_new']['form']['additional_headers_help']                         ='<ul><li><strong>Header:</strong>&nbsp;Header to be added to every email going out</li><li><strong>Value:</strong>&nbsp;The value of the header to embed. (supports custom/additional/system fields, spintags and dynamic tags)</li></ul>';


/************* **Connectivity** *************/
$lang['method']               							= 'Method';
$lang['signin_to_go_security_page']  					= 'Sign in and go to your Account security page.';
$lang['turn_on_verification'] 							= 'Turn on Two-Step Verification if it`s not.';
$lang['turn_off_verification']       					= 'Turn off Two-Step Verification if it`s not.';
$lang['generate_app_password']       					= 'Click Generate app password or Manage app passwords';
$lang['select_other_app']            					= 'Select \'other app\' from the drop down menu, write \''.$siteTitle.'\' and click Generate.';
$lang['app_password_as_smtp']        					= 'Use this app password as SMTP Password.';
$lang['method_two']                  					= 'Method 2';
$lang['using_app_password']       						= 'Using App Password';
$lang['enable_allow_apps']        						= 'Enable Allow apps that use less secure sign-in.';
$lang['process_delivery_reports'] 						= 'Process Delivery Reports';
$lang['process_details_title']    						= 'Configuring :app Webhooks'; 
$lang['process_delivery_reports_help'] 					= 'Enable it if you want to process delivery status reports for all recipients';
$lang['api_key_link']  									= 'Not sure where to find API Key?';
$lang['api_key']       									= 'API Key';
$lang['get_api_keys']  									= 'Obtaining :app API Key';
$lang['api_key_help']  									= 'Insert your :app API key';
$lang['email_address'] 									= 'Email Address';
$lang['email_address_help'] 							= 'Email Address';
$lang['domain_name']    								= 'Domain Name';
$lang['domain_name_eg'] 								= 'e.g mg.mydomain.com';
/************* ** Sendgrid Connectivity** *************/
$lang['connectivity']['sendgrid']['title']                                          ='Sendgrid Integration';
$lang['connectivity']['sendgrid']['description']                                    ='Connect your Sendgrid account by filling up the required fields below.';
$lang['connectivity']['sendgrid']['form']['to_your_sendgrid_account']               = 'to your SendGrid Account';
$lang['connectivity']['sendgrid']['form']['navigate_to_settings']                   = 'Navigate to Settings';
$lang['connectivity']['sendgrid']['form']['create_api_key']                         = 'Click on \'Create API Key?\' button and copy the key';
$lang['connectivity']['sendgrid']['form']['api_key']                                = 'Click on \'Create API Key?\' button and copy the key';
$lang['connectivity']['sendgrid']['form']['webhooks_recommended']                   = 'Webhooks (Recommended)';
$lang['connectivity']['sendgrid']['form']['webhooks_recommended_help']              = '<p><strong>Webbooks:</strong>&nbsp;Use webhooks to postback delivery status notifications to '.$siteTitle.'.</p>';
$lang['connectivity']['sendgrid']['form']['navigate_to_settings']                   = 'Navigate to Settings';
$lang['connectivity']['sendgrid']['form']['mail_settings'] 							= 'Mail Settings';
$lang['connectivity']['sendgrid']['form']['turn_on_notification']                   = 'Turn on Event Notification, select from the actions you want to get processed and paste the callback URL you see in '.$siteTitle.'';
$lang['connectivity']['sendgrid']['form']['click_copy_button'] 						= 'Click on button to copy URL';

/************* ** Mailgun Connectivity** *************/
$lang['connectivity']['mailgun']['title']                    ='Mailgun Integration';
$lang['connectivity']['mailgun']['description']              ='Connect your Mailgun account by filling up the required fields below.';
$lang['connectivity']['mailgun']['api_key_find_help']        ="
<div class='api_key_find_help'>
<p>Inside the <b>Mailgun Control Panel</b> (options displayed down the left-hand side on a dark column), the API keys appear on only one page.  To view the API keys, use the following instructions:</p>
<ol>
    <li>Click on <b>Settings</b> on the left-hand side of your <a href='https://app.mailgun.com/app/dashboard' target='_blank'>Mailgun dashboard</a></li>
    <li>Select <b>Security & Users</b> from the menu below on the left-hand side</li>
    <li>Click on the <b>API security</b> tab</li>
    <li>On the following page, under the <b>API Keys</b> section, you'll see both your Private and Public API keys</li>
    <li>Click on the <b>eye</b> icon to make the Private API key visible and copy it</li>
</ol></div>";
$lang['connectivity']['mailgun']['api_configure_help']       ="
<div class='api_key_find_help'>
<p>Configure Mailgun webhooks by following the steps below to process the delivery status notifications for the outgoing message</p>
<ol>
    <li>Click on <b>Sending </b> on the left-hand side of your <a href='https://app.mailgun.com/app/dashboard' target='_blank'>Mailgun dashboard</a></li>
    <li>Click on <b>Webhooks</b> and select the domain from the top dropdown</li>
    <li>Click on <b>Add Webhook</b> button</li>
    <li>Select from the <b>Event Types</b> and paste the <b>Callback</b> URL you see in ".$siteTitle." and press <b>Create Webhook</b> button</li>
</ol></div>";

/************* ** Amazon Connectivity** *************/
$lang['connectivity']['amazon']['title']      				  		 ='Amazon Integration';
$lang['connectivity']['amazon']['description']				  		 ='Connect your Amazon account by filling up the required fields below.';
$lang['connectivity']['amazon']['form']['access_key_id']      		 = 'Access Key ID';
$lang['connectivity']['amazon']['form']['secret_access_key']  		 = 'Secret Access Key';
$lang['connectivity']['amazon']['form']['region']['title']    		 = 'Region';
$lang['connectivity']['amazon']['form']['region']['opt1']     		 = 'US East (Ohio)us-east-2';
$lang['connectivity']['amazon']['form']['region']['opt2']     		 = 'US East (N. Virginia)';
$lang['connectivity']['amazon']['form']['region']['opt3']     		 = 'US West (N. California)';
$lang['connectivity']['amazon']['form']['region']['opt4']     		 = 'US West (Oregon)';
$lang['connectivity']['amazon']['form']['region']['opt5']     		 = 'Asia Pacific (Mumbai)';
$lang['connectivity']['amazon']['form']['region']['opt6']     		 = 'Asia Pacific (Osaka-Local)**';
$lang['connectivity']['amazon']['form']['region']['opt7']     		 = 'Asia Pacific (Seoul)';
$lang['connectivity']['amazon']['form']['region']['opt8']     		 = 'Asia Pacific (Singapore)';
$lang['connectivity']['amazon']['form']['region']['opt9']     		 = 'Asia Pacific (Sydney)';
$lang['connectivity']['amazon']['form']['region']['opt10']    		 = 'Asia Pacific (Tokyo)';
$lang['connectivity']['amazon']['form']['region']['opt11']    		 = 'Canada (Central)';
$lang['connectivity']['amazon']['form']['region']['opt12']    		 = 'China (Beijing)';
$lang['connectivity']['amazon']['form']['region']['opt13']    		 = 'China (Ningxia)';
$lang['connectivity']['amazon']['form']['region']['opt14']    		 = 'EU (Frankfurt)';
$lang['connectivity']['amazon']['form']['region']['opt15']    		 = 'EU (Ireland)';
$lang['connectivity']['amazon']['form']['region']['opt16']    		 = 'EU (London)';
$lang['connectivity']['amazon']['form']['region']['opt17']    		 = 'EU (Paris)';
$lang['connectivity']['amazon']['form']['region']['opt18']    		 = 'EU (Stockholm)';
$lang['connectivity']['amazon']['form']['region']['opt19']    		 = 'South America (São Paulo)';
$lang['connectivity']['amazon']['form']['get_api_keys']       		 = 'Obtaining Amazon SES API Credentials';
$lang['connectivity']['amazon']['form']['how_to_get_api_keys']       = "
<p>Follow the steps below to obtain Amazon SES API Credentials to connect it with ".$siteTitle.".<br>&nbsp;</p>
<ol>
<li><strong><a href='https://console.aws.amazon.com/console/home' target='_blank'>Login</a></strong>&nbsp;to <strong>Amazon AWS Console</strong></li>
<li>Click on your Name in the top navigation and navigate to&nbsp;<strong><a href='https://console.aws.amazon.com/iam/home?#/security_credential' target='_blank'>My Security Credentials</a></strong></li>
<li>Click on <strong>Users</strong> and <strong>Add New</strong></li>
<li>Write a <strong>Username</strong>, choose access type as <strong>Programmatic Access</strong> and click Next.</li>
<li>Select <strong>\"Attach existing policies directly\"</strong> and select <strong>\"AmazonSESFullAccess\"</strong> from the list</li>
<li>Click next and then click <strong>Next: Review</strong></li>
<li>Click <strong>Create User</strong> and copy the <strong>Access Key ID</strong> and <strong>Secret Access Key</strong>.</li>
</ol>
";
$lang['connectivity']['amazon']['form']['simple_notification_service']        = 'Simple Notification Service (SNS)';
$lang['connectivity']['amazon']['form']['process_delivery_reports_using_sns'] = 'Configuring Simple Notification Service (SNS) in Amazon';
$lang['connectivity']['amazon']['form']['configure_sns']                      = '<ol>
<li><strong><a href="https://console.aws.amazon.com/console/home" target="_blank">Login</a></strong>&nbsp;to Amazon <strong>AWS Console</strong></li>
<li>Now Navigate to&nbsp;<strong><a href="https://console.aws.amazon.com/ses/home" target="_blank">SES Home</a></strong></li>
<li>Click on <strong>Configuration Sets</strong></li>
<li>Click on the&nbsp;<strong>“Create Configuration Set”</strong> button and define a name e.g '.$siteTitle.'-Report. (This configuration set name will be used in step 21)</li>
<li>Click on the <strong>recently created</strong> Configuration Set</li>
<li>In <strong>“Add Destination”</strong> and choose <strong>SNS</strong> from the dropdown</li>
<li>Write a <strong>name</strong> e.g '.$siteTitle.'-SNS and select the <strong>event types</strong> you want '.$siteTitle.' to process. Most commonly used events are
<ul>
<li>Reject</li>
<li>Delivery</li>
<li>Bounce</li>
<li>Complaint</li>
<li>Rendering Failure</li>
</ul>
</li>
<li>From the Topic dropdown, select <strong>“Create SNS Topic”</strong></li>
<li>Define a <strong>Topic Name</strong> e.g '.$siteTitle.'-SNS-Topic and Display Name</li>
<li>Press <strong>Save</strong></li>
<li>Now Navigate to&nbsp;<strong><a href="https://console.aws.amazon.com/sns/v3" target="_blank">Amazon Simple Notification Service (SNS)</a></strong></li>
<li>Navigate to <strong>Topics</strong></li>
<li>Click on the <strong>recently created</strong> topic ARN</li>
<li>Click on <strong>“Create Subscription”</strong> button</li>
<li>Use the correct <strong>protocol</strong> i.e HTTP or HTTPS</li>
<li>
In <strong>Endpoint</strong>, paste the <strong>callback</strong><br>
<div class="urldmn"><input type="text" id="copyurl2" class="form-control" name="" value=":url" readonly="" aria-invalid="false"><i class="fa fa-copy" title="Click on button to copy URL" onclick="copyFunction2()"></i></div>
</li>
<li>Click <strong>“Create Subscription”</strong></li>
<li><button type="button" id="process1" class="btn btn-info btn-xs">Click Here</button> if you are done with all the steps listed above</li>
<li><button type="button" id="process2" disabled="" class="btn btn-info btn-xs">Click Here</button> to fetch the confirmation URL and then click the button below to confirm subscription.</li>
<li>Now click on the&nbsp;<strong>"Confirm Subscription"</strong> button to open the confirmation page in a new tab. Once you see the confirmed message in XML format, it means the confirmation was <strong>successful</strong></li>
<li>Paste the <strong>Configuration Set Name</strong> in the textbox that you have&nbsp;created in step 4.</li>
</ol>';
$lang['connectivity']['amazon']['form']['confirm_subscription']                 = 'Confirm Subscription';
$lang['connectivity']['amazon']['form']['you_are_all_set_now']                  = 'You are all set now. Just write your Configuration Set name in the field below';
$lang['connectivity']['amazon']['form']['configuration_set_name']               = 'Configuration Set Name';
$lang['connectivity']['amazon']['form']['configuration_set_name_step4']         = 'Configuration Set Name is the one that you setup in Step #4.';

/************* ** SparkPost Connectivity** *************/
$lang['connectivity']['sparkPost']['title']      						        ='SparkPost';
$lang['connectivity']['sparkPost']['description']						        ='Connect your SparkPost account by filling up the required fields below.';
$lang['connectivity']['sparkPost']['form']['howto_find_sparkpost_apikey']       ='<ol>
<li><strong><a href="https://app.sparkpost.com/auth" target="_blank">Login</a></strong>&nbsp;to your <strong>Sparkpost</strong> Account</li>
<li>Navigate to Configuration -&gt;&nbsp;<strong><a href="https://app.sparkpost.com/account/api-keys" target="_blank">API Keys</a></strong></li>
<li>Click on <strong>“Create API Key”</strong> button</li>
<li>Write any <strong>API Key Name</strong></li>
<li>Select “All” for <strong>API Permissions</strong></li>
<li>Click on <strong>"Create API Key"</strong> button and copy it</li>
</ol>';
$lang['connectivity']['sparkPost']['form']['configuring_sparkpost_apikey']       ='<ol>
<li><strong><a href="https://app.sparkpost.com/auth" target="_blank">Login</a></strong>&nbsp;to your <strong>Sparkpost</strong> account</li>
<li>Navigate to Configuration -&gt;&nbsp;<strong><a href="https://app.sparkpost.com/webhooks" target="_blank">Webhooks</a></strong>&nbsp;and click on&nbsp;<strong><a href="https://app.sparkpost.com/webhooks/create" target="_blank">Create Webhook</a></strong>&nbsp;button</li>
<li>Write any webhook name, copy the <strong>callback</strong> URL from '.$siteTitle.' and paste&nbsp;into <strong>Target</strong> field</li>
<li>Select from the <strong>Events</strong> you want to be processed by '.$siteTitle.'. If you want to process all events then select “All Events”. <span style="font-size:14px">(<strong>Important</strong>: this option may overload your server, so just select the events that really matter)</span></li>
<li><strong>Authentication</strong> should be “None”</li>
<li>Click on <strong>“Create Webhook”</strong> button and it should be all set</li>
</ol>:input';
/************* ** Elastic Email Connectivity** *************/
$lang['connectivity']['elastic_email']['title']                                    ='Elastic Email';
$lang['connectivity']['elastic_email']['description']                              ='Connect your Elastic Email account by filling up the required fields below.';
$lang['connectivity']['elastic_email']['form']['howto_find_elastic_email_apikey']  ='<ol>
<li><strong><a href="https://elasticemail.com/account" target="_blank">Login</a></strong>&nbsp;to your <strong>Elastic Email</strong> Account</li>
<li>Navigate to <strong>Settings</strong></li>
<li>Click on&nbsp;<strong><a href="https://elasticemail.com/account#/settings/apikey" target="_blank">API</a></strong></li>
<li>Click on <strong>Create API Key</strong>&nbsp;button</li>
<li>Write a friendly <strong>API Key Name</strong></li>
<li>Select <strong>Full Permissions</strong>&nbsp;for API Permissions</li>
<li>Click on the&nbsp;<strong>Create</strong> button</li>
<li>Copy the <strong>API Key</strong> and paste into <strong>'.$siteTitle.'</strong></li>
</ol>';
$lang['connectivity']['elastic_email']['form']['configuring_apikey']                ='<ol>
<li><strong><a href="https://elasticemail.com/account" target="_blank">Login</a></strong>&nbsp;to your <strong>Elastic Email</strong> account</li>
<li>Now Navigate to&nbsp;<strong>Webhooks</strong>&nbsp;and click on plus sign [+] to create the webhook</li>
<li>Insert the following URL in Target :input</li>
<li>Select the <strong>Notifications</strong> you want to be processed</li>
<li>Insert the <strong>Notification Link</strong> in inbound email (URL where Inbound email notifications will be available)</li>
<li>Insert the <strong>inbound domain</strong></li>
<li>Click on <strong>Save</strong>&nbsp;button</li>
</ol>';
/************* ** Mailjet Connectivity** *************/
$lang['connectivity']['mailjet']['title']                                      ='Mailjet';
$lang['connectivity']['mailjet']['description']                                ='Connect your Mailjet account by filling up the required fields below.';
$lang['connectivity']['mailjet']['form']['api_public_key']                     ='API Public Key';
$lang['connectivity']['mailjet']['form']['api_public_key_help']                ='Insert your Mailjet API Public Key';
$lang['connectivity']['mailjet']['form']['api_secret_key']                     ='API Secret Key';
$lang['connectivity']['mailjet']['form']['api_secret_key_help']                ='Insert your Mailjet API Secret Key';
$lang['connectivity']['mailjet']['form']['howto_find_mailjet_apikey']          ='<ol>
<li><strong><a href="https://app.mailjet.com/signin" target="_blank">Login</a></strong>&nbsp;to your <strong>Mailjet</strong> Account.</li>
<li>Navigate to Account settings -&gt;&nbsp;<strong><a href="https://app.mailjet.com/account" target="_blank">REST API</a></strong></li>
<li>Click on <strong><a href="https://app.mailjet.com/account/api_keys">Master API Key & Sub API key management</a></strong>&nbsp;Link</li>
<li>Here you\'ll find the API Public Key and Secret Key</li>
</ol>';
$lang['connectivity']['mailjet']['form']['configuring_mailjet_apikey']         ='<ol>
<li><strong><a href="https://app.mailjet.com/signin" target="_blank">Login</a></strong>&nbsp;to your <strong>Mailjet</strong> Account</li>
<li>Navigate to Account settings -&gt; <strong><a href="https://app.mailjet.com/account">REST API</a></strong></li>
<li>Click on <strong><a href="https://app.mailjet.com/account/triggers">Event notifications (webhooks)</a></strong> Link</li>
<li>Insert the following URL in Select All box if you want to keep it same click on Apply to all :input</li>
</ol>';
/************* ** Smtp2go Connectivity** *************/
$lang['connectivity']['smtp2go']['title']                                 ='Smtp2go';
$lang['connectivity']['smtp2go']['description']                           ='Connect your Smtp2go account by filling up the required fields below.';
$lang['connectivity']['smtp2go']['form']['howto_find_smtp2go_apikey']     ='<ol>
<li><strong><a href="https://app.smtp2go.com/login" target="_blank">Login</a></strong>&nbsp;to your <strong>SMTP2GO</strong> Account</li>
<li>Navigate to <strong>Settings</strong> and then click on <strong>API Keys</strong></li>
<li>Click on <strong>Add API Key</strong></li>
<li>Select all&nbsp;under the <strong>Permissions</strong> tab</li>
<li>Press <strong>Save</strong></li>
<li>Copy the <strong>API Key</strong> and paste into <strong>'.$siteTitle.'</strong></li>
</ol>';
$lang['connectivity']['smtp2go']['form']['configuring_smtp2go_apikey']     ='<ol>
<li><strong><a href="https://app.smtp2go.com/login/" target="_blank">Login</a></strong>&nbsp;to your <strong>SMTP2GO</strong> Account</li>
<li>Navigate to <strong>Settings</strong> and then click on <strong>Webhooks</strong></li>
<li>Click on <strong>Add Webhook</strong></li>
<li>Here set your webhook URL and select the events you want to process.:input</li>
<li>In <strong>Users</strong>, select the <strong>API Key</strong> or Select All</li>
<li>Select the <strong>events</strong> you want to be processed</li>
<li>In Headers textbox, write&nbsp;<span style="background-color:#ecf0f1">email_log_id</span></li>
<li>Click <strong>Save</strong></li>
</ol>';

/************* ** Postmark Connectivity** *************/
$lang['connectivity']['postmark']['title']                                 ='Postmark';
$lang['connectivity']['postmark']['description']                           ='Connect your Postmark account by filling up the required fields below.';
$lang['connectivity']['postmark']['form']['howto_find_postmark_apikey']    ='<ol>
<li><strong><a href="https://account.postmarkapp.com/login" target="_blank">Login</a></strong>&nbsp;to your <strong>Postmark</strong> Account</li>
<li>Go to <strong>Servers</strong> and click on the desired server</li>
<li>Click on&nbsp;<strong>API Tokens</strong></li>
<li>Copy the <strong>token</strong> and paste into <strong>'.$siteTitle.'</strong></li>
</ol>';
$lang['connectivity']['postmark']['form']['configuring_postmark_apikey']    ='<ol>
<li><strong><a href="https://account.postmarkapp.com/login" target="_blank">Login</a></strong>&nbsp;to your <strong>Postmark</strong> Account</li>
<li>Navigate to&nbsp;<strong>Servers</strong> and&nbsp;select the desired server</li>
<li>Click on <strong>Webhooks</strong></li>
<li>Click on <strong>Add webhook</strong></li>
<li>Here set your webhook URL and select the <strong>events</strong> you want to get processed :input</li>
<li>Click <strong>Save webhook</strong></li>
</ol>';
/************* ** Problem with gmail ** *************/
$lang['problem_with_gmail']['title']                                 = 'Having problems getting Gmail to work with '.$siteTitle.'?';
$lang['problem_with_gmail']['method_gmail_smtp']                     = 'There are two methods to use Gmail SMTP with '.$siteTitle.'';
//Method 1;
$lang['problem_with_gmail']['method_one']                            = 'Method 1';
$lang['problem_with_gmail']['go_to_your']                            = 'Go to your';
$lang['problem_with_gmail']['google_account']                        = 'Google Account';
$lang['problem_with_gmail']['left_click_security']                   = 'On the left navigation panel, click Security.';
$lang['problem_with_gmail']['signing_in_google_panel_password']      = 'On the Signing in to Google panel, click App passwords. Note: If you can`t get to the page, 2-Step Verification is';
$lang['problem_with_gmail']['not_set_up_for_your_account']           = 'Not set up for your account';
$lang['problem_with_gmail']['set_up_for_security_keys_only']         = 'Set up for security keys only';
$lang['problem_with_gmail']['select_app_youre_using']                = 'At the bottom, click Select app and choose the app you’re using.';
$lang['problem_with_gmail']['select_device_youre_using']             = 'Click Select device and choose the device you’re using.';
$lang['problem_with_gmail']['click_generate']                        = 'Click Generate.';
$lang['problem_with_gmail']['use_your_password_gmail_validate']      = 'Use the app password instead of your Gmail password and click Validate.';
//'Method 2';
$lang['problem_with_gmail']['login_to_your']                         = 'Login to your';
$lang['problem_with_gmail']['gmail_account']                         = 'Gmail Account';
$lang['problem_with_gmail']['my_account']                            = 'My Account';
$lang['problem_with_gmail']['turn_off_2step_verification']           = 'Turn off 2-Step Verification';
$lang['problem_with_gmail']['turn_on_access_for']                    = 'Turn on access for';
$lang['problem_with_gmail']['less_secure_apps_link']                 = 'Less Secure Apps';

/************* ** Problem with hotmail ** *************/
$lang['problem_with_hotmail']['title']                     = 'Having problems getting Hotmail to work with '.$siteTitle.'?';
$lang['problem_with_hotmail']['connect_hotmail_smtp']      = 'Connecting with hotmail SMTP is the simplest thing.';
$lang['problem_with_hotmail']['username_field_hotmail']    = 'Just enter your hotmail email address in the smtp username field';
$lang['problem_with_hotmail']['password_field_hotmail']    = 'Write your hotmail password for the SMTP password';

/************* ** Problem with yahoo ** *************/
$lang['problem_with_yahoo']['title'] 					   = 'Having problems getting Yahoo to work with '.$siteTitle.'?';
$lang['problem_with_yahoo']['methods_to_use_yahoo_smtp']   = 'There are two methods to use Yahoo SMTP with '.$siteTitle.'';
$lang['problem_with_yahoo']['method_one_recommended']      = 'Method 1 (Recommended):';
$lang['problem_with_yahoo']['yahoo_password_as_smtp']      = 'Use your Yahoo email password as the SMTP password.';

/************* ** Problem with aol ** *************/
$lang['problem_with_aol']['title'] 					       = 'Having problems getting aol to work with '.$siteTitle.'?';
$lang['problem_with_aol']['methods_to_use_aol_smtp']       = 'There are two methods to use AOL SMTP with '.$siteTitle.'';
$lang['problem_with_aol']['method_one_recommended']        = 'Method 1 (Recommended):';
$lang['problem_with_aol']['aol_password_as_smtp']          = 'Use your AOL email password as the SMTP password.';
/************* ** Messages ** *************/
$lang['message']['tracking_domain_status_off']             = '<strong>Note</strong>: This tracking domain status is off and the intellectual pattern to select the tracking domain is enabled, so the primary domain will appear in the tracking links.';
$lang['message']['tracking_domain_intellectual_status_off']             = '<strong>Note</strong>: This tracking domain status is off and the intellectual pattern to select the tracking domain is also disabled, so the tracking domain will still appear in the tracking links. If your tracking domain is unfunctional, it may result in the broken links inside the emails going out.';
$lang['message']['smtp_msg_01']                            = 'You need to have at least 1 sending domain before you can add an SMTP.';
$lang['message']['domain_url_copied']                      = 'Domain URL Successfully copied.';
$lang['message']['congratulations']                        = 'Congratulations!';
$lang['message']['success_node_configure']                 = 'Your Sending Node Configuration has been successfully configured!';
$lang['message']['copies_created']                         = 'Copies created';
$lang['message']['smtp_limit_exceeded']                    = 'SMTP limit exceeded, your are not allowed to create the smtp.';
$lang['message']['domain_not_allowed']                     = 'You are not allowed to add this domain';
$lang['message']['not_allowed']                            = 'You are not allowed to add this from email address';
$lang['message']['error_test_email']                       = 'Please enter a valid email address.';
$lang['message']['preview_email']['success']               = 'Preview email successfully sent!';
$lang['message']['preview_email']['failure']               = 'Preview email not sent due to SMTP issue!';
$lang['message']['msg_status']                             = 'Successfully Done';
$lang['message']['success_import']                         = 'SMTP Successfully Imported';
$lang['message']['error_import']                           = 'Cannot import! Please Choose a file with CSV format';
$lang['message']['sendgrid_successfully_created']          = 'Sendgrid successfully created';
$lang['message']['note']          						   = 'Sending Node is your email courier and technically called an MTA. You can connect an SMTP or an ESP account from the supported providers.';

/************* ** Preview Email ** *************/
$lang['preview_email']['content']   = '<p>This is to let you know that you\'ve just sent a test email to this address to verify the sending node connection. Below, you can find the results data.</p>
                 <p>Sending Node: :name </p>
                 <p>Type:  :nodeType </p>
                 <p>Result: Succesful </p>
                 <p>Date: :date</p>
                 <p><br><br>If you are unaware of this email and you haven\'t originated this test, please void this email. </p>
                 ';
/************* ** Test Email Form ** *************/
$lang['test_email']['form']['heading']           = 'Test Email';
$lang['test_email']['form']['get_debug_log']     = 'Get Debug Log';
$lang['test_email']['form']['debug_log']         = 'View Debug Log';
/************* ** General ** *************/
$lang['activity_title']       = 'Sending Nodes';
$lang['activity_log']         = 'Campaign Group';
$lang['choose_domain']        = 'Choose Domain';
$lang['signup']               = 'If you don’t have an account with :app, you can ';
$lang['signup_here']          = 'Signup Here';
$lang['auto_inactive']        = 'Auto Inactive';
$lang['sending_nodes']        = 'Sending Nodes';
$lang['debug_log']            = 'Debug Log';
$lang['rename_group']         = 'Rename group';;
$lang['delete_move']          = 'Delete group and move lists to Unsorted';
$lang['delete']               = 'Delete group and all lists inside';
$lang['mailgun_account']      = 'Mailgun Account';
$lang['Connect_Sending_Node'] = 'Connect Sending Node';
$lang['smtp_failed_reason']   = 'SMTP Failed Reason';
$lang['select_gateway']   = 'Select gateway';
$lang['selectGateway']['err']   = 'Select a gateway';

$lang['th']['id']   = 'ID';
$lang['th']['notice']   = 'Notice/Error';
$lang['test_connection']['no_node']   = 'No node to test.';
$lang['validate_node']   = 'Validation process will send a test email to ';
$lang['validating_node']   = 'Validating the sending node';
$lang['validated']   = 'Node has been successfully validated.';


$lang['label']['test_connection']  = 'Verifying SMTP Connections';


$lang['module']['message']  = 'We have updated the Sending Nodes functionality in version 5.2. You should switch it to the new module.';


$lang['delete_node']['alert']  = '<b>Error: </b> Un-assign the node ":node" from the associated assets and then delete it.';
$lang['assign']['to_other']  = 'You can re-assign the assets to another node.';
$lang['select_smtp']  = 'Select node';
$lang['moveToLabel']  = 'Shift assets to another Node';
$lang['delete_node']['mdl_title'] = 'Dependency check';
$lang['gmail']['card_body'] = '<div class="helpheader"><p>There are two methods to use Gmail SMTP with '.$siteTitle.'</p> </div> <h3 class="m-form__heading-title"> Method 1:</h3> <h6 class="sbold">Using App Password</h6> <ol class="helpList"> <li>Go to your <a href="https://myaccount.google.com/" target="_blank">Google Account</a>.</li> <li>On the left navigation panel, click Security.</li> <li> On the Signing in to Google panel, click App passwords. Note: If you can`t get to the page, 2-Step Verification is: <ul class="helpListChild"> <li>Not set up for your account</li> <li>Set up for security keys only</li> </ul> </li> <li>At the bottom, click Select app and choose the app you’re using.</li> <li>Click Select device and choose the device you’re using.</li> <li>Click Generate.</li> <li>Use the app password instead of your Gmail password and click Validate.</li> </ol> <hr> <h3 class="m-form__heading-title"> Method 2: </h3> <ol class="helpList"> <li>Login to your<a href="https://www.gmail.com/" target="_blank">Gmail Account</a></li> <li>Go to <a href="https://myaccount.google.com/" target="_blank">My Account</a></li> <li>Turn off 2-Step Verification</li> <li>Turn on access for<a href="https://www.google.com/settings/security/lesssecureapps" target="_blank">Less Secure Apps</a></li></ol>';
$lang['aol']['card_body'] = '<div class="helpheader"> <p>There are two methods to use AOL SMTP with '.$siteTitle.'</p> </div> <h3 class="m-form__heading-title"> Method 1 (Recommended): </h3> <ol> <li><a href="https://login.aol.com/account/security" target="_blank">Sign in and go to your Account security page.</a>.</li> <li>Turn on Two-Step Verification if it`s not.</li> <li>Click Generate app password or Manage app passwords</li> <li>Select `other app` from the drop down menu, write '.$siteTitle.' and click Generate.</li> <li>Use this app password as SMTP Password.</li> </ol> <hr> <h3 class="m-form__heading-title"> Method 2 </h3> <h6 class="sbold">Using App Password</h6> <ol> <li><a href="https://login.aol.com/account/security" target="_blank">Sign in and go to your Account security page.</a></li> <li>Turn off Two-Step Verification if it`s not.</li> <li>Enable Allow apps that use less secure sign-in.</li> <li>Use your AOL email password as the SMTP password.</li> </ol>';
$lang['outlook']['card_body'] = '<div class="card-body"> <div class="helpheader"> <p>Connecting with hotmail SMTP is the simplest thing.</p> </div> <h3 class="m-form__heading-title"> Method: </h3> <h6 class="sbold">Using App Password</h6> <ol> <li>Just enter your hotmail email address in the smtp username field</li> <li>Write your hotmail password for the SMTP password</li> </ol> </div>';
$lang['yahoo']['card_body'] = '<div class="card-body"> <div class="helpheader"> <p>There are two methods to use Yahoo SMTP with '.$siteTitle.'</p> </div> <h3 class="m-form__heading-title"> Method 1 (Recommended): </h3> <ol> <li><a href="https://login.yahoo.com/account/security" target="_blank">Sign in and go to your Account security page.</a>.</li> <li>Turn on Two-Step Verification if it`s not.</li> <li>Click Generate app password or Manage app passwords</li> <li>Select `other app` from the drop down menu, write '.$siteTitle.' and click Generate.</li> <li>Use this app password as SMTP Password.</li> </ol> <hr> <h3 class="m-form__heading-title"> Method 2: </h3> <h6 class="sbold">Using App Password</h6> <ol> <li><a href="https://login.yahoo.com/account/security" target="_blank">Sign in and go to your Account security page.</a></li> <li>Turn off Two-Step Verification if it`s not.</li> <li>Enable Allow apps that use less secure sign-in.</li> <li>Use your Yahoo email password as the SMTP password.</li> </ol> </div>';

 
$lang['controller']['sendgrid_created_session']  = 'Sendgrid successfully created';
$lang['controller']['smtp_created_session']  = 'SMTP successfully created';
$lang['controller']['content_drip_groups']  = 'Drip Groups';
$lang['step_blade']['self_signed_certificates_label']  = 'Allow Self-signed Certificates';
$lang['step_blade']['verify_peer_certificates_label']  = 'Verify Peer Certificate';
$lang['step_blade']['verify_peer_name_label']  = 'Verify Peer Name';
$lang['step_blade']['yes_only_label']  = 'Yes';
$lang['step_blade']['no_only_label']  = 'No';
$lang['add_node_blade']['value_copied_command']  = 'Value copied successfully!';
$lang['add_node_blade']['code_copied_command']  = 'Code copied successfully!';
$lang['add_node_blade']['gateway_relay_email_popover']  = 'Select a gateway responsible to relay the emails from this Node.';
$lang['add_node_blade']['email_required_small_text']  = 'Email is required';
$lang['add_node_blade']['debug_log_input']  = 'Get Debug Log';
$lang['add_node_blade']['copy_txt_action']  = 'Copy';
$lang['add_node_blade']['gateway_txt_label']  = 'Gateway';

$lang['important_blade']['importing_smtps_span']  = 'Importing SMTPS from';
$lang['important_blade']['fields_dropdown_para']  = 'Select appropriate fields of the application from the each dropdown, to map according to the correct headers of the importing file.';
$lang['index_blade']['notice_txt_bold']  = 'Notice!';
$lang['index_blade']['switch_now_action']  = 'Switch Now';
$lang['index_blade']['add_powermta_button']  = 'Add PowerMTA';
$lang['index_blade']['nodes_limit_button']  = 'Nodes Limit:';
$lang['index_blade']['select_smtp_option']  = 'SMTP';
$lang['index_blade']['select_gmail_option']  = 'Gmail';
$lang['index_blade']['select_outlook_option']  = 'Outlook';
$lang['index_blade']['select_aol_option']  = 'AOL';
$lang['index_blade']['select_yahoo_option']  = 'Yahoo';
$lang['index_blade']['status_changed_failed_command']  = 'Status Changed Failed';
$lang['index_blade']['status_changed_successfully_command']  = 'Status Changed Successfully';
$lang['index_blade']['record_update_successfully_command']  = 'Record updated successfully';
$lang['index_blade']['status_of_th']  = 'Status';
$lang['smtp_create_blade']['verify_peer_name_label']  = 'Verify Peer Name';
$lang['smtp_create_blade']['verify_peer_certificate_label']  = 'Verify Peer Certificate';
$lang['smtp_create_blade']['self_signed_certificate_label']  = 'Allow Self-signed Certificates';
$lang['smtp_create_blade']['eg_txt_key_div']  = 'e.g key-hs892hs872tsix872gkkzhx41fas72hsl6gq1';

$lang['esp_controller']['missing_parameter_bounce_error']  = 'Error: Missing required parameter, bounce email id';
$lang['esp_controller']['missing_parameter_rply_error']  = 'Error: Missing required parameter, reply email';

$lang['media_controller']['file_type_return']  = 'The file must be a file of type';


$lang['include_breadcrum_blade']['action_help_article']  = 'Help Article';

$lang['include_common_script_blade']['return_bootstrap_session']  = 'Bootstrap-session-timeout plugin is miss-configured. Option "redirAfter" must be equal or greater than "warnAfter".';
$lang['include_common_script_blade']['alert_oops_wrong']  = 'Oops Something went Wrong';
$lang['include_common_script_blade']['end_of_notification']  = 'End of notifications';
$lang['include_common_script_blade']['select_priority_option']  = 'Select Priority';

$lang['include_header_blade']['months_ago_span']  = '5 months ago';
$lang['include_header_blade']['trash_all_action']  = 'Trash All Recoreds';

$lang['include_side_menu_blade']['email_limit_small']  = 'Email Limit (Today)';
$lang['include_side_menu_blade']['transactional_limit_small']  = 'Transactional Limit (Today)';
$lang['include_side_menu_blade']['email_limit__month_small']  = 'Email Limit (This Month)';
$lang['include_side_menu_blade']['transactional_limit_month_small']  = 'Transactional Limit (This Month)';
$lang['include_side_menu_blade']['email_credits_small']  = 'Email Credits';
$lang['include_side_menu_blade']['email_transactional_small']  = 'Transactional Credits';
$lang['include_side_menu_blade']['renewal_date_small']  = 'Renewal Date';

$lang['include_todos_blade']['error_notification']  = 'Errors Notification';

$lang['include_topbar_blade']['billing_area_div']  = 'Go to your billing area';
$lang['include_topbar_blade']['biling_txt_div']  = 'Billing';
$lang['include_topbar_blade']['learn_about_current']  = 'Learn about your current plan';
$lang['include_topbar_blade']['subscription_txt_div']  = 'Subscription';
$lang['include_topbar_blade']['hi_txt_span']  = 'Hi,';
$lang['include_topbar_blade']['action_download_file']  = 'Download file';

$lang['include_topbar_notifications_blade']['update_mumara_heading']  = 'Update Mumara';
$lang['include_topbar_notifications_blade']['inital_setup_guide_heading']  = 'Initial Setup Guide';
$lang['include_topbar_notifications_blade']['complete_qualiy_broadcast_heading']  = 'Complete the following basic steps to qualify for the first broadcast.';
$lang['include_topbar_notifications_blade']['sure_delete_all_files']  = 'Are you sure you want to delete all exported files?';
$lang['include_topbar_notifications_blade']['operation_successfull_command']  = 'Operation is successfull';
$lang['include_topbar_notifications_blade']['notifications_heading']  = 'Notifications ';
$lang['include_topbar_notifications_blade']['last_checked_div']  = 'Last Checked Nov 28, 2019 04:52:59 AM ';
$lang['include_topbar_notifications_blade']['view_all_action']  = 'View All ';

$lang['include_validator_function_blade']['please_enter_valid_ip_try']  = 'Please enter a valid IP and Port';
$lang['include_validator_function_blade']['enter_valid_ipv4']  = 'Please enter a valid IPv4';
$lang['include_validator_function_blade']['invalid_ip_address']  = 'Invalid IP address';
$lang['include_validator_function_blade']['letters_numbers_try']  = 'Letters, numbers, and underscores only please';
$lang['include_topbar_blade']['']  = '';


    return $lang;