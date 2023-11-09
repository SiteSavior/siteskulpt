<?php
	/**
	 * @link       https://codecanyon.net/user/web_trendy
	 * @since      3.1
	 * @package    Wp_custom_cursors
	 * @subpackage Wp_custom_cursors/includes
	 * @author     Web_Trendy <webtrendyio@gmail.com>
	 */

	// Initialization
	$fe_width_value = 10;
	$fe_height_value = 10;
	$fe_color_value = '#252525';
	$fe_radius_value = 100;
	$fe_border_value = 0;
	$fe_border_color_value = '#252525';
	$fe_duration_value = 0;
	$fe_timing_value = 'ease-out';
	$fe_blending_value = 'normal';
	$fe_zindex_value = 101;
	$fe_backdrop_value = 'none';
	$fe_backdrop_amount_value = '';

	$se_width_value = 50;
	$se_height_value = 50;
	$se_color_value = '#08bea6';
	$se_radius_value = 100;
	$se_border_value = 0;
	$se_border_color_value = '#252525';
	$se_duration_value = 0;
	$se_timing_value = 'ease-out';
	$se_blending_value = 'normal';
	$se_zindex_value = 100;
	$se_backdrop_value = 'none';
	$se_backdrop_amount_value = '';


	$image_url_value = null;
	$image_width_value = 100;
	$image_height_value = null;
	$image_background_value = 'off';
	$image_background_color_value = 'transparent';
	$image_background_radius_value = 0;
	$image_background_padding_value = 0;
	$image_blending_value = 'normal';
	$click_point_value = "50,50";


	$cursor_text_value = esc_html__( 'WP Custom Cursor - Circular Cursor', 'wpcustom-cursors' );
	$show_dot_value = 'on';
	$dot_width_value = 10;
	$dot_color_value = '#252500';
	$text_color_value = '#252525';
	$text_transform_value = 'uppercase';
	$font_size_value = 55;
	$font_weight_value = 'bold';
	$text_width_value = 150;
	$word_spacing_value = 30;
	$text_animation_value = 'spinright';
	$text_animation_duration_value = 10;
	$text_type_value = 'text';
	
	$hr_text_value = esc_html__( 'Cursor', 'wpcustom-cursors' );
	$hr_backdrop_value = 'none';
	$hr_backdrop_amount_value = '';
	$hr_background_value = '#f3f6f4';
	$hr_radius_value = 0;
	$hr_padding_value = 0;
	$hr_width_value = 150;
	$hr_size_value = 35;
	$hr_transform_value = 'capitalize';
	$hr_color_value = '#252525';
	$hr_weight_value = 'bold';
	$hr_spacing_value = 5;
	$hr_duration_value = 0;
	$hr_timing_value = 'ease-out';

	$cursor_type_value = 'shape';
	$cursor_state_value = 'normal';

	// Edit cursor
    if(isset($_GET['edit_row'])) {
    	global $wpdb;
		$tablename = $wpdb->prefix . "created_cursors";
		$edit_row = intval( sanitize_text_field( $_GET['edit_row'] ) );
		$query = $wpdb->prepare( "SELECT * from $tablename WHERE cursor_id = %d", $edit_row  );
		$cursor = $wpdb->get_row($query);

		$stripped = stripslashes($cursor->cursor_options);
		$decoded = json_decode($stripped, false);

		switch ($cursor->cursor_type) {
			case 'shape':
				$fe_width_value = $decoded->fe_width;
				$fe_height_value = $decoded->fe_height;
				$fe_color_value = $decoded->fe_color;
				$fe_radius_value = $decoded->fe_radius;
				$fe_border_value = $decoded->fe_border_width;
				$fe_border_color_value = $decoded->fe_border_color;
				$fe_duration_value = $decoded->fe_duration;
				$fe_timing_value = $decoded->fe_timing;
				$fe_blending_value = $decoded->fe_blending;
				$fe_zindex_value = $decoded->fe_zindex;
				$fe_backdrop_value = $decoded->fe_backdrop;
				$fe_backdrop_amount_value = $decoded->fe_backdrop_value;

				$se_width_value = $decoded->se_width;
				$se_height_value = $decoded->se_height;
				$se_color_value = $decoded->se_color;
				$se_radius_value = $decoded->se_radius;
				$se_border_value = $decoded->se_border_width;
				$se_border_color_value = $decoded->se_border_color;
				$se_duration_value = $decoded->se_duration;
				$se_timing_value = $decoded->se_timing;
				$se_blending_value = $decoded->se_blending;
				$se_zindex_value = $decoded->se_zindex;
				$se_backdrop_value = $decoded->se_backdrop;
				$se_backdrop_amount_value = $decoded->se_backdrop;
			break;
			case 'image':
				$image_url_value = $decoded->image_url;
				$image_width_value = $decoded->width;
				$image_height_value = $decoded->height;
				$image_background_value = $decoded->background;
				$image_background_color_value = $decoded->color;
				$image_background_radius_value = $decoded->radius;
				$image_background_padding_value = $decoded->padding;
				$image_blending_value = $decoded->blending;
				$click_point_value = $decoded->click_point;
			break;
			case 'text':
				if ($decoded->text_type == 'horizontal') {
					$hr_text_value = $decoded->hr_text;
					$hr_backdrop_value = $decoded->hr_backdrop;
					$hr_backdrop_amount_value = $decoded->hr_backdrop_amount;
					$hr_background_value = $decoded->hr_bgcolor;
					$hr_radius_value = $decoded->hr_radius;
					$hr_padding_value = $decoded->hr_padding;
					$hr_width_value = $decoded->hr_width;
					$hr_transform_value = $decoded->hr_transform;
					$hr_weight_value = $decoded->hr_weight;
					$hr_color_value = $decoded->hr_color;
					$hr_size_value = $decoded->hr_size;
					$hr_spacing_value = $decoded->hr_spacing;
					$hr_duration_value = $decoded->hr_duration;
					$hr_timing_value = $decoded->hr_timing;
					$text_type_value = $decoded->text_type;
				}
				else {
					$cursor_text_value = $decoded->text;
					$show_dot_value = $decoded->dot;
					$dot_color_value = $decoded->dot_color;
					$text_color_value = $decoded->text_color;
					$text_transform_value = $decoded->text_transform;
					$font_size_value = $decoded->font_size;
					$font_weight_value = $decoded->font_weight;
					$text_width_value = $decoded->width;
					$word_spacing_value = $decoded->word_spacing;
					$text_animation_value = $decoded->animation;
					$text_animation_duration_value = $decoded->animation_duration;
					$text_type_value = $decoded->text_type;
				}
			break;
		}

		$cursor_type_value = $cursor->cursor_type;
	}

	?>

	<div class="card p-0">
		<form action="#" method="post" id="create_cursor_form">
		  	<div class="card-header">
		    	<div class="row align-items-center">
		    		<div class="col-8">
		    			<h3 class="h5 mb-0"><?php echo esc_html__( 'Create New Cursor', 'wpcustom-cursors' );?></h3>
		    		</div>
		    		<div class="col-4 d-flex align-items-center">
		    			<label for="cursor_type" class="title-normal"><?php echo esc_html__('Cursor Type:', 'wpcustom-cursors'); ?></label>
		    			<!-- Cursor Type -->
						<div class="form-group flex-grow-1 ms-3">
							<select class="form-control" id="cursor_type" name='cursor_type'>
								<option value="shape" <?php if (isset($cursor_type_value)) {selected( $cursor_type_value, 'shape' );} ?>><?php _e('Shape', 'wpcustom-cursors'); ?></option>
								<option value="image" <?php if (isset($cursor_type_value)) {selected( $cursor_type_value, 'image' );} ?>><?php _e('Image', 'wpcustom-cursors'); ?></option>
								<option value="text" <?php if (isset($cursor_type_value)) {selected( $cursor_type_value, 'text' );} ?>><?php _e('text', 'wpcustom-cursors'); ?></option>
							</select>
						</div>
		    		</div>
		    	</div>
		  	</div>
		 	<div class="card-body py-0">
		 		<div class="row">
			 		<div class="col-9 col-md border-end py-3">
			 			<div id="preview_container">
			 				<!-- Shape Preview - Normal -->
				 			<div class="cursor-preview" id="shape_preview" style="<?php if($cursor_type_value != 'shape') { echo 'display: none;'; }?>">
					 			<div class="cursor-wrapper bg-white">
									<div class="el-1 shape-element" id="el_1" style="--width: <?php echo $fe_width_value; ?>px; --height: <?php echo $fe_height_value; ?>px; --color: <?php echo $fe_color_value; ?>; --radius: <?php echo $fe_radius_value; ?>px; --border: <?php echo $fe_border_value; ?>px; --border-color: <?php echo $fe_border_color_value; ?>; --blending: <?php echo $fe_blending_value ?>; --zindex: <?php echo $fe_zindex_value; ?>; --backdrop: <?php echo $fe_backdrop_value.'('.$fe_backdrop_amount_value.')'; ?>;"></div>
									<div class="el-2 shape-element" id="el_2" style="--width: <?php echo $se_width_value; ?>px; --height: <?php echo $se_height_value; ?>px; --color: <?php echo $se_color_value; ?>; --radius: <?php echo $se_radius_value; ?>px; --border: <?php echo $se_border_value; ?>px; --border-color: <?php echo $se_border_color_value; ?>; --blending: <?php echo $se_blending_value ?>; --zindex: <?php echo $se_zindex_value; ?>; --backdrop: <?php echo $se_backdrop_value.'('.$se_backdrop_amount_value.')'; ?>;"></div>
								</div>
							</div>

							<!-- Image Preview - Normal -->
							<div class="cursor-preview position-relative" id="image_preview" style="<?php if($cursor_type_value != 'image') { echo 'display: none;'; }?>">
								<div class="image-cursor-wrapper">
									<div class="cursor-pointer <?php if($image_url_value) echo 'visually-hidden'; ?>" id="image_upload_btn">
										<?php echo esc_html__( 'Click to add image', 'wpcustom-cursors' ); ?>
									</div>
 
									<div class="new-image position-relative d-inline-block <?php if(!$image_url_value) echo 'visually-hidden'; ?>" id="uploaded_image_wrapper" style="--image-width: <?php echo $image_width_value; ?>px; --image-background-color: <?php echo $image_background_color_value; ?>; --image-background-radius: <?php echo $image_background_radius_value; ?>px; --image-background-padding: <?php echo $image_background_padding_value; ?>px; --image-background-blending: <?php echo $image_blending_value; ?>;">

										<!-- Set The Click Point -->
							    		<div class="click-point" id="click_point" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?php echo esc_html__( 'Drag to set the click point', 'wpcustom-cursors' );?>"></div>
							    		
										<img src="<?php echo $image_url_value ?>" id="uploaded_image" alt="<?php echo esc_html__('Custom Image Cursor', 'wpcustom-cursors'); ?>" />
									</div>
								</div>

								<!-- Delete Button -->
					    		<div id="wpcc_delete_image" class="wpcc_delete_image <?php if ( !$image_url_value ) { echo 'visually-hidden'; } ?>">
							    	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
									    <g>
									        <path fill="none" d="M0 0h24v24H0z"/>
									        <path d="M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z" fill="white"/>
									    </g>
									</svg>
							    </div>

							    <div id="click_point_info" class="click-point-info text-muted <?php if ( !$image_url_value ) { echo 'visually-hidden'; } ?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?php echo esc_html__( 'The red dot defines the clickable point of the image cursor. Simply move the dot to the point of you image cursor where you want to do the click functionality.', 'wpcustom-cursors' );?>">
							    	<i class="ri-question-fill"></i> <span class="small"><?php echo esc_html__( 'About Click Point?', 'wpcustom-cursors' );?></span>	
							    </div>
							    
							</div>

							<!-- Text Preview - Normal -->
							<div class="cursor-preview" id="text_preview" style="<?php if($cursor_type_value != 'text' || $text_type_value != 'circular') { echo 'display: none;'; }?>">
								<div class="cursor-text">
									<svg viewBox="0 0 500 500" id="svg_node" style="--dot-fill: <?php echo $dot_color_value; ?>; --text-color: <?php echo $text_color_value; ?>; --text-width: <?php echo $text_width_value; ?>px; --text-transform: <?php echo $text_transform_value; ?>; --font-size: <?php echo $font_size_value; ?>px; --font-weight: <?php echo $font_weight_value; ?>; --word-spacing: <?php echo $word_spacing_value; ?>px; --animation-name: <?php echo $text_animation_value; ?>; --animation-duration: <?php echo $text_animation_duration_value; ?>s;"><path d="M50,250c0-110.5,89.5-200,200-200s200,89.5,200,200s-89.5,200-200,200S50,360.5,50,250" id="textcircle" fill="none"></path><text dy="25" id="svg_text_cursor"><textPath xlink:href="#textcircle" id="textpath"><?php echo $cursor_text_value; ?></textPath></text><circle cx="250" cy="250" r="10" id="svg_circle_node"/></svg>
								</div>
							</div>

							<div class="cursor-preview" id="horizontal_preview" style="<?php if($cursor_type_value != 'text' || $text_type_value != 'horizontal') { echo 'display: none;'; }?>">
								<div class="cursor-text">
									<div id="hr_text_container" class="horizontal-text" style="--hr-color: <?php echo $hr_color_value; ?>; --bg-color: <?php echo $hr_background_value; ?>; --hr-width: <?php echo $hr_width_value; ?>px;; --hr-radius: <?php echo $hr_radius_value; ?>px; --hr-transform: <?php echo $hr_transform_value; ?>; --hr-size: <?php echo $hr_size_value; ?>px; --hr-weight: <?php echo $hr_weight_value; ?>; --hr-duration: <?php echo $hr_duration_value; ?>ms; --hr-timing: <?php echo $hr_timing_value; ?>px; --hr-spacing: <?php echo $hr_spacing_value; ?>px; --hr-backdrop: <?php echo $hr_backdrop_value . '(' .$hr_backdrop_amount_value. ')'; ?>">
										<?php echo $hr_text_value; ?>
									</div>
								</div>
							</div>
						</div>
			 		</div>
			 		<div class="col-12 col-md py-3 options-container" id="options_container">
			 			<div id="shape_options" style="<?php if($cursor_type_value != 'shape') { echo 'display: none;'; }?>">




			 				<div class="accordion accordion-flush" id="shapeAccordionOptions">
			 					<div class="accordion-item">
			 						<h2 class="accordion-header">
			 							<button class="accordion-button collapsed flex-column align-items-start" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
			 								<h4 class="h5"><?php echo esc_html__( 'Inner Circle', 'wpcustom-cursors' );?></h4>
			 							</button>
			 						</h2>
			 						<div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#shapeAccordionOptions">
			 							<div class="accordion-body">
			 								<!-- First Element Options - Normal -->
								 			<div id="shape_1_options" >
								 				<!-- Width -->
												<label for="fe_width" class="title-normal mt-3"><?php echo esc_html__( 'Width:', 'wpcustom-cursors' );?></label>

												<div class="d-flex align-items-center mt-2">
													<input type="range" data-apply="el_1" data-variable="width" data-unit="px" class="form-range me-2" min="1" max="300" id="fe_width_range" value="<?php echo $fe_width_value; ?>">
													<input type="number" data-apply="el_1" data-variable="width" data-unit="px" min="1" max="300" id="fe_width" class="number-input" value="<?php echo $fe_width_value; ?>" data-name="fe_width">
													<span class="ms-2 small"><?php echo esc_html__( 'PX', 'wpcustom-cursors' );?></span>
												</div>

												<!-- Height -->
												<label for="fe_height" class="title-normal mt-3"><?php echo esc_html__( 'Height:', 'wpcustom-cursors' );?></label>

												<div class="d-flex align-items-center mt-2">
													<input type="range" data-apply="el_1" data-variable="height" data-unit="px" class="form-range me-2" min="1" max="300" id="fe_height_range" value="<?php echo $fe_height_value; ?>">
													<input type="number" data-apply="el_1" data-variable="height" data-unit="px" min="1" max="300" id="fe_height" class="number-input" value="<?php echo $fe_height_value; ?>" data-name="fe_height">
													<span class="ms-2 small"><?php echo esc_html__( 'PX', 'wpcustom-cursors' );?></span>
												</div>

												<!-- Color -->
												<div class="title-normal mt-3">
													<?php echo esc_html__('Color:', 'wpcustom-cursors'); ?>
												</div>
												<div class="color_select form-group mt-2">
												    <label class="w-100">
												    	<input type='text' class="form-control basic wp-custom-cursor-color-picker" data-apply="el_1" data-variable="color" id="fe_color" value="<?php echo $fe_color_value; ?>" data-name="fe_color">
												    </label>
												</div>

												<!-- Border -->
												<label for="fe_border" class="title-normal mt-3"><?php echo esc_html__( 'Border Width:', 'wpcustom-cursors' );?></label>

												<div class="d-flex align-items-center mt-2">
													<input type="range" data-apply="el_1" data-variable="border" data-unit="px" class="form-range me-2" min="0" max="100" id="fe_border_range" value="<?php echo $fe_border_value; ?>">
													<input type="number" data-apply="el_1" data-variable="border" data-unit="px" min="0" max="100" id="fe_border" class="number-input" value="<?php echo $fe_border_value; ?>" data-name="fe_border_width">
													<span class="ms-2 small"><?php echo esc_html__( 'PX', 'wpcustom-cursors' );?></span>
												</div>

												<!-- Radius -->
												<label for="fe_radius" class="title-normal mt-3"><?php echo esc_html__( 'Border Radius:', 'wpcustom-cursors' );?></label>

												<div class="d-flex align-items-center mt-2">
													<input type="range" data-apply="el_1" data-variable="radius" data-unit="px" class="form-range me-2" min="0" max="1000" id="fe_radius_range" value="<?php echo $fe_radius_value; ?>">
													<input type="number" data-apply="el_1" data-variable="radius" data-unit="px" min="0" max="1000" id="fe_radius" class="number-input" value="<?php echo $fe_radius_value; ?>" data-name="fe_radius">
													<span class="ms-2 small"><?php echo esc_html__( 'PX', 'wpcustom-cursors' );?></span>
												</div>

												<!-- Border Color -->
												<div class="title-normal mt-3">
													<?php echo esc_html__('Border Color:', 'wpcustom-cursors'); ?>
												</div>
												<div class="color_select form-group mt-2">
												    <label class="w-100">
												    	<input type='text' class="form-control basic wp-custom-cursor-color-picker" data-apply="el_1" data-variable="border-color" id="fe_border_color" value="<?php echo $fe_border_color_value; ?>" data-name="fe_border_color">
												    </label>
												</div>

												<!-- Transition Duration -->
												<label for="fe_duration" class="title-normal mt-3"><?php echo esc_html__( 'Transition Duration:', 'wpcustom-cursors' );?></label>

												<div class="d-flex align-items-center mt-2">
													<input type="range" data-apply="el_1" data-variable="duration" data-unit="ms" class="form-range me-2" min="0" max="1000" id="fe_duration_range" value="<?php echo $fe_duration_value; ?>">
													<input type="number" data-apply="el_1" data-variable="duration" data-unit="ms" min="0" max="1000" id="fe_duration" class="number-input" value="<?php echo $fe_duration_value; ?>" data-name="fe_duration">
													<span class="ms-2 small"><?php echo esc_html__( 'MS', 'wpcustom-cursors' );?></span>
												</div>

												<!-- Transition Timing Function -->
												<div class="form-group">
													<label for="fe_timing" class="title-normal mt-3"><?php echo esc_html__('Transition Timing Function:', 'wpcustom-cursors'); ?></label>
													<select class="form-control mt-2" id="fe_timing" data-apply="el_1" data-variable="timing" data-name="fe_timing">
														<option value="ease" <?php if (isset($fe_timing_value)) {selected( $fe_timing_value, 'ease' );} ?>><?php _e('Ease', 'wpcustom-cursors'); ?></option>
														<option value="ease-in" <?php if (isset($fe_timing_value)) {selected( $fe_timing_value, 'ease-in' );} ?>><?php _e('Ease In', 'wpcustom-cursors'); ?></option>
														<option value="ease-out" <?php if (isset($fe_timing_value)) {selected( $fe_timing_value, 'ease-out' );} ?>><?php _e('Ease Out', 'wpcustom-cursors'); ?></option>
														<option value="ease-in-out" <?php if (isset($fe_timing_value)) {selected( $fe_timing_value, 'ease-in-out' );} ?>><?php _e('Ease In Out', 'wpcustom-cursors'); ?></option>
														<option value="linear" <?php if (isset($fe_timing_value)) {selected( $fe_timing_value, 'linear' );} ?>><?php _e('Linear', 'wpcustom-cursors'); ?></option>
													</select>
												</div>

												<!-- Blending Mode -->
												<div class="form-group">
													<label for="fe_blending" class="title-normal mt-3"><?php echo esc_html__('Blending Mode:', 'wpcustom-cursors'); ?></label>
													<select class="form-control mt-2" id="fe_blending" data-apply="el_1" data-variable="blending" data-name="fe_blending">
														<option value="normal" <?php if (isset($fe_blending_value)) {selected( $fe_blending_value, 'normal' );} ?>><?php _e('Normal', 'wpcustom-cursors'); ?></option>
														<option value="multiply" <?php if (isset($fe_blending_value)) {selected( $fe_blending_value, 'multiply' );} ?>><?php _e('Multiply', 'wpcustom-cursors'); ?></option>
														<option value="screen" <?php if (isset($fe_blending_value)) {selected( $fe_blending_value, 'screen' );} ?>><?php _e('Screen', 'wpcustom-cursors'); ?></option>
														<option value="overlay" <?php if (isset($fe_blending_value)) {selected( $fe_blending_value, 'overlay' );} ?>><?php _e('Overlay', 'wpcustom-cursors'); ?></option>
														<option value="darken" <?php if (isset($fe_blending_value)) {selected( $fe_blending_value, 'darken' );} ?>><?php _e('Darken', 'wpcustom-cursors'); ?></option>
														<option value="lighten" <?php if (isset($fe_blending_value)) {selected( $fe_blending_value, 'lighten' );} ?>><?php _e('Lighten', 'wpcustom-cursors'); ?></option>
														<option value="color-dodge" <?php if (isset($fe_blending_value)) {selected( $fe_blending_value, 'color-dodge' );} ?>><?php _e('Color Dodge', 'wpcustom-cursors'); ?></option>
														<option value="color-burn" <?php if (isset($fe_blending_value)) {selected( $fe_blending_value, 'color-burn' );} ?>><?php _e('Color Burn', 'wpcustom-cursors'); ?></option>
														<option value="hard-light" <?php if (isset($fe_blending_value)) {selected( $fe_blending_value, 'hard-light' );} ?>><?php _e('Hard Light', 'wpcustom-cursors'); ?></option>
														<option value="soft-light" <?php if (isset($fe_blending_value)) {selected( $fe_blending_value, 'soft-light' );} ?>><?php _e('Soft Light', 'wpcustom-cursors'); ?></option>
														<option value="difference" <?php if (isset($fe_blending_value)) {selected( $fe_blending_value, 'difference' );} ?>><?php _e('Difference', 'wpcustom-cursors'); ?></option>
														<option value="exclusion" <?php if (isset($fe_blending_value)) {selected( $fe_blending_value, 'exclusion' );} ?>><?php _e('Exclusion', 'wpcustom-cursors'); ?></option>
														<option value="hue" <?php if (isset($fe_blending_value)) {selected( $fe_blending_value, 'hue' );} ?>><?php _e('Hue', 'wpcustom-cursors'); ?></option>
														<option value="saturation" <?php if (isset($fe_blending_value)) {selected( $fe_blending_value, 'saturation' );} ?>><?php _e('Saturation', 'wpcustom-cursors'); ?></option>
														<option value="color" <?php if (isset($fe_blending_value)) {selected( $fe_blending_value, 'color' );} ?>><?php _e('Color', 'wpcustom-cursors'); ?></option>
														<option value="luminosity" <?php if (isset($fe_blending_value)) {selected( $fe_blending_value, 'luminosity' );} ?>><?php _e('Luminosity', 'wpcustom-cursors'); ?></option>
													</select>
												</div>

												<!-- Z-index -->
												<label for="fe_zindex" class="title-normal mt-3"><?php echo esc_html__( 'Z-index:', 'wpcustom-cursors' );?></label>

												<div class="d-flex align-items-center mt-2">
													<input type="range" data-apply="el_1" data-variable="zindex" class="form-range me-2" min="100" max="1000000" id="fe_zindex_range" value="<?php echo $fe_zindex_value; ?>">
													<input type="number" data-apply="el_1" data-variable="zindex" min="100" max="1000000" id="fe_zindex" class="number-input" value="<?php echo $fe_zindex_value; ?>" data-name="fe_zindex">
												</div>

												<!-- Backdrop Filter -->
												<div class="form-group">
													<label for="fe_backdrop" class="title-normal mt-3"><?php echo esc_html__('Backdrop Filter:', 'wpcustom-cursors'); ?></label>
													<select class="form-control mt-2" id="fe_backdrop" data-apply="el_1" data-variable="backdrop" data-name="fe_backdrop">
														<option value="none" <?php if (isset($fe_backdrop_value)) {selected( $fe_backdrop_value, 'none' );} ?>><?php _e('None', 'wpcustom-cursors'); ?></option>
														<option value="blur" <?php if (isset($fe_backdrop_value)) {selected( $fe_backdrop_value, 'blur' );} ?>><?php _e('Blur', 'wpcustom-cursors'); ?></option>
														<option value="brightness" <?php if (isset($fe_backdrop_value)) {selected( $fe_backdrop_value, 'brightness' );} ?>><?php _e('Brightness', 'wpcustom-cursors'); ?></option>
														<option value="contrast" <?php if (isset($fe_backdrop_value)) {selected( $fe_backdrop_value, 'contrast' );} ?>><?php _e('Contrast', 'wpcustom-cursors'); ?></option>
														<option value="drop-shadow" <?php if (isset($fe_backdrop_value)) {selected( $fe_backdrop_value, 'drop-shadow' );} ?>><?php _e('Drop Shadow', 'wpcustom-cursors'); ?></option>
														<option value="grayscale" <?php if (isset($fe_backdrop_value)) {selected( $fe_backdrop_value, 'grayscale' );} ?>><?php _e('Grayscale', 'wpcustom-cursors'); ?></option>
														<option value="hue-rotate" <?php if (isset($fe_backdrop_value)) {selected( $fe_backdrop_value, 'hue-rotate' );} ?>><?php _e('Hue Rotate', 'wpcustom-cursors'); ?></option>
														<option value="invert" <?php if (isset($fe_backdrop_value)) {selected( $fe_backdrop_value, 'invert' );} ?>><?php _e('Invert', 'wpcustom-cursors'); ?></option>
														<option value="opacity" <?php if (isset($fe_backdrop_value)) {selected( $fe_backdrop_value, 'opacity' );} ?>><?php _e('Opacity', 'wpcustom-cursors'); ?></option>
														<option value="sepia" <?php if (isset($fe_backdrop_value)) {selected( $fe_backdrop_value, 'sepia' );} ?>><?php _e('Sepia', 'wpcustom-cursors'); ?></option>
														<option value="saturate" <?php if (isset($fe_backdrop_value)) {selected( $fe_backdrop_value, 'saturate' );} ?>><?php _e('Saturate', 'wpcustom-cursors'); ?></option>
														<option value="revert" <?php if (isset($fe_backdrop_value)) {selected( $fe_backdrop_value, 'revert' );} ?>><?php _e('Revert', 'wpcustom-cursors'); ?></option>
													</select>
												</div>

												<!-- Backdrop Filter Value -->
												<div class="form-floating mt-3">
													<input type="text" class="form-control" id="fe_backdrop_amount" placeholder="<?php echo esc_html__( 'e.g. 2px', 'wpcustom-cursors' );?>" value="<?php echo $fe_backdrop_amount_value; ?>" data-name="fe_backdrop_value">
													<label for="fe_backdrop_amount"><?php echo esc_html__( 'Value with unit e.g. 2px', 'wpcustom-cursors' );?></label>
												</div>
								 			</div>
			 							</div>
			 						</div>
			 					</div>
			 					<div class="accordion-item">
			 						<h2 class="accordion-header">
			 							<button class="accordion-button collapsed flex-column align-items-start" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
			 								<h4 class="h5"><?php echo esc_html__( 'Outer Circle', 'wpcustom-cursors' );?></h4>
			 							</button>
			 						</h2>
			 						<div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#shapeAccordionOptions">
			 							<div class="accordion-body">
			 								<!-- Second Element Options - Normal -->
								 			<div id="shape_2_options">
								 				<!-- Width -->
												<label for="se_width" class="title-normal mt-3"><?php echo esc_html__( 'Width:', 'wpcustom-cursors' );?></label>

												<div class="d-flex align-items-center mt-2">
													<input type="range" data-apply="el_2" data-variable="width" data-unit="px" class="form-range me-2" min="1" max="300" id="se_width_range" value="<?php echo $se_width_value; ?>">
													<input type="number" data-apply="el_2" data-variable="width" data-unit="px" min="1" max="300" id="se_width" class="number-input" value="<?php echo $se_width_value; ?>" data-name="se_width">
													<span class="ms-2 small"><?php echo esc_html__( 'PX', 'wpcustom-cursors' );?></span>
												</div>

												<!-- Height -->
												<label for="se_height" class="title-normal mt-3"><?php echo esc_html__( 'Height:', 'wpcustom-cursors' );?></label>

												<div class="d-flex align-items-center mt-2">
													<input type="range" data-apply="el_2" data-variable="height" data-unit="px" class="form-range me-2" min="1" max="300" id="se_height_range" value="<?php echo $se_height_value; ?>">
													<input type="number" data-apply="el_2" data-variable="height" data-unit="px" min="1" max="300" id="se_height" class="number-input" value="<?php echo $se_height_value; ?>" data-name="se_height">
													<span class="ms-2 small"><?php echo esc_html__( 'PX', 'wpcustom-cursors' );?></span>
												</div>

												<!-- Color -->
												<div class="title-normal mt-3">
													<?php echo esc_html__('Color:', 'wpcustom-cursors'); ?>
												</div>
												<div class="color_select form-group mt-2">
												    <label class="w-100">
												    	<input type='text' class="form-control basic wp-custom-cursor-color-picker" data-apply="el_2" data-variable="color" id="se_color" value="<?php echo $se_color_value; ?>" data-name="se_color">
												    </label>
												</div>

												<!-- Border -->
												<label for="se_border" class="title-normal mt-3"><?php echo esc_html__( 'Border Width:', 'wpcustom-cursors' );?></label>

												<div class="d-flex align-items-center mt-2">
													<input type="range" data-apply="el_2" data-variable="border" data-unit="px" class="form-range me-2" min="0" max="100" id="se_border_range" value="<?php echo $se_border_value; ?>">
													<input type="number" data-apply="el_2" data-variable="border" data-unit="px" min="0" max="100" id="se_border" class="number-input" value="<?php echo $se_border_value; ?>" data-name="se_border_width">
													<span class="ms-2 small"><?php echo esc_html__( 'PX', 'wpcustom-cursors' );?></span>
												</div>

												<!-- Radius -->
												<label for="se_radius" class="title-normal mt-3"><?php echo esc_html__( 'Border Radius:', 'wpcustom-cursors' );?></label>

												<div class="d-flex align-items-center mt-2">
													<input type="range" data-apply="el_2" data-variable="radius" data-unit="px" class="form-range me-2" min="0" max="1000" id="se_radius_range" value="<?php echo $se_radius_value; ?>">
													<input type="number" data-apply="el_2" data-variable="radius" data-unit="px" min="0" max="1000" id="se_radius" class="number-input" value="<?php echo $se_radius_value; ?>" data-name="se_radius">
													<span class="ms-2 small"><?php echo esc_html__( 'PX', 'wpcustom-cursors' );?></span>
												</div>

												<!-- Border Color -->
												<div class="title-normal mt-3">
													<?php echo esc_html__('Border Color:', 'wpcustom-cursors'); ?>
												</div>
												<div class="color_select form-group mt-2">
												    <label class="w-100">
												    	<input type='text' class="form-control basic wp-custom-cursor-color-picker" data-apply="el_2" data-variable="border-color" id="se_border_color" value="<?php echo $se_border_color_value; ?>" data-name="se_border_color">
												    </label>
												</div>

												<!-- Transition Duration -->
												<label for="se_duration" class="title-normal mt-3"><?php echo esc_html__( 'Transition Duration:', 'wpcustom-cursors' );?></label>

												<div class="d-flex align-items-center mt-2">
													<input type="range" data-apply="el_2" data-variable="duration" data-unit="ms" class="form-range me-2" min="0" max="1000" id="se_duration_range" value="<?php echo $se_duration_value; ?>">
													<input type="number" data-apply="el_2" data-variable="duration" data-unit="ms" min="0" max="1000" id="se_duration" class="number-input" value="<?php echo $se_duration_value; ?>" data-name="se_duration">
													<span class="ms-2 small"><?php echo esc_html__( 'MS', 'wpcustom-cursors' );?></span>
												</div>

												<!-- Transition Timing Function -->
												<div class="form-group">
													<label for="se_timing" class="title-normal mt-3"><?php echo esc_html__('Transition Timing Function:', 'wpcustom-cursors'); ?></label>
													<select class="form-control mt-2" id="se_timing" data-apply="el_2" data-variable="timing" data-name="se_timing">
														<option value="ease" <?php if (isset($se_timing_value)) {selected( $se_timing_value, 'ease' );} ?>><?php _e('Ease', 'wpcustom-cursors'); ?></option>
														<option value="ease-in" <?php if (isset($se_timing_value)) {selected( $se_timing_value, 'ease-in' );} ?>><?php _e('Ease In', 'wpcustom-cursors'); ?></option>
														<option value="ease-out" <?php if (isset($se_timing_value)) {selected( $se_timing_value, 'ease-out' );} ?>><?php _e('Ease Out', 'wpcustom-cursors'); ?></option>
														<option value="ease-in-out" <?php if (isset($se_timing_value)) {selected( $se_timing_value, 'ease-in-out' );} ?>><?php _e('Ease In Out', 'wpcustom-cursors'); ?></option>
														<option value="linear" <?php if (isset($se_timing_value)) {selected( $se_timing_value, 'linear' );} ?>><?php _e('Linear', 'wpcustom-cursors'); ?></option>
													</select>
												</div>

												<!-- Blending Mode -->
												<div class="form-group">
													<label for="se_blending" class="title-normal mt-3"><?php echo esc_html__('Blending Mode:', 'wpcustom-cursors'); ?></label>
													<select class="form-control mt-2" id="se_blending" data-apply="el_2" data-variable="blending" data-name="se_blending">
														<option value="normal" <?php if (isset($se_blending_value)) {selected( $se_blending_value, 'normal' );} ?>><?php _e('Normal', 'wpcustom-cursors'); ?></option>
														<option value="multiply" <?php if (isset($se_blending_value)) {selected( $se_blending_value, 'multiply' );} ?>><?php _e('Multiply', 'wpcustom-cursors'); ?></option>
														<option value="screen" <?php if (isset($se_blending_value)) {selected( $se_blending_value, 'screen' );} ?>><?php _e('Screen', 'wpcustom-cursors'); ?></option>
														<option value="overlay" <?php if (isset($se_blending_value)) {selected( $se_blending_value, 'overlay' );} ?>><?php _e('Overlay', 'wpcustom-cursors'); ?></option>
														<option value="darken" <?php if (isset($se_blending_value)) {selected( $se_blending_value, 'darken' );} ?>><?php _e('Darken', 'wpcustom-cursors'); ?></option>
														<option value="lighten" <?php if (isset($se_blending_value)) {selected( $se_blending_value, 'lighten' );} ?>><?php _e('Lighten', 'wpcustom-cursors'); ?></option>
														<option value="color-dodge" <?php if (isset($se_blending_value)) {selected( $se_blending_value, 'color-dodge' );} ?>><?php _e('Color Dodge', 'wpcustom-cursors'); ?></option>
														<option value="color-burn" <?php if (isset($se_blending_value)) {selected( $se_blending_value, 'color-burn' );} ?>><?php _e('Color Burn', 'wpcustom-cursors'); ?></option>
														<option value="hard-light" <?php if (isset($se_blending_value)) {selected( $se_blending_value, 'hard-light' );} ?>><?php _e('Hard Light', 'wpcustom-cursors'); ?></option>
														<option value="soft-light" <?php if (isset($se_blending_value)) {selected( $se_blending_value, 'soft-light' );} ?>><?php _e('Soft Light', 'wpcustom-cursors'); ?></option>
														<option value="difference" <?php if (isset($se_blending_value)) {selected( $se_blending_value, 'difference' );} ?>><?php _e('Difference', 'wpcustom-cursors'); ?></option>
														<option value="exclusion" <?php if (isset($se_blending_value)) {selected( $se_blending_value, 'exclusion' );} ?>><?php _e('Exclusion', 'wpcustom-cursors'); ?></option>
														<option value="hue" <?php if (isset($se_blending_value)) {selected( $se_blending_value, 'hue' );} ?>><?php _e('Hue', 'wpcustom-cursors'); ?></option>
														<option value="saturation" <?php if (isset($se_blending_value)) {selected( $se_blending_value, 'saturation' );} ?>><?php _e('Saturation', 'wpcustom-cursors'); ?></option>
														<option value="color" <?php if (isset($se_blending_value)) {selected( $se_blending_value, 'color' );} ?>><?php _e('Color', 'wpcustom-cursors'); ?></option>
														<option value="luminosity" <?php if (isset($se_blending_value)) {selected( $se_blending_value, 'luminosity' );} ?>><?php _e('Luminosity', 'wpcustom-cursors'); ?></option>
													</select>
												</div>

												<!-- Z-index -->
												<label for="se_zindex" class="title-normal mt-3"><?php echo esc_html__( 'Z-index:', 'wpcustom-cursors' );?></label>

												<div class="d-flex align-items-center mt-2">
													<input type="range" data-apply="el_2" data-variable="zindex" class="form-range me-2" min="100" max="1000000" id="se_zindex_range" value="<?php echo $se_zindex_value; ?>">
													<input type="number" data-apply="el_2" data-variable="zindex" min="100" max="1000000" id="se_zindex" class="number-input" value="<?php echo $se_zindex_value; ?>" data-name="se_zindex">
												</div>

												<!-- Backdrop Filter -->
												<div class="form-group">
													<label for="se_backdrop" class="title-normal mt-3"><?php echo esc_html__('Backdrop Filter:', 'wpcustom-cursors'); ?></label>
													<select class="form-control mt-2" id="se_backdrop" data-apply="el_2" data-variable="backdrop" data-name="se_backdrop">
														<option value="none" <?php if (isset($se_backdrop_value)) {selected( $se_backdrop_value, 'none' );} ?>><?php _e('None', 'wpcustom-cursors'); ?></option>
														<option value="blur" <?php if (isset($se_backdrop_value)) {selected( $se_backdrop_value, 'blur' );} ?>><?php _e('Blur', 'wpcustom-cursors'); ?></option>
														<option value="brightness" <?php if (isset($se_backdrop_value)) {selected( $se_backdrop_value, 'brightness' );} ?>><?php _e('Brightness', 'wpcustom-cursors'); ?></option>
														<option value="contrast" <?php if (isset($se_backdrop_value)) {selected( $se_backdrop_value, 'contrast' );} ?>><?php _e('Contrast', 'wpcustom-cursors'); ?></option>
														<option value="drop-shadow" <?php if (isset($se_backdrop_value)) {selected( $se_backdrop_value, 'drop-shadow' );} ?>><?php _e('Drop Shadow', 'wpcustom-cursors'); ?></option>
														<option value="grayscale" <?php if (isset($se_backdrop_value)) {selected( $se_backdrop_value, 'grayscale' );} ?>><?php _e('Grayscale', 'wpcustom-cursors'); ?></option>
														<option value="hue-rotate" <?php if (isset($se_backdrop_value)) {selected( $se_backdrop_value, 'hue-rotate' );} ?>><?php _e('Hue Rotate', 'wpcustom-cursors'); ?></option>
														<option value="invert" <?php if (isset($se_backdrop_value)) {selected( $se_backdrop_value, 'invert' );} ?>><?php _e('Invert', 'wpcustom-cursors'); ?></option>
														<option value="opacity" <?php if (isset($se_backdrop_value)) {selected( $se_backdrop_value, 'opacity' );} ?>><?php _e('Opacity', 'wpcustom-cursors'); ?></option>
														<option value="sepia" <?php if (isset($se_backdrop_value)) {selected( $se_backdrop_value, 'sepia' );} ?>><?php _e('Sepia', 'wpcustom-cursors'); ?></option>
														<option value="saturate" <?php if (isset($se_backdrop_value)) {selected( $se_backdrop_value, 'saturate' );} ?>><?php _e('Saturate', 'wpcustom-cursors'); ?></option>
														<option value="revert" <?php if (isset($se_backdrop_value)) {selected( $se_backdrop_value, 'revert' );} ?>><?php _e('Revert', 'wpcustom-cursors'); ?></option>
													</select>
												</div>

												<!-- Backdrop Filter Value -->
												<div class="form-floating mt-3">
													<input type="text" class="form-control" id="se_backdrop_amount" placeholder="<?php echo esc_html__( 'e.g. 2px', 'wpcustom-cursors' );?>" value="<?php echo $se_backdrop_amount_value; ?>" data-name="se_backdrop_value">
													<label for="se_backdrop_amount"><?php echo esc_html__( 'Value with unit e.g. 2px', 'wpcustom-cursors' );?></label>
												</div>
								 			</div>
			 							</div>
			 						</div>
			 					</div>
			 				</div>





				 			

				 			
			 			</div>

			 			<!-- Image Cursor Options - Normal -->
			 			<div id="image_options" style="<?php if($cursor_type_value != 'image') { echo 'display: none;'; }?>">

					    	<!-- Uploaded Image URL Input -->
							<input type="hidden" id="image_url_input" class="image-url-input" value="<?php echo $image_url_value ?>" data-name="image_url">

							<!-- Click Point Inputs -->
							<input type="hidden" id="click_point_input" data-name="click_point" value="<?php echo $click_point_value ?>">

			 				<!-- Image Width -->
							<label for="image_width" class="title-normal"><?php echo esc_html__( 'Width:', 'wpcustom-cursors' );?></label>

							<div class="d-flex align-items-center mt-2">
								<input type="range" data-apply="uploaded_image_wrapper" data-variable="image-width" data-unit="px" class="form-range me-2" min="10" max="500" id="image_width_range" value="<?php echo $image_width_value; ?>">
								<input type="number" data-apply="uploaded_image_wrapper" data-variable="image-width" data-unit="px" min="10" max="500" id="image_width" class="number-input" value="<?php echo $image_width_value; ?>" data-name="width">
								<span class="ms-2 small"><?php echo esc_html__( 'PX', 'wpcustom-cursors' );?></span>
								<input type="hidden" data-name="height" value="<?php echo $image_height_value; ?>" id="image_height" data-variable="image-height" data-unit="px">
							</div>

							<!-- Background -->
							<label class="toggler-wrapper mt-3 style-4"> 
								<span class="toggler-label"><?php echo esc_html__( 'Background', 'wpcustom-cursors' );?></span>
								<input type="checkbox" id="image_background" value="<?php echo $image_background_value; ?>" <?php checked( $image_background_value, 'on' ); ?> data-name="background">
								<div class="toggler-slider">
									<div class="toggler-knob"></div>
								</div>
							</label>

							<div class="image-bg-options border p-4 rounded-3 mt-3 <?php if($image_background_value == 'off') {echo 'visually-hidden';} ?>">
								<!-- Background Color -->
								<div class="title-normal mt-3">
									<?php echo esc_html__('Background Color:', 'wpcustom-cursors'); ?>
								</div>
								<div class="color_select form-group mt-2">
								    <label class="w-100">
								    	<input type='text' data-apply="uploaded_image_wrapper" data-variable="image-background-color" class="form-control basic wp-custom-cursor-color-picker" id="image_background_color" value="<?php echo $image_background_color_value; ?>" data-name="color">
								    </label>
								</div>

								<!-- Radius -->
								<label for="image_background_radius" class="title-normal mt-3"><?php echo esc_html__( 'Radius:', 'wpcustom-cursors' );?></label>

								<div class="d-flex align-items-center mt-2">
									<input type="range" data-apply="uploaded_image_wrapper" data-variable="image-background-radius" data-unit="px" class="form-range me-2" min="0" max="500" id="image_background_radius_range" value="<?php echo $image_background_radius_value; ?>">
									<input type="number" data-apply="uploaded_image_wrapper" data-variable="image-background-radius" data-unit="px" min="0" max="500" id="image_background_radius" class="number-input" value="<?php echo $image_background_radius_value; ?>" data-name="radius">
									<span class="ms-2 small"><?php echo esc_html__( 'PX', 'wpcustom-cursors' );?></span>
								</div>

								<!-- Padding -->
								<label for="image_background_padding" class="title-normal mt-3"><?php echo esc_html__( 'Padding:', 'wpcustom-cursors' );?></label>

								<div class="d-flex align-items-center mt-2">
									<input type="range" data-apply="uploaded_image_wrapper" data-variable="image-background-padding" data-unit="px" class="form-range me-2" min="0" max="100" id="image_background_padding_range" value="<?php echo $image_background_padding_value; ?>">
									<input type="number" data-apply="uploaded_image_wrapper" data-variable="image-background-padding" data-unit="px" min="0" max="100" id="image_background_padding" class="number-input" value="<?php echo $image_background_padding_value; ?>" data-name="padding">
									<span class="ms-2 small"><?php echo esc_html__( 'PX', 'wpcustom-cursors' );?></span>
								</div>
							</div>

							<!-- Image Blending Mode -->
							<div class="form-group">
								<label for="image_blending" class="title-normal mt-3"><?php echo esc_html__('Blending Mode:', 'wpcustom-cursors'); ?></label>
								<select class="form-control mt-2" id="image_blending" data-apply="uploaded_image_wrapper" data-variable="image-background-blending" data-name="blending">
									<option value="normal" <?php if (isset($image_blending_value)) {selected( $image_blending_value, 'normal' );} ?>><?php _e('Normal', 'wpcustom-cursors'); ?></option>
									<option value="multiply" <?php if (isset($image_blending_value)) {selected( $image_blending_value, 'multiply' );} ?>><?php _e('Multiply', 'wpcustom-cursors'); ?></option>
									<option value="screen" <?php if (isset($image_blending_value)) {selected( $image_blending_value, 'screen' );} ?>><?php _e('Screen', 'wpcustom-cursors'); ?></option>
									<option value="overlay" <?php if (isset($image_blending_value)) {selected( $image_blending_value, 'overlay' );} ?>><?php _e('Overlay', 'wpcustom-cursors'); ?></option>
									<option value="darken" <?php if (isset($image_blending_value)) {selected( $image_blending_value, 'darken' );} ?>><?php _e('Darken', 'wpcustom-cursors'); ?></option>
									<option value="lighten" <?php if (isset($image_blending_value)) {selected( $image_blending_value, 'lighten' );} ?>><?php _e('Lighten', 'wpcustom-cursors'); ?></option>
									<option value="color-dodge" <?php if (isset($image_blending_value)) {selected( $image_blending_value, 'color-dodge' );} ?>><?php _e('Color Dodge', 'wpcustom-cursors'); ?></option>
									<option value="color-burn" <?php if (isset($image_blending_value)) {selected( $image_blending_value, 'color-burn' );} ?>><?php _e('Color Burn', 'wpcustom-cursors'); ?></option>
									<option value="hard-light" <?php if (isset($image_blending_value)) {selected( $image_blending_value, 'hard-light' );} ?>><?php _e('Hard Light', 'wpcustom-cursors'); ?></option>
									<option value="soft-light" <?php if (isset($image_blending_value)) {selected( $image_blending_value, 'soft-light' );} ?>><?php _e('Soft Light', 'wpcustom-cursors'); ?></option>
									<option value="difference" <?php if (isset($image_blending_value)) {selected( $image_blending_value, 'difference' );} ?>><?php _e('Difference', 'wpcustom-cursors'); ?></option>
									<option value="exclusion" <?php if (isset($image_blending_value)) {selected( $image_blending_value, 'exclusion' );} ?>><?php _e('Exclusion', 'wpcustom-cursors'); ?></option>
									<option value="hue" <?php if (isset($image_blending_value)) {selected( $image_blending_value, 'hue' );} ?>><?php _e('Hue', 'wpcustom-cursors'); ?></option>
									<option value="saturation" <?php if (isset($image_blending_value)) {selected( $image_blending_value, 'saturation' );} ?>><?php _e('Saturation', 'wpcustom-cursors'); ?></option>
									<option value="color" <?php if (isset($image_blending_value)) {selected( $image_blending_value, 'color' );} ?>><?php _e('Color', 'wpcustom-cursors'); ?></option>
									<option value="luminosity" <?php if (isset($image_blending_value)) {selected( $image_blending_value, 'luminosity' );} ?>><?php _e('Luminosity', 'wpcustom-cursors'); ?></option>
								</select>
							</div>
			 			</div>

			 			<!-- Text Cursor Options - Normal -->
			 			<div id="text_options" style="<?php if($cursor_type_value != 'text' || $text_type_value != 'text') { echo 'display: none;'; }?>">

					    	<!-- Text Type Dropdown -->
							<div class="form-group mb-3">
								<label for="text_type" class="title-normal"><?php echo esc_html__('Text Type:', 'wpcustom-cursors'); ?></label>
								<select class="form-control mt-2" id="text_type" data-name='text_type' data-select="hr_text_type">
									<option value="text" <?php if (isset($text_type_value)) {selected( $text_type_value, 'text' );} ?>><?php _e('Circular', 'wpcustom-cursors'); ?></option>
									<option value="horizontal" <?php if (isset($text_type_value)) {selected( $text_type_value, 'horizontal' );} ?>><?php _e('Horizontal', 'wpcustom-cursors'); ?></option>
								</select>
							</div>

							<!-- Text Content -->
			 				<label for="cursor_text_input" class="form-label"><?php echo esc_html__('Text for the cursor', 'wpcustom-cursors'); ?></label>
							<input type="text" data-apply="textpath" value="<?php echo $cursor_text_value; ?>" class="form-control" placeholder="<?php echo esc_html__('Enter Text', 'wpcustom-cursors'); ?>" aria-label="<?php echo esc_html__('Text Cursor', 'wpcustom-cursors'); ?>" id="cursor_text_input" data-name="text">

							<!-- Dot -->
							<label class="toggler-wrapper mt-3 style-4"> 
								<span class="toggler-label"><?php echo esc_html__( 'Show Dot', 'wpcustom-cursors' );?></span>
								<input type="checkbox" id="show_dot" data-apply="svg_node" value="on" <?php checked( $show_dot_value, 'on' ); ?> data-name="dot">
								<div class="toggler-slider">
									<div class="toggler-knob"></div>
								</div>
							</label>

							<div class="border p-4 rounded-3 mt-3" id="dot_options">
								<!-- Dot Width -->
								<label for="dot_width" class="title-normal mt-3"><?php echo esc_html__( 'Dot Width:', 'wpcustom-cursors' );?></label>

								<div class="d-flex align-items-center mt-2">
									<input type="range" data-apply="svg_circle_node" data-variable="dot-width" data-unit="px" class="form-range me-2" min="10" max="200" id="dot_width_range" value="<?php echo $dot_width_value; ?>">
									<input type="number" data-apply="svg_circle_node" data-variable="dot-width" data-unit="px" min="10" max="200" id="dot_width" class="number-input" value="<?php echo $dot_width_value; ?>" data-name="dot_width">
									<span class="ms-2 small"><?php echo esc_html__( 'PX', 'wpcustom-cursors' );?></span>
								</div>

								<!-- Dot Color -->
								<div class="title-normal mt-3">
									<?php echo esc_html__('Dot Color:', 'wpcustom-cursors'); ?>
								</div>
								<div class="color_select form-group mt-2">
								    <label class="w-100">
								    	<input type='text' class="form-control basic wp-custom-cursor-color-picker" data-apply="svg_node" data-variable="dot-fill" id="dot_color" value="<?php echo $dot_color_value; ?>" data-name="dot_color">
								    </label>
								</div>
							</div>

							<!-- Width -->
							<label for="text_width" class="title-normal mt-3"><?php echo esc_html__( 'Width:', 'wpcustom-cursors' );?></label>

							<div class="d-flex align-items-center mt-2">
								<input type="range" data-apply="svg_node" data-variable="text-width" data-unit="px" class="form-range me-2" min="50" max="500" id="text_width_range" value="<?php echo $text_width_value; ?>">
								<input type="number" data-apply="svg_node" data-variable="text-width" data-unit="px" min="50" max="500" id="text_width" class="number-input" value="<?php echo $text_width_value; ?>" data-name="width">
								<span class="ms-2 small"><?php echo esc_html__( 'PX', 'wpcustom-cursors' );?></span>
							</div>

							<!-- Text Transform -->
							<div class="form-group">
								<label for="text_transform" class="title-normal mt-3"><?php echo esc_html__('Text Transform:', 'wpcustom-cursors'); ?></label>
								<select class="form-control mt-2" id="text_transform" data-apply="svg_node" data-variable="text-transform" data-name="text_transform">
									<option value="uppercase" <?php if (isset($text_transform_value)) {selected( $text_transform_value, 'uppercase' );} ?>><?php _e('Uppercase', 'wpcustom-cursors'); ?></option>
									<option value="lowercase" <?php if (isset($text_transform_value)) {selected( $text_transform_value, 'lowercase' );} ?>><?php _e('Lowercase', 'wpcustom-cursors'); ?></option>
									<option value="capitalize" <?php if (isset($text_transform_value)) {selected( $text_transform_value, 'capitalize' );} ?>><?php _e('Capitalize', 'wpcustom-cursors'); ?></option>
								</select>
							</div>

							<!-- Font Weight -->
							<div class="form-group">
								<label for="font_weight" class="title-normal mt-3"><?php echo esc_html__('Font Weight:', 'wpcustom-cursors'); ?></label>
								<select class="form-control mt-2" id="font_weight" data-apply="svg_node" data-variable="font-weight" data-name="font_weight">
									<option value="normal" <?php if (isset($font_weight_value)) {selected( $font_weight_value, 'normal' );} ?>><?php _e('Normal', 'wpcustom-cursors'); ?></option>
									<option value="bold" <?php if (isset($font_weight_value)) {selected( $font_weight_value, 'bold' );} ?>><?php _e('Bold', 'wpcustom-cursors'); ?></option>
								</select>
							</div>

							<!-- Text Color -->
							<div class="title-normal mt-3">
								<?php echo esc_html__('Text Color:', 'wpcustom-cursors'); ?>
							</div>
							<div class="color_select form-group mt-2">
							    <label class="w-100">
							    	<input type='text' class="form-control basic wp-custom-cursor-color-picker" data-apply="svg_node" data-variable="text-color" id="text_color" value="<?php echo $text_color_value; ?>" data-name="text_color">
							    </label>
							</div>

							<!-- Font Size -->
							<label for="font_size" class="title-normal mt-3"><?php echo esc_html__( 'Font Size:', 'wpcustom-cursors' );?></label>

							<div class="d-flex align-items-center mt-2">
								<input type="range" data-apply="svg_node" data-variable="font-size" data-unit="px" class="form-range me-2" min="10" max="200" id="font_size_range" value="<?php echo $font_size_value; ?>">
								<input type="number" data-apply="svg_node" data-variable="font-size" data-unit="px" min="10" max="200" id="font_size" class="number-input" value="<?php echo $font_size_value; ?>" data-name="font_size">
								<span class="ms-2 small"><?php echo esc_html__( 'PX', 'wpcustom-cursors' );?></span>
							</div>

							<!-- Word Spacing -->
							<label for="word_spacing" class="title-normal mt-3"><?php echo esc_html__( 'Word Spacing:', 'wpcustom-cursors' );?></label>

							<div class="d-flex align-items-center mt-2">
								<input type="range" data-apply="svg_node" data-variable="word-spacing" data-unit="px" class="form-range me-2" min="1" max="200" id="word_spacing_range" value="<?php echo $word_spacing_value; ?>">
								<input type="number" data-apply="svg_node" data-variable="word-spacing" data-unit="px" min="1" max="200" id="word_spacing" class="number-input" value="<?php echo $word_spacing_value; ?>" data-name="word_spacing">
								<span class="ms-2 small"><?php echo esc_html__( 'PX', 'wpcustom-cursors' );?></span>
							</div>

							<!-- Animation -->
							<div class="form-group">
								<label for="text_animation" class="title-normal mt-3"><?php echo esc_html__('Text Animation:', 'wpcustom-cursors'); ?></label>
								<select class="form-control mt-2" id="text_animation" data-apply="svg_node" data-variable="animation-name" data-name="animation">
									<option value="none" <?php if (isset($text_animation_value)) {selected( $text_animation_value, 'none' );} ?>><?php _e('None', 'wpcustom-cursors'); ?></option>
									<option value="spinright" <?php if (isset($text_animation_value)) {selected( $text_animation_value, 'spinright' );} ?>><?php _e('Spin Right', 'wpcustom-cursors'); ?></option>
									<option value="spinleft" <?php if (isset($text_animation_value)) {selected( $text_animation_value, 'spinleft' );} ?>><?php _e('Spin Left', 'wpcustom-cursors'); ?></option>
								</select>
							</div>

							<!-- Text Animation Duration -->
							<label for="text_animation_duration" class="title-normal mt-3"><?php echo esc_html__( 'Text Animation Duration:', 'wpcustom-cursors' );?></label>

							<div class="d-flex align-items-center mt-2">
								<input type="range" data-apply="svg_node" data-variable="animation-duration" data-unit="s" class="form-range me-2" min="0" max="100" id="text_animation_duration_range" value="<?php echo $text_animation_duration_value; ?>">
								<input type="number" data-apply="svg_node" data-variable="animation-duration" data-unit="s" min="0" max="100" id="text_animation_duration" class="number-input" value="<?php echo $text_animation_duration_value; ?>" data-name="animation_duration">
								<span class="ms-2 small"><?php echo esc_html__( 'S', 'wpcustom-cursors' );?></span>
							</div>
			 			</div>

			 			<!-- Horizontal Text Options -->
						<div id="horizontal_options" style="<?php if($cursor_type_value != 'text' || $text_type_value != 'horizontal') { echo 'display: none;'; }?>">

							<!-- Text Type Dropdown -->
							<div class="form-group mb-3">
								<label for="hr_text_type" class="title-normal"><?php echo esc_html__('Text Type:', 'wpcustom-cursors'); ?></label>
								<select class="form-control mt-2" id="hr_text_type" data-name='text_type' data-select="text_type">
									<option value="text" <?php if (isset($text_type_value)) {selected( $text_type_value, 'text' );} ?>><?php _e('Circular', 'wpcustom-cursors'); ?></option>
									<option value="horizontal" <?php if (isset($text_type_value)) {selected( $text_type_value, 'horizontal' );} ?>><?php _e('Horizontal', 'wpcustom-cursors'); ?></option>
								</select>
							</div>

							<!-- Text Content -->
			 				<label for="hr_text_input" class="form-label"><?php echo esc_html__('Text for the cursor', 'wpcustom-cursors'); ?></label>
							<input type="text" data-apply="hr_text_container" value="<?php echo $hr_text_value; ?>" class="form-control" placeholder="<?php echo esc_html__('Enter Text', 'wpcustom-cursors'); ?>" aria-label="<?php echo esc_html__('Text Cursor', 'wpcustom-cursors'); ?>" id="hr_text_input" data-name="hr_text">

							<!-- Background Color -->
							<div class="title-normal mt-3">
								<?php echo esc_html__('Background Color:', 'wpcustom-cursors'); ?>
							</div>
							<div class="color_select form-group mt-2">
							    <label class="w-100">
							    	<input type='text' data-apply="hr_text_container" data-variable="bg-color" class="form-control basic wp-custom-cursor-color-picker" id="hr_background_color" value="<?php echo $hr_background_value; ?>" data-name="hr_bgcolor">
							    </label>
							</div>

							<!-- Radius -->
							<label for="hr_radius" class="title-normal mt-3"><?php echo esc_html__( 'Radius:', 'wpcustom-cursors' );?></label>

							<div class="d-flex align-items-center mt-2">
								<input type="range" data-apply="hr_text_container" data-variable="hr-radius" data-unit="px" class="form-range me-2" min="0" max="500" id="hr_radius_range" value="<?php echo $hr_radius_value; ?>">
								<input type="number" data-apply="hr_text_container" data-variable="hr-radius" data-unit="px" min="0" max="500" id="hr_radius" class="number-input" value="<?php echo $hr_radius_value; ?>" data-name="hr_radius">
								<span class="ms-2 small"><?php echo esc_html__( 'PX', 'wpcustom-cursors' );?></span>
							</div>

							<!-- Padding -->
							<label for="hr_padding" class="title-normal mt-3"><?php echo esc_html__( 'Padding:', 'wpcustom-cursors' );?></label>

							<div class="d-flex align-items-center mt-2">
								<input type="range" data-apply="hr_text_container" data-variable="hr-padding" data-unit="px" class="form-range me-2" min="0" max="100" id="hr_padding_range" value="<?php echo $hr_padding_value; ?>">
								<input type="number" data-apply="hr_text_container" data-variable="hr-padding" data-unit="px" min="0" max="100" id="hr_padding" class="number-input" value="<?php echo $hr_padding_value; ?>" data-name="hr_padding">
								<span class="ms-2 small"><?php echo esc_html__( 'PX', 'wpcustom-cursors' );?></span>
							</div>

							<!-- Width -->
							<label for="hr_width" class="title-normal mt-3"><?php echo esc_html__( 'Width:', 'wpcustom-cursors' );?></label>

							<div class="d-flex align-items-center mt-2">
								<input type="range" data-apply="hr_text_container" data-variable="hr-width" data-unit="px" class="form-range me-2" min="50" max="500" id="hr_width_range" value="<?php echo $hr_width_value; ?>">
								<input type="number" data-apply="hr_text_container" data-variable="hr-width" data-unit="px" min="50" max="500" id="hr_width" class="number-input" value="<?php echo $hr_width_value; ?>" data-name="hr_width">
								<span class="ms-2 small"><?php echo esc_html__( 'PX', 'wpcustom-cursors' );?></span>
							</div>

							<!-- Text Transform -->
							<div class="form-group">
								<label for="hr_transform" class="title-normal mt-3"><?php echo esc_html__('Text Transform:', 'wpcustom-cursors'); ?></label>
								<select class="form-control mt-2" id="hr_transform" data-apply="hr_text_container" data-variable="hr-transform" data-name="hr_transform">
									<option value="uppercase" <?php if (isset($hr_transform_value)) {selected( $hr_transform_value, 'uppercase' );} ?>><?php _e('Uppercase', 'wpcustom-cursors'); ?></option>
									<option value="lowercase" <?php if (isset($hr_transform_value)) {selected( $hr_transform_value, 'lowercase' );} ?>><?php _e('Lowercase', 'wpcustom-cursors'); ?></option>
									<option value="capitalize" <?php if (isset($hr_transform_value)) {selected( $hr_transform_value, 'capitalize' );} ?>><?php _e('Capitalize', 'wpcustom-cursors'); ?></option>
								</select>
							</div>

							<!-- Font Weight -->
							<div class="form-group">
								<label for="hr_weight" class="title-normal mt-3"><?php echo esc_html__('Font Weight:', 'wpcustom-cursors'); ?></label>
								<select class="form-control mt-2" id="hr_weight" data-apply="hr_text_container" data-variable="hr-weight" data-name="hr_weight">
									<option value="normal" <?php if (isset($hr_weight_value)) {selected( $hr_weight_value, 'normal' );} ?>><?php _e('Normal', 'wpcustom-cursors'); ?></option>
									<option value="bold" <?php if (isset($hr_weight_value)) {selected( $hr_weight_value, 'bold' );} ?>><?php _e('Bold', 'wpcustom-cursors'); ?></option>
								</select>
							</div>

							<!-- Text Color -->
							<div class="title-normal mt-3">
								<?php echo esc_html__('Text Color:', 'wpcustom-cursors'); ?>
							</div>
							<div class="color_select form-group mt-2">
							    <label class="w-100">
							    	<input type='text' class="form-control basic wp-custom-cursor-color-picker" data-apply="hr_text_container" data-variable="hr-color" id="hr_color" value="<?php echo $hr_color_value; ?>" data-name="hr_color">
							    </label>
							</div>

							<!-- Font Size -->
							<label for="hr_size" class="title-normal mt-3"><?php echo esc_html__( 'Font Size:', 'wpcustom-cursors' );?></label>

							<div class="d-flex align-items-center mt-2">
								<input type="range" data-apply="hr_text_container" data-variable="hr-size" data-unit="px" class="form-range me-2" min="10" max="200" id="hr_size_range" value="<?php echo $hr_size_value; ?>">
								<input type="number" data-apply="hr_text_container" data-variable="hr-size" data-unit="px" min="10" max="200" id="hr_size" class="number-input" value="<?php echo $hr_size_value; ?>" data-name="hr_size">
								<span class="ms-2 small"><?php echo esc_html__( 'PX', 'wpcustom-cursors' );?></span>
							</div>

							<!-- Word Spacing -->
							<label for="hr_spacing" class="title-normal mt-3"><?php echo esc_html__( 'Word Spacing:', 'wpcustom-cursors' );?></label>

							<div class="d-flex align-items-center mt-2">
								<input type="range" data-apply="hr_text_container" data-variable="hr-spacing" data-unit="px" class="form-range me-2" min="1" max="200" id="hr_spacing_range" value="<?php echo $hr_spacing_value; ?>">
								<input type="number" data-apply="hr_text_container" data-variable="hr-spacing" data-unit="px" min="1" max="200" id="hr_spacing" class="number-input" value="<?php echo $hr_spacing_value; ?>" data-name="hr_spacing">
								<span class="ms-2 small"><?php echo esc_html__( 'PX', 'wpcustom-cursors' );?></span>
							</div>

							<!-- Transition Duration -->
							<label for="hr_duration" class="title-normal mt-3"><?php echo esc_html__( 'Transition Duration:', 'wpcustom-cursors' );?></label>

							<div class="d-flex align-items-center mt-2">
								<input type="range" data-apply="hr_text_container" data-variable="hr_duration" data-unit="ms" class="form-range me-2" min="0" max="1000" id="hr_duration_range" value="<?php echo $hr_duration_value; ?>">
								<input type="number" data-apply="hr_text_container" data-variable="hr_duration" data-unit="ms" min="0" max="1000" id="hr_duration" class="number-input" value="<?php echo $hr_duration_value; ?>" data-name="hr_duration">
								<span class="ms-2 small"><?php echo esc_html__( 'MS', 'wpcustom-cursors' );?></span>
							</div>

							<!-- Transition Timing Function -->
							<div class="form-group">
								<label for="hr_timing" class="title-normal mt-3"><?php echo esc_html__('Transition Timing Function:', 'wpcustom-cursors'); ?></label>
								<select class="form-control mt-2" id="hr_timing" data-apply="hr_text_container" data-variable="hr_timing" data-name="hr_timing">
									<option value="ease" <?php if (isset($hr_timing_value)) {selected( $hr_timing_value, 'ease' );} ?>><?php _e('Ease', 'wpcustom-cursors'); ?></option>
									<option value="ease-in" <?php if (isset($hr_timing_value)) {selected( $hr_timing_value, 'ease-in' );} ?>><?php _e('Ease In', 'wpcustom-cursors'); ?></option>
									<option value="ease-out" <?php if (isset($hr_timing_value)) {selected( $hr_timing_value, 'ease-out' );} ?>><?php _e('Ease Out', 'wpcustom-cursors'); ?></option>
									<option value="ease-in-out" <?php if (isset($hr_timing_value)) {selected( $hr_timing_value, 'ease-in-out' );} ?>><?php _e('Ease In Out', 'wpcustom-cursors'); ?></option>
									<option value="linear" <?php if (isset($hr_timing_value)) {selected( $hr_timing_value, 'linear' );} ?>><?php _e('Linear', 'wpcustom-cursors'); ?></option>
								</select>
							</div>

					    	<!-- Horizontal Text Backdrop Filter -->
							<div class="form-group">
								<label for="hr_backdrop" class="title-normal mt-3"><?php echo esc_html__('Backdrop Filter:', 'wpcustom-cursors'); ?></label>
								<select class="form-control mt-2" id="hr_backdrop" data-name="hr_backdrop">
									<option value="none" <?php if (isset($hr_backdrop_value)) {selected( $hr_backdrop_value, 'none' );} ?>><?php _e('None', 'wpcustom-cursors'); ?></option>
									<option value="blur" <?php if (isset($hr_backdrop_value)) {selected( $hr_backdrop_value, 'blur' );} ?>><?php _e('Blur', 'wpcustom-cursors'); ?></option>
									<option value="brightness" <?php if (isset($hr_backdrop_value)) {selected( $hr_backdrop_value, 'brightness' );} ?>><?php _e('Brightness', 'wpcustom-cursors'); ?></option>
									<option value="contrast" <?php if (isset($hr_backdrop_value)) {selected( $hr_backdrop_value, 'contrast' );} ?>><?php _e('Contrast', 'wpcustom-cursors'); ?></option>
									<option value="drop-shadow" <?php if (isset($hr_backdrop_value)) {selected( $hr_backdrop_value, 'drop-shadow' );} ?>><?php _e('Drop Shadow', 'wpcustom-cursors'); ?></option>
									<option value="grayscale" <?php if (isset($hr_backdrop_value)) {selected( $hr_backdrop_value, 'grayscale' );} ?>><?php _e('Grayscale', 'wpcustom-cursors'); ?></option>
									<option value="hue-rotate" <?php if (isset($hr_backdrop_value)) {selected( $hr_backdrop_value, 'hue-rotate' );} ?>><?php _e('Hue Rotate', 'wpcustom-cursors'); ?></option>
									<option value="invert" <?php if (isset($hr_backdrop_value)) {selected( $hr_backdrop_value, 'invert' );} ?>><?php _e('Invert', 'wpcustom-cursors'); ?></option>
									<option value="opacity" <?php if (isset($hr_backdrop_value)) {selected( $hr_backdrop_value, 'opacity' );} ?>><?php _e('Opacity', 'wpcustom-cursors'); ?></option>
									<option value="sepia" <?php if (isset($hr_backdrop_value)) {selected( $hr_backdrop_value, 'sepia' );} ?>><?php _e('Sepia', 'wpcustom-cursors'); ?></option>
									<option value="saturate" <?php if (isset($hr_backdrop_value)) {selected( $hr_backdrop_value, 'saturate' );} ?>><?php _e('Saturate', 'wpcustom-cursors'); ?></option>
									<option value="revert" <?php if (isset($hr_backdrop_value)) {selected( $hr_backdrop_value, 'revert' );} ?>><?php _e('Revert', 'wpcustom-cursors'); ?></option>
								</select>
							</div>

							<!-- Backdrop Filter Value -->
							<div class="form-floating mt-3">
								<input type="text" class="form-control" id="hr_backdrop_amount" placeholder="<?php echo esc_html__( 'e.g. 2px', 'wpcustom-cursors' );?>" value="<?php echo $hr_backdrop_amount_value; ?>" data-name="hr_backdrop_amount">
								<label for="hr_backdrop_amount"><?php echo esc_html__( 'Value with unit e.g. 2px', 'wpcustom-cursors' );?></label>
							</div>
						</div>
			 		</div>
		 		</div>
		  	</div>
		  	<div class="card-footer text-muted">

		  		<!-- Input to store cursor data -->
				<input type="hidden" id="cursor_options" name="cursor_options" value="<?php echo $cursor_options_value ?>">

			    <?php  
					if(isset($_GET['edit_row'])) {
						?>
						<input type="hidden" name="update_id" value="<?php echo sanitize_text_field( $_GET['edit_row'] ); ?>">
						<input type="submit" name="update_created" class="btn btn-primary" value="<?php echo esc_html__( 'Update Cursor', 'wpcustom-cursors' ) ?>" />
						<?php
					}
					else {
						?>
						<input disabled name="create" class="btn btn-primary" value="<?php echo esc_html__( 'Save Cursor (Pro)', 'wpcustom-cursors' ) ?>" />
						<small><?php echo esc_html__( 'Please purchase the pro version from Codecanyon website.', 'wpcustom-cursors' );?></small>
						<?php
					}
				?>
			</div>
			<?php wp_nonce_field( 'wpcc_create_cursor', 'wpcc_create_nonce' ); ?>
		</form>
	</div>