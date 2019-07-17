<?php
/**
 * Template part for displaying posts that are descendents of the schools and Colleges category
 *
 * @package ort-site-2019
 */

//$field_names = array( 'ort_schoolmaster_name', 'ort_school_phone', 'ort_school_site', 'ort_school_address', 'ort_school_email');
//
//foreach ( $field_names as $name ) {
//	$value = get_field( $name );
//	//var_dump( empty( $value ) );
//
//	if ( empty( $value ) ) {
//		global $post;
//		echo $name;
//		//<strong>מנהלת בית הספר: </strong>
//		switch ( $name ) {
//			case "ort_schoolmaster_name":
//				$full_regex   = '/מנהל.*/iu';
//				$prefix_regex = '/מנהל.*:/u';
////				$full_regex   = '/<strong>מנהל.*/iu';
////				$prefix_regex = '/<strong>מנהל.*<\/strong>/u';
//				break;
//			case "ort_school_phone":
//				$full_regex   = '/טלפון.*/iu';
//				$prefix_regex = '/טלפון.*:/u';
////				$full_regex   = '/<strong>טלפון.*/iu';
////				$prefix_regex = '/<strong>טלפון.*<\/strong>/u';
//				break;
//			case "ort_school_site":
//				/* when the text is a link */
//				$full_regex   = '/.*אתר.*/iu';
//				$prefix_regex = '/(<a href=")|(">.*)/i';
//				/* when the label isn't bold*/
////				$full_regex   = '/.*אתר.*:/iu';
////				$prefix_regex = '/.*אתר.*:/iuU';
//				/* when the label is bold*/
////				$full_regex   = '/<strong>.*אתר.*/iu';
////				$prefix_regex = '/<strong>.*אתר.*<\/strong>/u';
//				break;
//			case "ort_school_email":
//			    echo '777';
//				$full_regex   = '/.*ליצירת.*/iu';
//				$prefix_regex = '/(.*<a href="mailto:)|(">.*ליצירת.*)/u';
//				break;
//			case "ort_school_address":
//				$full_regex   = '/כתובת.*/iu';
//				$prefix_regex = '/כתובת.*:/u';
////				$full_regex   = '/<strong>כתובת.*/iu';
////				$prefix_regex = '/<strong>כתובת.*<\/strong>/u';
//				break;
//			default:
//				$full_regex   = '';
//				$prefix_regex = '';
//				break;
//		}
//		//echo $full_regex;
//		if ( ! empty( $full_regex ) ) {
//			$output = preg_match_all( $full_regex, $post->post_content, $matches );
//			if ( count( $matches ) > 0 && count( $matches[0] ) > 0 ) {
//				$full_field = $matches[0][0];
//
//				$field_value = preg_replace( $prefix_regex, '', strip_tags( $full_field, '<a>' ) );
//
//				update_field( $name, $field_value );
//
//				$post->post_content = str_replace( $full_field, '', $post->post_content );
//
//			}
//		}
//	}
//}
//
//
//$updated_post = array(
//	'ID'           => $post->ID,
//	'post_content' => $post->post_content,
//);
//$post_id      = wp_update_post( $updated_post, true );
//if ( is_wp_error( $post_id ) ) {
//
//	$errors = $post_id->get_error_messages();
//	foreach ( $errors as $error ) {
//		echo $error;
//	}
//}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
		<?php
		the_title( '<h1 class="entry-title">', '</h1>' );
		?>
    </header><!-- .entry-header -->

	<?php
	get_template_part( 'template-parts/content', 'school-custom-fields' ); ?>


    <div class="entry-content">
		<?php
		the_content( sprintf(
			wp_kses(
			/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'ort_site_2019' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );

		?>
    </div><!-- .entry-content -->
    <footer class="entry-school-majors">
		<?php
		global $post;
		$majors = $utils->get_the_posts_tags_per_group( [ $post ], 1 );
		if ( $majors ) {
			?>
            <h3><?php _e( 'School majors', 'ort_site_2019' ); ?> </h3>
            <ul class="school-majors-list">
				<?php foreach ( $majors as $major ) {
					?>
                    <li class="tag-id-<?php echo $major->term_id ?> school-major-item"><?php echo $major->name; ?></li>
				<?php } ?>
            </ul>
		<?php } ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
