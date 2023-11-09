<?php

/**
 *
 * @link       https://codecanyon.net/user/web_trendy
 * @since      1.0.0
 *
 * @package    Wp_custom_cursors
 * @subpackage Wp_custom_cursors/includes
 */

/**
 *
 * @since      1.0.0
 * @package    Wp_custom_cursors
 * @subpackage Wp_custom_cursors/includes
 * @author     Web_Trendy <webtrendyio@gmail.com>
 */

class Wp_custom_cursors_Deactivator {

	/**
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		global $wpdb;
	    $addedCursorsTable = $wpdb->prefix . "added_cursors";
	    $createdCursorsTable = $wpdb->prefix . "created_cursors";
	    $addedCursorssql = "DROP TABLE IF EXISTS $addedCursorsTable";
	    $createdCursorssql = "DROP TABLE IF EXISTS $createdCursorsTable";
	    $wpdb->query($addedCursorssql);
	    $wpdb->query($createdCursorssql);
	}

}
