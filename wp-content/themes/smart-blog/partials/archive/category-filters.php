<?php 
/**
 * Category archive header - Ribbon style heading with sub-category filters
 */
				
// Current category
$cat     = get_category(get_query_var('cat'));

// Use the parent from higher in hierarachy if not a parent category
$cat_id  = ($cat->category_parent == 0 ? $cat->cat_ID : $cat->category_parent);
$parent  = get_category($cat_id);

// Get child categories
$children = get_categories(array(
	'parent' => $cat_id, 
	'hide_empty' => false
));

// Current category is active?
$active   = ($cat->cat_ID == $cat_id ? ' active' : '');

?>

	<section class="wrap archive-head ribbon grid-box">
		
		<h2 class="title-ribbon"><?php echo esc_html($parent->cat_name); ?></h2>
		
		<?php if (!empty($children)): ?>
			
		<div class="filter-cats">
			
			<a href="<?php echo esc_url(get_category_link($parent)); ?>" class="sub-cat<?php echo esc_attr($active); 
				?>"><?php esc_html_e('All', 'smart-blog'); ?></a>
		
			<?php
				// Print the sub-categories 
				foreach ($children as $sub_cat):
					$active = ($cat->cat_ID == $sub_cat->cat_ID ? ' active' : '');
			?>
				
				<a href="<?php echo esc_url(get_category_link($sub_cat)); ?>" class="sub-cat<?php echo esc_attr($active); 
					?>"><?php echo esc_html($sub_cat->name); ?></a>
				
			<?php endforeach; ?>

		</div>
			
		<?php endif; // children check ?>		
		
	</section>