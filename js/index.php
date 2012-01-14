<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query. 
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage cg
 */

get_header(); ?>

<div class="content" role="main">

	<div class="intro half">
		<h2 class="label above">It's all about:</h2>
		<h3 class="big-title">Form, function and joi de vivre in creative that serves purpose</h3>
	</div>
	<?php /* If there are no posts to display, such as an empty archive page */ ?>
	<?php if ( ! have_posts() ) : ?>
		<div id="post-0" class="half error404 not-found">
			<h1 class="entry-title"><?php _e( 'Not Found' ); ?></h1>
			<div class="entry-content">
				<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.'); ?></p>
				<?php get_search_form(); ?>
			</div><!-- .entry-content -->
		</div><!-- #post-0 -->
	<?php endif; ?>

	<!-- Start the Loop. -->
	<?php if ( have_posts() ) : ?>
		<!-- <h2 class="label">Projects</h2> -->
	<?php while ( have_posts() ) : the_post(); ?>
	  <div id="<?php echo $post->post_name; ?>" <?php post_class('half'); ?>>
			<a href="<?php the_permalink(); ?>" rel="bookmark">
				<?php
				$attr = array(
					'alt'	=> get_the_title(),
					'title'	=> false,
				);
				the_post_thumbnail('medium',$attr);
				?>
				<h3><?php the_title(); ?></h3>
				<?php
				$processes = get_the_terms( $post->ID, 'process' );
				if ( $processes && ! is_wp_error( $processes ) ) {
				?>
					<ul class="processes">
						<?php
						foreach ( $processes as $process ) {
							echo "<li>" . $process->name . "</li>";
						}
						?>
					</ul>
				<?php 
				}
				?>
			</a>
		</div><!-- #<?php echo $post->post_name; ?> -->
		
		<script type="text/javascript">
		/* <![CDATA[ */
		var arr = document.getElementsByTagName("img");
		for (i = 0; i < arr.length; i++) {
		   arr[i].style.display = "none";
		}
		/* ]]> */
		</script>
		
	<?php endwhile; endif; ?>

</div><!-- #content -->

<div class="principal">

	<?php
	// All below data fed from these vars
	$user_info = get_metadata('user',1);
	$first_name = $user_info['first_name'][0];
	$last_name = $user_info['last_name'][0];
	$nickname = $user_info['nickname'][0];
	$description = $user_info['description'][0];
	$email = $user_info['jabber'][0];
	?>

  <div class="bio">
		<h2 class="label above"><?php echo $first_name; ?> <?php echo $last_name; ?></h2>
		<p>
			<span class="pic"><?php echo get_avatar( 1, $size = '105' ); ?></span>
			<?php echo $description; ?>
		</p>
	</div><!-- .bio -->
	
	<div class="bio-meta">
		<div class="pinterest">
			<h3><a href="http://pinterest.com/<?php echo $nickname; ?>">Likes</h3>
			<?php
			showPins($nickname,6);
			?>
		</div><!-- .pinterest -->
		<div class="twitter">
			<h3><a href="http://twitter.com/<?php echo $nickname; ?>">@<?php echo $nickname; ?></a></h3>
			<?php
			showTweets($nickname,1);
			?>
		</div><!-- .twitter -->
		<?php
/*
		<div class="contact">		
			<ul>
				<li><a href="http://www.linkedin.com/in/<?php echo $first_name . $last_name; ?>">LinkedIn</a></li>
				<li><a href="https://plus.google.com/103821730694119742257/about">Google</a></li>
				<li><a href="http://www.rdio.com/#/people/<?php echo $nickname; ?>/">Rdio</a></li>
			</ul>
		</div><!-- .contact -->
*/
		?>
	</div><!-- .bio-meta -->
	
</div><!-- .footer -->

<?php get_footer(); ?>
