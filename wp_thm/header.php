<?php
/**
 * The Header template for our theme
 
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">	
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/fevicon.png">
	<link rel="shortcut icon"  href="<?php echo get_template_directory_uri(); ?>/images/fevicon.png">

	<?php wp_head(); ?>
    <?php if ( get_option('we_custom_css') != ""){ ?>
    <style>
	<?php echo stripslashes(get_option('we_custom_css')); ?>
	</style>
    <?php }?>
</head>

<body <?php body_class(); ?>>
<div class="container">
  <div class="row">
    <div class="col-md-4 col-sm-6">
      <h1 class="logo"><a href="<?php bloginfo('siteurl');?>"><?php if ( get_option('we_logos') != ""){ ?>
        <img src='<?php echo stripslashes(get_option('we_logos')); ?> '/>
         <?php }
		 else{
			 ?>
			<a href="<?php bloginfo('siteurl');?>"><?php bloginfo( 'name' ); ?></a>
         <?php }?></a></h1>
    </div>
   <div class="col-md-8 col-sm-6 ful-res">
      <div class="top-right clearfix">
	  <?php
wp_nav_menu(array('menu' => 'top_menu','container' => '','menu_class' => 'top-link pull-right','items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>'));

?>
        <div class="main-nav pull-right" id="cssmenu">
        <div id="menu-button">Menu</div>
		<?php
			class My_Walker_Nav_Menu extends Walker_Nav_Menu {
				function start_lvl(&$output, $depth) {
				$indent = str_repeat("\t", $depth);
				$output .= "\n$indent<ul class=\"dropdown\">\n";
				}
			}
		 wp_nav_menu( array( 'theme_location' => 'primary','container' => '','menu_class' => 'main-menu','items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>','walker' => new My_Walker_Nav_Menu()) ); ?>
          
        </div>
      </div>
    </div>
  </div>
</div>