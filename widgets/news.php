<?php

namespace ArkElementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Ark_News_Elementor_Widget extends \Elementor\Widget_Base {
  public function get_name() {
		return 'ark-news';
	}

	public function get_title() {
		return __( 'arkNews', 'ark-elementor' );
	}

	public function get_icon() {
		return 'fas fa-newspaper';
	}

	public function get_categories() {
		return [ 'arkCategory' ];
  }
  
  protected function _register_controls() {
    $this->start_controls_section(
      'content_section',
      [
        'label' => __( 'Content', 'ark-elementor' ),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $types_post = $this->get_all_type_post();
    $options = [];
    foreach ($types_post as $type_post) {
      $options[$type_post] = $type_post;
    }

    $this->add_control(
      'post_type',
      [
        'label' => __( 'Тип записи', 'ark-elementor' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'placeholder' => __( 'https://your-link.com', 'ark-elementor' ),
        'options' => $options
      ]
    );

    $this->end_controls_section();
  }
  
  protected function render() {

    $settings = $this->get_settings_for_display();

    // $html = wp_oembed_get( $settings['url'] );

    echo '<div class="oembed-elementor-widget">';

    echo  $settings['post_type'];

    echo '</div>';

  }

  private function get_all_type_post() {
    $args = [
      'public' => true
    ];
    return get_post_types($args);
  }
}
