<?php
/***  Custom post type careers Jobs */
add_action('init', 'dionne_add_careers_jobs');
function dionne_add_careers_jobs() 
{
  $labels = array(
    'name' => _x('Careers Jobs', 'post type general name' ),
    'singular_name' => _x('images Item', 'post type singular name' ),
    'add_new' => _x('Add New', 'job'),
    'add_new_item' => __('Add New job Item'),
    'edit_item' => __('Edit job Item' ),
    'new_item' => __('New job Item'),
    'view_item' => __('View job Item'),
    'search_items' => __('Search job Items'),
    'not_found' =>  __('No job Items found'),
    'not_found_in_trash' => __('No job Items found in Trash'), 
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
  register_post_type('careers_jobs',$args);
}
/***  Shortcode for career jobs */
add_shortcode('all_career_jobs', 'career_jobs_shortcode_query'); 
function career_jobs_shortcode_query(){
   $args = array(
   'posts_per_page'   => -1,
            'post_type' => 'careers_jobs',
            'post_status' => 'publish'
        );
global $post;
        $string = '<div class="ld-sec">';
        $query = new WP_Query( $args );
        if( $query->have_posts() ){
            $string .= '';
            while( $query->have_posts() ){
                $query->the_post();
                $string .= '<div class="clearfix ld-sec-inner">
            	<div class="job-title">
                	<h4 class="yl-col">'.get_the_title().'</h4>
                    <p>'.get_the_content().'</p>
                </div>
        </div>';
            }
           
        }
		 $string .= '</div>';
        wp_reset_query();
        return $string;
}
?>