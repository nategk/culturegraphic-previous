<?php
/**
 * @package WordPress
 * @subpackage cg
 */



// Enables SASS to CSS automatic generation
function generate_css() {
  if(function_exists('wpsass_define_stylesheet'))
    wpsass_define_stylesheet("style.scss", "style.css", true);
}
add_action( 'after_setup_theme', 'generate_css' );


// Max content width to fit in blog 
// $GLOBALS['content_width'] = 640;


if ( function_exists( 'add_image_size' ) ) { 
  /*
	add_image_size( 'full', 200, 40, false ); //250 pixels wide (and 40 height)
	add_image_size( 'school-emblems', 120, 60, false ); //250 pixels wide (and 40 height)
	add_image_size( 'homepage-slideshow', 745, 274, true ); //(cropped)
  */
}


// Remove "posts"
function remove_menus()
{
    global $menu;
    $restricted = array( __('Posts'));
    end ($menu);
    while (prev($menu))
    {
        $value = explode(' ',$menu[key($menu)][0]);
        if(in_array($value[0] != NULL?$value[0]:"" , $restricted))
        {
            unset($menu[key($menu)]);
        }
    }
}
add_action('admin_menu', 'remove_menus');



// Register "project" type

add_action( 'init', 'create_post_type' );
function create_post_type() {
	register_post_type( 'project',
		array(
      'labels' => array(
        'name' => __( 'Projects' ),
        'singular_name' => __( 'Project' )
      ),
      'public' => true,
      'has_archive' => false,
      'rewrite' => array('slug' => 'projects'),
      'hierarchical' => false,
      'supports' => array('title','editor','author','thumbnail'),
      'taxonomies' => array('client','process')
    )
	);
}



// Register taxonomies

//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_taxonomies', 0 );
// Create custom taxonomies
function create_taxonomies() {
  // Add "client"
  register_taxonomy('client', array('project'), array(
    'hierarchical' => false,
    'labels' => array(
      'name' => __( 'Clients' ),
      'singular_name' => __( 'Client' )
    ),
    'rewrite' => false
  ));
  // Add "process"
  register_taxonomy('process', array('project'), array(
    'hierarchical' => false,
    'labels' => array(
      'name' => __( 'Processes' ),
      'singular_name' => __( 'Process' )
    ),
    'rewrite' => false
  )); 
}



// Remove gallery shortcode
remove_shortcode('gallery');
// get all of the images attached to the current post
function get_gallery_images($size = 'thumbnail', $show_thumbs = true) {
	global $post;
	$photos = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') );
	if ($photos) {
		$results = "<ul class='gallery_images grid_16 alpha'>";
		foreach ($photos as $photo) {
			// get the correct image html for the selected size
			$results .= "<li>";
			$results .= wp_get_attachment_image($photo->ID, 'large');
			if ($photo->post_excerpt) {
				$results .= "<span class='caption'>";
				$results .= $photo->post_excerpt; // caption
				$results .= "</span>";
			}
			$results .= "</li>";
		}
		$results .= "</ul>";
		return $results;
	} else {
		return false;
	}
}
// Replace gallery shortcode
add_shortcode('gallery', 'get_gallery_images');

