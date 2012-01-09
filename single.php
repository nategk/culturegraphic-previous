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

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="content error404 not-found" role="main">
		<h1 class="entry-title"><?php _e( 'Not Found' ); ?></h1>
		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.'); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>

<!-- Start the Loop. -->
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <div id="<?php echo $post->post_name; ?>" <?php post_class('content'); ?>>
  	<div class="meta">
			<h1 class="label"><?php the_title(); ?></h1>
			<p><?php echo the_date('Y'); ?></p>
			<p>
				<?php
				$args = array(
					'taxonomy' => 'process',
					'orderby' => 'name'
				);
				wp_tag_cloud($args);
				?>
			</p>
<!--
			<p class="third">Client, Date</p>
			<p class="third">Processes</p>
-->
		</div>
		<?php the_content(); ?>
	</div><!-- #<?php echo $post->post_name; ?> -->
<?php endwhile; endif; ?>

<?php get_footer(); ?>
