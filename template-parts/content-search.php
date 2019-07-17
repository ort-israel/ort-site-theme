<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ort-site-2019
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class();?>

<?php $post_id=get_the_ID();
      $post_link=get_post_permalink($post_id);
      $categories = get_the_category($post_id);
/*to check if its post of category and not elementor page*/
      if($categories && !(is_page())) {
          $cat_id = $categories[0]->term_id;
          $parent_category = $utils->get_category_top_parent_id($cat_id);
      }
      ?>
<header class="entry-header">

    <a href="<?php echo $post_link ?>">
    <?php
             if(has_post_thumbnail()){ ?>
                 <div class="image-post"> <?php  $utils->ort_site_2019_post_thumbnail_no_link(); ?></div>
           <?php  }
             else { ?>
                <div class="post-thumbnail">
                    <div class="image-post">   <img class="attachment-post-thumbnail" src="<?php echo get_template_directory_uri()."/images/search-defult.png";?>"> </div>
                </div>

            <?php }

  if($categories) { ?>
        <?php   /* display the date in correspondence posts */
        $cat_id = $categories[0]->term_id;
        $parent_category = $utils->get_category_top_parent_id($cat_id);
        if($parent_category=='correspondence') {
        $postdate = '<div class="post-date">';
        $postdate .= '<span class="post-date-day">';
        $postdate .= get_the_date('j');
        $postdate .= '</span>';
        $postdate .= '<span class="post-date-month">';
        $postdate .= get_the_date('F');
        $postdate .= '</span>';
        $postdate .= '</div>';
        echo $postdate; ?>
        <?php } } ?>

   <?php  if($categories) { ?>
    <span class="category-name">
       <?php echo $categories[0]->name; ?>
    </span>
    <?php  } ?>

</header><!-- .entry-header -->

<div class="entry-summary">
        <h2 class="entry-title"> <?php the_title(); ?> </h2>
        <div class="post-exc">
        <?php echo get_cont_exc();  ?>
        </div>


</div><!-- .entry-summary -->
</a>

</article><!-- #post-<?php the_ID(); ?> -->
