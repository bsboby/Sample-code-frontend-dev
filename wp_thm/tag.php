<?php
/**
 * The template for displaying Tag pages
 
 */

get_header(); ?>


		<?php if ( have_posts() ) : ?>
			<?php printf( __( 'Tag Archives: %s'), single_tag_title( '', false ) ); ?>

				<?php if ( tag_description() ) : // Show an optional tag description ?>
				<?php echo tag_description(); ?>
				<?php endif; ?>
			
			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>

			<?php weo_paging_nav(); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		

<?php get_sidebar(); ?>
<?php get_footer(); ?>