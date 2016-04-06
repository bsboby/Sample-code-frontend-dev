<?php 
/*

Template Name: Home Page Template

*/
get_header();?>


<div class="flexslider">
          <ul class="slides">
		  <?php	$count =0;
			$loop = new WP_Query( $args = array('posts_per_page' => -1,'post_type' => 'slider','post_status' => 'publish') );
			while ( $loop->have_posts() ) : $loop->the_post();?>
			<li><div class="page-banner321">
						<?php the_post_thumbnail( 'full' ); ?> </div>
						<div class="page-banner320 hide">
						<?php if (class_exists('MultiPostThumbnails')) : MultiPostThumbnails::the_post_thumbnail(get_post_type(),'secondary-image');endif;?>									
						</div>
						 <div class="flex-caption carousel-caption" style="background:<?php if(!empty(get_post_meta($post->ID,'pjs_textbgcolor',true))){echo get_post_meta($post->ID,'pjs_textbgcolor',true);}?>"><h4><?php the_title();?></h4></div>
						</li>

    			<?php endwhile;  wp_reset_postdata();?>
          </ul>
        </div>
<?php /*?><div class="slider">
  <div id="myCarousel" class="carousel slide carousel-fade">
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <!-- Carousel items -->
    <div class="carousel-inner">
	<?php 
	$count =0;
			$loop = new WP_Query( $args = array('posts_per_page' => -1,'post_type' => 'slider','post_status' => 'publish') );
			while ( $loop->have_posts() ) : $loop->the_post();
			?>
  <div class="<?php if ($count==0){echo "active";} ?> item">
				<div class="page-banner321"> 
						<?php the_post_thumbnail( 'full' ); ?> 
						 </div>
				 <div class="page-banner320 hide"> 
						<?php if (class_exists('MultiPostThumbnails')) : MultiPostThumbnails::the_post_thumbnail(get_post_type(),'secondary-image');endif;?>									
						</div>
        <div class="carousel-caption" style="background:<?php if(!empty(get_post_meta($post->ID,'pjs_textbgcolor',true))){echo get_post_meta($post->ID,'pjs_textbgcolor',true);}?>">
          <h4><?php the_title();?></h4>
        </div>
      </div>
		<?php $count++;	endwhile;  wp_reset_postdata(); ?>
    </div>
    <!-- Carousel nav --> 
    <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a> <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a> </div>
</div><?php */?>
<div class="container home-body">
  <div class="row">
    <div class="col-md-8">
      <div class="body-left">
        <h2><?php the_title();?></h2>
        <p><?php the_content();?></p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="body-right">
	  <?php dynamic_sidebar('sidebar-3'); ?> 
        
        
        
      </div>
    </div>
  </div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>