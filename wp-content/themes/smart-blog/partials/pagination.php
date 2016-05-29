<?php
/**
 * Partial: Common pagination for loops
 */
?>

	<nav class="main-pagination">
		<div class="previous"><?php next_posts_link('<i class="icon icon-arrow-prev"></i>' . esc_html__('Older', 'smart-blog')); ?></div>
		<div class="next"><?php previous_posts_link(esc_html__('Newer', 'smart-blog') . '<i class="icon icon-arrow-next"></i>'); ?></div>
	</nav>