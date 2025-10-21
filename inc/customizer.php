<?php
namespace WCBoost\Com\Theme;

/**
 * Customizer class
 */
class Customizer {

	/**
	 * Template parts
	 *
	 * @var array
	 */
	protected $template_parts = [];

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'maart_customize_register', [ $this, 'register' ] );
	}

	/**
	 * Get block parts
	 */
	protected function get_block_parts() {
		if ( ! empty( $this->template_parts) ) {
			return $this->template_parts;
		}

		$this->template_parts = [ '' => __( 'No template part', 'wcboost' ) ];

		$parts = get_block_templates( [], 'wp_template_part' );

		foreach ( $parts as $part ) {
			$this->template_parts[$part->slug] = $part->title;
		}

		return $this->template_parts;
	}

	/**
	 * Register theme settings
	 *
	 * @param \Maart\Customizer\Customize $manager
	 * @return void
	 */
	public function register( $manager ) {
		$manager->add_section(
			'wcboost',
			[
				'title'    => esc_html__( 'WCBoost', 'wcboost' ),
				'priority' => 200,
			]
		);

		// Brevo Conversion ID.
		$manager->add_setting( [
			'type'     => 'text',
			'name'     => 'brevo_conversion_id',
			'label'    => __('Brevo Conversion ID', 'wcboost'),
			'default'  => '',
			'section'  => 'wcboost',
		] );

		$this->register_footer_settings( $manager );
	}

	/**
	 * Register footer settings
	 */
	protected function register_footer_settings( $manager ) {
		// Footer sections.
		$manager->add_section(
			'wcboost_footer_sections',
			[
				'title'    => esc_html__( 'Footer Sections', 'wcboost' ),
				'panel'    => 'maart_footer',
			]
		);

		$manager->add_setting([
			'type'     => 'select',
			'name'     => 'footer_widgets_template',
			'label'    => __( 'Footer Widgets Template', 'wcboost' ),
			'default'  => '',
			'section'  => 'wcboost_footer_sections',
			'choices'  => $this->get_block_parts(),
		]);
	}
}

return new Customizer();
