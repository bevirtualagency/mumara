<?php
$siteTitle="Mumara Campaigns";
try {
    if(function_exists('getApplicationSettings')){
        $title= getApplicationSettings('title') ;
        $siteTitle=$title ? $title:$siteTitle;
    }

} catch (\Exception $e) {

}
$lang['web_hook']['config']='<ol>
<li><strong><a href="https://one.mumara.com" target="_blank">Login</a></strong>&nbsp;to your <strong>Mumara One</strong> Account</li>
<li>Navigate to&nbsp;<strong>Servers</strong> and&nbsp;select the desired server</li>
<li>Click on <strong>Webhooks</strong></li>
<li>Click on <strong>Add webhook</strong></li>
<li>Here set your webhook URL and select the <strong>events</strong> you want to get processed :input</li>
<li>Click <strong>Save webhook</strong></li>
</ol>';

$lang['api_keys']['setup'] = '<ol>
<li><strong><a href="https://one.mumara.com" target="_blank">Login</a></strong>&nbsp;to your <strong>Mumara One</strong> Account</li>
<li>Navigate to Transactional->Credentials</li>
<li>Click on Generate Credentials</li>
<li>Copy the API Key and paste it in <strong>'.$siteTitle.'</strong></li>
</ol>';

$lang['esp']['webhook_title'] = 'Configuring :app Webhooks';

$lang['amazon']['setup'] = "<p>Follow the steps below to obtain Amazon SES API Credentials to connect it with ".$siteTitle.".<br>&nbsp;</p>
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
$lang['amazon']['webhook_title']='Configuring Simple Notification Service (SNS) in Amazon';
$lang['amazon']['configure_sns']                      = '<ol>
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
<div class="urldmn"><input type="text" id="copyurl2" class="form-control" name="" value=":input" readonly="" aria-invalid="false"><i class="fa fa-copy" title="Click on button to copy URL" onclick="copyFunction2()"></i></div>
</li>
<li>Click <strong>“Create Subscription”</strong></li>
<li><button type="button" id="process1" class="btn btn-info btn-xs">Click Here</button> if you are done with all the steps listed above</li>
<li><button type="button" id="process2" disabled="" class="btn btn-info btn-xs">Click Here</button> to fetch the confirmation URL and then click the button below to confirm subscription.</li>
<li>Now click on the&nbsp;<strong>"Confirm Subscription"</strong> button to open the confirmation page in a new tab. Once you see the confirmed message in XML format, it means the confirmation was <strong>successful</strong></li>
<li>Paste the <strong>Configuration Set Name</strong> in the textbox that you have&nbsp;created in step 4.</li>
</ol>';
$lang['amazon']['web_hook_radio_btn_title'] = 'Simple Notification Service (SNS)';

$lang['sendgrid']['api_keys']['setup'] = ' <ol><li><a href="https://app.sendgrid.com/login" target="_blank">Login</a> to your SendGrid Account</li>
<li>Navigate to Settings -> <a href="https://app.sendgrid.com/settings/api_keys" target="_blank">Click on `Create API Key?` button and copy the key</a></li>
<li>Click on `Create API Key?` button and copy the key</li>
 </ol>';
$lang['sendgrid']['web_hook']['config'] = '<ol>
                                                                                <li><a href="https://app.sendgrid.com/login" target="_blank">Login</a> to your SendGrid Account.</li>
                                                                                <li>Navigate to Settings -> <a href="https://app.sendgrid.com/settings/mail_settings" target="_blank">Mail Settings</a>.</li>
                                                                                <li>Turn on Event Notification, select from the actions you want to get processed and paste the callback URL you see in Mumara C+</li>
                                                                            </ol>:input';
$lang['updated'] = 'Node has been successfully updated.';
$lang['created'] = 'Node has been successfully added.';
$lang['web_hook']['mailgun']['setup']       ="
<div class='api_key_find_help'>
<p>Configure Mailgun webhooks by following the steps below to process the delivery status notifications for the outgoing message</p>
<ol>
    <li>Click on <b>Sending </b> on the left-hand side of your <a href='https://app.mailgun.com/app/dashboard' target='_blank'>Mailgun dashboard</a></li>
    <li>Click on <b>Webhooks</b> and select the domain from the top dropdown</li>
    <li>Click on <b>Add Webhook</b> button</li>
    <li>Select from the <b>Event Types</b> and paste the <b>Callback</b> URL you see in ".$siteTitle." and press <b>Create Webhook</b> button</li>
</ol></div>:input";
$lang['select_domain']['error'] = 'Missing required parameter: Tracking domain/id';
return $lang;