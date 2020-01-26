<?php
/**
 * Created by PhpStorm.
 * User: lcohen
 * Date: 26/12/2018
 * Time: 10:55
 */

namespace ortsite2019;


class Categories {

	/**
	 * @param $cat
	 * Returns array of category object. The object has 3 fiellds: name, term_id, and a comma separated list of post_ids
	 *
	 * @return array|object|null
	 */
	function getChildCategoriesAndPosts( $cat ) {
		global $wpdb;
		$childCategories = null;
		if ( $cat == null ) {
			$cat = get_query_var( 'cat' );
		}
		if ( $cat != null ) {
			/*$childCategories = get_categories(
				array( 'parent' => $cat )
			);*/
			$childCategories = $wpdb->get_results( "SELECT {$wpdb->prefix}terms.name, {$wpdb->prefix}terms.term_id,  GROUP_CONCAT({$wpdb->prefix}term_relationships.object_id SEPARATOR ' , ') AS post_ids 
				FROM {$wpdb->prefix}term_taxonomy
				INNER JOIN {$wpdb->prefix}term_relationships on {$wpdb->prefix}term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_id
				INNER JOIN {$wpdb->prefix}terms on {$wpdb->prefix}terms.term_id = {$wpdb->prefix}term_taxonomy.term_id
				WHERE taxonomy='category' and parent=$cat
				GROUP BY {$wpdb->prefix}terms.term_id
				ORDER BY {$wpdb->prefix}terms.name;" );

			foreach ( $childCategories as $child_category ) {

				$child_category->post_ids = explode( ',', $child_category->post_ids );

			}
		}

		return $childCategories;
	}

	function getCurrentPostFromCategoryList( $post_id ) {
		global $posts;
		$ret       = null;
		$curr_post = array_filter( $posts, function ( $obj ) use ( $post_id ) {
			return $obj->ID == $post_id;
		} );
		$curr_post = array_values( $curr_post );
		if ( count( $curr_post ) > 0 ) {
			$ret = $curr_post[0];
		}

		return $ret;
	}

	public function __construct() {
		add_action( 'body_class', array( $this, 'custom_class' ) );
		add_filter( 'get_the_archive_title', array( $this, 'archive_title' ) );
	}

	function custom_class( $classes ) {
        $term = get_queried_object();
		if ( is_category() ) {
			$cat_kind = get_field( 'kind-of-category', $term );
			if ( $cat_kind ) {
				if ( in_array( 'category-vertical', $cat_kind ) ) {
					$classes[] = 'category-vertical';
				} elseif ( in_array( 'category-horizontal', $cat_kind ) ) {
					$classes[] = 'category-horizontal';
				}
			}

			// Tsofiya: Add the class of the parent, so the post items would get the correct css
            $parent_category = get_category($term->category_parent);
			if( property_exists($parent_category, 'slug')){
                if($parent_category->slug == 'newsletter'){
                    $classes[] = 'category-newsletter';
                }
                else if($parent_category->slug == 'videort'){
                    $classes[] = 'category-videort';
                }
            }

		}
		elseif (is_page()){
            $cat_kind = get_field( 'add class', $term );
            if ( $cat_kind ) {
                $classes[] = 'special-page';
            }
        }
        elseif (is_single()){
            $cat_kind = get_field( 'add class', $term );
            if ( $cat_kind ) {
                $classes[] = 'special-page';
            }
        }
		return $classes;
	}

	function archive_title( $title ) {
		if ( is_category() || is_tag() ) {
			$title = single_cat_title( '', false );
		}

		return $title;
	}
}

$catClass = new Categories();