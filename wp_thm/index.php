<?php
/**
 * The main template file
 
 */

get_header(); ?>

	
		<?php if ( have_posts() ) : ?>


			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>

			<?php weo_paging_nav(); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		


<?php get_footer(); ?>