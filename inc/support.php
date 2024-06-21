<?php
add_action( 'maart_customize_register', function( $manager ) {
	$manager->add_setting( [
		'type'      => 'dropdown-pages',
		'name'      => 'open_ticket_page_id',
		'label'     => __( 'Submit tickets page', 'wcboost' ),
		'default'   => '',
		'section'   => 'wcboost',
		'separator' => 'before',
	] );
} );

// Make the refund page private.
add_action( 'template_redirect', function() {
	$open_ticket_page_id = get_theme_mod( 'open_ticket_page_id' );

	if ( ! $open_ticket_page_id || ! is_page( $open_ticket_page_id ) ) {
		return;
	}

	if ( ! is_user_logged_in() ) {
		$url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'myaccount' ) : wp_login_url();
		wp_redirect( $url );
		exit();
	}

	if ( current_user_can( 'administrator' ) ) {
		return;
	}

	if ( empty( $_POST['_wpnonce'] ) || empty( $_POST['action'] ) || empty( $_POST['order_id'] ) ) {
		wp_redirect( home_url() );
		exit();
	}

	$order_id = $_POST['order_id'] ?? -1;

	if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'wcboost-refund-' . $order_id ) ) {
		$message = 'Invalid request! Please try again.';

		if ( wp_get_referer() ) {
			$message .= '<p><a href="' . wp_get_referer() . '">Go back</a></p>';
		}

		wp_die( $message );
		exit();
	}
} );
