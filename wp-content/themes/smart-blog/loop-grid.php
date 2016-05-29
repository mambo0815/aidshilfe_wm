<?php 
/**
 * The grid loop listing style for tags, author archives etc.
 */

$column = 'col-4';

// Use 2 columns for archives with sidebar enabled
if (Bunyad::registry()->grid_cols == 2 OR (!is_home() && Bunyad::core()->get_sidebar() != 'none')) {
	$column = 'col-6';
}

?>

	<div class="posts-grid ts-row cf" data-type="<?php echo esc_attr(Bunyad::options()->grid_type); ?>">
	
		<?php while (have_posts()) : the_post(); ?>
			
			<div class="<?php echo esc_attr($column); ?>">
				
			<?php get_template_part('content-grid', get_post_format()); ?>

			</div>
			
		<?php endwhile; ?>
		
	</div>
	
	<?php get_template_part('partials/pagination'); ?>
