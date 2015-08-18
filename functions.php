<?php 

 /** 
 * Child Theme Setup 
 * 
 * This setup function attaches all of the site-wide functions * to the correct actions 
 * and filters. All the functions themselves are defined inside this setup function. 
 * 
 */ 
 add_action('genesis_setup','child_theme_setup', 15); 
 function child_theme_setup() { 
 /* =====================================================================================*/


// Child theme (do not remove)
define('CHILD_THEME_NAME', 'JP Genesis Starter');
define('CHILD_THEME_URL', 'http://www.johnpotessdesign.com/');
define('CHILD_THEME_VERSION', '0.0.1');


 //* Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'jp_scripts_and_styles', 15);
function jp_scripts_and_styles() {

	// Styles
	wp_enqueue_style( 'site-styles', get_stylesheet_directory_uri() . '/css/style.css', array(), CHILD_THEME_VERSION );
 	wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', array(), CHILD_THEME_VERSION); 

	// Scripts
	wp_enqueue_script('jquery');
	wp_enqueue_script('site-js', get_stylesheet_directory_uri() . '/js/site.js', array('jquery'), '', true);
}

//* Add HTML5 support
add_theme_support( 'html5' );

// //* Add viewport meta tag for mobile browsers
// add_theme_support( 'genesis-responsive-viewport' );

//* Remove genesis default templates
add_filter( 'theme_page_templates', 'jp_remove_genesis_page_templates' );
function jp_remove_genesis_page_templates( $page_templates ) {
	unset( $page_templates['page_archive.php'] );
	unset( $page_templates['page_blog.php'] );
	return $page_templates;
}


//* Remove site layouts
genesis_unregister_layout('content-sidebar-sidebar');
genesis_unregister_layout('sidebar-sidebar-content');
genesis_unregister_layout('sidebar-content-sidebar');

//* Set full-width content as the default layout
genesis_set_default_layout('full-width-content');

//* Add support for structural wraps
add_theme_support( 'genesis-structural-wraps', array(
	'header',
	'nav',
	'subnav',
	'site-inner',
	'footer-widgets',
	'footer'
) );

//* Set preferred Genesis settings
add_filter('genesis_theme_settings_defaults', 'mtd_define_genesis_settings', 10, 2);
function mtd_define_genesis_settings($options) {

    $options['trackbacks_posts'] = 0;
    $options['breadcrumb_home'] = 1;
    $options['breadcrumb_posts_page'] = 1;
    $options['breadcrumb_single'] = 1;
    $options['breadcrumb_page'] = 1;
    $options['breadcrumb_archive'] = 1;
    $options['content_archive_thumbnail'] = 1;
    $options['image_alignment'] = '';
    
    return $options;
}

// Remove prefix text from breadcrumbs
add_filter('genesis_breadcrumb_args', 'mtd_breadcrumb_args');
function mtd_breadcrumb_args($args) {
    $args['labels']['prefix'] = '';
    // $args['sep']           = ' ';
    return $args;
}

//* Remove Site Description in Header
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );

// Reposition the primary nav
remove_action('genesis_after_header', 'genesis_do_nav');
add_action('genesis_header', 'genesis_do_nav', 10);

// //* Unregster Primary, Secondary Sidebar, and Header-Right Widget area
// 	unregister_sidebar( 'sidebar' );
// 	unregister_sidebar( 'sidebar-alt');	
// 	unregister_sidebar( 'header-right');

// //* Remove Primary and Secondary Sidebar
// 	remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
// 	remove_action( 'genesis_sidebar_alt', 'genesis_do_sidebar_alt' );



// Remove comment form allowed tags
add_filter( 'comment_form_defaults', 'mobile_first_remove_comment_form_allowed_tags' );
function mobile_first_remove_comment_form_allowed_tags($defaults) {
    $defaults['comment_notes_after'] = '';
    return $defaults;
}

//* Modify the length of post excerpts
add_filter( 'excerpt_length', 'sp_excerpt_length' );
function sp_excerpt_length( $length ) {
	return 40; // pull first 40 words
}

// Remove edit links
add_filter('genesis_edit_post_link', '__return_false');

// Add author box to single posts and author archives
add_filter('get_the_author_genesis_author_box_single', '__return_true');
add_filter('get_the_author_genesis_author_box_archive', '__return_true');

// // And remove it from anything that's not a post
// add_action('genesis_entry_footer', 'wpm_remove_author_box');
// function wpm_remove_author_box() {
//     if (get_post_type() != 'post') {
//         remove_action('genesis_after_entry', 'genesis_do_author_box_single', 8);
//         // remove_action( 'genesis_after_post', 'genesis_do_author_box_single', 8 );
//     }
// }

// Modify the size of the Gravatar in the author box
add_filter('genesis_author_box_gravatar_size', 'mobile_first_author_box_gravatar');
function mobile_first_author_box_gravatar($size) {
    return 100;
}

// Modify the size of the Gravatar in the entry comments
add_filter('genesis_comment_list_args', 'mobile_first_comments_gravatar');
function mobile_first_comments_gravatar($args) {
    $args['avatar_size'] = 60;
    return $args;
}

//* Customize the credits
add_filter( 'genesis_footer_creds_text', 'jp_footer_creds_text' );
function jp_footer_creds_text() {
	echo '<div class="creds"><p>';
	echo 'Copyright &copy; ';
	echo date('Y');
	echo ' &middot; <a href="http://www.site_name.com">Site Name Owner</a>';
	echo '</p></div>';
}



















 /* =====================================================================================*/
// Close Child Theme Setup
 }