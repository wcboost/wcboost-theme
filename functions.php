<?php

/**
 * Theme functions
 */

/**
 * Enqueue scripts
 */
add_action('maart_after_enqueue_styles', function () {
	wp_enqueue_style('wcboost', get_stylesheet_uri(), null, wp_get_theme()->get('Version'));
});

add_action('after_setup_theme', function () {
	add_theme_support('block-template-parts');
});

add_action('init', function () {
	register_nav_menu( 'footer-menu', esc_html__( 'Footer Menu', 'wcboost' ) );

	register_sidebar([
		'name'          => esc_html__('Footer 1', 'wcboost'),
		'id'            => 'footer-1',
		'description'   => esc_html__('Add widgets here to appear in the footer.', 'wcboost'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	]);

	register_sidebar([
		'name'          => esc_html__('Footer 2', 'wcboost'),
		'id'            => 'footer-2',
		'description'   => esc_html__('Add widgets here to appear in the footer.', 'wcboost'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	]);

	register_sidebar([
		'name'          => esc_html__('Footer 3', 'wcboost'),
		'id'            => 'footer-3',
		'description'   => esc_html__('Add widgets here to appear in the footer.', 'wcboost'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	]);

	register_sidebar([
		'name'          => esc_html__('Footer 4', 'wcboost'),
		'id'            => 'footer-4',
		'description'   => esc_html__('Add widgets here to appear in the footer.', 'wcboost'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	]);
});

// Modify header elements.
add_action('wp', function () {
	$maart = \Maart\Theme::instance();

	$header = $maart->frontend->get_component('header');
	$header_main = $header->get_section('header-main');

	$header_main->remove_component('search_icon', 'right', 20);
	$header_main->remove_component('branding', 'left', 10);
	$header_main->remove_component('menu', 'right', 10);

	$header_main->add_component([
		'type'     => 'branding',
		'priority' => 10,
		'column'   => 'left',
		'data' => [
			'no_heading' => true,
		],
	]);

	$header_main->add_component([
		'type'     => 'menu',
		'priority' => 10,
		'column'   => 'center',
		'data'     => [
			'location' => 'primary'
		],
	]);

	$header_main->add_component([
		'type'     => 'button',
		'priority' => 10,
		'column'   => 'right',
		'data'     => [
			'url' => wc_get_page_permalink('myaccount'),
			'text' => 'My Account',
			'class' => 'button--ghost button--icon header-button-account',
		],
	]);
} );

// Modify footer main.
add_action( 'wp', function () {
	$maart = \Maart\Theme::instance();
	$footer = $maart->frontend->get_component('footer')->get_section('footer-main');
	$footer->remove_component( 'copyright', 'center', 10 );
	$footer->add_component( [
		'type'     => 'copyright',
		'priority' => 10,
		'column'   => 'left',
	] );
	$footer->add_component( [
		'type'     => 'menu',
		'priority' => 10,
		'column'   => 'right',
	] );
} );

// Footer sections.
add_action('wp', function () {
	$maart = \Maart\Theme::instance();
	$footer = $maart->frontend->get_component('footer');

	// Footer widgets pattern.
	$footer_widgets_template = get_theme_mod( 'footer_widgets_template' );

	if ( $footer_widgets_template ) {
		$footer_widgets_part = new \Maart\Structure\Base\Section( 'footer-widgets-pattern' );
		$footer_widgets_part->priority = 5;
		$footer_widgets_part->set_type('footer');
		$footer_widgets_part->set_container('');
		$footer_widgets_part->add_component([
			'type'   => 'part',
			'column' => 'center',
			'data'   => [
				'template_part' => $footer_widgets_template,
			],
		] );

		$footer->add_section( $footer_widgets_part );
	}
});

// Footer legacy widgets.
add_action('wp', function () {
	$maart  = \Maart\Theme::instance();
	$footer = $maart->frontend->get_component('footer');

	// Footer sidebars section.
	$footer_widgets = new \Maart\Structure\Base\Section('footer-widgets');
	$footer_widgets->priority = 9;
	$footer_widgets->set_type('footer');

	$footer_widgets->add_component([
		'type'   => 'widgets',
		'column' => 'left',
		'data'   => [
			'sidebar_id' => 'footer-1',
		],
	]);

	$footer_widgets->add_component([
		'type'   => 'widgets',
		'column' => 'right',
		'data'   => [
			'sidebar_id' => 'footer-2',
		],
	]);

	$footer_widgets->add_component([
		'type'   => 'widgets',
		'column' => 'right',
		'data'   => [
			'sidebar_id' => 'footer-3',
		],
	]);

	$footer_widgets->add_component([
		'type'   => 'widgets',
		'column' => 'right',
		'data'   => [
			'sidebar_id' => 'footer-4',
		],
	]);

	if ( is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4') ) {
		$footer->add_section($footer_widgets);
	}
});

// Header top banner.
add_action( 'maart_before_header', function () {
	// get_template_part('template-parts/header/sale');
	// get_template_part('template-parts/header/halloween');
	get_template_part('template-parts/header/bfcm');
	get_template_part('template-parts/header/black-friday');
});

// Header top text.
add_action('maart_component_section_text', function ($data) {
	$content = $data['content'] ?? '';

	if ($content) {
	?>
		<div class="header-top-text"><?php echo wp_kses_post($content); ?></div>
	<?php
	}
});

// Read more text.
add_filter('maart_post_read_more_text', function () {
	return 'Continue reading';
});

/**
 * Get item property from the post meta
 *
 * @param string $prop
 * @param int $post_id
 * @return mixed
 */
function wcboost_item_prop($prop, $post_id = false) {
	$post_id = $post_id ? $post_id : get_the_ID();

	$meta = get_post_meta($post_id, 'wcboost_item_props', true);

	if (is_array($meta) && isset($meta[$prop])) {
		return $meta[$prop];
	}

	return null;
}

// Allow SVG uploads.
add_filter('upload_mimes', function ($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
});

add_action('admin_head', function () {
	echo '
	<style type="text/css">
		.image-icon.media-icon img[src$=".svg"], img[src$=".svg"].attachment-post-thumbnail { width: 60px !important;  height: auto !important; }
	</style>
	';
});

add_action('admin_init', function () {
	if (current_user_can('administrator') && ! defined('ALLOW_UNFILTERED_UPLOADS')) {
		define('ALLOW_UNFILTERED_UPLOADS', true);
	}
}, 1);

// Disable heartbeat.
add_action('init', function () {
	wp_deregister_script('heartbeat');
}, 1);

// Checkout fields.
add_filter('woocommerce_checkout_fields', function ($fields) {
	unset($fields['billing']['billing_phone']);
	// unset( $fields['billing']['billing_company'] );
	unset($fields['billing']['billing_country']);
	unset($fields['billing']['billing_address_1']);
	unset($fields['billing']['billing_address_2']);
	unset($fields['billing']['billing_city']);
	unset($fields['billing']['billing_state']);
	unset($fields['billing']['billing_postcode']);
	// unset( $fields['shipping']['shipping_phone']['validate'] );

	return $fields;
});

// Buy now.
add_filter('woocommerce_add_to_cart_redirect', function ($url, $adding) {
	// Clear notices for real actions only.
	// Avoid always clear notices.
	if ($adding) {
		wc_clear_notices();
	}

	$url = wc_get_checkout_url();

	return $url;
}, 10, 2);

// Brevo chat.
add_action('wp_footer', function () {
	$brevo_conversion_id = get_theme_mod('brevo_conversion_id');

	if (! $brevo_conversion_id) {
		return;
	}
	//610bb77f3846263c364feb6c
	?>
	<!-- Brevo Conversations {literal} -->
	<script>
		(function(d, w, c) {
			w.BrevoConversationsID = '<?php echo esc_js($brevo_conversion_id); ?>';
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
});

add_filter('woocommerce_downloadable_product_name', function () {
	return 'Download';
});

if (class_exists('\WCBoost\Com\Core\Plugins')) {
	include __DIR__ . '/inc/extension.php';
}

if (class_exists('\WCBoost\Com\Core\Docs')) {
	include __DIR__ . '/inc/docs.php';
}

if (class_exists('WooCommerce')) {
	include __DIR__ . '/inc/refund.php';
}

include __DIR__ . '/inc/support.php';
include __DIR__ . '/inc/customizer.php';
