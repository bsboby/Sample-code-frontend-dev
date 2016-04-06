<?php
/***  Custom post type Testimonials */
add_action('init', 'dionne_add_testimonials');
function dionne_add_testimonials() 
{
  $labels = array(
    'name' => _x('Testimonials', 'post type general name' ),
    'singular_name' => _x('images Item', 'post type singular name' ),
    'add_new' => _x('Add New', 'Testimonial'),
    'add_new_item' => __('Add New Testimonial Item'),
    'edit_item' => __('Edit Testimonial Item' ),
    'new_item' => __('New Testimonial Item'),
    'view_item' => __('View Testimonial Item'),
    'search_items' => __('Search Testimonial Items'),
    'not_found' =>  __('No Testimonial Items found'),
    'not_found_in_trash' => __('No Testimonial Items found in Trash'), 
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
    'supports' => array('title','editor'),
	'has_archive' => true
  ); 
  register_post_type('Testimonials',$args);
}
/***  Custom post title placehoder Testimonials */
function wpb_change_title_text( $title ){
     $screen = get_current_screen();
     if  ( 'testimonials' == $screen->post_type ) { $title = 'Enter Client Name'; }
     return $title;
	}
add_filter( 'enter_title_here', 'wpb_change_title_text' );

/***  Custom Metabox for Testimonials */
$prefix = 'pjt_';
	$meta_box = array(
    'id' => 'my-meta-box',
    'title' => 'Client Detail',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
    array(
    'name' => 'Designation','id' => $prefix . 'desg','type' => 'text','std' => ''),
	array('name' => 'Company','id' => $prefix . 'company','type' => 'text',  'std' => ''),
    )
    );
	    add_action('admin_menu', 'mytheme_add_box');
    // Add meta box
    function mytheme_add_box() {
		
    global $meta_box;
	$screens = array( 'Testimonials');
	foreach ( $screens as $screen ) {
    add_meta_box($meta_box['id'], $meta_box['title'], 'mytheme_show_box', $screen, $meta_box['context'], $meta_box['priority']);
	}
    }
	    // Callback function to show fields in meta box
    function mytheme_show_box() {
    global $meta_box, $post;
    // Use nonce for verification
    echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
    echo '<table class="form-table">';
    foreach ($meta_box['fields'] as $field) {
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
	    add_action('save_post', 'mytheme_save_data');
    // Save data from meta box
    function mytheme_save_data($post_id) {
    global $meta_box;
    // verify nonce
    if (!wp_verify_nonce($_POST['mytheme_meta_box_nonce'], basename(__FILE__))) {
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
    foreach ($meta_box['fields'] as $field) {
    $old = get_post_meta($post_id, $field['id'], true);
    $new = $_POST[$field['id']];
    if ($new && $new != $old) {
    update_post_meta($post_id, $field['id'], $new);
    } elseif ('' == $new && $old) {
    delete_post_meta($post_id, $field['id'], $old);
    }
    }
    }
	
	/***  Shortcode for Testimonials */
	add_shortcode('all_testimonials', 'testimonials_shortcode_query'); 
function testimonials_shortcode_query(){
   $args = array(
   'posts_per_page'   => -1,
            'post_type' => 'testimonials',
            'post_status' => 'publish'
        );
global $post;
        $string = '';
        $query = new WP_Query( $args );
        if( $query->have_posts() ){
            $string .= '';
            while( $query->have_posts() ){
                $query->the_post();
                $string .= '<div class="testimonial">
        <h5>&ldquo;'.get_the_content().'&rdquo;</h5>
        <p><strong>&ndash; '.get_the_title().', '.get_post_meta($post->ID,'pjt_desg',true).'</strong> <br>
          <span>'.get_post_meta($post->ID,'pjt_company',true).'</span></p>
      </div>';
            }
            $string .= '';
        }
        wp_reset_query();
        return $string;
}
