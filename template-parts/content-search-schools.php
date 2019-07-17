<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ort-site-2019
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php ort_site_2019_post_thumbnail( [ '150', '150' ] ); ?>

	<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

    <div class="entry-meta">
		<?php $city_cat = get_the_category( get_the_ID() );
		if ( count( $city_cat ) > 0 ) {
			echo $city_cat[0]->name;
		}
		?>
    </div><!-- .entry-meta -->

    <div class="entry-age_group">
		<?php echo implode( $utils->get_post_group_tags_names( 2 ), "//" ); ?>
    </div><!-- .entry-summary -->

    <footer class="entry-footer">
		<?php $utils->display_advanced_custom_field( 'ort_school_phone', 'span', 'fa-phone' ); ?>
		<?php $utils->display_advanced_custom_field( 'ort_school_email', 'span', 'fa-envelope' ); ?>
		<?php $utils->display_advanced_custom_field( 'ort_school_address', 'span', 'fa-map-marker-alt' ); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
