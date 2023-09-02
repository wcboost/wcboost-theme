<?php

class WCBoost_Custom_Post_Type {

	public function __construct() {
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_meta_boxes' ) );

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
	}

	public function register_post_types() {
		register_post_type( 'wcboost_plugin', [
			'labels' => array(
				'name'                  => __( 'WooCommerce Plugins', 'wcboost' ),
				'singular_name'         => __( 'Plugin', 'wcboost' ),
				'all_items'             => __( 'All Plugins', 'wcboost' ),
				'menu_name'             => _x( 'WC Plugins', 'Admin menu name', 'wcboost' ),
				'add_new'               => __( 'Add New', 'wcboost' ),
				'add_new_item'          => __( 'Add new plugin', 'wcboost' ),
				'edit'                  => __( 'Edit', 'wcboost' ),
				'edit_item'             => __( 'Edit plugin', 'wcboost' ),
				'new_item'              => __( 'New plugin', 'wcboost' ),
				'view_item'             => __( 'View plugin', 'wcboost' ),
				'view_items'            => __( 'View WC Plugins', 'wcboost' ),
				'search_items'          => __( 'Search WC Plugins', 'wcboost' ),
				'not_found'             => __( 'No WC Plugins found', 'wcboost' ),
				'not_found_in_trash'    => __( 'No WC Plugins found in trash', 'wcboost' ),
				'parent'                => __( 'Parent plugin', 'wcboost' ),
				'featured_image'        => __( 'Plugin image', 'wcboost' ),
				'set_featured_image'    => __( 'Set plugin image', 'wcboost' ),
				'remove_featured_image' => __( 'Remove plugin image', 'wcboost' ),
				'use_featured_image'    => __( 'Use as plugin image', 'wcboost' ),
				'insert_into_item'      => __( 'Insert into plugin', 'wcboost' ),
				'uploaded_to_this_item' => __( 'Uploaded to this plugin', 'wcboost' ),
				'filter_items_list'     => __( 'Filter WC Plugins', 'wcboost' ),
				'items_list_navigation' => __( 'WC Plugins navigation', 'wcboost' ),
				'items_list'            => __( 'WC Plugins list', 'wcboost' ),
				'item_link'             => __( 'Plugin Link', 'wcboost' ),
				'item_link_description' => __( 'A link to a plugin.', 'wcboost' ),
			),
			'public'              => true,
			'show_ui'             => true,
			'menu_icon'           => 'dashicons-plugins-checked',
			'capability_type'     => 'product',
			'map_meta_cap'        => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => false,
			'hierarchical'        => false, // Hierarchical causes memory issues - WP loads all records!
			'rewrite'             => array(
				'slug'       => 'plugin',
				'with_front' => false,
				'feeds'      => true,
			),
			'query_var'           => true,
			'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', 'publicize', 'wpcom-markdown' ),
			'has_archive'         => true,
			'show_in_nav_menus'   => true,
			'show_in_rest'        => true,
		] );

