<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ort-site-2019
 */

?>

<section class="no-results not-found">
    <header class="page-header splashed-header">
        <div class="title-desc">
            <h1 class="page-title">
                <?php
                /* translators: %s: search query. */
                printf( esc_html__( 'Search Results for:%s', 'ort_site_2019' ), '<div>' . get_search_query() . '</div>' );
                ?>
            </h1>
        </div>
    </header><!-- .page-header -->

    <div class="page-secondary-header">
		<h2 class="page-title"><?php esc_html_e( 'Nothing Found', 'ort_site_2019' ); ?></h2>
	</div><!-- .page-header -->

	<div class="page-content">

        <p><?php esc_html_e( 'Please try again with some different keywords.', 'ort_site_2019' ); ?></p>

        <?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'ort_site_2019' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_search() ) :
            wp_nav_menu( array(
                'theme_location' => 'no-results-link',
                'container'      => 'div',
                'container_class'=> 'no-results-link'
            ) );
			?>

			<?php
			//get_search_form();

		else :
			?>

			<p><?php //esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'ort_site_2019' ); ?></p>
			<?php
			//get_search_form();

		endif;
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
