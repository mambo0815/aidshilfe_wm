<?php
/**
 * About Me Widget
 */
class Bunyad_About_Widget extends WP_Widget
{
	/**
	 * Setup the widget
	 * 
	 * @see WP_Widget::__construct()
	 */
	public function __construct()
	{
		parent::__construct(
			'bunyad-widget-about',
			esc_html_x('SmartBlog - About Widget', 'Admin', 'smart-blog'),
			array('description' => esc_html_x('"About" widget suitable for sidebar.', 'Admin', 'smart-blog'), 'classname' => 'widget-about')
		);
	}
	
	/**
	 * Widget output 
	 * 
	 * @see WP_Widget::widget()
	 */
	public function widget($args, $instance)
	{
		extract($args);
		$title = apply_filters('widget_title', esc_html($instance['title']));
		
		?>

		<?php echo $args['before_widget']; ?>
		
			<?php if (!empty($instance['image'])): ?>
				
				<div class="author-image"><img src="<?php echo esc_url($instance['image']); ?>" alt="<?php esc_attr_e('About Me', 'smart-blog'); ?>" /></div>
				
			<?php endif; ?>
		
			<?php if (!empty($title)): ?>
				
				<?php
					echo $args['before_title'] . wp_kses_post($title) . $args['after_title']; // before_title/after_title are built-in WordPress sanitized
				?>
				
			<?php endif; ?>
			
			<div class="subtitle"><?php echo esc_html($instance['subtitle']); ?></div>
			
			<div class="about-text"><?php echo wp_kses_post(
				do_shortcode(apply_filters('shortcode_cleanup', wpautop($instance['text']))
			)); ?></div>
			
			<?php if (!empty($instance['read_more']) OR !empty($instance['social'])): ?>
			
			<div class="about-footer cf">
				
				<?php if (!empty($instance['read_more'])): ?>
					<a href="<?php echo esc_url($instance['read_more']); ?>" class="more"><?php esc_html_e('Read More', 'smart-blog'); ?></a>
				<?php endif; ?>
				
				<?php if (!empty($instance['social'])): ?>
				
					<div class="social-icons">
					
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
				
				<?php endif; ?>
				
			</div>
			
			<?php endif; ?>
		
		<?php echo $args['after_widget']; ?>
		
		<?php
	}
	
	/**
	 * Save widget
	 * 
	 * Strip out all HTML using wp_kses
	 * 
	 * @see wp_filter_post_kses()
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
	 * The widget form
	 */
	public function form($instance)
	{
		$defaults = array('title' => 'About', 'image' => '', 'text' => '', 'logo_text' => '', 'subtitle' => '', 'read_more' => '', 'social' => array());
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
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php echo esc_html_x('Title:', 'Admin', 'smart-blog'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php 
				echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>

		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('subtitle')); ?>"><?php echo esc_html_x('Sub Title:', 'Admin', 'smart-blog'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('subtitle')); ?>" name="<?php 
				echo esc_attr($this->get_field_name('subtitle')); ?>" type="text" value="<?php echo esc_attr($subtitle); ?>" />
			<small><?php echo esc_html_x('Example: Photography Enthusiast', 'Admin', 'smart-blog'); ?></small>
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('text')); ?>"><?php echo esc_html_x('About:', 'Admin', 'smart-blog'); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php 
				echo esc_attr($this->get_field_name('text')); ?>" rows="5"><?php echo esc_textarea($text); ?></textarea>
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('image')); ?>"><?php echo esc_html_x('Image URL: (optional)', 'Admin', 'smart-blog'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('image')); ?>" name="<?php 
				echo esc_attr($this->get_field_name('image')); ?>" type="text" value="<?php echo esc_attr($image); ?>" />
			<small><?php echo esc_html_x('You can add an image above title. Recommended size: 370px.', 'Admin', 'smart-blog'); ?></small>
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('read_more')); ?>"><?php echo esc_html_x('Read More Link: (optional)', 'Admin', 'smart-blog'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('read_more')); ?>" name="<?php 
				echo esc_attr($this->get_field_name('read_more')); ?>" type="text" value="<?php echo esc_attr($read_more); ?>" />
		</p>
		
		<div>
			<label for="<?php echo esc_attr($this->get_field_id('social')); ?>"><?php echo esc_html_x('Social Icons: (optional)', 'Admin', 'smart-blog'); ?></label>
			
			<?php foreach ($icons as $icon => $label): ?>
			
				<p>
					<label>
						<input class="widefat" type="checkbox" name="<?php echo esc_attr($this->get_field_name('social')); ?>[]" value="<?php echo esc_attr($icon); ?>"<?php 
						echo (in_array($icon, $social) ? ' checked' : ''); ?> /> 
					<?php echo esc_html($label); ?></label>
				</p>
			
			<?php endforeach; ?>
		</div>
	
	
		<?php
	}
}