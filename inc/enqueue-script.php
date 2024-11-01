<?php
if ( ! defined( 'ABSPATH' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

add_action( 'wp_enqueue_scripts' , 'wip_enqueue_script' );

function wip_enqueue_script() {
	wp_enqueue_style( 'bootstrap', WIP_URL . 'assets/bootstrap.min.css' );
	wp_enqueue_style( 'WIP-style', WIP_URL . 'assets/style.css' );

	wp_enqueue_script( 'WIP-script', WIP_URL . 'assets/script.js', array('jquery'), '1.0.0', false );
	wp_enqueue_script( 'popper', WIP_URL . 'assets/popper.min.js', false );
	wp_enqueue_script( 'bootstrap-js', WIP_URL . 'assets/bootstrap.min.js', false );

	wp_localize_script( 'WIP-script', 'wip_ajax', array(
	   'ajaxurl' => admin_url( 'admin-ajax.php' )
	) );
}
