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

	<div id="sponsors">
		<div class="container">
			<p>SPONSORS</p>
			<div id="sponsors-img-container">
				<?php
				$query = new WP_Query(array(
					'post_type' => 'sponsors',
					'post_status' => 'publish',
					'posts_per_page' => -1
				));

				while ($query->have_posts()) {
					$query->the_post();
					$post_id = get_the_ID();
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'single-post-thumbnail' );
					echo "<img src='" . $image[0] . "'/>";
				}

				wp_reset_query();
				?>
			</div>
		</div>
	</div>
			
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
				<br>
				<br>Email: <a href="mailto:jpoland@ksu.edu">jpoland@ksu.edu</a>
				<br>Phone: <a href="tel:1-785-532-2709">+1-785-532-2709</a>
				<br>Fax: +1-785-532-5692
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
