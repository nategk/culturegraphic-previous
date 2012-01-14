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


if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' ); 
}
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'medium-cropped', 365, 235, true );
}

// Remove title attr
function remove_attachment_title_attr( $attr ) {
	unset($attr['title']);
	return $attr;
}
add_action('wp_get_attachment_image_attributes', 'remove_attachment_title_attr');


// Remove auto p
remove_filter( 'the_content', 'wpautop' );

// Use stylesheet for visual editor
add_editor_style('style.css');




function showTweets($username, $items = 1){
	include_once(ABSPATH . WPINC . '/feed.php');
	// Get a SimplePie feed object from the specified feed source.
	$rss = fetch_feed("http://search.twitter.com/search.atom?q=from:" . $username . "&rpp=" . $items);
	if (!is_wp_error( $rss ) ) : // Checks that the object is created correctly 
		// Figure out how many total items there are, but limit it to 5. 
		$maxitems = $rss->get_item_quantity($items); 
		// Build an array of all the items, starting with element 0 (first element).
		$rss_items = $rss->get_items(0, $maxitems); 
	endif;
	if ($maxitems == 0)
		echo '<!-- No Tweets found -->';
	else
	?>
		<ul>
			<?php
			// Loop through each feed item and display each item as a hyperlink.
			foreach ( $rss_items as $item ) : ?>
				<li>
					<?php echo $item->get_description(); ?>
					<span class="timestamp">
						<a href='<?php echo ($items < 3 ? esc_url("http://twitter.com/#!/" . $username) : esc_url( $item->get_permalink() )); ?>'>
							<?php echo human_time_diff( $item->get_date('U'), current_time('timestamp') ) . ' ago'; ?>
						</a>
					</span>
				</li>
			<?php endforeach; ?>
		</ul>
<?php
}

function showPins($username, $items = 3){
	include_once(ABSPATH . WPINC . '/feed.php');
	// Get a SimplePie feed object from the specified feed source.
	$rss = fetch_feed("http://pinterest.com/" . $username . "/feed.rss");
	if (!is_wp_error( $rss ) ) : // Checks that the object is created correctly 
		// Figure out how many total items there are, but limit it to 5. 
		$maxitems = $rss->get_item_quantity($items); 
		// Build an array of all the items, starting with element 0 (first element).
		$rss_items = $rss->get_items(0, $maxitems); 
	endif;
	if ($maxitems == 0)
		echo '<!-- No Pins found -->';
	else
	?>
		<ul>
			<?php
			// Loop through each feed item and display each item as a hyperlink.
			foreach ( $rss_items as $item ) : ?>
				<li>
					<?php echo $item->get_description(); ?>
				</li>
			<?php endforeach; ?>
		</ul>
<?php
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
      'rewrite' => array('slug' => 'project', 'with_front' => false),
      'hierarchical' => false,
      'supports' => array('title','editor','author','thumbnail','revisions','excerpt'),
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


// Add projects to loop
add_filter( 'pre_get_posts', 'my_get_posts' );
function my_get_posts( $query ) {
	if ( is_home() )
		$query->set( 'post_type', array( 'project' ) );
	return $query;
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

