<?php

namespace DT\Contact\Controllers;

use DT\Contact\Views\Dtc;

class ScriptController{

      /**
	 * Version
	 *
	 * @var string
	 */
	private $version;


      public function __construct() {
		// $this->version = defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : RT_THE_POST_GRID_VERSION;
		// add_action( 'wp_head', [ $this, 'header_scripts' ] );
		add_action( 'init', [ $this, 'init' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue' ] );



	}

      public function enqueue(){
            wp_enqueue_style( 'dt-tpg-admin' );
            wp_enqueue_script( 'dt-js-admin' );
      }

      public function init(){

            // register scripts.
            $scripts = [];
            $styles  = [];
		
            // Plugin specific css.
            // $styles['dt-tpg']           = DtContact()->tpg_can_be_rtl( 'css/thepostgrid' );
            // $styles['dt-tpg-block']     = DtContact()->tpg_can_be_rtl( 'css/tpg-block' );
            // $styles['dt-tpg-shortcode'] = DtContact()->tpg_can_be_rtl( 'css/tpg-shortcode' );
            $styles['dt-tpg-admin']         = DtContact()->get_assets_uri( 'css/admin/admin.css' );
            // $scripts['dt-js-admin']         = DtContact()->get_assets_uri( 'js/admin/admin.js' );
		// var_dump( $scripts );die();
		// if ( is_admin() ) {
		// 	$scripts[] = [
		// 		'handle' => 'rt-select2',
		// 		'src'    => Dtc()->get_assets_uri( 'vendor/select2/select2.min.js' ),
		// 		'deps'   => [ 'jquery' ],
		// 		'footer' => false,
		// 	];
		// 	$scripts[] = [
		// 		'handle' => 'rt-tpg-admin',
		// 		'src'    => Dtc()->get_assets_uri( 'js/admin.js' ),
		// 		'deps'   => [ 'jquery', 'wp-color-picker', 'jquery-ui-sortable' ],
		// 		'footer' => true,
		// 	];
		// 	$scripts[] = [
		// 		'handle' => 'rt-tpg-admin-preview',
		// 		'src'    => Dtc()->get_assets_uri( 'js/admin-preview.js' ),
		// 		'deps'   => [ 'jquery' ],
		// 		'footer' => true,
		// 	];
            // }
            // die();
            // echo 'this is demo style';
            foreach ( $styles as $k => $v ) {
			wp_register_style( $k, $v, false, isset( $script['version'] ) ? $script['version'] : $this->version );
		}

		// foreach ( $scripts as $k => $v ) {
		// 	wp_register_script( $k, $v, false, isset( $script['version'] ) ? $script['version'] : $this->version );
		// }


      }
}
