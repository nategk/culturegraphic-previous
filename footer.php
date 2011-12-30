<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>
	<div class="clear"></div>

	<div class="footer" role="contentinfo">
	
	  	<div class="bio">
	    	<?php
	      $user = get_metadata('user','1');
	      ?>
	      <h2><?php echo $user->first_name . ' ' . $user->last_name; ?></h2>
	      <p><?php echo $user->description; ?></p>
	    </div>
	
		<div id="colophon">
			<div id="site-info">
				<a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<?php bloginfo( 'name' ); ?>
				</a>
			</div><!-- #site-info -->
		</div><!-- #colophon -->
		
	</div><!-- .footer -->

	<div class="clear"></div>

</div><!-- .wrapper -->

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>

</body>
</html>