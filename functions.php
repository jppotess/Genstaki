<?php 

// Child theme (do not remove)
define('CHILD_THEME_NAME', 'thesimplekind');
define('CHILD_THEME_URL', 'http://www.johnpotessdesign.com/');
define('CHILD_THEME_VERSION', '0.1.0');


 //* Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'gs_scripts_and_styles', 15);
function gs_scripts_and_styles() {

// Styles
wp_enqueue_style( 'site-styles', get_stylesheet_directory_uri() . '/app/css/styles.min.css', array(), CHILD_THEME_VERSION );
wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', array(), CHILD_THEME_VERSION); 

// Scripts
wp_enqueue_script('jquery');
wp_enqueue_script('site-scripts', get_stylesheet_directory_uri() . '/app/js/scripts.min.js', array('jquery'), '', true);
}

register_theme_directory( dirname( __FILE__ ) . '/app/' );
