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

	<?php
	$query = new WP_Query(array(
		'post_type' => 'industry_partners',
		'post_status' => 'publish',
		'posts_per_page' => -1
	));

	if ($query->have_posts()) {
	?>
		<div id="sponsors">
			<div class="container">
				<p>INDUSTRY PARTNERS</p>
				<div id="sponsors-img-container">
					<?php
					while ($query->have_posts()) {
						$query->the_post();
						$post_id = get_the_ID();
						$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'single-post-thumbnail' );
						
						if (get_field('industry_partner_website', $post_id)) {
							$industry_partner_website = get_field('industry_partner_website', $post_id);
							echo "<a href='" . $industry_partner_website . "' target='_blank'><img src='" . $image[0] . "'/></a>";
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

			<div class="footer-box">
				<h4>NAVIGATION</strong></h4>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu-footer',
					'depth' => 1
				) );
				?>
			</div>

			<div class="footer-box">
        <h4>OTHER SITES</strong></h4>
        <?php
				wp_nav_menu( array(
					'theme_location' => 'other-sites',
					'menu_id'        => 'other-sites',
					'depth' => 1
				) );
				?>
			</div>

			<div class="footer-box">
				<h4>OUR LOCATION</strong></h4>
				<p>Kansas State University
				<br>4702 Throckmorton PSC
				<br>1712 Claflin Road
				<br>Manhattan, KS 66506</p>
			</div>
			
			<nav class="footer-box">
        <h4>FOLLOW US</strong></h4>
        <?php
				wp_nav_menu( array(
					'theme_location' => 'social-footer',
					'menu_id'        => 'social-menu-footer',
					'depth' => 1
				) );
				?>
			</nav>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
