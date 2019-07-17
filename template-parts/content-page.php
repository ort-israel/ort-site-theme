<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ort-site-2019
 */

?>
<?php  /* put the main image of page as background image to entry header*/
        $page=$wp_query->get_queried_object();
        $page_id = $page->ID;
        $url = wp_get_attachment_url( get_post_thumbnail_id( $page_id) ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header splashed-header" style='background-image:url("<?php echo $url ?>")'>
        <div class="title-desc">
		<?php the_title( '<h1 class="entry-title" tabindex="0">', '</h1>' );?>
        <div class="page-description" tabindex="0"> <?php echo get_only_exc() ?> </div>
        </div>
	</header><!-- .entry-header -->

    
	<div class="entry-content">
		<?php
		the_content();

		?>
	</div><!-- .entry-content -->

    <?php $post_objects = get_field('choice expert');
    if( $post_objects ):?>

    <div class="expert">

        <h2 class="title-expert"><?php _e('our expert','ort_site_2019'); ?></h2>

            <ul>
                <?php foreach( $post_objects as $post_object): ?>
                    <li>
                        <?php echo $utils->get_exp_det( $post_object->ID); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
    </div>
        <?php endif;?>



	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'ort_site_2019' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
