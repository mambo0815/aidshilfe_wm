<?php

/**
 * Content Template is used for every post format and used on single posts
 * 
 * It is also used on archives called via loop.php
 */

?>

<article <?php
	// Setup article attributes
	Bunyad::markup()->attribs('post-wrapper', array(
		'id'        => 'post-' . get_the_ID(),
		'class'     => join(' ', get_post_class('the-post grid-box')),
		'itemscope' => '', 
		'itemtype'  => 'http://schema.org/Article',
		'data-gallery' => Bunyad::posts()->meta('gallery_type'), 
	)); ?>>
	
	<header class="post-header cf">
		<?php if (!Bunyad::posts()->meta('featured_disable')): ?>
		
		<div class="featured">
		
			<?php if (get_post_format() == 'gallery'): // get gallery template ?>
			
				<?php get_template_part('partials/gallery-format'); ?>
				
			<?php elseif (Bunyad::posts()->meta('featured_video')): // featured video available? ?>
			
				<div class="featured-vid">
					<?php echo apply_filters('bunyad_featured_video', esc_html(Bunyad::posts()->meta('featured_video'))); ?>
				</div>
				
			<?php elseif (has_post_thumbnail()): ?>
			
				<?php 
					/**
					 * Normal featured image when no post format
					 */
					$caption = get_post(get_post_thumbnail_id())->post_excerpt;
					$url     = get_permalink();
					
					// On single page? Link to image
					if (is_single()):
						$url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); 
						$url = $url[0];
					endif;
					
					// Which image?
					if (!Bunyad::options()->featured_crop) {
						$image = 'large';
					}
					else if (Bunyad::core()->get_sidebar() == 'none') {
						$image = 'smart-blog-main-full';
					}
					else {
						$image = 'smart-blog-main';
					}
				
				?>
			
				<a href="<?php echo esc_url($url); ?>" itemprop="image" class="image-link"><?php the_post_thumbnail(
						$image,  // larger image if no sidebar
						array('title' => strip_tags(get_the_title()))
					); ?>
				</a>
				
				<?php if (!empty($caption)): // have caption ? ?>
						
					<div class="image-caption"><?php echo wp_kses_post($caption); ?></div>
						
				<?php endif;?>
				
			<?php endif; // normal featured image ?>
		</div>
		
		<?php endif; // featured check ?>

		<?php 
			/**
			 * Set h1 tag on single post page
			 */
			$tag = 'h1';
			
			if (!is_single() OR is_front_page()) {
				$tag = 'h2';
			}
		?>

		<<?php echo esc_attr($tag); ?> class="post-title" itemprop="name headline">
		
		<?php 
			if (is_single()): 
				the_title(); 
			else: ?>
		
			<a href="<?php the_permalink(); ?>" rel="bookmark" class="post-title-link"><?php the_title(); ?></a>
				
		<?php endif;?>
		
		</<?php echo esc_attr($tag); ?>>
		
	</header><!-- .post-header -->
	
	<?php get_template_part('partials/post-meta'); ?>

	<div <?php 
		Bunyad::markup()->attribs('post-content', array(
			'class' => 'post-content description cf',
			'itemprop' => 'articleBody')); 
		?>>
		
		<?php

		// Excerpts or main content?
		if (is_single() OR Bunyad::options()->post_body == 'full'):

			/**
			 * A wrapper for the_content() for some of our magic.
			 * 
			 * Note: the_content filter is applied.
			 * 
			 * @see the_content()
			 */
			Bunyad::posts()->the_content(null, false);
			
		else:
		
			// Show the excerpt,  always add Keep Reading button (more button), and respect <!--more--> (teaser) 
			echo Bunyad::posts()->excerpt(null, Bunyad::options()->post_excerpt_blog, array('force_more' => true, 'use_teaser' => true));
		
		endif;
		
		?>
		
		<?php if (!is_single()): // Post counters for archives and listing ?>
			
			<?php get_template_part('partials/content/social-share'); ?>
		
		<?php endif; ?>
			
	</div><!-- .post-content -->

	
	<?php if (is_single()): // Single post ?>
		
	<div class="post-footer cf">
	
		<?php 
			wp_link_pages(array(
				'before' => '<div class="page-links post-pagination">', 
				'after' => '</div>', 
				'link_before' => '<span>',
				'link_after' => '</span>'
			));
		?>
	
		
		<div class="tag-share cf">
		
			<?php if (Bunyad::options()->single_tags): ?>

			<div class="post-tags"><?php the_tags('<span class="text">' . esc_html__('Tags: ', 'smart-blog') . '</span>', ''); ?></div>
			
			<?php endif; ?>
		
			<?php get_template_part('partials/content/social-share-single'); ?>
				
		</div>

		<?php if (Bunyad::options()->author_box): ?>
		
			<?php get_template_part('partials/author-box'); ?>
			
		<?php endif; ?>
		
	</div>

	<?php endif; ?>
	
		
</article> <!-- .the-post -->

<?php

// Related posts template 
get_template_part('partials/content/related-posts');
