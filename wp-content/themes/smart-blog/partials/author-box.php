<?php 
/**
 * Partial template for Author Box
 */

?>
	<div class="author-box add-separator">
	
		<?php echo get_avatar(get_the_author_meta('user_email'), 107); ?>
		
		<div class="content">
		
			<span class="author">
				<?php the_author_posts_link(); ?>
			</span>
			
			<p class="author-bio"><?php echo wp_kses_post(get_the_author_meta('description')); // sanitized html only ?></p>
			
			<ul class="social-icons">
			<?php 
			
				// author fields
				$fields = array(
					'url' => array('icon' => 'home', 'label' => esc_html__('Website', 'smart-blog')),
					'bunyad_facebook' => array('icon' => 'facebook', 'label' => esc_html__('Facebook', 'smart-blog')),
					'bunyad_twitter' => array('icon' => 'twitter', 'label' => esc_html__('Twitter', 'smart-blog')), 
					'bunyad_instagram' => array('icon' => 'instagram', 'label' => esc_html__('Instagram', 'smart-blog')),
					'bunyad_bloglovin' => array('icon' => 'heart', 'label' => esc_html__('BlogLovin', 'smart-blog')),
					'bunyad_pinterest' => array('icon' => 'pinterest', 'label' => esc_html__('Pinterest', 'smart-blog')),
					'bunyad_linkedin' => array('icon' => 'linkedin', 'label' => esc_html__('LinkedIn', 'smart-blog')),
					'bunyad_dribbble' => array('icon' => 'dribbble', 'label' => esc_html__('Dribble', 'smart-blog')),
					'bunyad_gplus' => array('icon' => 'google-plus', 'label' => esc_html__('Google+', 'smart-blog')), 
				);
				
				$the_meta = '';
				foreach ($fields as $meta => $data): 
				
					if (!get_the_author_meta($meta)) {
						continue;
					}
					
					$type     = $data['icon'];
					$the_meta = get_the_author_meta($meta);
					
					if ($meta == 'bunyad_public_email') {
						$the_meta = 'mailto:' . $the_meta;
					}
			?>
				
				<li>
					<a href="<?php echo esc_url($the_meta); ?>" class="icon icon-<?php echo esc_attr($type); ?>" title="<?php echo esc_attr($data['label']); ?>"> 
						<span class="visuallyhidden"><?php echo esc_html($data['label']); ?></span></a>				
				</li>
				
				
			<?php endforeach; ?>
			</ul>
			
		</div>
		
	</div>