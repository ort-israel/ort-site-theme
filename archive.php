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

            <?php if ( have_posts() ) : ?>

                <?php $bool_value=0;
                $term = get_queried_object();

                $image = get_field('image', $term);
                /*we have 2 presentation of category page, horizontal and vertical */
                $cat_kind = get_field('kind-of-category',$term);
                $slug="";
                /*א to display in catvot category something like search*/
                $category_id=get_the_category();
                $category_parent_id = $category_id[0]->category_parent;
                if ( $category_parent_id != 0 ){
                    $category_parent = get_term( $category_parent_id, 'category' );
                    $term= $category_parent;
                    $term_child=get_queried_object();
                    $slug = $category_parent->slug;
                }
                ?>
                <header class="page-header splashed-header" style='background-image:url(<?php echo $image['url']; ?>)'>
                    <div class="title-desc">
                        <?php
                        the_archive_title( '<h1 class="page-title" tabindex="0">', '</h1>' );
                        the_archive_description( '<div class="archive-description" tabindex="0">', '</div>' );
                        ?>
                    </div>
                </header><!-- .page-header -->

                <div class="breadcrumbs" typeof="BreadcrumbList" tabindex="0">
                    <?php
                    if(function_exists('bcn_display'))
                    {
                        bcn_display();
                    }?>
                </div>
                <?php
                /*not display the list of categories in news category page */
                $classes = get_body_class();
                if (!(in_array('news',$classes))){
                /*display the list of categories children of correspondence category, like a search*/
                if(($term->slug == 'correspondence' || $slug == 'correspondence') && (!is_tag()) && (!($term->slug == 'news'))){
                    $utils->list_categories($term,$term_child);
                } } ?>
       <div class="articles">
              <?php  /* Start the Loop */
                while ( have_posts() ) :
                    the_post();

                    if ($cat_kind && in_array('category-horizontal', $cat_kind) || $term->slug == 'correspondence' || is_tag()){
                        /*when we have posts from many categoreis,we want to know the father of specific post
                          sach as 'hadashot' category*/
                        if($utils->check_cat_children() ){
                            $bool_value=1;
                            $utils->post_category_name();}

                        set_query_var('bool_value', $bool_value);
                        set_query_var( 'utils', $utils );
                        get_template_part( 'template-parts/content','category-horizontal' );}

                    elseif ($cat_kind && in_array('category-vertical', $cat_kind) ){

                        if($utils->check_cat_children() ){
                            $bool_value=1;
                            $utils->post_category_name(); }

                        set_query_var('bool_value', $bool_value);
                        set_query_var( 'utils', $utils );
                        get_template_part( 'template-parts/content','category-vertical' );}

                    else{
                        /*to newsletter + publications category*/
                        set_query_var( 'utils', $utils );
                        get_template_part( 'template-parts/content', 'link' );}

                endwhile;

            else :

                get_template_part( 'template-parts/content', 'none' );

            endif;?>
       </div>
            <!--special added to oraa and lemida category-->
            <?php if (is_category('high-quality-teaching')){?>

                <section class="special-educators">

                    <?php echo do_shortcode('[special_educators]'); ?>

                    <span class="more-people-education"><a href="<?php echo get_category_link(30); ?>"> <?php  printf(esc_html__('read more people education  ','ort_site_2019') );?></a> </span>

                </section>

                <button class="join-us" onclick="window.location.href='https://mapa-linux-test.ort.org.il/ort-site-2019/jobs/'"><?php _e('join to us','ort_site_2019')?></button>
            <?php  } ?>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
the_posts_navigation();
get_sidebar();
get_footer();
