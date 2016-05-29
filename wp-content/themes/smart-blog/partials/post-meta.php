<?php
/**
 * Partial: Common post meta template
 */

// Primary category
if (($cat_label = Bunyad::posts()->meta('cat_label'))) {
	$category = get_category($cat_label);
}
else {
	$category = current(get_the_category());
}

// Object has category taxonomy? i.e., is it a post or a valid CPT?
if (!in_array('category', get_object_taxonomies(get_post_type()))) {
	return;
}

?>

		<div class="post-meta">
		
		<?php if (Bunyad::options()->meta_category): ?>
			<span class="post-cat">
			
			<?php if (is_single() && Bunyad::options()->single_all_cats): // Show all categories? ?>
			
				<?php echo get_the_category_list(' '); ?>
			
			<?php elseif (is_object($category)): // Show only Primary ?>
			
				<a href="<?php 
					echo esc_url(get_category_link($category)); ?>"><?php echo esc_html($category->name); 
				?></a></span>
			
			<?php endif; ?>
			
			<span class="meta-sep"></span>
			
		<?php endif; ?>
			
		<?php if (Bunyad::options()->meta_date): ?>
			<time class="post-date" <?php echo (in_the_loop() ? 'itemprop="datePublished" ' : ''); 
				?>datetime="<?php echo esc_attr(get_the_date(DATE_W3C)); ?>"><?php echo esc_html(get_the_date()); ?></time>
		<?php endif; ?>
		
		</div>
