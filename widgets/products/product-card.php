<?php

namespace ArkElementor\Widgets\Products;

if (!defined( 'ABSPATH ') ) {
  exit;
}

class ProductCard {
  public static $instance = null;

  public static function instance() {
    if (is_null(self::$instance)) {
      self::$instance = new self();
    }
    return self::$instance;
  }
  
}

ProductCard::instance();