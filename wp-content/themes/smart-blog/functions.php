<?php

/**
 * SmartBlog Theme!
 * 
 * This is the typical theme initialization file. Sets up the Bunyad Framework
 * and the theme functionality.
 * 
 * ----
 * 
 * Code Locations:
 * 
 *  /          -  WordPress default template files.
 *  lib/       -  Contains the Bunyad Framework files.
 *  inc/       -  Theme related functionality and some HTML helpers.
 *  admin/     -  Admin-only content.
 *  partials/  -  Template parts (partials) called via get_template_part().
 *  
 * Note: If you're looking to edit HTML, look for default WordPress templates in
 * top-level / and in partials/ folder.
 * 
 */

// Already initialized?
if (class_exists('Bunyad_Core')) {
	return;
}

// Initialize Framework
require_once get_template_directory() . '/lib/init.php';

// Fire up the theme - make available in Bunyad::get('smart_blog')
Bunyad::register('smart_blog', array(
	'class' => 'Bunyad_Theme_SmartBlog',
	'init' => true
));

/**
 * Main Framework Configuration
 */

$bunyad_core = Bunyad::core()->init(apply_filters('bunyad_init_config', array(

	'theme_name'    => 'smart_blog', // For prefixing options
	'meta_prefix'   => '_bunyad',    // Keep meta framework prefix for data interoperability 
	'theme_version' => '1.2.0',

	// widgets enabled
	'widgets'      => array('about', 'posts', 'social-count', 'cta', 'quote', 'ads', 'social'),
	'widgets_type' => 'embed',
	'post_formats' => array('gallery', 'image', 'video', 'audio'),
	'customizer'   => true,
	
	// Enabled metaboxes and prefs - id is prefixed with _bunyad_ in init() method of lib/admin/meta-boxes.php
	'meta_boxes' => array(
		array('id' => 'post-options', 'title' => esc_html_x('Post Options', 'Admin: Meta', 'smart-blog'), 'priority' => 'high', 'page' => array('post')),
		array('id' => 'page-options', 'title' => esc_html_x('Page Options', 'Admin: Meta', 'smart-blog'), 'priority' => 'high', 'page' => array('page')),
	)
)));


/**
 * SmartBlog Theme!
 * 
 * Anything theme-specific that won't go into the core framework goes here.
 */
class Bunyad_Theme_SmartBlog
{

	public function __construct() 
	{
		// Setup plugins before init
		$this->setup_plugins();
		
		// Perform the after_setup_theme 
		add_action('after_setup_theme', array($this, 'theme_init'), 12);
		
		/**
		 * Load theme functions and helpers.
		 * 
		 * Note: Classes can be included in Child Themes and extended to override
		 * or add functionality.
		 * 
		 * @see locate_template()
		 */
		
		// Ready up the custom css handlers
		include locate_template('inc/custom-css.php');
		
		// Customizer features
		include locate_template('inc/customizer.php');
		
		// Social counts
		include locate_template('inc/social.php');
		
		// Likes / heart functionality
		include locate_template('inc/likes.php');
		
		// Template tags related to general layout
		include locate_template('inc/helpers.php');
	}
	
