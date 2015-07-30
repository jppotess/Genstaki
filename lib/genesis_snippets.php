<?php
GENESIS SETUP
=========================================================================
=========================================================================

/**Theme Setup**
	/*	
	*	This setup function attaches all of the 
	*	site-wide functions to the correct 
	*	actions and filters. All the functions 
	*	themselves are defined below this setup 
	*	function. 
	*/ // Replaces 'start the engine'

	 add_action('genesis_setup','child_theme_setup', 15); 
	 function child_theme_setup() { 

	 	/*wrap all functions within this function*/

	};


**Enqueue Google Fonts**
	//* Enqueue Google Fonts
	add_action( 'wp_enqueue_scripts', 'genesis_sample_google_fonts' );
	function genesis_sample_google_fonts() {

		wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700', array(), CHILD_THEME_VERSION );

	}



**Enable HTML5 Markup on Site**
	//* Add HTML5 markup structure
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );


**Add Viewport Meta tag to site - Enabe mobile responsive viewport**
1. Standard Viewport
		//* Add Viewport meta tag for mobile browsers (requires HTML5 theme support)
		add_theme_support( 'genesis-responsive-viewport' );
2. Custom Viewport tag
			//* Add custom Viewport meta tag for mobile browsers
		add_action( 'genesis_meta', 'sp_viewport_meta_tag' );
		function sp_viewport_meta_tag() {
			echo '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>';
		}


**Wrap Scripts in Function**
	function theme_name_scripts() {
		// this holds all theme scripts(including exampls bellow)
	}
	 add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );


**Scripts to Wrap**
1.Add CSS Files
		// Add script to link Css files
 		wp_enqueue_style( 'main_css', get_stylesheet_directory_uri() . '/style.css');


2.Add JS Files
	    //Add mobile button script to Header Right widget navigation menu
	    	wp_enqueue_script( 'name_for_script', get_stylesheet_directory_uri() . '/relative/path/to/script.js', array('jquery'), '1.0.0' );
	    //Add JS for particular pages
			wp_enqueue_script( 'about_js', get_stylesheet_directory_uri() . '/js/about.js', array('jquery'), '', true);

3.Add font-awesome
 		//Add fontawesome to site
    	wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'); 












ADMIN SETTINGS
=======================================================================
=========================================================================

Layout Settings
---------------
**Force Layout Settings**
	//* Force content-sidebar layout setting
	add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar' );

	//* Force sidebar-content layout setting
	add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_sidebar_content' );

	//* Force content-sidebar-sidebar layout setting
	add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar_sidebar' );

	//* Force sidebar-sidebar-content layout setting
	add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_sidebar_sidebar_content' );

	//* Force sidebar-content-sidebar layout setting
	add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_sidebar_content_sidebar' );

	//* Force full-width-content layout setting
	add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );


** Force Layout to specific post types, cats, tags, etc**
	add_filter( 'genesis_pre_get_option_site_layout', 'child_do_layout' );
	function child_do_layout( $opt ) {
	    if ( is_single() || is_category() || is_tag() || is_singular( 'post' )) { // Modify the conditions to apply the layout to here
	        $opt = 'full-width-content'; // You can change this to any Genesis layout
	        return $opt;
	    }
	}



**Remove In-Post Layout Settings**
	//* Remove Genesis Layout Settings
	remove_theme_support( 'genesis-inpost-layouts' );


**Unregister Layout Settings**
	//* Unregister content/sidebar layout setting
	genesis_unregister_layout( 'content-sidebar' );
	 
	//* Unregister sidebar/content layout setting
	genesis_unregister_layout( 'sidebar-content' );
	 
	//* Unregister content/sidebar/sidebar layout setting
	genesis_unregister_layout( 'content-sidebar-sidebar' );
	 
	//* Unregister sidebar/sidebar/content layout setting
	genesis_unregister_layout( 'sidebar-sidebar-content' );
	 
	//* Unregister sidebar/content/sidebar layout setting
	genesis_unregister_layout( 'sidebar-content-sidebar' );
	 
	//* Unregister full-width content layout setting
	genesis_unregister_layout( 'full-width-content' );





**Remove Genesis Menu Link**
	//* Remove Genesis menu link
	remove_theme_support( 'genesis-admin-menu' );


