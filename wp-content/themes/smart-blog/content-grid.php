<?php
/**
 * Content Template is used for every post format and used on single posts
 * 
 * It is also used on archives called via loop.php
 */

$image = 'smart-blog-grid';
if (Bunyad::registry()->grid_cols == 2 && Bunyad::core()->get_sidebar() == 'none') {
	$image = 'smart-blog-main';
}

?>

<article <?php
	// hreview has to be first class because of rich snippet classes limit 
	Bunyad::markup()->attribs('grid-post-wrapper', array(
		'id'        => 'post-' . get_the_ID(),
		'class'     => join(' ', get_post_class('grid-post small-post grid-box')),
		'itemscope' => '', 
		'itemtype'  => 'http://schema.org/Article'
	)); ?>>
	
	<div class="post-header cf">
			
		<a href="<?php echo esc_url(get_permalink()); ?>" itemprop="image" class="image-link"><?php the_post_thumbnail(
					$image,
					array('title' => strip_tags(get_the_title()))
				); ?>
		</a>

		<?php get_template_part('partials/post-meta'); ?>

		<h2 class="post-title common-heading<?php echo (Bunyad::options()->title_trim_grid ? ' trimmed' : ''); ?>" itemprop="name headline">
			<a href="<?php the_permalink(); ?>" rel="bookmark" class="post-title-link" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>		
		</h2>
		
	</div><!-- .post-header -->

	<div <?php 
		Bunyad::markup()->attribs('post-excerpt', array(
			'class' => 'post-excerpt cf',
			'itemprop' => 'articleBody')); 
		?>>
				
		<?php

		// Excerpts or main content?
		echo Bunyad::posts()->excerpt(null, Bunyad::options()->post_excerpt_grid, array('force_more' => true));
		
		// Show counters and share - using our partial method for variable scope
		$options = array('comments' => false, 'heart' => false);
		Bunyad::core()->partial('partials/content/social-share', compact('options'));
		 
		?>
			
	</div><!-- .post-content -->
	
		
</article> <!-- .the-post -->
