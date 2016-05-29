<?php
/**
 * Partial: Related Posts
 */
?>

<?php if (is_single() && Bunyad::options()->related_posts): 

		$related = Bunyad::posts()->get_related(6);
		
		if (!$related) {
			return;
		}
?>

<section class="related-posts">
	<h4 class="heading common-heading"><?php esc_html_e('Related Articles', 'smart-blog'); ?></h4> 
	
	<div class="navigate"></div>
	
	<div class="posts">
	
	<?php foreach ($related as $post): setup_postdata($post); ?>
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
		
	<?php endforeach; wp_reset_postdata(); ?>
	
	</div>
	
</section>

<?php endif; ?>