**Add Post Formats to Site**
	//* Add support for post formats
	add_theme_support( 'post-formats', array(
		'aside',
		'audio',
		'chat',
		'gallery',
		'image',
		'link',
		'quote',
		'status',
		'video'
	) );

**Add Post Format Images to Site**
	//* Add support for post format images
	add_theme_support( 'genesis-post-format-images' );


**Remove empty paragraphs created by wpautop()**
//Remove empty paragraphs created by wpautop()
	function remove_empty_p( $content ) {
	    $content = force_balance_tags( $content );
	    $content = preg_replace( '#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content );
	    $content = preg_replace( '~\s?<p>(\s|&nbsp;)+</p>\s?~', '', $content );
	    return $content;
	}
	add_filter('the_content', 'remove_empty_p', 20, 1);


**Remove Genesis Default Templates - Blog and Archive, generally useless**
	//remove genesis default templates
	function be_remove_genesis_page_templates( $page_templates ) {
		unset( $page_templates['page_archive.php'] );
		unset( $page_templates['page_blog.php'] );
		return $page_templates;
	}
	add_filter( 'theme_page_templates', 'be_remove_genesis_page_templates' );










Header
=======================================================================
=========================================================================


**Remove Site Title from Site**
	//* Remove the site title
	remove_action( 'genesis_site_title', 'genesis_seo_site_title' );


**Remove Site Description from Site**
	//* Remove the site description
	remove_action( 'genesis_site_description', 'genesis_seo_site_description' );


**Remove Header Right Widget Area from Site**
	//* Remove the header right widget area
	unregister_sidebar( 'header-right' );



Reposition the Navigation
---------------------------------

**Reposition the Primary Navigation menu**
	//* Reposition the primary navigation menu
	remove_action( 'genesis_after_header', 'genesis_do_nav' );
	add_action( 'genesis_before_header', 'genesis_do_nav' );


**Reposition the Secondary Navigation Menu**
	//* Reposition the secondary navigation menu
	remove_action( 'genesis_after_header', 'genesis_do_subnav' );
	add_action( 'genesis_before_header', 'genesis_do_subnav' );




Unregister Navigation Menu
--------------------------

**Unregister primary/secondary navigation menus**
	//* Unregister primary/secondary navigation menus
	remove_theme_support( 'genesis-menus' );

**unregister only the primary navigation menu**
	//* Unregister primary navigation menu
	add_theme_support( 'genesis-menus', array( 'secondary' => __( 'Secondary Navigation Menu', 'genesis' ) ) );

**unregister only the secondary navigation menu**
	//* Unregister secondary navigation menu
	add_theme_support( 'genesis-menus', array( 'primary' => __( 'Primary Navigation Menu', 'genesis' ) ) );




Search Format
----------------

**Customize the Search form input box**
	//* Customize search form input box text
	add_filter( 'genesis_search_text', 'sp_search_text' );
	function sp_search_text( $text ) {
		return esc_attr( 'Search my blog...' );
	}


**Customize the Search form input button**
	//* Customize search form input button text
	add_filter( 'genesis_search_button_text', 'sp_search_button_text' );
	function sp_search_button_text( $text ) {
		return esc_attr( 'Go' );
	}


**Customize the search form label**
	//* Customize search form label
	add_filter( 'genesis_search_form_label', 'sp_search_form_label' );
	function sp_search_form_label ( $text ) {
		return esc_attr( 'Custom Label' );
	}
















Body
=======================================================================
=========================================================================


**Add Custom Body Class**


1. Add Body Class to all pages on site
		//* Add custom body class to the head
		add_filter( 'body_class', 'sp_body_class' );
		function sp_body_class( $classes ) {
			
			$classes[] = 'custom-class';
			return $classes;
			
		}


2. Add Body Class to a page with slug of 'sample-page'
		//* Add custom body class to the head
		add_filter( 'body_class', 'sp_body_class' );
		function sp_body_class( $classes ) {

			if ( is_page( 'sample-page' ) )
				$classes[] = 'custom-class';
				return $classes;

		}


3. Add Body class to a page with an ID of 1
		//* Add custom body class to the head
		add_filter( 'body_class', 'sp_body_class' );
		function sp_body_class( $classes ) {

			if ( is_page( '1' ) )
				$classes[] = 'custom-class';
				return $classes;

		}


4. Add body class to a category page with a slug of 'sample-category'
		//* Add custom body class to the head
		add_filter( 'body_class', 'sp_body_class' );
		function sp_body_class( $classes ) {
			
			if ( is_category( 'sample-category' ) )
				$classes[] = 'custom-class';
				return $classes;
				
		}


5. Add body class to a category page with an ID of 1
		//* Add custom body class to the head
		add_filter( 'body_class', 'sp_body_class' );
		function sp_body_class( $classes ) {
			
			if ( is_category( '1' ) )
				$classes[] = 'custom-class';
				return $classes;

		}


6. Add body class to a tage page with a slug of 'sample-tag'
		//* Add custom body class
		add_filter( 'body_class', 'sp_body_class' );
		function sp_body_class( $classes ) {

			if ( is_tag( 'sample-tag' ) )
				$classes[] = 'custom-class';
				return $classes;
				
		}


7. Add body class to a tag page with an ID of 1
		//* Add custom body class to the head
		add_filter( 'body_class', 'sp_body_class' );
		function sp_body_class( $classes ) {
			
			if ( is_tag( '1' ) )
				$classes[] = 'custom-class';
				return $classes;
	



















Genesis Entry
=========================================================================
=========================================================================

Entry Header
-----------

**Customize Entry Header**
	//* Customize the entry meta in the entry header (requires HTML5 theme support)
	add_filter( 'genesis_post_info', 'sp_post_info_filter' );
	function sp_post_info_filter($post_info) {
		$post_info = '[post_date] by [post_author_posts_link] [post_comments] [post_edit]';
		return $post_info;
	}


**Remove Entry Header Markup**
	//* Remove the entry header markup (requires HTML5 theme support)
	remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
	remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );


**Remove Entry Meta**
	//* Remove the entry meta in the entry header (requires HTML5 theme support)
	remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );


