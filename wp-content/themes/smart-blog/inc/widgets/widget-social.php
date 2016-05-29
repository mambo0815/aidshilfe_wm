<?php
/**
 * Social Icons Widget
 */
class Bunyad_Social_Widget extends WP_Widget 
{

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() 
	{
		parent::__construct(
			'bunyad-widget-social',
			esc_html_x('SmartBlog - Social Icons', 'Admin', 'smart-blog'),
			array('description' => esc_html_x('Social icons widget.', 'Admin', 'smart-blog'),  'classname' => 'widget-social')
		);
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
		// No icons to show?
		if (empty($instance['social'])) {
			return;
		}
		
		echo $args['before_widget'];
		
		?>
		
		<div class="cf">
			<div class="title"><?php echo esc_html($instance['title']); ?></div>
			
			<div class="social-icons<?php echo (count($instance['social']) > 4 ? ' collapse' : ''); ?>">
				
				<?php 
				
				/**
				 * Show Social icons
				 */
				$services = Bunyad::get('social')->get_services();
				$links    = Bunyad::options()->social_profiles;
				
				foreach ( (array) $instance['social'] as $icon):
					$social = $services[$icon];
					$url    = !empty($links[$icon]) ? $links[$icon] : '#';
				?>
					<a href="<?php echo esc_url($url); ?>" class="social-link"><i class="icon icon-<?php echo esc_attr($social['icon']); ?>"></i>
						<span class="visuallyhidden"><?php echo esc_html($social['label']); ?></span></a>
				
				<?php
				endforeach;
				?>
				
			</div>	
		</div>
		
		<?php

		echo $args['after_widget'];
	}
	
	/**
	 * Save widget.
	 * 
	 * Strip out all HTML using wp_kses
	 * 
	 * @see wp_kses_post()
	 */
	public function update($new, $old)
	{
		foreach ($new as $key => $val) {

			// Social just needs intval
			if ($key == 'social') {
				
				array_walk($val, 'intval');
				$new[$key] = $val;

				continue;
			}
			
			// Filter disallowed html 			
			$new[$key] = wp_kses_post($val);
		}
		
		return $new;
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
		$defaults = array('title' => '', 'social' => array());
		$instance = array_merge($defaults, (array) $instance);
		
		extract($instance);
				
		$icons = array(
			'facebook'  => esc_html_x('Facebook', 'Admin', 'smart-blog'),
			'twitter'   => esc_html_x('Twitter', 'Admin', 'smart-blog'),
			'pinterest' => esc_html_x('Pinterest', 'Admin', 'smart-blog'),
			'instagram' => esc_html_x('Instagram', 'Admin', 'smart-blog'),
			'bloglovin' => esc_html_x('BlogLovin', 'Admin', 'smart-blog'),
			'rss'       => esc_html_x('RSS', 'Admin', 'smart-blog'),
			'gplus'     => esc_html_x('Google Plus', 'Admin', 'smart-blog'),
			'youtube'   => esc_html_x('Youtube', 'Admin', 'smart-blog'),
			'dribbble'  => esc_html_x('Dribbble', 'Admin', 'smart-blog'),
			'tumblr'    => esc_html_x('Tumblr', 'Admin', 'smart-blog'),
			'linkedin'  => esc_html_x('LinkedIn', 'Admin', 'smart-blog'),
			'flickr'    => esc_html_x('Flickr', 'Admin', 'smart-blog'),
			'soundcloud' => esc_html_x('SoundCloud', 'Admin', 'smart-blog'),
			'vimeo'     => esc_html_x('Vimeo', 'Admin', 'smart-blog'), 
		);
		
		?>
		
		<p><?php echo esc_html_x('For best appearance, choose 4 icons.', 'Admin', 'smart-blog'); ?></p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php echo esc_html_x('Title:', 'Admin', 'smart-blog'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php 
				echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		
		<div>
			<label for="<?php echo esc_attr($this->get_field_id('social')); ?>"><?php echo esc_html_x('Social Icons:', 'Admin', 'smart-blog'); ?></label>
			
			<?php foreach ($icons as $icon => $label): ?>
			
				<p>
					<label>
						<input class="widefat" type="checkbox" name="<?php echo esc_attr($this->get_field_name('social')); ?>[]" value="<?php echo esc_attr($icon); ?>"<?php 
						echo (in_array($icon, $social) ? ' checked' : ''); ?> /> 
					<?php echo esc_html($label); ?></label>
				</p>
			
			<?php endforeach; ?>
			
			<p><small><?php echo esc_html_x('Configure URLs from Customizer > General Settings > Social Media Links.', 'Admin', 'smart-blog'); ?></small></p>
			
		</div>
	
	
		<?php
	}
}
