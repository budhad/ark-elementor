<?php
/* Plugin Name: ARK Elementor addons
* Description: Создание аддонов для elementor
* Author:      NikiTikiTa
* Version:     0.0.1
*
* Text Domain: ark-elementor
*
* License:     GPL2
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
*
*/

// this test git
// this test branch
// test new brach for master
// new branch iss54

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

final class Ark_Elementor_Extension {

	// const VERSION;
	// const MINIMUM_ELEMENTOR_VERSION;
	// const MINIMUM_PHP_VERSION;

  private static $_instance = null;
  
	public static function instance() {
    if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
  }

	public function __construct() {
    add_action( 'plugins_loaded', [ $this, 'on_plugins_loaded' ] );
  }

  public function i18n() {
		load_plugin_textdomain( 'ark-elementor' );
  }
  
	public function on_plugins_loaded() {
    if ( $this->is_compatible() ) {
			add_action( 'elementor/init', [ $this, 'init' ] );
		}
  }

	public function is_compatible() {
    if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return false;
		}

		return true;
  }

	public function init() {
    $this->i18n();

    add_action( 'elementor/elements/categories_registered', 'add_elementor_widget_categories' );

    $this->includes();
    add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
    // add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
    // add_action( 'elementor/controls/controls_registered', [ $this, 'init_controls' ] );
    add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_styles' ] );
    add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

  }

  public function includes() {
    require_once( __DIR__ . '/widgets/ark-widgets.php' );
  }

  public function register_widgets() {
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Ark_News_Elementor_Widget() );
		// \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Test_Widget2() );
	}

  public function widget_scripts() {
    // wp_register_script( 'some-library', plugins_url( 'js/libs/some-library.js', __FILE__ ) );
  }

  public function widget_styles() {
    // wp_register_style( 'widget-1', plugins_url( 'css/widget-1.css', __FILE__ ) );
		// wp_register_style( 'widget-2', plugins_url( 'css/widget-2.css', __FILE__ ) );
  }

  public function add_elementor_widget_categories($elements_manager) {
    $elements_manager->add_category(
      'arkCategory',
      [
        'title' => __( 'ark', 'ark-elementor' ),
        'icon' => 'fab fa-accessible-icon',
      ]
    );
  }

  public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'elementor-test-extension' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'elementor-test-extension' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-test-extension' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

  // public function init_widgets() {
	// 	require_once( __DIR__ . '/widgets/ark-widget.php' );
	// 	// Register widget
	// 	\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Test_Widget() );
	// }

	// public function init_controls() {
	// 	// Include Control files
	// 	require_once( __DIR__ . '/controls/ark-control.php' );
	// 	// Register control
	// 	\Elementor\Plugin::$instance->controls_manager->register_control( 'control-type-', new \Test_Control() );
	// }
}
Ark_Elementor_Extension::instance();