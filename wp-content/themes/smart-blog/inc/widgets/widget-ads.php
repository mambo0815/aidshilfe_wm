<?php

class Bunyad_Ads_Widget extends WP_Widget
{
	/**
	 * Setup the widget
	 * 
	 * @see WP_Widget::__construct()
	 */
	public function __construct()
	{
		parent::__construct(
			'bunyad-widget-ads',
			esc_html_x('SmartBlog - Advertisement', 'Admin', 'smart-blog'),
			array('description' => esc_html_x('Add advertisement code to your sidebar.', 'Admin', 'smart-blog'), 'classname' => 'widget-ads')
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

			<?php if (!empty($title)): ?>
				
				<?php
					echo $args['before_title'] . wp_kses_post($title) . $args['after_title']; // before_title/after_title are built-in WordPress sanitized
				?>
				
			<?php endif; ?>
			
			<div class="adwrap-widget">
				<?php echo do_shortcode($instance['ad_code']); // It's ad code - we shouldn't be escaping it ?>
			</div>

		
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
		$defaults = array('title' => '', 'ad_code' => '');
		$instance = array_merge($defaults, (array) $instance);
		
		extract($instance);

		?>
		

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('ad_code')); ?>"><?php echo esc_html_x('Ad Code:', 'Admin', 'smart-blog'); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('ad_code')); ?>" name="<?php 
				echo esc_attr($this->get_field_name('ad_code')); ?>" rows="5"><?php echo esc_textarea($ad_code); ?></textarea>
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php echo esc_html_x('Title: (Optional)', 'Admin', 'smart-blog'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php 
				echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>		
	
	
		<?php
	}
}