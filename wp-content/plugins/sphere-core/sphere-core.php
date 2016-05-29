<?php
/**
 * Plugin Name: Sphere Core
 * Plugin URI: http://theme-sphere.com
 * Description: Core plugin for SmartBlog to add support for like and social features.
 * Version: 1.0
 * Author: ThemeSphere
 * Author URI: http://theme-sphere.com
 * License: GPL2
 */

class Sphere_Plugin_Core
{
	public $components;
	public $registry;
	
	protected static $instance;
	
	public function __construct() 
	{
		add_action('after_setup_theme', array($this, 'setup'));
	}
	
	/**
	 * Initialize and include the components
	 */
	public function setup()
	{
		
		/**
		 * Registered components can be filtered with a hook after_setup_theme
		 */
		$this->components = apply_filters('sphere_plugin_components', array(
			'social-share', 'likes'
		));
		
		foreach ($this->components as $component) {
			require_once 'components/' . sanitize_file_name($component) . '.php';
			
			$class = 'Sphere_Plugin_' . implode('', array_map('ucfirst', explode('-', $component)));
			$this->registry[$component] = new $class;
		}
	}
	
	/**
	 * Static shortcut to retrieve component object from registry
	 * 
	 * @param  string $component
	 * @return object|boolean 
	 */
	public static function get($component)
	{
		$object = self::instance();
		if (isset($object->registry[$component])) {
			return $object->registry[$component];
		}
		
		return false;
	}
	
	/**
	 * Get singleton object
	 * 
	 * @return Sphere_Plugin_Core
	 */
	public static function instance()
	{
		if (!isset(self::$instance)) {
			self::$instance = new self;
		}
		
		return self::$instance;
	}
}

Sphere_Plugin_Core::instance();