<?php
/***  Custom post type Leadership Team */
add_action('init', 'dionne_add_leadership_team');
function dionne_add_leadership_team() 
{
  $labels = array(
    'name' => _x('Leadership Team', 'post type general name' ),
    'singular_name' => _x('images Item', 'post type singular name' ),
    'add_new' => _x('Add New', 'Member'),
    'add_new_item' => __('Add New Member Item'),
    'edit_item' => __('Edit Member Item' ),
    'new_item' => __('New Member Item'),
    'view_item' => __('View Member Item'),
    'search_items' => __('Search Member Items'),
    'not_found' =>  __('No Member Items found'),
    'not_found_in_trash' => __('No Member Items found in Trash'), 
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => false,
    'publicly_queryable' => true,
	'_builtin' => false,
    'show_ui' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    //'menu_icon' => get_template_directory_uri() .'/includes/images/portfolio.png',
    'menu_position' => null,
    'supports' => array('title','editor','thumbnail'),
	'has_archive' => true
  ); 
  register_post_type('leadership',$args);
}
/***  Custom post title placehoder Leadership Team */
function wplt_change_title_text( $title ){
     $screen = get_current_screen();
     if  ( 'leadership' == $screen->post_type ) { $title = 'Enter Name'; }
     return $title;
	}
add_filter( 'enter_title_here', 'wplt_change_title_text' );

/***  Custom Metabox for Testimonials */
$prefix = 'pjlt_';
	$ptmeta_box = array(
    'id' => 'my-meta-box',
    'title' => 'Member Detail',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
	array('name' => 'Postion','id' => $prefix . 'postion','type' => 'text',  'std' => ''),
    array('name' => 'Tel','id' => $prefix . 'tel','type' => 'text','std' => ''),
	array('name' => 'Cell','id' => $prefix . 'cell','type' => 'text','std' => ''),
	array('name' => 'Email','id' => $prefix . 'email','type' => 'text',  'std' => ''),
    )
    );
	    add_action('admin_menu', 'pttheme_add_box');
    // Add meta box
    function pttheme_add_box() {
		
    global $ptmeta_box;
	$screens = array( 'leadership');
	foreach ( $screens as $screen ) {
    add_meta_box($ptmeta_box['id'], $ptmeta_box['title'], 'pttheme_show_box', $screen, $ptmeta_box['context'], $ptmeta_box['priority']);
	}
    }
	    // Callback function to show fields in meta box
    function pttheme_show_box() {
    global $ptmeta_box, $post;
    // Use nonce for verification
    echo '<input type="hidden" name="pttheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
    echo '<table class="form-table">';
    foreach ($ptmeta_box['fields'] as $field) {
    // get current post meta data
    $meta = get_post_meta($post->ID, $field['id'], true);
    echo '<tr>',
    '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
    '<td>';
    switch ($field['type']) {
    case 'text':
    echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />', '<br />', $field['desc'];
    break;
    }
    echo '</td><td>',
    '</td></tr>';
    }
    echo '</table>';
    }
	    add_action('save_post', 'pttheme_save_data');
    // Save data from meta box
    function pttheme_save_data($post_id) {
    global $ptmeta_box;
    // verify nonce
    if (!wp_verify_nonce($_POST['pttheme_meta_box_nonce'], basename(__FILE__))) {
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
    foreach ($ptmeta_box['fields'] as $field) {
    $old = get_post_meta($post_id, $field['id'], true);
    $new = $_POST[$field['id']];
    if ($new && $new != $old) {

    update_post_meta($post_id, $field['id'], $new);
    } elseif ('' == $new && $old) {
    delete_post_meta($post_id, $field['id'], $old);
    }
    }
    }
	
	/***  Shortcode for Leadership Team */
add_shortcode('all_leadership_team', 'leadership_shortcode_query'); 
function leadership_shortcode_query(){
   $args = array(
		    'posts_per_page'   => -1,
            'post_type' => 'leadership',
            'post_status' => 'publish',
			'order'            => 'ASC'
        );
	global $post;
        $string = '';
        $query = new WP_Query( $args );
        if( $query->have_posts() ){
            $string .= '';
            while( $query->have_posts() ){
                $query->the_post();
				$attr = array('class' => "img-responsive");
                $string .= '<div class="clearfix ld-sec-inner">
            	<div class="pull-left ld-img">'.get_the_post_thumbnail($post_id,'full',$attr).'
                </div>
                <div class="pull-left ld-con">
                	<h2>'.get_the_title().'<span>&nbsp;'.get_post_meta($post->ID,'pjlt_postion',true).'</span></h2>
                    <div class="blog-info">
                    <ul>';
					if(!empty(get_post_meta($post->ID,'pjlt_tel',true))){$string .= '<li>Tel: <a href="tel:'.get_post_meta($post->ID,'pjlt_tel',true).'">'.get_post_meta($post->ID,'pjlt_tel',true).'</a></li>';}
                    if(!empty(get_post_meta($post->ID,'pjlt_cell',true))){$string .= '<li>cell: <a href="tel:'.get_post_meta($post->ID,'pjlt_cell',true).'">'.get_post_meta($post->ID,'pjlt_cell',true).'</a></li>';}
					if(!empty(get_post_meta($post->ID,'pjlt_email',true))){$string .= '<li><a href="mailto:'.get_post_meta($post->ID,'pjlt_email',true).'">'.get_post_meta($post->ID,'pjlt_email',true).'</a></li>';}
                    $string .= '</ul>
                    '.apply_filters( 'the_content', get_the_content()).'
                    </div>
                </div>
            </div>';
            }
            $string .= '';
        }
        wp_reset_query();
        return $string;
}
