<?php
/*
 * Plugin Name: Find and Replace
 * Description: A Simple plugin that searches the database for the given word and replace it by the replacement word
 * Plugin URI: http://www.abcd.com
 * Author: Aman Pandey
 * Author URI: http://www.abcd.com
 * Version: 1.0
 */
 add_action("admin_menu", "addMenu");
 /**
 *function to add menu on dashboard
 */
 function addMenu()
 {
 add_options_page("Find and Replace", "Find and Replace", "manage_options", "findreplace", "find_replace");
 }
//including the file
include_once(plugin_dir_path(__FILE__) . 'view/view.php');
/**
*function to backup the database
*@param $host is host name, $user is database username, $pass is database password, $name is name of the database
*/
function backup_tables($host,$user,$pass,$name)
{
  global $wpdb;
  $filename = 'db-backup-'.time().'-'.(md5(implode('',$name))).'.sql';
}
?>
