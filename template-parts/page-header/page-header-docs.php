<div class="docs-page-header page-header">
	<div class="container">
		<?php
		$queried_object = get_queried_object();
		$search_tax_query = is_tax( 'wcboost_docs_cat' ) ? ',"wcboost_docs_cat":"' . $queried_object->term_name . '"' : '';
		$header_content = '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|40"}}},"backgroundColor":"secondary","layout":{"type":"constrained","contentSize":"800px"}} -->
		<div class="wp-block-group alignfull has-secondary-background-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
		<!-- wp:spacer {"height":"60px"} -->
		<div style="height:60px" aria-hidden="true" class="wp-block-spacer"></div>
		<!-- /wp:spacer -->

		<!-- wp:heading {"textAlign":"center","level":2} -->
		<div class="wp-block-heading has-text-align-center has-extra-large-font-size">Knowlege Base</div>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"center"} -->
		<p class="has-text-align-center">Search for documentations ' . ( is_tax() ? 'in ' . $queried_object->name : ' on anything about products' ) . '</p>
		<!-- /wp:paragraph -->

		<!-- wp:search {"label":"Search","showLabel":false,"placeholder":"Search the docs","buttonText":"Search","buttonPosition":"button-inside","buttonUseIcon":true,"query":{"post_type":"wcboost_docs"' . $search_tax_query . '},"lock":{"move":true,"remove":true},"align":"center"} /--></div>
		<!-- /wp:group -->';

		echo do_blocks( $header_content );
		?>
	</div>
</div>
