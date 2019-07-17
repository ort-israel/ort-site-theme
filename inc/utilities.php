<?php

namespace ortsite2019;


class utilities {

	public $schools_and_colleges_cat_id = 0;

	public function init() {
		$this->init_variables();
		$this->hook_into_wordpress();
	}

	private function init_variables() {
		if ( term_exists( 'schools-and-colleges', 'category' ) ) {
			$this->schools_and_colleges_cat_id = get_category_by_slug( 'schools-and-colleges' )->term_id;
		}
	}

	private function hook_into_wordpress() {
		add_action( 'pre_get_posts', [ $this, 'pre_get_posts' ] );
		add_filter( 'use_block_editor_for_post', '__return_false', 10 );
		add_filter( 'use_block_editor_for_post_type', '__return_false', 10 );
		add_action( 'template_include', [ $this, 'school_search_tamplate' ] );
		add_action( 'init', [ $this, 'add_excerpt_support_for_pages' ] );
		add_filter( 'acf/fields/google_map/api', [ $this, 'acf_google_map_api' ] );
	}

	public function add_excerpt_support_for_pages() {
		add_post_type_support( 'page', 'excerpt' );
	}

	/*-- this function check if category has children --*/
	public function check_cat_children() {
		global $wpdb;
		$term  = get_queried_object();
		$check = $wpdb->get_results( " SELECT * FROM wp_term_taxonomy WHERE parent = '$term->term_id' " );
		if ( $check ) {
			return true;
		} else {
			return false;
		}
	}

	public function pre_get_posts( $query ) {
		if ( ! is_admin() && $query->is_main_query() ) {

			/*** Schools list ***/
			if ( term_exists( $this->schools_and_colleges_cat_id, 'category' ) && $query->is_category( $this->schools_and_colleges_cat_id ) ) {
				$query->set( 'posts_per_page', - 1 );
			}

			if ( is_search() ) {

				//  echo get_query_var('s');
			}
		}
	}

	/* Tests if any of a post's assigned categories are descendants of target categories
		*
		* @param int|array $cats The target categories. Integer ID or array of integer IDs
		* @param int|object $_post The post. Omit to test the current post in the Loop or main query
		* @return bool True if at least 1 of the post's categories is a descendant of any of the target categories
		* @see get_term_by() You can get a category by name or slug, then pass ID to this function
		* @uses get_term_children() Passes $cats
		* @uses in_category() Passes $_post (can be empty)
		* @version 2.7
		* @link http://codex.wordpress.org/Function_Reference/in_category#Testing_if_a_post_is_in_a_descendant_category
		*/
	function post_is_in_descendant_category( $cats, $_post = null ) {
		foreach ( (array) $cats as $cat ) {
			// get_term_children() accepts integer ID only
			$descendants = get_term_children( (int) $cat, 'category' );
			if ( $descendants && in_category( $descendants, $_post ) ) {
				return true;
			}
		}

		return false;
	}


