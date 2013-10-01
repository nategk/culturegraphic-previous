<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage cg
 */

get_header(); ?>

<div class="content" role="main">
	
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<div id="page-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="body">
				<?php the_content(); ?>
			</div><!-- .body -->
		</div><!-- #page.. -->
	
	<?php 
	endwhile; endif; //ends the loop
	?>

</div><!-- .content -->

<?php get_footer(); ?>
