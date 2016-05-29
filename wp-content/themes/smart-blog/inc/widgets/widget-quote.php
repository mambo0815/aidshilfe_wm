<?php

class Bunyad_Quote_Widget extends WP_Widget
{
	/**
	 * Setup the widget
	 * 
	 * @see WP_Widget::__construct()
	 */
	public function __construct()
	{
		parent::__construct(
			'bunyad-widget-quote',
			esc_html_x('SmartBlog - Quote Widget', 'Admin', 'smart-blog'),
			array('description' => esc_html_x('Add a styled quote.', 'Admin', 'smart-blog'), 'classname' => 'widget-quote')
		);
	}
	
	/**
	 * Widget output 
	 * 
	 * @see WP_Widget::widget()
	 */
	public function widget($args, $instance)
	{
		
		$instance['button_link'] = (!empty($instance['button_link']) ? $instance['button_link'] : '#');
		$title = apply_filters('widget_title', esc_html($instance['title']));
		
		// Add a link to the title
		if (!empty($instance['button_link'])) {
			$args['after_title'] = '<a href="' . esc_url($instance['button_link']) .'" class="more-link"><i class="icon icon-arrow-next"></i></a>' . $args['after_title'];
		}
		
		?>

		<?php echo $args['before_widget']; ?>
		
			<?php
				echo $args['before_title'] . esc_html($title) . $args['after_title']; // before_title/after_title are built-in WordPress sanitized
			?>
			
			<div class="content">
				<div class="quote-text"><?php echo wp_kses_post(apply_filters('bunyad_text_weight', $instance['text'])); ?></div>
				<span class="byline"><?php echo esc_html($instance['author']); ?></span>
					
					<?php if (!empty($instance['button_text'])): ?>
						<a href="<?php echo esc_url($instance['button_link']); ?>" class="button"><?php echo esc_html($instance['button_text']); ?></a>
					<?php endif; ?>
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
		$defaults = array('title' => 'Quote of the day', 'text' => '', 'author' => '', 'button_link' => '');
		$instance = array_merge($defaults, (array) $instance);
		
		extract($instance);
		?>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php echo esc_html_x('Title:', 'Admin', 'smart-blog'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php 
				echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>

		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('text')); ?>"><?php echo esc_html_x('Quote:', 'Admin', 'smart-blog'); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php 
				echo esc_attr($this->get_field_name('text')); ?>" rows="5"><?php echo esc_textarea($text); ?></textarea>
		</p>

		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('author')); ?>"><?php echo esc_html_x('Author:', 'Admin', 'smart-blog'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('author')); ?>" name="<?php 
				echo esc_attr($this->get_field_name('author')); ?>" type="text" value="<?php echo esc_attr($author); ?>" />
		</p>
		
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('button_link')); ?>"><?php echo esc_html_x('More Link (Optional):', 'Admin', 'smart-blog'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('button_link')); ?>" name="<?php 
				echo esc_attr($this->get_field_name('button_link')); ?>" type="text" value="<?php echo esc_attr($button_link); ?>" />
		</p>
	
	
		<?php
	}
}