<?php 
	if ( ! defined( 'ABSPATH' ) ) {
		echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
		exit;
	}
	
	global $product;
	$price = $product->get_price();
 ?>
<div class="button wip-show" data-price="<?php echo number_format( $price ) ?>"><?php _e( 'Installment Purchase', 'wip' ) ?></div>

<div id="wip-modal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLabel"><?php _e( 'Calculate Installment Purchase', 'wip' ) ?></h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="calculate">
					<div class="inner">
						<form action="" method="POST" id="form">
							<div class="calculate-detail">
								<p class="col-6"><?php _e( 'Installment Amount', 'wip' ) ?></p>
								<input class="col-6" type="text" name="money" id="money" value="">
							</div>
							<div class="calculate-detail">
								<p class="col-6"><?php _e( 'Interest Rate (%/year)', 'wip' ) ?></p>
								<input class="col-6" type="text"  name="rate" id="rate" value="">
							</div>
							<div class="calculate-detail">
								<p class="col-6"><?php _e( 'Term', 'wip' ) ?></p>
								<input class="col-3" type="text" name="deadline" id="deadline" value="">
								<select class="col-3" name="deadline-type" id="deadline-type">
									<option value="month"><?php _e( 'Month', 'wip' ) ?></option>
									<option value="year"><?php _e( 'Year', 'wip' ) ?></option>
								</select>

							</div>
							<div class="calculate-detail">
								<p class="col-6"><?php _e( 'Type', 'wip' ) ?></p>
								<select class="col-6" name="type" id="type">
									<option value="1"><?php _e( 'Pay off as debt decreases', 'wip' ) ?></option>
									<option value="2"><?php _e( 'Pay off monthly at double rates', 'wip' ) ?></option>
									<option value="3"><?php _e( 'Pay off monthly at single rates', 'wip' ) ?></option>
								</select>
							</div>
							<div class="calculate-detail">
								<button type="submit" name="submit" id="submit" class="btn btn-primary calculate-btn"><?php _e( 'Calculate', 'wip' ) ?></button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal-response"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e( 'Close', 'wip' ) ?></button>
			</div>
		</div>
	</div>
</div>