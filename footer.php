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

<div class="footer">
	<p>&copy;2012 culturegraphic&nbsp;&nbsp;&middot;&nbsp;&nbsp;<a href="http://sass-lang.com/">SASS</a>'ed up, <a href="http://www.alistapart.com/articles/responsive-web-design/">responsive</a> <a href="http://wordpress.org/">Wordpress</a>, <span class='grid_hover'>on a <a href="http://framelessgrid.com/">grid</a></span>&nbsp;&nbsp;&middot;&nbsp;&nbsp;<a href="mailto:hello@culturegraphic.com">hello@culturegraphic.com</a></p>
</div>

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>

</body>
</html>