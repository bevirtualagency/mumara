<?php
include("variables.php");
$lang = array();
$lang['validation']['failed']  = 'An error occurred.';
$lang['parameter']['bounce_rule']['req'] = 'Error: At least one criteria or parameter is required.';
$lang['error'] = "Error: ";
$lang['success'] = "Success: ";
$lang['api']['unauth'] = "Error: Authorization Error! Check API Token";
$lang['api']['suggestion'] = "If you are sending authentication header then your server may not be accepting it. Alternatively, you can try sending authentication header as a parameter";
$lang['api']['auth_pass'] = "Success: Authorization Passed!";
$lang['opps']['error'] = "Error: Something went wrong! try again.";
$lang['general']['parameter']['required'] = "Error: At least one parameter value is required to update a record.";
$lang['general']['parameter']['req'] = "Error: At least one parameter value is required.";
$lang['general']['user']['not_found'] = "Error: User Doesn't exist";
$lang['general']['host']['invalid'] = "Error: Invalid :attribute";
$lang['general']['timezone']['invalid'] = "Error: Invalid format :attribute";
$lang['general']['country_code']['invalid'] = "Error: Invalid format :attribute";
$lang['general']['mobile_code']['invalid'] = "Error: Invalid format :attribute";
//quota validation
$lang['list']['limit']['exceeded'] = "Error: Your List quota has been consumed.";
$lang['contact']['limit']['exceeded'] = "Error: Your Contact quota has been consumed.";
$lang['users']['limit']['exceeded'] = "Error: Your user quota has been consumed.";

$lang['permission']['denied'] = 'Error: Access Denied';
$lang['license']['permission']['denied'] = 'Error: Your license doesn\'t support this feature.';

$lang['general']['delete']['selected_prompt'] = "Do you really want to delete selected records";

$lang['general']['required'] = "Error: %%field_name%% is required.";

$lang['list']['created'] = "Success: List has been successfully created.";
$lang['list']['updated'] = "Success: List has been successfully updated.";
$lang['list']['exists'] = "Error: List already exists.";
$lang['list']['not_found'] = "Error: Contact list doesn't exist.";
$lang['list']['deleted'] = "Success: List has been successfully deleted.";
$lang['list_id']['not_found'] = "Record doesn't exist.";
$lang['list']['bounce']['not_found'] = "Error: Bounce email address doesn't exist. Add this bounce address to ".$siteTitle." first.";
$lang['list']['masking_domain']['not_found'] = "Error: Unauthorized domain, owner_email";
$lang['lists']['not_found'] = "No list found.";
$lang['list']['custom_field']['not_found'] = "Custom Field %%field%% doesn't exist. Add this field to ".$siteTitle." First.";
$lang['list']['in_use'] = "Error: Contact list is in use. Unlink it from associated triggers and segments";
$lang['list']['name_in_use'] = "Error: Contact list :name is in use. Unlink it from associated triggers and segments";
$lang['segment']['name_in_use'] = "Error: Segment :name is in use. Unlink it from associated triggers.";
$lang['group']['list']['in_use'] = "Error: Contact list %%name%% is in use. Unlink it from associated triggers and segments.";
$lang['list']['group']['not_found'] = "Error: Group doesn't exist.";
$lang['list']['group']['deleted'] = "Success: Contact List Group has been successfully deleted.";

$lang['add_subscriber']['list_not_found'] = "Error: Invalid contact list id.";
$lang['add_subscriber']['exists'] = "Error: Email address already exists";
$lang['add_subscriber']['added'] = "Success: Contact has been successfully created.";
$lang['update_subscriber']['not_found'] = "Error: Contact doesn't exist.";
$lang['update_subscriber']['updated'] = "Success: Contact has been successfully updated.";
$lang['subscriber']['not_found'] = "Error: Invalid contact id.";
$lang['update_subscriber']['email']['exist'] = "Error: Email already exists.";
$lang['subscriber']['deleted'] = "Success: Contact has been successfully deleted.";
$lang['subscriber']['not_found'] = "Error: The Contact List (id: %%list_id%%) has 0 contacts";
$lang['subscriber']['list_not_found'] = "Error: The contact list (id: %%list_id%%) doesn't exist";
$lang['subscriber']['email']['not_found'] = "Error: Email address doesn't exist.";

