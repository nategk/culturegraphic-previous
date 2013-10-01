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
		<h2 class="label above">Welcome</h2>
		<h3 class="big-title">Human-centered, data informed design by Nathaniel Kerksick</h3>
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
		<?php
		$imgdata = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' );
		$imgheight = $imgdata[2]; // thumbnail's height
		$imgwidth = $imgdata[1]; // thumbnail's width
		?>
	  <div id="<?php echo $post->ID; ?>" <?php post_class('half'); ?> style="height:<?php echo $imgheight; ?>px; width:<?php echo $imgwidth; ?>px;">
			<a href="<?php the_permalink(); ?>" rel="bookmark">
				<?php
				$attr = array(
					'alt'	=> get_the_title(),
					'title'	=> false,
					'id' => 'img-'.$post->ID
				);
				the_post_thumbnail('medium',$attr);
				?>
				<h3><?php the_title(); ?></h3>
				<?php
/*
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
*/
				?>
			</a>
		</div><!-- #<?php echo $post->post_name; ?> -->
		
	<?php endwhile; endif; ?>

</div><!-- #content -->

<div class="services">
	<h2 class="label above">Services</h2>
	<?php	
	$args = array(
		'orderby' => 'count',
		'order' => 'ASC'
	);
	$terms = get_terms("process",$args);
	$count = count($terms);
	if ( $count > 0 ){
		echo '<ul>';
		foreach ( $terms as $term ) {
			echo '<li><h3>' . $term->name . '</h3><p>' . $term->description . '</p></li>';
		}
		echo "</ul>";
	}
	?>
</div>

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
		<h2 class="label above"><a href="/about"><?php echo $first_name; ?> <?php echo $last_name; ?></a></h2>
		<p>
			<span class="pic"><?php echo get_avatar( 1, $size = '105' ); ?></span>
			<?php echo $description; ?>
			<a href="/about">More</a>
		</p>
	</div><!-- .bio -->
	
	<div class="bio-meta">

		<div class="pinterest">
			<h3><a href="http://pinterest.com/<?php echo $nickname; ?>">Likes</a></h3>
			<?php
			showPins($nickname,6);
			?>
		</div><!-- .pinterest -->

		<div class="contact">	
			<h3>Elsewhere</h3>	
			<ul>
				<li><a href="http://twitter.com/natesayer/">Twitter</a></li>
				<li><a href="http://instagram.com/natesayer/">Instagram</a></li>
				<li><a href="https://github.com/culturegraphic">GitHub</a></li>
				<li><a href="http://www.rdio.com/#/people/natesayer/">Rdio</a></li>
				<li><a href="http://www.linkedin.com/in/nathanielkerksick">LinkedIn</a></li>
			</ul>
		</div><!-- .contact -->

	</div><!-- .bio-meta -->
	
</div><!-- .principal -->

<?php get_footer(); ?>
