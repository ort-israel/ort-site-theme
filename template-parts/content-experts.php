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

    <header class="entry-header">
        <div class="startup-eduction"></div>

        </div>
        <?php
        if ( is_singular() ) :
            the_title( '<h1 class="entry-title">', '</h1>' );
        else :
            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        endif;?>

    </header><!-- .entry-header -->

    <?php ort_site_2019_post_thumbnail(); ?>

    <div class="entry-content">

 <?php
  $telephone=get_field('tel');
  $email=get_field('mail');?>
  <div class="desc-expert"><?php the_excerpt() ?></div>
  <div class="expert-tel"><?php echo $telephone; ?></div>
  <div class="expert-mail"><?php echo $email; ?></div>

    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php //ort_site_2019_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
