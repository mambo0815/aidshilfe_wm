<?php
/**
 * WordPress Customizer registration for SmartBlog
 */
class Bunyad_Theme_Customizer
{
	public $option_key;
	private $contexts;
	 
	public function __construct()
	{
		// Register the customizer
		add_action('customize_register', array($this, 'register'), 11);
		add_action('customize_preview_init', array($this, 'init_preview'));
		
		// AJAX reset
		add_action('wp_ajax_reset_customizer', array($this, 'ajax_reset'));
		
		// Contextual controls handler
		add_filter('customize_control_active', array($this, 'contextual_controls'), 10, 2);
	}
	
	/**
	 * Register customizer settings from Bunyad options
	 * 
	 * @param WP_Customizer_Manager $wp_customizer
	 */
	public function register($wp_customizer)
	{
		/* @var $wp_customizer WP_Customize_Manager */
		
		/**
		 * Load custom controls and register them
		 */ 
		include(get_template_directory() . '/inc/customizer/control-checkboxes.php');
		include(get_template_directory() . '/inc/customizer/control-typography.php');
		
		// Register for JS
		$wp_customizer->register_control_type('Bunyad_Customizer_Control_Checkboxes');
		$wp_customizer->register_control_type('Bunyad_Customizer_Control_Typography');
		
		
		/**
		 * Load settings array
		 */
		$this->option_key = Bunyad::options()->get_config('theme_prefix') .'_theme_options';
		$options = include(get_template_directory() . '/admin/options.php');
		
		// Start priority at 10 and increment by 1
		$priority = 10;
		
		
		/**
		 * Loop through options array to add panels, sections, and controls
		 */
		foreach ($options as $panel) {
			
			$priority++;
			
			if (!empty($panel['id'])) {
				
				$wp_customizer->add_panel($panel['id'], array(
					'title' => $panel['title'],
					'description' => (!empty($panel['desc']) ? $panel['desc'] : ''),
					'priority' => $priority,
				));
			}
			else {
				$panel['id'] = null;
			}
			
			/**
			 * Add sections
			 */
			foreach ($panel['sections'] as $section) {
				
				if (!isset($section['id'])) {
					$section['id'] = strtolower(str_replace(' ', '', $section['title']));
				}
				
				// Add the section
				$wp_customizer->add_section($section['id'], array(
					'title'       => $section['title'],
					'description' => (!empty($section['desc']) ? $section['desc'] : ''),
					'panel'       => $panel['id'],
					'priority'    => $priority,
				));
				
				foreach ($section['fields'] as $field) {
					
					// Setup defaults and override
					$field = array_merge(array(
						'type' => '', 'label' => '', 'desc' => '', 'value' => '', 'transport' => 'refresh', 
						'input_attrs' => array(), 'options' => array(), 'context' => ''
					), $field);
					
					/**
					 * Register the setting
					 */
					$setting_id = $this->option_key . '[' . $field['name'] .']';

					// Support field names of type example[key]
					if (strstr($field['name'], '[')) {
						$setting_id = preg_replace('/(.+?\[.+?)\[(.+?)\]\]/', '\\1][\\2]', $setting_id);
					}
					
					$setting = array(
						'type'    => 'option',
						'default' => $field['value'],
										
						// Fallback to filtering HTML if no specific sanitize
						'sanitize_callback' => (is_array($field['value']) ? array($this, 'sanitize_array') :  'wp_filter_post_kses'),
						'transport' => $field['transport']
					);
					
					$wp_customizer->add_setting($setting_id, $setting);
					
					
					/**
					 * Prepare the control
					 */
					$control = array(
						'type'        => $field['type'],
						'section'     => $section['id'],
						'settings'    => $setting_id,
						'label'       => $field['label'],
						'description' => $field['desc'],
						'priority'    => $priority,
						'input_attrs' => $field['input_attrs'],
						'context'     => $field['context'],
					);
					
					// Contextual conditionals?
					if ($field['context']) {
						$this->contexts[$field['name']] = $control;
					}
					

					switch ($field['type']) {
						
						/**
						 * Color control with a special sanitize function
						 */
						case 'color':
							
							// Change sanitize for colors
							$wp_customizer->add_setting(
								$setting_id, 
								array_merge($setting, array('sanitize_callback' => 'sanitize_hex_color'))
							);
							
							// Add the control
							$wp_customizer->add_control(
								new WP_Customize_Color_Control($wp_customizer, 'color-' . $field['name'], $control)
							);
							
							break;

						
						/**
						 * Upload control - supports the media field to save id or older image control for full
						 */
						case 'upload':
							
							// Important for JS handling
							$control['type'] = $field['options']['type'];
								
							// Image/upload control - saves attachment ID
							if ($field['options']['type'] == 'media') {
								
								$wp_customizer->add_control(
									new WP_Customize_Media_Control($wp_customizer, 'upload-' . $field['name'], $control)
								);
								
							}
							else {
								
								// Image or Upload?
								$type = ($field['options']['type'] == 'image' ? 'WP_Customize_Image_Control' : 'WP_Customize_Upload_Control');
								$wp_customizer->add_control(
									new $type($wp_customizer, 'upload-' . $field['name'], $control)
								);
							}
							
							break;
							
						/**
						 * Multiple checkboxes control is a custom control
						 */
						case 'checkboxes':
							
							// Set choices
							$control['choices'] = $field['options'];
							$wp_customizer->add_control(
								new Bunyad_Customizer_Control_Checkboxes($wp_customizer, $field['name'], $control)
							);
							
							break;
							
						/**
						 * Typography control is mainly related to Google Fonts
						 */
						case 'typography':
							
							if (!empty($field['options'])) {
								$control['choices'] = $field['options'];
							}
							else {
								$control['choices'] = $this->get_font_choices();
							}
							
							// Other control settings
							$control['add_custom'] = true;
							$control['typeface']   = (!empty($field['typeface']) ? $field['typeface'] : false);
							
							$wp_customizer->add_control(
								new Bunyad_Customizer_Control_Typography($wp_customizer, $field['name'], $control)
							);
							
							break;
							
						case 'number':
							
							// Change sanitize for numbers
							$wp_customizer->add_setting(
								$setting_id, 
								array_merge($setting, array('sanitize_callback' => 'absint'))
							);
							
							$wp_customizer->add_control($field['name'], $control);
							
							break;

						case 'radio':
						case 'select':
							$control['choices'] = $field['options'];
							// continue, don't break!
				
						
						/**
						 * Default handler for all core supported controls
						 */
						default:
							$wp_customizer->add_control($field['name'], $control);
							break;
							
					}
					
				} // fields loop
				
			} // sections loop
			
		} // tabs loop
		
		
		/**
		 * Modifications to the defaul elements
		 */
		
		$wp_customizer->remove_section('themes'); 
		
		// Move native background image container to color & style
		$bg = $wp_customizer->get_section('background_image');
		$bg->panel = 'options-tab-style';
		$bg->title = esc_html_x('Site Background Image', 'Admin', 'smart-blog');
		
		// Move Site Identity to General
		$identity = $wp_customizer->get_section('title_tagline');
		$identity->panel = 'options-tab-general';
		$identity->priority = 400;
		
		// Remove default color section
		$wp_customizer->remove_section('colors');
	}
	
