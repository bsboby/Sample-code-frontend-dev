<?php
/**
 * The template for displaying all single posts
 
 */

get_header(); ?>

<div class="container home-body abt-body">
  <div class="row">
    <div class="col-md-2">
    <div class="btn-group responsive-toggle clearfix">
      <a class="btn dropdown-toggle btn-select2" data-toggle="dropdown" href="#">Bio & Technology<span class="caret"></span></a>
       <?php
wp_nav_menu(array('menu' => 'industries_we_serve','container' => '','menu_class' => 'dropdown-menu','items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>'));?>
    </div>
    
      <h3 class="abt-txt">Industries <br>
        We Serve</h3>
      <?php
wp_nav_menu(array('menu' => 'industries_we_serve','container' => '','menu_class' => 'nav nav-tabs','items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>'));?>
    </div>
<div class="col-md-8">
      <div class="tab-pane active " id="d">
			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>
				<?php weo_post_nav(); ?>
				<?php comments_template(); ?>

			<?php endwhile; ?>
			</div>
    </div>
			<div class="col-md-2">
      <?php dynamic_sidebar('sidebar-4'); ?> 
    </div>
  </div>
</div>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
