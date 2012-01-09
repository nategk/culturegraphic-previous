<!doctype html>
<!--[if lt IE 9]><html class="ie"><![endif]-->
<!--[if gte IE 9]><!--><html><!--<![endif]-->

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;
	wp_title( '&bull', true, 'right' );
	// Add the blog name.
	bloginfo( 'name' );
	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " $site_description";
	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' &bull ' . sprintf( __( 'Page %s', 'cg' ), max( $paged, $page ) );
	?>
	</title>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
	<link rel="icon" type="image/svg+xml" href="<?php bloginfo( 'template_url' ); ?>/img/culturegraphic-logomark.svg" />
	<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
  <?php
  	/* We add some JavaScript to pages with the comment form
  	 * to support sites with threaded comments (when in use).
  	 */
  	if ( is_singular() && get_option( 'thread_comments' ) )
  		wp_enqueue_script( 'comment-reply' );
  
  	/* Always have wp_head() just before the closing </head>
  	 * tag of your theme, or you will break many plugins, which
  	 * generally use this hook to add elements to <head> such
  	 * as styles, scripts, and meta tags.
  	 */
  	wp_enqueue_script("jquery");
  	wp_head();
  	flush_rewrite_rules();
  ?>
  <script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/dom.js"></script>
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
</head>
<body <?php body_class('container_15'); ?> <?php language_attributes(); ?>>

  <header>

		<?php if (is_home()) { ?>
	    <div class="logo">
	      <h1><?php bloginfo( 'name' ); ?> <span class="small-title"><?php bloginfo( 'description' ); ?></span></h1>
	    </div><!-- .logo -->
    <?php } else { ?>
    	<div class="logo">
		    <a href="<?php bloginfo('url'); ?>">
		      <h2><?php bloginfo( 'name' ); ?> <span class="small-title"><?php bloginfo( 'description' ); ?></span></h2>
		    </a><!-- a -->
	    </div><!-- .logo -->
    <?php
    }
    ?>
    
		<?php
		if ( is_single() ) {
			$project_title = get_the_title();
			$args = array(
				'post_type' => 'project',
				'orderby' => 'date',
				'order'  => 'ASC'
			);
			$projects = new WP_Query( $args );
			if ($projects->have_posts()) {
			?>
				<ul class="nav" role="navigation">
				<?php while ( $projects->have_posts() ) : $projects->the_post(); ?>
					<li class="small-title<?php if ($project_title == get_the_title()) echo " active"; ?>"><a href="<?php the_permalink(); ?>"><?php echo $post->post_name; ?></a></li>
				<?php
				endwhile;
				?>
				</ul>
				<?php
			}
		}
		?>
    
  </header>