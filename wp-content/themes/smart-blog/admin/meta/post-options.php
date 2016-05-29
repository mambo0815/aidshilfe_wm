<?php
/**
 * Meta box for post options
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
		'label' => esc_html_x('Primary Category', 'Admin', 'smart-blog'),
		'name'  => 'cat_label',
		'type'  => 'html',
		'html' =>  wp_dropdown_categories(array(
			'show_option_all' => esc_html_x('-- Auto Detect--', 'Admin', 'smart-blog'), 
			'hierarchical' => 1, 'order_by' => 'name', 'class' => '', 
			'name' => '_bunyad_cat_label', 'echo' => false,
			'selected' => Bunyad::posts()->meta('cat_label')
		)),
		'desc' => esc_html_x('When you have multiple categories for a post, auto detection chooses one in alphabetical order. This setting is used for selecting the correct category in post meta.', 'Admin', 'smart-blog')
	),
	
	array(
		'label' => esc_html_x('Galleries Type (If Any)', 'Admin', 'smart-blog'),
		'name'  => 'gallery_type',
		'type'  => 'select',
		'options' => array(
			'' => esc_html_x('Default (As set in Customizer)', 'Admin', 'smart-blog'),
			'justified' => esc_html_x('Justified Galleries Style', 'Admin', 'smart-blog'),
			'default' => esc_html_x('Default WordPress Gallery', 'Admin', 'smart-blog')
		),
		'value' => '', // default
		'desc' => esc_html_x('The galleries within this post will be displayed using the selected gallery setting.', 'Admin', 'smart-blog')
	),
		
	array(
		'label' => esc_html_x('Featured Video/Audio Link', 'Admin', 'smart-blog'),
		'name'  => 'featured_video', 
		'type'  => 'text',
		'input_size' => 90,
		'value' => '',
		'desc'  => esc_html_x('When using Video or Audio post format, enter a link of the video or audio from a service like YouTube, Vimeo, SoundCloud. ', 'Admin', 'smart-blog'),
	),
);

$options = $this->options($options);

?>

<div class="bunyad-meta cf">

	<input type="hidden" name="bunyad_meta_box" value="post">

<?php foreach ($options as $element): ?> 
	
	<div class="option <?php echo esc_attr($element['name']); ?>">
		<span class="label"><?php echo esc_html(isset($element['label_left']) ? $element['label_left'] : $element['label']); ?></span>
		<span class="field">

			<?php echo $this->render($element); // Bunyad_Admin_OptionRenderer::render() ?>
		
			<?php if (!empty($element['desc'])): ?>
			
			<p class="description"><?php echo esc_html($element['desc']); ?></p>
		
			<?php endif;?>
		
		</span>
	</div>
	
<?php endforeach; ?>

</div>