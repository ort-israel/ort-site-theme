<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ort-site-2019
 */

get_header();
?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">

			<?php if ( have_posts() ) :

			$bool_value = 0;
			/*$term = get_queried_object();*/
			$current_category = get_queried_object();

			$image = get_field( 'image', $current_category );
			/*we have 2 presentation of category page, horizontal and vertical */
			$cat_kind = get_field( 'kind-of-category', $current_category );
			$slug     = "";
			$term     = 0;
			/*א to display in catvot category something like search*/
			$category_id = get_the_category();

			if ( $category_id ) {
				$category_parent_id = $category_id[0]->category_parent;
				if ( $category_id[0]->category_parent != 0 ) {
					$category_parent = get_term( $category_parent_id, 'category' );
					$term            = $category_parent;
					$term_child      = get_queried_object();
					$slug            = $category_parent->slug;
				}
			}

			?>
            <header class="page-header splashed-header"
				<?php //only for categories with image
				if ( $image['url'] ): ?>
                    style='background-image:url(<?php echo $image['url']; ?>)'
				<?php endif; ?>
            >
                <div class="title-desc">
					<?php
					the_archive_title( '<h1 class="page-title" tabindex="0">', '</h1>' );
					the_archive_description( '<div class="archive-description" tabindex="0">', '</div>' );
					?>
                </div>
            </header><!-- .page-header -->

            <div class="breadcrumbs" typeof="BreadcrumbList" tabindex="0">
				<?php
				if ( function_exists( 'bcn_display' ) ) {
					bcn_display();
				} ?>
            </div>
		<?php
		/*display the list of categories children of correspondence category, like a search*/
		if ( ( ( ! empty( $term ) && $term->slug === 'correspondence' ) || $slug === 'correspondence' ) && ( ! is_tag() ) && ( ! empty( $term ) && $term->slug !== 'news' ) ) {
			$utils->list_categories( $term, $term_child, __( 'all subjects', 'ort_site_2019' ) );
		} // Tsofiya: Display sub-categories for News.
        elseif ( $current_category->slug === 'news' ) {
			$utils->list_categories( $current_category, $current_category, __( 'all subjects', 'ort_site_2019' ) );
		} // Tsofiya: Display sub-categories for videort and newsletter.
        elseif ( ( ( ! empty( $term ) && $term->slug === 'videort' ) || $slug === 'videort' ) ||
		         ( ( ! empty( $term ) && $term->slug === 'newsletter' ) || $slug === 'newsletter' ) ) {
			$utils->list_categories( $term, $term_child, __( 'all years', 'ort_site_2019' ), 'DESC' );
		}
		?>
            <div class="articles">
				<?php /* Start the Loop */
				while ( have_posts() ) :
					the_post();

					if ( ( $cat_kind && in_array( 'category-horizontal', $cat_kind ) ) ||
					     ( ! empty( $term ) && property_exists( $term, 'slug' ) && $term->slug === 'correspondence' ) ||
					     is_tag() ||
					     ( ! empty( $term ) && $term->name === 'cool_timeline' ) ) {
						/*when we have posts from many categoreis,we want to know the father of specific post
						  sach as 'hadashot' category*/
						if ( $utils->check_cat_children() ) {
							$bool_value = 1;
							$utils->post_category_name();
						}

						set_query_var( 'bool_value', $bool_value );
						set_query_var( 'utils', $utils );
						get_template_part( 'template-parts/content', 'category-horizontal' );
					} elseif ( $cat_kind && in_array( 'category-vertical', $cat_kind ) ) {

						if ( $utils->check_cat_children() ) {
							$bool_value = 1;
							$utils->post_category_name();
						}

						set_query_var( 'bool_value', $bool_value );
						set_query_var( 'utils', $utils );
						get_template_part( 'template-parts/content', 'category-vertical' );

					} else {
						/* to newsletter, videort and publications categories */
						set_query_var( 'utils', $utils );
						$thumbnail_size = $slug === 'newsletter' ? 'rectangle_narrow' : 'rectangle_wide';
						set_query_var( 'thumbnail_size', $thumbnail_size );
						get_template_part( 'template-parts/content', 'link' );

					}
					// Tsofiya 7/1/20: We don't have style to another structure. May be correct creating content-base.php file
					/*else{
						set_query_var('utils', $utils);
							get_template_part('template-parts/content');
						}*/

				endwhile;

				endif; ?>
            </div>
            <!--special added to oraa and lemida category-->
			<?php if ( is_category( 'high-quality-teaching' ) ) { ?>

                <section class="special-educators">

					<?php echo do_shortcode( '[special_educators]' ); ?>

                    <span class="more-people-education"><a
                                href="<?php echo get_category_link( 30 ); ?>"> <?php printf( esc_html__( 'read more people education  ', 'ort_site_2019' ) ); ?></a> </span>

                </section>

				<?php $href = get_bloginfo( 'url' ); ?>
                <button class="join-us"
                        onclick="window.location.href='<?php echo $href ?>/jobs/'"><?php _e( 'join to us', 'ort_site_2019' ) ?></button>
			<?php } ?>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
the_posts_navigation();
get_sidebar();
get_footer();
