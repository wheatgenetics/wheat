<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Wheat
 */

?>

	</div><!-- #content -->

	<?php
	$query = new WP_Query(array(
		'post_type' => 'sponsors',
		'post_status' => 'publish',
		'posts_per_page' => -1
	));

	if ($query->have_posts()) {
	?>
		<div id="sponsors">
			<div class="container">
				<p>SPONSORS</p>
				<div id="sponsors-img-container">
					<?php
					while ($query->have_posts()) {
						$query->the_post();
						$post_id = get_the_ID();
						$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'single-post-thumbnail' );
						
						if (get_field('sponsor_website', $post_id)) {
							$sponsor_website = get_field('sponsor_website', $post_id);
							echo "<a href='" . $sponsor_website . "' target='_blank'><img src='" . $image[0] . "'/></a>";
						} else {
							echo "<img src='" . $image[0] . "'/>";
						}
					}

					wp_reset_query();
					?>
				</div>
			</div>
		</div>
	<?php } ?>
			
	<footer id="colophon" class="site-footer">
		<div class="container">
			<div id="kstate-logo-holder">
				<img id="kstate-logo" src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/wheat/images/KansasStateUniversity.png" />
			</div>
			
			<nav class="social-menu">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'social'
				) );
				?>
			</nav>

			<div id="contact">
				Kansas State University
				<br>4702 Throckmorton PSC
				<br>1712 Claflin Road
				<br>Manhattan, KS 66506
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
