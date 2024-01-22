<?php
/**
 * Functions
 */

/**
 * Enqueue scripts
 */
add_action( 'maart_after_enqueue_styles', function() {
	$version = filemtime( get_stylesheet_directory() . '/style.css' );
	$version = $version ?? wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'wcboost', get_stylesheet_uri(), null, $version );
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

	$topbar = new \Maart\Structure\Base\Section( 'header-top' );
	$topbar->priority = 5;
	$topbar->add_component( [
		'type'     => 'text',
		'priority' => 10,
		'column'   => 'center',
		'data' => [
			'content' => '🎉 Big Black Friday and Cyber Monday Sale! Save 40% on <a href="' . esc_url( get_post_type_archive_link( 'wcboost_plugin' ) ) . '">all plugins</a>! 🎉',
		],
	] );

	// $header->add_section( $topbar );


	// Modify footer.
	$footer = $maart->frontend->get_component( 'footer' );

	$footer_widgets = new \Maart\Structure\Base\Section( 'footer-widgets' );

	$footer->add_section( $footer_widgets );
}, 20 );

add_action( 'maart_component_section_text', function( $data ) {
	$content = $data['content'] ?? '';

	if ( $content ) {
		?>
		<div class="header-top-text"><?php echo wp_kses_post( $content ); ?></div>
		<?php
	}
} );

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

add_action( 'maart_customize_register', function( $manager ) {
	$manager->add_section(
		'wcboost',
		[
			'title'    => esc_html__( 'WCBoost', 'wcboost' ),
			'priority' => 1000,
		]
	);

	$manager->add_setting( [
		'type'     => 'text',
		'name'     => 'brevo_conversion_id',
		'label'    => __( 'Brevo Conversion ID', 'wcboost' ),
		'default'  => '',
		'section'  => 'wcboost',
	] );
} );

// Brevo chat.
add_action( 'wp_footer', function() {
	$brevo_conversion_id = get_theme_mod( 'brevo_conversion_id' );

	if ( ! $brevo_conversion_id ) {
		return;
	}
	//610bb77f3846263c364feb6c
	?>
	<!-- Brevo Conversations {literal} -->
	<script>
		(function(d, w, c) {
			w.BrevoConversationsID = '<?php echo esc_js( $brevo_conversion_id ); ?>';
			w[c] = w[c] || function() {
				(w[c].q = w[c].q || []).push(arguments);
			};
			var s = d.createElement('script');
			s.async = true;
			s.src = 'https://conversations-widget.brevo.com/brevo-conversations.js';
			if (d.head) d.head.appendChild(s);
		})(document, window, 'BrevoConversations');
	</script>
	<!-- /Brevo Conversations {/literal} -->
	<?php
} );

include __DIR__ . '/inc/extension.php';
include __DIR__ . '/inc/docs.php';
include __DIR__ . '/inc/refund.php';
