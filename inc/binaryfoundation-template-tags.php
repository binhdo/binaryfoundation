<?php
/**
 * Custom template tags for this theme.
 * 
 * @package Binary Foundation
 * @since Binary Foundation 0.1
 */

/**
 * Full width column class
 * 
 * @return string
 */
function binaryfoundation_full_width_class() {
	return 'small-12 large-12 columns';
}

/**
 * #primary .content-area
 *
 * @param string $has_sidebar
 * @return string
 */
function binaryfoundation_primary_class($has_sidebar = true) {
	if ( $has_sidebar && is_active_sidebar( 'sidebar-2' ) ) {
		$class = 'small-12 large-9 columns';
	} else {
		$class = 'small-12 large-12 columns';
	}

	return $class;
}

function binaryfoundation_secondary_widget_class() {
	return 'small-block-grid-2 large-block-grid-4';
}

/**
 * #tertiary .widget-area class (Appears on posts and pages in the sidebar)
 *
 * @return string
 */
function binaryfoundation_tertiary_class() {
		return 'small-12 large-3 columns';
}

function binaryfoundation_tertiary_widget_class() {
	return 'small-block-grid-2 large-block-grid-1';
}


function binaryfoundation_top_bar( $location, $args = array() ) {
	if ( has_nav_menu( $location ) ) {
		$defaults = array(
			'show_title' => true,
			'title_name' => get_bloginfo( 'name' ),
			'title_url' => home_url( '/' ),
			'menu_item_text' => __( 'Menu', 'binaryfoundation' ),
			'align' => 'left',
		);
	
		$args = wp_parse_args( $args, $defaults );
		extract( $args, EXTR_OVERWRITE );
		
		$nav_menu_args = array(
			'container' => false,
			'menu_class' => $align,
			'menu_id' => '',
			'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'depth' => 0,
			'walker' => new BinaryFoundation_Walker_Nav_Menu(),
			'theme_location' => $location );		
		?>
		<nav class="top-bar">
			<?php if ( $show_title ) : ?>
				<ul class="title-area">
					<!-- Title Area -->
					<li class="name"><h1><a href="<?php echo esc_url( $title_url ); ?>"><?php echo esc_attr( $title_name ); ?></a></h1></li>
					<li class="toggle-topbar menu-icon"><a href="#"><span><?php echo esc_attr( $menu_item_text ); ?></span></a></li>
				</ul>
			<?php endif; ?>
			<section class="top-bar-section">
				<?php wp_nav_menu( $nav_menu_args ); ?>
			</section>
		</nav>
	<?php
	}
}

/**
 * Returns the Google font stylesheet URL, if available.
 *
 * The use of Source Sans Pro and Bitter by default is localized. For languages
 * that use characters not supported by the font, the font can be disabled.
 *
 * @since Binary Foundation 1.0
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function binaryfoundation_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Source Sans Pro, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$source_sans_pro = _x( 'on', 'Source Sans Pro font: on or off', 'binaryfoundation' );

	/* Translators: If there are characters in your language that are not
	 * supported by Bitter, translate this to 'off'. Do not translate into your
	 * own language.
	 */
	$bitter = _x( 'on', 'Bitter font: on or off', 'binaryfoundation' );

	if ( 'off' !== $source_sans_pro || 'off' !== $bitter ) {
		$font_families = array();

		if ( 'off' !== $source_sans_pro )
			$font_families[] = 'Source+Sans+Pro:300,400,700,300italic,400italic,700italic';

		if ( 'off' !== $bitter )
			$font_families[] = 'Bitter:400,700';

		$protocol = is_ssl() ? 'https' : 'http';
		$query_args = array(
			'family' => implode( '|', $font_families ),
			'subset' => 'latin,latin-ext',
		);
		$fonts_url = add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" );
	}

	return $fonts_url;
}

if ( ! function_exists( 'binaryfoundation_paging_nav' ) ) :
/**
 * Displays navigation to next/previous set of posts when applicable.
 *
 * @since Binary Foundation 1.0
 *
 * @return void
 */
function binaryfoundation_paging_nav() {
	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'binaryfoundation' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'binaryfoundation' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'binaryfoundation' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'binaryfoundation_post_nav' ) ) :
/**
 * Displays navigation to next/previous post when applicable.
*
* @since Binary Foundation 1.0
*
* @return void
*/
function binaryfoundation_post_nav() {
	global $post;

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous )
		return;
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'binaryfoundation' ); ?></h1>
		<div class="nav-links">

			<?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'binaryfoundation' ) ); ?>
			<?php next_post_link( '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'binaryfoundation' ) ); ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'binaryfoundation_entry_meta' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own binaryfoundation_entry_meta() to override in a child theme.
 *
 * @since Binary Foundation 1.0
 *
 * @return void
 */
function binaryfoundation_entry_meta() {
	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<span class="featured-post">' . __( 'Sticky', 'binaryfoundation' ) . '</span>';

	if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
		binaryfoundation_entry_date();

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'binaryfoundation' ) );
	if ( $categories_list ) {
		echo '<span class="categories-links">' . $categories_list . '</span>';
	}

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'binaryfoundation' ) );
	if ( $tag_list ) {
		echo '<span class="tags-links">' . $tag_list . '</span>';
	}

	// Post author
	if ( 'post' == get_post_type() ) {
		printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'binaryfoundation' ), get_the_author() ) ),
			get_the_author()
		);
	}
}
endif;

if ( ! function_exists( 'binaryfoundation_entry_date' ) ) :
/**
 * Prints HTML with date information for current post.
 *
 * Create your own binaryfoundation_entry_date() to override in a child theme.
 *
 * @since Binary Foundation 1.0
 *
 * @param boolean $echo Whether to echo the date. Default true.
 * @return string The HTML-formatted post date.
 */
function binaryfoundation_entry_date( $echo = true ) {
	$format_prefix = ( has_post_format( 'chat' ) || has_post_format( 'status' ) ) ? _x( '%1$s on %2$s', '1: post format name. 2: date', 'binaryfoundation' ): '%2$s';

	$date = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'binaryfoundation' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if ( $echo )
		echo $date;

	return $date;
}
endif;

if ( ! function_exists( 'binaryfoundation_the_attached_image' ) ) :
/**
 * Prints the attached image with a link to the next attached image.
 *
 * @since Binary Foundation 1.0
 *
 * @return void
 */
function binaryfoundation_the_attached_image() {
	$post                = get_post();
	$attachment_size     = apply_filters( 'binaryfoundation_attachment_size', array( 724, 724 ) );
	$next_attachment_url = wp_get_attachment_url();

	/**
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID'
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );

		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
	}

	printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
		esc_url( $next_attachment_url ),
		the_title_attribute( array( 'echo' => false ) ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

/**
 * Returns the URL from the post.
 *
 * @uses get_url_in_content() to get the URL in the post meta (if it exists) or
 * the first link found in the post content.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @since Binary Foundation 1.0
 *
 * @return string The Link format URL.
 */
function binaryfoundation_get_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content( $content );

	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

