<?php 

/**
 * The main loop used to list posts in the category, tag, author archives etc.
 */

?>

<?php if (have_posts()): ?>

	<?php while (have_posts()) : the_post(); ?>
		
		<?php get_template_part('content', get_post_format()); ?>
		
	<?php endwhile; ?>
	
	<?php get_template_part('partials/pagination'); ?>
	
<?php else: ?>

	<?php get_template_part('content-none'); ?>
	
<?php endif; ?>