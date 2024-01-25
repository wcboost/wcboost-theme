<header class="docs-header page-header">
	<div class="container--narrow">
		<?php \Maart\Theme::instance()->module_manager->get( 'breadcrumbs' )->breadcrumb(); ?>
		<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
		<?php the_archive_description( '<div class="page-header-desc">', '</div>' ); ?>
	</div>
</header>
