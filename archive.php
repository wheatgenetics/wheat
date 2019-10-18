<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Wheat
 */

get_header();
?>

	<div class="container">
		<div class="left-wing">
		</div>
		
		<?php get_sidebar(); ?>
		
		<div id="primary" class="content-area">
			<main id="main" class="site-main">
				<h3 id="page-title">
					<?php post_type_archive_title(); ?>
				</h3>

				<?php if ( have_posts() ) :
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/*
						* Include the Post-Type-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Type name) and that will be used instead.
						*/
						get_template_part( 'template-parts/content', get_post_type() );

					endwhile;

					the_posts_navigation();

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>
			</main><!-- #main -->
		</div><!-- #primary -->

		<div class="right-wing">
		</div>
	</div>

<?php
get_sidebar();
get_footer();
