<?php
include("variables.php");
/**
 * Created by Mumara Team
 * Date: 07/10/2020
 */
/*-------------- 1. Setup -> Multi-threading ----------------*/

$lang['page']['title']                 = 'Multithreading';
$lang['page']['description']           = 'Speed up the email sending process by running parallel jobs using multi threads. Using X number of multi-threads means, '.$siteTitle.' will run X number of parallel jobs to speed up the sending process.';
$lang['page']['form']['heading']       = 'Multi-threading Setup';
$lang['page']['form']['threads']       = 'Default Number of Threads';
$lang['page']['form']['status_help']       = 'Switch on Multithreading so let users select the number of threads while scheduling broadcasts';
$lang['page']['form']['threads_help']       = 'Select the default number of threads to make it a suggested number for users while scheduling process';
$lang['page']['form']['message']       = 'Threads start parallel processes and multiply the resources consumption. Make sure you don\'t force your server to bite more than it can chew.';
return $lang;