$lang['record']['not_found'] = "Error: Record doesn't exist.";
$lang['records']['not_found'] = "Error: Records do not exist.";
$lang['record']['deleted'] = "Success: Record has been successfully deleted.";

$lang['campaign']['created'] = "Success: Broadcast successfully created.";
$lang['campaign']['updated'] = "Success: Broadcast successfully updated.";
$lang['campaign']['deleted'] = "Success: Broadcast has been successfully deleted.";
$lang['campaign']['exists'] = "Success: Broadcast name already exists.";
$lang['campaign']['not_found'] = "Error: Broadcast doesn't exist.";

$lang['custom_field']['type']['validate'] = "Error: Type field should contain one of these values ";

$lang['custom_field']['created'] = "Success: Custom field created successfully.";
$lang['custom_field']['updated'] = "Success: Custom field updated successfully.";
$lang['custom_field']['deleted'] = "Success: Custom field has been successfully deleted.";
$lang['custom_field']['list']['not_found'] = "Error: List doesn't exist.";
$lang['custom_field']['not_found'] = "Error: Custom field doesn't exist.";
$lang['custom_field']['cannot_delete'] = "Error: Please unassign custom field from the associated lists before it can be deleted. Otherwise you can forcibly delete custom field by parsing force=1.";
$lang['custom_field']['added_to_list'] = "Error: Custom Field Successfully added to a List %%list%%.";
$lang['custom_field']['exists'] = "Error: Custom Field already exists.";

$lang['suppress_email']['add_to_list']['exist'] = "Error: Email already exists.";
$lang['suppress_email']['add_to_list']['added'] = "Success: Email has been successfully added to suppression list";

$lang['suppress_domain']['add_to_list']['exist'] = "Error: Domain already exists.";
$lang['suppress_domain']['add_to_list']['added'] = "Success: Domain has been successfully added to suppression list";

$lang['suppress_ip']['add_to_list']['added'] = "Success: %%processed%% out of %%total%% IP has been inserted successfully.";
$lang['suppress_ip']['add_to_list']['invalid'] = "Error: Invalid format for IP.";
$lang['suppress_ip']['add_to_list']['exist'] = "Error: IP already exists.";

$lang['suppress']['param_required'] = "Error: You must specify value of one of these parameters %%params%%.";
$lang['suppress']['user_id']['permission_denied'] = "Error: Permission denied for user id.";
$lang['suppress']['ip']['added'] = "Error: IP has been successfully added to suppression list.";

$lang['bounce']['mailbox']['not_found'] = "Error: Bounce Address does not exist.";
$lang['bounce']['mailbox']['exist'] = "Error: Bounce Address already exists.";
$lang['bounce']['mailbox']['added'] = "Success: Bounce Address has been successfully added.";
$lang['bounce']['mailbox']['updated'] = "Success: Bounce Address has been successfully updated.";
$lang['bounce']['mailbox']['deleted'] = "Success: Bounce Address has been successfully deleted.";

$lang['bounce']['rule']['not_found'] = "Error: Bounce Rule does not exist.";
$lang['bounce']['rule']['exist'] = "Error: Bounce Rule already exists.";
$lang['bounce']['rule']['added'] = "Success: Bounce Rule has been successfully added.";
$lang['bounce']['rule']['updated'] = "Success: Bounce Rule has been successfully updated.";
$lang['bounce']['rule']['deleted'] = "Success: Bounce Rule has been successfully deleted.";

$lang['bounce_rule']['added'] = "Success: Bounce Rule successfully added.";
$lang['bounce_rule']['not_found'] = "Error: Bounce Rule not found.";
$lang['bounce_rule']['updated'] = "Success: Bounce Rule has been successfully updated.";
$lang['bounce_rule']['deleted'] = "Success: Bounce Rule has been successfully deleted.";
$lang['bounce_rule']['code']['error'] = "Error: Invalid format for Bounce code";
$lang['parameter']['req'] = 'Error: At least one criteria is required.';