		register_post_type( 'wcboost_theme', [
			'labels' => array(
				'name'                  => __( 'WooCommerce Themes', 'wcboost' ),
				'singular_name'         => __( 'Theme', 'wcboost' ),
				'all_items'             => __( 'All Themes', 'wcboost' ),
				'menu_name'             => _x( 'WC Themes', 'Admin menu name', 'wcboost' ),
				'add_new'               => __( 'Add New', 'wcboost' ),
				'add_new_item'          => __( 'Add new theme', 'wcboost' ),
				'edit'                  => __( 'Edit', 'wcboost' ),
				'edit_item'             => __( 'Edit theme', 'wcboost' ),
				'new_item'              => __( 'New theme', 'wcboost' ),
				'view_item'             => __( 'View theme', 'wcboost' ),
				'view_items'            => __( 'View WC Themes', 'wcboost' ),
				'search_items'          => __( 'Search WC Themes', 'wcboost' ),
				'not_found'             => __( 'No WC Themes found', 'wcboost' ),
				'not_found_in_trash'    => __( 'No WC Themes found in trash', 'wcboost' ),
				'parent'                => __( 'Parent theme', 'wcboost' ),
				'featured_image'        => __( 'Theme image', 'wcboost' ),
				'set_featured_image'    => __( 'Set theme image', 'wcboost' ),
				'remove_featured_image' => __( 'Remove theme image', 'wcboost' ),
				'use_featured_image'    => __( 'Use as theme image', 'wcboost' ),
				'insert_into_item'      => __( 'Insert into theme', 'wcboost' ),
				'uploaded_to_this_item' => __( 'Uploaded to this theme', 'wcboost' ),
				'filter_items_list'     => __( 'Filter WC Themes', 'wcboost' ),
				'items_list_navigation' => __( 'WC Themes navigation', 'wcboost' ),
				'items_list'            => __( 'WC Themes list', 'wcboost' ),
				'item_link'             => __( 'Theme Link', 'wcboost' ),
				'item_link_description' => __( 'A link to a theme.', 'wcboost' ),
			),
			'public'              => true,
			'show_ui'             => true,
			'menu_icon'           => 'dashicons-color-picker',
			'capability_type'     => 'product',
			'map_meta_cap'        => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => false,
			'hierarchical'        => false, // Hierarchical causes memory issues - WP loads all records!
			'rewrite'             => array(
				'slug'       => 'theme',
				'with_front' => false,
				'feeds'      => true,
			),
			'query_var'           => true,
			'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', 'publicize', 'wpcom-markdown' ),
			'has_archive'         => true,
			'show_in_nav_menus'   => true,
			'show_in_rest'        => true,
		] );

		register_post_type( 'wcboost_docs', [
			'labels' => array(
				'name'                  => __( 'Documentations', 'wcboost' ),
				'singular_name'         => __( 'Documentation', 'wcboost' ),
				'all_items'             => __( 'All Docs', 'wcboost' ),
				'menu_name'             => _x( 'Docs', 'Admin menu name', 'wcboost' ),
				'add_new'               => __( 'Add New', 'wcboost' ),
				'add_new_item'          => __( 'Add new Docs', 'wcboost' ),
				'edit'                  => __( 'Edit', 'wcboost' ),
				'edit_item'             => __( 'Edit Docs', 'wcboost' ),
				'new_item'              => __( 'New Docs', 'wcboost' ),
				'view_item'             => __( 'View Docs', 'wcboost' ),
				'view_items'            => __( 'View Docs', 'wcboost' ),
				'search_items'          => __( 'Search docs', 'wcboost' ),
				'not_found'             => __( 'No docs found', 'wcboost' ),
				'not_found_in_trash'    => __( 'No docs found in trash', 'wcboost' ),
				'parent'                => __( 'Parent docs', 'wcboost' ),
				'featured_image'        => __( 'Docs image', 'wcboost' ),
				'set_featured_image'    => __( 'Set docs image', 'wcboost' ),
				'remove_featured_image' => __( 'Remove docs image', 'wcboost' ),
				'use_featured_image'    => __( 'Use as docs image', 'wcboost' ),
				'insert_into_item'      => __( 'Insert into docs', 'wcboost' ),
				'uploaded_to_this_item' => __( 'Uploaded to this docs', 'wcboost' ),
				'filter_items_list'     => __( 'Filter Docs', 'wcboost' ),
				'items_list_navigation' => __( 'Docs navigation', 'wcboost' ),
				'items_list'            => __( 'Docs list', 'wcboost' ),
				'item_link'             => __( 'Docs Link', 'wcboost' ),
				'item_link_description' => __( 'A link to a docs.', 'wcboost' ),
			),
			'public'              => true,
			'show_ui'             => true,
			'menu_icon'           => 'dashicons-book',
			'capability_type'     => 'product',
			'map_meta_cap'        => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => false,
			'hierarchical'        => false, // Hierarchical causes memory issues - WP loads all records!
			'rewrite'             => array(
				'slug'       => 'docs',
				'with_front' => false,
				'feeds'      => true,
			),
			'query_var'           => true,
			'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', 'publicize', 'wpcom-markdown' ),
			'has_archive'         => false,
			'show_in_nav_menus'   => true,
			'show_in_rest'        => true,
		] );
	}

	public function register_taxonomies() {
		register_taxonomy(
			'wcboost_plugin_cat',
			array( 'wcboost_plugin' ),
			array(
				'hierarchical'          => true,
				'label'                 => __( 'Categories', 'wcboost' ),
				'labels'                => array(
					'name'                  => __( 'Plugin categories', 'wcboost' ),
					'singular_name'         => __( 'Category', 'wcboost' ),
					'menu_name'             => _x( 'Categories', 'Admin menu name', 'wcboost' ),
					'search_items'          => __( 'Search categories', 'wcboost' ),
					'all_items'             => __( 'All categories', 'wcboost' ),
					'parent_item'           => __( 'Parent category', 'wcboost' ),
					'parent_item_colon'     => __( 'Parent category:', 'wcboost' ),
					'edit_item'             => __( 'Edit category', 'wcboost' ),
					'update_item'           => __( 'Update category', 'wcboost' ),
					'add_new_item'          => __( 'Add new category', 'wcboost' ),
					'new_item_name'         => __( 'New category name', 'wcboost' ),
					'not_found'             => __( 'No categories found', 'wcboost' ),
					'item_link'             => __( 'Plugin Category Link', 'wcboost' ),
					'item_link_description' => __( 'A link to a plugin category.', 'wcboost' ),
				),
				'show_in_rest'          => true,
				'show_ui'               => true,
				'query_var'             => true,
				'rewrite'               => array(
					'slug'         => 'plugin-category',
					'with_front'   => false,
					'hierarchical' => true,
				),
			)
		);

		register_taxonomy(
			'wcboost_theme_cat',
			array( 'wcboost_theme' ),
			array(
				'hierarchical'          => true,
				'label'                 => __( 'Categories', 'wcboost' ),
				'labels'                => array(
					'name'                  => __( 'Theme categories', 'wcboost' ),
					'singular_name'         => __( 'Category', 'wcboost' ),
					'menu_name'             => _x( 'Categories', 'Admin menu name', 'wcboost' ),
					'search_items'          => __( 'Search categories', 'wcboost' ),
					'all_items'             => __( 'All categories', 'wcboost' ),
					'parent_item'           => __( 'Parent category', 'wcboost' ),
					'parent_item_colon'     => __( 'Parent category:', 'wcboost' ),
					'edit_item'             => __( 'Edit category', 'wcboost' ),
					'update_item'           => __( 'Update category', 'wcboost' ),
					'add_new_item'          => __( 'Add new category', 'wcboost' ),
					'new_item_name'         => __( 'New category name', 'wcboost' ),
					'not_found'             => __( 'No categories found', 'wcboost' ),
					'item_link'             => __( 'Theme Category Link', 'wcboost' ),
					'item_link_description' => __( 'A link to a theme category.', 'wcboost' ),
				),
				'show_in_rest'          => true,
				'show_ui'               => true,
				'query_var'             => true,
				'rewrite'               => array(
					'slug'         => 'theme-category',
					'with_front'   => false,
					'hierarchical' => true,
				),
			)
		);

		register_taxonomy(
			'wcboost_docs_cat',
			array( 'wcboost_docs' ),
			array(
				'hierarchical'          => true,
				'label'                 => __( 'Categories', 'wcboost' ),
				'labels'                => array(
					'name'                  => __( 'Docs categories', 'wcboost' ),
					'singular_name'         => __( 'Category', 'wcboost' ),
					'menu_name'             => _x( 'Categories', 'Admin menu name', 'wcboost' ),
					'search_items'          => __( 'Search categories', 'wcboost' ),
					'all_items'             => __( 'All categories', 'wcboost' ),
					'parent_item'           => __( 'Parent category', 'wcboost' ),
					'parent_item_colon'     => __( 'Parent category:', 'wcboost' ),
					'edit_item'             => __( 'Edit category', 'wcboost' ),
					'update_item'           => __( 'Update category', 'wcboost' ),
					'add_new_item'          => __( 'Add new category', 'wcboost' ),
					'new_item_name'         => __( 'New category name', 'wcboost' ),
					'not_found'             => __( 'No categories found', 'wcboost' ),
					'item_link'             => __( 'Docs Category Link', 'wcboost' ),
					'item_link_description' => __( 'A link to a docs category.', 'wcboost' ),
				),
				'show_in_rest'          => true,
				'show_ui'               => true,
				'query_var'             => true,
				'rewrite'               => array(
					'slug'         => 'docs-category',
					'with_front'   => false,
					'hierarchical' => true,
				),
			)
		);
	}

	public function add_meta_boxes() {
		add_meta_box( 'plugin-data', esc_html__( 'Plugin Data', 'wcboost' ), array( $this, 'plugin_data_metabox' ), 'wcboost_plugin', 'advanced', 'high' );
	}

	public function plugin_data_metabox( $post ) {
		$props = (array) get_post_meta( $post->ID, 'wcboost_item_props', true );
		$props = wp_parse_args( $props, array(
			'version' => '',
			'php_version' => '',
			'wp_version' => '',
			'wc_version' => '',
			'support_url' => '',
			'docs_url' => '',
			'download_url' => '',
		) );

		if ( ! function_exists( 'woocommerce_wp_text_input' ) ) {
			return;
		}

		woocommerce_wp_text_input( array(
			'label' => esc_html__( 'Download URL', 'wcboost' ),
			'id' => 'wcboost_item_props[download_url]',
			'value' => $props['download_url'],
		) );

		woocommerce_wp_text_input( array(
			'label' => esc_html__( 'Version', 'wcboost' ),
			'id' => 'wcboost_item_props[version]',
			'value' => $props['version'],
		) );

		woocommerce_wp_text_input( array(
			'label' => esc_html__( 'Requires PHP Version', 'wcboost' ),
			'id' => 'wcboost_item_props[php_version]',
			'value' => $props['php_version'],
		) );

		woocommerce_wp_text_input( array(
			'label' => esc_html__( 'Requires WP Version', 'wcboost' ),
			'id' => 'wcboost_item_props[wp_version]',
			'value' => $props['wp_version'],
		) );

		woocommerce_wp_text_input( array(
			'label' => esc_html__( 'Requires WC Version', 'wcboost' ),
			'id' => 'wcboost_item_props[wc_version]',
			'value' => $props['wc_version'],
		) );

		woocommerce_wp_text_input( array(
			'label' => esc_html__( 'Documentation URL', 'wcboost' ),
			'id' => 'wcboost_item_props[docs_url]',
			'value' => $props['docs_url'],
		) );

		woocommerce_wp_text_input( array(
			'label' => esc_html__( 'Support URL', 'wcboost' ),
			'id' => 'wcboost_item_props[support_url]',
			'value' => $props['support_url'],
		) );

	}

	public function save_meta_boxes( $post_id ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		if ( isset( $_REQUEST['post_type'] ) && 'wcboost_plugin' == $_REQUEST['post_type'] && isset( $_REQUEST['wcboost_item_props'] ) ) {
			update_post_meta( $post_id, 'wcboost_item_props', $_REQUEST['wcboost_item_props'] );
		}
	}

	public function enqueue_admin_scripts( $hook ) {
		if ( 'post.php' == $hook || 'edit.php' == $hook ) {
			wp_add_inline_style( 'common', '
				#plugin-data .form-field {
					display: flex;
				}

				#plugin-data .form-field label {
					flex-basis: 20%;
				}
			' );
		}
	}
}

new WCBoost_Custom_Post_Type();
