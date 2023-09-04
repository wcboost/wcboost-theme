<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WCBoost
 */

?>

<div id="plugin-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="plugin-header entry-header">
		<?php if ( has_post_thumbnail() ) : ?>
			<a href="<?php the_permalink(); ?>" class="plugin-thumbnail-link">
				<?php the_post_thumbnail( 'large' ); ?>
			</a>
		<?php endif; ?>
		<h2 class="plugin-title entry-title">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>
	</header>

	<div class="plugin-summary entry-content">
		<?php the_excerpt(); ?>
	</div>

	<a href="<?php the_permalink(); ?>" class="button button--medium button--outline" aira-label="<?php echo esc_attr( sprintf( __( 'Continue reading "%s"', 'wcboost' ), get_the_title() ) ); ?>">
		<?php esc_html_e( 'View details', 'wcboost' ); ?>
	</a>
</div>