	/**
	 * Contextual controls - hide and show controls based on provided rules
	 * 
	 * @param boolean $active
	 * @param WP_Customize_Control $control
	 */
	public function contextual_controls($active, $control)
	{
		
		// If there are registered context conditional for this control
		if (!empty($this->contexts[$control->id])) {
			
			$data = $this->contexts[$control->id]['context'];
			$control = $data['control'];
			
			// If the current options value doesn't match the required value to show, hide it
			if (Bunyad::options()->get($control['key']) != $control['value']) {
				return false;
			}
		}
		
		return $active;
	}

	
	/**
	 * Run when customizer is run on the front-end to show the preview
	 */
	public function init_preview()
	{	
		// Re-init options in memory based on preview 
		Bunyad::options()->init();
		
		// Special case: This is set by Bunyad_Core::init() which runs before init_preview() 
		Bunyad::core()->set_sidebar(Bunyad::options()->default_sidebar);
		
		// Enqueue our JS
		wp_enqueue_script(
			'bunyad-customize-preview', 
			get_template_directory_uri() . '/js/admin/customizer-preview.js', 
			array('jquery', 'customize-preview'), 
			true
		);
				
	}
	
	/**
	 * Get a choice of available / recommended fonts
	 */
	public function get_font_choices()
	{
		$choices = array(
			'Lato', 'Open Sans', 'Merriweather', 'Source Sans Pro', 'Karla', 'Noto Sans', 'Noto Serif', 
			'PT Sans', 'PT Serif', 'Gentium Book Basic', 'Lora', 'Ubuntu', 'Playfair Display'
		);
		
		return array_combine($choices, $choices);
	}
	
	/**
	 * Sanitize array of values
	 */
	public function sanitize_array($values = '')
	{
		if (!is_array($values)) {
			return array();
		}
		
		return array_map('wp_filter_post_kses', $values);
		
	}
	
	/**
	 * Reset settings with AJAX for a custom control
	 */
	public function ajax_reset()
	{
		global $wp_customize;
		
		// nonce registered by customizer 
		$nonce = 'bunyad-save-customize_' . wp_get_theme()->get_stylesheet();
		
		if (!check_ajax_referer($nonce, 'nonce', false)) {
			wp_send_json_error('invalid_nonce');
		}
		
		// Delete all options - setting them to defaults
		Bunyad::factory('admin/options')->set_options()->delete_options(null, false);
		
		wp_send_json_success();
	}
}


// init and make available in Bunyad::get('customizer')
Bunyad::register('customizer', array(
	'class' => 'Bunyad_Theme_Customizer',
	'init' => true
));
