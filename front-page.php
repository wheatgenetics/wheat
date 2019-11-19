<?php
/**
 * The template for displaying the front page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Wheat
 */

get_header('front');
?>
	<?php 
	$args = array(
		'post_type'=> 'research_areas'
	);              

	$researchAreas = new WP_Query($args);

	if ($researchAreas->have_posts()) {
		echo '<div id="research-areas">';
		
		while ($researchAreas->have_posts()) {
			$researchAreas->the_post();
			echo '<a class="research-box">';
			echo '<p><i style="font-size: 3em;" class="fas fa-dna"></i></p>';
			the_title();
			echo '</a>';
		}

		echo '</div>';
	}
	?>
	

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php
			while ( have_posts() ) :
				the_post();
			?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>				
					<div class="entry-content">
						<?php the_content(); ?>
					</div><!-- .entry-content -->

				</article><!-- #post-<?php the_ID(); ?> -->
			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer('front');
