<?php
// Creating the widget 
class wts_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'wts_widget', 

// Widget name will appear in UI
__('Testimonial Right Sidebar', 'wts_widget_domain'), 

// Widget description
array( 'description' => __( 'Testimonial Right Sidebar', 'wts_widget_domain' ), ) 
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
$name = apply_filters( 'widget_title', $instance['name'] );
$designation = apply_filters( 'widget_designation', $instance['designation'] );
$content = apply_filters( 'widget_content', $instance['content'] );
$company = apply_filters( 'widget_company', $instance['company'] );

// before and after widget arguments are defined by themes
echo $args['before_widget'];
echo'<div class="testimonial">
        <h5>&ldquo;'.substr("$content",0,120).'&rdquo;</h5>
        <p><strong>&ndash;'.$name.', '.$designation.'</strong> <br>
          <span>'.$company.'</span></p>
      </div>';
echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'name' ] ) ) {
$name = $instance[ 'name' ];
}

if ( isset( $instance[ 'content' ] ) ) {
$content = $instance[ 'content' ];
}
if ( isset( $instance[ 'designation' ] ) ) {
$designation = $instance[ 'designation' ];
}
if ( isset( $instance[ 'company' ] ) ) {
$company = $instance[ 'company' ];
}
// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e( 'Name:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" type="text" value="<?php echo esc_attr( $name ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'designation' ); ?>"><?php _e( 'Designation:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'designation' ); ?>" name="<?php echo $this->get_field_name( 'designation' ); ?>" type="text" value="<?php echo esc_attr( $designation ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'company' ); ?>"><?php _e( 'Company:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'company' ); ?>" name="<?php echo $this->get_field_name( 'company' ); ?>" type="text" value="<?php echo esc_attr( $company ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'content' ); ?>"><?php _e( 'Content:' ); ?></label> 
<textarea class="widefat" id="<?php echo $this->get_field_id( 'content' ); ?>" name="<?php echo $this->get_field_name( 'content' ); ?>" rows="5" cols="5"><?php echo esc_attr( $content ); ?></textarea>
</p>
<?php 
}
	 
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['name'] = ( ! empty( $new_instance['name'] ) ) ? strip_tags( $new_instance['name'] ) : '';
$instance['content'] = ( ! empty( $new_instance['content'] ) ) ? strip_tags( $new_instance['content'] ) : '';
$instance['company'] = ( ! empty( $new_instance['company'] ) ) ? strip_tags( $new_instance['company'] ) : '';
$instance['designation'] = ( ! empty( $new_instance['designation'] ) ) ? strip_tags( $new_instance['designation'] ) : '';

return $instance;
} 
} // Class wts_widget ends here 

// Register and load the widget
function wts_load_widget() {
	register_widget( 'wts_widget' );
}
add_action( 'widgets_init', 'wts_load_widget' );