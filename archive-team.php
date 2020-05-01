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
            echo '<h3 class="team-title">' . $custom_term->name . '</h3>';
            echo '<div class="team-grid">';
            while ($loop->have_posts()) {
              $loop->the_post();

              $title_position = get_field('titleposition');
              ?>
              <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" id="post-<?php the_ID(); ?>">
                <?php
                the_post_thumbnail('full');
                the_title( '<h4>', '</h4>' );

                if (!empty($title_position)) {
                  echo $title_position;
                }
                ?>
              </a><!-- #post-<?php the_ID(); ?> -->
            <?php
            }
          echo '</div> <!-- .team-grid -->';
          echo '<hr class="wp-block-separator">';
        }
      }
      ?> 
      </main><!-- #main -->
    </div><!-- #primary -->
  </div><!-- .container -->

<?php
get_footer();
