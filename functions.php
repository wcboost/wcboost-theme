<?php
/**
 * Functions
 */

/**
 * Enqueue scripts
 */
add_action( 'maart_after_enqueue_styles', function() {
	wp_enqueue_style( 'maart-child', get_stylesheet_uri() );
} );

/**
 * Add footer sections
 */
add_action( 'init', function() {
	$maart = \Maart\Theme::instance();
	$footer = $maart->frontend->get_component( 'footer' );

	$footer_widgets = new \Maart\Structure\Base\Section( 'footer-widgets' );

	$footer->add_section( $footer_widgets );
}, 20 );

/**
 * Add classes to body
 */
add_filter( 'body_class', function( $class ) {
	if ( is_post_type_archive( 'wcboost_plugin' ) ) {
		$class[] = 'blog-layout-grid';
	}

	return $class;
} );

/**
 * Page header
 */
add_action( 'maart_before_site_content', function() {
	if ( ! is_post_type_archive( 'wcboost_plugin' ) ) {
		return;
	}

	get_template_part( 'template-parts/page-header/page-header-plugin' );
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

/**
 * Load "Plugin" post type
 */
require_once get_theme_file_path( '/inc/post-types.php' );
