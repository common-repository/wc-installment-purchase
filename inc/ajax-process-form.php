<?php
if ( ! defined( 'ABSPATH' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

add_action( 'wp_ajax_process_form', 'wip_process_form' );
add_action( 'wp_ajax_nopriv_process_form', 'wip_process_form' );

function wip_process_form() {
	$money = $rate = $deadline = $deadline_type = $type = "";

	// Clean up the input values
	foreach( $_POST as $key => $value ) {
		$_POST[$key] = sanitize_key($value);
	}

	if ( isset( $_POST['money'] ) ) {
		$money = $_POST['money'];
		$money = (int)str_replace( ',', '', $money );
	}

	if ( isset( $_POST['rate'] ) ) {
		$rate = $_POST['rate'];
	}

	if ( isset( $_POST['deadline'] ) ) {
		$deadline = $_POST['deadline'];
	}

	if ( isset( $_POST['deadline-type'] ) ) {
		$deadline_type = $_POST['deadline-type'];
	}

	if ( isset( $_POST['type'] ) ) {
		$type = $_POST['type'];
	}
				  	
  	if ( $deadline_type == 'year' ) {
  		$deadline = $deadline * 12;
  	}

  	if ( !is_numeric( $money ) || !is_numeric( $rate ) || !is_numeric( $deadline ) ) {

  		echo '<p class="text-center">' . __( 'Check the input value!', 'wip' ) . '</p>';

  	} else {
  		$before_money = $money;
  		$base_per_month = $money / $deadline;
  		$total_interest = 0;
  		?>
			<table class="table table-responsive">
				<thead class="thead-light">
					<tr>
					  	<th scope="col"></th>
					    <th scope="col"><?php _e( 'Total Original Amount', 'wip' ) ?></th>
					    <th scope="col"><?php _e( 'Original Amount Payment Monthly', 'wip') ?></th> 
					    <th scope="col"><?php _e( 'Interest Payment Monthly', 'wip') ?></th>
					    <th scope="col"><?php _e( 'Total Amount Payment Monthly', 'wip') ?></th>
					</tr>
				</thead>
				<tbody>
					<tr>
					  	<td></td>
					  	<td><?php echo esc_html( number_format( $money ) ) ?></td>
					  	<td></td>
					  	<td></td>
					  	<td></td>
					</tr>
					
		<?php 
	  	
	  	switch ( $type ) {
	  		case '1':
	  			
	  			for ( $i = 1; $i <= $deadline; $i++ ) {

			  		$interest_per_month = $money * ( $rate / 100 ) / 12;
			  		$total_interest += $interest_per_month;
			  		
			  		$money = $money - $base_per_month;
			  		
			  		$pay_per_month = $base_per_month + $interest_per_month;
			  		echo '<tr>
			  				<th scope="row">' . __( 'Month ', 'wip' ) . $i . '</th>
			  				<td>' . esc_html( number_format( $money ) ) . '</td>
						    <td>' . esc_html( number_format( $base_per_month ) ) . '</td> 
						    <td>' . esc_html( number_format( $interest_per_month ) ) . '</td>
						    <td>' . esc_html( number_format( $pay_per_month ) ) . '</td>
						  </tr>';
			  	}
	  			break;				  		
	  		case '2':
	  			$total_interest = ( $money * pow( 1 + ( ( $rate / 100 ) / 12 ) , $deadline ) - $money );
	  			$interest_per_month = $total_interest / $deadline;	
	  			for ( $i = 1; $i <= $deadline; $i++ ) {
			  				  		
			  		$money = $money - $base_per_month;
			  		
			  		$pay_per_month = $base_per_month + $interest_per_month;
			  		echo '<tr>
			  				<th scope="row">' . __( 'Month ', 'wip' ) . $i . '</th>
						    <td>' . esc_html( number_format( $money ) ) . '</td>
						    <td>' . esc_html( number_format( $base_per_month ) ) . '</td> 
						    <td>' . esc_html( number_format( $interest_per_month ) ) . '</td>
						    <td>' . esc_html( number_format( $pay_per_month ) ) . '</td>
						  </tr>';
			  	}
	  			break;

	  		case '3':
	  			$total_interest = $money * ( $rate / 100 ) / 12 * $deadline;
	  			$interest_per_month = $total_interest / $deadline;	
		  		for ( $i = 1; $i <= $deadline; $i++ ) { 		
			  		$money = $money - $base_per_month;
			  		
			  		$pay_per_month = $base_per_month + $interest_per_month;
			  		echo '<tr>
			  				<th scope="row">' . __( 'Month ', 'wip' ) . $i . '</th>
						    <td>' . esc_html( number_format( $money ) ) . '</td>
						    <td>' . esc_html( number_format( $base_per_month ) ) . '</td> 
						    <td>' . esc_html( number_format( $interest_per_month ) ) . '</td>
						    <td>' . esc_html( number_format( $pay_per_month ) ) . '</td>
						  </tr>';
			  	}
	  			break;
	  	}
	  	?>
	  			</tbody>			  
			</table>
			<div class="total">
  				<div class="col-md-4">
  					<p><?php _e( 'Total Amount', 'wip') ?></p>
  					<p><?php echo esc_html( number_format( $before_money + $total_interest ) ); ?></p>
  				</div>
  				<div class="col-md-4">
  					<p><?php _e( 'Total Original Amount', 'wip' ) ?></p>
  					<p><?php echo esc_html( number_format( $before_money ) ); ?></p>
  				</div>
  				<div class="col-md-4">
  					<p><?php _e( 'Total Interest Amount', 'wip' ) ?></p>
  					<p><?php echo esc_html( number_format( $total_interest ) ); ?></p>
  				</div>  				
  			</div>
		<?php
  	}
  	die();

}