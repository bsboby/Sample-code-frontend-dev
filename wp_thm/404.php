<?php
/**
 * The template for displaying 404 pages (Not Found)
 
 */

get_header(); ?>
			<?php /*?><div class="page-banner page-banner321"> 
			<img src="<?php echo get_bloginfo('template_directory').'/images/404-errorPage-banner.jpg';?>" class="img-responsive" alt="">	
						 </div>
				 <div class="page-banner page-banner320 hide"> 
						<img src="<?php echo get_bloginfo('template_directory').'/images/404-errorPage-banner320.jpg';?>" class="img-responsive" alt="">					
						</div> <?php */?>
			<div class="no-page-banner"></div>
		
<div class="container home-body abt-body">
  <div class="row">
    <div class="col-md-2 left_nav clearfix">
    
    <div class="btn-group responsive-toggle clearfix">
      <a class="btn dropdown-toggle btn-select2" data-toggle="dropdown" href="#">About Us <span class="caret"></span></a>
      <?php
wp_nav_menu(array('menu' => 'about_us','container' => '','menu_class' => 'dropdown-menu','items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>'));?>
    </div>
    
      <h3 class="abt-txt">About Us</h3>
      <?php
wp_nav_menu(array('menu' => 'about_us','container' => '','menu_class' => 'nav nav-tabs','items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>'));?>
	
    </div>
    <div class="col-md-8">
      <div class="tab-pane">
        <h4 class="error404"><?php echo "404";?></h4>
		<p class="errorc404"><?php _e( 'Page Not found'); ?></p>
		<p class="errorhome"> Go to the <a href="<?php bloginfo('siteurl');?>" >homepage</a>.</p>
      </div>
    </div>
    <div class="col-md-2">
      <?php dynamic_sidebar('sidebar-4'); ?> 
    </div>
  </div>
</div>			
				

<?php get_footer(); ?>