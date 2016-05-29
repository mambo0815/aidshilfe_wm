<?php
/**
 * The template for displaying theme header
 * 
 * Parts: Top bar, Logo, Navigation
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>

	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta http-equiv="x-ua-compatible" content="ie=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
		
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<div class="main-wrap">

	<?php if (!Bunyad::options()->header_layout): // Default header ?>

	<header id="main-head" class="main-head">
	
		<?php get_template_part('partials/header/top-bar'); ?>
		
		<div class="wrap">
		
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
		
		</div>
		
	</header> <!-- .main-head -->
	
	<?php else: ?>
	
		<?php get_template_part('partials/header/layout-' . Bunyad::options()->header_layout); ?>
	
	<?php endif; ?>
	
<?php do_action('bunyad_pre_main_content'); ?>
	