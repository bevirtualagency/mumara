<?php
include("variables.php");
/**
 * Created by Mumara Team
 * Date: 06/17/2020
 */


/*------------- 1. Lists - Segments -----------/

/************* ** Page Top Bar ** *************/
$lang['page']['title']       = 'Segments';
$lang['page']['description'] = "A segment is a virtual list of the contacts based on similarities and likelihood. A segment is not an actual list but isn't less than an actual list as you can perform any action on a segment that you can perform on a contact list. A segment is a series of contacts that are grouped together based on multiple filters e.g people with first name as Ken or the people who have opened your broadcast from New York or so on.";

/************* ** General ** *************/
$lang['tools']           	 = 'Tools';
$lang['counting']        	 = 'Counting';
$lang['lists']           	 = 'Lists';
$lang['statistics']      	 = 'Statistics';
$lang['any_list']        	 = 'Any List';
$lang['activity_title']  	 = 'Segment';
	 
$lang['edit']            	 = 'Edit Segment';
$lang['contacts_count']            	 = 'Contacts Count';

$lang['update_existing']                       = 'Update existing';
$lang['copy_segment_title']                    = 'Copy Segment to a List';
$lang['move_segment_title']                    = 'Move Segment to a List';
$lang['select_lists']                          = 'Selected Lists';
$lang['modal-copy-move']['modal_title']        = 'Copy Segment to a List';
$lang['modal-copy-move']['choose_group']       = 'Choose Group';
$lang['modal-copy-move']['duplicate']          = 'Duplicate';
$lang['modal-copy-move']['duplicate_action']   = 'Duplicate Action';


/************* ** Datatable ** *************/
$lang['table_headings']['id']                  = 'ID';
$lang['table_headings']['sr']                  = 'Sr.';
$lang['table_headings']['name']                = 'Name';
$lang['table_headings']['created_by']          = $created_by;
$lang['table_headings']['type']                = 'Segment Type';
$lang['table_headings']['total']               = 'Total';
$lang['table_headings']['contacts']            = 'Contacts';
$lang['table_headings']['creation_date']       = $created_on;
$lang['table_headings']['actions']             = 'Actions';
//logHistory table heading 
$lang['table_headings']['description']         = 'Description';
$lang['table_headings']['action_performed_at'] = 'Action Performed at';

/************* ** Datatable Records Actions ** *************/
$lang['view_segment_list']['view_segemnt'] = 'View Segment';
$lang['view_segment_list']['edit_segemnt'] = 'Edit Segment';
$lang['view_segment_list']['recount']      = 'Recount';
$lang['view_segment_list']['move']         = 'Move Segment to a List';
$lang['view_segment_list']['view_segemnt']      = 'View Segment';
$lang['view_segment_list']['recount']           = 'Recount';
$lang['view_segment_list']['move']              = 'Move Segment to a List';
$lang['view_segment_list']['copy']              = 'Copy Segment to a List';
$lang['view_segment_list']['view_criteria']     = 'View Criteria';
$lang['view_segment_list']['export_segment']     = 'Export Segment';

/************* ** Messages ** *************/
$lang['message']['no_segment']             = "Are you sure to create a segment of 0 Subscribers?";
$lang['message']['make_segment']           = "Are you sure to create a segment of :subscribers_total Subscribers?";
$lang['message']['recount_success']        = 'Recount segment subscribers is scheduled';
$lang['message']['recount_fail']           = 'There is problem is recounting';
$lang['message']['select_user']            = 'Select A User';
$lang['message']['time_taking']            = 'It is taking time. save the segemnt and view the result';

/*-------------- 2. Lists - Segments - Add New Segment ----------------*/

/************* ** Page Top Bar ** *************/
$lang['add_new']['page']['title']       = 'Add New Segment';
$lang['edit_new']['page']['title']       = 'Edit Segment';
$lang['add_new']['page']['description'] = 'Segmentation of the data stored in your lists, makes it possible for you to send content which your contacts wish to receive, select list(s) and set filters to create new segments.';

/************* ** Form ** *************/

