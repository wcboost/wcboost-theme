<?php
namespace WCBoost\Com\Theme;

use WCBoost\Com\Core\Docs as Docs_Post_Type;

/**
 * Template class of documentation page layouts
 */
class Docs {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'wp', [ $this, 'template_hooks' ] );
		add_action( 'wp', [ $this, 'fix_post_excerpt' ], 20 );

		add_filter( 'maart_block_editor_css', [ $this, 'block_editor_css'] );
	}

	public function template_hooks() {
		add_filter( 'body_class', [ $this, 'body_class' ] );
		add_filter( 'maart_header_background_color', [ $this, 'header_background_color' ] );
		add_action( 'maart_before_site_content', [ $this, 'docs_search_header' ] );
		add_action( 'maart_before_site_content_container', [ $this, 'page_header' ] );
		add_filter( 'maart_site_content_container', [ $this, 'content_container' ] );

		if ( $this->is_docs() ) {
			add_filter( 'maart_get_breadcrumb', [ $this, 'add_breadcrumb_trail' ] );
		}

		if ( $this->is_single() ) {
			add_action( 'maart_before_main_content', [ \Maart\Theme::instance()->module_manager->get( 'breadcrumbs' ), 'breadcrumb' ] );
			add_filter( 'maart_single_post_header_meta', '__return_empty_array' );
			add_action( 'maart_after_main_loop', [ $this, 'singular_navigation' ] );
		}
	}

	/**
	 * Check if it is the search results page of documentations
	 *
	 * @return bool
	 */
	public function is_search() {
		return ( is_search() && Docs_Post_Type::POST_TYPE == get_query_var( 'post_type' ) );
	}

	/**
	 * Check if it is the archive page of documentation
	 *
	 * @return bool
	 */
	public function is_archive() {
		return is_tax( Docs_Post_Type::CATEGORY );
	}

	/**
	 * Check if it is the documentation single page
	 *
	 * @return bool
	 */
	public function is_single() {
		return is_singular( Docs_Post_Type::POST_TYPE );
	}

	/**
	 * Check if this is a page for documentation
	 *
	 * @return bool
	 */
	public function is_docs() {
		return $this->is_single() || $this->is_archive() || $this->is_search();
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
		if ( $this->is_single() || $this->is_archive() || $this->is_search() ) {
			$color = '';
		}

		return $color;
	}

	/**
	 * Load page header for documentation pages
	 *
	 * @return void
	 */
	public function docs_search_header() {
		if ( $this->is_single() || $this->is_archive() || $this->is_search() ) {
			get_template_part( 'template-parts/page-header/docs-search-header' );
		}
	}

	/**
	 * Load page header for documentation pages
	 *
	 * @return void
	 */
	public function page_header() {
		if ( $this->is_archive() && ! $this->is_search() ) {
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

	public function add_breadcrumb_trail( $crumbs ) {
		$docs = get_page_by_path( 'docs' );

		if ( $docs ) {
			$home = array_shift( $crumbs );
			array_unshift( $crumbs, [
				__( 'Documentation', 'wcboost' ),
				get_page_link( $docs ),
			] );
		}

		return $crumbs;
	}

	/**
	 * Navigation on single docs page
	 *
	 * @return void
	 */
	public function singular_navigation() {
		the_post_navigation( [
			'prev_text'          => '<span class="nav-links__label">' . esc_html__( 'Previous', 'wcboost' ) . '</span><span class="nav-links__text">%title</span>',
			'next_text'          => '<span class="nav-links__label">' . esc_html__( 'Next', 'wcboost' ) . '</span><span class="nav-links__text">%title</span>',
			'in_same_term'       => true,
			'taxonomy'           => Docs_Post_Type::CATEGORY,
			'screen_reader_text' => __( 'Documentation navigation', 'wcboost' ),
			'aria_label'         => __( 'Documentations', 'wcboost' ),
		] );
	}

	/**
	 * Block editor CSS additions for docs
	 *
	 * @param  string $css
	 *
	 * @return void
	 */
	public function block_editor_css( $css ) {
		$css .= '
			body.post-type-wcboost_docs {
				--maart-editor--content-width: var(--container-width--narrow);
			}
		';

		return $css;
	}
}

return new Docs();
