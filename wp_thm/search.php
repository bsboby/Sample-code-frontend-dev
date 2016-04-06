<?php
/**
 * The template for displaying Search Results pages
 
 */

get_header(); ?>

	

		<?php if ( have_posts() ) : ?>

			<?php printf( __( 'Search Results for: %s'), get_search_query() ); ?>
			

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