<?php 
/**
 * The homepage listing
 */

// Set sidebar from settings
Bunyad::core()->set_sidebar(Bunyad::options()->home_sidebar);

get_header();

// Home template from settings
$template = (!Bunyad::options()->home_layout ? 'default' : Bunyad::options()->home_layout);

// Normalize grid-N to normal grid template
$template = str_replace('-2', '', $template);

/**
 * Show slider on home?
 * 
 * Loads partials/slider.php or partials/slider-alt.php depending on the 
 * setting in Customizer.
 */
if (Bunyad::options()->home_slider) {
	
	$slider = 'partials/slider';
	if (Bunyad::options()->home_slider == 'alt') {
		$slider .= '-alt';
	} 	

	get_template_part($slider);
}

?>

<div class="main wrap">
	<div class="ts-row cf">

		<?php
		
		// Render the home layout template. Default is partials/home/default.php
		get_template_part('partials/home/' . sanitize_file_name($template));

		?>

	</div> <!-- .ts-row -->

	<?php if (Bunyad::options()->home_carousel): ?>
	
		<?php get_template_part('partials/home/carousel'); ?>
	
	<?php endif; ?>
	
</div> <!-- .main -->

<?php get_footer(); ?>