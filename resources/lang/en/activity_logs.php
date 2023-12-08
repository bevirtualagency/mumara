<?php
include("variables.php");
/**
 * Created by Mumara Team
 * Date: 07/02/2020
 */
/*-------------- Subscribers ----------------*/

$lang['AddContact']           = 'Contact <b>:id</b> has been added to the list <b>:list_name</b> by <b>:user_name</b>';

$lang['EditContact']          = 'Contact <b>:id</b> has been edited by <b>:user_name</b>';

$lang['DeleteContact']        = 'Contact <b>:id</b> has been deleted by <b>:user_name</b>';

$lang['AddContactList']       = 'Contact list <b>:list_name</b> has been added by <b>:user_name</b>';

$lang['EditContactList']      = 'Contact list <b>:list_name</b> has been edited by <b>:user_name</b>';

$lang['DeleteContactList']    = 'Contact list <b>:list_name</b> has been deleted by <b>:user_name</b>';

$lang['ImportList']           = ':total contacts have been imported into <b>:list_name</b> by <b>:user_name</b>';

$lang['ExportList']           = 'Contact list <b>:list_name</b> has been exported by <b>:user_name</b>';

$lang['AddCustomField']       ='Custom field <b>:name</b> has been added by <b>:user_name</b>';

$lang['EditCustomField']      ='Custom field <b>:name</b> has been edited by <b>:user_name</b>';

$lang['DeleteCustomField']    ='Custom field <b>:name</b> has been deleted by <b>:user_name</b>';

$lang['AddSegment']           ='Segment <b>:name</b> has been created by <b>:user_name</b>';

$lang['EditSegment']          ='Segment <b>:name</b> has been edited by <b>:user_name</b>';

$lang['DeleteSegment']        ='Segment <b>:name</b> has been deleted by <b>:user_name</b>';

$lang['ExportSegment']        ='Segment <b>:name</b> has been exported by <b>:user_name</b>';

$lang['AddBroadcast']='Broadcast <b>:name</b> has been added by <b>:user_name</b>';

$lang['EditBroadcast']='Broadcast <b>:name</b> has been edited by <b>:user_name</b>';

$lang['DeleteBroadcast']='Broadcast <b>:name</b> has been deleted by <b>:user_name</b>';

$lang['AddDripGroup']='Drip Group <b>:name</b> has been added by <b>:user_name</b>';

$lang['EditDripGroup']='Drip Group <b>:name</b> has been edited by <b>:user_name</b>';

$lang['DeleteDripGroup']='Drip Group <b>:name</b> has been deleted by <b>:user_name</b>';

$lang['AddDrip']='Drip <b>:name</b> has been added by <b>:user_name</b>';

$lang['EditDrip']='Drip <b>:name</b> has been edited by <b>:user_name</b>';

$lang['DeleteDrip']='Drip <b>:name</b> has been deleted by <b>:user_name</b>';

$lang['AddSplitTest']='Split test <b>:name</b> has been added by <b>:user_name</b>';

$lang['EditSplitTest']='Split test <b>:name</b> has been edited by <b>:user_name</b>';

$lang['DeleteSplitTest']='Split test <b>:name</b> has been deleted by <b>:user_name</b>';

$lang['AddSpinTag']='Spintag <b>:name</b> has been added by <b>:user_name</b>';

$lang['EditSpingTag']='Spintag <b>:name</b> has been edited by <b>:user_name</b>';

$lang['DeleteSpinTag']='Spintag <b>:name</b> has been deleted by <b>:user_name</b>';

$lang['AddDynamicContentTag']='Dynamic Tag <b>:name</b> has been added by <b>:user_name</b>';

$lang['EditDynamicContentTag']='Dynamic Tag <b>:name</b> has been edited by <b>:user_name</b>';

$lang['DeleteDynamicContentTag']='Dynamic Tag <b>:name</b> has been deleted by <b>:user_name</b>';

$lang['ScheduleBroadcast']='Campaign <b>:name</b> has been scheduled by <b>:user_name</b>';

$lang['StartBroadcast']='Campaign <b>:name</b> scheduled by <b>:user_name</b> has been started';

$lang['PauseBroadcast']='Campaign <b>:name</b> has been paused by <b>:user_name</b>';

$lang['SystemPauseBroadcast']='Campaign <b>:name</b> has been system-paused**';

$lang['ResumeBroadcast']='Campaign <b>:name</b> has been resumed by <b>:user_name</b>';

$lang['DeleteScheduledBroadcast']='Campaign <b>:name</b> has been deleted by <b>:user_name</b>';

$lang['AddTrigger']='Trigger <b>:name</b> has been added by <b>:user_name</b>';

$lang['EditTrigger']='Trigger <b>:name</b> has been edited by <b>:user_name</b>';

$lang['DeleteTrigger']='Trigger <b>:name</b> has been deleted by <b>:user_name</b>';

$lang['AddBounceAddress']='Bounce address <b>:id</b> has been added by <b>:user_name</b>';

$lang['EditBounceAddress']='Bounce address <b>:id</b> has been edited by <b>:user_name</b>';

$lang['DeleteBounceAddress']='Bounce address <b>:id</b> has been deleted by <b>:user_name</b>';

$lang['AddBounceRule']='Bounce rule <b>:id</b> has been added by <b>:user_name</b>';

$lang['EditBounceRule']='Bounce rule <b>:id</b> has been edited by <b>:user_name</b>';

$lang['DeleteBounceRule']='Bounce rule <b>:id</b> has been deleted by <b>:user_name</b>';

$lang['AddSendingDomain']='Sending Domain <b>:domain</b> has been added by <b>:user_name</b>';

$lang['EditSendingDomain']='Sending Domain <b>:domain</b> has been edited by <b>:user_name</b>';

$lang['DeleteSendingDomain']='Sending Domain <b>:domain</b> has been deleted by <b>:user_name</b>';

$lang['AddSendingNode']='Sending Node <b>:name</b> has been added by <b>:user_name</b>';

$lang['EditSendingNode']='Sending Node <b>:name</b> has been edited by <b>:user_name</b>';

$lang['DeleteSendingNode']='Sending Node <b>:name</b> has been deleted by <b>:user_name</b>';

$lang['AddWebForm']='Web Form <b>:name</b> has been added by <b>:user_name</b>';

$lang['EditWebForm']='Web Form <b>:name</b> has been edited by <b>:user_name</b>';

$lang['DeleteWebForm']='Web Form <b>:name</b> has been deleted by <b>:user_name</b>';

$lang['AddFeebackLoop']='Feedback Loop <b>:id</b> has been added by <b>:user_name</b>';

$lang['EditFeebackLoop']='Feedback Loop <b>:id</b> has been edited by <b>:user_name</b>';

$lang['DeleteFeebackLoop']='Feedback Loop <b>:id</b> has been deleted by <b>:user_name</b>';

$lang['AddSuppression']   =':total have been imported into Suppression (<b>:ref_name</b>) by <b>:user_name</b>';
$lang['AddIpSuppression'] =':total have been added into Suppression (<b>:ref_name</b>) by <b>:user_name</b>';
$lang['ExportSupressionEmail']        ='Supressed email list  has been exported by <b>:user_name</b>';
$lang['ExportSupressionDomain']        ='Supressed domain list has been exported by <b>:user_name</b>';
return $lang;