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
$authors = get_field('authors');
$journal = get_field('journal');
$publication_date = get_field('publication_date');
$link = get_field('link');
$journal_date = [];
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_post_thumbnail('thumbnail'); ?>
	
		<?php
		if ( is_singular() ) :
			the_title( '<h3 class="entry-title">', '</h3>' );
		else :
			the_title( '<h3 class="entry-title"><a href="' . $link . '" rel="bookmark" target="_blank">', '</a></h3>' );
		endif;

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