	/**
	 * Displays the given field in the given tag. Shows a Fontawsome icon if requested, and shows the field name if requested
	 *
	 * @param $fieldname - Name of custom field (gotten from the admin of the custom fields)
	 * @param $tag - HTML tag to put the field in
	 * @param string $fontawsome_class - Fontawsome classes for desired icon
	 * @param string $addtional_classes - Additional classes applied to the tag
	 * @param bool $show_field_name - Whether to display the field name. Default is false
	 */
	public function display_advanced_custom_field( $fieldname, $tag, $fontawsome_class = '', $addtional_classes = '', $show_field_name = false ) {
		$field = get_field( $fieldname );
		if ( $field ) {
			switch ( $tag ) {
				case "img":
					$classes = 'schoolmaster-picture ' . $addtional_classes;
					if ( $field['sizes']['thumbnail'] ) {
						?>
                        <img src="<?php echo $field['sizes']['thumbnail'] ?>"
                             class="<?php echo $classes ?>"
                             alt="<?php _e( 'Schoolmaster picture', 'ort_site_2019' ) ?>">
						<?php
					}
					break;
				case "span":
					$classes = str_replace( 'ort-', '', str_replace( '_', '-', $fieldname ) ) . ' ' . $addtional_classes
					?>
                    <span class="<?php echo $classes; ?> ">
                        <?php if ( $fontawsome_class ) { ?>
                            <i class="fas <?php echo $fontawsome_class ?>"></i>
                        <?php } ?>
						<?php if ( $show_field_name ) {
							$field_obj = get_field_object( $fieldname ) ?>
                            <span class="field-name"><?php echo $field_obj["label"]; ?></span>
						<?php } ?>
						<span class="field-value"><?php echo $field; ?></span>
                    </span>
					<?php
					break;
				case "a":
					$classes = str_replace( 'ort-', '', str_replace( '_', '-', $fieldname ) ) . ' ' . $addtional_classes ?>
                    <a href="<?php echo $field ?>" title="<?php _e( 'facebook', 'ort_site_2019' ) ?>"
                       class="<?php echo $classes ?>">
                        <i class="fab <?php echo $fontawsome_class ?>" aria-hidden="true">
                            <span class="screen-reader-text"><?php _e( 'facebook', 'ort_site_2019' ) ?> </span></i></a>
					<?php
					break;
				default:
					echo $field;
					break;
			}

			?>

		<?php }
	}

	/**
	 * Load special template file for school search
	 * https://wordpress.stackexchange.com/questions/144043/use-created-page-as-search-results-page-and-custom-template
	 *
	 * @param $template
	 *
	 * @return string
	 */
	function school_search_tamplate( $template ) {
		if ( is_search() && get_query_var( 'id' ) > 0 ) {
			$t = locate_template( 'search-schools.php', false );
			if ( ! empty( $t ) ) {
				$template = $t;
			}
		}

		return $template;
	}

	/**
	 * Get all tags in Tag group, in given post
	 *
	 * @param int $group - Tag Group ID
	 * @param string $separator - how to separate the tags
	 *
	 * @return array
	 */
	public function get_post_group_tags_names( $group = 1 ) {
		$ret      = array();
		$posttags = wp_get_post_tags( get_the_ID() );
		foreach ( $posttags as $tag ) {
			if ( $group == $tag->term_group ) {
				$ret[] = $tag->name;
			}
		}

		return $ret;
	}

	/**
	 * @param $posts
	 * @param $group_id
	 *
	 * @return array
	 */
	public function get_the_posts_tags_per_group( $posts, $group_id ) {
		$post_ids   = wp_list_pluck( $posts, 'ID' );
		$posts_tags = array();

		if ( is_array( $post_ids ) ) {
			foreach ( $post_ids as $post_id ) {
				// get each post's tags
				$curr_post_tags = get_the_tags( $post_id );
				if ( $curr_post_tags ) {
					// check if tags belong to group
					foreach ( $curr_post_tags as $curr_post_tag ) {
						if ( $group_id == $curr_post_tag->term_group ) {
							// check if tag already exists
							$found = array_filter( $posts_tags, function ( $uniqueObject ) use ( $curr_post_tag ) {
								return $uniqueObject->term_id == $curr_post_tag->term_id;
							} );
							if ( ! $found ) {
								$posts_tags[]                                         = $curr_post_tag;
								$posts_tags[ count( $posts_tags ) - 1 ]->{"post_ids"} = array( $post_id );
							} else {
								// add post id
								$arr_length = count( $posts_tags );
								for ( $i = 0; $i < $arr_length; $i ++ ) {
									if ( $posts_tags[ $i ]->term_id == $curr_post_tag->term_id ) {
										$posts_tags[ $i ]->post_ids[] = $post_id;
									}
								}
							}
						}
					}

				}
			}
		}

		return $posts_tags;
	}