$lang['add_new']['form']['title']                         = 'Segment Details';
$lang['add_new']['field']['segment_name']                 = 'Segment Name';
$lang['add_new']['field']['based_list']                   = 'Based on Contact Lists';
$lang['add_new']['field']['based_list_description']       = 'This type of segment allows you to group your contacts across multiple lists based on similar field values and/or statuses. Have a look on the screenshot below then continuing further';
$lang['add_new']['field']['based_statistics']             = 'Based on Statistics';
$lang['add_new']['field']['based_statistics_description'] = 'Group your contacts based on similar engagements and activities.';
$lang['add_new']['field']['filter_by_list']               = 'Filter by List';
$lang['add_new']['field']['any_contact_list']             = 'Any Contact List';
$lang['add_new']['field']['any_contact_list_help']        = 'This option ignores the list-specific criteria and selects all lists globally. So any filters you apply will search for the contacts across the whole database.';
$lang['add_new']['field']['contact_lists_help']           = 'It allows you to choose specific/multiple contact lists to find the filtered contacts from.';
$lang['add_new']['field']['our_contact_list']             = 'Our Contact lists';
$lang['add_new']['field']['user_specific_lists']          = 'User-specific Lists';
$lang['add_new']['field']['specific']                     = 'Specific Contact Lists';
$lang['add_new']['field']['users_lists']                  = "User's Lists";
$lang['add_new']['field']['all_lists']                    = "All Lists";
$lang['add_new']['field']['list_type']                    = "Lists Type";
$lang['add_new']['field']['select_list']                  = 'Select List';
$lang['add_new']['field']['groups']                       = 'Member Of';
$lang['add_new']['field']['custom_criteria']              = 'Custom Criteria';
$lang['add_new']['field']['custom_criteria_help'] 		  = 'It allows you to apply filters on list names/groups that auto-selects all lists with matching criteria.';
$lang['add_new']['field']['advance_criteria']              = 'Advance Criteria';
$lang['add_new']['field']['advance_criteria_help'] 		  = 'It allows you to apply filters on list names/groups that auto-selects all lists with matching criteria.';
$lang['add_new']['field']['broadcasts_type']              = 'Broadcasts type';
$lang['add_new']['field']['our_broadcasts']               = 'Our Broadcasts';
$lang['add_new']['field']['user_specific_broadcasts']     = 'User Specific Broadcasts';
$lang['add_new']['field']['all_broadcasts']               = 'All Broadcasts Globally';
$lang['add_new']['field']['contact_lists']                = 'Contact Lists';
$lang['add_new']['field']['select_all']                   = 'Select all';
$lang['add_new']['field']['select_group']                 = 'Groups';
$lang['add_new']['field']['select_group_help']            = 'Segments can also be created on all lists globally that belong to the specific group(s). It will allow you to select the groups instead of lists.';
$lang['add_new']['field']['select_one_list']              = 'Select At least one list';
$lang['add_new']['field']['select_criteria']              = 'Select Criteria';
$lang['add_new']['field']['list_name']                    = 'List Name';
$lang['add_new']['field']['group_name']                   = 'Group Name';
$lang['add_new']['field']['any_broadcast']                = 'Any Broadcast';
$lang['add_new']['field']['broadcasts']                   = 'Broadcasts';
$lang['add_new']['field']['select_broadcast']             = 'Selected Broadcasts';
$lang['add_new']['field']['apply_filters']                = 'Apply Filters';
$lang['add_new']['field']['select_option']                = 'Select Option';
$lang['add_new']['field']['comma_separated_list']         = 'Comma Separated List';
$lang['add_new']['field']['confirmed']                    = 'Confirmed';
$lang['add_new']['field']['unconfirmed']                  = 'Unconfirmed';
$lang['add_new']['field']['text']                         = 'Text';
$lang['add_new']['field']['html']                         = 'HTML';
$lang['add_new']['field']['not_bounced']                         = 'Not Bounced';
$lang['add_new']['field']['hard_bounce']                         = 'Hard Bounced';
$lang['add_new']['field']['soft_bounce']                         = 'Soft Bounced';
$lang['add_new']['field']['date_field']                   = 'Date Field';
$lang['add_new']['field']['select_duration']              = 'Select Duration';
$lang['add_new']['field']['placeholder']['xx_days']       = 'XX no. of days / time';

