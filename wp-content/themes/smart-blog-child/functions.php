<?php
/**
 * Theme Name child theme functions and definitions
 */

/*—————————————————————————————————————————*/
/* Include the parent theme style.css
/*—————————————————————————————————————————*/

function theme_enqueue_styles() {
    wp_enqueue_style( 'parent', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'slick slider', get_stylesheet_directory_uri() . '/lib/vendor/slick/slick/slick.css' );
    wp_enqueue_style( 'slick slider theme', get_stylesheet_directory_uri() . '/lib/vendor/slick/slick/slick-theme.css' );
	
  

}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' ); 

function theme_enqueue_javascripts() {

    wp_enqueue_script( 'slick slider',get_stylesheet_directory_uri() . '/lib/vendor/slick/slick/slick.min.js' );
    wp_enqueue_script( 'CUSTOM JS',get_stylesheet_directory_uri() . '/js/custom.js' );
	
  

}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_javascripts' ); 