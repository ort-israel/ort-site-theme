<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ort-site-2019
 */

?>
<?php $post_url=get_post_permalink(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <a href="<?php echo $post_url; ?>" >

        <div class="image-post <?php if( $categories[0]->slug == 'publications') echo 'publications'; ?>">
            <?php $utils->ort_site_2019_post_thumbnail_no_link(); ?>
        </div>

    <?php $categories = get_the_category();?>
    <?php
    $postdate = '<div class="post-date">';
    $postdate .= '<span class="post-date-day">';
    $postdate .= get_the_date('j');
    $postdate .= '</span>';
    $postdate .= '<span class="post-date-month">';
    $postdate .= get_the_date('F');
    $postdate .= '</span>';
    $postdate .= '</div>';
    echo $postdate;
    ?>


   <!-- publications's class added because css to design img posts that belongs to publications category  -->

    <?php if($bool_value==1){ ?>
        <span class="category-name"> <?php echo $name_category;?> </span> <?php } ?>

    <header class="entry-header">
        <?php
            the_title( '<h2 class="entry-title">', '</h2>' ); ?>

    </header><!-- .entry-header -->
	
        <div class="entry-content">
            <?php echo get_cont_exc() ?>
        </div>
	
    </a>
</article><!-- #post-<?php the_ID(); ?> -->
