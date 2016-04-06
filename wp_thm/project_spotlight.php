<?php
// Creating the widget 
class wps_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'wps_widget', 

// Widget name will appear in UI
__('Project Spotlight', 'wps_widget_domain'), 

// Widget description
array( 'description' => __( 'Home Project Spotlight', 'wps_widget_domain' ), ) 
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
$heading = apply_filters( 'widget_heading', $instance['heading'] );
$content = apply_filters( 'widget_content', $instance['content'] );
$imagetext = apply_filters( 'widget_imagetext', $instance['imagetext'] );
$country = apply_filters( 'widget_country', $instance['country'] );
$rmlink = apply_filters( 'widget_rmlink', $instance['rmlink'] );
$image_uri = apply_filters( 'widget_image_uri', $instance['image_uri'] );

// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $heading ) )
echo $args['before_title'] . $heading . $args['after_title'];

       echo '<div class="home-img"> <img src="'.$image_uri.'" alt="" class="img-responsive"> <span>'.$imagetext.'</span> </div>
        <h4>'.$title.' <span>('.$country.')</span></h4>
        <p> '.$content.' &nbsp; <a href="'.$rmlink.'">READ MORE</a> </p>';

echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'New title', 'wps_widget_domain' );
}
if ( isset( $instance[ 'content' ] ) ) {
$content = $instance[ 'content' ];
}
if ( isset( $instance[ 'imagetext' ] ) ) {
$imagetext = $instance[ 'imagetext' ];
}
if ( isset( $instance[ 'country' ] ) ) {
$country = $instance[ 'country' ];
}
if ( isset( $instance[ 'rmlink' ] ) ) {
$rmlink = $instance[ 'rmlink' ];
}
if ( isset( $instance[ 'image_uri' ] ) ) {
$image_uri = $instance[ 'image_uri' ];
}
if ( isset( $instance[ 'heading' ] ) ) {
$heading = $instance[ 'heading' ];
}


// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'heading' ); ?>"><?php _e( 'Heading:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'heading' ); ?>" name="<?php echo $this->get_field_name( 'heading' ); ?>" type="text" value="<?php echo esc_attr( $heading ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'country' ); ?>"><?php _e( 'Country:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'country' ); ?>" name="<?php echo $this->get_field_name( 'country' ); ?>" type="text" value="<?php echo esc_attr( $country ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'imagetext' ); ?>"><?php _e( 'Image Text:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'imagetext' ); ?>" name="<?php echo $this->get_field_name( 'imagetext' ); ?>" type="text" value="<?php echo esc_attr( $imagetext ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'content' ); ?>"><?php _e( 'Content:' ); ?></label> 
<textarea class="widefat" id="<?php echo $this->get_field_id( 'content' ); ?>" name="<?php echo $this->get_field_name( 'content' ); ?>" rows="5" cols="5"><?php echo esc_attr( $content ); ?></textarea>
</p>
<p>
<label for="<?php echo $this->get_field_id( 'rmlink' ); ?>"><?php _e( 'Read More Link:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'rmlink' ); ?>" name="<?php echo $this->get_field_name( 'rmlink' ); ?>" type="text" value="<?php echo esc_attr( $rmlink ); ?>" />
</p>
 <p>
      <label for="<?php echo $this->get_field_id('image_uri'); ?>">Image</label><br />
  
        <input type="text" class="widefat custom_media_url" name="<?php echo $this->get_field_name('image_uri'); ?>" id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php echo $image_uri; ?>">
		      <?php if(!empty($image_uri)){?><img class="custom_media_image" src="<?php echo $image_uri; ?>" style="margin:0;padding:0;max-width:100%;float:left;display:block" /><?php } ?>
			  <br />
       </p>
       <p>
        <input type="button" value="<?php _e( 'Upload Image', 'iuw' ); ?>" class="button custom_media_upload" id="custom_image_uploader"/>
		<?php /*?><input type="button" value="<?php _e( 'Delete', 'iuw' ); ?>" class="button custom_media_delete" id="custom_image_delete"/><?php */?>
    </p>
<?php 
}
	 
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['heading'] = ( ! empty( $new_instance['heading'] ) ) ? strip_tags( $new_instance['heading'] ) : '';
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['content'] = ( ! empty( $new_instance['content'] ) ) ? strip_tags( $new_instance['content'] ) : '';
$instance['country'] = ( ! empty( $new_instance['country'] ) ) ? strip_tags( $new_instance['country'] ) : '';
$instance['imagetext'] = ( ! empty( $new_instance['imagetext'] ) ) ? strip_tags( $new_instance['imagetext'] ) : '';
$instance['rmlink'] = ( ! empty( $new_instance['rmlink'] ) ) ? strip_tags( $new_instance['rmlink'] ) : '';
$instance['image_uri'] = ( ! empty( $new_instance['image_uri'] ) ) ? strip_tags( $new_instance['image_uri'] ) : '';

return $instance;
} 
} // Class wps_widget ends here 

// Register and load the widget
function wps_load_widget() {
	register_widget( 'wps_widget' );
}
add_action( 'widgets_init', 'wps_load_widget' );
function vjs_imScript(){
  wp_enqueue_media();
  wp_enqueue_script('adsScript', get_bloginfo('template_directory').'/js/image-upload-widget.js');
}
add_action('admin_enqueue_scripts', 'vjs_imScript');
