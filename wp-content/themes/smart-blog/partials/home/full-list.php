<?php 
/**
 * Template for home: First full post + then list
 */

?>

	<div class="col-8 main-content cf">
	
		<?php if (!is_paged()): ?>
		
			<?php while (have_posts()) : the_post(); ?>
				
				<?php get_template_part('content', get_post_format()); ?>
				
				<?php break; // for first post only ?>
				
			<?php endwhile; ?>
			
		<?php endif; ?>
	
		<?php get_template_part('loop-list'); ?>
		
	</div>
	
	<?php Bunyad::core()->theme_sidebar(); ?>