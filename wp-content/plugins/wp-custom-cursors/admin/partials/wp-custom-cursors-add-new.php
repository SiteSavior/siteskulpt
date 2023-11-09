<?php
	/**
	 * @link       https://codecanyon.net/user/web_trendy
	 * @since      2.1.0
	 * @package    Wp_custom_cursors
	 * @subpackage Wp_custom_cursors/includes
	 * @author     Web_Trendy <webtrendyio@gmail.com>
	 */
	
	// Form initialization
	$cursor_type_value = 'shape';
	$cursor_shape_value = 1;
	$cursor_image_value = null;
	$cursor_text_value = null;
	$default_cursor_value = 1;
	
	$color_value = "#000000";
	$width_value = 30;
	$blending_mode_value = 'normal';
	$hide_tablet_value = 'on';
	$hide_mobile_value = 'on';
	$activate_on_value = 0;
	$selector_type_value = null;
	$selector_data_value = null;
	$hover_cursors_value = null;

    $hover_trigger_link_value = 1;
	$hover_trigger_button_value = 1;
	$hover_trigger_custom_value = 0; 
	$hover_trigger_selector_value = "";
	$hover_cursor_type_value = 'default';
	$hover_cursor_value = 1;
	$hover_cursor_text = "View";
	$hover_cursor_icon = esc_url( plugins_url( '../img/icons/hover-cursor-icon.svg', __FILE__ ) );
	$hover_bg_color_value = "#ff3c38";
	$hover_cursor_width_value = 100;


    // Edit cursor
    if(isset($_GET['edit_row'])) {
    	global $wpdb; 
		$tablename = $wpdb->prefix . "added_cursors";
		$edit_row = intval( sanitize_text_field( $_GET['edit_row'] ) );
		$query = $wpdb->prepare( "SELECT * from $tablename WHERE cursor_id = %d", $edit_row );
		$cursor = $wpdb->get_row($query);

		if ($cursor) {
			$cursor_type_value = $cursor->cursor_type;
			$cursor_shape_value = $cursor->cursor_shape;
			$cursor_image_value = $cursor->cursor_image;
			$cursor_text_value = $cursor->cursor_text;
			$default_cursor_value = $cursor->default_cursor;
			$color_value = $cursor->color;
			$width_value = $cursor->width;
			$blending_mode_value = $cursor->blending_mode;
			$hide_tablet_value = $cursor->hide_tablet;
			$hide_mobile_value = $cursor->hide_mobile;
			$hover_cursors_value =$cursor->hover_cursors;
			$activate_on_value = $cursor->activate_on;
			$selector_type_value = $cursor->selector_type;
			$selector_data_value = $cursor->selector_data;

			if ($hover_cursors_value) {
				$hover_cursors_value = stripslashes($hover_cursors_value);
				$hover_cursors_value = json_decode($hover_cursors_value);
				
				$hover_cursor_item = '';
				$id = 0;
				foreach($hover_cursors_value as $hover_cursor_object) {
					$hover_cursor_value = $hover_cursor_object->cursor;
					$hover_bg_color_value = $hover_cursor_object->bgColor;
					$hover_cursor_width_value = $hover_cursor_object->width;
					$hover_cursor_type = $hover_cursor_object->hoverType;
					$hover_list_type = ''; 
					if ( $hover_cursor_type != 'available' ) {
						$hover_list_type = '<div class="col-md-2"><span class="badge text-bg-primary me-3">'.$hover_cursor_type.'</span></div>';
					}
					else {
						$hover_list_type = '<div class="col-md-2"><img src="'.plugins_url( '', __FILE__ ).'/../img/cursors/hover-'.$hover_cursor_value.'.svg" class="img" /></div><div class="col-md-3"><div class="bg-color">'.esc_html__( 'Background Color: ', 'wpcustom-cursors' ).'<div style="background-color: '.$hover_bg_color_value.';"></div></div></div><div class="col-md-3"><div class="width">'.esc_html__( 'Width: ', 'wpcustom-cursors' ).'<div class="text-muted">'.$hover_cursor_width_value.' px</div></div></div>';
					}
					$hover_cursor_item .= '<div class="hover-list-item title-normal row position-relative">'.$hover_list_type.'<div class="col-md-3"><div class="activation">Activates on: <div class="text-muted">'.implode(',', $hover_cursor_object->selector).'</div></div></div><div class="remove-hover" data-id="'.$id.'"><i class="ri-close-fill ri-lg"></i></div></div>';
					$id++;
				}

				$hover_cursors_value = htmlspecialchars(json_encode($hover_cursors_value));
			}
		}
		else { unset( $_GET['edit_row'] ); }
    }

	?>

	<div class="mt-3">
		<div class="row">
			<div class="col-md-8">
				<div class="card bg-light rounded-3 p-0">
					<div class="card-body p-0">
						<!-- Form -->
						<form action="#" method="post" id="add_new_form">
							<!-- Step 1: Select Cursor -->
							<fieldset>
								<legend class="pb-2 mb-0 pt-3 px-4">
									<div class="d-flex align-items-center">
										<i class="ri-cursor-fill ri-lg"></i>
										<div class="ms-2">
											<div class="lead fw-normal"><?php echo esc_html__( 'Cursor Type', 'wpcustom-cursors' );?></div>
											<div class="title-normal text-muted"><?php echo esc_html__('Choose cursor type:', 'wpcustom-cursors'); ?></div>
										</div>
									</div>
								</legend>
								<!-- Progress Bar -->
								<div class="progressbar">
									<div class="progress-complete"></div>
								</div>

								<!-- Cursors list-->
								<div class="px-4">
									<div class="cursors-list" style="margin-left: -2px; margin-right: -2px;">
										<!-- Cursor 1 -->
										<input type="radio" class="btn-check" id="shape-1" autocomplete="off" name="cursor_shape" value="1" <?php checked( $cursor_shape_value, '1' ); ?>>
										<label for="shape-1"><img src="<?php echo esc_url( plugins_url( '../img/cursors/1.svg', __FILE__ ) ); ?>" alt="<?php echo esc_html__('Cursor 1', 'wpcustom-cursors'); ?>" class="shape-img" /></label>
										<!-- End Cursor 1 -->

										<!-- Cursor 2 -->
										<input type="radio" class="btn-check" id="shape-2" autocomplete="off" name="cursor_shape" value="2" <?php checked( $cursor_shape_value, '2' ); ?>>
										<label for="shape-2"><img src="<?php echo esc_url( plugins_url( '../img/cursors/2.svg', __FILE__ ) ); ?>" alt="<?php echo esc_html__('Cursor 2', 'wpcustom-cursors'); ?>" class="shape-img" /></label>
										<!-- End Cursor 2 -->

										<!-- Cursor 3 -->
										<input type="radio" class="btn-check" id="shape-3" autocomplete="off" name="cursor_shape" value="3" <?php checked( $cursor_shape_value, '3' ); ?>>
										<label for="shape-3"><img src="<?php echo esc_url( plugins_url( '../img/cursors/3.svg', __FILE__ ) ); ?>" alt="<?php echo esc_html__('Cursor 3', 'wpcustom-cursors'); ?>" class="shape-img" /></label>
										<!-- End Cursor 3 -->

										<!-- Cursor 4 -->
										<input type="radio" class="btn-check" id="shape-4" autocomplete="off" name="cursor_shape" value="4" <?php checked( $cursor_shape_value, '4' ); ?>>
										<label for="shape-4"><img src="<?php echo esc_url( plugins_url( '../img/cursors/4.svg', __FILE__ ) ); ?>" alt="<?php echo esc_html__('Cursor 4', 'wpcustom-cursors'); ?>" class="shape-img" /></label>
										<!-- End Cursor 4 -->

										<!-- Cursor 5 -->
										<input type="radio" class="btn-check" id="shape-5" autocomplete="off" name="cursor_shape" value="5" <?php checked( $cursor_shape_value, '5' ); ?>>
										<label for="shape-5"><img src="<?php echo esc_url( plugins_url( '../img/cursors/5.svg', __FILE__ ) ); ?>" alt="<?php echo esc_html__('Cursor 5', 'wpcustom-cursors'); ?>" class="shape-img" /></label>
										<!-- End Cursor 5 -->

										<!-- Cursor 6 -->
										<input type="radio" class="btn-check" id="shape-6" autocomplete="off" name="cursor_shape" value="6" <?php checked( $cursor_shape_value, '6' ); ?>>
										<label for="shape-6"><img src="<?php echo esc_url( plugins_url( '../img/cursors/6.svg', __FILE__ ) ); ?>" alt="<?php echo esc_html__('Cursor 6', 'wpcustom-cursors'); ?>" class="shape-img" /></label>
										<!-- End Cursor 6 -->

										<!-- Cursor 7 -->
										<input type="radio" class="btn-check" id="shape-7" autocomplete="off" name="cursor_shape" value="7" <?php checked( $cursor_shape_value, '7' ); ?>>
										<label for="shape-7"><img src="<?php echo esc_url( plugins_url( '../img/cursors/7.svg', __FILE__ ) ); ?>" alt="<?php echo esc_html__('Cursor 7', 'wpcustom-cursors'); ?>" class="shape-img" /></label>
										<!-- End Cursor 7 -->

										<!-- Cursor 8 -->
										<input type="radio" class="btn-check" id="shape-8" autocomplete="off" name="cursor_shape" value="8" <?php checked( $cursor_shape_value, '8' ); ?>>
										<label for="shape-8"><img src="<?php echo esc_url( plugins_url( '../img/cursors/8.svg', __FILE__ ) ); ?>" alt="<?php echo esc_html__('Cursor 8', 'wpcustom-cursors'); ?>" class="shape-img" /></label>
										<!-- End Cursor 8 -->
										<?php  
										global $wpdb;
										$tablename = $wpdb->prefix . "created_cursors";
									    $cursors = $wpdb->get_results("SELECT * FROM $tablename");


									    if ($cursors) {
									    	foreach ($cursors as $cursor) {
									    		$stripped = stripslashes($cursor->cursor_options);
									    		$decoded = json_decode($stripped, false);
									    		?>
									    		<input type="radio" data-type="<?php echo $cursor->cursor_type; ?>" data-id="<?php echo $cursor->cursor_id; ?>" class="btn-check" id="created-shape-<?php echo esc_html( $cursor->cursor_id ); ?>" autocomplete="off" name="cursor_shape" value="created-<?php echo esc_html( $cursor->cursor_id ); ?>" <?php checked( $cursor_shape_value, 'created-' . $cursor->cursor_id ); ?>>
									    		<?php  
								    			switch ($cursor->cursor_type) {
								    				case 'shape':
								    					?>
								    					<label for="created-shape-<?php echo $cursor->cursor_id ?>" class="created-cursor-label" style="--fe-width: <?php echo $decoded->fe_width; ?>px; --fe-height: <?php echo $decoded->fe_height; ?>px; --fe-color: <?php echo $decoded->fe_color; ?>; --fe-radius: <?php echo $decoded->fe_radius; ?>px; --fe-border: <?php echo $decoded->fe_border_width; ?>px; --fe-border-color: <?php echo $decoded->fe_border_color; ?>; --fe-blending: <?php echo $decoded->fe_blending; ?>; --fe-zindex: <?php echo $decoded->fe_zindex; ?>; --se-width: <?php echo $decoded->se_width; ?>px; --se-height: <?php echo $decoded->se_height; ?>px; --se-color: <?php echo $decoded->se_color; ?>; --se-radius: <?php echo $decoded->se_radius; ?>px; --se-border: <?php echo $decoded->se_border_width; ?>px; --se-border-color: <?php echo $decoded->se_border_color; ?>; --se-blending: <?php echo $decoded->se_blending; ?>; --se-zindex: <?php echo $decoded->se_zindex; ?>;"><div class="cursor-el1" ></div><div class="cursor-el2"></div>
															<div class="action-icons">
																<a href="<?php menu_page_url('wpcc_cursor_maker', true); ?>&edit_row=<?php echo intval( $cursor->cursor_id ); ?>" title="<?php echo esc_html__( 'Edit Created Cursor', 'wpcustom-cursors' ); ?>" class="edit-icon"><i class="ri-pencil-line ri-lg"></i></a>
																
																<button type="submit" name="delete_created" title="<?php echo esc_html__( 'Delete Created Cursor', 'wpcustom-cursors' ); ?>" class="delete-icon" value="<?php echo esc_html( $cursor->cursor_id ); ?>"><i class="ri-close-fill ri-lg"></i></button>
																<?php wp_nonce_field( 'wpcc_delete_created_cursor', 'wpcc_delete_created_nonce' ); ?>
															</div>
														</label>
								    					<?php
							    					break;
								    				case 'image':
								    					?>
								    					<label for="created-shape-<?php echo $cursor->cursor_id ?>" class="created-cursor-label image" style="--width: <?php echo $decoded->width; ?>px; <?php if($decoded->background != 'off') {echo '--padding: '.$decoded->padding.'px';} ?>; --color: <?php echo $decoded->color; ?>; --radius: <?php echo $decoded->radius; ?>px; --blending: <?php echo $decoded->blending; ?>;"><div class="img-wrapper"><img src="<?php echo $decoded->image_url; ?>" class="img-fluid" /></div>
															<div class="action-icons">
																<a href="<?php menu_page_url('wpcc_cursor_maker', true); ?>&edit_row=<?php echo intval( $cursor->cursor_id ); ?>" title="<?php echo esc_html__( 'Edit Created Cursor', 'wpcustom-cursors' ); ?>" class="edit-icon"><i class="ri-pencil-line ri-lg"></i></a>
																
																<button type="submit" name="delete_created" title="<?php echo esc_html__( 'Delete Created Cursor', 'wpcustom-cursors' ); ?>" class="delete-icon" value="<?php echo esc_html( $cursor->cursor_id ); ?>"><i class="ri-close-fill ri-lg"></i></button>
																<?php wp_nonce_field( 'wpcc_delete_created_cursor', 'wpcc_delete_created_nonce' ); ?>
															</div>
														</label>
								    					<?php
							    					break;
							    					case 'text':
							    						if ($decoded->text_type == 'horizontal') {
							    							?>
							    							<label for="created-shape-<?php echo $cursor->cursor_id ?>" class="created-cursor-label horizontal" style="--bg-color: <?php echo $decoded->hr_bgcolor; ?>; --hr-width: <?php echo $decoded->hr_width; ?>px; --hr-transfom: <?php echo $decoded->hr_transform; ?>; --hr-weight: <?php echo $decoded->hr_weight; ?>; --hr-color: <?php echo $decoded->hr_color; ?>; --hr-size: <?php echo $decoded->hr_size; ?>px;--hr-spacing: <?php echo $decoded->hr_spacing; ?>px; --hr-duration: <?php echo $decoded->hr_duration; ?>ms; --hr-timing: <?php echo $decoded->hr_timing; ?>; --hr-radius: <?php echo $decoded->hr_radius; ?>px;--hr-padding: <?php echo $decoded->hr_padding; ?>s; ">
							    									<div class="hr-text"><?php echo $decoded->hr_text;?></div>
							    									<div class="action-icons">
																		<a href="<?php menu_page_url('wpcc_cursor_maker', true); ?>&edit_row=<?php echo intval( $cursor->cursor_id ); ?>" title="<?php echo esc_html__( 'Edit Created Cursor', 'wpcustom-cursors' ); ?>" class="edit-icon"><i class="ri-pencil-line ri-lg"></i></a>
																		
																		<button type="submit" name="delete_created" title="<?php echo esc_html__( 'Delete Created Cursor', 'wpcustom-cursors' ); ?>" class="delete-icon" value="<?php echo esc_html( $cursor->cursor_id ); ?>"><i class="ri-close-fill ri-lg"></i></button>
																		<?php wp_nonce_field( 'wpcc_delete_created_cursor', 'wpcc_delete_created_nonce' ); ?>
																	</div>
								    							</label>
							    							<?php
							    						}
							    						else {
							    							?>
							    							<label for="created-shape-<?php echo $cursor->cursor_id ?>" class="created-cursor-label text" style="--dot-fill: <?php echo $decoded->dot_color; ?>; --text-width: <?php echo $decoded->width; ?>px; --text-transfom: <?php echo $decoded->text_transform; ?>; --font-weight: <?php echo $decoded->font_weight; ?>; --text-color: <?php echo $decoded->text_color; ?>; --font-size: <?php echo $decoded->font_size; ?>px;--word-spacing: <?php echo $decoded->word_spacing; ?>px;--animation-name: <?php echo $decoded->animation; ?>;--animation-duration: <?php echo $decoded->animation_duration; ?>s; --dot-width: <?php echo $decoded->dot_width; ?>px;"><svg viewBox="0 0 500 500" id="svg_node"><path d="M50,250c0-110.5,89.5-200,200-200s200,89.5,200,200s-89.5,200-200,200S50,360.5,50,250" id="textcircle" fill="none"></path><text dy="25" id="svg_text_cursor"><textPath xlink:href="#textcircle" id="textpath"><?php echo $decoded->text;?></textPath></text><circle cx="250" cy="250" r="<?php echo $decoded->dot_width;?>" id="svg_circle_node"/></svg>
																<div class="action-icons">
																	<a href="<?php menu_page_url('wpcc_cursor_maker', true); ?>&edit_row=<?php echo intval( $cursor->cursor_id ); ?>" title="<?php echo esc_html__( 'Edit Created Cursor', 'wpcustom-cursors' ); ?>" class="edit-icon"><i class="ri-pencil-line ri-lg"></i></a>
																	
																	<button type="submit" name="delete_created" title="<?php echo esc_html__( 'Delete Created Cursor', 'wpcustom-cursors' ); ?>" class="delete-icon" value="<?php echo esc_html( $cursor->cursor_id ); ?>"><i class="ri-close-fill ri-lg"></i></button>
																	<?php wp_nonce_field( 'wpcc_delete_created_cursor', 'wpcc_delete_created_nonce' ); ?>
																</div>
															</label>
							    							<?php
							    						}
							    					break;
								    			}
									    	}
									    }
									    ?>
									</div>
									<div class="small text-muted mt-2"><?php echo esc_html__( 'Select one of the pre designed cursors above or', 'wpcustom-cursors' ); ?> <a href="<?php menu_page_url('wpcc_cursor_maker', true) ?>" class="text-decoration-none"><?php echo esc_html__( 'create', 'wpcustom-cursors' ); ?></a> <?php echo esc_html__( 'your custom one.', 'wpcustom-cursors' ); ?></div>
									<input type="hidden" value="<?php echo $cursor_type_value; ?>" id="cursor_type_input" name="cursor_type">
								</div>
							
							</fieldset>

							<!-- Step 2: Cursor Options -->
							<fieldset>
								<legend class="pb-2 mb-0 pt-3 px-4">
									<div class="d-flex align-items-center">
										<i class="ri-tools-line ri-lg"></i>
										<div class="ms-2">
											<div class="lead fw-normal"><?php echo esc_html__( 'Cursor Options', 'wpcustom-cursors' );?></div>
											<div class="title-normal text-muted"><?php echo esc_html__('Set the options for the cursor:', 'wpcustom-cursors'); ?></div>
										</div>
									</div>
								</legend>
								<!-- Progress Bar -->
								<div class="progressbar">
									<div class="progress-complete"></div>
								</div>

								<div class="px-4">
									<!-- Show Default Cursor -->
									<label class="toggler-wrapper mt-2 style-4"> 
										<span class="toggler-label"><?php echo esc_html__( 'Show Default Cursor?', 'wpcustom-cursors' );?></span>
										<input type="checkbox" name="default_cursor" id="default_cursor" value="1" <?php checked( $default_cursor_value, '1' ); ?>>
										<div class="toggler-slider">
											<div class="toggler-knob"></div>
										</div>
									</label>

									<div class="row bg-white rounded-2 py-3 my-3" id="shape_cursor_options">
										<div class="col-md-6">
											<!-- Cursor Color -->
											<div class="title-normal mt-3">
												<?php echo esc_html__('Cursor Color:', 'wpcustom-cursors'); ?>
											</div>
											<div class="color_select form-group mt-2">
											    <label class="w-100">
											    	<input type='text' class="form-control basic wp-custom-cursor-color-picker" id="cursor_color" name="color" value="<?php echo $color_value; ?>">
											    </label>
											</div>
										</div>
										<div class="col-md-6">
											<!-- Cursor Size -->
											<label for="cursor_size_input" class="title-normal mt-3"><?php echo esc_html__( 'Cursor Size:', 'wpcustom-cursors' );?></label>

											<div class="d-flex align-items-center mt-2">
												<input type="range" class="form-range me-2" min="1" max="500" id="cursor_size_range" value="<?php echo $width_value; ?>">
												<input type="number" min="1" max="500" id="cursor_size_input" class="number-input" name='width' value="<?php echo $width_value; ?>">
												<span class="ms-2 small"><?php echo esc_html__( 'PX', 'wpcustom-cursors' );?></span>
											</div>
										</div>
										<div class="col-md-6">
											<!-- Blending Mode Select -->
											<div class="form-group blending-selector">
												<label for="blending_mode" class="title-normal mt-3"><?php echo esc_html__('Blending Mode:', 'wpcustom-cursors'); ?></label>
												<select class="form-control mt-2" id="blending_mode" name='blending_mode'>
													<option value="normal" <?php if (isset($blending_mode_value)) {selected( $blending_mode_value, 'normal' );} ?>><?php _e('Normal', 'wpcustom-cursors'); ?></option>
													<option value="multiply" <?php if (isset($blending_mode_value)) {selected( $blending_mode_value, 'multiply' );} ?>><?php _e('Multiply', 'wpcustom-cursors'); ?></option>
													<option value="screen" <?php if (isset($blending_mode_value)) {selected( $blending_mode_value, 'screen' );} ?>><?php _e('Screen', 'wpcustom-cursors'); ?></option>
													<option value="overlay" <?php if (isset($blending_mode_value)) {selected( $blending_mode_value, 'overlay' );} ?>><?php _e('Overlay', 'wpcustom-cursors'); ?></option>
													<option value="darken" <?php if (isset($blending_mode_value)) {selected( $blending_mode_value, 'darken' );} ?>><?php _e('Darken', 'wpcustom-cursors'); ?></option>
													<option value="lighten" <?php if (isset($blending_mode_value)) {selected( $blending_mode_value, 'lighten' );} ?>><?php _e('Lighten', 'wpcustom-cursors'); ?></option>
													<option value="color-dodge" <?php if (isset($blending_mode_value)) {selected( $blending_mode_value, 'color-dodge' );} ?>><?php _e('Color Dodge', 'wpcustom-cursors'); ?></option>
													<option value="color-burn" <?php if (isset($blending_mode_value)) {selected( $blending_mode_value, 'color-burn' );} ?>><?php _e('Color Burn', 'wpcustom-cursors'); ?></option>
													<option value="hard-light" <?php if (isset($blending_mode_value)) {selected( $blending_mode_value, 'hard-light' );} ?>><?php _e('Hard Light', 'wpcustom-cursors'); ?></option>
													<option value="soft-light" <?php if (isset($blending_mode_value)) {selected( $blending_mode_value, 'soft-light' );} ?>><?php _e('Soft Light', 'wpcustom-cursors'); ?></option>
													<option value="difference" <?php if (isset($blending_mode_value)) {selected( $blending_mode_value, 'difference' );} ?>><?php _e('Difference', 'wpcustom-cursors'); ?></option>
													<option value="exclusion" <?php if (isset($blending_mode_value)) {selected( $blending_mode_value, 'exclusion' );} ?>><?php _e('Exclusion', 'wpcustom-cursors'); ?></option>
													<option value="hue" <?php if (isset($blending_mode_value)) {selected( $blending_mode_value, 'hue' );} ?>><?php _e('Hue', 'wpcustom-cursors'); ?></option>
													<option value="saturation" <?php if (isset($blending_mode_value)) {selected( $blending_mode_value, 'saturation' );} ?>><?php _e('Saturation', 'wpcustom-cursors'); ?></option>
													<option value="color" <?php if (isset($blending_mode_value)) {selected( $blending_mode_value, 'color' );} ?>><?php _e('Color', 'wpcustom-cursors'); ?></option>
													<option value="luminosity" <?php if (isset($blending_mode_value)) {selected( $blending_mode_value, 'luminosity' );} ?>><?php _e('Luminosity', 'wpcustom-cursors'); ?></option>
												</select>
											</div>
										</div>
									</div>

									<!-- Hide Custom Cursor On Tablet -->
									<label class="toggler-wrapper mt-3 style-4"> 
										<span class="toggler-label"><?php echo esc_html__( 'Hide Custom Cursor On Tablet', 'wpcustom-cursors' );?></span>
										<input type="checkbox" id="hide_tablet" name="hide_tablet" value="on" <?php checked( $hide_tablet_value, 'on' ); ?>>
										<div class="toggler-slider">
											<div class="toggler-knob"></div>
										</div>
									</label>

									<!-- Hide Custom Cursor On Mobile -->
									<label class="toggler-wrapper mt-3 style-4"> 
										<span class="toggler-label"><?php echo esc_html__( 'Hide Custom Cursor On Mobile', 'wpcustom-cursors' );?></span>
										<input type="checkbox" id="hide_mobile" name="hide_mobile" value="on" <?php checked( $hide_mobile_value, 'on' ); ?>>
										<div class="toggler-slider">
											<div class="toggler-knob"></div>
										</div>
									</label>
								</div>
							</fieldset>

							<!-- Step 3: Hover Options -->
							<fieldset>
								<legend class="pb-2 mb-0 pt-3 px-4">
									<div class="d-flex align-items-center">
										<i class="ri-drag-drop-fill ri-lg"></i>
										<div class="ms-2">
											<div class="lead fw-normal"><?php echo esc_html__( 'Hover Options', 'wpcustom-cursors' );?></div>
											<div class="title-normal text-muted"><?php echo esc_html__('Add hover cursors:', 'wpcustom-cursors'); ?></div>
										</div>
									</div>
								</legend>
								<!-- Progress Bar -->
								<div class="progressbar">
									<div class="progress-complete"></div>
								</div>

								<div class="px-4">
									<!-- List of Hover Cursors -->
									<div class="hover-cursors-list-wrapper px-2 mb-4">
										<?php if( isset($hover_cursor_item) ) { echo $hover_cursor_item; } ?>
									</div>

									<!-- Add Hover Cursor Button -->
									<button type="button" class="plus-btn" id="create_hover_btn">
										<i class="ri-add-line"></i>
										<?php echo esc_html__('Create Hover Cursor', 'wpcustom-cursors'); ?>
									</button>

									<!-- Add Hover Cursor Form -->
									<div id="hover_cursor_wrapper" class="hover-form-wrapper  mt-3 p-4 rounded-3" style="display: none;">

										<div class="title-normal">
											<?php echo esc_html__( 'Enable On:', 'wpcustom-cursors' );?>
										</div>
										<div class="row">
											<div class="col-md-6">
												<!-- Links -->
												<label class="toggler-wrapper mt-2 style-4"> 
													<span class="toggler-label"><?php echo esc_html__( 'Links', 'wpcustom-cursors' );?></span>
													<input type="checkbox" id="hover_trigger_link" value="1" <?php checked( $hover_trigger_link_value, '1' ); ?>>
													<div class="toggler-slider">
														<div class="toggler-knob"></div>
													</div>
												</label>

												<!-- Buttons -->
												<label class="toggler-wrapper mt-3 style-4"> 
													<span class="toggler-label"><?php echo esc_html__( 'Buttons', 'wpcustom-cursors' );?></span>
													<input type="checkbox" id="hover_trigger_button" value="1" <?php checked( $hover_trigger_button_value, '1' ); ?>>
													<div class="toggler-slider">
														<div class="toggler-knob"></div>
													</div>
												</label>
											</div>
											<div class="col-md-6">
												<!-- Custom Element -->
												<label class="toggler-wrapper style-4"> 
													<span class="toggler-label"><?php echo esc_html__( 'Custom Element', 'wpcustom-cursors' );?></span>
													<input type="checkbox" id="hover_trigger_custom" value="1" <?php checked( $hover_trigger_custom_value, '1' ); ?>>
													<div class="toggler-slider">
														<div class="toggler-knob"></div>
													</div>
												</label>

												<!-- Custom Hover Selector -->
												<div class="input-group mt-2" id="hover_trigger_custom_wrapper">
													<span class="input-group-text" id="custom_hover_selector"><?php echo esc_html__('CSS Query', 'wpcustom-cursors'); ?></span>
													<input type="text" value="<?php echo $hover_trigger_selector_value; ?>" class="form-control" placeholder="<?php echo esc_html__('e.g. .btn', 'wpcustom-cursors'); ?>" aria-label="<?php echo esc_html__('Selector', 'wpcustom-cursors'); ?>" aria-describedby="custom_hover_selector" id="hover_trigger_selector">
												</div>
											</div>
										</div>

										<div class="title-normal mt-4 mb-2">
											<?php echo esc_html__( 'Hover Type:', 'wpcustom-cursors' );?>
										</div>

										<!-- Hover Cursor Type -->
										<div class="btn-group" role="group" aria-label="<?php echo esc_html__( 'Hover Type:', 'wpcustom-cursors' );?>">
											<input type="radio" class="btn-check" name="hover_type" id="hover_type_default" autocomplete="off" value="default" <?php checked( $hover_cursor_type_value, 'default' ); ?>>
											<label class="btn btn-outline-dark btn-sm" for="hover_type_default"><?php echo esc_html__( 'Default', 'wpcustom-cursors' );?></label>

											<input type="radio" class="btn-check" name="hover_type" id="hover_type_snap" autocomplete="off" value="snap" <?php checked( $hover_cursor_type_value, 'snap' ); ?>>
											<label class="btn btn-outline-dark btn-sm" for="hover_type_snap"><?php echo esc_html__( 'Snap', 'wpcustom-cursors' );?></label>

											<input type="radio" class="btn-check" name="hover_type" id="hover_type_available" autocomplete="off" value="available" <?php checked( $hover_cursor_type_value, 'available' ); ?>>
											<label class="btn btn-outline-dark btn-sm" for="hover_type_available"><?php echo esc_html__( 'Shape', 'wpcustom-cursors' );?></label>
										</div>

										<div class="hover-cursors-list mt-3" id="available_hover_cursors" style="display: none;">
											<!-- Cursor 1 -->
											<input type="radio" name="hover_cursor_type" class="btn-check hover-cursor-radio" id="hover_cursor_1" autocomplete="off" value="1" <?php checked( $hover_cursor_value, '1' ); ?>>
											<label for="hover_cursor_1"><img src="<?php echo esc_url( plugins_url( '../img/cursors/hover-1.svg', __FILE__ ) ); ?>" alt="<?php echo esc_html__('Hover Cursor 1', 'wpcustom-cursors'); ?>" class="shape-img" /></label>

											<!-- Cursor 2 -->
											<input type="radio" name="hover_cursor_type" class="btn-check hover-cursor-radio" id="hover_cursor_2" autocomplete="off" value="2" <?php checked( $hover_cursor_value, '2' ); ?>>
											<label for="hover_cursor_2"><img src="<?php echo esc_url( plugins_url( '../img/cursors/hover-2.svg', __FILE__ ) ); ?>" alt="<?php echo esc_html__('Hover Cursor 2', 'wpcustom-cursors'); ?>" class="shape-img" /></label>

											<!-- Cursor 3 -->
											<input type="radio" name="hover_cursor_type" class="btn-check hover-cursor-radio" id="hover_cursor_3" autocomplete="off" value="3" <?php checked( $hover_cursor_value, '3' ); ?>>
											<label for="hover_cursor_3"><img src="<?php echo esc_url( plugins_url( '../img/cursors/hover-3.svg', __FILE__ ) ); ?>" alt="<?php echo esc_html__('Hover Cursor 3', 'wpcustom-cursors'); ?>" class="shape-img" /></label>

											<!-- Cursor 4 -->
											<input type="radio" name="hover_cursor_type" class="btn-check hover-cursor-radio" id="hover_cursor_4" autocomplete="off" value="4" <?php checked( $hover_cursor_value, '4' ); ?>>
											<label for="hover_cursor_4"><img src="<?php echo esc_url( plugins_url( '../img/cursors/hover-4.svg', __FILE__ ) ); ?>" alt="<?php echo esc_html__('Hover Cursor 4', 'wpcustom-cursors'); ?>" class="shape-img" /></label>

											<!-- Cursor 5 -->
											<input type="radio" name="hover_cursor_type" class="btn-check hover-cursor-radio" id="hover_cursor_5" autocomplete="off" value="5" <?php checked( $hover_cursor_value, '5' ); ?>>
											<label for="hover_cursor_5"><img src="<?php echo esc_url( plugins_url( '../img/cursors/hover-5.svg', __FILE__ ) ); ?>" alt="<?php echo esc_html__('Hover Cursor 5', 'wpcustom-cursors'); ?>" class="shape-img" /></label>

											<!-- Cursor 6 -->
											<input type="radio" name="hover_cursor_type" class="btn-check hover-cursor-radio" id="hover_cursor_6" autocomplete="off" value="6" <?php checked( $hover_cursor_value, '6' ); ?>>
											<label for="hover_cursor_6"><img src="<?php echo esc_url( plugins_url( '../img/cursors/hover-6.svg', __FILE__ ) ); ?>" alt="<?php echo esc_html__('Hover Cursor 6', 'wpcustom-cursors'); ?>" class="shape-img" /></label>

											<!-- Cursor 7 -->
											<input type="radio" name="hover_cursor_type" class="btn-check hover-cursor-radio" id="hover_cursor_7" autocomplete="off" value="7" <?php checked( $hover_cursor_value, '7' ); ?>>
											<label for="hover_cursor_7"><img src="<?php echo esc_url( plugins_url( '../img/cursors/hover-7.svg', __FILE__ ) ); ?>" alt="<?php echo esc_html__('Hover Cursor 7', 'wpcustom-cursors'); ?>" class="shape-img" /></label>

											<!-- Cursor 8 -->
											<input type="radio" name="hover_cursor_type" class="btn-check hover-cursor-radio" id="hover_cursor_8" autocomplete="off" value="8" <?php checked( $hover_cursor_value, '8' ); ?>>
											<label for="hover_cursor_8"><img src="<?php echo esc_url( plugins_url( '../img/cursors/hover-8.svg', __FILE__ ) ); ?>" alt="<?php echo esc_html__('Hover Cursor 8', 'wpcustom-cursors'); ?>" class="shape-img" /></label>

											<!-- Cursor 9 -->
											<input type="radio" name="hover_cursor_type" class="btn-check hover-cursor-radio" id="hover_cursor_9" autocomplete="off" value="9" <?php checked( $hover_cursor_value, '9' ); ?>>
											<label for="hover_cursor_9"><img src="<?php echo esc_url( plugins_url( '../img/cursors/hover-9.svg', __FILE__ ) ); ?>" alt="<?php echo esc_html__('Hover Cursor 9', 'wpcustom-cursors'); ?>" class="shape-img" /></label>

											<!-- Cursor 10 -->
											<input type="radio" name="hover_cursor_type" class="btn-check hover-cursor-radio" id="hover_cursor_10" autocomplete="off" value="10" <?php checked( $hover_cursor_value, '10' ); ?>>
											<label for="hover_cursor_10"><img src="<?php echo esc_url( plugins_url( '../img/cursors/hover-10.svg', __FILE__ ) ); ?>" alt="<?php echo esc_html__('Hover Cursor 10', 'wpcustom-cursors'); ?>" class="shape-img" /></label>

											<!-- Cursor 11 -->
											<input type="radio" name="hover_cursor_type" class="btn-check hover-cursor-radio" id="hover_cursor_11" autocomplete="off" value="11" <?php checked( $hover_cursor_value, '11' ); ?>>
											<label for="hover_cursor_11"><img src="<?php echo esc_url( plugins_url( '../img/cursors/hover-11.svg', __FILE__ ) ); ?>" alt="<?php echo esc_html__('Hover Cursor 11', 'wpcustom-cursors'); ?>" class="shape-img" /></label>

											<!-- Cursor 12 -->
											<input type="radio" name="hover_cursor_type" class="btn-check hover-cursor-radio" id="hover_cursor_12" autocomplete="off" value="12" <?php checked( $hover_cursor_value, '12' ); ?>>
											<label for="hover_cursor_12"><img src="<?php echo esc_url( plugins_url( '../img/cursors/hover-12.svg', __FILE__ ) ); ?>" alt="<?php echo esc_html__('Hover Cursor 12', 'wpcustom-cursors'); ?>" class="shape-img" /></label>

											<!-- Cursor 13 -->
											<input type="radio" name="hover_cursor_type" class="btn-check hover-cursor-radio" id="hover_cursor_13" autocomplete="off" value="13" <?php checked( $hover_cursor_value, '13' ); ?>>
											<label for="hover_cursor_13"><img src="<?php echo esc_url( plugins_url( '../img/cursors/hover-13.svg', __FILE__ ) ); ?>" alt="<?php echo esc_html__('Hover Cursor 13', 'wpcustom-cursors'); ?>" class="shape-img" /></label>

											<!-- Cursor 14 -->
											<input type="radio" name="hover_cursor_type" class="btn-check hover-cursor-radio" id="hover_cursor_14" autocomplete="off" value="14" <?php checked( $hover_cursor_value, '14' ); ?>>
											<label for="hover_cursor_14"><img src="<?php echo esc_url( plugins_url( '../img/cursors/hover-14.svg', __FILE__ ) ); ?>" alt="<?php echo esc_html__('Hover Cursor 14', 'wpcustom-cursors'); ?>" class="shape-img" /></label>

											<!-- Cursor 15 -->
											<input type="radio" name="hover_cursor_type" class="btn-check hover-cursor-radio" id="hover_cursor_15" autocomplete="off" value="15" <?php checked( $hover_cursor_value, '15' ); ?>>
											<label for="hover_cursor_15"><img src="<?php echo esc_url( plugins_url( '../img/cursors/hover-15.svg', __FILE__ ) ); ?>" alt="<?php echo esc_html__('Hover Cursor 15', 'wpcustom-cursors'); ?>" class="shape-img" /></label>

											<!-- Cursor 16 -->
											<input type="radio" name="hover_cursor_type" class="btn-check hover-cursor-radio" id="hover_cursor_16" autocomplete="off" value="16" <?php checked( $hover_cursor_value, '16' ); ?>>
											<label for="hover_cursor_16"><img src="<?php echo esc_url( plugins_url( '../img/cursors/hover-16.svg', __FILE__ ) ); ?>" alt="<?php echo esc_html__('Hover Cursor 16', 'wpcustom-cursors'); ?>" class="shape-img" /></label>

											<!-- Cursor 17 -->
											<input type="radio" name="hover_cursor_type" class="btn-check hover-cursor-radio" id="hover_cursor_17" autocomplete="off" value="17" <?php checked( $hover_cursor_value, '17' ); ?>>
											<label for="hover_cursor_17"><img src="<?php echo esc_url( plugins_url( '../img/cursors/hover-17.svg', __FILE__ ) ); ?>" alt="<?php echo esc_html__('Hover Cursor 17', 'wpcustom-cursors'); ?>" class="shape-img" /></label>

											<!-- Cursor 18 -->
											<input type="radio" name="hover_cursor_type" class="btn-check hover-cursor-radio" id="hover_cursor_18" autocomplete="off" value="18" <?php checked( $hover_cursor_value, '18' ); ?>>
											<label for="hover_cursor_18"><img src="<?php echo esc_url( plugins_url( '../img/cursors/hover-18.svg', __FILE__ ) ); ?>" alt="<?php echo esc_html__('Hover Cursor 18', 'wpcustom-cursors'); ?>" class="shape-img" /></label>

											<!-- Cursor 19 -->
											<input type="radio" name="hover_cursor_type" class="btn-check hover-cursor-radio" id="hover_cursor_19" autocomplete="off" value="19" <?php checked( $hover_cursor_value, '19' ); ?>>
											<label for="hover_cursor_19"><img src="<?php echo esc_url( plugins_url( '../img/cursors/hover-19.svg', __FILE__ ) ); ?>" alt="<?php echo esc_html__('Hover Cursor 19', 'wpcustom-cursors'); ?>" class="shape-img" /></label>

											<div class="row align-items-end" id="hover_text_icon_wrapper" style="display: none;">
												<div class="col-md-6">
													<!-- Hover Cursor Text -->
													<div class="mt-3">
														<label for="hover_cursor_text" class="form-label"><?php echo esc_html__('Hover Cursor Text', 'wpcustom-cursors'); ?></label>
														<input type="text" class="form-control" value="<?php echo $hover_cursor_text; ?>" id="hover_cursor_text" placeholder="<?php echo esc_html__('View', 'wpcustom-cursors'); ?>" aria-label="<?php echo esc_html__('View', 'wpcustom-cursors'); ?>">
													</div>
												</div>
												<div class="col-md-6">
													<!-- Hover Cursor Icon -->
													<div class="icon-wrapper" id="hover_cursor_icon_wrapper">
														<div class="label">
															<?php echo esc_html__('Icon', 'wpcustom-cursors'); ?>
														</div>
														<div class="file">
															<img src="<?php echo $hover_cursor_icon ?>" id="hover_cursor_icon" alt="<?php echo esc_html__('Hover Cursor Icon', 'wpcustom-cursors'); ?>" />
														</div>
													</div>
													<input type="hidden" id="hover_cursor_icon_url" value="<?php echo $hover_cursor_icon ?>">
												</div>
											</div>

											<div class="row">
												<div class="col-md-6">
													<!-- Color -->
													<div class="title-normal mt-3">
														<?php echo esc_html__('Background Color:', 'wpcustom-cursors'); ?>
													</div>
													<div class="color_select form-group mt-2">
													    <label class="w-100">
													    	<input type='text' class="form-control basic wp-custom-cursor-color-picker" id="hover_background_color" value="<?php echo $hover_bg_color_value; ?>">
													    </label>
													</div>
												</div>
												<div class="col-md-6">
													<!-- Width -->
													<label for="hover_cursor_width_range" class="title-normal mt-3"><?php echo esc_html__( 'Width:', 'wpcustom-cursors' );?></label>

													<div class="d-flex align-items-center mt-2">
														<input type="range" class="form-range me-2" min="10" max="500" id="hover_cursor_width_input" value="<?php echo $hover_cursor_width_value; ?>">
														<input type="number" min="10" max="500" id="hover_cursor_width_range" class="number-input" value="<?php echo $hover_cursor_width_value; ?>">
														<span class="ms-2 small"><?php echo esc_html__( 'PX', 'wpcustom-cursors' );?></span>
													</div>
												</div>
											</div>
										</div>

										<div class="mt-3">
											<!-- Input to store all hover cursors -->
											<input type="hidden" id="hover_cursors" name="hover_cursors" value="<?php echo $hover_cursors_value ?>">

											<div class="text-end">
												<!-- Cancel Button -->
												<button type="button" class="btn btn-danger mt-3" id="cancel_hover_btn"><?php echo esc_html__('Cancel', 'wpcustom-cursors'); ?></button>

												<!-- Save Button -->
												<button type="button" class="btn btn-primary mt-3" id="save_hover_btn"><?php echo esc_html__('Save', 'wpcustom-cursors'); ?></button>
											</div>

											<!-- Error Message -->
											<div class="mt-3 alert alert-danger d-none align-items-center fade small" role="alert" id="alert_container">
											  	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
											    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
											  	</svg>
											  	<div id="alert_message"></div>
											</div>
										</div>
									</div>
								</div>
							</fieldset>

							<!-- Step 4: Activation -->
							<fieldset>
								<legend class="pb-2 mb-0 pt-3 px-4">
									<div class="d-flex align-items-center">
										<i class="ri-check-double-fill ri-lg"></i>
										<div class="ms-2">
											<div class="lead fw-normal"><?php echo esc_html__( 'Activation', 'wpcustom-cursors' );?></div>
											<div class="title-normal text-muted"><?php echo esc_html__('Add custom cursor to your page:', 'wpcustom-cursors'); ?></div>
										</div>
									</div>
								</legend>
								<!-- Progress Bar -->
								<div class="progressbar">
									<div class="progress-complete"></div>
								</div>

								<div class="px-4">
									<div class="btn-group" role="group" aria-label="<?php echo esc_html__('Activate On', 'wpcustom-cursors'); ?>">
										<div id="activate_on_page">
											<input type="radio" class="btn-check" name="activate_on" value="0" id="activate_on_body" autocomplete="off" <?php checked( $activate_on_value, '0' ); ?>>
											<label class="btn btn-outline-dark btn-sm" for="activate_on_body"><i class="ri-window-fill"></i> <?php echo esc_html__('Entire Website', 'wpcustom-cursors'); ?></label>
										</div>

										<div id="activate_on_section">
											<input type="radio" class="btn-check" name="activate_on" value="1" id="activate_on_element" autocomplete="off" <?php checked( $activate_on_value, '1' ); ?>>
											<label class="btn btn-outline-dark btn-sm" for="activate_on_element"><i class="ri-picture-in-picture-line"></i> <?php echo esc_html__('A Section', 'wpcustom-cursors'); ?></label>
										</div>
									</div>
									<!-- End Activate On -->

									<!-- Element Selector Group -->
									<div id="select_element_group" style="display: none;">
										<div class="input-group selector-group mt-3">
											<select class="form-select" name="selector_type" id="selector_type" aria-label="<?php echo esc_html__('Selector Type', 'wpcustom-cursors'); ?>">
												<option value="tag" <?php if ($selector_type_value) {selected( $selector_type_value, 'tag' );}?>><?php echo esc_html__( 'Tag', 'wpcustom-cursors' ); ?></option>
											    <option value="class" <?php if ($selector_type_value) {selected( $selector_type_value, 'class' );}?>><?php echo esc_html__( 'Class', 'wpcustom-cursors' ); ?></option>
											    <option value="id" <?php if ($selector_type_value) {selected( $selector_type_value, 'id' );}?>><?php echo esc_html__( 'ID', 'wpcustom-cursors' ); ?></option>
											    <option value="attribute" <?php if ($selector_type_value) {selected( $selector_type_value, 'attribute' );}?>><?php echo esc_html__( 'Attribute', 'wpcustom-cursors' ); ?></option>
											</select>
											 <input type='text' placeholder="<?php echo esc_html__('Selector', 'wpcustom-cursors'); ?>" class="form-control rounded-right " name='selector_data' id="selector_data" value="<?php echo $selector_data_value; ?>" aria-label="<?php echo esc_html__('Selector Query', 'wpcustom-cursors'); ?>" aria-describedby="selector_type">
										</div>

										<small class="text-muted fw-light"><?php echo esc_html__('All elements selected with above criteria would have the custom cursor.', 'wpcustom-cursors'); ?></small>
										<!-- End Element Selector Group -->
									</div>

									<!-- Submit Button -->
									<div>
									<?php  
										if(isset($_GET['edit_row'])) {
											?>
											<input type="hidden" name="update_id" value="<?php echo sanitize_text_field( $_GET['edit_row'] ); ?>">
											<button type="submit" name="update" class="btn btn-success btn-lg mt-4 d-flex align-items-center">
												<?php echo esc_html__( 'Update Cursor', 'wpcustom-cursors' ) ?>
												<i class="ri-pencil-line ms-2"></i>
											</button>

											<?php
										}

										else {
											?>
											<button type="submit" name="add" class="btn btn-primary btn-lg mt-4 d-flex align-items-center">
												<?php echo esc_html__( 'Save Cursor', 'wpcustom-cursors' ) ?>
												<i class="ri-checkbox-circle-fill ms-2"></i>
											</button>
											<?php
										}
									?>
									</div>
								</div>
							</fieldset>
							<?php wp_nonce_field( 'wpcc_add_new_cursor', 'wpcc_add_new_nonce' ); ?>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card bg-light rounded-3 p-0 position-sticky top">
					<div class="card-body p-0">
						<!-- Preview -->
						<div class="bg-white rounded-2">
							<div id="wt-preview" class="<?php if($default_cursor_value == 0) { echo 'no-cursor'; } ?>">
								<div class="preview-inner  p-4 ">
									<div class="font-weight-bold mb-3"><?php _e('Preview:', 'wpcustom-cursors'); ?></div>
									<div class="d-flex align-items-center">
										<button class="btn btn-danger"><?php _e('Button', 'wpcustom-cursors'); ?></button>
										<input type="text" class="form-control mx-2" placeholder="<?php _e('Input', 'wpcustom-cursors'); ?>">
										<a href="javascript:void(0);"><?php _e('Link', 'wpcustom-cursors'); ?></a>
										
									</div>
							    	
							    	<div class="position-relative">
							    		<img src="<?php echo esc_url( plugins_url( '../img/preview-image.jpg', __FILE__ ) ); ?>" alt="<?php echo esc_html__('Test blending mode option on image', 'wpcustom-cursors');?>" class="img-fluid mt-2 rounded" />
							    		<small class="credit"><?php _e('Photo Credit: Unsplash', 'wpcustom-cursors'); ?></small>
							    	</div>
						    	</div>
						    </div>
						</div>
						<!-- End Preview -->
					</div>
				</div>
			</div>
		</div>
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