$lang['fbl']['mailbox']['not_found'] = "Error: FBL Account does not exist.";
$lang['fbl']['mailbox']['exists'] = "Error: FBL Account already exists.";
$lang['fbl']['mailbox']['added'] = "Success: FBL Account has been successfully added.";
$lang['fbl']['mailbox']['updated'] = "Success: FBL Account has been successfully updated.";
$lang['fbl']['mailbox']['deleted'] = "Success: FBL Account has been successfully deleted.";

$lang['spinTag']['not_found'] = "Error: Spintag not found.";
$lang['spinTag']['exists'] = "Error: Spintag already exists.";
$lang['spinTag']['added'] = "Success: Spintag has been successfully added.";
$lang['spinTag']['updated'] = "Success: Spintag has been successfully updated.";
$lang['spinTag']['deleted'] = "Success: Spintag has been successfully deleted.";

$lang['sending_domain']['not_found'] = "Error: Sending Domain not found.";
$lang['sending_domain']['exists'] = "Error: Sending Domain already exists.";
$lang['sending_domain']['added'] = "Success: Sending Domain has been successfully added.";
$lang['sending_domain']['updated'] = "Success: Sending Domain has been successfully updated.";
$lang['sending_domain']['deleted'] = "Success: Sending Domain has been successfully deleted.";

$lang['user']['exists'] = 'Error: User already exists';
$lang['user']['not_found'] = 'Error: User doesn`t exist';
$lang['user']['deleted'] = 'User has been successfully deleted.';
$lang['user']['package']['not_found'] = 'Error: Package doesn`t exist';
$lang['user']['created'] = 'Success: User has been successfully created.';
$lang['user']['updated'] = 'Success: User has been successfully updated.';

$lang['update']['yearly']['expired'] = 'Error: Opssss... Yearly updates subscription has been expired.';
$lang['group']['not_found'] = "Error: Group doesn't exist.";
$lang['activity_log']['not_found'] = "Error: Activity Log doesn't exist.";

$lang['sending_node']['import']['invalid_headers'] = 'Error: Invalid Headers mapping';
$lang['sending_node']['import']['invalid_port'] = 'Error: Invalid format port';
$lang['sending_node']['import']['domain']['not_found'] = 'Error: %%domain%% doesn\'t exist in your Sending Domains.';
$lang['sending_node']['import']['bounce']['not_found'] = 'Error: %%bounce%% doesn\'t exist in your Bounce Addresses.';
$lang['sending_node']['import']['invalid_host'] = 'Error: Invalid hostname %%host%%';
$lang['sending_node']['import']['successful'] = 'Success: Imported successfully';
$lang['sending_node']['import_success']['header_skipped'] = 'Success: Imported successfully but %%number%% additional headers skipped.';
$lang['sending_node']['import_success']['invalid_header'] = 'Success: Imported successfully but skipped additional headers (Invalid format).';
$lang['sending_node']['import']['empty_password'] = 'Error: Empty password.';
$lang['sending_node']['import']['empty_username'] = 'Error: Empty username.';
$lang['sending_node']['import']['duplicate_smtp'] = 'Error: Duplicate smtp data.';
$lang['session']['expired'] = 'You were automatically logout beacause session idle time was excceded.';

$lang['api_token']['expired'] = 'Error: API Token has been Expired.';
$lang['staff_role']['delete']['error'] = 'Error: Role is in use first unattach this role from the users.';
$lang['adminOnClient']['edit_list'] = 'You are editing a contact list that belongs to a user';
$lang['adminOnClient']['view_contacts'] = 'You are viewing contacts of a contact list that belongs to a user';
$lang['adminOnClient']['add_contact_to_list'] = 'You are adding a new contact to a contact list that belongs to a user';
$lang['adminOnClient']['user_list'] = 'This contact belongs to a user\'s contact list';
$lang['adminOnClient']['user_history'] = 'This contact belongs to a user\'s contact list';
$lang['adminOnClient']['edit_contact'] = 'You are editing a contact that belongs to a user\'s contact list';
$lang['adminOnClient']['edit_trigger'] = 'You are editing a trigger that belongs to a user\'s triggers';
$lang['adminOnClient']['delete_contact'] = 'You are about to delete a contact that belongs to a user\'s contact list';
$lang['adminOnClient']['import_contact'] = 'You are importing into a contact list that belongs to a user';

