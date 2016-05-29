<?php 
/**
 * Footer template for the site footer
 * 
 * The footer is split into three sections:
 * 
 *  - Logo + Subscribe section if enabled
 *  - Instagram section
 *  - Copyright and Back to top button
 */
?>
	<footer class="main-footer">

		<?php if (Bunyad::options()->footer_upper): ?>	
		
		<section class="upper-footer">
			<div class="wrap">
				
				<?php if (Bunyad::options()->footer_logo): ?>
				
				<div class="logo">
					<img <?php
						/**
						 * Get escaped attributes and add optionally add srcset for retina
						 */ 
						Bunyad::markup()->attribs('footer-logo', array(
							'src'    => Bunyad::options()->footer_logo,
							'class'  => 'footer-logo',
							'alt'    => get_bloginfo('name', 'display'),
							'srcset' => array(Bunyad::options()->footer_logo => '', Bunyad::options()->footer_logo_2x => '2x')
						)); ?> />
				</div>
				
				<?php endif; ?>
				
				<div class="subscribe-form">
				
					<form method="post" action="<?php echo esc_url(Bunyad::options()->footer_mailchimp); ?>">
						<label class="message"><?php echo apply_filters('bunyad_text_weight', esc_html(Bunyad::options()->footer_subscribe_label)); ?></label>
						<input type="text" name="EMAIL" class="email" placeholder="<?php esc_attr_e('Enter your email here', 'smart-blog'); ?>" />
						<input type="submit" value="<?php echo esc_attr('Subscribe', 'smart-blog'); ?>" name="subscribe" class="button" />
					</form>
				
				</div>
			</div>
		</section>
		
		<?php endif; ?>
		
		<?php if (is_active_sidebar('smart-blog-instagram')): ?>
		
		<section class="mid-footer cf">
			<?php dynamic_sidebar('smart-blog-instagram'); ?>
		</section>
		
		<?php endif; ?>
		
		
		<?php if (Bunyad::options()->footer_lower): ?>
		
		<section class="lower-footer cf">
			<div class="wrap">
				<p class="copyright"><?php echo wp_kses_post(Bunyad::options()->footer_copyright); ?></p>
				
				<?php if (Bunyad::options()->footer_back_top): ?>
				<div class="to-top">
					<a href="#" class="back-to-top"><i class="icon-up-open-mini"></i> <?php esc_html_e('Top', 'smart-blog'); ?></a>
				</div>
				<?php endif; ?>
			</div>
		</section>
		
		<?php endif; ?>
	
	</footer>
	
</div> <!-- .main-wrap -->

<div class="mobile-menu-container off-canvas">
	<div class="close">
		<a href="#"><span><?php esc_html_e('Navigate', 'smart-blog'); ?></span><i class="icon icon-cancel"></i></a>
	</div>
	
	<?php if (has_nav_menu('smart-blog-mobile')): ?>

		<?php wp_nav_menu(array('container' => '', 'menu_class' => 'mobile-menu', 'theme_location' => 'smart-blog-mobile')); ?>

	<?php else: ?>
	
		<ul class="mobile-menu"></ul>

	<?php endif;?>
</div>

<?php wp_footer(); ?>

</body>
</html>