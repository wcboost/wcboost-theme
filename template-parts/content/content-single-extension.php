<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WCBoost
 */

$slug = wcboost_item_prop( 'wporg_slug' ) ?? $GLOBALS['post']->post_name;
?>

<div id="plugin-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="plugin-header">
		<?php the_title( '<h1 class="entry-title plugin-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="plugin-content__wrapper">
		<div class="plugin-content">
			<div class="plugin-thumbnail">
				<?php the_post_thumbnail( 'full' ); ?>
			</div>
			<?php
			the_content();

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wcboost' ),
					'after'  => '</div>',
				)
			);
			?>
		</div><!-- .entry-content -->

		<div class="plugin-sidebar">
			<div class="plugin-sidebar__box plugin-sidebar__download">
				<a class="button button--large button--full" href="<?php echo esc_url( wcboost_item_prop( 'download_link' ) ?? 'https://wordpress.org/plugin/' . $slug ); ?>" onclick="if ( ! this.getAttribute( 'href' ) || '#' === this.href ) {  alert('<?php esc_attr_e( 'The download link will be available soon', 'wcboost' ) ?>'); return false; }" target="_blank"><?php esc_html_e( 'Download', 'wcboost' ) ?></a>

				<p>
					<a href="<?php echo esc_url( wcboost_item_prop( 'docs_url' ) ) ?>" target="_blank">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32"><path d="M25.7 9.3l-7-7c-.2-.2-.4-.3-.7-.3H8c-1.1 0-2 .9-2 2v24c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V10c0-.3-.1-.5-.3-.7zM18 4.4l5.6 5.6H18V4.4zM24 28H8V4h8v6c0 1.1.9 2 2 2h6v16z" fill="currentColor"/><path d="M10 22h12v2H10z" fill="currentColor"/><path d="M10 16h12v2H10z" fill="currentColor"/></svg>
						<?php esc_html_e( 'Documentation', 'wcboost' ) ?>
					</a>
				</p>
				<p>
					<a href="<?php echo esc_url( wcboost_item_prop( 'support_url' ) ?? 'https://wordpress.org/support/plugin/' . $slug ) ?>" target="_blank">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><g fill="none"><path d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 1 1-18 0a9 9 0 0 1 18 0zm-5 0a4 4 0 1 1-8 0a4 4 0 0 1 8 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></g></svg>
						<?php esc_html_e( 'Get support', 'wcboost' ) ?>
					</a>
				</p>
			</div>

			<div class="plugin-sidebar__box plugin-sidebar__info">
				<ul>
					<li>
						<span><?php esc_html_e( 'Version', 'wcboost' ) ?></span>
						<strong><?php echo wcboost_item_prop( 'version' ); ?></strong>
					</li>
					<li>
						<span><?php esc_html_e( 'Last Updated', 'wcboost' ) ?></span>
						<strong>
							<?php
							$last_updated = wcboost_item_prop( 'last_updated' );
							$modified = strtotime( $last_updated ?? get_the_modified_date() );
							echo human_time_diff( $modified ) . ' ' . esc_html__( 'ago', 'wcboost' );
							?>
						</strong>
					</li>
					<li>
						<span><?php esc_html_e( 'PHP', 'wcboost' ) ?></span>
						<strong><?php echo wcboost_item_prop( 'php_version' ); ?>+</strong>
					</li>
					<li>
						<span><?php esc_html_e( 'WordPress', 'wcboost' ) ?></span>
						<strong><?php echo wcboost_item_prop( 'wp_version' ); ?>+</strong>
					</li>
					<?php if ( $tested = wcboost_item_prop( 'wp_tested' ) ) : ?>
						<li>
							<span><?php esc_html_e( 'WordPress tested with', 'wcboost' ) ?></span>
							<strong><?php echo esc_html( $tested ); ?></strong>
						</li>
					<?php endif; ?>
					<li>
						<span><?php esc_html_e( 'WooCommerce', 'wcboost' ) ?></span>
						<strong><?php echo wcboost_item_prop( 'wc_version' ); ?>+</strong>
					</li>
					<?php if ( class_exists( 'WooCommerce' ) ) : ?>
						<li>
							<span><?php esc_html_e( 'WooCommerce tested with', 'wcboost' ) ?></span>
							<strong><?php echo WC()->version; ?></strong>
						</li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
	</div>

</div>
