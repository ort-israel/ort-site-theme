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

    <div class="image-post">
    <?php $utils->ort_site_2019_post_thumbnail_no_link(); ?>
    </div>

    <div class="details-post">
        <?php if($bool_value==1){ ?>
            <span class="category-name"> <?php echo $name_category;?> </span>
        <?php } ?>
     <header class="entry-header">

     <?php   if ( is_singular() ) :
        the_title( '<h1 class="entry-title">', '</h1>' );
        else :
        the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        endif;

        if ( 'post' === get_post_type() ) :
        endif; ?>

     </header><!-- .entry-header -->

    <div class="entry-content">
              <?php echo get_cont_exc() ?>
        <span class="learn-more" aria-label="<?php _e('read-more-post','ort-site-2019') ?>"><a href="<?php  echo esc_url( get_permalink());?>"><?php esc_html_e( 'learn more', 'ort_site_2019' ); ?></a> </span>
    </div><!-- .entry-content -->
    </div>

    <footer class="entry-footer">
        <?php //ort_site_2019_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
