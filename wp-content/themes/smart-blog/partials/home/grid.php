<?php 
/**
 * Template for home: Grid style
 */

Bunyad::registry()->grid_cols = Bunyad::core()->get_sidebar() == 'none' ? 3 : 2;

?>
	<div class="col-8 main-content cf">
	
		<?php get_template_part('loop-grid'); ?>
		
	</div>
	
	<?php Bunyad::core()->theme_sidebar(); ?>