// Dynamic Duration
$lang['add_new']['field']['dynamic_duration']['values']['is_due_in']      = 'Occurring after';
$lang['add_new']['field']['dynamic_duration']['values']['is_overdue_for'] = 'Occurred before';
$lang['add_new']['field']['dynamic_duration']['values']['past']           = 'For the past';
$lang['add_new']['field']['dynamic_duration']['values']['older_than']     = 'Older than';
$lang['add_new']['field']['dynamic_duration']['values']['minutes']        = 'Minutes';
$lang['add_new']['field']['dynamic_duration']['values']['hours']          = 'Hours';
$lang['add_new']['field']['dynamic_duration']['values']['days']           = 'Days';
$lang['add_new']['field']['dynamic_duration']['values']['weeks']          = 'Weeks';
$lang['add_new']['field']['dynamic_duration']['values']['months']         = 'Months';
$lang['add_new']['field']['dynamic_duration']['values']['years']          = 'Years';
$lang['add_new']['field']['dynamic_duration']['title']                    = 'Dynamic Duration';
// Date Duration
$lang['add_new']['field']['date_duration']['values']['after']             = 'After';
$lang['add_new']['field']['date_duration']['values']['before']            = 'Before';
$lang['add_new']['field']['date_duration']['values']['exactly']           = 'Exactly';
$lang['add_new']['field']['date_duration']['values']['between']           = 'Between';
$lang['add_new']['field']['date_duration']['values']['is_due_in']         = 'Occurring after';
$lang['add_new']['field']['date_duration']['values']['is_overdue_for']    = 'Occurred before';
$lang['add_new']['field']['date_duration']['values']['past']              = 'For the past';
$lang['add_new']['field']['date_duration']['values']['older_than']        = 'Older than';
$lang['add_new']['field']['date_duration']['values']['minutes'] 		  = 'Minutes';
$lang['add_new']['field']['date_duration']['values']['hours']   		  = 'Hours';
$lang['add_new']['field']['date_duration']['values']['days']    		  = 'Days';
$lang['add_new']['field']['date_duration']['values']['weeks']   		  = 'Weeks';
$lang['add_new']['field']['date_duration']['values']['months']  		  = 'Months';
$lang['add_new']['field']['date_duration']['values']['years']             = 'Years';

$lang['add_new']['field']['country']              = 'Country';
$lang['add_new']['field']['any_country']          = 'Any Country';
$lang['add_new']['field']['selected_country']     = 'Selected Countries';
$lang['add_new']['field']['choose']['country']    = 'Choose Country';

$lang['add_new']['field']['state']                = 'State';
$lang['add_new']['field']['any_state']            = 'Any State';
$lang['add_new']['field']['selected_state']       = 'Selected State';
$lang['add_new']['field']['choose']['state']      = 'Choose State';

$lang['add_new']['field']['city']                 = 'City';
$lang['add_new']['field']['any_city']             = 'Any City';
$lang['add_new']['field']['selected_city']        = 'Selected Cities';
$lang['add_new']['field']['choose']['city']       = 'Choose City';

$lang['add_new']['field']['zip']                  = 'Zip';
$lang['add_new']['field']['any_zip']              = 'Any Zip';
$lang['add_new']['field']['selected_zip']         = 'Selected zips';
$lang['add_new']['field']['choose']['zip'] 		  = 'Choose Zip';

$lang['add_new']['field']['browser']              = 'Browser';
$lang['add_new']['field']['any_browser']          = 'Any Browser';
$lang['add_new']['field']['selected_browser']     = 'Selected Browsers';
$lang['add_new']['field']['choose']['browser']    = 'Choose Browser';

$lang['add_new']['field']['os']                   = 'Operating System';
$lang['add_new']['field']['any_os']               = 'Any OS';
$lang['add_new']['field']['selected_os']          = 'Selected OS';
$lang['add_new']['field']['choose']['os']         = 'Choose Operating System';

$lang['add_new']['field']['choose']['campaign']   = 'Choose Campaign';
$lang['add_new']['field']['choose']['link']       = 'Choose Link';

$lang['add_new']['field']['duration']             = 'Duration';
$lang['add_new']['field']['none']                 = 'None';

