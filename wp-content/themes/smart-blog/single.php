<?php 

/**
 * Singular Content Template
 */

?>

<?php get_header(); ?>

<div class="main wrap">

	<div class="ts-row cf">
		<div class="col-8 main-content cf">
		
			<?php while (have_posts()) : the_post(); ?>

				<?php get_template_part('content', 'single'); ?>

				<div class="comments">
				<?php comments_template('', true); ?>
				</div>
	
			<?php endwhile; // end of the loop. ?>

		</div>
		
		<?php Bunyad::core()->theme_sidebar(); ?>
		
	</div> <!-- .ts-row -->
</div> <!-- .main -->

<?php

if (Bunyad::options()->post_navigation):
	get_template_part('partials/post-navigation');
endif;

?>

<?php get_footer(); ?>