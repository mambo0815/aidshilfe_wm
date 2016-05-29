<?php
/**
 * Partial: Slider for the featured area
 */

// Get latest featured posts
$args = array('order' => 'date', 'posts_per_page' => Bunyad::options()->slider_posts, 'ignore_sticky_posts' => 1);

$tags = trim(Bunyad::options()->slider_tag);
if ($tags) {
	$args['tag_slug__in'] = array_map('trim', explode(',', $tags));
}

$query = new WP_Query(apply_filters('bunyad_slider_args', $args));

// No posts to show? Quit.
if (!$query->have_posts()) {
	return;
}

?>
	
	<section class="main-slider alt-slider common-slider wrap">
		<div class="slides" data-autoplay="<?php echo esc_attr(Bunyad::options()->slider_autoplay); ?>" data-speed="<?php 
			echo esc_attr(Bunyad::options()->slider_delay); ?>" data-animation="<?php echo esc_attr(Bunyad::options()->slider_animation); ?>">
		
			<?php while ($query->have_posts()): $query->the_post(); ?>
		
				<div>
					<a href="<?php the_permalink(); ?>"><?php 
						the_post_thumbnail('smart-blog-slider-alt', array('alt' => strip_tags(get_the_title()), 'title' => '')); 
					?></a>
					
					<div class="overlay cf">

						<?php get_template_part('partials/post-meta'); ?>					

						<h2 class="common-heading post-heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						
						<a href="<?php the_permalink(); ?>" class="button"><?php esc_html_e('Keep Reading', 'smart-blog'); ?></a>	
			
					</div>
					
				</div>
				
			<?php endwhile; ?>
		</div>
		
		<div class="dot-nav"></div>

	</section>
	
	<?php wp_reset_postdata(); ?>