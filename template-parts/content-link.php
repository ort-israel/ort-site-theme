<?php
/**
 * Created by PhpStorm.
 * User: mirik
 * Date: 13/02/2019
 * Time: 12:28
 */


/**
 * Template part for displaying link posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ort-site-2019
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php $post_category = get_the_category(); ?>

    <div class="entry-content">
		<?php $content_link = get_the_content(); ?>
        <a href="<?php echo $content_link ?>">

			<?php
			$thumbnail_size = isset( $thumbnail_size ) ? $thumbnail_size : 'medium'; // in case a $thumbnail_size hasn't been defined
			$utils->ort_site_2019_post_thumbnail_no_link( $thumbnail_size ); ?>
            <span class="excerpt"><?php the_title(); ?></span>
			<?php if ( $post_category && $post_category[0]->term_id == 25 ) { ?>
                <div class="post-date-author">
					<?php $correspondence_date = get_field( 'date' );
					$correspondence_author     = get_field( 'author' ); ?>
                    <time><?php echo $correspondence_date; ?>,</time>
					<?php echo $correspondence_author;
					?>
                </div>
			<?php } ?>
        </a>
    </div><!-- .entry-content -->
</div><!-- #post-<?php the_ID(); ?> -->

