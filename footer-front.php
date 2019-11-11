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

	<?php if (is_front_page()) { ?>
		<?php
		$backgroundInfographic = get_field('background_infographic');

		if ( !empty($backgroundInfographic) ) {
		?>
			<div id="infographic">
    	        <img src="<?php echo $backgroundInfographic['url']; ?>" />
			</div>
		<?php } ?>

		<div id="news">
			<h3>NEWS</h3>
			
			<div id="news-container">
				<?php
				$query = new WP_Query(array(
					'post_type' => 'news',
					'post_status' => 'publish',
					'posts_per_page' => 3
				));

				while ($query->have_posts()) {
					$query->the_post();
					$post_id = get_the_ID();
					$title = get_the_title();
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'single-post-thumbnail' );

					echo "<div class='news-item' style='background:linear-gradient(transparent, #020202), url(" . $image[0] . ") no-repeat center top;background-size: cover;'>";
					echo "<div class='news-item-content-holder'>";
					echo "<p>" . $title . "</p>";
					echo "<hr class='dotted'>";
					echo "<p><a class='button purple-background'>Read More</a></p>";
					echo "</div>";
					echo "</div>";
				}

				wp_reset_query();
				?>
			</div>

			<div class="view-all-link-container">
				<a class="button" href="<?php echo esc_url( home_url( '/news' ) ); ?>">All news</a>
			</div>
		</div>

		<div id="recent-publications">
			<h3>RECENT PUBLICATIONS</h3>

			<div id="recent-publications-container">
				<?php
				$query = new WP_Query(array(
					'post_type' => 'publications',
					'post_status' => 'publish',
					'posts_per_page' => 3
				));

				while ($query->have_posts()) {
					$query->the_post();
					$post_id = get_the_ID();
					$title = get_the_title();
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'single-post-thumbnail' );
					$publication_date = get_the_date();
					
					// if (get_field('publication_date', $post_id)) {
					// 	$publication_date = get_field('publication_date', $post_id);
					// } else {
					// 	$publication_date = '';
					// }

					if (get_field('journal', $post_id)) {
						$journal = get_field('journal', $post_id);
					} else {
						$journal = '';
					}
					echo "<div class='recent-publication'>";
					echo "<div class='recent-publication-header'>";
					echo "<img class='pubicon' src='" . esc_url( home_url( '/' ) ) . "wp-content/themes/wheat/images/PubIcon.png' />";
					echo "<span class='button publication-date purple-background'>" . $publication_date . "</span>";
					echo "</div>";
					echo "<p>" . $title . "</p>";
					echo "<div class='journal'>";
					echo $journal;
					echo "</div>";
					echo "</div>";
				}

				wp_reset_query();
				?>
			</div>

			<div class="view-all-link-container">
				<a class="button" href="<?php echo esc_url( home_url( '/publications' ) ); ?>">All publications</a>
			</div>
		</div>
	<?php } ?>

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
