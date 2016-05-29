<?php 
/**
 * Template for home: First full post + sidebar + then 3 column posts grid
 */
?>

	<?php if (!is_paged()): ?>
	
	<div class="col-8 main-content cf first-full">
		
		<?php while (have_posts()) : the_post(); ?>
			
			<?php get_template_part('content', get_post_format()); ?>
			
			<?php break; // for first post only ?>
			
		<?php endwhile; ?>	
	</div>
	
	<?php Bunyad::core()->theme_sidebar(); ?>
	
	<?php endif; ?>
	
	<div class="<?php echo esc_attr((!is_paged() ? 'first-full ' : '')); ?> col-12">
		<?php get_template_part('loop-grid'); ?>
	</div>