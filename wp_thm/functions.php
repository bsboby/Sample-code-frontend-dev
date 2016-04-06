<?php
/**
 * WEO functions and definitions
 
 */

/*
 * Set up the content width value based on the theme's design.
 *
 * @see weo_content_width() for template-specific adjustments.
 */
if ( ! isset( $content_width ) )
	$content_width = 604;

require_once('theme_option/option.php');
require_once('project_spotlight.php');
require_once('testimonial_right_sidebar.php');
require_once('address_right_sidebar.php');
require_once('custom_posttype/careers-job.php');
require_once('custom_posttype/slider.php');
require_once('custom_posttype/leadership_team.php');
require_once('custom_posttype/testimonial.php');

require_once('wp-paginate.php');



/**
 * WEO only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6-alpha', '<' ) )
	require get_template_directory() . '/inc/back-compat.php';

/**
 * WEO setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * WEO supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add Visual Editor stylesheets.
 * @uses add_theme_support() To add support for automatic feed links, post
 * formats, and post thumbnails.
 * @uses register_nav_menu() To add support for a navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since WEO 1.0
 *
 * @return void
 */
function weo_setup() {
	/*
	 * Makes WEO available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on WEO, use a find and
	 * replace to change 'weo' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain(get_template_directory() . '/languages' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	//add_editor_style( array( 'css/editor-style.css', 'fonts/genericons.css', weo_fonts_url() ) );

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Switches default core markup for search form, comment form,
	 * and comments to output valid HTML5.
	 */
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

	/*
	 * This theme supports all available post formats by default.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Navigation Menu') );

	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 604, 270, true );
	add_image_size( 'responsive_banner', 414, 320,true );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
add_action( 'after_setup_theme', 'weo_setup' );

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since WEO 1.0
 *
 * @return void
 */
function weo_scripts_styles() {
	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	// Adds Masonry to handle vertical alignment of footer widgets.
	if ( is_active_sidebar( 'sidebar-1' ) )
		wp_enqueue_script( 'jquery-masonry' );

	// Loads JavaScript file with functionality specific to WEO.
	wp_enqueue_script( 'script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '2013-07-18', true );

	// Add Source Sans Pro and Bitter fonts, used in the main stylesheet.
	//wp_enqueue_style( 'fonts', weo_fonts_url(), array(), null );

	// Add Genericons font, used in the main stylesheet.
	//wp_enqueue_style( 'genericons', get_template_directory_uri() . '/fonts/genericons.css', array(), '2.09' );

	// Loads our main stylesheet.
	wp_enqueue_style( 'style', get_stylesheet_uri(), array(), '2013-07-18' );

	// Loads the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'ie', get_template_directory_uri() . '/css/ie.css', array( 'style' ), '2013-07-18' );
	wp_style_add_data( 'weo-ie', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'weo_scripts_styles' );

/**
 * Filter the page title.
 *
 * Creates a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since WEO 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep   Optional separator.
 * @return string The filtered title.
 */
function weo_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s'), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'weo_wp_title', 10, 2 );

/**
 * Register two widget areas.
 *
 * @since WEO 1.0
 *
 * @return void
 */
function weo_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Main Widget Area'),
		'id'            => 'sidebar-1',
		'description'   => __( 'Appears in the footer section of the site.'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Secondary Widget Area'),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears on posts and pages in the sidebar.'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Project Spotlight'),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears on home page in the Right Side'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Testimonial Right Sidebar'),
		'id'            => 'sidebar-4',
		'description'   => __( 'Appears on All sub pages of About Us, Leadership Team, Industries we serve,Services we offer in the Right Side'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Address Right Sidebar'),
		'id'            => 'sidebar-5',
		'description'   => __( 'Appears on All sub pages of Contact us, Get In Touch, Service Request in the Right Side'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'weo_widgets_init' );

if ( ! function_exists( 'weo_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since WEO 1.0
 *
 * @return void
 */
function weo_paging_nav() {
	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation'); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts') ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>') ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'weo_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
*
* @since WEO 1.0
*
* @return void
*/
function weo_post_nav() {
	global $post;

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous )
		return;
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation'); ?></h1>
		<div class="nav-links">

			<?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link') ); ?>
			<?php next_post_link( '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link') ); ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'weo_entry_meta' ) ) :
/**
 * Print HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own weo_entry_meta() to override in a child theme.
 *
 * @since WEO 1.0
 *
 * @return void
 */
function weo_entry_meta() {
	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<span class="featured-post">' . __( 'Sticky') . '</span>';

	if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
		weo_entry_date();

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ') );
	if ( $categories_list ) {
		echo '<span class="categories-links">' . $categories_list . '</span>';
	}

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ') );
	if ( $tag_list ) {
		echo '<span class="tags-links">' . $tag_list . '</span>';
	}

	// Post author
	if ( 'post' == get_post_type() ) {
		printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s'), get_the_author() ) ),
			get_the_author()
		); 
	}
}
endif;

if ( ! function_exists( 'weo_entry_date' ) ) :
/**
 * Print HTML with date information for current post.
 *
 * Create your own weo_entry_date() to override in a child theme.
 *
 * @since WEO 1.0
 *
 * @param boolean $echo (optional) Whether to echo the date. Default true.
 * @return string The HTML-formatted post date.
 */
function weo_entry_date( $echo = true ) {
	if ( has_post_format( array( 'chat', 'status' ) ) )
		$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date');
	else
		$format_prefix = '%2$s';

	$date = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s'), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if ( $echo )
		echo $date;

	return $date;
}
endif;

if ( ! function_exists( 'weo_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @since WEO 1.0
 *
 * @return void
 */
function weo_the_attached_image() {
	/**
	 * Filter the image attachment size to use.
	 *
	 * @since WEO 1.0
	 *
	 * @param array $size {
	 *     @type int The attachment height in pixels.
	 *     @type int The attachment width in pixels.
	 * }
	 */
	$attachment_size     = apply_filters( 'weo_attachment_size', array( 724, 724 ) );
	$next_attachment_url = wp_get_attachment_url();
	$post                = get_post();

	/*
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're 
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID'
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );

		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
	}

	printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
		esc_url( $next_attachment_url ),
		the_title_attribute( array( 'echo' => false ) ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

/**
 * Return the post URL.
 *
 * @uses get_url_in_content() to get the URL in the post meta (if it exists) or
 * the first link found in the post content.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @since WEO 1.0
 *
 * @return string The Link format URL.
 */
function weo_get_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content( $content );

	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Active widgets in the sidebar to change the layout and spacing.
 * 3. When avatars are disabled in discussion settings.
 *
 * @since WEO 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function weo_body_class( $classes ) {
	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	if ( is_active_sidebar( 'sidebar-2' ) && ! is_attachment() && ! is_404() )
		$classes[] = 'sidebar';

	if ( ! get_option( 'show_avatars' ) )
		$classes[] = 'no-avatars';

	return $classes;
}
add_filter( 'body_class', 'weo_body_class' );

/**
 * Adjust content_width value for video post formats and attachment templates.
 *
 * @since WEO 1.0
 *
 * @return void
 */
function weo_content_width() {
	global $content_width;

	if ( is_attachment() )
		$content_width = 724;
	elseif ( has_post_format( 'audio' ) )
		$content_width = 484;
}
add_action( 'template_redirect', 'weo_content_width' );

/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since WEO 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 * @return void
 */
function weo_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'weo_customize_register' );

/**
 * Enqueue Javascript postMessage handlers for the Customizer.
 *
 * Binds JavaScript handlers to make the Customizer preview
 * reload changes asynchronously.
 *
 * @since WEO 1.0
 *
 * @return void
 */
function weo_customize_preview_js() {
	wp_enqueue_script( 'weo-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20130226', true );
}
add_action( 'customize_preview_init', 'weo_customize_preview_js' );

/***  Custom Metabox for Post/ Industries We Serve  */
$prefix = 'pji_';
	$pimeta_box = array(
    'id' => 'my-meta-box',
    'title' => 'Client Detail',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
    array('name' => 'Location','id' => $prefix . 'country','type' => 'text','std' => ''),
	array('name' => 'Owner','id' => $prefix . 'owner','type' => 'text','std' => ''),
	array('name' => 'General Contractor','id' => $prefix . 'contractor','type' => 'text','std' => ''),
	array('name' => 'Contract Value','id' => $prefix . 'cvalue','type' => 'text',  'std' => ''),
	array('name' => 'Select Slider','id' => $prefix . 'slider','type' => 'select',  'std' => ''),
    )
    );
	    add_action('admin_menu', 'pitheme_add_box');
    // Add meta box
    function pitheme_add_box() {
		
    global $pimeta_box;
	$screens = array( 'post');
	foreach ( $screens as $screen ) {
    add_meta_box($pimeta_box['id'], $pimeta_box['title'], 'pitheme_show_box', $screen, $pimeta_box['context'], $pimeta_box['priority']);
	}
    }
	    // Callback function to show fields in meta box
    function pitheme_show_box() {
    global $pimeta_box, $post;
    // Use nonce for verification
    echo '<input type="hidden" name="pitheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
    echo '<table class="form-table">';
    foreach ($pimeta_box['fields'] as $field) {
    // get current post meta data
    $meta = get_post_meta($post->ID, $field['id'], true);
    echo '<tr>',
    '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
    '<td>';
    switch ($field['type']) {
    case 'text':
    echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />', '<br />', $field['desc'];
    break;
	case 'select':
	echo '<select name="', $field['id'], '" id="', $field['id'], '">';
				 global $wpdb;
				$query="SELECT * FROM ".$wpdb->prefix."huge_itslider_sliders ";
				$rowwidget=$wpdb->get_results($query);
				foreach($rowwidget as $rowwidgetecho){
				if($rowwidgetecho->id == get_post_meta($post->ID, $field['id'], true)){ $selected= 'selected'; } else{ $selected= ''; } 
			echo '<option '.$selected.' value="'.$rowwidgetecho->id.'">'.$rowwidgetecho->name.'</option>';
} 
				echo '</select>';
//    echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />', '<br />', $field['desc'];
    break;
    }
    echo '</td><td>',
    '</td></tr>';
    }
    echo '</table>';
    }
	    add_action('save_post', 'pitheme_save_data');
    // Save data from meta box
    function pitheme_save_data($post_id) {
    global $pimeta_box;
    // verify nonce
    if (!wp_verify_nonce($_POST['pitheme_meta_box_nonce'], basename(__FILE__))) {
    return $post_id;
    }
    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
    }
    // check permissions
    if ('page' == $_POST['post_type']) {
    if (!current_user_can('edit_page', $post_id)) {
    return $post_id;
    }
    } elseif (!current_user_can('edit_post', $post_id)) {
    return $post_id;
    }
    foreach ($pimeta_box['fields'] as $field) {
    $old = get_post_meta($post_id, $field['id'], true);
    $new = $_POST[$field['id']];
    if ($new && $new != $old) {
    update_post_meta($post_id, $field['id'], $new);
    } elseif ('' == $new && $old) {
    delete_post_meta($post_id, $field['id'], $old);
    }
    }
    }

/*------------------------------------------------------------------------------------
	remove quick edit for custom post type Silder just to check if less mem consumption
------------------------------------------------------------------------------------*/
add_filter( 'post_row_actions', 'remove_row_actions_silder', 10, 2 );
function remove_row_actions_silder( $actions, $post )
{ 
  global $current_screen;
	if( $current_screen->post_type != 'slider' ) return $actions;
	unset( $actions['view'] );
	unset( $actions['inline hide-if-no-js'] );
	return $actions;
}
/*------------------------------------------------------------------------------------
	remove quick edit for custom post type careers_jobs just to check if less mem consumption
------------------------------------------------------------------------------------*/
add_filter( 'post_row_actions', 'remove_row_actions_careers_jobs', 10, 2 );
function remove_row_actions_careers_jobs( $actions, $post )
{ 
  global $current_screen;
	if( $current_screen->post_type != 'careers_jobs' ) return $actions;
	unset( $actions['view'] );
	unset( $actions['inline hide-if-no-js'] );
	return $actions;
}

/*------------------------------------------------------------------------------------
	remove quick edit for custom post type testimonials just to check if less mem consumption
------------------------------------------------------------------------------------*/
add_filter( 'post_row_actions', 'remove_row_actions_testimonials', 10, 2 );
function remove_row_actions_testimonials( $actions, $post )
{ 
  global $current_screen;
	if( $current_screen->post_type != 'testimonials' ) return $actions;
	unset( $actions['view'] );
	unset( $actions['inline hide-if-no-js'] );
	return $actions;
}
/*------------------------------------------------------------------------------------
	remove quick edit for custom post type leadership just to check if less mem consumption
------------------------------------------------------------------------------------*/
add_filter( 'post_row_actions', 'remove_row_actions_leadership', 10, 2 );
function remove_row_actions_leadership( $actions, $post )
{ 
  global $current_screen;
	if( $current_screen->post_type != 'leadership' ) return $actions;
	unset( $actions['view'] );
	unset( $actions['inline hide-if-no-js'] );
	return $actions;
}

/*------------------------------------------------------------------------------------
	Change password procted page form
------------------------------------------------------------------------------------*/
add_filter( 'the_password_form', 'custom_password_form' );
function custom_password_form() {
	global $post;
	$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$o = '<form class="protected-post-form" action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post">
	<p>'.get_the_title($post->ID).' is password protected. To view it please enter Username and password below: </p>
	<div class="form">
<li><label for="post_username" class="mendtrey-feild">Username*</label><br><input type="text" name="post_username" id="post_username" class="input-bg1" size="40" ><span class="passproerror passprourerror hide">Please fill the required field.</span></li>
<li><label for="' . $label . '" class="mendtrey-feild">Password*</label><br><input name="post_password" id="' . $label . '" type="password" class="input-bg1" size="40" /><span class="passproerror passpropaserror hide">Please fill the required field.</span></li>
<li>
</div>
<input type="hidden" name="username_res_postid" value="' . $post->ID . '">
	<input id="password_submit" class="submit-btn" type="submit" name="Submit" value="' . esc_attr__( "Submit" ) . '" />
	</form>
	';
	return $o;
}
/**
 * Set the post password cookie expire time based on the email
 */
add_filter( 'post_password_expires', function( $valid ) {

  $postid = filter_input( INPUT_POST, 'username_res_postid', FILTER_SANITIZE_NUMBER_INT );
  $username = filter_input( INPUT_POST, 'post_username', FILTER_SANITIZE_STRING );
  // a timestamp in the past
  $expired = time() - 10 * DAY_IN_SECONDS;

  if ( empty( $postid ) || ! is_numeric( $postid ) ) {
      // empty or bad post id, return past timestamp
      return $expired;
  }
  if ( empty($username)) {
      // empty or bad email id, return past timestamp
      return $expired;
  }
  // get the allowed emails
  $allowed = array_filter( (array)get_post_meta( $postid, 'username' ), function( $e ) {
   return $e;
  });
  if ( ! empty( $allowed ) ) { // some emails are setted, let's check it
    // if the emails posted is good return the original expire time
    // otherwise  return past timestamp
    return in_array( $username, $allowed ) ? $valid : $expired;
  }
  // no emails are setted, return the original expire time
  return $valid;

}, 0 );

add_action( 'wp', 'post_pw_sess_expire' );
    function post_pw_sess_expire() {
    if ( isset( $_COOKIE['wp-postpass_' . COOKIEHASH] ) )
    // Setting a time of 0 in setcookie() forces the cookie to expire with the session
    setcookie('wp-postpass_' . COOKIEHASH, '', 0, COOKIEPATH);
}
function post_pw_sess_refresh($seconds = 900) {
	if ( isset( $_COOKIE['wp-postpass_' . COOKIEHASH] ) ){
		setcookie('wp-postpass_' . COOKIEHASH, $_COOKIE['wp-postpass_' . COOKIEHASH], time() + $seconds, COOKIEPATH);
	}
}
/*------------------------------------------------------------------------------------
	Remove Protected and private from Title
------------------------------------------------------------------------------------*/

function remove_protected_in_title($title) {
	return '%s';
}
add_filter('private_title_format', 'remove_protected_in_title');
add_filter('protected_title_format', 'remove_protected_in_title');

/*------------------------------------------------------------------------------------
	Add select to contact form 7 dropdown
------------------------------------------------------------------------------------*/
function my_wpcf7_form_elements($html) {
	$text = '-SELECT-';
	$html = str_replace('<option value="">---</option>', '<option value="">' . $text . '</option>', $html);
	return $html;
}
add_filter('wpcf7_form_elements', 'my_wpcf7_form_elements');

/*------------------------------------------------------------------------------------
	Second Feature Images to pages and slider
------------------------------------------------------------------------------------*/
 if (class_exists('MultiPostThumbnails')) {
            $types = array('slider', 'page');
            foreach($types as $type) {
                new MultiPostThumbnails(array(
                    'label' => 'Secondary Image',
                    'id' => 'secondary-image',
                    'post_type' => $type
                    )
                );
            }
        }