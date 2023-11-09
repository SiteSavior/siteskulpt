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
class Wp_custom_cursors_Admin {

	/**
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
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

		$screen = get_current_screen();
		$base = $screen->base;

		$pages = ['wp_custom_cursors', 'wpcc_add_new', 'wpcc_cursor_maker', 'wpcc_tuts'];

		foreach ($pages as $page) {
			$pos = strripos($base, $page);
			if (!($pos === false)) {
			    wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-custom-cursors-admin.css', array(), $this->version, 'all' );
	            wp_enqueue_style( 'bootstrapcss', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );
	            
	            wp_enqueue_style( 'remixicon', plugin_dir_url( __FILE__ ) . 'fonts/remixicon.css', array(), $this->version, 'all' );
	            
	            wp_enqueue_style( 'spectrum', plugin_dir_url( __FILE__ ) . 'css/spectrum.min.css', array(), $this->version, 'all' );
			} 
		}

	}

	/**
	 *
	 * @since    1.1.0
	 */
	public function enqueue_scripts() {
		global $wpdb;
		$tablename = $wpdb->prefix . "created_cursors";

		$sql = "SELECT * FROM $tablename";
		$cursors = $wpdb->get_results( $sql, ARRAY_A );

		$cursors_array = [];

		foreach($cursors as $cursor) {
			$stripped = stripslashes($cursor['cursor_options']);
			$decoded = json_decode($stripped, false);
			$cursor['cursor_options'] = $decoded;
			array_push($cursors_array, $cursor);
		}

		$image_path = [plugins_url( 'img', __FILE__ )];

		$screen = get_current_screen();
		$base = $screen->base;

		$pages = ['wp_custom_cursors', 'wpcc_add_new', 'wpcc_cursor_maker'];

		$add_new_pos = strripos($base, $pages[1]);
		$cursor_maker_pos = strripos($base, $pages[2]);

		$i10n_strings = [];
		array_push($i10n_strings, esc_html__('Hover cursor for this selector already exists! Try changing the selector.', 'wpcustom-cursors'));
		array_push($i10n_strings, esc_html__('Background Color: ', 'wpcustom-cursors'));
		array_push($i10n_strings, esc_html__('Width: ', 'wpcustom-cursors'));
		array_push($i10n_strings, esc_html__('Activates On: ', 'wpcustom-cursors'));

		if (!($add_new_pos === false)) {
			wp_enqueue_script( 'bootstrapjs', plugin_dir_url( __FILE__ ) . 'js/bootstrap.bundle.min.js', array(), $this->version, 'all' );
	    
		    wp_enqueue_script( 'interactjs', plugin_dir_url( __FILE__ ) . 'js/interact.min.js', array(), $this->version, 'all' );
		    
		    wp_enqueue_script( 'spectrum', plugin_dir_url( __FILE__ ) . 'js/spectrum.min.js', array(), $this->version, 'all' );

		    wp_enqueue_script( 'formtowizard', plugin_dir_url( __FILE__ ) . 'js/jquery.formtowizard.js', array(), $this->version, 'all' );

            wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-custom-cursors-admin.js', array(), $this->version, 'all' );
            wp_localize_script( $this->plugin_name, 'wpcc_image_path', $image_path );
            wp_enqueue_media();

			wp_localize_script( $this->plugin_name, 'cursors', $cursors_array );
			wp_localize_script( $this->plugin_name, 'strings', $i10n_strings );
		}

		if (!($cursor_maker_pos === false)) {
			wp_enqueue_script( 'bootstrapjs', plugin_dir_url( __FILE__ ) . 'js/bootstrap.bundle.min.js', array(), $this->version, 'all' );
			wp_localize_script( $this->plugin_name, 'wpcc_image_path', $image_path );
            wp_enqueue_media();
			wp_enqueue_script( 'interactjs', plugin_dir_url( __FILE__ ) . 'js/interact.min.js', array(), $this->version, 'all' );
			wp_enqueue_script( 'spectrum', plugin_dir_url( __FILE__ ) . 'js/spectrum.min.js', array(), $this->version, 'all' );
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-custom-cursors-make-cursor.js', array(), $this->version, 'all' );
		}
	}

