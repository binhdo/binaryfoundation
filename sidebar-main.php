<?php
/**
 * The sidebar containing the footer widget area.
 *
 * If no active widgets in this sidebar, it will be hidden completely.
 *
 * @package WordPress
 * @subpackage Binary_Foundation
 * @since Binary Foundation 1.0
 */

if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
<div id="secondary" class="sidebar-container <?php echo binaryfoundation_full_width_class(); ?>" role="complementary">
	<ul class="widget-area <?php echo binaryfoundation_secondary_widget_class(); ?>">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</ul><!-- .widget-area -->
	</div><!-- #secondary -->
<?php endif; ?>