<?php
/**
 * Content Template is used for every post format and used on single posts
 * 
 * It is also used on archives called via loop.php
 */

?>

<article <?php
	// setup the tag attributes
	Bunyad::markup()->attribs('list-post-wrapper', array(
		'id'        => 'post-' . get_the_ID(),
		'class'     => 'list-post small-post grid-box',
		'itemscope' => '',
		'itemtype'  => 'http://schema.org/Article'
	)); ?>>
	
	<a href="<?php echo esc_url(get_permalink()); ?>" itemprop="image" class="image-link"><?php the_post_thumbnail(
				(Bunyad::core()->get_sidebar() == 'none' ? 'smart-blog-list-large' : 'smart-blog-list-small'), // small image if there's a sidebar
				array('title' => strip_tags(get_the_title()))
			); ?>
	</a>


	<div class="content">
	
		<?php get_template_part('partials/post-meta'); ?>

		<h2 class="post-title common-heading" itemprop="name headline">
			<a href="<?php the_permalink(); ?>" rel="bookmark" class="post-title-link"><?php the_title(); ?></a>		
		</h2>
		
		
		<div <?php 
			Bunyad::markup()->attribs('post-excerpt', array(
				'class' => 'post-excerpt cf',
				'itemprop' => 'articleBody')); 
			?>>
					
			<?php
			
			// Full width requires more words in the excerpt
			$excerpt = Bunyad::options()->post_excerpt_list;
			$words   = Bunyad::core()->get_sidebar() == 'none' ?  round($excerpt * 2) : $excerpt;
		
			// Get excerpt with read more button added
			echo Bunyad::posts()->excerpt(null, $words, array('force_more' => true));

			// Show counters and share - using our partial method for variable scope
			$options = array('comments' => false, 'heart' => false);
			Bunyad::core()->partial('partials/content/social-share', compact('options'));
			
			?>
				
		</div>
	</div> <!-- .content -->
	
		
</article>