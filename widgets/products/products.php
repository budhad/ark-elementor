<?php

namespace ArkElementor\Widgets\Products;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use ArkMagazine\ArkMagazine;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Ark_Products_Elementor_Widget extends Widget_Base {

  public function get_name() {
		return 'ark-products';
	}

	public function get_title() {
		return __( 'ARK Товары', 'ark-elementor' );
	}

	public function get_icon() {
		return 'fab fa-studiovinari';
	}

	public function get_categories() {
		return [ 'arkCategory' ];
  }
  
  protected function _register_controls() {
    $this->start_controls_section(
      'content_section',
      [
        'label' => __( 'Товары', 'ark-elementor' ),
        'tab' => Controls_Manager::TAB_CONTENT,
      ]
    );

    $options = [
      'cards'     => 'Карточки',
      'no-cards'  => 'Не карточки'
    ];

    $this->add_control(
      'view_type',
      [
        'label' => __( 'Внешний вид', 'ark-elementor' ),
        'type' => Controls_Manager::SELECT,
        'placeholder' => __( 'https://your-link.com', 'ark-elementor' ),
        'options' => $options
      ]
    );

    $this->add_control(
			'pagination_page_limit',
			[
				'label' => __( 'Лимиты', 'ark-elementor' ),
				'default' => '5',
				'condition' => [
					'view_type' => [
            'cards'
          ],
				],
			]
		);
    
    $this->add_control(
			'alignment',
			[
				'label' => __( 'Alignment', 'ark-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'yes' => [
						'title' => __( 'yes', 'ark-elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'no' => [
						'title' => __( 'no', 'ark-elementor' ),
						'icon' => 'fa fa-align-center',
					],
				],
				'default' => 'yes',
			]
    );
    
    $this->add_control(
			'thousand_separator',
			[
				'label' => __( 'Thousand Separator', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Show', 'elementor' ),
				'label_off' => __( 'Hide', 'elementor' ),
			]
    );
    
    $this->add_control(
			'pagination_page_limit1',
			[
				'label' => __( 'Лимиты', 'ark-elementor' ),
				'default' => '3',
				'condition' => [
					'thousand_separator' => [
            'yes'
          ],
				],
			]
		);

    $this->end_controls_section();
  }
  
  protected function render() {

    $settings = $this->get_settings_for_display();


    // $this->add_inline_editing_attributes( 'view_type', 'basic' );
    // $this->add_inline_editing_attributes( 'content', 'advanced' );

    // $products

    ?>

      <h2><?php  ?></h2>
      <div <?php //echo $this->get_render_attribute_string( 'content' ); ?>><?php //echo $settings['content']; ?></div>
		
    <?php
    // $html = wp_oembed_get( $settings['url'] );

    echo '<div class="oembed-elementor-widget">';

    $posts = ArkMagazine::$instance->product->get_wp_products();

    // var_dump($posts);

    $html_cards = ProductCard::render_products($posts);

    foreach ($html_cards as $card) {
      echo $card;
    }

    // echo  $settings['view_type'];

    echo '</div>';

  }

  protected function _content_template() {
		?>
    <# view.addInlineEditingAttributes( 'view_type', 'basic' ); #>
		<h3 {{{ view.getRenderAttributeString( 'view_type' ) }}}>{{{ settings.view_type }}}</h3>
    <div {{{ view.getRenderAttributeString( 'content' ) }}}>{{{ settings.content }}}</div>
		
		<?php
	}

}