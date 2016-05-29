<?php

/**
 * Widget to show posts in a list format in sidebar
 */
class Bunyad_Posts_Widget extends WP_Widget
{
	/**
	 * Setup the widget
	 * 
	 * @see WP_Widget::__construct()
	 */
	public function __construct()
	{
		parent::__construct(
			'bunyad-posts-widget',
			esc_html_x('SmartBlog - Posts List', 'Admin', 'smart-blog'),
			array('description' => esc_html_x('Popular Posts/Latest Posts widget for sidebar.', 'Admin', 'smart-blog'), 'classname' => 'widget-posts')
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
		
		// Setup the query
		$query_args  = array('posts_per_page' => $instance['number'], 'ignore_sticky_posts' => 1);
		
		if ($instance['type'] == 'popular') {
			$query_args = array_merge($query_args, array('orderby' => 'comment_count'));
		}
		
		$query = new WP_Query($query_args);
		
		?>

		<?php echo $args['before_widget']; ?>
		
			<?php if (!empty($title)): ?>
				
				<?php
					echo $args['before_title'] . wp_kses_post($title) . $args['after_title']; // before_title/after_title are built-in WordPress sanitized
				?>
				
			<?php endif; ?>
			
			<ul class="posts-list list-<?php echo esc_attr($instance['style']); ?>">
			<?php  while ($query->have_posts()) : $query->the_post(); ?>
				<li class="post cf">
				
					<a href="<?php the_permalink() ?>" class="image-link">
						<?php 
							the_post_thumbnail(	
								($instance['style'] == 'large' ? 'post-thumbnail' : 'smart-blog-thumb'), 
								array('title' => strip_tags(get_the_title())
							)); 
						?>
					</a>
					
					<div class="content">
					
						<a href="<?php the_permalink(); ?>" class="title-link"><?php the_title(); ?></a>
							
						<?php if ($instance['style'] == 'large'): ?>
							<div class="excerpt"><?php echo Bunyad::posts()->excerpt(null, 15, array('add_more' => false)); ?></div>
						<?php endif; ?>
						
						<?php get_template_part('partials/post-meta'); ?>
					</div>
				
				</li>
			<?php endwhile; wp_reset_postdata(); ?>
			</ul>
		
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
			$new[$key] = wp_kses_post($val);
		}
		
		return $new;
	}
	
	/**
	 * The widget form
	 */
	public function form($instance)
	{
		$defaults = array('title' => '', 'type' => '', 'number' => 4, 'style' => 'thumbs');
		$instance = array_merge($defaults, (array) $instance);
		extract($instance);
		
		?>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php echo esc_html_x('Title:', 'Admin', 'smart-blog'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php 
				echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('type')); ?>"><?php echo esc_html_x('Show:', 'Admin', 'smart-blog'); ?></label>
			
			<select id="<?php echo esc_attr($this->get_field_id('type')); ?>" name="<?php echo esc_attr($this->get_field_name('type')); ?>" class="widefat">
				<option value="" <?php selected($type, ''); ?>><?php echo esc_html_x('Latest Posts', 'Admin', 'smart-blog') ?></option>
				<option value="popular" <?php selected($type, 'popular'); ?>><?php echo esc_html_x('Popular Posts', 'Admin', 'smart-blog'); ?></option>
			</select>
			
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php echo esc_html_x('Number of posts to show:', 'Admin', 'smart-blog'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php 
				echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('style')); ?>"><?php echo esc_html_x('Style:', 'Admin', 'smart-blog'); ?></label>
			
			<select id="<?php echo esc_attr($this->get_field_id('style')); ?>" name="<?php echo esc_attr($this->get_field_name('style')); ?>" class="widefat">
				<option value="large" <?php selected($style, 'large'); ?>><?php echo esc_html_x('Large Thumbnails', 'Admin', 'smart-blog') ?></option>
				<option value="small" <?php selected($style, 'small'); ?>><?php echo esc_html_x('Small Thumbnails', 'Admin', 'smart-blog'); ?></option>
			</select>
		</p>
	
	
		<?php
	}
}