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
  <div id="<?php echo $post->post_name; ?>" <?php post_class('content'); ?> <?php if (get_next_post()) echo 'data-next="' . get_permalink(get_next_post()->ID) . '"'; ?> <?php if (get_previous_post()) echo 'data-prev="' . get_permalink(get_previous_post()->ID) . '"'; ?>>
  	<div class="intro">
	  	<div class="title half">
				<?php
				$clients = get_the_terms( $post->ID, 'client' );
				if ( $clients && ! is_wp_error( $clients ) ) {
				?>
					<div class="label above">
						<?php
						foreach ( $clients as $client ) {
							echo $client->name;
						}
						?>
					</div>
				<?php 
				}
				?>
	  		<h1><?php the_title(); ?></h1>
	  	</div><!-- .title -->
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
			<!-- <p class="date"><?php echo the_date('Y'); ?></p> -->
		</div><!-- .intro -->
		<div class="body">
			<?php the_content(); ?>
		</div><!-- .body -->
	</div><!-- #<?php echo $post->post_name; ?> -->
<?php endwhile; endif; ?>

<?php get_footer(); ?>
