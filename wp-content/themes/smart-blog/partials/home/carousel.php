<?php
/**
 * Partial Template: Home Carousel to be shown above footer
 */
	
$args = array('posts_per_page' => Bunyad::options()->home_carousel_posts, 'ignore_sticky_posts' => 1);

if (Bunyad::options()->home_carousel_type == 'liked') {
	$args = array_merge($args, array(
		 'meta_key' => '_sphere_user_likes_count', 'orderby' => 'meta_value'
	));
}

$tags = trim(Bunyad::options()->home_carousel_tag);
if ($tags) {
	$args['tag_slug__in'] = array_map('trim', explode(',', $tags));
}

// Setup the home carousel query
$query = new WP_Query($args);

?>
	
	<section class="posts-carousel">
				
			<h4 class="heading common-heading"><?php echo esc_html(Bunyad::options()->home_carousel_title); ?></h4>
			
			<div class="the-carousel">
			
				<div class="posts">
				
				<?php while ($query->have_posts()): $query->the_post(); ?>
				
					<article class="grid-box post" itemscope itemtype="http://schema.org/Article">
								
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="image-link" itemprop="url">
							<?php
								the_post_thumbnail(
									(Bunyad::core()->get_sidebar() == 'none' ? 'smart-blog-main' : 'post-thumbnail'), // use larger image when no sidebar
									array('class' => 'image', 'title' => strip_tags(get_the_title()), 'itemprop' => 'image')
								); 
							?>
						</a>
						
						<div class="content">
							
							<h3 class="post-title" itemprop="name headline"><a href="<?php the_permalink(); ?>" class="post-link"><?php the_title(); ?></a></h3>
				
							<?php get_template_part('partials/post-meta'); ?>
							
						</div>
				
					</article >
					
				<?php endwhile; wp_reset_postdata(); ?>
				
				</div>
				
				<div class="navigate"></div>
				
			</div>

	</section>