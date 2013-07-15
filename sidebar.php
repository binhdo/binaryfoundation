<?php
/**
 * The sidebar containing the secondary widget area, displays on posts and pages.
 *
 * If no active widgets in this sidebar, it will be hidden completely.
 *
 * @package WordPress
 * @subpackage Binary_Foundation
 * @since Binary Foundation 1.0
 */

if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
<div id="tertiary" class="sidebar-container <?php echo binaryfoundation_tertiary_class(); ?>" role="complementary">
	<ul class="widget-area  <?php echo binaryfoundation_tertiary_widget_class(); ?>">
				<?php dynamic_sidebar( 'sidebar-2' ); ?>
			</ul><!-- .widget-area -->
	</div><!-- #tertiary -->
<?php endif; ?>