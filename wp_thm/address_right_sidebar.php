<?php
// Creating the widget 
class was_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'was_widget', 

// Widget name will appear in UI
__('Address Right Sidebar', 'was_widget_domain'), 

// Widget description
array( 'description' => __( 'Address Right Sidebar', 'was_widget_domain' ), ) 
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
$address = apply_filters( 'widget_address', $instance['address'] );
$address2 = apply_filters( 'widget_address2', $instance['address2'] );
$tel = apply_filters( 'widget_tel', $instance['tel'] );
$email = apply_filters( 'widget_email', $instance['email'] );
$link = apply_filters( 'widget_link', $instance['link'] );

// before and after widget arguments are defined by themes
echo $args['before_widget'];
echo '<div class="address">
        <h5>Address</h5>
        <p><a href="'.$link.'"><strong>'.$address.'
         <span> '.$address2.'</span></strong></a></p>
         <p> Tel: <strong><a href="tel:'.$tel.'">'.$tel.'</a></strong>
         <span> Email: <strong><a href="mailto:'.$email.'">'.$email.'</a></strong> </span></p>
      </div>';
echo $args['after_widget'];
}

// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'address' ] ) ) {
$address = $instance[ 'address' ];
}

if ( isset( $instance[ 'address2' ] ) ) {
$address2 = $instance[ 'address2' ];
}
if ( isset( $instance[ 'tel' ] ) ) {
$tel = $instance[ 'tel' ];
}
if ( isset( $instance[ 'email' ] ) ) {
$email = $instance[ 'email' ];
}
if ( isset( $instance[ 'link' ] ) ) {
$link = $instance[ 'link' ];
}
// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'address' ); ?>"><?php _e( 'Address :' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" type="text" value="<?php echo esc_attr( $address ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'address2' ); ?>"><?php _e( 'Address 2:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'address2' ); ?>" name="<?php echo $this->get_field_name( 'address2' ); ?>" type="text" value="<?php echo esc_attr( $address2 ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'tel' ); ?>"><?php _e( 'Tel:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'tel' ); ?>" name="<?php echo $this->get_field_name( 'tel' ); ?>" type="text" value="<?php echo esc_attr( $tel ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e( 'email:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" type="text" value="<?php echo esc_attr( $email ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'link:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>" />
</p>

<?php 
}
	 
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['address'] = ( ! empty( $new_instance['address'] ) ) ? strip_tags( $new_instance['address'] ) : '';
$instance['address2'] = ( ! empty( $new_instance['address2'] ) ) ? strip_tags( $new_instance['address2'] ) : '';
$instance['tel'] = ( ! empty( $new_instance['tel'] ) ) ? strip_tags( $new_instance['tel'] ) : '';
$instance['email'] = ( ! empty( $new_instance['email'] ) ) ? strip_tags( $new_instance['email'] ) : '';
$instance['link'] = ( ! empty( $new_instance['link'] ) ) ? strip_tags( $new_instance['link'] ) : '';

return $instance;
} 
} // Class was_widget ends here 

// Register and load the widget
function was_load_widget() {
	register_widget( 'was_widget' );
}
add_action( 'widgets_init', 'was_load_widget' );