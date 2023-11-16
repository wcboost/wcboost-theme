<?php
/**
 * Functions
 */

/**
 * Enqueue scripts
 */
add_action( 'maart_after_enqueue_styles', function() {
	wp_enqueue_style( 'wcboost', get_stylesheet_uri() );
} );

/**
 * Add footer sections
 */
add_action( 'init', function() {
	if ( is_admin() ) {
		return;
	}

	$maart = \Maart\Theme::instance();

	// Modify header.
	$header = $maart->frontend->get_component( 'header' );

	$header->get_section( 'header-main' )->remove_component( 'search_icon', 'right', 20 );


	// Modify footer.
	$footer = $maart->frontend->get_component( 'footer' );

	$footer_widgets = new \Maart\Structure\Base\Section( 'footer-widgets' );

	$footer->add_section( $footer_widgets );
}, 20 );

/**
 * Get item property from the post meta
 *
 * @param string $prop
 * @param int $post_id
 * @return mixed
 */
function wcboost_item_prop( $prop, $post_id = false ) {
	$post_id = $post_id ? $post_id : get_the_ID();

	$meta = get_post_meta( $post_id, 'wcboost_item_props', true );

	if ( is_array( $meta ) && isset( $meta[ $prop ] ) ) {
		return $meta[ $prop ];
	}

	return null;
}

// Allow SVG uploads.
add_filter( 'upload_mimes', function( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
} );

add_action( 'admin_head', function() {
	echo '
	<style type="text/css">
		.image-icon.media-icon img[src$=".svg"], img[src$=".svg"].attachment-post-thumbnail { width: 60px !important;  height: auto !important; }
	</style>
	';
} );

add_action( 'admin_init', function() {
	if ( current_user_can( 'administrator' ) && ! defined( 'ALLOW_UNFILTERED_UPLOADS' ) ) {
		define('ALLOW_UNFILTERED_UPLOADS', true);
	}
}, 1 );

// Disable heartbeat.
add_action( 'init', function() {
	wp_deregister_script( 'heartbeat' );
}, 1 );

// Checkout fields.
add_filter( 'woocommerce_checkout_fields', function( $fields ) {
	unset( $fields['billing']['billing_phone'] );
	unset( $fields['billing']['billing_company'] );
	unset( $fields['billing']['billing_country'] );
	unset( $fields['billing']['billing_address_1'] );
	unset( $fields['billing']['billing_address_2'] );
	unset( $fields['billing']['billing_city'] );
	unset( $fields['billing']['billing_state'] );
	unset( $fields['billing']['billing_postcode'] );
	// unset( $fields['shipping']['shipping_phone']['validate'] );

	return $fields;
} );

// Buy now.
add_filter ( 'woocommerce_add_to_cart_redirect', function() {
	wc_clear_notices();

    return wc_get_checkout_url();
}, 10, 2 );

include __DIR__ . '/inc/extension.php';
include __DIR__ . '/inc/docs.php';
