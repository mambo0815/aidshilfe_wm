<?php 
/**
 * Sidebar template
 */
?>
		<aside class="col-4 sidebar">
		
		<?php if (is_active_sidebar('smart-blog-primary')) : ?>
			<ul>
				<?php dynamic_sidebar('smart-blog-primary'); ?>
			</ul>
		<?php endif; ?>

		</aside>