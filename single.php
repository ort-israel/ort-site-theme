<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ort-site-2019
 */

get_header();

$categories = get_the_category();
?>
<!-- add class to arabs posts -->
    <div id="primary" class="content-area<?php if($categories && $categories[0]->term_id==314) echo "-arabs"; ?>">
        <main id="main" class="site-main">

			<?php
			while ( have_posts() ) :
				the_post();
			    if(in_category('experts')){

                    get_template_part( 'template-parts/content', 'experts' );
                }
				else if ( $utils->post_is_in_descendant_category( $utils->schools_and_colleges_cat_id ) ) {
					set_query_var( 'utils', $utils );
					get_template_part( 'template-parts/content', 'single-school' );

				} else{
                    set_query_var( 'utils', $utils );
					get_template_part( 'template-parts/content', get_post_format() );
				}

			endwhile; // End of the loop.
			?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
