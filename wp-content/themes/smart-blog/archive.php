<?php
/**
 * Archives Page!
 * 
 * This page is used for all kind of archives from custom post types to blog to 'by date' archives.
 * 
 * Bunyad framework recommends this template to be used as generic template wherever any sort of listing 
 * needs to be done.
 * 
 * Types of archives handled:
 * 
 *  - Categories
 *  - Tags
 *  - Taxonomies
 *  - Author Archives
 *  - Date Archives
 * 
 * @link http://codex.wordpress.org/images/1/18/Template_Hierarchy.png
 */


// Set default loop template
$loop_template = Bunyad::options()->archive_loop;

// Have a sidebar preference for archives?
if (Bunyad::options()->archive_sidebar) {
	Bunyad::core()->set_sidebar(
		Bunyad::options()->archive_sidebar
	);
}

get_header();

?>

	<div class="wrap">
	
	<?php if (is_tag()): ?>
	
		<?php 
		
		/**
		 * Setup tags archives header
		 */
		$icon = 'tag';

		Bunyad::core()->partial('partials/archive/heading', compact('icon'));
		
		?>
	
	<?php elseif (is_category()): // category page ?>
	
		<?php 
		
		$loop_template = Bunyad::options()->category_loop;
		
		/**
		 * Setup category header 
		 */
		
		if (!Bunyad::options()->category_header):
		
			get_template_part('partials/archive/category-filters'); 
		
		else:
			
			// Archive type heading
			get_template_part('partials/archive/heading');
			
		endif;
		
		?>

		
	<?php elseif (is_search()): // search ?>
	
		<?php 
		
		// set loop template
		$loop_template = Bunyad::options()->search_loop;
		
		/**
		 * Setup search archive header
		 */
		$icon    = 'search';
		$heading = get_search_query();
		$info    = sprintf(esc_html__('Showing %s Results', 'smart-blog'), '<strong>' . intval($wp_query->found_posts) . '</strong>'); 
		
		Bunyad::core()->partial('partials/archive/heading', compact('icon', 'heading', 'info'));
		 
		?>
		
	<?php elseif (is_author()): // author archives ?>
		
		<?php 
		
		/**
		 * Setup author archives header
		 */
		$icon = 'user';
		
		$authordata = get_userdata(get_query_var('author'));
		$heading    = get_the_author();

		Bunyad::core()->partial('partials/archive/heading', compact('icon', 'heading'));
		
		?>	
		
		
	<?php else: ?>
	
		<?php
		
			/**
			 * Set heading based on archives, fallback to WordPress 4.1+ default
			 * 
			 * @see get_the_archive_title()
			 */
			$icon = 'clock';
			
			if (is_day()) {
				$heading = get_the_date('F j, Y');
				$description = sprintf(esc_html__('Showing all posts made on the day %s.', 'smart-blog'), $heading);  // escaped below
			}
			else if (is_month()) {
				$heading =  get_the_date('F Y');
				$description = sprintf(esc_html__('Showing all posts made in the month of %s.', 'smart-blog'), $heading);  // escaped below
			}
			else if (is_year()) {
				$heading = get_the_date('Y');
				$description = sprintf(esc_html__('Showing all posts made in the year %s.', 'smart-blog'), $heading); // escaped below 
			}
			
			Bunyad::core()->partial('partials/archive/heading',  compact('icon', 'heading', 'description'));
		
		?>
	
	<?php endif; ?>
	</div>

	
	<div class="main wrap">
		<div class="ts-row cf">
			<div class="col-8 main-content cf">
		
			<?php 
			
			// render our loop
			get_template_part((!empty($loop_template) ? $loop_template : 'loop')); 
	
			?>
	
			</div> <!-- .main-content -->
			
			<?php Bunyad::core()->theme_sidebar(); ?>
			
		</div> <!-- .ts-row -->
	</div> <!-- .main -->

<?php get_footer(); ?>