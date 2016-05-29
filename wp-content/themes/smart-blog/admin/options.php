<?php
/**
 * Theme Settings - All the relevant options!
 * 
 * @see Bunyad_Options
 * @see Bunyad_Theme_Customizer
 */

return apply_filters('bunyad_theme_options', array(

	array(
		'title' => esc_html_x('General Settings', 'Admin', 'smart-blog'),
		'id'    => 'options-tab-general',
		'sections' => array(
			array(
				'id' => 'general-home',
				'title'  => esc_html_x('Homepage', 'Admin', 'smart-blog'),
				'fields' => array(
			
					array(
						'name' => 'home_layout',
						'label'   => esc_html_x('Home Layout', 'Admin', 'smart-blog'),
						'value'   => 'full-grid',
						'desc'    => '',
						'type'    => 'radio',
						'options' => array(
							'' => esc_html_x('Blog Style', 'Admin', 'smart-blog'),
							'list' => esc_html_x('List Style', 'Admin', 'smart-blog'),
							'full-list' => esc_html_x('Large Post + List', 'Admin', 'smart-blog'),
							'full-grid' => esc_html_x('Large Post + Grid', 'Admin', 'smart-blog'),
							'full-grid-2' => esc_html_x('Large + 2 Column Grid (Requires: No Sidebar)', 'Admin', 'smart-blog'),
							'full-sidebar-grid' => esc_html_x('Large Post + Sidebar + 3 Column Grid', 'Admin', 'smart-blog'),
							'grid' => esc_html_x('Simple Grid', 'Admin', 'smart-blog'),
						),
					),
					
					array(
						'name' => 'home_sidebar',
						'label'   => esc_html_x('Home Sidebar', 'Admin', 'smart-blog'),
						'value'   => 'right',
						'desc'    => '',
						'type'    => 'radio',
						'options' => array(
							'none'  => esc_html_x('No Sidebar', 'Admin', 'smart-blog'),
							'right' => esc_html_x('Right Sidebar', 'Admin', 'smart-blog') 
						),
					),
					
					array(
						'name' => 'home_slider',
						'label'   => esc_html_x('Slider on Home', 'Admin', 'smart-blog'),
						'value'   => '',
						'desc'    => '',
						'type'    => 'select',
						'options' => array(
							''        => esc_html_x('Disabled', 'Admin', 'smart-blog'),
							'default' => esc_html_x('Default Slider', 'Admin', 'smart-blog'),
							'alt'     => esc_html_x('Alternate Slider', 'Admin', 'smart-blog'),
						),
					),
					
					
					array(
						'name' => 'slider_posts',
						'label'   => esc_html_x('Slider Post to Show', 'Admin', 'smart-blog'),
						'value'   => 3,
						'desc'    => '',
						'type'    => 'number',
					),
					
					array(
						'name' => 'slider_tag',
						'label'   => esc_html_x('Slider Posts Tag', 'Admin', 'smart-blog'),
						'value'   => 'featured',
						'desc'    => esc_html_x('Posts with this tag will be shown in the slider. Leaving it empty will show latest posts.', 'Admin', 'smart-blog'),
						'type'    => 'text',
					),
					
					array(
						'name' => 'slider_autoplay',
						'label'   => esc_html_x('Slider Autoplay', 'Admin', 'smart-blog'),
						'value'   => 1,
						'desc'    => '',
						'type'    => 'checkbox',
					),
					
					array(
						'name' => 'slider_animation',
						'label'   => esc_html_x('Slider Autoplay', 'Admin', 'smart-blog'),
						'value'   => 'fade',
						'desc'    => '',
						'type'    => 'radio',
						'options' => array(
							'fade'  => esc_html_x('Fade Animation', 'Admin', 'smart-blog'),
							'slide' => esc_html_x('Slide Animation', 'Admin', 'smart-blog'),
						),
					),
					
					array(
						'name' => 'slider_delay',
						'label'   => esc_html_x('Slide Autoplay Delay', 'Admin', 'smart-blog'),
						'value'   => 5000,
						'desc'    => '',
						'type'    => 'number',
						'input_attrs' => array('min' => 500, 'max' => 50000, 'step' => 500),
					),
					
					array(
						'name' => 'home_carousel',
						'label'   => esc_html_x('Enable Posts Carousel On Home', 'Admin', 'smart-blog'),
						'value'   => 0,
						'desc'    => esc_html_x('Will show a posts carousel above footer.', 'Admin', 'smart-blog'),
						'type'    => 'checkbox',
					),
					
					array(
						'name' => 'home_carousel_posts',
						'label'   => esc_html_x('Home Carousel Posts', 'Admin', 'smart-blog'),
						'value'   => 8,
						'desc'    => '',
						'type'    => 'number',
					),
					
					array(
						'name' => 'home_carousel_title',
						'label'   => esc_html_x('Home Carousel Title', 'Admin', 'smart-blog'),
						'value'   => esc_html__('Most Liked Articles', 'smart-blog'),
						'desc'    => '',
						'type'    => 'text',
					),
					
					array(
						'name' => 'home_carousel_type',
						'label'   => esc_html_x('Home Carousel Posts', 'Admin', 'smart-blog'),
						'value'   => 'liked',
						'desc'    => '',
						'type'    => 'select',
						'options' => array(
							'liked' => esc_html_x('Most Liked', 'Admin', 'smart-blog'),
							'posts'   => esc_html_x('Latest / By Tag', 'Admin', 'smart-blog'),
						),
					),
					
					array(
						'name' => 'home_carousel_tag',
						'label'   => esc_html_x('Home Carousel Tag - Optional', 'Admin', 'smart-blog'),
						'value'   => '',
						'desc'    => '',
						'type'    => 'text',
					),
					
					
					
					
				), // fields
				
			), // section
			
			array(
				'id' => 'general-archives',
				'title'  => esc_html_x('Categories & Archives', 'Admin', 'smart-blog'),
				'fields' => array(
			
					array(
						'name' => 'archive_sidebar',
						'label'   => esc_html_x('Listings Sidebar', 'Admin', 'smart-blog'),
						'value'   => '',
						'desc'    => esc_html_x('Applies to all type of archives except home.', 'Admin', 'smart-blog'),
						'type'    => 'radio',
						'options' => array(
							''  => esc_html_x('Default', 'Admin', 'smart-blog'),
							'none'  => esc_html_x('No Sidebar', 'Admin', 'smart-blog'),
							'right' => esc_html_x('Right Sidebar', 'Admin', 'smart-blog') 
						),
					),
			
					array(
						'name' => 'category_loop',
						'label'   => esc_html_x('Category Listing Style', 'Admin', 'smart-blog'),
						'value'   => '',
						'desc'    => '',
						'type'    => 'select',
						'options' => array(
							'' => esc_html_x('Blog Style', 'Admin', 'smart-blog'),
							'loop-list' => esc_html_x('List Style', 'Admin', 'smart-blog'),
							'loop-grid' => esc_html_x('Grid Style', 'Admin', 'smart-blog'),
						),
					),
					
					array(
						'name' => 'category_header',
						'label'   => esc_html_x('Category Heading Style', 'Admin', 'smart-blog'),
						'value'   => '',
						'desc'    => '',
						'type'    => 'select',
						'options' => array(
							'' => esc_html_x('Stylish Heading + Sub-cat Filters', 'Admin', 'smart-blog'),
							'archive' => esc_html_x('Archive Heading Style', 'Admin', 'smart-blog'),
						),
					),
					
					array(
						'name' => 'archive_loop',
						'label'   => esc_html_x('Archive Listing Style', 'Admin', 'smart-blog'),
						'value'   => '',
						'desc'    => '',
						'type'    => 'select',
						'options' => array(
							'' => esc_html_x('Blog Style', 'Admin', 'smart-blog'),
							'loop-list' => esc_html_x('List Style', 'Admin', 'smart-blog'),
							'loop-grid' => esc_html_x('Grid Style', 'Admin', 'smart-blog'),
						),
					),
					
					array(
						'name' => 'search_loop',
						'label'   => esc_html_x('Search Listing Style', 'Admin', 'smart-blog'),
						'value'   => '',
						'desc'    => '',
						'type'    => 'select',
						'options' => array(
							''  => esc_html_x('Blog Style', 'Admin', 'smart-blog'),
							'loop-list' => esc_html_x('List Style', 'Admin', 'smart-blog'),
							'loop-grid' => esc_html_x('Grid Style', 'Admin', 'smart-blog'),
						),
					),
					
				) // fields
			
			), // section
			
			array(
				'id' => 'general-social',
				'title'  => esc_html_x('Social Media Links', 'Admin', 'smart-blog'),
				'desc'   => esc_html_x('Enter full URLs to your social media profiles. These are used in Top Bar social icons.', 'Admin', 'smart-blog'),
				'fields' => array(

					array(
						'name'   => 'social_profiles[facebook]',
						'value' => '',
						'label' => esc_html_x('Facebook', 'Admin', 'smart-blog'),
						'desc'  => '',
						'type'  => 'text'
					),
					
					array(
						'name'   => 'social_profiles[twitter]',
						'value' => '',
						'label' => esc_html_x('Twitter', 'Admin', 'smart-blog'),
						'desc'  => '',
						'type'  => 'text'
					),
					
					array(
						'name'   => 'social_profiles[instagram]',
						'value' => '',
						'label' => esc_html_x('Instagram', 'Admin', 'smart-blog'),
						'desc'  => '',
						'type'  => 'text'
					),	
					
					array(
						'name'   => 'social_profiles[pinterest]',
						'value' => '',
						'label' => esc_html_x('Pinterest', 'Admin', 'smart-blog'),
						'desc'  => '',
						'type'  => 'text'
					),
					
					array(
						'name'   => 'social_profiles[bloglovin]',
						'value' => '',
						'label' => esc_html_x('BlogLovin', 'Admin', 'smart-blog'),
						'desc'  => '',
						'type'  => 'text'
					),
					
					array(
						'name'   => 'social_profiles[bloglovin]',
						'value' => '',
						'label' => esc_html_x('BlogLovin', 'Admin', 'smart-blog'),
						'desc'  => '',
						'type'  => 'text'
					),
					
					array(
						'name'   => 'social_profiles[gplus]',
						'value' => '',
						'label' => esc_html_x('Google+', 'Admin', 'smart-blog'),
						'desc'  => '',
						'type'  => 'text'
					),
					
					array(
						'name'   => 'social_profiles[youtube]',
						'value' => '',
						'label' => esc_html_x('YouTube', 'Admin', 'smart-blog'),
						'desc'  => '',
						'type'  => 'text'
					),
					
					array(
						'name'   => 'social_profiles[dribbble]',
						'value' => '',
						'label' => esc_html_x('Dribbble', 'Admin', 'smart-blog'),
						'desc'  => '',
						'type'  => 'text'
					),
					
					array(
						'name'   => 'social_profiles[tumblr]',
						'value' => '',
						'label' => esc_html_x('Tumblr', 'Admin', 'smart-blog'),
						'desc'  => '',
						'type'  => 'text'
					),
					
					array(
						'name'   => 'social_profiles[linkedin]',
						'value' => '',
						'label' => esc_html_x('LinkedIn', 'Admin', 'smart-blog'),
						'desc'  => '',
						'type'  => 'text'
					),
					
					array(
						'name'   => 'social_profiles[flickr]',
						'value' => '',
						'label' => esc_html_x('Flickr', 'Admin', 'smart-blog'),
						'desc'  => '',
						'type'  => 'text'
					),
					
					array(
						'name'   => 'social_profiles[soundcloud]',
						'value' => '',
						'label' => esc_html_x('SoundCloud', 'Admin', 'smart-blog'),
						'desc'  => '',
						'type'  => 'text'
					),
					
					array(
						'name'   => 'social_profiles[vimeo]',
						'value' => '',
						'label' => esc_html_x('Vimeo', 'Admin', 'smart-blog'),
						'desc'  => '',
						'type'  => 'text'
					),
					
					array(
						'name'   => 'social_profiles[rss]',
						'value' => get_bloginfo('rss2_url'),
						'label' => esc_html_x('RSS', 'Admin', 'smart-blog'),
						'desc'  => '',
						'type'  => 'text'
					),
			
				) // fields
			
			), // section
			
						
			array(
				'id' => 'general-misc',
				'title'  => esc_html_x('Layout & Misc', 'Admin', 'smart-blog'),
				'fields' => array(
			
					array(
						'name' => 'default_sidebar',
						'label'   => esc_html_x('Default Sidebar', 'Admin', 'smart-blog'),
						'value'   => 'right',
						'desc'    => esc_html_x('This setting can be changed per post or page.', 'Admin', 'smart-blog'),
						'type'    => 'radio',
						'options' => array(
							'none'  => esc_html_x('No Sidebar', 'Admin', 'smart-blog'),
							'right' => esc_html_x('Right Sidebar', 'Admin', 'smart-blog') 
						),
					),
					
					array(
						'name' => 'responsive',
						'label'   => esc_html_x('Responsive Layout', 'Admin', 'smart-blog'),
						'value'   => 1,
						'desc'    => esc_html_x('Activate optimized layouts for mobile devices.', 'Admin', 'smart-blog'),
						'type'    => 'checkbox',
					),
					
					array(
						'name' => 'widget_cats_parents',
						'label'   => esc_html_x('Categories Widget: Show Parents Only', 'Admin', 'smart-blog'),
						'value'   => 0,
						'desc'    => esc_html_x('Show parent categories only in the categories widget.', 'Admin', 'smart-blog'),
						'type'    => 'checkbox',
					),

					array(
						'name'   => 'search_posts_only',
						'value' => 1,
						'label' => esc_html_x('Limit Search To Posts', 'Admin', 'smart-blog'),
						'desc'  => esc_html_x('Enabling this feature will exclude pages from WordPress search.', 'Admin', 'smart-blog'),
						'type'  => 'checkbox'
					),
					
					array(
						'name' => 'enable_lightbox',
						'label'   => esc_html_x('Enable Lightbox for Images', 'Admin', 'smart-blog'),
						'value'   => 1,
						'desc'    => '',
						'type'    => 'checkbox',
					),
					
					
				) // fields
				
			) // section
			
		) // sections
		
	), // panel
			
	array(
		'title' => esc_html_x('Header & Navigation', 'Admin', 'smart-blog'),
		'id'    => 'options-tab-header',
		'sections' => array(
			array(
				'id' => 'header-topbar',
				'title'  => esc_html_x('General & Top Bar', 'Admin', 'smart-blog'),
				'fields' => array(
			
					array(
						'name' => 'header_layout',
						'label'   => esc_html_x('Header Layout Style', 'Admin', 'smart-blog'),
						'value'   => '',
						'desc'    => '',
						'type'    => 'select',
						'options' => array(
							'' => esc_html_x('Default', 'Admin', 'smart-blog'),
							'alt' => esc_html_x('Alternate Layout', 'Admin', 'smart-blog'),
						),
					),

					array(
						'name' => 'topbar_menu',
						'label'   => esc_html_x('Enable Top Hamburger Menu', 'Admin', 'smart-blog'),
						'value'   => 1,
						'desc'    => '',
						'type'    => 'checkbox',
					),
					
					array(
						'name' => 'topbar_search',
						'label'   => esc_html_x('Show Search', 'Admin', 'smart-blog'),
						'value'   => 1,
						'desc'    => '',
						'type'    => 'checkbox',
					),
					
					array(
						'name' => 'topbar_sticky',
						'label'   => esc_html_x('Sticky Top Bar/Navigation', 'Admin', 'smart-blog'),
						'value'   => 1,
						'desc'    => esc_html_x('Make topbar sticky on scrolling.', 'Admin', 'smart-blog'),
						'type'    => 'checkbox',
					),

					array(
						'label'   => esc_html_x('Top Bar Social Icons', 'Admin', 'smart-blog'),
						'name'    => 'topbar_social',
						'value'   => array('facebook', 'twitter', 'pinterest', 'instagram', 'bloglovin', 'rss'),
						'desc'    => esc_html_x('Configure these icons URLs from General > Social Media.', 'Admin', 'smart-blog'),
						'type'    => 'checkboxes',
					
						// Show only if header layout is default
						'context' => array('control' => array('key' => 'header_layout', 'value' => '')),
						'options' => array(
							'facebook'  => esc_html_x('Facebook', 'Admin', 'smart-blog'),
							'twitter'   => esc_html_x('Twitter', 'Admin', 'smart-blog'),
							'pinterest' => esc_html_x('Pinterest', 'Admin', 'smart-blog'),
							'instagram' => esc_html_x('Instagram', 'Admin', 'smart-blog'),
							'bloglovin' => esc_html_x('BlogLovin', 'Admin', 'smart-blog'),
							'rss'       => esc_html_x('RSS', 'Admin', 'smart-blog'),
							'gplus'     => esc_html_x('Google Plus', 'Admin', 'smart-blog'),
							'youtube'   => esc_html_x('Youtube', 'Admin', 'smart-blog'),
							'dribbble'  => esc_html_x('Dribbble', 'Admin', 'smart-blog'),
							'tumblr'    => esc_html_x('Tumblr', 'Admin', 'smart-blog'),
							'linkedin'  => esc_html_x('LinkedIn', 'Admin', 'smart-blog'),
							'flickr'    => esc_html_x('Flickr', 'Admin', 'smart-blog'),
							'soundcloud' => esc_html_x('SoundCloud', 'Admin', 'smart-blog'),
							'vimeo'     => esc_html_x('Vimeo', 'Admin', 'smart-blog'), 
						),
					),
					
					array(
						'label'   => esc_html_x('Hamburger Menu Social Icons', 'Admin', 'smart-blog'),
						'name'    => 'topbar_menu_social',
						'value'   => array('facebook', 'instagram'),
						'desc'    => esc_html_x('Please select only two.', 'Admin', 'smart-blog'),
						'type'    => 'checkboxes',
						'options' => array(
							'facebook'  => esc_html_x('Facebook', 'Admin', 'smart-blog'),
							'twitter'   => esc_html_x('Twitter', 'Admin', 'smart-blog'),
							'pinterest' => esc_html_x('Pinterest', 'Admin', 'smart-blog'),
							'instagram' => esc_html_x('Instagram', 'Admin', 'smart-blog'),
							'bloglovin' => esc_html_x('BlogLovin', 'Admin', 'smart-blog'),
							'rss'       => esc_html_x('RSS', 'Admin', 'smart-blog'),
							'gplus'     => esc_html_x('Google Plus', 'Admin', 'smart-blog'),
							'youtube'   => esc_html_x('Youtube', 'Admin', 'smart-blog'),
							'dribbble'  => esc_html_x('Dribbble', 'Admin', 'smart-blog'),
							'tumblr'    => esc_html_x('Tumblr', 'Admin', 'smart-blog'),
							'linkedin'  => esc_html_x('LinkedIn', 'Admin', 'smart-blog'),
							'flickr'    => esc_html_x('Flickr', 'Admin', 'smart-blog'),
							'soundcloud' => esc_html_x('SoundCloud', 'Admin', 'smart-blog'),
							'vimeo'     => esc_html_x('Vimeo', 'Admin', 'smart-blog'), 
						),
					),
					
				), // fields
			
			), // section
			
			array(
				'id' => 'header-logo',
				'title'  => esc_html_x('Logos', 'Admin', 'smart-blog'),
				'fields' => array(
			
					array(
						'name'    => 'image_logo',
						'value'   => '',
						'label'   => esc_html_x('Logo Image', 'Admin', 'smart-blog'),
						'desc'    => esc_html_x('Highly recommended to use a logo image in PNG format.', 'Admin', 'smart-blog'),
						'type'    => 'upload',
						'options' => array(
							'type'  => 'image',
						),
					),
					
					array(
						'name'    => 'image_logo_2x',
						'label'   => esc_html_x('Logo Image Retina (2x)', 'Admin', 'smart-blog'),
						'value'   => '',
						'desc'    => esc_html_x('This will be used for higher resolution devices like iPhone/Macbook.', 'Admin', 'smart-blog'),
						'type'    => 'upload',
						'options' => array(
							'type'  => 'image',
						),
					),
					
					array(
						'name'    => 'mobile_logo_2x',
						'value'   => '',
						'label'   => esc_html_x('Mobile Logo Retina (2x - Optional)', 'Admin', 'smart-blog'),
						'desc'    => esc_html_x('Use a different logo for mobile devices. Upload a logo twice the normal width and height.', 'Admin', 'smart-blog'),
						'type'    => 'upload',
						'options' => array(
							'type'  => 'media',
						),
					),
			
				), // fields
			
			), // section
						
		), // sections
		
	),	// panel		

	array(
		'title' => esc_html_x('Posts & Listings', 'Admin', 'smart-blog'),
		'id'    => 'options-tab-posts',
		'sections' => array(
			array(
				'id' => 'posts-general',
				'title'  => esc_html_x('General', 'Admin', 'smart-blog'),
				'fields' => array(

					array(
						'name' => 'meta_date',
						'label'   => esc_html_x('Post Meta: Show Date', 'Admin', 'smart-blog'),
						'value'   => 1,
						'desc'    => '',
						'type'    => 'checkbox',
					),

					array(
						'name' => 'meta_category',
						'label'   => esc_html_x('Post Meta: Show Category', 'Admin', 'smart-blog'),
						'value'   => 1,
						'desc'    => '',
						'type'    => 'checkbox',
					),

					array(
						'name' => 'posts_likes',
						'label'   => esc_html_x('Enable Post Likes', 'Admin', 'smart-blog'),
						'value'   => 1,
						'desc'    => '',
						'type'    => 'checkbox',
					),
					
					array(
						'name' => 'share_counters',
						'label'   => esc_html_x('Enable Share Numbers', 'Admin', 'smart-blog'),
						'value'   => 1,
						'desc'    => '',
						'type'    => 'checkbox',
					),
					
					array(
						'name' => 'post_galleries',
						'label'   => esc_html_x('Post Galleries Type', 'Admin', 'smart-blog'),
						'value'   => 'classic',
						'desc'    => esc_html_x('Refer to documentation to learn more about our unique justified galleries.', 'Admin', 'smart-blog'),
						'type'    => 'radio',
						'options' => array(
							'justified' => esc_html_x('Justified Galleries', 'Admin', 'smart-blog'),
							'classic'   => esc_html_x('Normal Galleries', 'Admin', 'smart-blog')
						)
					),
						
				), // fields
			), // section
			
			array(
				'id' => 'posts-single',
				'title'  => esc_html_x('Single Post', 'Admin', 'smart-blog'),
				'fields' => array(

					array(
						'name'   => 'post_navigation',
						'value' => 1,
						'label' => esc_html_x('Show Prev/Next Nav', 'Admin', 'smart-blog'),
						'desc'  => '',
						'type'  => 'checkbox'
					),
					
					array(
						'name' => 'single_share',
						'label'   => esc_html_x('Show Post Share', 'Admin', 'smart-blog'),
						'value'   => 1,
						'desc'    => '',
						'type'    => 'checkbox',
					),
					
					array(
						'name' => 'single_tags',
						'label'   => esc_html_x('Show Post Tags', 'Admin', 'smart-blog'),
						'value'   => 1,
						'desc'    => '',
						'type'    => 'checkbox',
					),
					
					array(
						'name' => 'show_featured',
						'label'   => esc_html_x('Show Featured Image Area', 'Admin', 'smart-blog'),
						'value'   => 1,
						'desc'    => esc_html_x('Stops displaying the featured image in large posts.', 'Admin', 'smart-blog'),
						'type'    => 'checkbox',	
					),
						
					array(
						'name' => 'featured_crop',
						'label'   => esc_html_x('Crop Featured Image', 'Admin', 'smart-blog'),
						'value'   => 1,
						'desc'    => esc_html_x('Crop featured image for consistent sizing and least bandwidth usage. Also applies to Blog Style listings.', 'Admin', 'smart-blog'),
						'type'    => 'checkbox',
					),
					
					array(
						'name' => 'single_all_cats',
						'label'   => esc_html_x('All Categories in Meta', 'Admin', 'smart-blog'),
						'value'   => 0,
						'desc'    => esc_html_x('If unchecked, only the Primary Category is displayed.', 'Admin', 'smart-blog'),
						'type'    => 'checkbox',	
					),
					
					array(
						'name' => 'related_posts',
						'label'   => esc_html_x('Show Related Posts', 'Admin', 'smart-blog'),
						'value'   => 1,
						'desc'    => '',
						'type'    => 'checkbox',	
					),
					
					array(
						'name' => 'related_posts_by',
						'label'   => esc_html_x('Related Posts Match By', 'Admin', 'smart-blog'),
						'value'   => 'cat_tags',
						'desc'    => '',
						'type'    => 'select',
						'options' => array(
							''     => esc_html_x('Categories', 'Admin', 'smart-blog'),
							'tags' => esc_html_x('Tags', 'Admin', 'smart-blog'),
							'cat_tags' => esc_html_x('Both', 'Admin', 'smart-blog'),
							 
						),
					),
					
					array(
						'name' => 'author_box',
						'label'   => esc_html_x('Show Author Box', 'Admin', 'smart-blog'),
						'value'   => 1,
						'desc'    => '',
						'type'    => 'checkbox',	
					),

				), // fields
			), // section
			
			array(
				'id' => 'posts-listings',
				'title'  => esc_html_x('Post Listings', 'Admin', 'smart-blog'),
				'fields' => array(
			
					array(
						'name' => 'post_share',
						'label'   => esc_html_x('Show Post Share', 'Admin', 'smart-blog'),
						'value'   => 1,
						'desc'    => '',
						'type'    => 'checkbox',
					),
					
					array(
						'name' => 'post_comments',
						'label'   => esc_html_x('Show Comment Count', 'Admin', 'smart-blog'),
						'value'   => 1,
						'desc'    => '',
						'type'    => 'checkbox',
					),
					
					array(
						'name'   => 'read_more',
						'value' => 1,
						'label' => esc_html_x('Enable "Keep Reading"', 'Admin', 'smart-blog'),
						'desc'  => '',
						'type'  => 'checkbox'
					),
					
					array(
						'name'    => 'post_body',
						'label'   => esc_html_x('Post Body', 'Admin', 'smart-blog'),
						'value'   => 'excerpt',
						'type'    => 'radio',
						'desc'    => esc_html_x('Note: Only applies to Blog Listing style. Both support WordPress <!--more--> teaser.', 'Admin', 'smart-blog'),
						'options' => array(
							'full' => esc_html_x('Full Post', 'Admin', 'smart-blog'),
							'excerpt' => esc_html_x('Excerpts', 'Admin', 'smart-blog'),
						),
					),
					
					array(
						'name'    => 'post_excerpt_blog',
						'label'   => esc_html_x('Excerpt Words: Blog Style', 'Admin', 'smart-blog'),
						'value'   => 150,
						'type'    => 'number',
						'desc'    => '',
					),
					
					array(
						'name'    => 'post_excerpt_grid',
						'label'   => esc_html_x('Excerpt Words: Grid Style', 'Admin', 'smart-blog'),
						'value'   => 15,
						'type'    => 'number',
						'desc'    => '',
					),
					
					
					array(
						'name'    => 'post_excerpt_list',
						'label'   => esc_html_x('Excerpt Words: List Style', 'Admin', 'smart-blog'),
						'value'   => 15,
						'type'    => 'number',
						'desc'    => '',
					),
					
					array(
						'name'    => 'title_trim_grid',
						'label'   => esc_html_x('Grid Style: Single Line Title', 'Admin', 'smart-blog'),
						'value'   => 1,
						'desc'    => '',
						'type'    => 'checkbox',
					),
					
					array(
						'name'    => 'grid_type',
						'label'   => esc_html_x('Grid Type', 'Admin', 'smart-blog'),
						'value'   => '',
						'desc'    => '',
						'type'    => 'radio',
						'options' => array(
							'' => esc_html_x('Default Style', 'Admin', 'smart-blog'),
							'masonry' => esc_html_x('Masonry Grid', 'Admin', 'smart-blog'),
						)
					),
			
				), // fields
			), // section
				
		) // sections
			
	), // panel
	
	

	array(
		'title' => esc_html_x('Footer Settings', 'Admin', 'smart-blog'),
		'id'    => 'options-tab-footer',
		'desc'  => esc_html_x('Middle footer is activated by adding an instagram widget.', 'Admin', 'smart-blog'),
		'sections' => array(
			array(
				'id' => 'footer-upper',
				'title'  => esc_html_x('Upper Footer', 'Admin', 'smart-blog'),
				'fields' => array(
			
					array(
						'name'  => 'footer_upper',
						'value' => 1,
						'label' => esc_html_x('Enable Upper Footer', 'Admin', 'smart-blog'),
						'desc'  => '',
						'type'  => 'checkbox'
					),
					
					array(
						'name'  => 'footer_logo',
						'value' => '',
						'label' => esc_html_x('Footer Logo', 'Admin', 'smart-blog'),
						'desc'  => esc_html_x('Add a logo to the left of subscribe box.', 'Admin', 'smart-blog'),
						'type'  => 'upload',
						'options' => array(
							'type' => 'image'
						)
					),
					
					array(
						'name'  => 'footer_logo_2x',
						'value' => '',
						'label' => esc_html_x('Footer Logo Retina (2x)', 'Admin', 'smart-blog'),
						'desc'  => '',
						'type'  => 'upload',
						'options' => array(
							'type' => 'image'
						)
					),
					
					array(
						'name'  => 'footer_mailchimp',
						'value' => '',
						'label' => esc_html_x('Mailchimp Form Submit URL', 'Admin', 'smart-blog'),
						'desc'  => esc_html_x('Refer to the documentation to learn how to create a mailchimp form.', 'Admin', 'smart-blog'),
						'type'  => 'text'
					),
					
					array(
						'name'  => 'footer_subscribe_label',
						'value' => 'Subscribe *now* to get *daily* updates',
						'label' => esc_html_x('Subscribe Message', 'Admin', 'smart-blog'),
						'desc'  => '',
						'type'  => 'text'
					),
			
				), // fields
			), // section
			
			array(
				'id' => 'footer-lower',
				'title'  => esc_html_x('Lower Footer', 'Admin', 'smart-blog'),
				'fields' => array(
			
					array(
						'name'  => 'footer_lower',
						'value' => 1,
						'label' => esc_html_x('Enable Lower Footer', 'Admin', 'smart-blog'),
						'desc'  => '',
						'type'  => 'checkbox'
					),
					
					array(
						'name'  => 'footer_copyright',
						'value' => '',
						'label' => esc_html_x('Copyright Message', 'Admin', 'smart-blog'),
						'desc'  => '',
						'type'  => 'text'
					),
					
					array(
						'name'  => 'footer_back_top',
						'value' => 1,
						'label' => esc_html_x('Show Back to Top', 'Admin', 'smart-blog'),
						'desc'  => '',
						'type'  => 'checkbox'
					),
			
				), // fields
			), // section
				
		) // sections
			
	), // panel
	
	array(
		'title' => esc_html_x('Colors & Style', 'Admin', 'smart-blog'),
		'id'    => 'options-tab-style',
		'sections' => array(
			array(
				'id' => 'style-general',
				'title'  => esc_html_x('General', 'Admin', 'smart-blog'),
				'fields' => array(
			
					array(
						'name'  => 'css_main_color',
						'value' => '#82af7c',
						'label' => esc_html_x('Main Theme Color', 'Admin', 'smart-blog'),
						'desc'  => '',
						'type'  => 'color',
						'css'   => array(

							'selectors' => array(
					
								'::selection' => 'background: rgba(%s, 0.8)',
								'::-moz-selection' => 'background: rgba(%s, 0.8)',

								'blockquote::before, .main-color, .post-meta .post-cat > a, .top-nav .menu li a:hover, .follow-us .social-link:hover .icon, 
								.top-bar .social-icons .icon:hover, .navigation .menu > li:hover > a, .navigation .menu > .current-menu-item > a, 
								.navigation .menu > .current-menu-parent > a, .navigation .menu > .current-menu-ancestor > a, .navigation li:hover > a::after, 
								.navigation .current-menu-item > a::after, .navigation .current-menu-parent > a::after, .navigation .current-menu-ancestor > a::after,
								.navigation .menu li li:hover > a, .navigation .menu li li.current-menu-item > a, .post-content a, .post-tags a, .post-share .count:hover, 
								.count-heart.voted, .post-counters .count-heart.voted, .comments-area .number, .comment-reply-link, .about-footer .more, 
								.about-footer .social-link:hover, .widget-social .social-link:hover, .widget-quote .widget-title, .widget-posts .title-link, 
								.social-follow .icon, .tagcloud a:hover, .widget_calendar caption, .widget_calendar td a, .search-action .icon-search:hover'
									=> 'color: %s',
									
								'input[type="submit"], button, input[type="button"], .button, .main-pagination .next a:hover, .main-pagination .previous a:hover, 
								.page-links .current, .page-links a:hover, .page-links > span, .post-content ul li::before, .bypostauthor .post-author, .read-more a:hover, 
								.archive-head .title-ribbon, .posts-carousel .heading::after, .subscribe-form .button, .alt-slider .button'
									=> 'background: %s',
									
								'.main-pagination .next a:hover, .main-pagination .previous a:hover, .page-links .current, .page-links a:hover, .page-links > span, 
								.read-more a:hover, .widget-social .social-link:hover, .tagcloud a:hover, .archive-head .title-ribbon::after, .archive-head .title-ribbon::before, 
								.alt-slider .button:hover'
									=> 'border-color: %s',
									
								'.the-post.sticky' => 'border-bottom-color: %s',
							)
						)
					),
					
					array(
						'name'  => 'css_body_color',
						'value' => '#494949',
						'label' => esc_html_x('Post Body Color', 'Admin', 'smart-blog'),
						'desc'  => '',
						'type'  => 'color',
						'css'   => array(
							'selectors' => array(
								'.post-content' => 'color: %s'
							)
						)
					),
					
					array(
						'name'  => 'css_site_bg',
						'value' => '#f8f8f8',
						'label' => esc_html_x('Site Background Color', 'Admin', 'smart-blog'),
						'desc'  => '',
						'type'  => 'color',
						'css'   => array(
							'selectors' => array(
								'body' => 'background-color: %s'
							)
						)
					),

					array(
						'name'  => 'css_footer_bg',
						'value' => '#494949',
						'label' => esc_html_x('Footer Background', 'Admin', 'smart-blog'),
						'desc'  => '',
						'type'  => 'color',
						'css'   => array(
							'selectors' => array(
								'.main-footer' => 'background-color: %s; border-top: 0'
							)
						)
					),

				), // fields
			), // section
			
			array(
				'id' => 'style-header',
				'title'  => esc_html_x('Header', 'Admin', 'smart-blog'),
				'fields' => array(
			
					array(
						'name'  => 'css_topbar_bg',
						'value' => '#fff',
						'label' => esc_html_x('Top Bar Background', 'Admin', 'smart-blog'),
						'desc'  => '',
						'type'  => 'color',
						'css'   => array(
							'selectors' => array(
								'.top-bar-content' => 'background-color: %s'
							)
						)
					),
					
					array(
						'name'  => 'css_topbar_social',
						'value' => '#fff',
						'label' => esc_html_x('Top Bar Social Icons', 'Admin', 'smart-blog'),
						'desc'  => '',
						'type'  => 'color',
						'css'   => array(
							'selectors' => array(
								'.top-bar .social-icons .icon' => 'color: %s'
							)
						)
					),

					array(
						'name'  => 'css_logo_padding_top',
						'value' => 50,
						'label' => esc_html_x('Logo Padding Top', 'Admin', 'smart-blog'),
						'desc'  => '',
						'type'  => 'number',
						'css'   => array(
							'selectors' => array(
								'.main-head .title' => 'padding-top: %spx'
							)
						)
					),
					

					array(
						'name'  => 'css_logo_padding_bottom',
						'value' => 50,
						'label' => esc_html_x('Logo Padding Bottom', 'Admin', 'smart-blog'),
						'desc'  => '',
						'type'  => 'number',
						'css'   => array(
							'selectors' => array(
								'.main-head .title' => 'padding-bottom: %spx'
							)
						)
					),

				), // fields
			), // section
			
			array(
				'id' => 'style-navigation',
				'title'  => esc_html_x('Navigation', 'Admin', 'smart-blog'),
				'fields' => array(
			
					array(
						'name'  => 'css_nav_color',
						'value' => '#434343',
						'label' => esc_html_x('Top-level Links Color', 'Admin', 'smart-blog'),
						'desc'  => '',
						'type'  => 'color',
						'css'   => array(
							'selectors' => array(
								'.navigation .menu > li > a' => 'color: %s'
							)
						)
					),
					
					array(
						'name'  => 'css_nav_hover',
						'value' => '#717171',
						'label' => esc_html_x('Top-level Hover/Active', 'Admin', 'smart-blog'),
						'desc'  => '',
						'type'  => 'color',
						'css'   => array(
							'selectors' => array(
								'.navigation .menu > li:hover > a, .navigation .menu > .current-menu-item > a, 
								.navigation .menu > .current-menu-parent > a, .navigation .menu > .current-menu-ancestor > a' 
									=> 'color: %s'
							)
						)
					),					
					
					array(
						'name'  => 'css_nav_drop_bg',
						'value' => '#fff',
						'label' => esc_html_x('Dropdown Background', 'Admin', 'smart-blog'),
						'desc'  => '',
						'type'  => 'color',
						'css'   => array(
							'selectors' => array(
								'.navigation .menu ul' => 'background: %s',

								// Use transparent borders to adapt to background
								'.navigation .menu > li li a' => 'border-color: rgba(255, 255, 255, 0.07)'
							)
						)
					),

					array(
						'name'  => 'css_nav_drop_color',
						'value' => '#555',
						'label' => esc_html_x('Dropdown Links Color', 'Admin', 'smart-blog'),
						'desc'  => '',
						'type'  => 'color',
						'css'   => array(
							'selectors' => array(
								'.navigation .menu > li li a' => 'color: %s'
							)
						)
					),
					
					array(
						'name'  => 'css_nav_drop_hover',
						'value' => '#82af7c',
						'label' => esc_html_x('Dropdown Links Hover/Active', 'Admin', 'smart-blog'),
						'desc'  => '',
						'type'  => 'color',
						'css'   => array(
							'selectors' => array(
								'.navigation .menu li li:hover > a, .navigation .menu li li.current-menu-item > a' => 'color: %s'
							)
						)
					),

				), // fields
			), // section

				
		) // sections
	), // panel
	
	

	array(
		'title' => esc_html_x('Typography', 'Admin', 'smart-blog'),
		'id'    => 'options-tab-typography',
		'desc'  => esc_html_x('All the typography fonts are from Google Fonts. You can either select one from the list or click and type the name of any font from Google Fonts directory.', 'Admin', 'smart-blog'),
		'sections' => array(
			array(
				'id' => 'typography-fonts',
				'title'  => esc_html_x('Fonts & Sizes', 'Admin', 'smart-blog'),
				'fields' => array(
					array(
						'name' => 'css_font_primary',
						'label' => esc_html_x('Primary Font', 'Admin', 'smart-blog'),
						'value' => array('font_name' => 'Open Sans'),
						'desc'  => esc_html_x('Select from list or click and type your own Google Font name.', 'Admin', 'smart-blog'),
						'type'  => 'typography',
						'typeface' => true, // is family
						'css'   => array(
							'selectors' => 'body, .navigation .menu > li::after, .comments-area .number, .bypostauthor .post-author',
						)
					),
					
					array(
						'name' => 'css_font_secondary',
						'label' => esc_html_x('Secondary/Contrast Font', 'Admin', 'smart-blog'),
						'value' => array('font_name' => 'Merriweather'),
						'desc'  => '',
						'type'  => 'typography',
						'typeface' => true, // is family
						'css'   => array(
							'selectors' => 'blockquote, .post-title, .common-heading, .follow-us .message, .navigation, .the-post .post-title, .author-box .author, 
								.comment .comment-author, .archive-head .title, .filter-cats a, .widget-posts .title-link, .social-follow .plus, .slider-nav .post-heading, 
								.sidebar .widget-title, .subscribe-form .message, .lower-footer, .search-overlay, .widget-cta .message, .widget-quote',
						)
					),
					
					array(
						'name' => 'css_font_sidebar_title',
						'label' => esc_html_x('Widget Titles', 'Admin', 'smart-blog'),
						'value' => array('font_name' => 'Merriweather', 'font_weight' => '700', 'font_size' => '18'),
						'desc'  => '',
						'type'  => 'typography',
						'css'   => array(
							'selectors' => '.sidebar .widget-title',
						)
					),
					
					
					array(
						'name' => 'css_font_nav_links',
						'label' => esc_html_x('Navigation Links', 'Admin', 'smart-blog'),
						'value' => array('font_name' => 'Merriweather', 'font_weight' => '400', 'font_size' => '12'),
						'desc'  => '',
						'type'  => 'typography',
						'css'   => array(
							'selectors' => '.navigation .menu > li > a',
						)
					),
					
					array(
						'name' => 'css_font_nav_drops',
						'label' => esc_html_x('Navigation Dropdowns', 'Admin', 'smart-blog'),
						'value' => array('font_name' => 'Merriweather', 'font_weight' => '400', 'font_size' => '12'),
						'desc'  => '',
						'type'  => 'typography',
						'css'   => array(
							'selectors' => '.navigation .menu > li li a',
						)
					),
					
					array(
						'name' => 'css_font_post_titles',
						'label' => esc_html_x('Post Titles', 'Admin', 'smart-blog'),
						'value' => array('font_name' => 'Merriweather', 'font_weight' => '700', 'font_size' => '25'),
						'desc'  => '',
						'type'  => 'typography',
						'css'   => array(
							'selectors' => '.the-post .post-title',
						)
					),
					
					array(
						'name' => 'css_font_titles_small',
						'label' => esc_html_x('Small Post Titles', 'Admin', 'smart-blog'),
						'value' => array('font_name' => 'Merriweather', 'font_weight' => '700', 'font_size' => '18'),
						'desc'  => '',
						'type'  => 'typography',
						'css'   => array(
							'selectors' => '.common-heading',
						)
					),
					
					array(
						'name' => 'css_font_post_meta',
						'label' => esc_html_x('Post Meta', 'Admin', 'smart-blog'),
						'value' => array('font_name' => 'Open Sans', 'font_weight' => '400'),
						'desc'  => '',
						'type'  => 'typography',
						'css'   => array(
							'selectors' => '.post-meta, .the-post .post-meta',
						)
					),
					
					array(
						'name' => 'css_font_post_body',
						'label' => esc_html_x('Post Body Content', 'Admin', 'smart-blog'),
						'value' => array('font_name' => 'Open Sans', 'font_weight' => '400', 'font_size' => '14'),
						'desc'  => '',
						'type'  => 'typography',
						'css'   => array(
							'selectors' => '.post-content',
						)
					),
					
					array(
						'name' => 'css_font_post_h1',
						'label' => esc_html_x('Post Body H1', 'Admin', 'smart-blog'),
						'value' => array('font_size' => '25'),
						'desc'  => '',
						'type'  => 'typography',
						'css'   => array(
							'selectors' => 'h1',
						)
					),
					
					array(
						'name' => 'css_font_post_h2',
						'label' => esc_html_x('Post Body H2', 'Admin', 'smart-blog'),
						'value' => array('font_size' => '22'),
						'desc'  => '',
						'type'  => 'typography',
						'css'   => array(
							'selectors' => 'h2',
						)
					),
					
					array(
						'name' => 'css_font_post_h3',
						'label' => esc_html_x('Post Body H3', 'Admin', 'smart-blog'),
						'value' => array('font_size' => '20'),
						'desc'  => '',
						'type'  => 'typography',
						'css'   => array(
							'selectors' => 'h3',
						)
					),
					
					array(
						'name' => 'css_font_post_h4',
						'label' => esc_html_x('Post Body H4', 'Admin', 'smart-blog'),
						'value' => array('font_size' => '18'),
						'desc'  => '',
						'type'  => 'typography',
						'css'   => array(
							'selectors' => 'h4',
						)
					),
										
					array(
						'name' => 'css_font_post_h5',
						'label' => esc_html_x('Post Body H5', 'Admin', 'smart-blog'),
						'value' => array('font_size' => '16'),
						'desc'  => '',
						'type'  => 'typography',
						'css'   => array(
							'selectors' => 'h5',
						)
					),
					
					array(
						'name' => 'css_font_post_h6',
						'label' => esc_html_x('Post Body H6', 'Admin', 'smart-blog'),
						'value' => array('font_size' => '14'),
						'desc'  => '',
						'type'  => 'typography',
						'css'   => array(
							'selectors' => 'h6',
						)
					),
				) // fields
			), // section
			
			array(
				'id' => 'typography-advanced',
				'title'  => esc_html_x('Advanced', 'Admin', 'smart-blog'),
				'fields' => array(
					array(
						'name' => 'font_charset',
						'label' => esc_html_x('Google Font Charsets', 'Admin', 'smart-blog'),
						'value' => array(),
						'type'  => 'checkboxes',
						'options' => array(
							'latin' => 'Latin',
							'latin-ext' => 'Latin Extended',
							'cyrillic'  => 'Cyrillic',
							'cyrillic-ext'  => 'Cyrillic Extended', 
							'greek'  => 'Greek',
							'greek-ext' => 'Greek Extended',
							'vietnamese' => 'Vietnamese'
						),
					),
					
				), // fields	
			), // section
			
		), // sections
	), // panel
	

	array(
		'sections' => array(
			array(
				'id' => 'custom-css',
				'title'  => esc_html_x('Custom CSS', 'Admin', 'smart-blog'),
				'fields' => array(
			
					array(
						'name'  => 'css_custom',
						'value' => '',
						'label' => esc_html_x('Custom CSS', 'Admin', 'smart-blog'),
						'desc'  => '',
						'type'  => 'textarea',
						'transport' => 'postMessage'
					),
					
				) // fields
			), // section
			
			array(
				'id' => 'reset-customizer',
				'title'  => esc_html_x('Reset Settings', 'Admin', 'smart-blog'),
				'fields' => array(
					array(
						'name' => 'reset_customizer',
						'value' => esc_html_x('Reset All Settings', 'Admin', 'smart-blog'),
						'desc'  => esc_html_x('Clicking the Reset button will revert all settings in the customizer except for menus, widgets and site identity.', 'Admin', 'smart-blog'),
						'type'  => 'button',
						'input_attrs' => array(
							'class' => 'button reset-customizer',
						),
					)
					
				) // fields
			), // section
		
		) // sections
		
	), // panel
	
));