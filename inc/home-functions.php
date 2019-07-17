<?php
/**
 * Created by PhpStorm.
 * User: mirik
 * Date: 26/12/2018
 * Time: 14:08
 */
function excerpt( $limit ) {
	$excerpt = explode( ' ', get_the_excerpt(), $limit );
	if ( count( $excerpt ) >= $limit ) {
		array_pop( $excerpt );
		$excerpt = implode( " ", $excerpt ) . '...';
	} else {
		$excerpt = implode( " ", $excerpt );
	}
	$excerpt = preg_replace( '`[[^]]*]`', '', $excerpt );

	return $excerpt;
}

function content( $limit ) {
	$content = explode( ' ', get_the_content(), $limit );
	if ( count( $content ) >= $limit ) {
		array_pop( $content );
		$content = implode( " ", $content ) . '...';
	} else {
		$content = implode( " ", $content );
	}
	$content = preg_replace( '/[.+]/', '', $content );
	$content = apply_filters( 'the_content', $content );
	$content = str_replace( ']]>', ']]&gt;', $content );

	return $content;
}

function get_cont_exc() {
	$classes = get_body_class();
	if ( is_category() ) {
		if ( has_excerpt() ) {
			$text = excerpt( 50 );

			return strip_tags( $text, '<p>' );
		} /*else {
            $text = content(50);
            return strip_tags($text, '<p>');
        }*/
	} elseif ( in_array( 'elementor-default', $classes ) ) {
		if ( has_excerpt() ) {
			$text = excerpt( 15 );

			return strip_tags( $text, '<p>' );
		} else {

		}
	} else {
		if ( has_excerpt() ) {
			$text = excerpt( 15 );

			return strip_tags( $text, '<p>' );
		} else {
			$text = content( 15 );

			return strip_tags( $text, '<p>' );
		}
	}
}

/* this function called in page+posts, In accordance with Site Characterization,
display only excerpt and not!! part of content */
function get_only_exc() {
	if ( has_excerpt() ) {
		$text = excerpt( 30 );

		return strip_tags( $text, '<p>' );
	}
}


/* this function display details according to the parameters which transfered */
function mop_get_posts( $postdate = true, $postnail = true, $catname = true, $postname = true, $getexc = true, $categories ) {

	echo '<li>';

	echo '<a href=' . get_permalink() . '>';
	echo '<div class="post-text-img">';
    if ( $postnail ) {
        $postnail = get_the_post_thumbnail( '', 'full' );
        echo '<div class="container">';
        echo $postnail;
        echo '</div>';
    }

	if ( $postdate ) {
		$postdate = '<div class="post-date">';
		$postdate .= '<span class="post-date-day">';
		$postdate .= get_the_date( 'j' );
		$postdate .= '</span>';
		$postdate .= '<span class="post-date-month">';
		$postdate .= get_the_date( 'F' );
		$postdate .= '</span>';
		$postdate .= '</div>';
		echo $postdate;
	}

	if ( $catname ) {
		$catname = '<span class="category-name">' . esc_html( $categories[0]->name ) . '</span>';
		echo $catname;
	}
	if ( $postname ) {
		$post_title = get_the_title();
		$postname   = '<h3 class="post-name">' . $post_title . '</h3>';
		echo $postname;
	}
	if ( $getexc ) {
		$exc = get_cont_exc();
		echo '<div class="post-exc">' . $exc . '</div>';
	}

	echo '</div>';
	echo '</a>';

	echo '</li>';
}

/* 2 functions below display the custom-field "nickname" if we have two names to category*/
function get_secondary_title( $cat_query ) {
	$term         = $cat_query->get_queried_object();
	$cat_sec_name = get_field( 'nickname', $term );

	return $cat_sec_name;
}

function print_titles_section( $cat_query, $cat_id ) {
	echo '<h2>' . get_secondary_title( $cat_query ) . '</h2>';
	echo '<h3>' . category_description( $cat_id ) . '</h3>';
}

function israeli_pride_zone() {
	echo '<section class="isreal-pride">';

	$idObj     = get_category_by_slug( 'israeli-pride' );
	$cat_pride = $idObj->term_id;
	$cat_query = new WP_Query( 'cat=' . $cat_pride . '&posts_per_page=7' );
	print_titles_section( $cat_query, $cat_pride );

	echo '<ul class="important-posts">';
	while ( $cat_query->have_posts() ) : $cat_query->the_post();
		mop_get_posts( $postdate = false, $postnail = true, $catname = false, $postname = true, $getexc = false, '' );
	endwhile;
	echo '</ul>';

	echo '</section>';
}

add_shortcode( 'israeli_pride', 'israeli_pride_zone' );

function correspondence_zone( $atts ) {
	$short_code_array  = shortcode_atts( array(
		'number-of-posts' => 'number',
	), $atts );
	$id_correspondence = get_category_by_slug( 'correspondence' );
	$cat_id            = $id_correspondence->term_id;
	$cat_query         = new WP_Query( 'cat=' . $cat_id . '&posts_per_page=' . $atts['number-of-posts'] );

	if ( is_home() ) {
		print_titles_section( $cat_query, $cat_id );
		/*called to this button here b/s a problem with css*/
		echo '<span class="more-publications">';
		echo '<a href=' . get_category_link( 23 ) . '>' . __( 'read more publications ', 'ort_site_2019' ) . '</a>';
		echo '</span>';
	}

	echo '<div class="articles">';

	echo '<ul class="important-posts" aria-label="' . __( 'more-articles', 'ort_site_2019' ) . '">';
	while ( $cat_query->have_posts() ) : $cat_query->the_post();
		$post       = get_post();
		$categories = get_the_category( $post->ID );
		if ( is_page() ) {
			mop_get_posts( $postdate = true, $postnail = true, $catname = true, $postname = true, $getexc = true, $categories );
		} else {
			mop_get_posts( $postdate = true, $postnail = true, $catname = true, $postname = true, $getexc = false, $categories );
		}
	endwhile;
	echo '</ul>';

	echo '</div>';
}

