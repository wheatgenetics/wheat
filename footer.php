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
				<div class="news-item"
					style="background:linear-gradient(transparent, #020202), url(<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/wheat/images/wheat_code.jpg) no-repeat center top;background-size: cover;">
					<div class="news-item-content-holder">
						<p>Wheat Code Finally Cracked</p>
						<hr class="dotted">
						<p><a class="button purple-background">Read More</a></p>
					</div>
				</div>

				<div class="news-item"
					style="background:linear-gradient(transparent, #020202), url(<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/wheat/images/usaid_extends.jpg) no-repeat center top;background-size: cover;">
					<div class="news-item-content-holder">
						<p>USAID Extends Innovation and Research Partnerships</p>
						<hr class="dotted">
						<p><a class="button purple-background">Read More</a></p>
					</div>
				</div>

				<div class="news-item"
					style="background:linear-gradient(transparent, #020202), url(<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/wheat/images/new_genomic_tool.jpg) no-repeat center top;background-size: cover;">
					<div class="news-item-content-holder">
						<p>New Genomic Tool Searches Wheat's Wild Past</p>
						<hr class="dotted">
						<p><a class="button purple-background">Read More</a></p>
					</div>
				</div>
			</div>

			<div class="view-all-link-container">
				<a class="button" href="#">All news</a>
			</div>
		</div>

		<div id="recent-publications">
			<h3>RECENT PUBLICATIONS</h3>

			<div id="recent-publications-container">
				<div class="recent-publication">
					<div class="recent-publication-header">
						<img class="pubicon" src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/wheat/images/PubIcon.png" />
						<span class="button date purple-background">June 6, 2019</span>
					</div>

					<p>Genome mapping of quantitative trait loci (QTL) controlling domestication traits of
						intermediate
						wheatgrass (Thinopyrum intermedium)</p>
					<div class="journal">
						Theoretical and Applied Genetics
					</div>
				</div>

				<div class="recent-publication">
					<div class="recent-publication-header">
						<img class="pubicon" src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/wheat/images/PubIcon.png" />
						<span class="button date purple-background">May 28, 2019</span>
					</div>

					<p>Reduced response diversity does not negatively impact wheat climate resilience</p>
					<div class="journal">
						Proceedings of the National Academy of Sciences
					</div>
				</div>

				<div class="recent-publication">
					<div class="recent-publication-header">
						<img class="pubicon" src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/wheat/images/PubIcon.png" />
						<span class="button date purple-background">May 14, 2019</span>
					</div>

					<p>Small plot identification from video streams for high-throughput phenotyping of large
						breeding
						populations with unmanned aerial systems</p>
					<div class="journal">
						International Society for Optics and Photonics
					</div>
				</div>
			</div>

			<div class="view-all-link-container">
				<a class="button" href="#">All publications</a>
			</div>
		</div>
	<?php } ?>

	<div id="sponsors">
		<p>SPONSORS</p>
		<div id="sponsors-img-container">
			<img src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/wheat/images/KansasWheat.png" />
			<img src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/wheat/images/NSF.png" />
			<img src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/wheat/images/IWYP.png" />
			<img src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/wheat/images/FeedtheFuture.png" />
			<img src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/wheat/images/BeachelBorlaug.png" />
			<img src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/wheat/images/NIFA.png" />
			<img src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/wheat/images/GatesFoundation.png" />
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
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
