<?php

/**
 * Default 404 Page
 */


get_header();

?>

<div class="main wrap">
	<div class="ts-row cf">
		<div class="col-12 main-content cf">
	
		<div class="the-post grid-box the-page cf">
		
			<header class="post-heading">
				<h1 class="main-heading"><?php esc_html_e('Page Not Found!', 'smart-blog'); ?></h1>
			</header>
		
			<div class="post-content error-page row">
				
				<div class="col-3 text-404 main-color">404</div>
				
				<div class="col-8 post-content">
					<p>
					<?php esc_html_e("We're sorry, but we can't find the page you were looking for. It's probably some thing we've done wrong but now we know about it and we'll try to fix it. In the meantime, try one of these options:", 'smart-blog'); ?>
					</p>
					<ul class="links fa-ul">
						<li><i class="fa fa-angle-double-right"></i> <a href="javascript: history.go(-1);"><?php esc_html_e('Go to Previous Page', 'smart-blog'); ?></a></li>
						<li><i class="fa fa-angle-double-right"></i> <a href="<?php echo esc_url(home_url()); ?>"><?php esc_html_e('Go to Homepage', 'smart-blog'); ?></a></li>
					</ul>
				</div>
				
			</div>

		</div>

		</div> <!-- .main-content -->
		
	</div> <!-- .ts-row -->
</div> <!-- .main -->

<?php get_footer(); ?>