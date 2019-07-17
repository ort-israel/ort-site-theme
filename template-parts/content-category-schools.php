<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ort-site-2019
 */

?>
<li id="cat-<?php echo $city->term_id; ?>" class="city-category-wrapper closed">
    <h2 class="city-category-title"><?php echo $city->name; ?></h2>
    <ul class="school-list">
		<?php

		// Each city has an array of post ids. loop through them and retrieve the posts and print their title and link
		foreach ( $city->post_ids as $post_id ) {
			?>

			<?php
			// assign the current post to the global $post, so the template can use the loop's functions
			$post = $catClass->getCurrentPostFromCategoryList( $post_id ); ?>

			<?php the_title( sprintf( '<li class="entry-title school-name"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></li>' ); ?>


		<?php } ?>
    </ul>
</li><!-- #post-<?php the_ID(); ?> -->



