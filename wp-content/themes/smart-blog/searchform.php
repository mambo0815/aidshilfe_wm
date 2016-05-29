<?php
/**
 * Search template to use in places like Search Widget 
 */
?>
	<form method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
		<label>
			<span class="screen-reader-text"><?php echo esc_attr_x('Search for:', 'search', 'smart-blog'); ?></span>
			<input type="search" class="search-field" placeholder="<?php echo esc_attr_x('Type and hit enter...', 'search', 'smart-blog') ?>" value="<?php 
				echo esc_attr(get_search_query()); // escaped ?>" name="s" title="<?php echo esc_attr_x('Search for:', 'search', 'smart-blog'); ?>" />
		</label>
		<button type="submit" class="search-submit"><i class="icon icon-search"></i></button>
	</form>