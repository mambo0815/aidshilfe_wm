<?php

/**
 * Partial Template - Display the gallery slider for gallery post formats
 */

$image_ids = Bunyad::posts()->get_first_gallery_ids();

if (!$image_ids) {
	return;
}

$images = get_posts(array(
	'post_type' => 'attachment',
	'post_status' => 'inherit',
	'post__in' => $image_ids,
	'orderby' => 'post__in',
	'posts_per_page' => -1
));

?>

	<div class="gallery-slider common-slider">
			<?php foreach ($images as $attachment): ?>
				
				<div>
					<a href="<?php echo esc_url(wp_get_attachment_url($attachment->ID)); ?>">
					
					<?php if ((!in_the_loop() && Bunyad::posts()->meta('layout_style') == 'full') OR Bunyad::core()->get_sidebar() == 'none'): // largest images - no sidebar? ?>
					
						<?php echo wp_get_attachment_image($attachment->ID, 'smart-blog-main-full'); ?>
					
					<?php else: ?>
						
						<?php echo wp_get_attachment_image($attachment->ID, 'smart-blog-main'); ?>
						
					<?php endif; ?>
					
					<?php if ($attachment->post_excerpt): // caption ?>
						
						<div class="caption"><?php echo esc_html($attachment->post_excerpt); ?></div>
						
					<?php endif; ?>
					
					</a>
				</div>
				
			<?php endforeach; // no reset query needed; get_posts() uses a new instance ?>
	</div>

<?php wp_reset_query(); ?>