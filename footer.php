<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ort-site-2019
 */

?>

	</div><!-- #content -->



	<footer id="colophon" class="site-footer">
        <div class="two-parts-footer">
            <?php echo do_shortcode('[elementor-template id="23164"]'); ?>
            <?php echo do_shortcode('[elementor-template id="23185"]'); ?>
        </div>
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'ort_site_2019' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by', 'ort_site_2019' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'mop-developer', 'ort_site_2019' ), 'ort_site_2019', '<a href="https://ort.org.il">Ort Israel Team</a>' );
				?>
            <span class="sep"> | </span>

            <!--<a href="https://mapa-linux-test.ort.org.il/ort-site-2019/%d7%94%d7%a6%d7%94%d7%a8%d7%aa-%d7%a0%d7%92%d7%99%d7%a9%d7%95%d7%aa/"><?php //_e('accessibility declaration','ort_site_2019')?></a> -->

            <a href="<?php echo get_site_url(null, '/accessibility-declaration/', 'https'); ?>"><?php _e('accessibility declaration','ort_site_2019')?></a>

            <span class="sep"> | </span>

            <a href="<?php echo get_site_url(null, '/site-map/', 'https'); ?>"><?php _e('site map','ort_site_2019')?></a>


        </div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<button class="top-bar" onclick="window.location.href='#site-navigation'"><?php _e('go to top navigation','ort_site_2019')?></button>
</body>
</html>
