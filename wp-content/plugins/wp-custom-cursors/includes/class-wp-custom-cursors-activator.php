<?php

/**
 *
 * @link       https://codecanyon.net/user/web_trendy
 * @since      1.0.0
 * @package    Wp_custom_cursors
 * @subpackage Wp_custom_cursors/includes
 * @author     Web_Trendy <webtrendyio@gmail.com>
 */

class Wp_custom_cursors_Activator {

	/**
	 * @since    1.0.0
	 */
	public static function activate() {
		if (current_user_can('manage_options')) {
			
			global $wpdb;
			global $charset_collate;

			$addedCursorsTable = $wpdb->prefix . "added_cursors";
			if( $wpdb->get_var( "SHOW TABLES LIKE '$addedCursorsTable'" ) != $addedCursorsTable ) { 
				
				require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

				$sql_create_table = "CREATE TABLE `$addedCursorsTable` (
					cursor_id bigint(20) unsigned NOT NULL auto_increment,
					cursor_type varchar(20) NOT NULL default 'shape',
					cursor_shape varchar(20) NOT NULL default '0',
					default_cursor varchar(20) NOT NULL default 'none',
					color longtext NULL,
					width bigint(20) unsigned NOT NULL default '30',
					blending_mode varchar(20) NOT NULL default 'normal',
					hide_tablet varchar(20) NOT NULL default 'on',
					hide_mobile varchar(20) NOT NULL default 'on',
					hover_cursors longtext NULL,
					activate_on bigint(20) unsigned NOT NULL default '0',
					selector_type varchar(20) NOT NULL default 'tag',
					selector_data varchar(50) NOT NULL default 'body',
					PRIMARY KEY  (cursor_id),
					KEY cursor_type (cursor_type)
				    ) $charset_collate; ";
				 
				dbDelta( $sql_create_table );
			}

			$createdCursorsTable = $wpdb->prefix . "created_cursors";
			if( $wpdb->get_var( "SHOW TABLES LIKE '$createdCursorsTable'" ) != $createdCursorsTable ) { 
				
				require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

				$sql_create_table = "CREATE TABLE `$createdCursorsTable` (
					cursor_id bigint(20) unsigned NOT NULL auto_increment,
					cursor_type varchar(20) NOT NULL default 'shape',
					cursor_options longtext NULL,
					PRIMARY KEY  (cursor_id),
					KEY cursor_type (cursor_type)
				    ) $charset_collate; ";
				 
				dbDelta( $sql_create_table );
			}

		}
	}

}
