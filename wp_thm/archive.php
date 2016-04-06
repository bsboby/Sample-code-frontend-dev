<?php
/**
 * The template for displaying Archive pages
 */

get_header(); ?>

	

		<?php if ( have_posts() ) : ?>
			<title><?php
					if ( is_day() ) :
						printf( __( 'Daily Archives: %s'), get_the_date() );
					elseif ( is_month() ) :
						printf( __( 'Monthly Archives: %s'), get_the_date( _x( 'F Y', 'monthly archives date format') ) );
					elseif ( is_year() ) :
						printf( __( 'Yearly Archives: %s'), get_the_date( _x( 'Y', 'yearly archives date format') ) );
					else :
						_e( 'Archives');
					endif;
				?>

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