<?php
/**
 * The template for displaying the front page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Wheat
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

        
		<?php
		while ( have_posts() ) :
			the_post();
        ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php wheat_post_thumbnail(); ?>
                
                <div class="entry-content">
                    <?php the_content(); ?>
                </div><!-- .entry-content -->

            </article><!-- #post-<?php the_ID(); ?> -->
		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