// Criteria
$lang['add_new']['field']['select_criteria']                 = 'Select Criteria';
$lang['add_new']['field']['has_opened_broadcast']            = 'Has opened';
$lang['add_new']['field']['hasnt_opened_any_broadcast']      = 'Hasn’t opened';
$lang['add_new']['field']['has_unsubscribe']                 = 'Has UnSubscribed';
$lang['add_new']['field']['has_complained']                  = 'Has Complained';
$lang['add_new']['field']['sent']                            = 'Sent';
$lang['add_new']['field']['never_sent']                      = 'Never Sent';
$lang['add_new']['field']['injected_into_mta']               = 'Injected into MTA';
$lang['add_new']['field']['delivered']                       = 'Delivered';
$lang['add_new']['field']['delayed']                         = 'Delayed';
$lang['add_new']['field']['bounced']                         = 'Bounced';
$lang['add_new']['field']['and']                             = 'AND';
$lang['add_new']['field']['clicked_on_link']                 = 'Clicked on a link';
$lang['add_new']['field']['hasnt_clicked_on_link']           = 'Hasn’t clicked on any link';
$lang['add_new']['field']['any_link']                        = 'Any link';
$lang['add_new']['field']['selected_links']                  = 'Selected Links';
$lang['add_new']['field']['type']                            = 'Type';
$lang['add_new']['field']['bounce_reason']                   = 'Bounce Reason';
$lang['add_new']['field']['soft_bounce']                     = 'Soft Bounced';
$lang['add_new']['field']['hard_bounce']                     = 'Hard Bounced';
$lang['add_new']['field']['bounce_code']                     = 'Bounce Code';
$lang['add_new']['field']['bounce_details']                  = 'Bounce Details';
$lang['add_new']['field']['filter_is']                       = 'is';
$lang['add_new']['field']['filter_isnt']                     = 'Isn&apos;t';

// Custom fields filter options
$lang['add_new']['customfield_filters']['set_rules']['values']['contain']      = 'Contains';
$lang['add_new']['customfield_filters']['set_rules']['values']['not_contain']  = 'Doesn\'t Contain';
$lang['add_new']['customfield_filters']['set_rules']['values']['equal']        = 'Equal';
$lang['add_new']['customfield_filters']['set_rules']['values']['not_equal']    = 'Isn`t Equal';
$lang['add_new']['customfield_filters']['set_rules']['values']['start']        = 'Starts With';
$lang['add_new']['customfield_filters']['set_rules']['values']['end']          = 'Ends With';
$lang['add_new']['customfield_filters']['set_rules']['values']['greater']      = 'Starts with and greater than';
$lang['add_new']['customfield_filters']['set_rules']['values']['less']         = 'Starts with and less than';


/************* ** Filters ** *************/
$lang['filter']['is']                           = 'Is';
$lang['filter']['is_not']                       = 'Isn`t';
$lang['filter']['contain']                      = 'Contains';
$lang['filter']['does_not_contain']             = 'Doesn\'t contain';
$lang['filter']['starts_with'] 				    = 'Starts with';
$lang['filter']['ends_at']     				    = 'Ends at';
$lang['filter']['first_alphabet_greater_equal'] = 'First alphabet is greater than and equal to';
$lang['filter']['first_alphabet_lesser_equal']  = 'First alphabet is lesser than and equal to';
$lang['filter']['lesser_equal']                 = 'Lesser than';
$lang['filter']['greater_than']                 = 'Greater than';
$lang['filter']['lesser_than']                  = 'Lesser than';
$lang['filter']['domain_is']        			= 'Domain is';
$lang['filter']['domain_isnt']      			= 'domain isn`t';
$lang['filter']['domain_is_not']      			= 'domain isn`t';
$lang['filter']['by_activity']      			= 'Filter by Activity';
$lang['filter']['after']            			= 'After';
$lang['filter']['before']           			= 'Before';
$lang['filter']['exactly']          			= 'Exactly On';
$lang['filter']['between']          			= 'Between';
$lang['filter']['occurring_before'] 			= 'Occurred Before';
$lang['filter']['occurred_after'] 			    = 'Occurred After';
$lang['filter']['for_the_past']     			= 'For the past';
$lang['filter']['older_than']                   = 'Older than';
$lang['filter']['is_today']                   = 'Is Today';
$lang['filter']['day_of_month']                   = 'Day of Month';
$lang['filter']['month_of_year']                   = 'Month of Year';
$lang['filter']['january']                   = 'January';
$lang['filter']['february']                   = 'February';
$lang['filter']['march']                   = 'March';
$lang['filter']['april']                   = 'April';
$lang['filter']['may']                   = 'May';
$lang['filter']['june']                   = 'June';
$lang['filter']['july']                   = 'July';
$lang['filter']['august']                   = 'August';
$lang['filter']['september']                   = 'September';
$lang['filter']['october']                   = 'October';
$lang['filter']['november']                   = 'November';
$lang['filter']['december']                   = 'December';
$lang['filter']['todays_date']                   = "Today's Date";
$lang['filter']['this_month']                   = "This Month";




