<?php
namespace WCBoost\Com\Theme;

/**
 * Template class of documentation page layouts
 */
class Docs {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'wp', [ $this, 'fix_post_excerpt' ], 20 );
		add_filter( 'body_class', [ $this, 'body_class' ] );
		add_filter( 'maart_header_background_color', [ $this, 'header_background_color' ] );
		add_action( 'maart_before_site_content', [ $this, 'page_header' ] );
		add_filter( 'maart_site_content_container', [ $this, 'content_container' ] );
	}

	/**
	 * Check if it is the search results page of documentations
	 *
	 * @return bool
	 */
	public function is_search() {
		return ( is_search() && isset( $_GET['post_type'] ) && 'wcboost_docs' == $_GET['post_type'] );
	}

	/**
	 * Check if it is the archive page of documentation
	 *
	 * @return bool
	 */
	public function is_archive() {
		return is_tax( 'wcboost_docs_cat' );
	}

	/**
	 * Check if it is the documentation single page
	 *
	 * @return bool
	 */
	public function is_single() {
		return is_singular( 'wcboost_docs' );
	}

	/**
	 * Ensure always display the excerpt on archive
	 *
	 * @return void
	 */
	public function fix_post_excerpt() {
		if ( ! $this->is_archive() && ! $this->is_search() ) {
			return;
		}

		if ( 'full' == get_theme_mod( 'blog_layout_posts' ) ) {
			$blog = \Maart\Theme::instance()->frontend->get_component( 'blog' );

			remove_action( 'maart_post_content', [ $blog, 'post_content' ] );
			add_action( 'maart_post_content', [ $blog, 'post_excerpt' ] );
		}

		add_filter( 'excerpt_length', [ $this, 'excerpt_length' ] );
	}

	/**
	 * Change the excerpt length for documentations
	 *
	 * @return void
	 */
	public function excerpt_length() {
		return 30;
	}

	/**
	 * Add body class
	 *
	 * @param  array $class
	 *
	 * @return void
	 */
	public function body_class( $class ) {
		if ( $this->is_search() ) {
			$class[] = 'docs-search-results';
		}

		return $class;
	}

	/**
	 * Change the header background color of archive and single page to transparent
	 *
	 * @param  string $color
	 *
	 * @return void
	 */
	public function header_background_color( $color ) {
		if ( $this->is_archive() || $this->is_search() ) {
			$color = '';
		}

		return $color;
	}

	/**
	 * Load page header for documentation pages
	 *
	 * @return void
	 */
	public function page_header() {
		if ( $this->is_search() || $this->is_archive() ) {
			get_template_part( 'template-parts/page-header/page-header-docs' );
		}
	}

	/**
	 * Change the site content containter to narrow for documentation pages
	 *
	 * @param  string $container
	 *
	 * @return void
	 */
	public function content_container( $container ) {
		if ( $this->is_single() || $this->is_archive() || $this->is_search() ) {
			$container = 'container--narrow';
		}

		return $container;
	}
}

return new Docs();
