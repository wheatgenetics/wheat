<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Wheat
 */

?>

<?php
$post_type = get_post_type();
$authors = get_field('authors');
$journal = get_field('journal');
// $publication_date = get_field('publication_date');
$publication_date = get_the_date( 'm.d.Y' );
$link = get_field('link');
$journal_date = [];
$bio = get_field('bio');
$email = get_field('email');
$office_location = get_field('office_location');
$phone = get_field('phone');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php the_post_thumbnail('thumbnail'); ?>

	<div class="header-content-wrapper">
		<header class="entry-header">
			<?php
			if ($post_type == 'publications') {
				the_title( '<h3 class="entry-title"><a href="' . $link . '" rel="bookmark" target="_blank">', '</a></h3>' );
			} else {
				if (is_singular()) {
					the_title( '<h3 class="entry-title">', '</h3>' );
				} else {
					the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
				}
			}

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

			// the_content(
			// 	sprintf(
			// 		wp_kses(
			// 			/* translators: %s: Name of current post. Only visible to screen readers */
			// 			__( '', 'wheat' ),
			// 			array(
			// 				'span' => array(
			// 					'class' => array(),
			// 				),
			// 			)
			// 		),
			// 		get_the_title()
			// 	)
			// );

			the_excerpt();

			if ($post_type == 'team') {
				if (!empty($bio)) {
					echo '<p>' . $bio . '</p>';
				}

				if (!empty($office_location)) {
					echo '<p>' . $office_location . '</p>';
				}

				if (!empty($email)) {
					echo '<a href="mailto:' . $email . '" target="_blank">' . $email . '</a><br>';
				}

				if (!empty($phone)) {
					echo '<a href="tel:' . $phone . '" target="_blank">' . $phone . '</a>';
				}
			}

			if ($post_type == 'publications' || $post_type == 'news') {
				echo "<p class='gray' style='text-transform:uppercase;'>" . implode('&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;', $journal_date) . "</p>";
			}
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wheat' ),
				'after'  => '</div>',
			) );
			?>
			
		</div><!-- .entry-content -->
	</div>
	
	<footer class="entry-footer">
		<?php wheat_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->