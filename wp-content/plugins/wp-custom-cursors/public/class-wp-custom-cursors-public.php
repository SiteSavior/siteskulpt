<?php

/**
 *
 * @link       https://codecanyon.net/user/web_trendy
 * @since      1.0.0
 *
 * @package    Wp_custom_cursors
 * @subpackage Wp_custom_cursors/admin
 */

/**
 *
 * @package    Wp_custom_cursors
 * @subpackage Wp_custom_cursors/admin
 * @author     Web_Trendy <webtrendyio@gmail.com>
 */

class Wp_custom_cursors_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style($this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp_custom_cursors_main_style.css', array(), $this->version, 'all');

	}

	/**
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		global $wpdb;
		$added_cursors_table = $wpdb->prefix . "added_cursors";
		$created_cursors_table = $wpdb->prefix . "created_cursors";

		$added_cursors_query = "SELECT * FROM $added_cursors_table";
		$created_cursors_query = "SELECT * FROM $created_cursors_table";

		$added_cursors = $wpdb->get_results( $added_cursors_query, ARRAY_A );
		$created_cursors = $wpdb->get_results( $created_cursors_query, ARRAY_A );

		$added_cursors_stripped = [];
		$created_cursors_stripped = [];

		foreach($added_cursors as $cursor) {
			$cursor['hover_cursors'] = stripcslashes($cursor['hover_cursors']);
			array_push($added_cursors_stripped, $cursor);
		}

		foreach($created_cursors as $cursor) {
			$stripped = stripslashes($cursor['cursor_options']);
			$decoded = json_decode($stripped, false);
			$cursor['cursor_options'] = $decoded;
			array_push($created_cursors_stripped, $cursor);
		}

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp_custom_cursors_main_script.js', array(), $this->version, true );

		wp_localize_script( $this->plugin_name, 'added_cursors', $added_cursors_stripped );
		wp_localize_script( $this->plugin_name, 'created_cursors', $created_cursors_stripped );
	}

}