$lang['filter']['subscriber']['options']['select_option']        = 'Select Option';
$lang['filter']['subscriber']['options']['status']               = 'Status';
$lang['filter']['subscriber']['options']['subscriber_status']    = 'Contact Status';
$lang['filter']['subscriber']['options']['suppression_status']    = 'Suppression Status';
$lang['filter']['subscriber']['options']['subscription_status']  = 'Subscription Status';
$lang['filter']['subscriber']['options']['confirmation_status']  = 'Confirmation Status';
$lang['filter']['subscriber']['options']['complained_status']    = 'complained Status';
$lang['filter']['subscriber']['options']['fbl_status']           = 'FBL Status';
$lang['filter']['subscriber']['options']['spammed']              = 'Spammed';
$lang['filter']['subscriber']['options']['not_spammed']          = 'Not Spammed';
$lang['filter']['subscriber']['options']['content_format']       = 'Content Format';
$lang['filter']['subscriber']['options']['creation_date']        = 'Creation date';
$lang['filter']['subscriber']['options']['bounce_status']        = 'Bounce Status';
$lang['filter']['subscriber']['options']['by_field_value']       = 'By Field Value';
$lang['filter']['subscriber']['options']['email']                = 'Email';

$lang['filter']['subscriber']['conditions']['is']                = 'Is';
$lang['filter']['subscriber']['conditions']['is_not']            = 'Isn`t';
$lang['filter']['subscriber']['values']['active']                = 'Active';
$lang['filter']['subscriber']['values']['unsubscribed']          = 'Unsubscribed';

$lang['filter']['contact_list']      = 'Contact List';
$lang['filter']['sending_node_type'] = 'Sending Node Type';
$lang['filter']['sending_node']      = 'Sending Node';
$lang['filter']['sending_domain']    = 'Sending Domain';
$lang['filter']['send_from_email']   = 'Send From Email';
$lang['filter']['bounce_email']      = 'Bounce Email';
$lang['filter']['reply_to_email']    = 'Reply-to Email';
$lang['filter']['recipient_email']   = 'Recipient Email';
$lang['filter']['schedule_email']    = 'Schedule Label';
$lang['filter']['message_id']        = 'Message-ID';

/*============== End of add new page =========*/

/*-------------- 3. Lists - Segments - View Segment ----------------*/

