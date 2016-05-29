<?php 
/**
 * Template for home: Default Blog loop style
 */
?>
	<div class="col-8 main-content cf">
	
		<?php get_template_part('loop'); ?>
		
	</div>
	
	<?php Bunyad::core()->theme_sidebar(); ?>