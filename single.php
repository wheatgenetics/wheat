<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Wheat
 */

get_header();
?>

<?php
$publication_date = get_field('publication_date');
$link = get_field('original_source_link');
$bio = get_field('bio');
$email = get_field('email');
$office_location = get_field('office_location');
$phone = get_field('phone');
$project_website = get_field('project_website');
?>

	<div class="container">
		<?php get_sidebar(); ?>

		<div id="page-title">
			<?php post_type_archive_title(); ?>
		</div>

		<div id="primary" class="content-area">
			<main id="main" class="site-main">

				<?php
				while ( have_posts() ) :
					the_post();
				?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php the_post_thumbnail('thumbnail'); ?>

						<div class="header-content-wrapper">
							<header class="entry-header">
								<?php

								the_title( '<h3 class="entry-title">', '</h3>' );

								echo "<p class='gray' style='text-transform:uppercase;'>" . $publication_date . "</p>";

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
								// the_post_thumbnail('medium', ['class' => 'alignleft']);
								// the_post_thumbnail_caption();
									
								if (!empty($authors)) {
									echo "<p>" . $authors . "</p>";
								}
								
								if (!empty($publication_date)) {
									$journal_date[] = $publication_date;
								}

								if (!empty($title_position)) {
									echo $title_position;
								}

								if ($post_type == 'people') {
									echo '<p>' . $bio . '</p>';
									echo $office_location;
									echo '<br><a href="mailto:' . $email . '" target="_blank">' . $email . '</a>';
									echo '<br><a href="tel:' . $phone . '" target="_blank">' . $phone . '</a>';
								}

								the_content(
									sprintf(
										wp_kses(
											/* translators: %s: Name of current post. Only visible to screen readers */
											__( '', 'wheat' ),
											array(
												'span' => array(
													'class' => array(),
												),
											)
										),
										get_the_title()
									)
								);

								wp_link_pages( array(
									'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wheat' ),
									'after'  => '</div>',
								) );
								?>
								
								<!-- <br>

								<hr class="dotted">

								<br> -->

								<?php if ($post_type == 'news') { ?>
									<a href="<?php echo $link; ?>" class="dark-gray-button" target="_blank">Go to original story</a>
								<?php } ?>

								<?php if ($post_type == 'projects' && !empty($project_website)) { ?>
									<br>
									<a href="<?php echo $project_website; ?>" class="dark-gray-button" target="_blank">Visit project website</a>
								<?php } ?>
							</div><!-- .entry-content -->

							<footer class="entry-footer">
								<?php wheat_entry_footer(); ?>
							</footer><!-- .entry-footer -->
						</div>
					</article><!-- #post-<?php the_ID(); ?> -->

					<?php

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>
			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- .container -->	
<?php
get_footer();
