<?php
/***  Custom post type slider */
add_action('init', 'dionne_add_slider');
function dionne_add_slider() 
{
  $labels = array(
    'name' => _x('Slider', 'post type general name' ),
    'singular_name' => _x('images Item', 'post type singular name' ),
    'add_new' => _x('Add New', 'slide'),
    'add_new_item' => __('Add New slide Item'),
    'edit_item' => __('Edit slide Item' ),
    'new_item' => __('New slide Item'),
    'view_item' => __('View slide Item'),
    'search_items' => __('Search slide Items'),
    'not_found' =>  __('No slide Items found'),
    'not_found_in_trash' => __('No slide Items found in Trash'), 
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
    'supports' => array('title','thumbnail'),
	'has_archive' => true
  ); 
  register_post_type('Slider',$args);
}

/***  Custom Metabox for Slider */
$prefix = 'pjs_';
	$psmeta_box = array(
    'id' => 'my-meta-box3',
    'title' => 'Background',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
    array('name' => 'Text Background Color','id' => $prefix . 'textbgcolor','type' => 'colorpicker','std' => ''),
	
    )
    );
	    add_action('admin_menu', 'pstheme_add_box');
    // Add meta box
    function pstheme_add_box() {
		
    global $psmeta_box;
	$screens = array( 'slider');
	foreach ( $screens as $screen ) {
    add_meta_box($psmeta_box['id'], $psmeta_box['title'], 'pstheme_show_box', $screen, $psmeta_box['context'], $psmeta_box['priority']);
	}
    }
	    // Callback function to show fields in meta box
    function pstheme_show_box() {
	
    global $psmeta_box, $post;
    // Use nonce for verification
    echo '<input type="hidden" name="pstheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
    echo '<table class="form-table">';
    foreach ($psmeta_box['fields'] as $field) {
    // get current post meta data
    $meta = get_post_meta($post->ID, $field['id'], true);
    echo '<tr>',
    '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
    '<td>';
    switch ($field['type']) {
    case 'colorpicker':
	echo '<input type="text" class="my-color-field" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '"/>','<br />', $field['desc'];
    break;
    }
    echo '</td><td>',
    '</td></tr>';
    }
    echo '</table>';
    }
	    add_action('save_post', 'pstheme_save_data');
    // Save data from meta box
    function pstheme_save_data($post_id) {
    global $psmeta_box;
    // verify nonce
    if (!wp_verify_nonce($_POST['pstheme_meta_box_nonce'], basename(__FILE__))) {
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
    foreach ($psmeta_box['fields'] as $field) {
    $old = get_post_meta($post_id, $field['id'], true);
    $new = $_POST[$field['id']];
    if ($new && $new != $old) {
    update_post_meta($post_id, $field['id'], $new);
    } elseif ('' == $new && $old) {
    delete_post_meta($post_id, $field['id'], $old);
    }
    }
    }