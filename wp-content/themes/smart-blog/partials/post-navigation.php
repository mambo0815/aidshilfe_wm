<?php
/**
 * Partial: Post navigation for single
 */

	/**
	 * Previous Post
	 */
	$previous = get_previous_post();
	if (!empty($previous)):
		setup_postdata($post = $previous);
?>

	<div class="post-nav-overlay previous cf">
		<a href="<?php the_permalink(); ?>" title="<?php esc_attr_e('Previous Post', 'smart-blog'); ?>" class="nav-icon">
			<i class="icon icon-left-open-big"></i>
		</a>
		
		<span class="content">
			<a href="<?php the_permalink(); ?>" class="common-heading">
				<?php the_post_thumbnail(); ?>
				<span class="the-title"><?php the_title(); ?></span>
			</a>
		</span>
	</div>
		
	
<?php
		wp_reset_postdata(); 
	endif; 
		
?>

<?php

	$next = get_next_post();
	if (!empty($next)):
		setup_postdata($post = $next);
?>

	<div class="post-nav-overlay next cf">
		<a href="<?php the_permalink(); ?>" title="<?php esc_attr_e('Next Post', 'smart-blog'); ?>" class="nav-icon">
			<i class="icon icon-right-open-big"></i>
		</a>
		<span class="content">
			<a href="<?php the_permalink(); ?>" class="common-heading">
				<span class="the-title"><?php the_title(); ?></span>				
				<?php the_post_thumbnail(); ?>
			</a>
		</span>
	</div>
		
	
<?php
		wp_reset_postdata(); 
	endif; 
		
?>