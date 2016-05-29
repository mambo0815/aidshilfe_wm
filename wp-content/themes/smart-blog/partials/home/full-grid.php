<?php 
/**
 * Template for home: First full post + then 2 column posts grid
 */

Bunyad::registry()->grid_cols = Bunyad::core()->get_sidebar() == 'none' ? 3 : 2;

// Force 2 columns for the grid-2 template
if (Bunyad::options()->home_layout == 'full-grid-2') {
	Bunyad::registry()->grid_cols = 2;
}

?>

	<div class="col-8 main-content cf">
	
		<?php if (!is_paged()): ?>
		
			<?php while (have_posts()) : the_post(); ?>
				
				<?php get_template_part('content', get_post_format()); ?>
				
				<?php break; // for first post only ?>
				
			<?php endwhile; ?>
			
		<?php endif; ?>
	
		<?php get_template_part('loop-grid'); ?>
		
	</div>
	
	<?php Bunyad::core()->theme_sidebar(); ?>