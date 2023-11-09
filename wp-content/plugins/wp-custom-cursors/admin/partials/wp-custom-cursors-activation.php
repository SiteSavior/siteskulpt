<?php 
	
	/**
	 * @link       https://codecanyon.net/user/web_trendy
	 * @since      3.1
	 * @package    Wp_custom_cursors
	 * @subpackage Wp_custom_cursors/includes
	 * @author     Web_Trendy <webtrendyio@gmail.com>
	 */

	$actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	if (isset($_POST['status']) && isset($_POST['message'])) {
		if ($_POST['status'] == 'Activated') {
			add_option( 'wpcustomcursor_activation', 'active', '', 'yes' );
		}
		echo 'Status: ' . $_POST['status'];
		echo '<br/> Message: ' . $_POST['message'];
	}

	echo '<br/> Option: ' .get_option('wpcustomcursor_activation');

?>

	<div class="wt-body">
		<div class="wt-page">
			<div class="card bg-light p-3">
	    		<div class="card-body">
	    			<div class="row">
	    				<div class="col">
	    					<h3 class="h5 mb-3"><?php echo esc_html__( 'Activation', 'wpcustom-cursors' ); ?></h3>
	    					<form class="row align-items-end" method="post" action="#" id="activate_form">
	    						<div class="col-md">
	    							<label for="purchase_code" class="form-label d-flex align-items-center">
	    								<?php echo esc_html__( 'Purchase Code:', 'wpcustom-cursors' ); ?>
	    								<span class="text-body-tertiary d-flex ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?php echo esc_html__( 'Enter the purchase code you get from CodeCanyon. An example purchase code will look like:  86781236-23d0-4b3c-7dfa-c1c147e0dece', 'wpcustom-cursors' );?>">
		    								<i class="ri-question-fill"></i>
	    								</span>
	    							</label>
									<input type="text" class="form-control" id="purchase_code" name="purchase_code" required style="height: 38px;">
									<input type="hidden" value="<?php echo $actual_link; ?>" name="source_url">
	    						</div>
	    						<div class="col-md">
	    							<button type="submit" class="btn btn-primary">Activate</button>
	    						</div>
	    					</form>
	    				</div>
	    			</div>
	    		</div>
	    	</div>
		</div>
	</div>
	
	<?php if (isset($_POST['status']) && isset($_POST['message'])) { ?>
	<div class="toast-container position-fixed bottom-0 end-0 p-3">
	  	<div id="message_toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
	    	<div class="toast-header">
	      		<?php  
	      			switch ($_POST['status']) {
	      				case 'Activated': 
	      					echo '<i class="ri-cursor-line text-success lh-1 fs-5 me-2"></i>';
	      				break;
	      				case 'Not Activated':
	      					echo '<i class="ri-close-line text-danger lh-1 fs-5 me-2"></i>';
	      				break;
	      			}
	      		?>
	      		<strong class="me-auto"><?php echo esc_html__( $_POST['status'], 'wpcustom-cursors' );?></strong>
	      		<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="<?php echo esc_html__( 'Close', 'wpcustom-cursors' );?>"></button>
	    	</div>
	    	<div class="toast-body">
		      	<?php echo esc_html__( $_POST['message'], 'wpcustom-cursors' );?>
	    	</div>
	  	</div>
	</div>
	<script>
		(function(){
			window.addEventListener('DOMContentLoaded', function(event) {
				window.addEventListener('load', function(event) {
					const cursorToast = document.getElementById('message_toast');
					if (cursorToast) {
					  	const toast = new bootstrap.Toast(cursorToast)
				    	toast.show();
					}
				});
			});
		})();
	</script>
	<?php } ?>
