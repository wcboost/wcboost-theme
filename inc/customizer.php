<?php
namespace WCBoost\Com\Theme;

class Customizer {
	protected $template_parts = array();

	public function __construct() {
		add_action( 'maart_customize_register', [ $this, 'register' ] );
	}

	protected function get_block_parts() {
		static $template_part_choices = null;

		if (null !== $template_part_choices) {
			return $template_part_choices;
		}

		$template_parts = get_block_templates([], 'wp_template_part');
		$template_part_choices = array('' => __('No template part', 'wcboost'));
		foreach ($template_parts as $template_part) {
			$template_part_choices[$template_part->slug] = $template_part->title;
		}

		return $template_part_choices;
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
				'title'    => esc_html__('WCBoost', 'wcboost'),
				'priority' => 200,
			]
		);
	
		$manager->add_setting([
			'type'     => 'text',
			'name'     => 'brevo_conversion_id',
			'label'    => __('Brevo Conversion ID', 'wcboost'),
			'default'  => '',
			'section'  => 'wcboost',
		]);

		$this->register_footer_settings( $manager );
	
		$this->register_extension_template_settings( $manager );	
	}

	protected function register_footer_settings( $manager ) {
		// Footer sections.
		$manager->add_section(
			'wcboost_footer_sections',
			[
				'title'    => esc_html__('Footer Sections', 'wcboost'),
				'panel'    => 'maart_footer',
			]
		);
	
		$manager->add_setting([
			'type'     => 'select',
			'name'     => 'footer_widgets_template_part',
			'label'    => __('Footer Widgets Template Part', 'wcboost'),
			'default'  => '',
			'section'  => 'wcboost_footer_sections',
			'choices'  => $this->get_block_parts(),
		]);
	}

	protected function register_extension_template_settings( $manager ) {
		// Extension sections.
		$manager->add_section(
			'wcboost_extension',
			[
				'title'    => esc_html__('WCBoost Extension', 'wcboost'),
				'priority' => 250,
			]
		);
	
		$manager->add_setting([
			'type'     => 'select',
			'name'     => 'extension_price_template_part',
			'label'    => __('Price Template Part', 'wcboost'),
			'default'  => '',
			'section'  => 'wcboost_extension',
			'choices'  => $this->get_block_parts(),
		]);
	}
}

return new Customizer();