	/**
	 *
	 * @since    1.0.0 
	 */
	public function wp_custom_cursors_add_admin_menu(  ) {
	    add_menu_page( esc_html__('WP Custom Cursors', 'wpcustom-cursors'), esc_html__('Custom Cursor', 'wpcustom-cursors'), 'manage_options', 'wp_custom_cursors', 'wpcc_render_main_page', 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMjEuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiI+CjxnPgoJPHBhdGggZmlsbD0iI2EwYTVhYSIgZD0iTTUwMi45LDMwNC44MzRMMTg4LjQ4MSwxNjguNzc5Yy01LjY0LTIuMzg4LTEyLjE3My0xLjE0My0xNi41MDksMy4xOTNzLTUuNTk2LDEwLjg2OS0zLjE5MywxNi41MDlsMTM2LjA1NSwzMTQuNDIyICAgYzIuMzg4LDUuNTUyLDcuODM3LDkuMDk3LDEzLjc5OSw5LjA5N2MwLjQzOSwwLDAuODk0LTAuMDE1LDEuMzYyLTAuMDU5YzYuNDc1LTAuNTg2LDExLjgzNi01LjI4OCwxMy4yNzEtMTEuNjMxbDMxLjU1My0xMzUuNDkxICAgbDEzNS40ODgtMzEuNTUzYzYuMzQzLTEuNDM2LDExLjA0NS02Ljc5NywxMS42MzEtMTMuMjcxUzUwOC44NzcsMzA3LjM5Nyw1MDIuOSwzMDQuODM0eiIvPgoJPHBhdGggZmlsbD0iI2EwYTVhYSIgZD0iTTE5NSwxMjBjOC4yOTEsMCwxNS02LjcwOSwxNS0xNVYxNWMwLTguMjkxLTYuNzA5LTE1LTE1LTE1cy0xNSw2LjcwOS0xNSwxNXY5MEMxODAsMTEzLjI5MSwxODYuNzA5LDEyMCwxOTUsMTIweiIvPgoJPHBhdGggZmlsbD0iI2EwYTVhYSIgZD0iTTEyMC43NjIsMjQ4LjAyN2wtNjMuNjQ3LDYzLjY0N2MtNS44NTksNS44NTktNS44NTksMTUuMzUyLDAsMjEuMjExYzUuODYsNS44NiwxNS4zNTEsNS44NiwyMS4yMTEsMGw2My42NDctNjMuNjQ3ICAgYzUuODU5LTUuODU5LDUuODU5LTE1LjM1MiwwLTIxLjIxMVMxMjYuNjIxLDI0Mi4xNjgsMTIwLjc2MiwyNDguMDI3eiIvPgoJPHBhdGggZmlsbD0iI2EwYTVhYSIgZD0iTTI2OS4yMzgsMTQxLjk3M2w2My42NDctNjMuNjQ3YzUuODU5LTUuODU5LDUuODU5LTE1LjM1MiwwLTIxLjIxMXMtMTUuMzUyLTUuODU5LTIxLjIxMSwwbC02My42NDcsNjMuNjQ3ICAgYy01Ljg1OSw1Ljg1OS01Ljg1OSwxNS4zNTIsMCwyMS4yMTFDMjUzLjg4NywxNDcuODMyLDI2My4zNzksMTQ3LjgzMiwyNjkuMjM4LDE0MS45NzN6Ii8+Cgk8cGF0aCBmaWxsPSIjYTBhNWFhIiBkPSJNNzguMzI1LDU3LjExNGMtNS44NTktNS44NTktMTUuMzUyLTUuODU5LTIxLjIxMSwwcy01Ljg1OSwxNS4zNTIsMCwyMS4yMTFsNjMuNjQ3LDYzLjY0N2M1Ljg2LDUuODYsMTUuMzUxLDUuODYsMjEuMjExLDAgICBjNS44NTktNS44NTksNS44NTktMTUuMzUyLDAtMjEuMjExTDc4LjMyNSw1Ny4xMTR6Ii8+Cgk8cGF0aCBmaWxsPSIjYTBhNWFhIiBkPSJNMTIwLDE5NWMwLTguMjkxLTYuNzA5LTE1LTE1LTE1SDE1Yy04LjI5MSwwLTE1LDYuNzA5LTE1LDE1czYuNzA5LDE1LDE1LDE1aDkwQzExMy4yOTEsMjEwLDEyMCwyMDMuMjkxLDEyMCwxOTV6Ii8+CjwvZz4KCgoKCgoKCgoKCgoKCgoKPC9zdmc+Cg==' );

	    add_submenu_page( 'wp_custom_cursors', esc_html__( 'Add New Cursor', 'wpcustom-cursors' ), esc_html__( 'Add New Cursor', 'wpcustom-cursors' ), 'manage_options', 'wpcc_add_new', 'wpcc_render_add_new_page' );

	    add_submenu_page( 'wp_custom_cursors', esc_html__( 'Cursor Maker', 'wpcustom-cursors' ), esc_html__( 'Cursor Maker', 'wpcustom-cursors' ), 'manage_options', 'wpcc_cursor_maker', 'wpcc_render_cursor_maker_page' );

	    add_submenu_page( 'wp_custom_cursors', esc_html__( 'Tutorials', 'wpcustom-cursors' ), esc_html__( 'Tutorials', 'wpcustom-cursors' ), 'manage_options', 'wpcc_tuts', 'wpcc_render_tuts_page' );


	    function wpcc_render_main_page() {
		    ?>
		    <div class="wt-page mt-3 me-4">
				
				<?php include_once( 'partials/wp-custom-cursors-header.php' ); ?>

				<!-- Body -->
				<div class="wt-body">
					<?php  
						global $wpdb;
						$tablename = $wpdb->prefix . "added_cursors";
					    $cursors = $wpdb->get_results("SELECT cursor_id, cursor_type, cursor_shape, activate_on, default_cursor, selector_type, selector_data, color, width, blending_mode FROM $tablename");


					    if ($cursors) {
					    	?>
					    	<div class="card bg-light">
					    		<div class="card-body">
					    			<div class="row">
					    				<div class="col">
					    					<h3 class="h5 mb-3"><?php echo esc_html__( 'Active Cursors:', 'wpcustom-cursors' ); ?></h3>
					    				</div>
					    			</div>
							    	<?php
							    	foreach ($cursors as $cursor) {
							    	?>
							    	
						    			<div class="row align-items-center mt-3 shadow py-3 rounded-4">
						    				<div class="col-md-2 position-relative text-center">
						    					<?php 
												switch ($cursor->cursor_type) {
													case "shape":
														if (str_contains($cursor->cursor_shape, "created")) {
															$id = substr($cursor->cursor_shape, 8);
															global $wpdb;
															$tablename = $wpdb->prefix . "created_cursors";
														    $created_cursor = $wpdb->get_row("SELECT * FROM $tablename WHERE cursor_id = $id");

														    $stripped = stripslashes($created_cursor->cursor_options);
												    		$decoded = json_decode($stripped, false);
															?>
															<label class="created-cursor-label" style="--fe-width: <?php echo $decoded->fe_width; ?>px; --fe-height: <?php echo $decoded->fe_height; ?>px; --fe-color: <?php echo $decoded->fe_color; ?>; --fe-radius: <?php echo $decoded->fe_radius; ?>px; --fe-border: <?php echo $decoded->fe_border_width; ?>px; --fe-border-color: <?php echo $decoded->fe_border_color; ?>; --fe-blending: <?php echo $decoded->fe_blending; ?>; --fe-zindex: <?php echo $decoded->fe_zindex; ?>; --se-width: <?php echo $decoded->se_width; ?>px; --se-height: <?php echo $decoded->se_height; ?>px; --se-color: <?php echo $decoded->se_color; ?>; --se-radius: <?php echo $decoded->se_radius; ?>px; --se-border: <?php echo $decoded->se_border_width; ?>px; --se-border-color: <?php echo $decoded->se_border_color; ?>; --se-blending: <?php echo $decoded->se_blending; ?>; --se-zindex: <?php echo $decoded->se_zindex; ?>;"><div class="cursor-el1" ></div><div class="cursor-el2"></div>
															</label>
															<?php
														}
														else {
															?>
														    <img src="<?php echo esc_url( plugins_url( 'img/cursors/'.$cursor->cursor_shape.'.svg', __FILE__ ) ); ?>" alt="<?php echo esc_html__('Cursor Shape '.$cursor->cursor_shape, 'wpcustom-cursors');?>" class="list-shape-image" />
														    <?php
														}
												    break;
													case "image":
													if (str_contains($cursor->cursor_shape, "created")) {
															$id = substr($cursor->cursor_shape, 8);
															global $wpdb;
															$tablename = $wpdb->prefix . "created_cursors";
														    $created_cursor = $wpdb->get_row("SELECT * FROM $tablename WHERE cursor_id = $id");

														    $stripped = stripslashes($created_cursor->cursor_options);
												    		$decoded = json_decode($stripped, false);
												    		?>
												    		<label class="created-cursor-label image" style="--width: <?php echo $decoded->width; ?>px; --background: <?php echo $decoded->background; ?>px; --color: <?php echo $decoded->color; ?>; --radius: <?php echo $decoded->radius; ?>px; --padding: <?php echo $decoded->padding; ?>px; --blending: <?php echo $decoded->blending; ?>; --click-point-x: <?php echo $click_point_x; ?>%; --click-point-y: <?php echo $click_point_y; ?>%;"><div class="img-wrapper"><img src="<?php echo $decoded->image_url; ?>" class="img-fluid" /></div>
															</label>
												    		<?php
												    	}
												    else {
												    	?>
														<img src="<?php echo $cursor->cursor_image; ?>" alt="<?php echo esc_html__('Cursor Image', 'wpcustom-cursors');?>" class="list-cursor-image" />
												    	<?php
												    }
												    break;
													case "text":
														if (str_contains($cursor->cursor_shape, "created")){
															$id = substr($cursor->cursor_shape, 8);
															global $wpdb;
															$tablename = $wpdb->prefix . "created_cursors";
														    $created_cursor = $wpdb->get_row("SELECT * FROM $tablename WHERE cursor_id = $id");

														    $stripped = stripslashes($created_cursor->cursor_options);
												    		$decoded = json_decode($stripped, false);

												    		if ($decoded->text_type == 'horizontal') {
												    			?>
												    			<label class="created-cursor-label horizontal" style="--bg-color: <?php echo $decoded->hr_bgcolor; ?>; --hr-width: <?php echo $decoded->hr_width; ?>px; --hr-transfom: <?php echo $decoded->hr_transform; ?>; --hr-weight: <?php echo $decoded->hr_weight; ?>; --hr-color: <?php echo $decoded->hr_color; ?>; --hr-size: <?php echo $decoded->hr_size; ?>px;--hr-spacing: <?php echo $decoded->hr_spacing; ?>px;--hr-radius: <?php echo $decoded->hr_radius; ?>px;--hr-padding: <?php echo $decoded->hr_padding; ?>s; ">
												    				<div class="hr-text"><?php echo $decoded->hr_text;?></div>
												    			</label>
												    			<?php
												    		}

												    		else {

													    		?>
														    	<label class="created-cursor-label text" style="--dot-fill: <?php echo $decoded->dot_color; ?>; --text-width: <?php echo $decoded->width; ?>px; --text-transfom: <?php echo $decoded->text_transform; ?>; --font-weight: <?php echo $decoded->font_weight; ?>; --text-color: <?php echo $decoded->text_color; ?>; --font-size: <?php echo $decoded->font_size; ?>px;--word-spacing: <?php echo $decoded->word_spacing; ?>px;--animation-name: <?php echo $decoded->animation; ?>;--animation-duration: <?php echo $decoded->animation_duration; ?>s; --dot-width: <?php echo $decoded->dot_width; ?>px;"><svg viewBox="0 0 500 500" id="svg_node"><path d="M50,250c0-110.5,89.5-200,200-200s200,89.5,200,200s-89.5,200-200,200S50,360.5,50,250" id="textcircle" fill="none"></path><text dy="25" id="svg_text_cursor"><textPath xlink:href="#textcircle" id="textpath"><?php echo $decoded->text;?></textPath></text><circle cx="250" cy="250" r="<?php echo $decoded->dot_width;?>" id="svg_circle_node"/></svg>
																</label>
														    	<?php

														    	}
														    }
													    else {
													    	?>
													    	<label class="created-cursor-label text" style="--width: <?php echo $cursor->width; ?>px;--text-color: <?php echo $cursor->color; ?>;"><svg viewBox="0 0 500 500" id="svg_node"><path d="M50,250c0-110.5,89.5-200,200-200s200,89.5,200,200s-89.5,200-200,200S50,360.5,50,250" id="textcircle" fill="none"></path><text dy="25" id="svg_text_cursor"><textPath xlink:href="#textcircle" id="textpath"><?php echo $cursor->cursor_text;?></textPath></text></svg>
															</label>
													    	<?php
													    }
												    break;
												}
												?>
						    				</div>
						    				<div class="col-md-2">
						    					<div>
						    					<?php 
													echo esc_html(ucfirst($cursor->cursor_type));
												?>
												</div>
												<div>
												<?php 
												switch ($cursor->cursor_type) {
												 	case 'shape':
											 			echo esc_html__( 'Color:', 'wpcustom-cursors' );
														if ( str_contains( $cursor->cursor_shape, "created" ) ) {
															$id = substr($cursor->cursor_shape, 8);
															global $wpdb;
															$tablename = $wpdb->prefix . "created_cursors";
														    $created_cursor = $wpdb->get_row("SELECT * FROM $tablename WHERE cursor_id = $id");

														    $stripped = stripslashes($created_cursor->cursor_options);
												    		$decoded = json_decode($stripped, false);

														    echo '<div class="color-dot" style="background-color: '.$decoded->fe_color.'"></div>';
														    echo '<div class="color-dot" style="background-color: '.$decoded->se_color.'"></div>';
														}
														else {
															echo '<div class="color-dot" style="background-color: '.$cursor->color.'"></div>';
														}
											 		break;
												 	
												 	case 'image':
											 			echo esc_html__( 'Width: ', 'wpcustom-cursors' );
														if ( str_contains( $cursor->cursor_shape, "created" ) ) {
															$id = substr($cursor->cursor_shape, 8);
															global $wpdb;
															$tablename = $wpdb->prefix . "created_cursors";
														    $created_cursor = $wpdb->get_row("SELECT * FROM $tablename WHERE cursor_id = $id");

														    $stripped = stripslashes($created_cursor->cursor_options);
												    		$decoded = json_decode($stripped, false);

														    echo '<span class="small">'.$decoded->width.' px</span>';
														}
														else {
															echo '<span class="small">'.$cursor->width.' px</span>';
														}
											 		break;

											 		case 'text':
											 			$id = substr($cursor->cursor_shape, 8);
														global $wpdb;
														$tablename = $wpdb->prefix . "created_cursors";
													    $created_cursor = $wpdb->get_row("SELECT * FROM $tablename WHERE cursor_id = $id");

													    $stripped = stripslashes($created_cursor->cursor_options);
											    		$decoded = json_decode($stripped, false);

											 			if ($decoded->text_type == 'horizontal') {
											 				echo esc_html__( 'Color:', 'wpcustom-cursors' );
														    echo '<div class="color-dot" style="background-color: '.$decoded->hr_bgcolor.'"></div>';
											 			}
											 			else {
											 				echo esc_html__( 'Color:', 'wpcustom-cursors' );
															$id = substr($cursor->cursor_shape, 8);
															global $wpdb;
															$tablename = $wpdb->prefix . "created_cursors";
														    $created_cursor = $wpdb->get_row("SELECT * FROM $tablename WHERE cursor_id = $id");

														    $stripped = stripslashes($created_cursor->cursor_options);
												    		$decoded = json_decode($stripped, false);

														    echo '<div class="color-dot" style="background-color: '.$decoded->text_color.'"></div>';
											 			}
											 			
											 		break;
												 } 
												?>
												</div>
						    				</div>
						    				<div class="col-md-2">
						    					<div><?php echo esc_html__('Activate On:', 'wpcustom-cursors'); ?></div>
						    					<?php if ($cursor->activate_on == 0) {
												echo esc_html__( 'Body', 'wpcustom-cursors' );
												} 
												else {
													switch ($cursor->selector_type) {
														case 'tag':
															echo "&lt;".esc_html( $cursor->selector_data )."&gt;";
															break;
														case 'class':
															echo ".".esc_html( $cursor->selector_data );
															break;
														case 'id':
															echo "#".esc_html( $cursor->selector_data );
															break;
														case 'attribute':
															echo "[".esc_html( $cursor->selector_data )."]";
															break;
														default:
															echo esc_html__( 'No data!', 'wpcustom-cursors' );
															break;
													}
												} ?>
						    				</div>
						    				<div class="col-md-6 text-end">
						    					<a href="<?php menu_page_url('wpcc_add_new', true); ?>&edit_row=<?php echo intval( $cursor->cursor_id ); ?>" title="<?php echo esc_html__( 'Edit Cursor', 'wpcustom-cursors' ); ?>" class="wpcc-icon"><i class="ri-pencil-line ri-lg"></i></a>
												<form action="" class="d-inline-block" method="post">
													<input type="hidden" name="delete_row" value="<?php echo esc_html( $cursor->cursor_id ); ?>">
													<button type="submit" name="delete" title="<?php echo esc_html__( 'Delete Cursor', 'wpcustom-cursors' ); ?>" class="wpcc-icon"><i class="ri-close-fill ri-lg"></i></button>
													<?php wp_nonce_field( 'wpcc_delete_cursor', 'wpcc_delete_nonce' ); ?>
												</form>
						    				</div>
						    			</div>
								    <?php
									}
								?>
								</div>
					    	</div>
						<?php
					    }
					    else {
					    ?>
					    	<div class="container mt-3">
					    		<div class="row">
					    			<div class="card bg-light py-5 rounded-3">
					    				<div class="card-body">
					    					<div class="row justify-content-center">
					    						<div class="col-md-6 text-center">
					    							<img src="<?php echo esc_url( plugins_url( 'img/icons/no-cursor.svg', __FILE__ ) ); ?>" alt="<?php echo esc_html__('Add you first cursor!', 'wpcustom-cursors'); ?>" class="img-fluid mx-5 px-5" />
								    				<div class="mt-3 fw-light">
								    					<div class="d-flex justify-content-center mb-3">
								    						<i class="ri-tools-fill"></i> <span><?php echo esc_html__( 'Select cursor type', 'wpcustom-cursors' );?></span>
									    					<i class="ri-arrow-right-s-fill"></i> <?php echo esc_html__( 'Create hover cursor', 'wpcustom-cursors' );?>
									    					<i class="ri-arrow-right-s-fill"></i> <?php echo esc_html__( 'Add cursor to the page', 'wpcustom-cursors' );?>
								    					</div>
								    					<span class="text-muted"><?php echo esc_html__( 'To begin', 'wpcustom-cursors' );?></span>
								    					<a href="<?php menu_page_url('wpcc_add_new', true) ?>" class="text-decoration-none fw-normal"><?php echo esc_html__( 'click here', 'wpcustom-cursors' );?></a>
								    				</div>
					    						</div>
					    					</div>
					    				</div>
					    			</div>
					    		</div>
					    	</div>
					    <?php
					    }
					?>
				</div>
				<!-- End Body -->
			</div>
		    
		    <div class="toast-container position-fixed bottom-0 end-0 p-3">
			  	<div id="cursor_toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
			    	<div class="toast-header">
			      		<i class="ri-cursor-line lh-1 fs-5 me-2"></i>
			      		<strong class="me-auto"><?php echo esc_html__( 'Cursor Removed', 'wpcustom-cursors' );?></strong>
			      		<small><?php echo esc_html__( 'Just Now', 'wpcustom-cursors' );?></small>
			      		<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
			    	</div>
			    	<div class="toast-body">
			      	<?php echo esc_html__( 'The cursor was permanently deleted.', 'wpcustom-cursors' );?>
			    	</div>
			  	</div>
			</div>
		    <?php
		}

		function wpcc_render_add_new_page() {
			?>
			<div class="wt-page mt-3 me-4">
				<?php include_once( 'partials/wp-custom-cursors-header.php' ); ?>

				<!-- Body -->
				<div class="wt-body">
					<?php include_once( 'partials/wp-custom-cursors-add-new.php' ); ?>
				</div>
				<!-- End Body -->
			</div>
			<?php
		}

		function wpcc_render_cursor_maker_page() {
			?>
			<div class="wt-page mt-3 me-4">
				<?php include_once( 'partials/wp-custom-cursors-header.php' ); ?>
				<div class="wt-body">
					<?php include_once( 'partials/wp-custom-cursors-cursor-maker.php' ); ?>
				</div>
			</div>
			<?php
		}

		function wpcc_render_tuts_page() {
			?>
			<div class="wt-page mt-3 me-4">
				<?php include_once( 'partials/wp-custom-cursors-header.php' ); ?>
				<div class="wt-body">
					<?php include_once( 'partials/wp-custom-cursors-tuts.php' ); ?>
				</div>
			</div>
			<?php
		}
	}

	/**
	 *
	 * @since    2.2.4 
	 */
	public function add_plugin_settings_link($links) {
		$links[] = '<a href="' .
		admin_url( 'admin.php?page=wp_custom_cursors' ) .
		'">' . esc_html__('Settings') . '</a>';
		return $links;
	}

	/**
	 *
	 * @since    3.0 
	 */
	public function crud_cursor() {
		if( isset( $_POST['add'] ) && check_admin_referer( 'wpcc_add_new_cursor', 'wpcc_add_new_nonce' ) ) {
			global $wpdb;
			$tablename = $wpdb->prefix . "added_cursors";

			$cursor_type = sanitize_text_field( $_POST['cursor_type'] );
			$cursor_shape = sanitize_text_field( $_POST['cursor_shape'] );
			
			$default_cursor = ( isset( $_POST['default_cursor'] ) )? sanitize_text_field( $_POST['default_cursor'] ) : 0 ;
			$hover_cursors = sanitize_text_field( $_POST['hover_cursors'] );
			$activate_on = sanitize_text_field( $_POST['activate_on'] );
			$selector_type = sanitize_text_field( $_POST['selector_type'] );
			if ( $_POST['selector_data'] == "" ) {
				$_POST['selector_data'] = "body";
			}
			$selector_data = sanitize_text_field( $_POST['selector_data'] );
			$color = sanitize_text_field( $_POST['color'] );
			if ( $_POST['width'] == 0 ) {
				$_POST['width'] = 30; 
			}
			$width = sanitize_text_field( $_POST['width'] );
			$blending_mode = sanitize_text_field( $_POST['blending_mode'] );
			if ( !isset( $_POST['hide_tablet'] ) ) {
				$_POST['hide_tablet'] = 'off';
			}
			$hide_tablet = sanitize_text_field( $_POST['hide_tablet'] );
			if ( !isset( $_POST['hide_mobile'] ) ) {
				$_POST['hide_mobile'] = 'off';
			}
			$hide_mobile = sanitize_text_field( $_POST['hide_mobile'] );
			
			$success = $wpdb->insert( $tablename, array( "cursor_type" => $cursor_type, "cursor_shape" => $cursor_shape, "default_cursor" => $default_cursor, "color" => $color, "width" => $width, "blending_mode" => $blending_mode, "hide_tablet" => $hide_tablet, "hide_mobile" => $hide_mobile, "hover_cursors" => $hover_cursors, "activate_on" => $activate_on, "selector_type" => $selector_type, "selector_data" => $selector_data ), array( "%s", "%s", "%s", "%s", "%d", "%s", "%s", "%s", "%s", "%d", "%s", "%s" ) );
			
			if( $success !== false ) {
				if ( wp_safe_redirect( admin_url('admin.php?page=wp_custom_cursors') ) ) {
				    exit;
				}
		    } 
		    else {
				echo '<div class="container">
						<div class="row">
							<div class="col">
								<div class="alert alert-warning" role="alert">
								  '.esc_html__( 'An error happened!', 'wpcustom-cursors' ).'
								</div>
							</div>
						</div>
					 </div>';
			}
		}
		if( isset( $_POST['update'] ) && check_admin_referer( 'wpcc_add_new_cursor', 'wpcc_add_new_nonce' ) ) {
			global $wpdb;
			$tablename = $wpdb->prefix . "added_cursors";

			$cursor_type = sanitize_text_field( $_POST['cursor_type'] );
			$cursor_shape = sanitize_text_field( $_POST['cursor_shape'] );
			
			$default_cursor = ( isset( $_POST['default_cursor'] ) )? sanitize_text_field( $_POST['default_cursor'] ) : 0 ;
			$hover_cursors = sanitize_text_field( $_POST['hover_cursors'] );
			$activate_on = sanitize_text_field( $_POST['activate_on'] );
			$selector_type = sanitize_text_field( $_POST['selector_type'] );
			if ( $_POST['selector_data'] == "" ) {
				$_POST['selector_data'] = "body";
			}
			$selector_data = sanitize_text_field( $_POST['selector_data'] );
			$color = sanitize_text_field( $_POST['color'] );
			if ( $_POST['width'] == 0 ) {
				$_POST['width'] = 30; 
			}
			$width = sanitize_text_field( $_POST['width'] );
			$blending_mode = sanitize_text_field( $_POST['blending_mode'] );
			if ( !isset( $_POST['hide_tablet'] ) ) {
				$_POST['hide_tablet'] = 'off';
			}
			$hide_tablet = sanitize_text_field( $_POST['hide_tablet'] );
			if ( !isset( $_POST['hide_mobile'] ) ) {
				$_POST['hide_mobile'] = 'off';
			}
			$hide_mobile = sanitize_text_field( $_POST['hide_mobile'] );
			$row_id = sanitize_text_field( $_POST['update_id'] );

			$success = $wpdb->update( $tablename, array( "cursor_type" => $cursor_type, "cursor_shape" => $cursor_shape, "default_cursor" => $default_cursor, "color" => $color, "width" => $width, "blending_mode" => $blending_mode, "hide_tablet" => $hide_tablet, "hide_mobile" => $hide_mobile, "hover_cursors" => $hover_cursors, "activate_on" => $activate_on, "selector_type" => $selector_type, "selector_data" => $selector_data ), array( "cursor_id" => $row_id ), array( "%s", "%s", "%s", "%s", "%d", "%s", "%s", "%s", "%s", "%d", "%s", "%s" ) );

			
			if( $success !== false ) {
				if ( wp_safe_redirect( admin_url('admin.php?page=wp_custom_cursors') ) ) {
				    exit;
				}
		    } 
		    else {
				echo '<div class="container">
						<div class="row">
							<div class="col">
								<div class="alert alert-warning" role="alert">
								  '.esc_html__( 'An error happened!', 'wpcustom-cursors' ).'
								</div>
							</div>
						</div>
					 </div>';
			}
		}
		if ( isset( $_POST['delete'] ) && check_admin_referer( 'wpcc_delete_cursor', 'wpcc_delete_nonce' ) ) {
    		global $wpdb;
			$tablename = $wpdb->prefix . "added_cursors";

			$delete_row = sanitize_text_field( $_POST['delete_row'] );

			$sql = $wpdb->prepare( "DELETE from $tablename WHERE cursor_id = %d", array( $delete_row ) );
			$deleted = $wpdb->query( $sql );
			
			if( $deleted ) {
				?>
				<script>
					(function(){
						window.addEventListener('DOMContentLoaded', function(event) {
							window.addEventListener('load', function(event) {
								const cursorToast = document.getElementById('cursor_toast');
								if (cursorToast) {
								  	const toast = new bootstrap.Toast(cursorToast)
							    	toast.show();
								}
							});
						});
					})();
				</script>
				<?php
		    } 
		    else {
				//echo 'Not deleted';
			}
    	}
    	if ( isset( $_POST['create'] ) && check_admin_referer( 'wpcc_create_cursor', 'wpcc_create_nonce' ) ) {
    		global $wpdb;
			$tablename = $wpdb->prefix . "created_cursors";
			$cursor_type = sanitize_text_field( $_POST['cursor_type'] );
			$cursor_options = sanitize_text_field( $_POST['cursor_options'] );

			$success = $wpdb->insert( $tablename, array( "cursor_type" => $cursor_type, "cursor_options" => $cursor_options ), array( "%s", "%s" ) );
			
			if( $success !== false ) {
				if ( wp_safe_redirect( admin_url( 'admin.php?page=wpcc_add_new' ) ) ) {
				    exit;
				}
		    } 
		    else {
				echo '<div class="container">
						<div class="row">
							<div class="col">
								<div class="alert alert-warning" role="alert">
								  '.esc_html__( 'An error happened!', 'wpcustom-cursors' ).'
								</div>
							</div>
						</div>
					 </div>';
			}
    	}
    	if ( isset( $_POST['update_created'] ) && check_admin_referer( 'wpcc_create_cursor', 'wpcc_create_nonce' ) ) {

    		global $wpdb;
			$tablename = $wpdb->prefix . "created_cursors";
			
			$cursor_type = sanitize_text_field( $_POST['cursor_type'] );
			$cursor_options = sanitize_text_field( $_POST['cursor_options'] );

			$row_id = sanitize_text_field( $_POST['update_id'] );

			$success = $wpdb->update( $tablename, array( "cursor_type" => $cursor_type, "cursor_options" => $cursor_options ), array( "cursor_id" => $row_id ), array( "%s", "%s" ) );
			
			if( $success !== false ) {
				if ( wp_safe_redirect( admin_url( 'admin.php?page=wpcc_add_new' ) ) ) {
				    exit;
				}
		    } 
		    else {
				echo '<div class="container">
						<div class="row">
							<div class="col">
								<div class="alert alert-warning" role="alert">
								  '.esc_html__( 'An error happened!', 'wpcustom-cursors' ).'
								</div>
							</div>
						</div>
					 </div>';
			}
    	}
    	if ( isset( $_POST['delete_created'] ) && check_admin_referer( 'wpcc_delete_created_cursor', 'wpcc_delete_created_nonce' ) ) {
    		global $wpdb;
			$tablename = $wpdb->prefix . "created_cursors";

			$delete_row = sanitize_text_field( $_POST['delete_created'] );

			$sql = $wpdb->prepare( "DELETE from $tablename WHERE cursor_id = %d", array( $delete_row ) );
			$deleted = $wpdb->query( $sql );






			$added_table = $wpdb->prefix . "added_cursors";
			$check_shape = 'created-'.$delete_row;
			$added_sql = $wpdb->get_results( $wpdb->prepare( "SELECT * from $added_table WHERE cursor_shape = %s", array($check_shape) ) );
			if ($added_sql) {
				$prepare_added_cursor = $wpdb->prepare( "DELETE from $added_table WHERE cursor_shape = %s", array( $check_shape ) );
				$deleted_added_cursor = $wpdb->query( $prepare_added_cursor );
				if ($deleted_added_cursor) {
					// echo 'deleted';
				}
				else {
					// echo 'not deleted';
				}
			}





			
			if( $deleted ) {
				?>
				<script>
					(function(){
						window.addEventListener('DOMContentLoaded', function(event) {
							window.addEventListener('load', function(event) {
								const cursorToast = document.getElementById('cursor_toast');
								if (cursorToast) {
								  	const toast = new bootstrap.Toast(cursorToast)
							    	toast.show();
								}
							});
						});
					})();
				</script>
				<?php
		    } 
		    else {
				//echo 'Not deleted';
			}
    	}
	}
}
