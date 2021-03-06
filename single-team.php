<?php
/**
 * The template for displaying all single team posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Wheat
 */

get_header();
?>

<?php
$bio = get_field('bio');
$email = get_field('email');
$office_location = get_field('office_location');
$phone = get_field('phone');
$education = get_field('education');
$appointments = get_field('appointments');
$previous = get_field('previous');
?>

	<div class="container">
    <aside id="secondary" class="widget-area">
      <section class="widget team-sidebar-widget">
        <h2 class="widget-title">Our Team</h2>

        <?php
        $custom_terms = get_terms('position_category');

        foreach($custom_terms as $custom_term) {
          wp_reset_query();

          $args = array('post_type' => 'team',
            'tax_query' => array(
              array(
                'taxonomy' => 'position_category',
                'field' => 'slug',
                'terms' => $custom_term->slug,
              ),
            ),
          );

          $loop = new WP_Query($args);

          if ($loop->have_posts()) {
            echo '<span class="purple-background position-category-header">' . $custom_term->name . '</span>';

            echo '<ul>';

            while ($loop->have_posts()) {
              $loop->the_post();
              
              echo '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
            }

            echo '</ul>';
          }
        }
        ?>         
      </section>
    </aside><!-- #secondary -->

		<div id="page-title">
			<?php post_type_archive_title(); ?>
		</div>

		<div id="primary" class="content-area">
			<main id="main" class="site-main">

        <?php	while ( have_posts() ) :
          the_post();
        ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
              <?php the_title( '<h3 class="entry-title">', '</h3>' ); ?>
            </header><!-- .entry-header -->

            <div class="entry-content">
              <?php
              the_post_thumbnail('medium', ['class' => 'alignleft']);

              if (!empty($bio)) {
                echo $bio;
              }
              
              if ($post_type == 'team' && (!empty($education) || !empty($appointments) || !empty($previous))) {
                echo "<hr class='wp-block-separator'>";

                if (!empty($education)) {
                  echo "<h4 class='purple'>Education</h4>";
                  echo $education;
                }

                if (!empty($appointments)) {
                  echo "<h4 class='purple'>Appointments</h4>";
                  echo $appointments;
                }

                if (!empty($previous)) {
                  echo "<h4 class='purple'>Previous</h4>";
                  echo $previous;
                }
              }
              ?>
            </div><!-- .entry-content -->

            <footer class="entry-footer">
              <?php wheat_entry_footer(); ?>
            </footer><!-- .entry-footer -->
					</article><!-- #post-<?php the_ID(); ?> -->
				<?php	endwhile; // End of the loop. ?>
			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- .container -->	
<?php
get_footer();
