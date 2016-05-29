<?php
/**
 * Partial: Top bar template - displayed above logo
 */

?>

	<div class="top-bar">
	
		<div class="top-bar-content" data-sticky-bar="<?php echo esc_attr(Bunyad::options()->topbar_sticky); ?>">
			<div class="wrap cf">

				<?php get_template_part('partials/header/top-menu'); ?>
				
			
				<?php if (has_nav_menu('smart-blog-main')): ?>
						
				<nav class="navigation">					
					<?php wp_nav_menu(array('theme_location' => 'smart-blog-main', 'fallback_cb' => '')); ?>
				</nav>
				
				<?php endif; ?>
				
				
				<?php if (Bunyad::options()->topbar_search): ?>
				
				<div class="search-action cf">
				
					<a href="#" class="action search icon-search" title="<?php esc_attr_e('Search', 'smart-blog'); ?>"></a>
					
					<div class="search-overlay"><?php get_search_form(); ?></div>
				
				</div>
				
				<?php endif; ?>
				
				
				<?php if (Bunyad::options()->topbar_social): ?>
				
				<ul class="social-icons cf">
				
					<?php
					
					/**
					 * Use theme settings to show enabled icons
					 */
					$services = Bunyad::get('social')->get_services();
					$links    = Bunyad::options()->social_profiles;
					
					foreach ( (array) Bunyad::options()->topbar_social as $icon):
					
						$service = $services[$icon];
						$url = !empty($links[$icon]) ? $links[$icon] : '#';
					?>
				
					<li><a href="<?php echo esc_url($url); ?>" class="icon icon-<?php echo esc_attr($service['icon']); 
						?>"><span class="visuallyhidden"><?php echo esc_html($service['label']); ?></span></a></li>
											
					<?php endforeach; ?>
				
				</ul>
				
				<?php endif; ?>
				
			</div>			
		</div>
		
	</div>