$lang['adminOnClient']['edit_segment'] = 'You are editing a segment that belongs to a user';


$lang['broadcast']['speed_updated'] = 'Success: Broadcast speed has been successfully updated.';
$lang['session']['deleted'] = 'Success: Device has been successfully deleted.';
$lang['password']['invalid'] = 'Error: Invalid old password.';
$lang['password']['updated'] = 'Success: Password has been successfully updated.';

$lang['user_id']['not_found'] = 'Error: User not found against provided user_id.';
$lang['invalid']['date'] = 'Error: Invalid date format.';


$lang['send_email']['api']['invalid_recp'] = "Error: recipients type must be an array.";
$lang['send_email']['api']['invalid_headers'] = "Error: custom_headers type must be an array.";
$lang['send_email']['api']['domain']['not_found'] = "Error: %%domain%% doesn't exist in your Sending Domains.";
$lang['send_email']['api']['domain']['not_verified'] = "Error: Your %%domain%% domain is not verified.";
$lang['send_email']['api']['domain']['not_auth'] = "Error: Your %%domain%% domain is not authenticated.";
$lang['send_email']['api']['bounce']['not_found'] = "Error: Bounce email %%bounce%% domain doesn't exist in your Sending Domains.";
$lang['send_email']['api']['bounce']['not_verified'] = "Error: Your bounce account %%bounce%% domain is not verified.";
$lang['send_email']['api']['bounce']['not_auth'] = "Error: Your bounce  account %%bounce%% domain is not authenticated.";
$lang['send_email']['api']['smtp']['inactive'] = "Error: No Active Smtp";
$lang['send_email']['api']['invalid_email'] = "Error: Invalid email format.";
$lang['logs']['not_found'] = "Error: Log not found";

$lang['stats']['bounce']['not_found'] = 'Error: Bounce stats do not exist.';
$lang['stats']['global']['not_found'] = 'Error: Global stats do not exist.';
$lang['stats']['open']['not_found'] = 'Error: Open stats do not exist.';
$lang['stats']['click']['not_found'] = 'Error: Click stats do not exist.';
$lang['stats']['unsub']['not_found'] = 'Error: Unsubscribe stats do not exist.';
$lang['stats']['spam']['not_found'] = 'Error: Complaint stats do not exist.';
$lang['stats']['log']['not_found'] = 'Error:  Stats Log do not exist.';
$lang['segment']['not_found'] = "Error: Segment doesn't exist.";
$lang['broadcast']['not_found'] = "Error: Broadcast doesn't exist.";
$lang['split_test']['not_found'] = "Error: Split test doesn't exist.";
$lang['smtp']['not_found'] = "Error: Active smtp doesn't exist.";
$lang['broadcast']['scheduled'] = "Success: A broadcast has been scheduled successfully.";
$lang['contacts_limit']['reached'] = "Error: Opsss... Contacts limit has been reached";
$lang['amazon']['subscription']['not_found'] = "Error: Opsss... Subscription file not found";
$lang['amazon']['subscription']['url_not_found'] = "Error: Opsss... Invalid Url format";
$lang['amazon']['subscription']['disclaimer'] = "<strong>Note:</strong> &nbsp;If you want to reconfirm the subscription, you'll need to send another confirmation request from Amazon SNS";

$lang['shared_controller']['record_status_title'] = 'Record status';