$lang['view_segment']['page']['title']                        = 'View Segment';
$lang['view_segment']['page']['description']                  = 'View Segment Description';
$lang['view_segment']['view_segment_list']['view_segemnt']    = 'View Segment';
$lang['view_segment']['based_statistics']                     = 'Based on Statistics';
$lang['view_segment']['based_lists']                          = 'Based on Contact Lists';
$lang['view_segment']['filter_by_list']                       = 'Filter by List';
$lang['view_segment']['filter_by_statistics']                 = 'Filter by Statistics';
$lang['view_segment']['select_list']                          = 'Select List';
$lang['view_segment']['any_contact_list']                     = 'Any contact list';
$lang['view_segment']['contact_list']                         = 'Contact list';
$lang['view_segment']['groups']                               = 'Groups';
$lang['view_segment']['custom_criteria']                      = 'Custom Criteria';
$lang['view_segment']['list_name']                            = 'List Name';
$lang['view_segment']['list_group']                           = 'Group Name';
$lang['view_segment']['apply_filters']                        = 'Apply Filters';
$lang['view_segment']['status']                               = 'Status';
$lang['view_segment']['bounce_status']                               = 'Bounce Status';
$lang['view_segment']['subscription_status']                  = 'Subscription Status';
$lang['view_segment']['confirmation_status']                  = 'Confirmation Status';
$lang['view_segment']['complained_status']   				  = 'Complained status';
$lang['view_segment']['content_format']      				  = 'Content Format';
$lang['view_segment']['creation_date']       				  = 'Creation date';
$lang['view_segment']['email']               				  = 'Email';
$lang['view_segment']['filter_by_activity']  				  = 'Filter by Activity';
$lang['view_segment']['broadcasts']          				  = 'Broadcasts';
$lang['view_segment']['selected_broadcasts'] 				  = 'Selected Broadcasts';
$lang['view_segment']['select_criteria']     				  = 'Select Criteria';
$lang['view_segment']['any']                 				  = 'Any';
$lang['view_segment']['has_opened_broadcast']  				  = 'Has opened the broadcast';
$lang['view_segment']['hasnt_opened_broadcast']				  = 'Hasn’t opened any broadcast';
$lang['view_segment']['has_unsubscribed']      				  = 'Has UnSubscribed';
$lang['view_segment']['has_complained']        				  = 'Has Complained';
$lang['view_segment']['is_sent']               				  = 'Sent';
$lang['view_segment']['never_sent']            				  = 'Never Sent';
$lang['view_segment']['injected']              				  = 'Injected into MTA';
$lang['view_segment']['delivered']             				  = 'Delivered';
$lang['view_segment']['delayed']               				  = 'Delayed';
$lang['view_segment']['bounced']               				  = 'Bounced';
$lang['view_segment']['clicked_on_a_link'] 		    		  = 'Clicked on a link';
$lang['view_segment']['has_not_clicked_on_any_link']		  = 'Hasn’t clicked on any link';
$lang['view_segment']['and']               		    		  = 'AND';
$lang['view_segment']['any_link']          		    		  = 'Any Link';
$lang['view_segment']['selected_link']     		    		  = 'Selected Links';
$lang['view_segment']['any_country']       		    		  = 'Any Country';
$lang['view_segment']['selected_countries']		    		  = 'Selected Countries';
$lang['view_segment']['any_state']         		    		  = 'Any State';
$lang['view_segment']['selected_state']    		    		  = 'Selected State';
$lang['view_segment']['any_city'] 							  = 'Any City';
$lang['view_segment']['selected_city']    					  = 'Selected City';
$lang['view_segment']['any_zip']  							  = 'Any Zip';
$lang['view_segment']['selected_zip']     					  = 'Selected Zip';
$lang['view_segment']['any_browser']      					  = 'Any Browser';
$lang['view_segment']['selected_browser'] 					  = 'Selected Browser';
$lang['view_segment']['any_os']   							  = 'Any OS';
$lang['view_segment']['selected_os']      					  = 'Selected OS';
$lang['view_segment']['none']             					  = 'None';
$lang['view_segment']['duration']         					  = 'Duration';
$lang['view_segment']['by_date']  							  = 'By Date';
$lang['view_segment']['after']            					  = 'After';
$lang['view_segment']['before']           					  = 'Before';
$lang['view_segment']['exactly_on']       					  = 'Exactly on';
$lang['view_segment']['exactly']           					  = 'Exactly';
$lang['view_segment']['is_overdue_for'] 					  = 'Occurred before';
$lang['view_segment']['past']              					  = 'For the past';
$lang['view_segment']['between']          					  = 'Between';
$lang['view_segment']['from']             					  = 'from';
$lang['view_segment']['to']               					  = 'To';
$lang['view_segment']['occurred_before']  					  = 'Occurred Before';
$lang['view_segment']['for_the_past']     					  = 'For the past';
$lang['view_segment']['older']       					      = 'Older than';
$lang['view_segment']['older_than']       					  = 'Older than';
$lang['view_segment']['contact_list']     					  = 'Contact lists';
$lang['view_segment']['sending_node_type']					  = 'Sending node type';
$lang['view_segment']['sending_node']     					  = 'Sending node';
$lang['view_segment']['sending_domain']   					  = 'Sending domain';
$lang['view_segment']['send_from_email']  					  = 'Send From Email';
$lang['view_segment']['bounce_email']     					  = 'Bounce Email';
$lang['view_segment']['reply_to_email']						  = 'Reply to Email';
$lang['view_segment']['recipient_email']  					  = 'Recipient Email';
$lang['view_segment']['schedule_label']   					  = 'Schedule Label';
$lang['view_segment']['message_id']       					  = 'Message ID';
$lang['view_segment']['is']               					  = 'Is';
$lang['view_segment']['is_not']           					  = 'Is Not';
$lang['view_segment']['contain']          					  = 'Contain';
$lang['view_segment']['not_contain']              			  = "Doesn't contain";
$lang['view_segment']['start_with']               			  = "Start With";
$lang['view_segment']['end_at']                   			  = "End At";
$lang['view_segment']['domain_is']                			  = "Domain is";
$lang['view_segment']['domain_is_not']            			  = "Domain isn`t";
$lang['view_segment']['first_alpha_greater_equal']			  = "First alphabet is greater than and equal to";
$lang['view_segment']['first_alpha_lesser_equal'] 			  = "First alphabet is lesser than and equal to";
$lang['view_segment']['is_due_in']                			  = "Is due in";
$lang['view_segment']['segment_copying']          			  = 'Segmented data is Copying.';
$lang['view_segment']['segment_moving']                       = 'Segmented data is Moving';
$lang['view_segment']['segment_exporting']                    = 'Segmented data is Exporting.';
$lang['view_segment']['no_proccess']                          = 'No Process';


