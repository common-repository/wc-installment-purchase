<?php 
/**
 * Plugin Name: WooCommerce Installment Purchase
 * Plugin URI: https://github.com/Longkt/wc-installment-purchase
 * Description: A button show the referent to monthly payment.
 * Version: 1.0.0
 * Author: Long Nguyen
 * Author URI: https://profiles.wordpress.org/longnguyen
 * Text Domain: wip
 * Domain Path: /languages
 * License: GPLv2 or later
 */

if ( ! defined( 'ABSPATH' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

define( 'WIP_URL', plugin_dir_url( __FILE__ ) );
define( 'WIP_PATH', plugin_dir_path( __FILE__ ) );

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    require( WIP_PATH . 'inc/enqueue-script.php' );
	require( WIP_PATH . 'inc/ajax-process-form.php' );
	 
	add_action( 'woocommerce_after_shop_loop_item', 'wip_button_installment_purchase', 30 );
	add_action( 'woocommerce_single_product_summary', 'wip_button_installment_purchase', 35 );
	add_action( 'init', 'wip_i18n' );

	function wip_button_installment_purchase() {
		include( WIP_PATH . 'templates/modal.php' );
	}

	function wip_i18n() {
		load_plugin_textdomain( 'wip', false, basename( dirname( __FILE__ ) ) . '/languages/' );
	}
}
