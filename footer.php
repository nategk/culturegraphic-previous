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

	<div class="footer" role="contentinfo">
	
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
			<h2 class="label"><?php echo $first_name; ?> <?php echo $last_name; ?></h2>
			<p>
				<div class="pic"><?php echo get_avatar( 1, $size = '100' ); ?></div>
				<?php echo $description; ?>
			</p>
		</div><!-- .bio -->
		
		<div class="bio-meta">
			<div class="pinterest">
				<h3>Inspiration</h3>
				<?php
				showPins($nickname,5);
				?>
			</div><!-- .pinterest -->
			<div class="twitter">
				<?php
				showTweets($nickname,1);
				?>
			</div><!-- .twitter -->
			<div class="contact">
				<h3>Contact</h3>			
				<p><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></p>
			</div><!-- .contact -->
		</div><!-- .bio-meta -->
		
	</div><!-- .footer -->

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>

</body>
</html>