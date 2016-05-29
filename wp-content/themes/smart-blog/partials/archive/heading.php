<?php
/**
 * Partial Template: Archive header
 */

if (empty($description)) {
	$description = get_the_archive_description();
}

if (empty($info)) {
	$info = sprintf(esc_html__('%s Posts', 'smart-blog'), '<strong>' . intval($wp_query->post_count) . '</strong>');
}

// Default to term title as heading
if (empty($heading)) {
	$heading = single_term_title('', false);
}

?>

	<section class="cf archive-head grid-box">
		
		<div class="cf">
			<h2 class="title"><i class="icon title-icon icon-<?php echo esc_attr($icon); ?>"></i><?php echo esc_html($heading); ?></h2>
			<span class="info"><?php echo wp_kses_post($info); // escaped above and in archive.php ?></span>
			
			<a href="<?php echo esc_url(home_url()); ?>" class="home-link"><i class="icon icon-home"></i><?php esc_html_e('Back Home', 'smart-blog'); ?></a>		
		</div>
		
		<?php if (!empty($description)): ?>
			<div class="description cf post-content"><?php echo wp_kses_post($description); ?></div>
		<?php endif; ?>
		
	</section>