$lang['view_segment']['create']['select_country']['required'] = "Error: Missing required parameter, select country";
$lang['view_segment']['create']['select_state']['required']   = "Error: Missing required parameter, select state";
$lang['view_segment']['create']['select_city']['required']    = "Error: Missing required parameter, select city";
$lang['view_segment']['create']['select_zip']['required']     = "Error: Missing required parameter, select zip";

/*============== End of View Segment =========*/


/*------------- 4. Lists - Segments - Export Segment -----------*/


/************* ** Page Top Bar ** *************/
$lang['export_segments']['page']['title']       = 'Export Segment';
$lang['export_segments']['page']['description'] = 'Following area helps you export a .CSV of the segment by selecting the desired fields you want to keep in the exporting file.';

/************* ** General ** *************/
$lang['export_segments']['exporting']           		= 'Exporting segment <b>:title</b> to a CSV file';
$lang['export_segments']['waiting_to_export']           = 'Waiting to export';
$lang['export_segments']['choose_custom_fields']        = 'Choose Custom Fields';
$lang['export_segments']['email']                       = 'Email';
$lang['export_segments']['select_one_field']            = 'Select at least one field';
$lang['export_segments']['labels']['geo_stats']         = 'Statistics';
$lang['export_segments']['labels']['geo_country']       = 'Geo Country';
$lang['export_segments']['labels']['geo_state']         = 'Geo State';
$lang['export_segments']['labels']['geo_city']          = 'Geo City';
$lang['export_segments']['labels']['geo_zip']           = 'Geo Zip';
$lang['export_segments']['labels']['browser']           = 'Browser';
$lang['export_segments']['labels']['operating_system']  = 'Operating System';
$lang['export_segments']['labels']['link_clicked']      = 'Link Clicked';
$lang['export_segments']['labels']['message_id']        = 'Message-ID';
$lang['export_segments']['labels']['stop_export_message']        = 'Segment-%%segemnt_name%% export has been stoped';

/************* ** Messages ** *************/
$lang['export_segments']['message']['success'] = 'Segment has been schedule in background for export to csv.';
$lang['export_segments']['message']['error']   = 'Oop`s something went wrong, try later.';
//added by azeem dated 08-10-2021
$lang['export_segments']['campaign']                          = 'Campaign';
$lang['export_segments']['labels']['campaign_name']           = 'Campaign name';
$lang['export_segments']['labels']['group_name']              = 'Group name';
$lang['export_segments']['labels']['subject_line']            = 'Subject line';
$lang['export_segments']['labels']['broadcast_creation_date'] = 'Broadcast Creation Date';
$lang['export_segments']['labels']['campaign_sent_date'] = 'Campaign Sent Date';
$lang['export_segments']['labels']['file_not_exist'] = 'File not exist';
//end added by azeem dated 08-10-2021

/*============== End of Export Segment =========*/

/*------------- 5. Lists - Segments - View Total Subscribers -----------/

/************* ** Page Top Bar ** *************/
$lang['segment_subscribers']['page']['title']       = 'View/Search Contacts of the Segment :name';
$lang['segment_subscribers']['page']['description'] = 'View Segment Subscribers';

