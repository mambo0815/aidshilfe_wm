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
	
	<section class="main-slider common-slider wrap">
		<div class="slides" data-autoplay="<?php echo esc_attr(Bunyad::options()->slider_autoplay); ?>" data-speed="<?php 
			echo esc_attr(Bunyad::options()->slider_delay); ?>" data-animation="<?php echo esc_attr(Bunyad::options()->slider_animation); ?>">
		
			<?php while ($query->have_posts()): $query->the_post(); ?>
		
				<div>
					<a href="<?php the_permalink(); ?>"><?php 
						the_post_thumbnail('smart-blog-main-full', array('alt' => strip_tags(get_the_title()), 'title' => '')); 
					?></a>
				</div>
				
			<?php endwhile; $query->rewind_posts(); ?>
		</div>
		
		<div class="slider-nav cf">
		
			<?php while ($query->have_posts()): $query->the_post(); ?>
			
				<div class="column col-4 post">
					
					<h2 class="post-heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					
					<?php get_template_part('partials/post-meta'); ?>
					
				</div>
			
			<?php endwhile; ?>

		</div>
	</section>
	
	<?php wp_reset_postdata(); ?>