	/**
	 * Setup enque data and actions
	 */
	public function theme_init()
	{
		/**
		 * Enqueue assets (css, js)
		 * 
		 * Register Custom CSS at a lower priority for CSS specificity
		 */
		add_action('wp_enqueue_scripts', array($this, 'register_assets'));
		
		/**
		 * Featured images settings
		 * 
		 * smart-blog-main        -  Used for main featured images
		 * smart-blog-main-full   -  Featured image for the full width posts
		 * smart-blog-grid        -  Used on the grid layout
		 * smart-blog-list-large  -  Used on list layout in full-width
		 * smart-blog-list-small  -  For list layout with sidebar
		 * smart-blog-thumb       -  Smaller thumbnail for widgets
		 */
		set_post_thumbnail_size(270, 180, true);
		
		add_image_size('smart-blog-main', 770, 515, true);
		add_image_size('smart-blog-main-full', 1170, 495, true);
		add_image_size('smart-blog-slider-alt', 1170, 585, true);
		
		add_image_size('smart-blog-grid', 369, 246, true);
		add_image_size('smart-blog-list-large', 339, 254, true);
		add_image_size('smart-blog-list-small', 254, 254, true);
		
		add_image_size('smart-blog-thumb', 99, 66, true);

		// i18n
		load_theme_textdomain('smart-blog', get_template_directory() . '/languages');
		
		// Setup navigation menu
		register_nav_menu('smart-blog-main', esc_html_x('Main Navigation', 'Admin', 'smart-blog'));
		register_nav_menu('smart-blog-top', esc_html_x('Top Bar Navigation', 'Admin', 'smart-blog'));
		register_nav_menu('smart-blog-top-foot', esc_html_x('Top Bar Menu Footer', 'Admin', 'smart-blog'));
		register_nav_menu('smart-blog-mobile', esc_html_x('Mobile Menu (Optional)', 'Admin', 'smart-blog'));
		
		
		// Additional HTML5 support not previously activated by Bunyad core
		add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));
		add_theme_support('title-tag');
		add_theme_support('custom-background');
		
		// User fields
		add_filter('user_contactmethods', array($this, 'add_profile_fields'));
		
		// Add content width for oEmbed and similar
		global $content_width;
		
		if (!isset($content_width)) {
			$content_width = 668;
		}
		
		/**
		 * Register Sidebars and relevant filters
		 */
		add_action('widgets_init', array($this, 'register_sidebars'));
		
		// Category widget settings
		add_filter('widget_categories_args', array($this, 'category_widget_query'));
		
		/**
		 * Posts related filter
		 */
		
		// Video format auto-embed
		add_filter('bunyad_featured_video', array($this, 'video_auto_embed'));
		add_filter('embed_defaults', array($this, 'soundcloud_embed'), 10, 2);
		
		// Remove hentry microformat, we use schema.org/Article
		add_action('post_class', array($this, 'fix_post_class'));
		
		// Fix content_width for full-width posts
		add_filter('wp_head', array($this, 'content_width_fix'));
				
		if (is_admin()) {
			// Add image sizes to the editor
			add_filter('image_size_names_choose', array($this, 'add_image_sizes_editor'));
			
			// Add editor styles
			add_editor_style(get_template_directory_uri() . '/css/admin/editor-style.css');
			add_filter('tiny_mce_before_init', array($this, 'add_editor_class'), 1);
		}
		
		// Limit search to posts?
		if (Bunyad::options()->search_posts_only) {
			add_filter('pre_get_posts', array($this, 'limit_search'));
		}
		
		// Fix pagination for first full post styles
		if (in_array(Bunyad::options()->home_layout, array('full-sidebar-grid', 'full-grid', 'full-list'))) {
			add_filter('pre_get_posts', array($this, 'fix_grid_pagination'));
		}
		
		// Add "more" text for excerpts
		Bunyad::posts()->more_html = '<div class="read-more"><a href="%s" title="%s">'. esc_html__('Keep Reading', 'smart-blog') .'<i class="icon icon-angle-right"></i></a></div>';
		
		/**
		 * Setup multi-weight post titles
		 */
		if (!is_admin()) {
			
			add_filter('the_title', array($this, 'title_styling'));
			add_filter('widget_title', array($this, 'title_styling'));
			
			// For text that's not a title, apply this filter
			add_filter('bunyad_text_weight', array($this, 'title_styling'));
			
			// Apply at priority 8 so wp_kses() filter strips the tags
			add_filter('single_post_title', array($this, 'title_styling'), 8);
		}
		
		// Default comment fields re-order
		add_filter('comment_form_fields', array($this, 'comment_form_order'), 20);

	}
	
	/**
	 * Filter callback: Add support or bold and emphasis in markdown format.
	 * 
	 * Example:
	 * 
	 * __bold__ OR **bold** is converted to <strong>bold</strong>
	 * _text_  OR *text*  is converted to <em>text</em>
	 * 
	 * @param string $title
	 */
	public function title_styling($title)
	{
		$title = preg_replace(
			array('/(\*\*|__)(.*?)\1/', '/(\*|_)(.*?)\1/'),
			array('<strong>\2</strong>', '<em>\2</em>'),
			$title
		);
		
		return $title;
	}

	/**
	 * Register and enqueue theme CSS and JS files
	 */
	public function register_assets()
	{
		if (!is_admin()) {
			
			/**
			 * Add CSS styles
			 */
			
			// Add google fonts
			$args  = array('family' => 'Open Sans:400,400italic,600,700|Merriweather:400,300italic,400italic,700');
		
			if (Bunyad::options()->font_charset) {
				$args['subset'] = implode(',', array_filter(Bunyad::options()->font_charset));
			}
		
			wp_enqueue_style('smart-blog-fonts', add_query_arg(urlencode_deep($args), (is_ssl() ? 'https' : 'http') . '://fonts.googleapis.com/css'), array(), null);
				
			// Add core css
			wp_enqueue_style('smart-blog-core', get_stylesheet_uri(), array(), Bunyad::options()->get_config('theme_version'));

			// Add lightbox to pages and single posts
			if (Bunyad::options()->enable_lightbox) {
				wp_enqueue_script('smart-blog-lightbox', get_template_directory_uri() . '/js/jquery.mfp-lightbox.js', array(), false, true);
				wp_enqueue_style('smart-blog-lightbox', get_template_directory_uri() . '/css/lightbox.css', array(), Bunyad::options()->get_config('theme_version'));
			}
			
			// Add web fonts
			wp_enqueue_style('smart-blog-icons', get_template_directory_uri() . '/css/icons/css/icons.css', array(), Bunyad::options()->get_config('theme_version'));
						
			// responsive
			if (Bunyad::options()->responsive) {
				wp_enqueue_style('smart-blog-responsive', get_template_directory_uri() . '/css/responsive.css', array(), Bunyad::options()->get_config('theme_version'));
			}
			
			// Load the theme scripts to footer, except for jquery
			wp_enqueue_script('smart-blog-theme', get_template_directory_uri() . '/js/bunyad-theme.js', array('jquery'), Bunyad::options()->get_config('theme_version'), true);
			wp_enqueue_script('smart-blog-slick', get_template_directory_uri() . '/js/jquery.slick.js', array('jquery'), Bunyad::options()->get_config('theme_version'), true);
			
			// Justified galleries turned on globally or for current post?
			if (Bunyad::options()->post_galleries == 'justified' || Bunyad::posts()->meta('gallery_type') == 'justified') {
				wp_enqueue_script('smart-blog-gallery', get_template_directory_uri() . '/js/jquery.gallery.js', array('jquery'), Bunyad::options()->get_config('theme_version'), true);
			}
			
			// Add intrinsic dimensions plugin if picturefill is enqueued by Retina2x
			if (wp_script_is('picturefill')) {
				wp_enqueue_script('smart-blog-pfid', get_template_directory_uri() . '/js/pf.intrinsic.js', array('picturefill'), Bunyad::options()->get_config('theme_version'));
			}
			
			wp_enqueue_script('smart-blog-masonry', get_template_directory_uri() . '/js/jquery.masonry.js', array('jquery'), Bunyad::options()->get_config('theme_version'));
		}
	}
	
	/**
	 * Setup the sidebars
	 */
	public function register_sidebars()
	{
	
		// register dynamic sidebar
		register_sidebar(array(
			'name' => esc_html_x('Main Sidebar', 'Admin', 'smart-blog'),
			'id'   => 'smart-blog-primary',
			'description' => esc_html_x('Widgets in this area will be shown in the default sidebar.', 'Admin', 'smart-blog'),
			'before_title' => '<h5 class="widget-title">',
			'after_title'  => '</h5>',
			'before_widget' => '<li id="%1$s" class="grid-box widget %2$s">',
			'after_widget'  => "</li>\n"
		));

		
		// register dynamic sidebar
		register_sidebar(array(
			'name' => esc_html_x('Footer Instagram', 'Admin', 'smart-blog'),
			'id'   => 'smart-blog-instagram',
			'description' => esc_html_x('Simply add a single widget using "WP Instagram Widget" plugin.', 'Admin', 'smart-blog'),
			'before_title' => '',
			'after_title'  => '',
			'before_widget' => '',
			'after_widget' => ''
		));
	}
	
	/**
	 * Setup and recommend plugins
	 */
	public function setup_plugins()
	{
		if (!is_admin()) {
			return;
		}
		
		// Load the plugin activation class and plugin updater
		require_once get_template_directory() . '/lib/vendor/tgm-activation.php';
		
		// Recommended and required plugins
		$plugins = array(
			array(
				'name'     => esc_html_x('Sphere Core', 'Admin', 'smart-blog'),
				'slug'     => 'sphere-core',
				'required' => true,
				'source'   => get_template_directory() . '/lib/vendor/plugins/sphere-core.zip', // The plugin source			
			),
		
			array(
				'name'     => esc_html_x('WP Retina 2x', 'Admin', 'smart-blog'),
				'slug'     => 'wp-retina-2x',
				'required' => false,
			),
			
			array(
				'name'     => esc_html_x('Contact Form 7', 'Admin', 'smart-blog'),
				'slug'     => 'contact-form-7',
				'required' => false,
			),
			
			array(
				'name'     => esc_html_x('Social Count Plus', 'Admin', 'smart-blog'),
				'slug'     => 'social-count-plus',
				'required' => false,
			),
			
			array(
				'name'     => esc_html_x('WP Instagram Widget', 'Admin', 'smart-blog'),
				'slug'     => 'wp-instagram-widget',
				'required' => false,
			),			
		);

		tgmpa($plugins, array('is_automatic' => true));
		
	}
			
	/**
	 * Filter callback: Add theme-specific profile fields
	 */
	public function add_profile_fields($fields)
	{
		$fields = array_merge((array) $fields, array(
			'bunyad_facebook'  => esc_html_x('Facebook URL', 'Admin', 'smart-blog'),	
			'bunyad_twitter'   => esc_html_x('Twitter URL', 'Admin', 'smart-blog'),
			'bunyad_gplus'     => esc_html_x('Google+ URL', 'Admin', 'smart-blog'),
			'bunyad_instagram' => esc_html_x('Instagram URL', 'Admin', 'smart-blog'),
			'bunyad_pinterest' => esc_html_x('Pinterest URL', 'Admin', 'smart-blog'),
			'bunyad_bloglovin' => esc_html_x('BlogLovin URL', 'Admin', 'smart-blog'),
			'bunyad_dribble'   => esc_html_x('Dribble URL', 'Admin', 'smart-blog'),
			'bunyad_linkedin'  => esc_html_x('LinkedIn URL', 'Admin', 'smart-blog'),
		));
		
		return $fields;
	}	
	
	/**
	 * Filter callback: Modify category widget for only top-level categories, if 
	 * enabled in customizer.
	 * 
	 * @param array $query
	 */
	public function category_widget_query($query)
	{
		if (!Bunyad::options()->widget_cats_parents) {
			return $query;
		}
		
		// Set to display top-level only
		$query['parent'] = 0;
		
		return $query;
	}
	
	/**
	 * Filter callback: Auto-embed video using a link
	 * 
	 * @param string $content
	 */
	public function video_auto_embed($content) 
	{
		global $wp_embed;
		
		if (!is_object($wp_embed)) {
			return $content;
		}
		
		return $wp_embed->autoembed($content);
	}
	
	/**
	 * Filter callback: Adjust dimensions for soundcloud auto-embed. A height of 
	 * width * 1.5 isn't ideal for the theme.
	 * 
	 * @param array  $dimensions
	 * @param string $url
	 * @see wp_embed_defaults()
	 */
	public function soundcloud_embed($dimensions, $url)
	{
		if (!strstr($url, 'soundcloud.com')) {
			return $dimensions;
		}
		
		$dimensions['height'] = 300;
		
		return $dimensions;
	}

	/**
	 * Filter callback: Remove unnecessary classes
	 */
	public function fix_post_class($classes = array())
	{
		// remove hentry, we use schema.org
		$classes = array_diff($classes, array('hentry'));
		
		return $classes;
	}
	
	/**
	 * Adjust content width for full-width posts
	 */
	public function content_width_fix()
	{
		global $content_width;
	
		if (Bunyad::core()->get_sidebar() == 'none') {
			$content_width = 1068;
		}
	}	

	/**
	 * Filter callback: Add custom image sizes to the editor image size selection
	 * 
	 * @param array $sizes
	 */
	public function add_image_sizes_editor($sizes) 
	{
		global $_wp_additional_image_sizes;
		
		if (empty($_wp_additional_image_sizes)) {
			return $sizes;
		}

		$images = array('smart-blog-main', 'smart-blog-main-full', 'smart-blog-grid', 'smart-blog-list-large', 'smart-blog-list-small');
		foreach ($_wp_additional_image_sizes as $id => $data) {

			if (in_array($id, $images) && !isset($sizes[$id])) {
				$sizes[$id] = esc_html_x('Theme - ', 'Admin', 'smart-blog') . ucwords(str_replace('-', ' ', $id));
			}
		}
		
		return $sizes;
	}
	
	/**
	 * Filter callback: Add a class to TinyMCE editor for our custom editor styling
	 * 
	 * @param array $settings
	 */
	public function add_editor_class($settings)
	{
		$settings['body_class'] = 'post-content';
		
		return $settings;
	}
	
	/**
	 * Filter callback: Fix pagination for home
	 */
	public function fix_grid_pagination($query)
	{
		// An extra post for the home-page
		if ($query->is_main_query() && $query->is_home() && !$query->is_paged()) {
			$query->set('posts_per_page', get_option('posts_per_page') + 1);
		}
		
		return $query;
	}
	
	
	/**
	 * Filter callback: Fix search by limiting to posts
	 * 
	 * @param object $query
	 */
	public function limit_search($query)
	{
		if (!$query->is_search OR !$query->is_main_query()) {
			return $query;
		}

		// ignore if on bbpress and woocommerce - is_woocommerce() cause 404 due to using get_queried_object()
		if (is_admin() OR (function_exists('is_bbpress') && is_bbpress()) OR (function_exists('is_shop') && is_shop())) {
			return $query;
		}
		
		// limit it to posts
		$query->set('post_type', 'post');
		
		return $query;
	}
	
	/**
	 * Adjust comment form fields order 
	 * 
	 * @param array $fields
	 */
	public function comment_form_order($fields)
	{

		// From Justin Tadlock's plugin
		if (isset($fields['comment'])) {
			
			// Grab the comment field.
			$comment_field = $fields['comment'];
			
			// Remove the comment field from its current position.
			unset($fields['comment']);
			
			// Put the comment field at the end.
			$fields['comment'] = $comment_field;
		}
		
		return $fields;
	}
}