<?php
/**
 * The sidebar containing the secondary widget area
 
 */

if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
	
				<?php dynamic_sidebar( 'sidebar-2' ); ?>
			
<?php endif; ?>