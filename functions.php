<?php

/**
 * Functions
 */

/**
 * Enqueue scripts
 */
add_action('maart_after_enqueue_styles', function () {
	$version = filemtime(get_stylesheet_directory() . '/style.css');
	$version = $version ?? wp_get_theme()->get('Version');

	wp_enqueue_style('wcboost', get_stylesheet_uri(), null, $version);
});

add_action('after_setup_theme', function () {
	add_theme_support('block-template-parts');
});

add_action('init', function () {
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

/**
 * Add footer sections
 */
add_action('wp', function () {
	// if ( is_admin() ) {
	// 	return;
	// }

	$maart = \Maart\Theme::instance();

	// Modify header.
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

	// $topbar = new \Maart\Structure\Base\Section('header-top');
	// $topbar->priority = 5;
	// $topbar->add_component( [
	// 	'type'     => 'text',
	// 	'priority' => 10,
	// 	'column'   => 'center',
	// 	'data' => [
	// 		'content' => '<span class="ghost-icon-ani" aria-hidden="true"></span><strong>🎃 Spooktacular Halloween Sale! Get 30% OFF <a href="https://wcboost.com/plugin/woocommerce-variation-swatches/">Premium Plugins</a></strong><span class="ghost-icon-ani is-right" aria-hidden="true">',
	// 	],
	// ] );

	// $header->add_section($topbar);


	// Modify footer.
	$footer = $maart->frontend->get_component('footer');

	// Footer widgets pattern.
	$footer_widgets_template_name = get_theme_mod('footer_widgets_template_part');

	if ($footer_widgets_template_name) {
		$footer_widgets_part = new \Maart\Structure\Base\Section('footer-widgets-pattern');
		$footer_widgets_part->priority = 5;
		$footer_widgets_part->set_type('footer');
		$footer_widgets_part->set_container('');
		$footer_widgets_part->add_component([
			'type'   => 'part',
			'column' => 'center',
			'data'   => [
				'template_part' => $footer_widgets_template_name,
			],
		]);

		$footer->add_section($footer_widgets_part);
	}

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

	if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4')) {
		$footer->add_section($footer_widgets);
	}
}, 20);

add_action('maart_before_header', function () {
	return;
?>
	<section class="top-banner-section">
		<style>
			.top-banner {
				/* background: linear-gradient(90deg, #ea580c, #6B21D1, #ea580c); */
				background-image: linear-gradient(135deg, #2e1853 0%, #2b1245 25%, #4c2a8c 50%, #663399 75%, #7b40b4 100%);
				background-size: 200% 100%;
				color: #fff;
				padding: 16px 20px;
				/* animation: gradient-move 15s linear infinite; */
				position: relative;
				overflow: hidden;
			}

			.banner-pattern-overlay {
				position: absolute;
				top: 0;
				left: 0;
				right: 0;
				bottom: 0;
				background-image: radial-gradient(circle at 1px 1px, rgba(255, 255, 255, 0.1) 1px, transparent 0);
				background-size: 20px 20px;
				pointer-events: none;
			}

			@keyframes gradient-move {
				0% {
					background-position: 0% 50%;
				}

				100% {
					background-position: 200% 50%;
				}
			}

			.banner-content {
				display: flex;
				justify-content: center;
				align-items: center;
				gap: 24px;
				max-width: 1200px;
				margin: 0 auto;
			}

			.gift-icon {
				font-size: 20px;
			}

			.top-banner__text {
				font-size: 18px;
				font-weight: 600;
				color: white;
				display: flex;
				align-items: center;
				gap: 8px;
			}

			.discount-highlight {
				color: #FFD700;
				font-weight: 800;
			}

			.code-pill {
				background: rgba(0, 0, 0, 0.15);
				padding: 8px;
				margin: 0 8px;
				border-radius: 6px;
				font-family: monospace;
				font-size: 16px;
				font-weight: bold;
				letter-spacing: 1px;
				border: 1px solid rgba(255, 255, 255, 0.15);
			}

			.learn-more {
				text-decoration: underline;
				color: #FFD700;
				font-weight: bold;
			}

			.countdown-wrapper {
				display: flex;
				gap: 12px;
				align-items: center;
			}

			.countdown-item {
				display: flex;
				flex-direction: column;
				align-items: center;
				min-width: 45px;
			}

			.countdown-number {
				font-size: 20px;
				font-weight: bold;
				line-height: 1;
			}

			.countdown-label {
				font-size: 12px;
				opacity: 0.9;
			}

			@media (max-width: 767px) {
				.banner-content {
					flex-direction: column;
					gap: 12px;
					text-align: center;
				}

				.top-banner__text {
					flex-direction: column;
				}

				.countdown-wrapper {
					margin-top: 8px;
				}
			}
		</style>
		<div class="top-banner">
			<div class="banner-pattern-overlay"></div>
			<div class="banner-content">
				<div class="top-banner__text">
					<span class="save-text">
						<span class="gift-icon">🎁</span>
						SAVE <span class="discount-highlight">50% OFF</span> Everything!
					</span>
					<span class="use-code">
						Use code: <span class="code-pill">BFCM2024</span>
					</span>
				</div>
				<div class="countdown-wrapper">
					<div class="countdown-item">
						<span class="countdown-number" id="days">01</span>
						<span class="countdown-label">days</span>
					</div>
					<div class="countdown-item">
						<span class="countdown-number" id="hours">10</span>
						<span class="countdown-label">hr</span>
					</div>
					<div class="countdown-item">
						<span class="countdown-number" id="minutes">22</span>
						<span class="countdown-label">min</span>
					</div>
					<div class="countdown-item">
						<span class="countdown-number" id="seconds">07</span>
						<span class="countdown-label">sec</span>
					</div>
				</div>
			</div>
		</div>

		<script>
			function updateCountdown() {
				const now = new Date();
				const endDate = new Date('2024-12-03T23:59:59'); // Adjust this date as needed
				const diff = endDate - now;

				if (diff <= 0) {
					document.querySelector('.top-banner').style.display = 'none';
					return;
				}

				const days = Math.floor(diff / (1000 * 60 * 60 * 24));
				const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
				const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
				const seconds = Math.floor((diff % (1000 * 60)) / 1000);

				document.getElementById('days').textContent = days.toString().padStart(2, '0');
				document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
				document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
				document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
			}

			setInterval(updateCountdown, 1000);
		</script>
	</section>
	<?php
});

add_action('maart_component_section_text', function ($data) {
	$content = $data['content'] ?? '';

	if ($content) {
	?>
		<div class="header-top-text"><?php echo wp_kses_post($content); ?></div>
	<?php
	}
});

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

include __DIR__ . '/inc/support.php';

if (class_exists('WooCommerce')) {
	include __DIR__ . '/inc/refund.php';
}

include __DIR__ . '/inc/customizer.php';