**Remove Entry Title**
	//* Remove the entry title (requires HTML5 theme support)
	remove_action( 'genesis_entry_header', 'genesis_do_post_title' );


**Remove Post Format Image**
	//* Remove the post format image (requires HTML5 theme support)
	remove_action( 'genesis_entry_header', 'genesis_do_post_format_image', 4 );	





Entry Content
-----------

**Remove Entry Content on Site**
	//* Remove the post content (requires HTML5 theme support)
	remove_action( 'genesis_entry_content', 'genesis_do_post_content' );


**Remove Post Image on Site**
	//* Remove the post image (requires HTML5 theme support)
	remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );


**Remove Post Navigation on Site**
	//* Remove the post navigation (requires HTML5 theme support)
	remove_action( 'genesis_entry_content', 'genesis_do_post_content_nav', 12 );


**Remove Post Permalink on Site**
//* Remove the post permalink (requires HTML5 theme support)
remove_action( 'genesis_entry_content', 'genesis_do_post_permalink', 14 );




Entry Footer
-----------

**Add Post Navigation to Site**
	//* Add post navigation (requires HTML5 theme support)
	add_action( 'genesis_entry_footer', 'genesis_prev_next_post_nav' );


**Customize Entry Footer on Site**
	//* Customize the entry meta in the entry footer (requires HTML5 theme support)
	add_filter( 'genesis_post_meta', 'sp_post_meta_filter' );
	function sp_post_meta_filter($post_meta) {
		$post_meta = '[post_categories] [post_tags]';
		return $post_meta;
	}


**Remove Entry Footer Markup on Site**
	//* Remove the entry footer markup (requires HTML5 theme support)
	remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
	remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );


**Remove Entry Meta on Site**
	//* Remove the entry meta in the entry footer (requires HTML5 theme support)
	remove_action( 'genesis_entry_footer', 'genesis_post_meta' );























Blog and Archives
=========================================================================
=========================================================================


Author Box
----------
**Remove author box on Single Posts**

	//* Remove the author box on single posts HTML5 Themes
	remove_action( 'genesis_after_entry', 'genesis_do_author_box_single', 8 );


**Global enable author box**
1. Single Posts
		//* Display author box on single posts
		add_filter( 'get_the_author_genesis_author_box_single', '__return_true' );

2. Archives
		//* Display author box on archive pages
		add_filter( 'get_the_author_genesis_author_box_archive', '__return_true' );


**Modify Author Box Title**
	//* Customize the author box title
	add_filter( 'genesis_author_box_title', 'custom_author_box_title' );
	function custom_author_box_title() {
		return '<strong>About the Author</strong>';
	}



