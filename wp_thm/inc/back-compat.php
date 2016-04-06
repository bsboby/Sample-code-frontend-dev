<?php
/**
 * WEO back compat functionality
 *
 * Prevents WEO from running on WordPress versions prior to 3.6,
 * since this theme is not meant to be backward compatible and relies on
 * many new functions and markup changes introduced in 3.6.
 *
 * @package WordPress
 * @subpackage WEO
 * @since WEO 1.0
 */

/**
 * Prevent switching to WEO on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since WEO 1.0
 *
 * @return void
 */
function weo_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'weo_upgrade_notice' );
}
add_action( 'after_switch_theme', 'weo_switch_theme' );

/**
 * Add message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * WEO on WordPress versions prior to 3.6.
 *
 * @since WEO 1.0
 *
 * @return void
 */
function weo_upgrade_notice() {
	$message = sprintf( __( 'WEO requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.'), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevent the Theme Customizer from being loaded on WordPress versions prior to 3.6.
 *
 * @since WEO 1.0
 *
 * @return void
 */
function weo_customize() {
	wp_die( sprintf( __( 'WEO requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.'), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'weo_customize' );

/**
 * Prevent the Theme Preview from being loaded on WordPress versions prior to 3.4.
 *
 * @since WEO 1.0
 *
 * @return void
 */
function weo_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'WEO requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.'), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'weo_preview' );
