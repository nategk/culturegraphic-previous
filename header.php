<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml" xml:lang="en-US" lang="en-US">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width"/><?php /*  content = "initial-scale = 1.0" */ ?>
	<?php if (is_home()) { ?>
	  <title><?php bloginfo('name'); ?></title>
	  <meta name="description" content="<?php bloginfo( 'description', 'display' ); ?>"/>
	  <meta property="og:description" content="<?php bloginfo( 'description', 'display' ); ?>"/>
		<meta property="og:title" content="<?php bloginfo('name'); ?>" />
		<meta property="og:description" content="<?php bloginfo( 'description', 'display' ); ?>"/>
		<meta property="og:image" content="<?php bloginfo( 'template_url' ); ?>/img/culturegraphic-logo.png"/>
		<meta property="og:type" content="company"/>
	<?php } else {
		$this_post = get_post($post->ID);
		?>
	  <title><?php wp_title( '&middot;', true, 'right' ); ?> <?php bloginfo('name'); ?></title>
		<meta property="og:title" content="<?php wp_title( '&middot;', true, 'right' ); ?> <?php bloginfo('name'); ?>" />
		<?php if ('project' == get_post_type()) { ?>
			<meta name="description" content="<?php echo strip_tags($this_post->post_excerpt); ?>" />
			<meta property="og:description" content="<?php echo strip_tags($this_post->post_excerpt); ?>"/>
			<meta property="og:type" content="company:project"/>
		<?php } ?>
	<?php } ?>
	<meta property="fb:admins" content="natesayer"/>
	<meta property="og:site_name" content="culturegraphic"/>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css' />
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
  <script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/jquery.masonry.min.js"></script>
  <script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/dom.js"></script>
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  <link id="favicon" rel="icon" type="image/png" href="<?php bloginfo( 'template_url' ); ?>/img/culturegraphic-logomark-icon.png" /> 
	<script type="text/javascript">
	/* <![CDATA[ */
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-9815746-1']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	/* ]]> */
	</script>
</head>
<body <?php body_class('container'); ?> <?php language_attributes(); ?>>

	<script type="text/javascript">
	/* <![CDATA[ */
	var body = document.getElementsByTagName('body');
	body[0].className += " JS";
	/* ]]> */
	</script>
	
	<!-- AddThis Button BEGIN -->
	<div class="addthis_toolbox addthis_default_style ">
		<!-- <a class="addthis_button_facebook_send" fb:send:font="arial"></a> -->
		<a href="http://www.addthis.com/bookmark.php" class="addthis_button" style="text-decoration:none;"><img src="http://s7.addthis.com/static/btn/sm-plus.gif" width="16" height="16" border="0" alt="Share" /></a>
		<a class="addthis_button_facebook_like" fb:like:font="arial" fb:like:layout="button_count" fb:like:href="<?php echo get_bloginfo( 'url' ); ?>"></a>
	</div>
	<script type="text/javascript">
	/* <![CDATA[ */
	var addthis_config = {
		pubid: "ra-4d7f74b4602b5a44",
		services_compact: "email,facebook,twitter,google_plusone_badge,pinterest,delicious",
		services_exclude: "reddit,print,stumbleupon,blogger,favorites,gmail,google",
    ui_header_color: "#333333",
    ui_header_background: "#f1f1f1",
    ui_use_css: true,
    ui_offset_left: -240,
    data_ga_tracker: "UA-9815746-1",
    data_track_clickback: true
	}
	/* ]]> */</script>
	<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4d7f74b4602b5a44"></script>
	<!-- AddThis Button END -->

  <div class="header">

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

/*
		if ( is_home() ) {	
			$args = array(
				'orderby' => 'count',
				'order' => 'ASC',
				'number' => 5
			);
			$terms = get_terms("process",$args);
			$count = count($terms);
			if ( $count > 0 ){
				echo '<ul class="services">';
				foreach ( $terms as $term ) {
					echo '<li>' . $term->name . '</li>';
				}
				echo '<li>Etc.</li>';
				echo "</ul>";
			}
		}
*/

			if ( is_single() ) {
				$project_title = get_the_title();
			}
			$args = array(
				'post_type' => 'project',
				'orderby' => 'date',
				'order'  => 'DESC'
			);
			$projects = new WP_Query( $args );
			if ($projects->have_posts()) {
			?>
				<ul class="nav" role="navigation">
				<?php while ( $projects->have_posts() ) : $projects->the_post(); ?>
					<li<?php if ((isset($project_title)) && ($project_title == get_the_title())) echo ' class="active"'; ?>><a href="<?php the_permalink(); ?>"><?php echo $post->post_name; ?></a></li>
				<?php
				endwhile;
				?>
				</ul>
				<?php
			}
		//
		?>
    
  </div>