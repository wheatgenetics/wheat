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
      
        <?php
        $custom_terms = get_terms('position_category');

        foreach($custom_terms as $custom_term) {
          if ($custom_term->slug == 'alumni') { // Don't display the alumni category on this page
            continue;
          }
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
            echo '<section style="padding-bottom:20px;">';
            echo '<span style="text-transform:uppercase;margin:15px 0 0;display:inline-block;">' . $custom_term->name . '</span>';

            while ($loop->have_posts()) {
              $loop->the_post();

              $bio = get_field('bio');
              $email = get_field('email');
              $office_location = get_field('office_location');
              $phone = get_field('phone');
              ?>
              <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php the_post_thumbnail('thumbnail'); ?>

                <div class="header-content-wrapper">
                  <header class="entry-header">
                    <?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
                  </header><!-- .entry-header -->

                  <div class="entry-content">
                    <?php
                    the_excerpt();

                    if (!empty($bio)) {
                      echo $bio;
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
            <?php
            }
          echo '</section>';
        }
      }
      ?> 
      </main><!-- #main -->
    </div><!-- #primary -->
  </div><!-- .container -->

<?php
get_footer();
