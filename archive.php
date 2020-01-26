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

            <?php if (have_posts()) :
            $term = get_queried_object();
            $image = get_field('image', $term);
            ?>

            <header class="page-header splashed-header"
                <?php
                if ($image['url']): ?>
                    style='background-image:url(<?php echo $image['url']; ?>)'
                <?php endif; ?>
            >
                <div class="title-desc">
                    <?php
                    the_archive_title('<h1 class="page-title" tabindex="0">', '</h1>');
                    the_archive_description('<div class="archive-description" tabindex="0">', '</div>');
                    ?>
                </div>
            </header><!-- .page-header -->

            <div class="breadcrumbs" typeof="BreadcrumbList" tabindex="0">
                <?php
                if (function_exists('bcn_display')) {
                    bcn_display();
                } ?>
            </div>
            <div class="articles">
                <?php /* Start the Loop */
                while (have_posts()) :
                    the_post();

                    if (is_tag() || $term->name == 'cool_timeline') {
                        set_query_var('utils', $utils);
                        set_query_var('bool_value', false); //if false don't display post category
                        get_template_part('template-parts/content', 'category-horizontal');
                    }/*
                Tsofiya 7/1/20: We don't have style to another structure. May be correct creating content-base.php file
                else{

                        get_template_part('template-parts/content');
                    }*/

                endwhile;

                endif; ?>
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
the_posts_navigation();
get_sidebar();
get_footer();
