<?php 
/**
 * Partial: Top Hamburger Menu
 */
?>

		<div class="top-actions cf">
			
			<div class="menu-action">
			
				<?php 
					$class = !Bunyad::options()->topbar_menu ? ' inactive' : '';
				?>
				<a href="#" class="action menu icon-hamburger<?php echo esc_attr($class); ?>" title="<?php esc_attr_e('Menu', 'smart-blog'); ?>"></a>
				
				<?php if (Bunyad::options()->topbar_menu && has_nav_menu('smart-blog-top')): ?>
				
				<nav class="top-nav cf">
					<?php wp_nav_menu(array('theme_location' => 'smart-blog-top', 'fallback_cb' => '')); ?>
					
					<?php							
						/**
						 * Show follow us part
						 */
						$services = Bunyad::get('social')->get_services();
						$links    = Bunyad::options()->social_profiles;
						$active   = Bunyad::options()->topbar_menu_social;
						
						// Change icon for Facebook
						$services['facebook']['icon'] = 'facebook-squared';
					?>
					
					<?php if (!empty($active)): // Enabled? ?>
					
					<div class="follow-us">
					
						<h6 class="message"><?php esc_html_e('follow me on:', 'smart-blog'); ?></h6>
					
						<?php 
						
						foreach ( (array) $active as $icon):
							$social = $services[$icon];
							$url    = !empty($links[$icon]) ? $links[$icon] : '#';
						?>
							<a href="<?php echo esc_url($url); ?>" class="social-link"><i class="icon icon-<?php echo esc_attr($social['icon']); ?>"></i><?php 
								echo esc_html($social['label']); ?></a>
						
						<?php
						endforeach;
						?>
					</div>
					
					<?php endif; ?>
					
					
					<?php if (has_nav_menu('smart-blog-top-foot')): ?>
					
					<div class="foot">
						<?php wp_nav_menu(array('theme_location' => 'smart-blog-top-foot', 'menu_class' => 'menu', 'fallback_cb' => '')); ?>
					</div>
					
					<?php endif; ?>
					
				</nav>											
				<?php endif; // menu enabled check ?>
				
			</div>

		</div>