<?php
/**
 * Header Layout: Alternate
 */
?>

	<header id="main-head" class="main-head alt-head">

		<div class="wrap">
		
			<?php get_template_part('partials/header/top-menu'); ?>
		
			<div class="title">
			
				<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
				
				<?php if (Bunyad::options()->image_logo): // custom logo ?>
					
					<?php Bunyad::get('helpers')->mobile_logo(); ?>
					
					<img <?php
						/**
						 * Get escaped attributes and add optionally add srcset for retina
						 */ 
						Bunyad::markup()->attribs('image-logo', array(
							'src'    => Bunyad::options()->image_logo,
							'class'  => 'logo-image',
							'alt'    => get_bloginfo('name', 'display'),
							'srcset' => array(Bunyad::options()->image_logo => '', Bunyad::options()->image_logo_2x => '2x')
						)); ?> />
						 
				<?php else: ?>
					
					<span class="text"><?php echo esc_html(get_bloginfo('name', 'display')); ?></span>
					
				<?php endif; ?>
				
				</a>
			
			</div>
			
			<?php if (Bunyad::options()->topbar_search): ?>
				
				<div class="search-action cf">
				
					<a href="#" class="action search icon-search" title="<?php esc_attr_e('Search', 'smart-blog'); ?>"></a>
					
					<div class="search-overlay"><?php get_search_form(); ?></div>
				
				</div>
				
			<?php endif; ?>
			
		</div>
		
		<div class="nav-wrap wrap">	
			<?php if (has_nav_menu('smart-blog-main')): ?>
						
				<nav class="navigation" data-sticky-bar="<?php echo esc_attr(Bunyad::options()->topbar_sticky); ?>">					
					<?php wp_nav_menu(array('theme_location' => 'smart-blog-main', 'fallback_cb' => '')); ?>
				</nav>
				
			<?php endif; ?>
		</div>
		
	</header> <!-- .main-head -->