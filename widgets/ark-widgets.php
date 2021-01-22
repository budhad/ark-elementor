<?php

class Ark_News_Elementor_Widget extends \Elementor\Widget_Base {
  public function get_name() {
		return 'ark-news';
	}

	public function get_title() {
		return __( 'arkNews', 'ark-elementor' );
	}

	public function get_icon() {
		return 'fa fa-code';
	}

	public function get_categories() {
		return [ 'ark' ];
  }
  
  protected function _register_controls() {
    $this->start_controls_section(
      'content_section',
      [
        'label' => __( 'Content', 'ark-elementor' ),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
      'url',
      [
        'label' => __( 'URL to embed', 'ark-elementor' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'input_type' => 'url',
        'placeholder' => __( 'https://your-link.com', 'ark-elementor' ),
      ]
    );

    $this->end_controls_section();
  }
  
  protected function render() {

    $settings = $this->get_settings_for_display();

    $html = wp_oembed_get( $settings['url'] );

    echo '<div class="oembed-elementor-widget">';

    echo ( $html ) ? $html : $settings['url'];

    echo '</div>';

  }
}