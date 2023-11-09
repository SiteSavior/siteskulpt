<?php

/**
 * @link       https://codecanyon.net/user/web_trendy
 * @since      2.1.0
 * @package    Wp_custom_cursors
 * @subpackage Wp_custom_cursors/includes
 * @author     Web_Trendy <webtrendyio@gmail.com>
 */
?>

<!-- Header -->
<div class="wt-header bg-white rounded d-flex justify-content-between align-items-center">
	<div class="d-flex align-items-center">
		<div class="wt-logo mr-3">
			<img src="<?php echo esc_url( plugins_url( '../img/thumbnail.svg', __FILE__ ) ); ?>" alt="<?php echo esc_html__('WP Custom Cursors', 'wpcustom-cursors');?>" title="<?php echo esc_html__('WP Custom Cursors', 'wpcustom-cursors');?>" />
		</div>
		<div class="wt-header-title ms-3">
			<h2 class="h5 d-inline-block"><?php echo esc_html__( 'WP Custom Cursors ', 'wpcustom-cursors' ); ?> </h2>  <span class="badge rounded-pill bg-warning text-dark"><?php echo WP_CUSTOM_CURSORS_VERSION; ?></span>
			<p class="mb-0">
				<a href="<?php echo esc_url('https://codecanyon.net/user/web_trendy/portfolio')?>" class="text-muted text-decoration-none wt-link" target="_blank" title="<?php echo esc_html__('Web_Trendy Portfolio', 'wpcustom-cursors'); ?>"><i class="ri-links-fill"></i> <?php echo esc_html__( 'View Our Portfolio', 'wpcustom-cursors' );?>
				</a>
			</p>
		</div>
	</div>
	<div class="navigation d-flex align-items-center">
	<?php  
		$screen = get_current_screen();
		$page_id = $screen->id;
		switch ($page_id) {
			case 'toplevel_page_wp_custom_cursors':
				?>
				<a href="<?php menu_page_url('wpcc_add_new', true) ?>" class="text-decoration-none link-dark d-inline-flex align-items-center"><?php echo esc_html__('Create Cursor', 'wpcustom-cursors') ?> <i class="nav-icon ms-2 ri-arrow-right-s-line"></i></a>
				<?php
				break;
			case 'custom-cursor_page_wpcc_add_new':
				?>
				<a href="<?php menu_page_url('wp_custom_cursors', true) ?>" class="text-decoration-none link-dark d-inline-flex align-items-center"><?php echo esc_html__('Home', 'wpcustom-cursors') ?> <i class="nav-icon ms-2 ri-arrow-right-s-line"></i></a>
				<?php
				break;
			case 'custom-cursor_page_wpcc_cursor_maker':
				?>
				<a href="<?php menu_page_url('wp_custom_cursors', true) ?>" class="text-decoration-none link-dark"><?php echo esc_html__('Home', 'wpcustom-cursors') ?> </a> <i class="ri-arrow-right-s-fill"></i> <a href="<?php menu_page_url('wpcc_add_new', true) ?>" class="text-decoration-none link-dark d-inline-flex align-items-center"><?php echo esc_html__('Create Cursor', 'wpcustom-cursors') ?>  <i class="nav-icon ms-2 ri-arrow-right-s-line"></i></a>
				<?php
				break;
		}
	?>
	</div>
	
</div>
<!-- End Header -->