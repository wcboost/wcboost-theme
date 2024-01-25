<aside id="secondary" class="widget-area sidebar sidebar-docs" role="complementary" itemscope itemtype="https://schema.org/WPSideBar">
	<?php
	if ( is_singular() ) : ?>
		<?php
		$docs = new WP_Query( [
			'post_type'      => 'wcboost_docs',
			'posts_per_page' => 20,
			'order_by'       => 'date',
			'order'          => 'ASC',
			'fields'         => 'ids',
		] );
		$cat = wp_get_post_terms( $GLOBALS['post']->ID, 'wcboost_docs_cat' );
		$cat = ! is_wp_error( $cat ) ? current( $cat ) : false;
		?>
		<?php if ( $docs->have_posts() ) : ?>
			<section class="widget same-cat-docs-widget">
				<h4 class="widget-title"><?php echo $cat ? $cat->name : ''; ?></h4>
				<ul>
					<?php foreach ( $docs->posts as $docs_id ) : ?>
						<?php if ( $docs_id == $GLOBALS['post']->ID ) : ?>
							<li class="current-docs"><?php echo esc_html( get_the_title( $docs_id ) ); ?></li>
						<?php else : ?>
							<li><a href="<?php echo esc_url( get_permalink( $docs_id ) ); ?>"><?php echo esc_html( get_the_title( $docs_id ) ); ?></a></li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
				<?php if ( $docs->max_num_pages > 1 ) : ?>
					<p class="docs-more-link">
						<a href="<?php echo esc_url( get_term_link( $cat ) ) ?>"><?php esc_html_e( 'View more', 'wcboost' ) ?></a>
					</p>
				<?php endif; ?>
			</section>
		<?php endif; ?>
	<?php endif; ?>
</aside>
