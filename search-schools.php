<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package ort-site-2019
 */

get_header();
?>

    <section id="primary" class="content-area">
        <main id="main" class="site-main">

			<?php if ( have_posts() ) : ?>

                <header class="page-header">
                    <h1 class="page-title">
						<?php
						/* translators: %s: search query. */
						printf( esc_html__( 'Search Results for: %s', 'ort_site_2019' ), '<span>' . get_search_query() . '</span>' );
						?>
                    </h1>

                    <nav class="schools-navigation">
                        <div class="school-search-form">
							<?php echo do_shortcode( '[ivory-search id="28625" title="Schools Search Form"]' ); ?>
                        </div>
						<?php
						global $posts;
						/* Display מגמות tags */
						$posts_tags = $utils->get_the_posts_tags_per_group( $posts, 1 );
						$utils->display_select_element_of_tags( $posts_tags, __( 'School majors', 'ort_site_2019' ) );
						?>


						<?php
						/* Display שכבת גיל tags */
						$posts_tags = $utils->get_the_posts_tags_per_group( $posts, 2 );
						$utils->display_select_element_of_tags( $posts_tags, __( 'Age groups', 'ort_site_2019' ) ); ?>
                    </nav>
                </header><!-- .page-header -->

				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					set_query_var( 'utils', $utils );
					get_template_part( 'template-parts/content', 'search-schools' );

				endwhile;

				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>

        </main><!-- #main -->
    </section><!-- #primary -->

<?php
get_sidebar();
get_footer();
