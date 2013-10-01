<?php
// PHP session info
if(isset($_SESSION['views']))
	$_SESSION['views'] = $_SESSION['views'] + 1;
else
	$_SESSION['views'] = 1;
?>

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
    <meta property="og:url" content="<?php echo get_bloginfo( 'url' ); ?>"/>
    <meta property="fb:admins" content="natesayer"/>
    <meta property="og:site_name" content="culturegraphic"/>
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
  <link rel="apple-touch-icon" href="<?php bloginfo( 'template_url' ); ?>/img/culturegraphic-logomark-icon.png"/>
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
<body <?php body_class('container ' . session_id()); ?> <?php language_attributes(); ?>>

	<script type="text/javascript">
	/* <![CDATA[ */
	var body = document.getElementsByTagName('body');
	body[0].className += " JS";
	/* ]]> */
	</script>

	<div class="twitter-follow-button-container">
		<a href="https://twitter.com/natesayer" class="twitter-follow-button" data-show-count="false">Follow @natesayer</a>
	</div>

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
    if ( !is_page() ) {
    ?>

      <ul class="nav" role="navigation">
        <li><a href="/about" />About</a></li>
    		<?php
          // Projects
    			if ( is_single() ) {
    				$project_title = get_the_title();
    			}
    			$project_args = array(
    				'post_type' => 'project',
    				'orderby' => 'date',
    				'order'  => 'DESC'
    			);
    			$projects = new WP_Query( $project_args );
    			if ($projects->have_posts()) {
    			?>
    				<?php while ( $projects->have_posts() ) : $projects->the_post(); ?>
    					<li<?php if ((isset($project_title)) && ($project_title == get_the_title())) echo ' class="active"'; ?>><a href="<?php the_permalink(); ?>"><?php echo $post->post_name; ?></a></li>
    				<?php
    				endwhile;
    				?>
    				<?php
    			}
        ?>
      </ul>

    <?php
    }
    ?>
    
  </div>