Excerpts
--------

**Modify read more link - when using WP More Tag to break a post on site**
	//* Modify the WordPress read more link
	add_filter( 'the_content_more_link', 'sp_read_more_link' );
	function sp_read_more_link() {
		return '<a class="more-link" href="' . get_permalink() . '">[Continue Reading]</a>';
	}

**Modify read more link when using Content Limit on the Content Archives section on Genesis Settings page**
	//* Modify the Genesis content limit read more link
	add_filter( 'get_the_content_more_link', 'sp_read_more_link' );
	function sp_read_more_link() {
		return '... <a class="more-link" href="' . get_permalink() . '">[Continue Reading]</a>';
	}

**Modify length of post excerpts**
	//* Modify the length of post excerpts
	add_filter( 'excerpt_length', 'sp_excerpt_length' );
	function sp_excerpt_length( $length ) {
		return 50; // pull first 50 words
	}


Previous/Next Post
------------------

**Customize Next Page Link**
	//* Customize the next page link
	add_filter ( 'genesis_next_link_text' , 'sp_next_page_link' );
	function sp_next_page_link ( $text ) {
	    return 'Custom Next Page Link &#x000BB;';
	}

**Customize Previous Page Link**
	//* Customize the previous page link
	add_filter ( 'genesis_prev_link_text' , 'sp_previous_page_link' );
	function sp_previous_page_link ( $text ) {
	    return '&#x000AB; Custom Previous Page Link';
	}






Post
=========================================================================
=========================================================================

**Filter Post Title and Add span for styling**
	/**
	 * Filter Genesis H1 Post Titles to add <span> for styling
	 * add the  cambodia country flag
	 */	
	add_filter( 'genesis_post_title_output', 'jp_custom_post_title_output', 15 );

	function jp_custom_post_title_output( $title ) {

		if ( is_singular() )
			$title = sprintf( '<h1 class="entry-title"><span>%s<div>custom content<a href="something.com"><img src="path/to/file.jpg"></a></div></span></h1>', apply_filters( 'genesis_post_title_text', get_the_title() ) );

		return $title;

	}

**Add Featured Image on Single Post** //consider user 'remove image alignment',below, with this snippet

	//* Add features image on single post
	add_action( 'genesis_entry_header', 'single_post_featured_image', 6 );

	function single_post_featured_image() {

	if ( ! is_singular( 'post' ) )
	return;

	$img = genesis_get_image( array( 'format' => 'html', 'size' => genesis_get_option( 'image_size' ), 'attr' => array( 'class' => 'post-image' ) ) );
	printf( '<a href="%s" title="%s">%s</a>', get_permalink(), the_title_attribute( 'echo=0' ), $img );

	}


**Remove Image Alignment from Featured Image** //use when adding featured image to single posts- possibly

	//Remove Image Alignment from Featured Image
	function be_remove_image_alignment( $attributes ) {
	  $attributes['class'] = str_replace( 'alignleft', 'alignnone', $attributes['class'] );
		return $attributes;
	}
	add_filter( 'genesis_attr_entry-image', 'be_remove_image_alignment' );













Comments
=========================================================================
=========================================================================

**Modify Comments link on site**
	//* Modify the comment link text in comments
	add_filter( 'genesis_post_info', 'sp_post_info_filter' );
	function sp_post_info_filter( $post_info ) {
		return '[post_comments zero="Leave a Comment" one="1 Comment" more="% Comments"]';
	}


**Modify Comments title text**
	//* Modify comments title text in comments
	add_filter( 'genesis_title_comments', 'sp_genesis_title_comments' );
	function sp_genesis_title_comments() {
		$title = '<h3>Discussion</h3>';
		return $title;
	}


**Modify Trackbacks title text**
	//* Modify trackbacks title in comments
	add_filter( 'genesis_title_pings', 'sp_title_pings' );
	function sp_title_pings() {
	echo '<h3>Trackbacks</h3>';
	}


**Modify 'Speak Your Mind' title text**
	//* Modify the speak your mind title in comments
	add_filter( 'comment_form_defaults', 'sp_comment_form_defaults' );
	function sp_comment_form_defaults( $defaults ) {
	 
		$defaults['title_reply'] = __( 'Leave a Comment' );
		return $defaults;
	 
	}


