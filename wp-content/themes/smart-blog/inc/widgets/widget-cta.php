<?php

class Bunyad_Cta_Widget extends WP_Widget
{
	/**
	 * Setup the widget
	 * 
	 * @see WP_Widget::__construct()
	 */
	public function __construct()
	{
		parent::__construct(
			'bunyad-widget-cta',
			esc_html_x('SmartBlog - Call To Action', 'Admin', 'smart-blog'),
			array('description' => esc_html_x('Add an image with text and button to promote content.', 'Admin', 'smart-blog'), 'classname' => 'widget-cta')
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
		
		$instance['button_link'] = (!empty($instance['button_link']) ? $instance['button_link'] : '#');
		
		?>

		<?php echo $args['before_widget']; ?>
		
			<?php if (!empty($instance['image'])): ?>
				
				<div class="cta-image"><img src="<?php echo esc_url($instance['image']); ?>" alt="<?php echo esc_attr($instance['text']); ?>" /></div>
				
			<?php endif; ?>
			
			<div class="content cf">
				<span class="message"><?php echo apply_filters('bunyad_text_weight', esc_html($instance['text'])); ?></span>
				
				<?php if (!empty($instance['button_text'])): ?>
					<a href="<?php echo esc_url($instance['button_link']); ?>" class="button"><?php echo esc_html($instance['button_text']); ?></a>
				
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
		$defaults = array('text' => '', 'image' => '', 'button_text' => '', 'button_link' => '');
		$instance = array_merge($defaults, (array) $instance);
		
		extract($instance);
		?>
		
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('image')); ?>"><?php echo esc_html_x('Image URL:', 'Admin', 'smart-blog'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('image')); ?>" name="<?php 
				echo esc_attr($this->get_field_name('image')); ?>" type="text" value="<?php echo esc_attr($image); ?>" />
			<small><?php echo esc_html_x('Add an image for call to action. Recommended size: 370px.', 'Admin', 'smart-blog'); ?></small>
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('text')); ?>"><?php echo esc_html_x('Message:', 'Admin', 'smart-blog'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php 
				echo esc_attr($this->get_field_name('text')); ?>" type="text" value="<?php echo esc_attr($text); ?>" />
		</p>

		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('button_text')); ?>"><?php echo esc_html_x('Button Text (Optional):', 'Admin', 'smart-blog'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('button_text')); ?>" name="<?php 
				echo esc_attr($this->get_field_name('button_text')); ?>" type="text" value="<?php echo esc_attr($button_text); ?>" />
		</p>
		
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('button_link')); ?>"><?php echo esc_html_x('Button Link (Optional):', 'Admin', 'smart-blog'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('button_link')); ?>" name="<?php 
				echo esc_attr($this->get_field_name('button_link')); ?>" type="text" value="<?php echo esc_attr($button_link); ?>" />
		</p>
	
	
		<?php
	}
}