<?php 
/*

Template Name: Service We Offer Template

*/
get_header(); ?>

	

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					
										<?php if ( has_post_thumbnail() && ! post_password_required() ) {?>
				<div class="page-banner page-banner321"> 
						<?php $attr = array('class' => "img-responsive"); the_post_thumbnail( 'full', $attr ); ?> 
						 </div>
				 <div class="page-banner page-banner320 hide"> 
						<?php if (class_exists('MultiPostThumbnails')) : MultiPostThumbnails::the_post_thumbnail(get_post_type(),'secondary-image');endif;?>									
						</div>
						 <?php }else{ echo '<div class="no-page-banner"></div>';} ?>

<div class="container home-body abt-body">
  <div class="row">
    <div class="col-md-2 left_nav">
    <div class="btn-group responsive-toggle clearfix">
<?php
class Walker_Nav_Menu_Dropdown extends Walker_Nav_Menu {
	function start_lvl(&$output, $depth){$indent = str_repeat("\t", $depth);}
	function end_lvl(&$output, $depth){$indent = str_repeat("\t", $depth);}
	function start_el(&$output, $item, $depth, $args) {
 		$url = '#' !== $item->url ? $item->url : '';
		if(get_permalink()==$url){$output .= '<option class="active" selected="selected" value="' . $url . '">' . $item->title;}
		else{$output .= '<option value="' . $url . '">' . $item->title;}
	}	
	function end_el(&$output, $item, $depth){$output .= "</option>\n"; }
}
	  wp_nav_menu(array('menu' => 'services_we_offer','container' => '','menu_class' => ''	,'walker' => new Walker_Nav_Menu_Dropdown(),
	'items_wrap'     => '<div class="mobile-menu"><form><select class="dropdown_menu" onchange="if (this.value) window.location.href=this.value">%3$s</select></form></div>'));
	?>
    </div>
    
      <h3 class="abt-txt">SERVICES <br>
        WE OFFER</h3>
      <?php
wp_nav_menu(array('menu' => 'services_we_offer','container' => '','menu_class' => 'nav nav-tabs','items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>'));?>
    </div>
    <div class="col-md-8">
      <div class="tab-pane">
        <h4><?php the_title(); ?></h4>
       <?php the_content(); ?>
      </div>
    </div>
    <div class="col-md-2">
       <?php dynamic_sidebar('sidebar-4'); ?> 
    </div>
  </div>
</div>
					
						<?php edit_post_link( __( 'Edit'), '<span class="edit-link">', '</span>' ); ?>
				</article>
			<?php endwhile; ?>



<?php get_footer(); ?>
<script>
$(document).ready(function(){
    $('#menu-button').text('services we offer');
});
</script>