add_shortcode( 'correspondence', 'correspondence_zone' );

function publications_zone() {
	global $utils;
	$idObj           = get_category_by_slug( 'publications' );
	$id_publications = $idObj->term_id;
	$cat_query       = new WP_Query( 'cat=' . $id_publications . '&posts_per_page=3' );

	echo '<div class="publications">';
	echo '<ul class="important-posts">';
	while ( $cat_query->have_posts() ) : $cat_query->the_post();
		set_query_var( 'utils', $utils );
		get_template_part( 'template-parts/content', 'link' );
	endwhile;
	echo '</ul>';
	echo '</div>';
}

add_shortcode( 'publications', 'publications_zone' );

function newsletter_zone() {
	global $utils;
	$idObj         = get_category_by_slug( 'newsletter' );
	$id_newsletter = $idObj->term_id;
	$cat_children  = get_categories( array( 'child_of' => $id_newsletter ) );

	echo '<div class="newsletter">';

	echo '<ul class="important-posts">';
	foreach ( $cat_children as $children ) {
		$args      = array(
			'posts_per_page' => 4,
			'category__in'   => array( $children->term_id )
		);
		$cat_query = new WP_Query( $args );
		while ( $cat_query->have_posts() ) : $cat_query->the_post();
			set_query_var( 'utils', $utils );
			get_template_part( 'template-parts/content', 'link' );
		endwhile;
	}

	echo '</ul>';
	echo '</div>';
}

add_shortcode( 'newsletter', 'newsletter_zone' );

function special_educators_zone() {
	$idObj        = get_category_by_slug( 'people-education' );
	$id_education = $idObj->term_id;
	$cat_query    = new WP_Query( 'cat=' . $id_education . '&posts_per_page=3' );
	print_titles_section( $cat_query, $id_education );
	if ( is_home() ) {
		echo '<span class="more-people-education">';
		echo '<a href=' . get_category_link( $id_education ) . '>' . esc_html__( 'read more people education  ', 'ort_site_2019' ) . '</a>';
		echo '</span>';
	}

	echo '<ul class="important-posts" aria-label="' . __( 'more people educator', 'ort_site_2019' ) . '">';
	while ( $cat_query->have_posts() ) : $cat_query->the_post();
		//mop_get_posts( $postdate = false, $postnail = true, $catname = false, $postname = false, $getexc = false, '' );
        echo '<li>';
        echo '<a href=' . get_permalink() . '>';
        $postnail = get_the_post_thumbnail( '', 'full' );
        echo '<div class="container">';
        echo $postnail;
        echo '</div>';
        echo '<div class="details-educators">';
        $post_title = get_the_title();
        echo '<h3 class="post-name">' . $post_title . '</h3>';
        $exc = get_cont_exc();
        echo '<div class="post-exc">' . $exc . '</div>';
        echo '</div>';
        echo '</a>';
        echo '</li>';
	endwhile;
	echo '</ul>';
}

add_shortcode( 'special_educators', 'special_educators_zone' );


function winning_zone( $atts ) {
    $short_code_array  = shortcode_atts( array(
        'number-of-posts' => 'number',
    ), $atts );
    $tag_query         = new WP_Query( 'tag=' . "winnings" . '&posts_per_page=' . $atts['number-of-posts'] );

    echo '<div class="articles">';

    echo '<ul class="important-posts" aria-label="' . __( 'more-articles', 'ort_site_2019' ) . '">';
    while ( $tag_query->have_posts() ) : $tag_query->the_post();
        $categories = "";
            mop_get_posts( $postdate = true, $postnail = true, $catname = false, $postname = true, $getexc = true, $categories );
    endwhile;
    echo '</ul>';

    echo '</div>';
}

add_shortcode( 'winning', 'winning_zone' );

add_filter( 'gettext', 'ort_site_2019_change_more_posts_text', 20, 3 );
/**
 * Change comment form default field names.
 *
 * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/gettext
 */
function ort_site_2019_change_more_posts_text( $translated_text, $text, $domain ) {
	switch ( $text ) {

		case 'Older posts' :

			$translated_text = __( 'Older posts in ORT', 'ort_site_2019' );
			break;

		case 'Newer posts' :

			$translated_text = __( 'Newer posts in ORT', 'ort_site_2019' );
			break;
	}


	return $translated_text;
}


function arabs_zone( $atts ) {
    $short_code_array  = shortcode_atts( array(
        'number-of-posts' => 'number',
    ), $atts );
    $cat_id            = '314';
    $cat_query         = new WP_Query( 'cat=' . $cat_id . '&posts_per_page=' . $atts['number-of-posts'] );

        print_titles_section( $cat_query, $cat_id );
        /*called to this button here b/s a problem with css*/

    echo '<div class="articles">';

    echo '<ul class="important-posts" aria-label="' . __( 'more-articles', 'ort_site_2019' ) . '">';
    while ( $cat_query->have_posts() ) : $cat_query->the_post();
        $post       = get_post();
        $categories = get_the_category( $post->ID );
        if ( is_page() ) {
            mop_get_posts( $postdate = true, $postnail = true, $catname = true, $postname = true, $getexc = true, $categories );
        } else {
            mop_get_posts( $postdate = true, $postnail = true, $catname = true, $postname = true, $getexc = false, $categories );
        }
    endwhile;
    echo '</ul>';

    echo '</div>';
}

add_shortcode( 'arabs', 'arabs_zone');
