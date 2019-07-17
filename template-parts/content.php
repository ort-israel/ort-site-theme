<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ort-site-2019
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	/*אwe need parameters to know where display comments zone*/
	$grand_cat       = [];
	$category_id     = '';
	$category_detail = get_the_category();
	if ( ! empty( $category_detail ) ) {
		$category_id   = $category_detail[0]->term_id;
		$category_slug = $category_detail[0]->slug;
		$grand_cat     = $utils->get_category_top_parent_id( $category_id );
	}
	?>

    <header class="entry-header">
        <div class="startup-eduction"></div>

        <div class="breadcrumbs" typeof="BreadcrumbList">
			<?php
			if ( function_exists( 'bcn_display' ) ) {
				bcn_display();
			} ?>
        </div>
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( $grand_cat == 'correspondence' ) :
			?>
            <div class="entry-meta">
				<?php

				the_time( 'j F, Y' );
				?>
            </div><!-- .entry-meta -->
		<?php endif; ?>
    </header><!-- .entry-header -->

    <div class="excerpt-post">
		<?php echo get_only_exc(); ?>
    </div>

	<?php //ort_site_2019_post_thumbnail(); ?>

    <div class="entry-content">

		<?php the_content( sprintf(
			wp_kses(
			/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'ort_site_2019' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );

		?>
    </div><!-- .entry-content -->

    <!-- to display expert according to custom field -->

	<?php $post_objects = get_field( 'choice expert' );
	if ( $post_objects ): ?>
    <div class="expert">

        <h2 class="title-expert"><?php _e( 'our expert', 'ort_site_2019' ); ?></h2>

        <ul>
			<?php foreach ( $post_objects as $post_object ): ?>
                <li>
					<?php /*get expert details*/
					echo $utils->get_exp_det( $post_object->ID ); ?>
                </li>
			<?php endforeach; ?>
        </ul>
		<?php endif; ?>

    </div>
    <div class="display-tags">
		<?php if ( has_tag() ) {
			the_tags( '', '', '' );
		} ?>
    </div>

	<?php
	if ( $grand_cat == 'correspondence' ) {
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
	}
	?>

    <!-- related post temaplate -->
	<?php // not display in category "israeli-pride"
	if ( ! ( $category_id == 18 ) ) {
		echo do_shortcode( '[elementor-template id="28369"]' );
	} ?>
    <footer class="entry-footer">
		<?php //ort_site_2019_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
