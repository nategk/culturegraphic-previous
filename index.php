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
		<h2 class="label">Mission</h2>
		<h3 class="big-title">Experiences that tell stories. Products that serve purpose.</h3>
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
		<h2 class="label">Projects</h2>
	<?php while ( have_posts() ) : the_post(); ?>
	  <div id="<?php echo $post->post_name; ?>" <?php post_class('half'); ?>>
			<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s'), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_post_thumbnail('thumbnail'); ?><h3 class="small-title"><?php the_title(); ?></h3></a>
		</div><!-- #<?php echo $post->post_name; ?> -->
	<?php endwhile; endif; ?>

</div><!-- #content -->

<?php get_footer(); ?>