**Modify 'author says' text**
		//* Modify the author says text in comments
	add_filter( 'comment_author_says_text', 'sp_comment_author_says_text' );
	function sp_comment_author_says_text() {
		return 'author says';
	}


**Modify gravatar size**
	//* Modify the size of the Gravatar in comments
	add_filter( 'genesis_comment_list_args', 'sp_comments_gravatar' );
	function sp_comments_gravatar( $args ) {
		$args['avatar_size'] = 96;
		return $args;
	}


**Modify 'Submit' button text**
	//* Customize the submit button text in comments
	add_filter( 'comment_form_defaults', 'sp_comment_submit_button' );
	function sp_comment_submit_button( $defaults ) {
	 
	        $defaults['label_submit'] = __( 'Submit', 'custom' );
	        return $defaults;
	 
	}


**Add Comment policy box**
	//* Add a comment policy box in comments
	add_action( 'genesis_after_comments', 'sp_comment_policy' );
	function sp_comment_policy() {
		if ( is_single() && !is_user_logged_in() && comments_open() ) {
		
	echo'	<div class="comment-policy-box">';
	echo'		<p class="comment-policy"><small><strong>Comment Policy:</strong>Your ';
	echo'		words are your own, so be nice and helpful if you can. Please, only use your real name ';
	echo'		and limit the amount of links submitted in your comment. We accept clean XHTML in ';
	echo'		comments, but don\'t overdo it please.</small></p>';
	echo'	</div>';
		}
	}



**Remove allowed tags text above comment form**
	//* Remove comment form allowed tags
	add_filter( 'comment_form_defaults', 'sp_remove_comment_form_allowed_tags' );
	function sp_remove_comment_form_allowed_tags( $defaults ) {

		$defaults['comment_notes_after'] = '';
		return $defaults;

	}










Footer
=========================================================================
=========================================================================


**Reposition Site Footer**
	//* Reposition the footer
	remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
	remove_action( 'genesis_footer', 'genesis_do_footer' );
	remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );
	add_action( 'genesis_after', 'genesis_footer_markup_open', 11 );
	add_action( 'genesis_after', 'genesis_do_footer', 12 );
	add_action( 'genesis_after', 'genesis_footer_markup_close', 13 );



**Customize Return to Top of Page text**
	//* Customize the return to top of page text
	add_filter( 'genesis_footer_backtotop_text', 'sp_footer_backtotop_text' );
	function sp_footer_backtotop_text($backtotop) {
		$backtotop = '[footer_backtotop text="Return to Top"]';
		return $backtotop;
	}

**Remove the 'Back to Top'(Return to Top) link in footer**
	//Remove the 'Return to Top' link in footer
	    add_filter( 'genesis_footer_output', 'jp_custom_footer_output');

	// remove $backtotop from $output = $backtotop . $creds
	    function my_footer_output() {
	        $output = $creds;
	    }




**Customize Credits text on site**
1. Option 1
				//* Customize the credits
		add_filter( 'genesis_footer_creds_text', 'sp_footer_creds_text' );
		function sp_footer_creds_text() {
			echo '<div class="creds"><p>';
			echo 'Copyright &copy; ';
			echo date('Y');
			echo ' &middot; <a href="http://mydomain.com">My Custom Link</a> &middot; Built on the <a href="http://www.studiopress.com/themes/genesis" title="Genesis Framework">Genesis Framework</a>';
			echo '</p></div>';
		}

2. Option 2
			//* Change the footer text
		add_filter('genesis_footer_creds_text', 'sp_footer_creds_filter');
		function sp_footer_creds_filter( $creds ) {
			$creds = '[footer_copyright] &middot; <a href="http://mydomain.com">My Custom Link</a> &middot; Built on the <a href="http://www.studiopress.com/themes/genesis" title="Genesis Framework">Genesis Framework</a>';
			return $creds;
		}	

3. Full Customization
			//* Customize the entire footer
		remove_action( 'genesis_footer', 'genesis_do_footer' );
		add_action( 'genesis_footer', 'sp_custom_footer' );
		function sp_custom_footer() {
			?>
			<p>&copy; Copyright 2012 <a href="http://mydomain.com/">My Domain</a> &middot; All Rights Reserved &middot; Powered by <a href="http://wordpress.org/">WordPress</a> &middot; <a href="http://mydomain.com/wp-admin">Admin</a></p>
			<?php
		}