/************* ** General ** *************/
$lang['segment_subscribers']['tools']          = 'Tools';
$lang['segment_subscribers']['modal']['title'] = 'Subscriber Details';

/************* ** Datatable ** *************/
$lang['segment_subscribers']['table_headings']['id']            = 'ID';
$lang['segment_subscribers']['table_headings']['email']         = 'Email';
$lang['segment_subscribers']['table_headings']['first_name']    = 'First Name';
$lang['segment_subscribers']['table_headings']['last_name']     = 'Last Name';
$lang['segment_subscribers']['table_headings']['bounced']       = 'Bounced';
$lang['segment_subscribers']['table_headings']['unsubscribed']  = 'Unsubscribed';
$lang['segment_subscribers']['table_headings']['confirmed']     = 'Confirmed';
$lang['segment_subscribers']['table_headings']['created_date']  = 'Created Date';
$lang['segment_subscribers']['table_headings']['actions']       = 'Actions';


$lang['add']['error']['broadcast_type']       = 'Select Broadcast type.';
$lang['add']['error']['broadcast']       = 'Select Broadcasts.';
$lang['add']['error']['criteria']       = 'Select Criteria.';
$lang['add']['error']['select_broadcast']       = 'Select at least one broadcast.';
$lang['add']['note'] = 'Note';
$lang['add']['log_notification'] = 'The log retention has been set to <code>%%keep_log_for%% Days</code>, so several filters linked to the logs may not pull data longer than this.';

/************* ** Errors ** *************/
$lang['copy']['heading']       = 'Copy to another List';
$lang['copy']['error1']        = '<b>Error: </b> Your segment was created on a global criteria and it can\'t be copied to another list.';
$lang['copy']['error2']        = '<b>Reason: </b> The destination contact list shouldn\'t be a part of source contact lists.';

$lang['move']['heading']       = 'Move to another List';
$lang['move']['error1']        = '<b>Error: </b> Your segment was created on a global criteria and it can\'t be moved to another list.';
$lang['move']['error2']        = '<b>Reason: </b> The destination contact list shouldn\'t be a part of source contact lists.';
$lang['select_segment']      = 'Select segment';
$lang['select_segment_error']      = 'Select a segment';
$lang['segments']      = 'Segments';
$lang['delete_segment']['alert'] = '<b>Error: </b> Un-assign the segment ":segment" from the associated assets and then delete it.';
$lang['delete_segment']['alert2'] = '<b>Error: </b> Un-assign these segments ":segment" from the associated assets and then delete it.';
$lang['delete_segment']['mdl_title'] = 'Dependency check';
$lang['delete_segment']['campaign_schedule'] = "Schedule campaigns";


$lang['segmentation_controller']['copying_span'] = "Copying";
$lang['segmentation_controller']['moving_span'] = "Moving";
$lang['segmentation_controller']['exporting_span'] = "Exporting";
$lang['segmentation_controller']['the_limit_reached_session'] = "Opsss... The limit has been reached.";
$lang['segmentation_controller']['action_contact_admin'] = "Contact administrator!";
$lang['segmentation_controller']['segment_exported_activity'] = "Segment Exported";
$lang['segmentation_controller']['export_supressed_list'] = "Export Supressed list not saved";
$lang['segmentation_controller']['Export_list_stop_error'] = "Export List stop error: ";

$lang['admin_segment_create_blade']['list_select_opt'] = "List";
$lang['admin_segment_create_blade']['is_member_option'] = "Is Member of";
$lang['admin_segment_create_blade']['is_not_member_option'] = "Isn't Member of";
$lang['admin_segment_create_blade']['my_list_select_opt'] = "My Lists";
$lang['admin_segment_create_blade']['fill_all_compulsary_alert'] = "Fill All compulsary fields";
$lang['admin_segment_create_blade']['select_suppressed_opt'] = "Suppressed";

$lang['index_blade']['segments_limit_button'] = "Segments Limit:";

$lang['user_segment_create_blade']['taking_time_segment_alert'] = "It is taking time. save the segemnt and view the result";
$lang['user_segment_create_blade']['fill_compulsary_alert'] = "Fill All compulsary fields";

$lang['users_dropdown_blade']['select_an_option'] = "Select An Option";
$lang[''][''] = "";
$lang[''][''] = "";



/*============== End of View Total Subscribers =========*/
return $lang;
