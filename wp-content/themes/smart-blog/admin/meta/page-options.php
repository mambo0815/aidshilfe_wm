<?php

/**
 * Options metabox for pages
 */

$options = array(
	array(
		'label' => esc_html_x('Layout Style', 'Admin', 'smart-blog'),
		'name'  => 'layout_style', // will be _bunyad_layout_style
		'type'  => 'radio',
		'options' => array(
			'' => esc_html_x('Default', 'Admin', 'smart-blog'),
			'right' => esc_html_x('Right Sidebar', 'Admin', 'smart-blog'),
			'full' => esc_html_x('Full Width', 'Admin', 'smart-blog')),
		'value' => '' // default
	),
	
	array(
		'label' => esc_html_x('Featured Slider', 'Admin', 'smart-blog'),
		'name'  => 'featured_slider', // will be _bunyad_layout_style
		'desc'  => esc_html_x('Helpful if using a static page as your home-page.', 'Adminbox', 'smart-blog'),
		'type'  => 'select',
		'options' => array(
			0 => esc_html_x('Disabled', 'Admin', 'smart-blog'),
			1 => esc_html_x('Enabled', 'Admin', 'smart-blog'),
		),
		'value' => 0 // default
	)
);

$options = $this->options(
	apply_filters('bunyad_metabox_page_options', $options)
);

?>

<div class="bunyad-meta cf">

<?php foreach ($options as $element): ?>
	
	<div class="option <?php echo esc_attr($element['name']); ?>">
		<span class="label"><?php echo esc_html($element['label']); ?></span>
		<span class="field">
			<?php echo $this->render($element); // Bunyad_Admin_OptionRenderer::render() ?>
		
			<?php if (!empty($element['desc'])): ?>
			
			<p class="description"><?php echo esc_html($element['desc']); ?></p>
		
			<?php endif;?>
		
		</span>		
	</div>
	
<?php endforeach; ?>

</div>