Images
=========================================================================
=========================================================================

**Add New Feature Images**
	//* Add new featured image sizes
	add_image_size( 'home-bottom', 150, 100, TRUE );
	add_image_size( 'home-top', 400, 200, TRUE );


**Add Custom Gravatar on Site**
	//* Display a custom Gravatar
	add_filter( 'avatar_defaults', 'sp_gravatar' );
	function sp_gravatar ($avatar) {
		$custom_avatar = get_stylesheet_directory_uri() . '/images/gravatar.png';
		$avatar[$custom_avatar] = "Custom Gravatar";
		return $avatar;
	}


**Display a custom favicon on Site**
	//* Display a custom favicon
	add_filter( 'genesis_pre_load_favicon', 'sp_favicon_filter' );
	function sp_favicon_filter( $favicon_url ) {
		return site_url() . '/wp-content/themes/path/to/favicon.ico';
	}














Sidebars
=========================================================================
=========================================================================

**Unregister Sidebars**

	//* Unregister primary sidebar
	unregister_sidebar( 'sidebar' );
	//* Unregister secondary sidebar
	unregister_sidebar( 'sidebar-alt' );


**Replace Primary Sidebar with Custom Sidebar**

1. Replace Primary Sidbar with Custom Sidebar
		//* Replace Primary Sidebar with custom sidebar (about-us-sidebar)
		add_action('get_header','jp_change_genesis_sidebar');
		function jp_change_genesis_sidebar() {
		    if ( is_page_template('about-us-page-template.php')) { // Check if we're on the page template could be is_category, is_single
		        remove_action( 'genesis_sidebar', 'ss_do_sidebar' ); //remove the default genesis sidebar
		        add_action( 'genesis_sidebar', 'jp_custom_sidebar' ); //add an action hook to call the function for my custom sidebar
		    }
		}

2. Function to output custom sidebar
		//Function to output my custom sidebar
		function jp_custom_sidebar() {
			// This is the sidebar name either registerd directly or using plugin such as
			// Genesis Simple Sidebar (recommended)
			dynamic_sidebar( 'name-of-sidebar' );
		}
















Widgets 
=========================================================================
=========================================================================

