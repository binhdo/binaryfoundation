<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Binary_Foundation
 * @since Binary Foundation 1.0
 */
?>

		</div><!-- #main -->
		<footer id="colophon" class="site-footer row" role="contentinfo">
			<?php get_sidebar( 'main' ); ?>

			<div class="site-info <?php echo binaryfoundation_full_width_class(); ?>">
				<?php do_action( 'binaryfoundation_credits' ); ?>
				<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'binaryfoundation' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'binaryfoundation' ); ?>"><?php printf( __( 'Proudly powered by %s', 'binaryfoundation' ), 'WordPress' ); ?></a>
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>
</body>
</html>