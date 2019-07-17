<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ort-site-2019
 */

get_header();
?>

 <section class="main-image">

     <?php echo do_shortcode('[elementor-template id="281"]'); ?>
     <div class="startup-edu-logo"></div>
     <?php echo file_get_contents(get_template_directory_uri()."/images/splash.svg"); ?>

 </section>

 <section class="banner">

     <?php  echo do_shortcode('[elementor-template id="289"]'); ?>

 </section>

 <section class="values-educational">

     <?php echo do_shortcode('[wcp-carousel id="29735"]');?>

 </section>

 <section class="publications-zone">
    <div class="wrapper">
         <?php echo do_shortcode('[correspondence number-of-posts="6"]'); ?>

         <?php echo do_shortcode('[publications]'); ?>
     </div>
 </section>

<?php echo do_shortcode('[israeli_pride]'); ?>

 <section class="special-educators">

     <?php echo do_shortcode('[special_educators]'); ?>

 </section>

<section class="find-ort">

    <?php echo do_shortcode('[elementor-template id="23129"]'); ?>

</section>

<?php

get_footer();
