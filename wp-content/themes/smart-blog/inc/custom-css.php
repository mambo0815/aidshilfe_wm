<?php
/**
 * Custom CSS generator for modifications
 */
class Bunyad_Theme_CustomCSS
{
	public function __construct()
	{
		add_action('after_setup_theme', array($this, 'init'), 12);
		add_action('customize_save', array($this, 'flush_cache'));
	}	
	
	public function init()
	{
		// set external css handler
		if ($this->has_custom_css()) {			
			add_action('template_redirect', array($this, 'global_custom_css'), 1);
		}
		
		add_action('wp_enqueue_scripts', array($this, 'register_custom_css'), 99);
	}
	
	/**
	 * Remove any custom CSS parser caches
	 * 
	 * @see Bunyad_Custom_Css::render()
	 */
	public function flush_cache()
	{
		delete_transient('bunyad_custom_css_cache');
	}
	
	/**
	 * Check if the theme has any custom css
	 */
	public function has_custom_css()
	{
		$css = array_filter(Bunyad::options()->get_all('css_'));
		if (count($css)) {
			return true;
		}
		
		return false;
	}
	
	/**
	 * Action callback: Output Custom CSS
	 */
	public function global_custom_css()
	{		
		// custom css requested?
		if (empty($_GET['bunyad_custom_css']) OR intval($_GET['bunyad_custom_css']) != 1) {
			return;
		}
		
		// set 200 - might be 404
		status_header(200);
		header("Content-type: text/css; charset: utf-8"); 

		include_once(locate_template('inc/css-generator.php'));
		
		/*
		 * Output the CSS customizations
		 */
		$render = new Bunyad_Custom_Css;
		$render->args = $_GET;
		echo $render->render();
		exit;
	}
	
	
	/**
	 * Action callback: Register Custom CSS with low priority 
	 */
	public function register_custom_css()
	{
		if (is_admin()) {
			return;
		}
		
		// add custom css
		if ($this->has_custom_css()) {
			
			$query_args = array('bunyad_custom_css' => 1);
			
			
			/**
			 * Custom CSS Output Method - external or on-page?
			 */
			if (Bunyad::options()->css_custom_output == 'external')  {
				wp_enqueue_style('bunyad-custom-css', add_query_arg($query_args, get_site_url() . '/'));
			}
			else {

				include_once(locate_template('inc/css-generator.php'));

				// associate custom css at the end
				$source = 'smart-blog-core';
				
				$check  = array('smart-blog-responsive');
				foreach ($check as $sheet) {
					if (wp_style_is($sheet, 'enqueued')) {
						$source = $sheet;
						break;
					}
				}
				
				// add to on-page custom css
				$render = new Bunyad_Custom_Css;
				$render->args = $query_args;
				Bunyad::core()->enqueue_css($source, $render->render());
			}
		}
	}
}

// init and make available in Bunyad::get('custom_css')
Bunyad::register('custom_css', array(
	'class' => 'Bunyad_Theme_CustomCSS',
	'init' => true
));