<?php
namespace WCBoost\Com\Theme;

use Automattic\Jetpack\My_Jetpack\Products\Extras;

/**
 * Template class for managing layout of plugin pages
 */
class Extension {

	public function __construct() {
		add_filter( 'body_class', [ $this, 'body_class' ] );
		add_action( 'maart_before_site_content', [ $this, 'page_header' ] );
		add_filter( 'maart_main_loop_content_template', [ $this, 'main_loop_content_template' ] );
	}

	/**
	 * Check if it is the search results page of extension
	 *
	 * @return bool
	 */
	public function is_search() {
		return ( is_search() && 'wcboost_plugin' == get_query_var( 'post_type' ) );
	}

	/**
	 * Check if it is the archive page of extension
	 *
	 * @return bool
	 */
	public function is_archive() {
		return is_tax( 'wcboost_plugin_cat' ) || is_post_type_archive( 'wcboost_plugin' );
	}

	/**
	 * Check if it is the extension single page
	 *
	 * @return bool
	 */
	public function is_single() {
		return is_singular( 'wcboost_plugin' );
	}

	/**
	 * Add classes to body of extension pages.
	 *
	 * @param  array $class
	 *
	 * @return array
	 */
	public function body_class( $class ) {
		if ( $this->is_archive() ) {
			$class[] = 'blog-layout-grid';
			$class[] = 'wcboost-extension-archive';
		}

		return $class;
	}

	/**
	 * Page header template part
	 *
	 * @return void
	 */
	public function page_header() {
		if ( $this->is_archive() ) {
			get_template_part( 'template-parts/page-header/page-header-plugin' );
		}
	}

	/**
	 * Main loop content template
	 *
	 * @param  array $template
	 *
	 * @return array
	 */
	public function main_loop_content_template( $template ) {
		if ( $this->is_single() ) {
			$template['part'] = 'template-parts/content/content-single';
			$template['name'] = 'extension';
		} elseif ( $this->is_archive() || $this->is_search() ) {
			$template['part'] = 'template-parts/content/content';
			$template['name'] = 'extension';
		}

		return $template;
	}
}

return new Extension();
