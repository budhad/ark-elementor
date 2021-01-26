<?php

namespace ArkElementor\Widgets\Products;

if (!defined( 'ABSPATH') ) {
  exit;
}

class ProductCard {
  // public static $instance = null;

  // public static function instance() {
  //   if (is_null(self::$instance)) {
  //     self::$instance = new self();
  //   }
  //   return self::$instance;
  // }
  private static function render_card( $post ) {
    $thumbnail = get_the_post_thumbnail( $post->ID, 'full' );
    ?>
    <div class="ark_card">
      <div class="ark_card-header">
        <div class="header_image-wrapper">
          <?php echo $thumbnail; ?>
        </div>
      </div>
      <div class="ark_card-body">

      </div>
      <div class="ark_card-footer">

      </div>
    </div>
    <?php
  }

  public static function render_products( $wp_query ) {
    if ( is_wp_error($wp_query) ) {
      return;
    }
    $html_cards = [];
    if ($wp_query->have_posts()) {
      while ($wp_query->have_posts()) {
        $wp_query->the_post();

        $html_cards[] = self::render_card( $wp_query->current_post );
      }
      wp_reset_postdata();
    }

    return $html_cards;
  }

  public static function render_product($id) {
    return 'chepuha' . $id;
  }
  
}

// ProductCard::instance();