<?php
/**
 * The default template for displaying content
 *
 */
?>

<div <?php post_class('blog-img1'); ?> id="post-<?php the_ID(); ?>">
	
		<?php //if ( has_post_thumbnail() && ! post_password_required() ) :  the_post_thumbnail(); endif; ?>

		<?php if ( is_single() ) : ?>
	<h3><?php the_title(); ?> <span><?php echo get_post_meta($post->ID,'pji_country',true)?></span></h3>
			<?php else : ?>
		<h3><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a> <span><?php echo get_post_meta($post->ID,'pji_country',true)?></span></h3>
		<h3><?php the_title(); ?> <span><?php echo get_post_meta($post->ID,'pji_country',true)?></span></h3>
		<?php endif; // is_single() ?>
<?php $slider_id= get_post_meta($post->ID,'pji_slider',true); if(!empty($slider_id)){ echo do_shortcode("[huge_it_slider id={$slider_id}]");}?>
          <div class="blog-info">
            <ul>
              <li>Owner: <span><?php echo get_post_meta($post->ID,'pji_owner',true)?></span></li>
              <li>General Contractor: <span><?php echo get_post_meta($post->ID,'pji_contractor',true)?></span></li>
              <li>Contract Value: <span><?php echo get_post_meta($post->ID,'pji_cvalue',true)?></span></li>
            </ul>
			<?php //weo_entry_meta(); ?>
	<?php if ( is_search() || is_category() ) : // Only display Excerpts for Search ?>
		<?php the_excerpt(); ?>
	<?php else : ?>
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>') ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:') . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
	<?php endif; ?>
	 </div>	
	<?php edit_post_link( __( 'Edit'), '<span class="edit-link">', '</span>' ); ?>
	
		<?php if ( comments_open() && ! is_single() ) : ?>
				<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment') . '</span>', __( 'One comment so far'), __( 'View all % comments') ); ?>
		<?php endif; // comments_open() ?>

		<?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
			<?php get_template_part( 'author-bio' ); ?>
		<?php endif; ?>
		</div>
