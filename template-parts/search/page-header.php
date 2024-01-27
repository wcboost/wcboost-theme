<?php
/**
 * Template part for displaying the page header of the search results
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Maart
 * @since 1.0.0
 */
use \WCBoost\Com\Theme\Docs;

$is_docs_search = 'wcboost_docs' == get_query_var( 'post_type' );
?>

<header class="page-header search-header">
	<div class="page-header__container <?php echo $is_docs_search ? 'container--narrow' : 'container' ?>">
		<h1 class="page-title">
			<?php $is_docs_search ? Docs::breadcrumb() : null; ?>
			<?php
			printf(
				/* translators: %s: Search term. */
				esc_html__( 'Results for "%s"', 'maart' ),
				'<span class="page-description search-term">' . esc_html( get_search_query() ) . '</span>'
			);
			?>
		</h1>
	</div>
</header>
