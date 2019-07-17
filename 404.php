<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package ort-site-2019
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="error-404 not-found">
				<header class="page-header splashed-header">
                    <div class="title-desc">
                        <h1 class="page-title"><?php esc_html_e( '404', 'ort_site_2019' ); ?></h1>
                    </div>

				</header><!-- .page-header -->

                <div class="page-secondary-header">
                    <p class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'ort_site_2019' ); ?></p>
                </div><!-- .page-header -->

                <div class="page-content">
					<h2><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'ort_site_2019' ); ?></h2>

					<?php
					get_search_form();

					//the_widget( 'WP_Widget_Recent_Posts' );
					?>

					<div class="widget widget_categories">
						<h2 class="widget-title"><?php //esc_html_e( 'Most Used Categories', 'ort_site_2019' ); ?></h2>
						<ul>
							<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => '',
								'title_li'   => '',
								'number'     => 10,
							) );
							?>
						</ul>
					</div><!-- .widget -->

					<?php
					/* translators: %1$s: smiley */
					//$ort_site_2019_archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'ort_site_2019' ), convert_smilies( ':)' ) ) . '</p>';
					//the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$ort_site_2019_archive_content" );

					//the_widget( 'WP_Widget_Tag_Cloud' );
					?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
