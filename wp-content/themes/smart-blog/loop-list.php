<?php 

/**
 * The "posts list" listing style for tags, author archives etc.
 */

?>

	<div class="posts-list cf">
			
		<?php while (have_posts()) : the_post(); ?>
				
			<?php get_template_part('content-list', get_post_format()); ?>
			
		<?php endwhile; ?>
						
		<?php get_template_part('partials/pagination'); ?>
		
	</div>