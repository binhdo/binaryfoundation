<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * @package Binary Foundation
 * @since Binary Foundation 0.1
 */

/**
 * Adds additional stylesheets to the TinyMCE editor if needed.
 *
 * @uses binaryfoundation_fonts_url() to get the Google Font stylesheet URL.
 *
 * @since Binary Foundation 1.0
 *
 * @param string $mce_css CSS path to load in TinyMCE.
 * @return string The filtered CSS paths list.
 */
function binaryfoundation_mce_css( $mce_css ) {
	$fonts_url = binaryfoundation_fonts_url();

	if ( empty( $fonts_url ) )
		return $mce_css;

	if ( ! empty( $mce_css ) )
		$mce_css .= ',';

	$mce_css .= esc_url_raw( str_replace( ',', '%2C', $fonts_url ) );

	return $mce_css;
}
add_filter( 'mce_css', 'binaryfoundation_mce_css' );

/**
 * Creates a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Binary Foundation 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function binaryfoundation_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'binaryfoundation' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'binaryfoundation_wp_title', 10, 2 );

/**
 * Sets the image size in featured galleries to large.
 *
 * @since Binary Foundation 1.0
 *
 * @param array $atts Combined and filtered attribute list.
 * @return array The filtered attribute list.
 */
function binaryfoundation_gallery_atts( $atts ) {
	if ( has_post_format( 'gallery' ) && ! is_single() )
		$atts['size'] = wp_is_mobile() ? 'thumbnail' : 'medium';

	return $atts;
}
add_filter( 'shortcode_atts_gallery', 'binaryfoundation_gallery_atts' );

/**
 * Extends the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Active widgets in the sidebar to change the layout and spacing.
 * 3. When avatars are disabled in discussion settings.
 *
 * @since Binary Foundation 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function binaryfoundation_body_class( $classes ) {
	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	if ( is_active_sidebar( 'sidebar-2' ) && ! is_attachment() && ! is_404() )
		$classes[] = 'sidebar';

	if ( ! get_option( 'show_avatars' ) )
		$classes[] = 'no-avatars';

	return $classes;
}
add_filter( 'body_class', 'binaryfoundation_body_class' );