**Unregister Widgets**
	//* Unregister Genesis widgets
	add_action( 'widgets_init', 'unregister_genesis_widgets', 20 );
	function unregister_genesis_widgets() {
		unregister_widget( 'Genesis_eNews_Updates' );
		unregister_widget( 'Genesis_Featured_Page' );
		unregister_widget( 'Genesis_Featured_Post' );
		unregister_widget( 'Genesis_Latest_Tweets_Widget' );
		unregister_widget( 'Genesis_Menu_Pages_Widget' );
		unregister_widget( 'Genesis_User_Profile_Widget' );
		unregister_widget( 'Genesis_Widget_Menu_Categories' );


**Hook custom widget to custom widget area(created through Genesis Simple Sidebars)
	//* Hook custom widget to custom widget area
	add_action( 'genesis_before_content', 'jp_custom_widget', 1);
		function jp_custom_widget() {
					//register custom widget area using Genesis Simple Sidebars plugin
			genesis_widget_area( 'custom_widget_area', array(
				'before' => '<div class="custom_widget_area"><div class="wrap">',
				'after' => '</div></div>',

		) );
	}



**Enable PHP in Widget areas** //Use with caution
	// Enable PHP in widgets
	add_filter('widget_text','execute_php',100);
	function execute_php($html){
	     if(strpos($html,"<"."?php")!==false){
	          ob_start();
	          eval("?".">".$html);
	          $html=ob_get_contents();
	          ob_end_clean();
	     }
	     return $html;
	}







Miscellaneous
=========================================================================
=========================================================================







Breadcrumbs
------------


**Reposition Breadcrumbs**
	//* Reposition the breadcrumbs
	remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
	add_action( 'genesis_after_header', 'genesis_do_breadcrumbs' );


**Remove 'You are here' from front of breadcrumb trail**
add_filter( 'genesis_breadcrumb_args', 'jp_custom_prefix_breadcrumb' );
function jp_custom_prefix_breadcrumb( $args ) {

  $args['labels']['prefix'] = '';
  return $args;

}


**Modify Breadcrumbs display**
//* Modify breadcrumb arguments.
	add_filter( 'genesis_breadcrumb_args', 'sp_breadcrumb_args' );
	function sp_breadcrumb_args( $args ) {
		$args['home'] = 'Home';
		$args['sep'] = ' / ';
		$args['list_sep'] = ', '; // Genesis 1.5 and later
		$args['prefix'] = '<div class="breadcrumb">';
		$args['suffix'] = '</div>';
		$args['heirarchial_attachments'] = true; // Genesis 1.5 and later
		$args['heirarchial_categories'] = true; // Genesis 1.5 and later
		$args['display'] = true;
		$args['labels']['prefix'] = 'You are here: ';
		$args['labels']['author'] = 'Archives for ';
		$args['labels']['category'] = 'Archives for '; // Genesis 1.6 and later
		$args['labels']['tag'] = 'Archives for ';
		$args['labels']['date'] = 'Archives for ';
		$args['labels']['search'] = 'Search for ';
		$args['labels']['tax'] = 'Archives for ';
		$args['labels']['post_type'] = 'Archives for ';
		$args['labels']['404'] = 'Not found: '; // Genesis 1.5 and later
	return $args;
	}






Structural Wraps
-----------------

**Add structural wraps to Site**
//* Add support for structural wraps
	add_theme_support( 'genesis-structural-wraps', array(
		'header',
		'nav',
		'subnav',
		'site-inner',
		'footer-widgets',
		'footer'
	) );



















Creating Templates
=========================================================================
=========================================================================

To add page content to the top of a page using the 
Blog Page template create a file called page_blog.php 
in your child theme directory with the following contents:


<?php

//* Template Name: Blog


// remove Genesis default loop
remove_action( 'genesis_loop', 'genesis_do_loop' );



//* Show page content above posts
add_action( 'genesis_loop', 'genesis_standard_loop', 5 );

genesis();






























Creating Custom Post Types
=========================================================================
=========================================================================

**Create Portfolio Custom Post Type**
//* Create Portfolio post type 
add_action( 'init', 'create_portfolio_type' );

function create_portfolio_type() {

    $labels = array(
    'name' => __( 'Portfolio' ),
    'singular_name' => __( 'Portfolio' ),
    'all_items' => __('All Portfolio'),
    'add_new' => _x('Add new Portfolio', 'Portfolio'),
    'add_new_item' => __('Add new Portfolio'),
    'edit_item' => __('Edit Portfolio'),
    'new_item' => __('New Portfolio'),
    'view_item' => __('View Portfolio'),
    'search_items' => __('Search in Portfolio'),
    'not_found' =>  __('No Portfolio found'),
    'not_found_in_trash' => __('No Portfolio found in trash'),
    'parent_item_colon' => ''
    );

    $args = array(
    'labels' => $labels,
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'has_archive' => true,
    'rewrite' => array('slug' => 'portfolio'),
    'supports' => array( 'title', 'editor', 'genesis-seo', 'thumbnail', 'genesis-cpt-archives-settings'),
    'taxonomies' => array('category')
    );

  register_post_type( 'portfolio', $args);
}



**Create Custom Taxonomy** 
//Create Custom Taxonomy Type
	function portfolio_category_init() {
		// create a new taxonomy
		register_taxonomy('portfolio-category', 'portfolio',array(
				'labels' => array(
			      'name' => _x( 'Portfolio Categories', 'taxonomy general name' ),
			      'singular_name' => _x( 'Portfolio Category', 'taxonomy singular name' ),
			      'search_items' =>  __( 'Search Portfolio Categories' ),
			      'all_items' => __( 'All Portfolio Categories' ),
			    //  'parent_item' => __( 'Parent Location' ),
			    //  'parent_item_colon' => __( 'Parent Location:' ),
			      'edit_item' => __( 'Edit Portfolio Category' ),
			      'update_item' => __( 'Update Portfolio Category' ),
			      'add_new_item' => __( 'Add New Portfolio Category' ),
			      'new_item_name' => __( 'New Portfolio Category Name' ),
			      'menu_name' => __( 'Portfolio Categories' ),
			    ),
				'rewrite' => array( 'slug' => 'portfolio-categories' ),
				'with_fromt' => true, // Display the category base before/category/
				'hierarchical' => true // (make like categories)
			)
		);
	}
add_action( 'init', 'portfolio_category_init' );



