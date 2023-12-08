<?php
include("variables.php");
/**
 * Created by Mumara Team
 * Date: 07/30/2020
 */
/*-------------- DB Check ----------------*/

$lang['page']['title']                 = 'Database Check';
$lang['page']['description']           = 'This page finds if your database is missing any field by comparing your database structure with our latest schema. Moreover, you can also apply the fixes automatically or manually.';


/************* ** Step 1 ** *************/
$lang['step1']['old_version_message'] = '<b>Error: </b>You are using an older version of the application. You need to update to the latest version before we can check the database fo the differences.';
$lang['step1']['update_to_latest'] = 'Update the application to the latest edition first';
$lang['step1']['update_application'] = 'Update Application';

/************* ** Step 2 ** *************/
$lang['step2']['heading']      = 'Check your database for the differences.';
$lang['step2']['press_button'] = 'Press the button below to compare your database with the latest schema';
$lang['step2']['check_database'] = 'Check Database';
// Error step
$lang['error_step']['error_encountered'] = '<b>Error: </b>An error has been encountered!';
$lang['error_step']['unable_to_connect'] = 'Unable to connect to the update server. Check if the following IP and port is unblocked in your server\'s firewall for outbound connections';
$lang['error_step']['unable_to_connect_source'] = 'Unable to connect to the :name server.';

/************* ** General ** *************/
$lang['title'] = 'DB Check';
$lang['checking_db'] = 'Checking your Database';
$lang['db_uptodate'] = 'Hurrah... Your database is up to date!';
$lang['go_to_dashboard'] = 'Go to Dashboard';
$lang['sql_found'] = 'We have found some missing items in your database and created the SQL queries for them.';
$lang['Copy_SQL'] = 'Copy SQL';
$lang['process_started'] = 'The process has been started in background and should be completed as per the database size.';
$lang['operation_cancelled'] = 'The operation has been cancelled';
$lang['sql_copied'] = 'SQL copied successfully.';
$lang['changes_cancelled'] = 'DB changes cancelled';
$lang['check_again'] = 'Check Again';
$lang['check_with_remote_schema'] = 'Check with Remote Schema';
$lang['run_migrations'] = 'Run Migrations';
$lang['migration_run_desc'] = 'Run migrations to check for the missing schema elements and fix issues.';
$lang['migration_run_msg'] = 'Migrations running in background';

$lang['index_blade']['remote_server_heading'] = 'Access denied to the remote server';
return $lang;