	public function display_select_element_of_tags( $posts_tags, $first_item_text = '' ) {
		if ( $posts_tags ) {
			// first dort them alphabetically:
			usort( $posts_tags, function ( $a, $b ) {
				return strcmp( $a->name, $b->name );
			} ); ?>
            <select>
				<?php
				if ( ! empty( $first_item_text ) ) {
					?>
                    <option id="0"><?php echo $first_item_text ?></option>
				<?php }
				foreach ( $posts_tags as $tag ) {
					?>
                    <option id="<?php echo 'tag-id-' . $tag->term_id; ?>"
                            value="<?php echo implode( $tag->post_ids, ',' ) ?>"><?php echo $tag->name ?></option>
				<?php } ?>
            </select>
		<?php }
	}

	public function acf_google_map_api( $api ) {
		$api['key'] = 'AIzaSyCItRidIyX9iIakOyQvbQ7fys-d-gdI_YI';

		return $api;
	}

	/* this function was written b/s of accessibility*/
	public function ort_site_2019_post_thumbnail_no_link() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}
		if ( is_singular() ) :?>

            <div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
            </div><!-- .post-thumbnail -->

		<?php else : ?>

            <div class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
				the_post_thumbnail( 'post-thumbnail', array(
					'alt' => the_title_attribute( array(
						'echo' => false,
					) ),
				) ); ?>

            </div>

		<?php
		endif; // End is_singular().
	}

	public function get_category_top_parent_id( $cat_id ) {
		$count = 0;
		while ( $cat_id && ! ( $count == 2 ) ) {

			$cat    = get_category( $cat_id ); // get the object for the catid
			$cat_id = $cat->category_parent; // assign parent ID (if exists) to $catid
			// the while loop will continue whilst there is a $catid
			// when there is no longer a parent $catid will be NULL so we can assign our $catParent
			$cat_Parent = $cat->slug;
			$count ++;
		}

		return $cat_Parent;
	}

	/* get expert details*/
	public function get_exp_det( $post_id ) {
		$telephone = get_field( 'tel', $post_id );
		$email     = get_field( 'mail', $post_id );
		$thumb     = '<div class="expert-img">';
		$thumb     .= get_the_post_thumbnail( $post_id );
		$thumb     .= '</div>';
		echo $thumb;
		echo '<div class="expert-details">';
		$title = '<h3 class="expert-title">';
		$title .= get_the_title( $post_id );
		$title .= '</h3>';
		echo $title;
		$exp = '<div class="expert-desc">';
		$exp .= get_the_excerpt( $post_id );
		$exp .= '</div>';
		echo $exp;
		echo '<div class="contact">';
		$tel = '<div class="expert-tel"><i class="fas fa-phone"></i>';
		$tel .= $telephone;
		$tel .= '</div>';
		echo $tel;
		$mail = '<div class="expert-mail"><i class="fas fa-envelope"></i>';
		$mail .= $email;
		$mail .= '</div>';
		echo $mail;
		echo '</div>'; //.contact
		echo '</div>'; //.expert-details
	}

	/* display all children categories of specific category also in every child we get the list
	   "correspondence category" */

	public function list_categories( $term, $term_child ) {
		$cat_children = get_categories( array( 'child_of' => $term->term_id ) );
		echo '<div class="mobile-current"><span></span><i class="fas fa-angle-down"></i></div>';
		echo '<ul class="list-categories" aria-label="'.__('list child','ort_site_2019').'">';
		foreach ( $cat_children as $children ) {
			if ( $term_child->term_id == $children->term_id ) {
				echo '<li class="child current">';
			} else {
				echo '<li class="child">';
			}
			printf( '<a href="%1$s">%2$s</a>',
				esc_url( get_category_link( $children->term_id ) ),
				esc_html( $children->name )
			);
			echo '</li>';
		}
		echo '</ul>';
	}

	/* to get the category name of the post if we have some posts from different categories*/
	public function post_category_name() {
		$category      = get_the_category();
		$name_category = $category[0]->cat_name;
		set_query_var( 'name_category', $name_category );
	}
}

$utils = new utilities();
$utils->init();