$lang['api_controller']['tracking_value_req_response'] = 'Tracking value is required to update';
$lang['api_controller']['tracking_updated_response'] = 'Tracking updated Successfully';
$lang['api_controller']['license_updated_response'] = 'License Attributes Updated';
$lang['api_controller']['nothing_update_response'] = 'nothing to update';
$lang['api_controller']['campaign_successfully_created_response'] = 'Campaign Successfully Created';
$lang['api_controller']['campaigns_not_found_response'] = 'campaigns not found';
$lang['api_controller']['campaigns_not_exist_response'] = 'Campaign do not exist';
$lang['api_controller']['campaign_successfully_deleted_response'] = 'Campaign successfully deleted';
$lang['api_controller']['segmentation_not_found_response'] = 'Segmentations not found';
$lang['api_controller']['segmentation_not_exist_response'] = 'Segmentation do not exist';
$lang['api_controller']['segment_used_campaign_response'] = 'Segment is being used in campaign';
$lang['api_controller']['segment_sucessfully_deleted_response'] = 'Segment successfully deleted';
$lang['api_controller']['follow_up_groups_not_found_response'] = 'Auto Follow-up groups not found';
$lang['api_controller']['follow_up_groups_not_exist_response'] = 'Auto Follow-up group do not exist';
$lang['api_controller']['follow_up_groups_used_response'] = 'Auto Follow-up group is being used';
$lang['api_controller']['follow_up_groups_successfully_deleted_response'] = 'Auto Follow-up group Successfully Deleted';
$lang['api_controller']['follow_up_not_found_response'] = 'Auto Follow-up not found';
$lang['api_controller']['follow_up_not_exist_response'] = 'Auto Follow-up do not exist';
$lang['api_controller']['follow_up_deleted_sucess_response'] = 'Auto Follow-up Successfully Deleted';
$lang['api_controller']['triggers_not_found_response'] = 'Triggers not found';
$lang['api_controller']['triggers_not_exist_response'] = 'Trigger do not exist';
$lang['api_controller']['triggers_sucessfully_deleted_response'] = 'Trigger Successfully Deleted';
$lang['api_controller']['triggers_already_exist_response'] = 'Trigger already exists';
$lang['api_controller']['triggers_sucessfully_added_response'] = 'Trigger Successfully Added';
$lang['api_controller']['triggers_sucessfully_updated_response'] = 'Trigger Successfully Updated';
$lang['api_controller']['sending_nodes_not_found_response'] = 'Sending Nodes not found';
$lang['api_controller']['sending_nodes_exists_response'] = 'Sending Node already exists';
$lang['api_controller']['sending_nodes_sucessfully_added_response'] = 'Sending Node Successfully Added';
$lang['api_controller']['sending_nodes_not_exist_response'] = 'Sending Node do not exist';
$lang['api_controller']['smtp_successfully_updated_response'] = 'Smtp Successfully Updated';
$lang['api_controller']['sending_nodes_sucessfully_deleted_response'] = 'Sending Node Successfully Deleted';
$lang['api_controller']['dynamic_tags_not_found_response'] = 'Dynamic Tags not found';
$lang['api_controller']['dynamic_tags_not_exist_response'] = 'Dynamic Tag do not exist';
$lang['api_controller']['dynamic_tags_sucessfully_deleted_response'] = 'Dynamic Tag Successfully Deleted';
$lang['api_controller']['web_form_not_found_response'] = 'Web Form not found';
$lang['api_controller']['web_form_exists_response'] = 'Web Form already exists';
$lang['api_controller']['web_form_sucessfully_added_response'] = 'Web Form Successfully Added';
$lang['api_controller']['web_form_not_found_exist_response'] = 'Web Form do not exist';
$lang['api_controller']['web_form_sucessfully_updated_response'] = 'Web Form Successfully Updated';
$lang['api_controller']['web_form_sucessfully_deleted_response'] = 'Web Form Successfully Deleted';
$lang['api_controller']['campaign_stats_not_exist_response'] = 'Campaign Stats do not exist';
$lang['api_controller']['_response'] = '';
$lang['api_controller']['_response'] = '';

$lang[''][''] = '';
return $lang;