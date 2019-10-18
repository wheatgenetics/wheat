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
		<?php get_sidebar(); ?>
		
		
		<div id="primary" class="content-area">
			<main id="main" class="site-main">
			<h3 id="page-title">
			<?php post_type_archive_title(); ?>
		</h3>

			<?php if ( have_posts() ) : ?>
				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					$authors = get_field('authors');
					$journal = get_field('journal');
					$publication_date = get_field('publication_date');
					$link = get_field('link');
					$journal_date = [];
				?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="entry-header">
							<?php
							the_title( '<h3 class="entry-title"><a href="' . $link . '" rel="bookmark" target="_blank">', '</a></h3>' );

							if ( 'post' === get_post_type() ) :
								?>
								<div class="entry-meta">
									<?php
									wheat_posted_on();
									wheat_posted_by();
									?>
								</div><!-- .entry-meta -->
							<?php endif; ?>
						</header><!-- .entry-header -->

						<div class="entry-content">
							<?php													
							if (!empty($authors)) {
								echo "<p>" . $authors . "</p>";
							}

							if (!empty($journal)) {
								$journal_date[] = $journal;
							}
							
							if (!empty($publication_date)) {
								$journal_date[] = $publication_date;
							}

							echo "<p class='gray' style='text-transform:uppercase;'>" . implode(' | ', $journal_date) . "</p>";

							wp_link_pages( array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wheat' ),
								'after'  => '</div>',
							) );
							?>
							
						</div><!-- .entry-content -->

						<footer class="entry-footer">
							<?php wheat_entry_footer(); ?>
						</footer><!-- .entry-footer -->
					</article><!-- #post-<?php the_ID(); ?> -->
					<?php
				endwhile;

				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
					?>

			</main><!-- #main -->
		</div><!-- #primary -->
	</div>

<?php
get_sidebar();
get_footer();
