<?php
/**
 * The template for displaying Category pages

 */

get_header(); ?>

		
<?php
$cur_cat_id = get_cat_id( single_cat_title("",false) );
if(!empty(Categories_Multiple_Images::get_image( $cur_cat_id, 1,'full'))){?>
<div class="page-banner page-banner321"> 
						<img src="<?php echo Categories_Multiple_Images::get_image( $cur_cat_id, 1,'full'); ?>" class="img-responsive" alt="">
						 </div>
				 <div class="page-banner page-banner320 hide"> 
						<img src="<?php echo Categories_Multiple_Images::get_image( $cur_cat_id, 2,'full'); ?>" class="img-responsive" alt="">									
						</div>
<?php } else{ echo '<div class="no-page-banner"></div>';} ?>

<div class="container home-body abt-body">
  <div class="row">
    <div class="col-md-2 left_nav">
    <div class="btn-group responsive-toggle clearfix">
<?php
class Walker_Nav_Menu_Dropdown extends Walker_Nav_Menu {
	function start_lvl(&$output, $depth){$indent = str_repeat("\t", $depth);}
	function end_lvl(&$output, $depth){$indent = str_repeat("\t", $depth);}
	function start_el(&$output, $item, $depth, $args) {
	$cur_cat_id = get_cat_id( single_cat_title("",false) );
 		$url = '#' !== $item->url ? $item->url : '';
		if(get_category_link($cur_cat_id)==$url){$output .= '<option class="active" selected="selected" value="' . $url . '">' . $item->title;}
		else{$output .= '<option value="' . $url . '">' . $item->title;}
	}	
	function end_el(&$output, $item, $depth){$output .= "</option>\n"; }
}
	  wp_nav_menu(array('menu' => 'industries_we_serve','container' => '','menu_class' => ''	,'walker' => new Walker_Nav_Menu_Dropdown(),
	'items_wrap'     => '<div class="mobile-menu"><form><select class="dropdown_menu" onchange="if (this.value) window.location.href=this.value">%3$s</select></form></div>'));
	?>

    </div>
    
      <h3 class="abt-txt">Industries <br>
        We Serve</h3>
      <?php
wp_nav_menu(array('menu' => 'industries_we_serve','container' => '','menu_class' => 'nav nav-tabs','items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>'));?>
    </div>
    <div class="col-md-8">
      <div class="tab-pane active" id="d">
        <h4><?php printf( __( '%s'), single_cat_title( '', false ) ); ?></h4>
        <?php if ( category_description() ) : // Show an optional category description ?>
				<?php echo category_description(); ?>
				<?php endif; ?>
				<?php if ( have_posts() ) : ?>
				<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>
			<?php if(function_exists('wp_paginate')) {
    wp_paginate();
}
else {
    weo_paging_nav();
}
?> 
       

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
      </div>
    </div>
    <div class="col-md-2">
      <?php dynamic_sidebar('sidebar-4'); ?> 
    </div>
  </div>
</div>
			
			

			


<?php //get_sidebar(); ?>
<?php get_footer(); ?>