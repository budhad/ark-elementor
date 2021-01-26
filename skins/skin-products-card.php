<?php

namespace ArkElementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Skin_Products_Cards extends Skin_Base {
	protected function _register_controls_actions() {
		parent::_register_controls_actions();

		// add_action( 'elementor/element/posts/cards_section_design_image/before_section_end', [ $this, 'register_additional_design_image_controls' ] );
  }
  
	public function get_id() {
		return 'cards';
	}

	public function get_title() {
		return __( 'Cards', 'ark-elementor' );
  }
  
  public function start_controls_tab( $id, $args ) {
		$args['condition']['_skin'] = $this->get_id();
		$this->parent->start_controls_tab( $this->get_control_id( $id ), $args );
	}

	public function end_controls_tab() {
		$this->parent->end_controls_tab();
	}

	public function start_controls_tabs( $id ) {
		$args['condition']['_skin'] = $this->get_id();
		$this->parent->start_controls_tabs( $this->get_control_id( $id ) );
	}

	public function end_controls_tabs() {
		$this->parent->end_controls_tabs();
	}
}