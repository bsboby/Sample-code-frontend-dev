<?php
/**
 * The template for displaying image attachments

 */

get_header(); ?>

	
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'image-attachment' ); ?>>
				<?php the_title(); ?>

					
						<?php
							$published_text = __( '<span class="attachment-meta">Published on <time class="entry-date" datetime="%1$s">%2$s</time> in <a href="%3$s" title="Return to %4$s" rel="gallery">%5$s</a></span>');
							$post_title = get_the_title( $post->post_parent );
							if ( empty( $post_title ) || 0 == $post->post_parent )
								$published_text = '<span class="attachment-meta"><time class="entry-date" datetime="%1$s">%2$s</time></span>';

							printf( $published_text,
								esc_attr( get_the_date( 'c' ) ),
								esc_html( get_the_date() ),
								esc_url( get_permalink( $post->post_parent ) ),
								esc_attr( strip_tags( $post_title ) ),
								$post_title
							);

							$metadata = wp_get_attachment_metadata();
							printf( '<span class="attachment-meta full-size-link"><a href="%1$s" title="%2$s">%3$s (%4$s &times; %5$s)</a></span>',
								esc_url( wp_get_attachment_url() ),
								esc_attr__( 'Link to full-size image'),
								__( 'Full resolution'),
								$metadata['width'],
								$metadata['height']
							);

							edit_post_link( __( 'Edit'), '<span class="edit-link">', '</span>' );
						?>
				<?php previous_image_link( false, __( '<span class="meta-nav">&larr;</span> Previous') ); ?>
						<?php next_image_link( false, __( 'Next <span class="meta-nav">&rarr;</span>') ); ?>
							<?php weo_the_attached_image(); ?>

							<?php if ( has_excerpt() ) : ?>
							
								<?php the_excerpt(); ?>
							
							<?php endif; ?>
					
					<?php if ( ! empty( $post->post_content ) ) : ?>
					
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:'), 'after' => '</div>' ) ); ?>
					
					<?php endif; ?>

			</article><!-- #post -->

			<?php comments_template(); ?>


<?php get_footer(); ?>