<?php

/**
 * Register Social Count Plus widget
 * 
 * Modifications for "Social Count Plus" and is only registered when the plugin
 * is active.
 */
class Bunyad_SocialCount_Widget extends WP_Widget 
{

	public $services;
	
	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'bunyad-social-count-plus',
			esc_html_x('SmartBlog - Social Follow', 'Admin', 'smart-blog'),
			array('description' => esc_html_x( 'Social followers counters configured in Settings > Social Count Plus.', 'Admin', 'smart-blog'))
		);
		
		/**
		 * Setup an array of services and their associate URL, label and icon
		 */
		$this->services = array(
			'googleplus' => array('url' => 'https://plus.google.com/%', 'key' => 'googleplus_id', 'label' => esc_html__('Google+', 'smart-blog'), 'icon' => 'gplus'),
			'comments'   => array('url' => '%', 'key' => 'comments_url', 'icon' => 'comment'),
			'facebook'   => array('url' => 'https://www.facebook.com/%', 'key' => 'facebook_id', 'icon' => 'facebook-squared'),
			'github'     => array('url' => 'https://github.com/%', 'key' => 'github_username', 'icon' => 'github'),
			'instagram'  => array('url' => 'https://instagram.com/%', 'key' => 'instagram_username', 'icon' => 'instagram'),
			'linkedin'   => array('url' => 'https://www.linkedin.com/company/%', 'key' => 'linkedin_company_id', 'icon' => 'linkedin'),
			'pinterest'  => array('url' => 'https://www.pinterest.com/%', 'key' => 'pinterest_username', 'icon' => 'pinterest'),
			'posts'      => array('url' => '%', 'key' => 'posts_url', 'icon' => 'newspaper'),
			'soundcloud' => array('url' => 'https://soundcloud.com/%', 'key' => 'soundcloud_username', 'icon' => 'soundcloud'),
			'steam'      => array('url' => 'https://steamcommunity.com/groups/%', 'key' => 'steam_group_name', 'icon' => 'steam'),
			'tumblr'     => array('url' => '%', 'key' => 'tumblr_hostname', 'icon' => 'tumblr'),
			'twitch'     => array('url' => 'http://www.twitch.tv/%/profile', 'key' => 'twitch_username', 'icon' => 'twitch'),
			'twitter'    => array('url' => 'https://twitter.com/%', 'key' => 'twitter_user', 'icon' => 'twitter'),
			'users'      => array('url' => '%', 'key' => 'users_url', 'icon' => 'users'),
			'vimeo'      => array('url' => 'https://vimeo.com/%', 'key' => 'vimeo_username', 'icon' => 'vimeo'),
			'youtube'    => array('url' => '%', 'key' => 'youtube_url', 'icon' => 'youtube')
		);
	}

	/**
	 * Register the widget if the plugin is active
	 */
	public function register_widget() {
		
		if (!class_exists('Social_Count_Plus_Generator')) {
			return;
		}
		
		register_widget(__CLASS__);
	}
	
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget($args, $instance) 
	{
		$title = apply_filters('widget_title', esc_html($instance['title']));

		echo $args['before_widget'];

		if (!empty($title)) {
			
			echo $args['before_title'] . wp_kses_post($title) . $args['after_title']; // before_title/after_title are built-in WordPress sanitized
		}

		$this->show_counters();

		echo $args['after_widget'];
	}
	
	/**
	 * Show counters for social count plus widget
	 * 
	 * @see Social_Count_Plus_View::get_view()
	 */
	public function show_counters()
	{
		if (!class_exists('Social_Count_Plus_Generator')) {
			return;
		}

		$settings = get_option('socialcountplus_settings');
		$design   = get_option('socialcountplus_design');
		$count    = Social_Count_Plus_Generator::get_count();
		$icons    = isset($design['icons']) ? array_map('sanitize_key', explode(',', $design['icons'])) : array();
		
		?>
		
		<ul class="social-follow">
			<?php 
			foreach ($icons as $icon):
				$class = 'social_count_plus_' . $icon . '_counter';
				if (!class_exists($class) OR !isset($count[$icon]) OR !isset($this->services[$icon])) {
					continue;
				}
				
				$service = $this->services[$icon];
				
				// Set url, label and 
				$url   = $this->get_url($service, $settings);
				$label = !empty($this->services[$icon]['label']) ? $this->services[$icon]['label'] : $icon;
			?>
			
				<li class="counter">
					<a href="<?php echo esc_url($url); ?>" class="service">
						<i class="icon icon-<?php echo esc_attr($service['icon']); ?>"></i>
						<?php if ($count[$icon] > 0): ?>
							<span class="count"><?php echo esc_html($this->readable_number($count[$icon])); ?></span>
						<?php endif; ?>
						<span class="label"><?php echo esc_html($label); ?></span>
						<span class="plus">+</span>
					</a>
					
				</li>
			
			<?php 
			endforeach; 
			?>
		</ul>
		
		<?php
	}
	
	/**
	 * Get URL form settings
	 * 
	 * @param array  $service
	 * @param array  $settings
	 */
	public function get_url($service, $settings) 
	{
		// Get the URL or username from settings/
		$value   = !empty($settings[ $service['key'] ]) ? $settings[ $service['key'] ] : '';
			
		return str_replace('%', $value, $service['url']);	
	}

	/**
	 * Make count more human in format 1.4K, 1.5M etc.
	 * 
	 * @param integer $number
	 */
	public function readable_number($number)
	{
		if ($number < 1000) {
			return $number;
		}

		if ($number < 10^6) {
			return round($number / 1000, 1) . 'K';
		}
		
		return round($number / 10^6, 1) . 'M';
	}
		

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form($instance) 
	{
		if (isset($instance['title'])) {
			$title = $instance['title'];
		} else {
			$title = '';
		}

		printf(
			'<p><label for="%1$s">%2$s: <input class="widefat" id="%1$s" name="%3$s" type="text" value="%4$s" /></label></p>', 
			esc_attr($this->get_field_id('title')), 
			esc_html_x('Title', 'Admin', 'smart-blog'), 
			esc_attr($this->get_field_name('title')), 
			esc_attr($title)
		);
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update($new_instance, $old_instance) 
	{
		$instance = array();
		$instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';

		return $instance;
	}
}
